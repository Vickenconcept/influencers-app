    <div x-data="{ openModal: false, }" class="overflow-y-auto h-screen pb-28">
        <h3 class="capitalize font-bold text-3xl pb-10">{{ $group->name }}</h3>
        {{-- overflow-auto lg:overflow-visible --}}

        <div class=" ">
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
                        <th class="p-3 text-left">Action</th>
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
                                            @isset($content->instagramName)
                                                {{ $content->instagramName }}
                                            @endisset
                                            @isset($content->youtubeName)
                                                {{ $content->youtubeName }}
                                            @endisset

                                        </div>
                                        <div class="text-gray-800 mt-2">
                                            @if (json_decode($influencer->emails, true) != null)
                                                @if (count(json_decode($influencer->emails, true)) > 0)
                                                    <select class="rounded-lg border-0 py-1 w-24 text-sm font-semibold">
                                                        <option value="" selected disabled>Emails</option>
                                                        @foreach (json_decode($influencer->emails, true) ?? [] as $email)
                                                            <option value="{{ $email }}">{{ $email }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            @else
                                                <button
                                                    wire:click="getEmails('{{ $influencer->id }}', '{{ isset($content->youtubeId) ? $content->youtubeId : '' }}')"
                                                    class="bg-white rounded-lg px-2 py-1 text-sm  focus:ring-2 focus:ring-gray-400 ">Get
                                                    email</button>
                                                <button
                                                    wire:click="checkContactWithAI({{ json_encode($influencer->content, true) }}, '{{ $influencer->id }}')"
                                                    class="bg-white rounded-lg px-2 py-1 text-sm  focus:ring-2 focus:ring-gray-400 ">Check
                                                    with AI</button>
                                            @endif
                                        </div>
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
                                @isset($content->subscribers)
                                    {{ format_number($content->subscribers) }}
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
                            <td class="p-3 ">
                                <button @click="openModal = true" wire:key="influencer-{{ $influencer->id }}"
                                    wire:click="setInfluencer('{{ $influencer->id }}', '{{ isset($influencer->emails) ? $influencer->emails : '' }}')">Send
                                    Campaign </button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="my-8">
            {{ $influencers->links() }}
        </div>



        {{-- openModal modal --}}
        <div class="fixed items-center justify-center  flex top-0 left-0 mx-auto w-full h-full bg-gray-600 bg-opacity-30 z-50 transition duration-1000 ease-in-out"
            x-show="openModal" x-cloak>
            <div @click.away="openModal = false"
                class="bg-white w-[90%] md:w-[60%]  shadow-inner  border rounded-2xl overflow-auto  py-6 px-8 transition-all relative duration-700">
                <div class=" h-full ">
                    {{-- {{$selectedEmail}} --}}

                    <div class="flex justify-between items-center">
                        <h5 class="font-bold text-xl">All Campaign</h5>
                        <button @click="openModal = false"><i class="bx bx-x text-xl font-bold"></i></button>
                    </div>
                    {{-- <form action="{{ route('campaigns.store') }}" method="POST" class="my-10 ">
              
            </form> --}}

                    <ul class="my-4 space-y-3 h-[400px] overflow-y-auto">
                        @foreach ($campaigns as $campaign)
                            <li @click.away="openDrawer = false" class="border-2 rounded-lg" x-data="{ openDrawer: false, emailType: 'default' }">
                                <div for="{{ $campaign->id }}" @click="openDrawer = !openDrawer"
                                    wire:click="setCampaign('{{ $campaign->uuid }}')"
                                    class=" cursor-pointer flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-200 hover:bg-gray-100 campaign  justify-between">
                                    <div class="flex items-center">
                                        <i class='bx bx-task text-xl'></i>
                                        <span
                                            class="flex-1 ms-3 whitespace-nowrap capitalize">{{ $campaign->title }}</span>
                                    </div>
                                    <span><i class='bx '
                                            :class="openDrawer ? 'bxs-chevron-up' : 'bxs-chevron-down'"></i></span>
                                </div>
                                <div class=" p-4" x-show="openDrawer" x-cloak>

                                    <div>
                                        <div class="flex justify-center mb-5">
                                            <button type="button" class="whitespace-nowrap flex flex-wrap"
                                                x-show="emailType == 'default'" style="display: none">
                                                <span
                                                    class="uppercase text-white border border-blue-600  bg-blue-600 px-5 py-2 rounded-full text-sm block md:-mr-10 z-10"
                                                    @click="emailType = 'default'">default</span>
                                                <span
                                                    class="uppercase border border-gray-800 pl-5 md:pl-16 pr-5 py-2  rounded-full text-sm   bg-white flex items-center space-x-4"
                                                    @click="emailType = 'custom'">
                                                    <i class='bx bx-customize'></i>
                                                    <span>Customized</span>
                                                </span>
                                            </button>
                                            <button type="button" class="whitespace-nowrap flex flex-wrap"
                                                x-show="emailType == 'custom'" style="display: none">
                                                <span
                                                    class="uppercase  border  border-gray-800  bg-white  pr-5 md:pr-16 pl-5 py-2 rounded-full text-sm block "
                                                    @click="emailType = 'default'">default</span>
                                                <span
                                                    class="uppercase text-white border  border-blue-600 bg-blue-600 pl-16 px-5 py-2  rounded-full text-sm   md:-ml-10 z-10  flex items-center space-x-4"
                                                    @click="emailType = 'custom'">
                                                    <i class='bx bx-customize'></i>
                                                    <span>Customized</span>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mx-auto w-[80%]" x-show="emailType == 'default'" x-cloak>
                                        <p class="text-xl font-medium mb-3">Automate Email Template</p>
                                        <div class="px-3 py-5 bg-gray-100  ">
                                            <p class="text-xl font-semibold mb-3">Hi {{ $influencerName }},</p>
                                            <p>We’re thrilled to invite you to join an exclusive campaign
                                                that’s perfectly tailored to your unique influence and
                                                style. Here’s a quick overview of the campaign:</p>
                                            <ul class="py-5">
                                                <li>
                                                    <strong style="margin-right: 6px;">&#10003;</strong>
                                                    <strong>🌟 Campaign Name:</strong> {{ $campaignTitle }}
                                                </li>
                                                <li>
                                                    <strong style="margin-right: 6px;">&#10003;</strong>
                                                    <strong>💰 Compensation:</strong> {{ $compensation }}
                                                </li>
                                            </ul>

                                            <p class="mb-4">If you’re ready to showcase your talent and make an
                                                impact,
                                                simply click the link below to review and accept the
                                                campaign details:</p>

                                            <button class="text-white bg-blue-500 text-sm rounded-lg px-4 py-2">👉
                                                Accept
                                                the
                                                Campaign Now</button>

                                            <p class="my-4">We’re excited to work with you and can’t wait to see the
                                                amazing content you’ll create for this campaign. If you
                                                have any questions or need more details, don’t hesitate to reach out to
                                                us.
                                            </p>

                                            <p style="font-size: 16px; font-family: sans-serif;">Best regards,<br>
                                                <strong>{{ env('APP_NAME') }} Team</strong>
                                            </p>
                                        </div>

                                        <div class="flex justify-between space-x-3 items-center bg-white p-3  ">
                                            <div class="">
                                                @if (json_decode($emails, true) != null)
                                                    @if (count(json_decode($emails, true)) > 0)
                                                        <select
                                                            class="rounded-lg border-2 border-gray-200 py-2.5  text-sm font-semibold bg-gray-50"
                                                            wire:model="selectedEmail">
                                                            <option value="null" selected>Select email</option>
                                                            @foreach (json_decode($emails, true) ?? [] as $email)
                                                                <option value="{{ $email }}">
                                                                    {{ $email }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                @endif
                                            </div>
                                            <button wire:click="sendCampaignInvite()"
                                                class="bg-blue-600 rounded-lg text-white px-5 py-2 flex items-center space-x-2">
                                                <i class='bx bx-mail-send'></i>
                                                <span>Send mail</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mx-auto w-[90%]" x-show="emailType == 'custom'" x-cloak>
                                        <p class="text-xl font-medium mb-3">Customize Your Email Template</p>
                                        <div wire:ignore class=" bg-gray-100  ">
                                            <x-editor :id="$campaign->id" :customEmailBody="$customEmailBody" />
                                        </div>
                                        <div class="flex justify-between space-x-3 items-center bg-white p-3 ">
                                            <div class="">
                                                @if (json_decode($emails, true) != null)
                                                    @if (count(json_decode($emails, true)) > 0)
                                                        <select
                                                            class="rounded-lg border-2 border-gray-200   text-sm font-semibold bg-gray-50"
                                                            wire:model="selectedEmail">
                                                            <option value="null" selected>Select email</option>
                                                            @foreach (json_decode($emails, true) ?? [] as $email)
                                                                <option value="{{ $email }}">
                                                                    {{ $email }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                @endif
                                            </div>
                                            <button wire:click="sendCustomCampaignInvite()"
                                                class="bg-blue-600 rounded-lg text-white px-5 py-2 flex items-center space-x-2">
                                                <i class='bx bx-mail-send'></i>
                                                <span>Send mail</span>
                                            </button>
                                        </div>
                                    </div>



                                </div>
                            </li>
                        @endforeach

                    </ul>

                </div>
            </div>
        </div>


        <script>
            // document.addEventListener('DOMContentLoaded', function() {
            //     Livewire.on('refreshPage', () => {
            //         location.reload();
            //     });
            // });


            document.addEventListener('DOMContentLoaded', function() {
                Livewire.on('addToEditor', function(data) {
                    const content = data.content;
                    const campaignId = data.id;
                    var summernote = $('#summernote-' + campaignId);
                    summernote.summernote('code', content);
                });
            });
        </script>

    </div>
