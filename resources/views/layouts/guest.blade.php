<!DOCTYPE html>
<html lang="en" class="h-full bg-white">

<head>
    <x-seo::meta />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @seo([
        'title' => 'FluenceGrid',
        'description' => 'Influencers Management Hub',
        'image' => asset('images/login-image.png'),
        'site_name' => config('app.name'),
        'favicon' => asset('images/fav-image.png'),
    ])

    <title>Influence</title>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    @vite(['resources/css/app.css', 'resources/js/app.js'])


    @yield('styles')

    @livewireStyles
</head>

<body class="h-full">
    {{ $slot }}

</body>



<script>
    window.addEventListener('beforeunload', function(event) {
        var hiddenText = document.getElementById('hiddenText');
        hiddenText.classList.remove('hidden');
    });
</script>


@yield('scripts')
@livewireScripts

</html>
