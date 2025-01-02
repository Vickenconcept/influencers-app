<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

// class FetchInfluencerDetailsJob implements ShouldQueue
// {
//     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//     private $platformIds;
//     private $cacheKey;
//     private $config;
//     private $platform;


//     public function __construct($platformIds, $cacheKey, $config, $platform)
//     {
//         $this->platformIds = $platformIds;
//         $this->cacheKey = $cacheKey;
//         $this->config = $config;
//         $this->platform = $platform;
//     }



//     public function handle()
//     {
//         $client = new Client();

//         foreach ($this->platformIds as $platformId) {
//             try {
//                 // Make the GET request to fetch the details
//                 $response = $client->request('GET', $this->config['detailsEndpoint'], [
//                     'headers' => [
//                         'Accept' => 'application/json',
//                         'apiId' => $this->config['apiId'],
//                     ],
//                     'query' => [
//                         "{$this->platform}Id" => $platformId,
//                     ],
//                 ]);

//                 // Decode the response into an array
//                 $detail = json_decode($response->getBody(), true);

//                 // Create dynamic platform key
//                 $platformKey = 'basic' . ucfirst($this->platform);

//                 // Log the structure of the detail to verify the platformKey
//                 Log::info('Full response data:', ['detail' => $detail]);

//                 // Loop over avatar and cover to encode images to base64
//                 foreach (['avatar', 'cover'] as $key) {
//                     if (isset($detail['data'][$platformKey][$key])) {
//                         $imageUrl = $detail['data'][$platformKey][$key];

//                         // Log the image URL to ensure it's being passed correctly
//                         Log::info("Fetching image for {$key}: $imageUrl");

//                         try {
//                             // Fetch the image content using Guzzle
//                             $imageResponse = $client->get($imageUrl, [
//                                 'headers' => [
//                                     'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36',
//                                     'Accept' => 'image/webp,image/apng,image/*,*/*;q=0.8',
//                                     'Accept-Encoding' => 'gzip, deflate, br',
//                                 ]
//                             ]);

//                             // Log the status code to check if the image was fetched successfully
//                             Log::info("Image fetch status: " . $imageResponse->getStatusCode() . " for $imageUrl");

//                             if ($imageResponse->getStatusCode() == 200) {
//                                 $imageData = $imageResponse->getBody()->getContents();

//                                 // Detect the image type dynamically (image/jpeg, image/png, etc.)
//                                 $imageType = $imageResponse->getHeader('Content-Type')[0] ?? 'image/jpeg'; // Default to 'image/jpeg' if not provided

//                                 // Encode the image to base64
//                                 $base64Image = base64_encode($imageData);

//                                 // Replace the original image URL with the base64-encoded string
//                                 $detail['data'][$platformKey][$key] = 'data:' . $imageType . ';base64,' . $base64Image;

//                                 Log::info("Base64 encoded image for {$key} on platform {$this->platform}");
//                             } else {
//                                 Log::warning("Failed to fetch image: $imageUrl for $key on platform {$this->platform} with status code " . $imageResponse->getStatusCode());
//                             }
//                         } catch (\Exception $e) {
//                             Log::error("Error fetching image: {$e->getMessage()} for $key on platform {$this->platform}");
//                         }
//                     }
//                 }


//                 // Update cache with new details
//                 $cachedDetails = Cache::get($this->cacheKey, []);
//                 $cachedDetails[] = $detail;

//                 // Store the updated details in cache with a 30-day expiration
//                 Cache::put($this->cacheKey, $cachedDetails, now()->addDays(30));
//             } catch (\Exception $e) {
//                 // Log any exceptions encountered during the process
//                 Log::error("Error fetching details for ID $platformId on platform {$this->platform}: " . $e->getMessage());
//             }
//         }
//     }

//     // public function handle()
//     // {
//     //     $client = new Client();

//     //     foreach ($this->platformIds as $platformId) {
//     //         try {
//     //             $response = $client->request('GET', $this->config['detailsEndpoint'], [
//     //                 'headers' => [
//     //                     'Accept' => 'application/json',
//     //                     'apiId' => $this->config['apiId'],
//     //                 ],
//     //                 'query' => [
//     //                     "{$this->platform}Id" => $platformId,
//     //                 ],
//     //             ]);

//     //             $detail = json_decode($response->getBody(), true);




