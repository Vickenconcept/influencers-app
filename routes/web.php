<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CampaignInquiryController;
use App\Http\Controllers\InfluencerController;
use App\Http\Controllers\InfluncersGroupController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\ProfileController;
use App\Services\FacebookInfluencerService;
use App\Services\InfluencerService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;

Route::get('/', function () {
    return view('welcome');
});




Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::view('register', 'auth.register')->name('register');
    Route::view('register/success', 'auth.success')->name('register.success');
    // Route::view('detail', 'auth.web-detail')->name('detail');


    Route::controller(AuthController::class)->prefix('auth')->name('auth.')->group(function () {
        Route::post('/register', 'register')->name('register');
        Route::post('/login', 'login')->name('login');
    });
    Route::controller(PasswordResetController::class)->group(function () {
        Route::get('forgot-password', 'index')->name('password.request');
        Route::post('forgot-password', 'store')->name('password.email');
        Route::get('/reset-password/{token}', 'reset')->name('password.reset');
        Route::post('/reset-password', 'update')->name('password.update');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/home', function () {
        return view('dashboard');
    })->name('home');

    Route::view('profile', 'profile')->name('profile');
    Route::post('profile/name', [ProfileController::class, 'changeName'])->name('changeName');
    Route::post('profile/password', [ProfileController::class, 'changePassword'])->name('changePassword');

    Route::get('platform/{platform}', [PlatformController::class, 'platform'])->name('platform.search');
    Route::get('creator-profile/{influencer_id}', function($influencer_id){
        return view('influencer', compact('influencer_id'));
    })->name('show.influencer');

    Route::resource('groups', InfluncersGroupController::class);
    Route::resource('influencers', InfluencerController::class);
    Route::resource('campaigns', CampaignController::class);
    Route::post('inquiries/{campaignId}/{influencerId}', [CampaignInquiryController::class, 'sendInquiry']);
});

// Route::get('try', function () 
// {

//     dd( Cache::get('facebook_influencer_details'));
//     $client = new Client();

//     // Step 1: Search for influencers
//     $response = $client->request('POST', 'https://dev.creatordb.app/v2/facebookAdvancedSearch', [
//         'body' => json_encode([
//             "maxResults" => 50,
//             "sortBy" => "followers",
//             "offset" => 0,
//             "desc" => true,
//             "filters" => [
//                 [
//                     "filterKey" => "followers",
//                     "op" => ">",
//                     "value" => 10000,
//                 ]
//             ],
//         ]),
//         'headers' => [
//             'Accept' => 'application/json',
//             'Content-Type' => 'application/json',
//             'apiId' => 'b3e3a97d2e6f09e2-F1vuybqkFX8mLk3wBbNR', // Replace with your valid API ID
//         ],
//     ]);

//     $searchResults = json_decode($response->getBody(), true);
//     $facebookIds = $searchResults['data'] ?? []; // Extract Facebook IDs

//     // Step 2: Fetch details for each Facebook ID
//     $details = [];
//     foreach ($facebookIds as $facebookId) {
//         try {
//             $detailResponse = $client->request('GET', 'https://dev.creatordb.app/v2/facebookBasic', [
//                 'headers' => [
//                     'Accept' => 'application/json',
//                     'apiId' => 'b3e3a97d2e6f09e2-F1vuybqkFX8mLk3wBbNR', // Replace with your valid API ID
//                 ],
//                 'query' => [
//                     'facebookId' => $facebookId,
//                 ],
//             ]);

//             $data = json_decode($detailResponse->getBody(), true);
//             $details[] = $data; // Add the response to the details array

//         } catch (\Exception $e) {
//             // Log the error or handle it as needed
//             error_log("Error fetching details for ID $facebookId: " . $e->getMessage());
//         }
//     }

//     Cache::put('facebook_influencer_details', $details, now()->addDays(30));
   
//     // Debug or return the results
//     echo json_encode($details, JSON_PRETTY_PRINT);
// });

Route::get('try', function (FacebookInfluencerService $service) {

    //  dd(Cache::get('facebook_details_2000'));
    // $facebookConfig = [
    //     'apiId' => 'b3e3a97d2e6f09e2-F1vuybqkFX8mLk3wBbNR',
    //     'searchEndpoint' => 'https://dev.creatordb.app/v2/facebookAdvancedSearch',
    //     'detailsEndpoint' => 'https://dev.creatordb.app/v2/facebookBasic',
    // ];
    $tiktokConfig = [
        'apiId' => 'b3e3a97d2e6f09e2-F1vuybqkFX8mLk3wBbNR',
        'searchEndpoint' => 'https://dev.creatordb.app/v2/tiktokAdvancedSearch',
        'detailsEndpoint' => 'https://dev.creatordb.app/v2/tiktokBasic',
    ];
    
    $service = new InfluencerService($tiktokConfig);
    
    // Fetch details for Facebook influencers
    $platform = 'tiktok';
    $followersCount = 3000;

    $details = $service->fetchPlatformInfluencerDetails($platform, $followersCount);
    // dd($details);
    
});

Route::get('/proxy-image', function () {
    $imageUrl = request('url');
    $response = Http::get($imageUrl);

    if ($response->ok()) {
        return response($response->body(), 200)->header('Content-Type', 'image/jpeg');
    }

    return response('Image not found', 404);
});


// Route::get('/proxy-image', function () {
//     $imageUrl = request('url');

//     $cacheKey = 'proxy_image_' . md5($imageUrl);

//     // Check if the image is already cached
//     if (Cache::has($cacheKey)) {
//         return response(Cache::get($cacheKey), 200)->header('Content-Type', 'image/jpeg');
//     }

//     // Fetch the image from the external source
//     $response = Http::get($imageUrl);

//     if ($response->ok()) {
//         // Cache only if the image is found
//         Cache::put($cacheKey, $response->body(), now()->addDays(7));
//         return response($response->body(), 200)->header('Content-Type', 'image/jpeg');
//     }

//     // Do not cache the "not found" response
//     return response('Image not found', 404);
// });

