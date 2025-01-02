<div>
    <div>

        <div class="overflow-auto lg:overflow-visible ">
            <table class="table text-gray-700 border-separate space-y-6 text-sm w-full">
                <thead class="bg-gray-200 text-gray-800">
                    <tr>
                        <th class="p-3">Brand</th>
                        <th class="p-3 text-left">Platform</th>
                        <th class="p-3 text-left">Language</th>
                        <th class="p-3 text-left">Country</th>
                        <th class="p-3 text-left">Followers</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Tags</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($influencers as $influencer)
                        {{-- {{ $influencer->content }} --}}
                        @php
                            $content = json_decode($influencer->content);
                        @endphp
                        <tr class="bg-gray-200">
                            <td class="p-3">
                                <div class="flex align-items-center">
                                    <img class="rounded-full h-12 w-12  object-cover" src="{{ $content->avatar }}" />
                                    <div class="ml-3">
                                        <div class="">
                                            {{-- name --}}
                                            @isset($content->facebookName)
                                                {{ $content->facebookName }}
                                            @endisset
                                            @isset($content->tiktokName)
                                                {{ $content->tiktokName }}
                                            @endisset

                                        </div>
                                        <div class="text-gray-800">mail@rgmail.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3 font-semibold capitalize">
                                @isset($influencer->platform)
                                    {{ $influencer->platform }}
                                @endisset
                            </td>
                            <td class="p-3">
                                @isset($content->lang)
                                    {{ $content->lang }}
                                @endisset
                            </td>
                            <td class="p-3">
                                @isset($content->country)
                                    {{ $content->country }}
                                @endisset
                            </td>
                            <td class="p-3 font-bold">
                                @isset($content->followers)
                                    {{ format_number($content->followers) }}
                                @endisset
                            </td>
                            <td class="p-3">
                                <span class="bg-green-400 text-gray-50 rounded-md px-2">available</span>
                            </td>
                            <td class="p-3 ">
                                @isset($content->hashtags)
                                    <span>{{ flatten_array($content->hashtags, ' | ', 4) }} </span>
                                @endisset
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
