<x-app-layout>
    @section('title')
        <p class="flex  space-x-2">
            <span>
                @if (strtolower($platform) == 'facebook')
                    <i class='bx bxl-facebook-circle text-3xl  text-blue-600'></i>
                @elseif (strtolower($platform) == 'instagram')
                    <i class='bx bxl-instagram text-3xl  bg-gradient-to-br from-yellow-600 via-red-500 to-indigo-400 inline-block text-transparent bg-clip-text'></i>
                @elseif (strtolower($platform) == 'youtube')
                    <i class='bx bxl-youtube text-3xl  text-red-600'></i>
                @elseif (strtolower($platform) == 'tiktok')
                    <i class='bx bxl-tiktok text-3xl  text-slate-900'></i>
                @else
                    <i class='bx bxl-question-mark text-3xl  text-blue-600'></i> <!-- Fallback icon -->
                @endif
            </span>
            <span>{{ $platform }} Search</span>
        </p>
    @endsection

    <div class="h-screen ">
        @livewire($platform)
    </div>

</x-app-layout>
