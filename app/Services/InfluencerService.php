<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use App\Jobs\FetchInfluencerDetailsJob;
use Illuminate\Support\Facades\Log;

class InfluencerService
{
    private $client;
    private $config;

    public function __construct(array $config)
    {
        $this->client = new Client();
        $this->config = $config;
    }

    // $filters = $this->filtersOption(
    //     '>', // Operator
    //     null, // category
    //     'E-commerce', // categoryBusiness
    //     true, // isVerified
    //     true, // isBusinessAccount
    //     false, // isPrivateAccount
    //     10000, // followers
    //     5, // engageRate
    //     'United States' // country
    // );
    // public function searchInfluencers($maxResults = 20,  $followers = 1000)
    public function searchInfluencers(
        $category = null,
        $categoryBusiness = null,
        $isVerified = null,
        $isBusinessAccount = null,
        $isPrivateAccount = null,
        $followers = 1000,
        $engageRate = null,
        $country = null,
        $lang = null,
    ) {

        $filters = $this->filtersOption(
            $category,
            $categoryBusiness,
            $isVerified,
            $isBusinessAccount,
            $isPrivateAccount,
            $followers,
            $engageRate,
            $country,
            $lang,
        );


        $maxResults = 20;
        $response = $this->client->request('POST', $this->config['searchEndpoint'], [
            'body' => json_encode([
                "maxResults" => min($maxResults, 20),
                "sortBy" => "followers",
                "offset" => 0,
                "desc" => true,
                "filters" => $filters,
                // "filters" => [
                //     [
                //         "filterKey" => "followers",
                //         "op" => ">",
                //         "value" => $followers,
                //     ]
                // ],
            ]),
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'apiId' => $this->config['apiId'],
            ],
        ]);

        $searchResults = json_decode($response->getBody(), true);
        return $searchResults['data'] ?? [];
    }

    public function fetchPlatformInfluencerDetails(
        $platform,
        $category,
        $categoryBusiness,
        $isVerified,
        $isBusinessAccount,
        $isPrivateAccount,
        $followers,
        $engageRate,
        $country,
        $lang,
    ) {
        // Generate a dynamic cache key
        $cacheKey = "{$platform}_details";

        // Check if the details already exist in cache
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // Step 1: Search for influencers and get their IDs
        $influencers = $this->searchInfluencers(
            $category,
            $categoryBusiness,
            $isVerified,
            $isBusinessAccount,
            $isPrivateAccount,
            $followers,
            $engageRate,
            $country,
            $lang,
        );
        $platformIds = $influencers;
        // $platformIds = array_column($influencers, 'id');

        if (empty($platformIds)) {
            return [];
        }

        // Step 2: Fetch the first 10 details synchronously
        $firstBatch = array_splice($platformIds, 0, 10);
        $firstDetails = [];
        foreach ($firstBatch as $platformId) {
            try {
                $firstDetails[] = $this->fetchDetailById($platformId, $platform);
            } catch (\Exception $e) {
                \Log::error("Error fetching details for ID $platformId on platform $platform: " . $e->getMessage());
            }
        }

        // Cache the first batch
        Cache::put($cacheKey, $firstDetails, now()->addDays(30));

        // Step 3: Dispatch a job to fetch the remaining details asynchronously
        FetchInfluencerDetailsJob::dispatch($platformIds, $cacheKey, $this->config, $platform)
            ->onQueue('influencer-details');


        return Cache::get("{$platform}_details");
        // return $firstDetails;
    }

    /**
     * Fetch details for a specific ID.
     *
     * @param string $platformId
     * @param string $platform
     * @return array
     */
    private function fetchDetailById($platformId, $platform)
    {
        $response = $this->client->request('GET', $this->config['detailsEndpoint'], [
            'headers' => [
                'Accept' => 'application/json',
                'apiId' => $this->config['apiId'],
            ],
            'query' => [
                "{$platform}Id" => $platformId,
            ],
        ]);

        $responseData = json_decode($response->getBody(), true);


        $platformKey = '';

        if ($platform == 'tiktok') {
            $platformKey = 'basic' . str_replace('t', 'T', $platform);
        } else {
            $platformKey =  'basic' . ucfirst($platform);
        }

        foreach (['avatar', 'cover'] as $key) {
            if (isset($responseData['data'][$platformKey][$key])) {
                $imageUrl = $responseData['data'][$platformKey][$key];

                $imageData = file_get_contents($imageUrl);

                if ($imageData !== false) {
                    $base64Image = base64_encode($imageData);

                    $responseData['data'][$platformKey][$key] = 'data:image/jpeg;base64,' . $base64Image;
                }
            }
        }

        return  $responseData;
    }



    private function filtersOption(
        $category,
        $categoryBusiness,
        $isVerified,
        $isBusinessAccount,
        $isPrivateAccount,
        $followers,
        $engageRate,
        $country,
        $lang,
    ) {
        $filters = [];

        if ($category !== null) {
            $filters[] = [
                "filterKey" => "category",
                "op" => "=",
                "value" => $category
            ];
        }

        if ($categoryBusiness !== null) {
            $filters[] = [
                "filterKey" => "categoryBusiness",
                "op" => "=",
                "value" => $categoryBusiness
            ];
        }

        if ($isVerified !== null) {
            $filters[] = [
                "filterKey" => "isVerified",
                "op" => "=",
                "value" => $isVerified
            ];
        }

        if ($isBusinessAccount !== null) {
            $filters[] = [
                "filterKey" => "isBusinessAccount",
                "op" => "=",
                "value" => $isBusinessAccount
            ];
        }

        if ($isPrivateAccount !== null) {
            $filters[] = [
                "filterKey" => "isPrivateAccount",
                "op" => "=",
                "value" => $isPrivateAccount
            ];
        }

        if ($country !== null) {
            $filters[] = [
                "filterKey" => "country",
                "op" => "=",
                "value" => $country
            ];
        }
        if ($lang !== null) {
            $filters[] = [
                "filterKey" => "lang",
                "op" => "=",
                "value" => $lang
            ];
        }

        if ($followers !== null) {
            $filters = array_merge($filters, $followers);
        }

        return $filters;
    }
}
