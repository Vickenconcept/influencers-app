<!DOCTYPE html>
<html lang="en" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('image/favicon.ico') }}"> --}}

    <title>Trust</title>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-d68d94cf.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-9d378ada   .css') }}">


    @livewireStyles
</head>

<body class="h-full">
    {{ $slot }}

</body>


<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>


<script>
    window.addEventListener('beforeunload', function(event) {
        var hiddenText = document.getElementById('hiddenText');
        hiddenText.classList.remove('hidden');
    });
</script>


<script>
    function PrintDiv(div) {
        var img = new Image();
        img.src = document.getElementById('imageToCapture').src;

        img.onload = function() {
            html2canvas(div, {
                logging: true,
                letterRendering: 1,
                allowTaint: false,
                useCORS: true,
                dpi: 144,
                scale: 2,
                onrendered: function(canvas) {
                    setpixelated(canvas.getContext('2d')); // Set pixelated rendering
                    var myImage = canvas.toDataURL();
                    downloadURI(myImage, "my-review.png");
                }
            });
        };
    }

    function downloadURI(uri, name) {
        var link = document.createElement("a");

        link.download = name;
        link.href = uri;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function setpixelated(context) {
        context['imageSmoothingEnabled'] = false; 
        context['mozImageSmoothingEnabled'] = false; 
        context['oImageSmoothingEnabled'] = false; 
        context['webkitImageSmoothingEnabled'] = false; 
        context['msImageSmoothingEnabled'] = false; 
    }
</script>

@livewireScripts
<script type="module" src="{{ asset('build/assets/app-e353bb9b.js   ') }}"></script>

</html>
