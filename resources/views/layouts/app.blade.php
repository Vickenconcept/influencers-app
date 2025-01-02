<!DOCTYPE html>
<html lang="en" class="h-full bg-white ">

<head>
    <x-seo::meta />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @seo([
        'title' => 'Influence',
        'description' => 'Review Manager app',
        'image' => asset('images/trustconvert.png'),
        'site_name' => config('app.name'),
        'favicon' => asset('favicon.ico'),
    ])

    <title>Influence</title>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://unpkg.com/@alpinejs/focus" defer></script>




    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    @yield('styles')


</head>

<body class="h-screen ">
    <div id="app" class="h-full  text-gray-700 ">
        <x-notification />



        

       <x-navbar />
       <x-sidebar />

        <div class="h-full p-4 sm:ml-64 bg-gray-100 pt-20 overflow-y-hidden">
            {{ $slot }}
        </div>
    </div>



    @yield('scripts')

    <script>
        window.addEventListener('beforeunload', function(event) {
            var hiddenText = document.getElementById('hiddenText');
            hiddenText.classList.remove('hidden');
        });
    </script>

    @livewireScripts

</body>

</html>
