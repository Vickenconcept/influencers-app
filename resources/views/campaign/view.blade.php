<x-guest-layout>
    <div>
        <h1>Campaign: {{ $campaign->title }}</h1>
        <p>{{ $campaign->description }}</p>
        <p>Budget: {{ $campaign->budget }}</p>

        <form method="POST" action="{{ route('campaign.respond') }}">
            @csrf
            <input type="hidden" name="token" value="{{ request('token') }}">
            <button type="submit" name="response" value="accepted">Accept</button>
            <button type="submit" name="response" value="declined">Decline</button>
        </form>

    </div>
</x-guest-layout>