//     //             $platformKey =  'basic' . ucfirst($this->platform);
//     //             // Check and modify the avatar and cover keys if they exist
//     //             foreach (['avatar', 'cover'] as $key) {
//     //                 if (isset($detail['data'][$platformKey][$key])) {
//     //                     $imageUrl = $detail['data'][$platformKey][$key];

//     //                     // Fetch the image content
//     //                     $imageData = file_get_contents($imageUrl);

//     //                     // Check if the image was fetched successfully before encoding
//     //                     if ($imageData !== false) {
//     //                         // Encode the image to base64
//     //                         $base64Image = base64_encode($imageData);

//     //                         // Replace the original image URL with the base64-encoded string
//     //                         $detail['data'][$platformKey][$key] = 'data:image/jpeg;base64,' . $base64Image;
//     //                     }
//     //                 }
//     //             }






//     //             // Update cache with new details
//     //             $cachedDetails = Cache::get($this->cacheKey, []);
//     //             $cachedDetails[] = $detail;

//     //             Cache::put($this->cacheKey, $cachedDetails, now()->addDays(30));
//     //         } catch (\Exception $e) {
//     //             Log::error("Error fetching details for ID $platformId on platform {$this->platform}: " . $e->getMessage());
//     //         }
//     //     }
//     // }
// }

class FetchInfluencerDetailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $platformIds;
    private $cacheKey;
    private $config;
    private $platform;

    public function __construct($platformIds, $cacheKey, $config, $platform)
    {
        $this->platformIds = $platformIds;
        $this->cacheKey = $cacheKey;
        $this->config = $config;
        $this->platform = $platform;
    }

    public function handle()
    {
        $client = new Client();

        foreach ($this->platformIds as $platformId) {
            try {
                // Make the GET request to fetch the details
                $response = $client->request('GET', $this->config['detailsEndpoint'], [
                    'headers' => [
                        'Accept' => 'application/json',
                        'apiId' => $this->config['apiId'],
                    ],
                    'query' => [
                        "{$this->platform}Id" => $platformId,
                    ],
                ]);

                // Decode the response into an array
                // $detail = json_decode($response->getBody(), true);

                $rawBody = $response->getBody();

                $detail = json_decode($rawBody, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    Log::error('JSON decoding failed:', ['error' => json_last_error_msg()]);
                    return;
                }

                // Log::info('Decoded response detail:', ['detail' => $detail]);


                $platformKey = '';

                if ($this->platform == 'tiktok') {
                    $platformKey = 'basic' . str_replace('t', 'T', $this->platform);
                } else {
                    $platformKey =  'basic' . ucfirst($this->platform);
                }


                // Loop over avatar and cover to encode images to base64
                foreach (['avatar', 'cover'] as $key) {
                    if (isset($detail['data'][$platformKey][$key])) {
                        $imageUrl = $detail['data'][$platformKey][$key];
                        Log::info("Processing image URL for {$key}: {$imageUrl}");

                        try {
                            $imageResponse = $client->get($imageUrl, [
                                'headers' => [
                                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36',
                                    'Accept' => 'image/webp,image/apng,image/*,*/*;q=0.8',
                                    'Accept-Encoding' => 'gzip, deflate, br',
                                ]
                            ]);

                            if ($imageResponse->getStatusCode() == 200) {
                                $imageData = $imageResponse->getBody()->getContents();

                                $imageType = $imageResponse->getHeader('Content-Type')[0] ?? 'image/jpeg'; // Default to 'image/jpeg' if not provided

                                $base64Image = base64_encode($imageData);

                                $detail['data'][$platformKey][$key] = 'data:' . $imageType . ';base64,' . $base64Image;

                                Log::info("Base64 encoded image for {$key} on platform {$this->platform}");
                            } else {
                                Log::warning("Failed to fetch image: {$imageUrl} for {$key} on platform {$this->platform} with status code " . $imageResponse->getStatusCode());
                            }
                        } catch (\Exception $e) {
                            Log::error("Error fetching image: {$e->getMessage()} for {$key} on platform {$this->platform}");
                        }
                    }
                }

                $cachedDetails = Cache::get($this->cacheKey, []);
                $cachedDetails[] = $detail;

                Cache::put($this->cacheKey, $cachedDetails, now()->addDays(30));
            } catch (\Exception $e) {
                Log::error("Error fetching details for ID $platformId on platform {$this->platform}: " . $e->getMessage());
            }
        }
    }
}
