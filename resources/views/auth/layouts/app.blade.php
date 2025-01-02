<!DOCTYPE html>
<html lang="en" class="h-full bg-white ">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('image/favicon.ico') }}"> --}}

    <title>Trust Convert io</title>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://unpkg.com/cloudinary-video-player@2.5.0/dist/cld-video-player.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cloudinary-core/2.13.1/cloudinary-core-shrinkwrap.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>



    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>


    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-d68d94cf.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-9d378ada   .css') }}"> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    <style>
        #htmltoimage {
            width: 65%;
            margin: auto;
        }
    </style>


</head>

<body class="h-full ">
    <x-notification />
    <div id="ap" class="h-full bg-gray- text-gray-700 " x-data="{ openHelp: false }">
        <x-sidebar />
        <div class=" h-full sm:ml-64">
            {{ $slot }}

            {{-- <x-footer /> --}}

        </div>
    </div>

    <script>
        window.addEventListener('beforeunload', function(event) {
            var hiddenText = document.getElementById('hiddenText');
            hiddenText.classList.remove('hidden');
        });
    </script>

    <script>
        const video = document.getElementById('video');
        const startButton = document.getElementById('start');
        const stopButton = document.getElementById('stop');
        const uploadButton = document.querySelector('button[type="submit"]');
        let mediaRecorder;
        let recordedBlob;

        function startRecording() {
            navigator.mediaDevices.getUserMedia({
                    audio: true,
                    video: true
                })
                .then((stream) => {
                    video.srcObject = stream;
                    mediaRecorder = new MediaRecorder(stream);

                    mediaRecorder.ondataavailable = (e) => {
                        if (e.data.size > 0) {
                            recordedBlob = e.data;
                        }
                    };

                    mediaRecorder.onstop = () => {
                        // Enable buttons after recording stops
                        startButton.disabled = false;
                        stopButton.disabled = true;
                        uploadButton.disabled = false;

                        // Log the video type
                        console.log('Recorded video type:', recordedBlob.type);
                        uploadVideo(recordedBlob);
                    };

                    // Enable buttons after starting recording
                    startButton.disabled = true;
                    stopButton.disabled = false;
                    uploadButton.disabled = true;

                    mediaRecorder.start();
                    console.log('Recording started');
                })
                .catch((error) => {
                    console.error('Error accessing camera:', error);
                });
        }

        function stopRecording() {
            mediaRecorder.stop();
            console.log('Recording stopped');
        }

        // Video upload logic
        function uploadVideo(blob) {
            const uploadUrl = '/upload-video';

            const formData = new FormData();
            formData.append('video', blob, 'recorded-video.webm');

            // Get the CSRF token from a meta tag in the HTML
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(uploadUrl, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the headers
                    },
                })
                .then(response => {
                    if (response.ok) {
                        const contentType = response.headers.get('content-type');
                        if (contentType && contentType.includes('application/json')) {
                            return response.json();
                        } else {
                            throw new Error('Invalid response format');
                        }
                    } else {
                        return response.json(); // Include validation error messages in the error object
                    }
                })
                .then(data => {
                    if (data.errors) {
                        const errorMessages = Object.values(data.errors).flat();
                        throw new Error(`Validation error: ${errorMessages.join(', ')}`);
                    } else {
                        console.log('Video uploaded successfully:', data);
                        video.src = data.videoUrl;
                    }
                })
                .catch(error => {
                    console.error('Error uploading video:', error);
                });


        }
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

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
                    onrendered: function(canvas) {
                        var myImage = canvas.toDataURL();
                        downloadURI(myImage, "my-review.jpg");
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
    </script>





    @livewireScripts
    <script type="module" src="{{ asset('build/assets/app-e353bb9b.js   ') }}"></script>

</body>

</html>
