    <div x-data="{ openModal: false, }" class="overflow-y-auto h-screen pb-28">
        <h3 class="capitalize font-bold text-3xl pb-10">{{$group->name}}</h3>
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
                                                    class="bg-white rounded-lg px-2 py-1 text-sm  focus:ring-2 focus:ring-gray-400 ">Check with AI</button>
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
                                <button @click="openModal = true"
                                    wire:click="setInfluencer('{{ $influencer->id }}', '{{ isset($influencer->emails) ? $influencer->emails : '' }}')">Send
                                    Campaign </button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        {{-- openModal modal --}}
        <div class="fixed items-center justify-center  flex top-0 left-0 mx-auto w-full h-full bg-gray-600 bg-opacity-30 z-50 transition duration-1000 ease-in-out"
            x-show="openModal" x-cloak>
            <div @click.away="openModal = false"
                class="bg-white w-[90%] md:w-[50%]  shadow-inner  border rounded-2xl overflow-auto  py-6 px-8 transition-all relative duration-700">
                <div class=" h-full ">
                    {{-- {{$selectedEmail}} --}}

                    <div class="flex justify-between items-center">
                        <h5 class="font-bold text-xl">All Campaign</h5>
                        <button @click="openModal = false"><i class="bx bx-x text-xl font-bold"></i></button>
                    </div>
                    {{-- <form action="{{ route('campaigns.store') }}" method="POST" class="my-10 ">
              
            </form> --}}

                    <ul class="my-4 space-y-3 h-[200px] overflow-y-auto">
                        @foreach ($campaigns as $campaign)
                            <li @click.away="openDrawer = false" class="border-2 rounded-lg" x-data="{ openDrawer: false }">
                                <div for="{{ $campaign->id }}" @click="openDrawer = true"
                                     wire:click="setCampaign('{{ $campaign->uuid }}')"
                                    class=" cursor-pointer flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 campaign hover:shadow ">
                                    <svg aria-hidden="true" class="h-4" viewBox="0 0 40 38" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M39.0728 0L21.9092 12.6999L25.1009 5.21543L39.0728 0Z"
                                            fill="#E17726" />
                                        <path d="M0.966797 0.0151367L14.9013 5.21656L17.932 12.7992L0.966797 0.0151367Z"
                                            fill="#E27625" />
                                        <path
                                            d="M32.1656 27.0093L39.7516 27.1537L37.1004 36.1603L27.8438 33.6116L32.1656 27.0093Z"
                                            fill="#E27625" />
                                        <path
                                            d="M7.83409 27.0093L12.1399 33.6116L2.89876 36.1604L0.263672 27.1537L7.83409 27.0093Z"
                                            fill="#E27625" />
                                        <path
                                            d="M17.5203 10.8677L17.8304 20.8807L8.55371 20.4587L11.1924 16.4778L11.2258 16.4394L17.5203 10.8677Z"
                                            fill="#E27625" />
                                        <path
                                            d="M22.3831 10.7559L28.7737 16.4397L28.8067 16.4778L31.4455 20.4586L22.1709 20.8806L22.3831 10.7559Z"
                                            fill="#E27625" />
                                        <path d="M12.4115 27.0381L17.4768 30.9848L11.5928 33.8257L12.4115 27.0381Z"
                                            fill="#E27625" />
                                        <path d="M27.5893 27.0376L28.391 33.8258L22.5234 30.9847L27.5893 27.0376Z"
                                            fill="#E27625" />
                                        <path
                                            d="M22.6523 30.6128L28.6066 33.4959L23.0679 36.1282L23.1255 34.3884L22.6523 30.6128Z"
                                            fill="#D5BFB2" />
                                        <path
                                            d="M17.3458 30.6143L16.8913 34.3601L16.9286 36.1263L11.377 33.4961L17.3458 30.6143Z"
                                            fill="#D5BFB2" />
                                        <path d="M15.6263 22.1875L17.1822 25.4575L11.8848 23.9057L15.6263 22.1875Z"
                                            fill="#233447" />
                                        <path d="M24.3739 22.1875L28.133 23.9053L22.8184 25.4567L24.3739 22.1875Z"
                                            fill="#233447" />
                                        <path d="M12.8169 27.0049L11.9606 34.0423L7.37109 27.1587L12.8169 27.0049Z"
                                            fill="#CC6228" />
                                        <path d="M27.1836 27.0049L32.6296 27.1587L28.0228 34.0425L27.1836 27.0049Z"
                                            fill="#CC6228" />
                                        <path
                                            d="M31.5799 20.0605L27.6165 24.0998L24.5608 22.7034L23.0978 25.779L22.1387 20.4901L31.5799 20.0605Z"
                                            fill="#CC6228" />
                                        <path
                                            d="M8.41797 20.0605L17.8608 20.4902L16.9017 25.779L15.4384 22.7038L12.3988 24.0999L8.41797 20.0605Z"
                                            fill="#CC6228" />
                                        <path d="M8.15039 19.2314L12.6345 23.7816L12.7899 28.2736L8.15039 19.2314Z"
                                            fill="#E27525" />
                                        <path d="M31.8538 19.2236L27.2061 28.2819L27.381 23.7819L31.8538 19.2236Z"
                                            fill="#E27525" />
                                        <path
                                            d="M17.6412 19.5088L17.8217 20.6447L18.2676 23.4745L17.9809 32.166L16.6254 25.1841L16.625 25.1119L17.6412 19.5088Z"
                                            fill="#E27525" />
                                        <path
                                            d="M22.3562 19.4932L23.3751 25.1119L23.3747 25.1841L22.0158 32.1835L21.962 30.4328L21.75 23.4231L22.3562 19.4932Z"
                                            fill="#E27525" />
                                        <path
                                            d="M27.7797 23.6011L27.628 27.5039L22.8977 31.1894L21.9414 30.5138L23.0133 24.9926L27.7797 23.6011Z"
                                            fill="#F5841F" />
                                        <path
                                            d="M12.2373 23.6011L16.9873 24.9926L18.0591 30.5137L17.1029 31.1893L12.3723 27.5035L12.2373 23.6011Z"
                                            fill="#F5841F" />
                                        <path
                                            d="M10.4717 32.6338L16.5236 35.5013L16.4979 34.2768L17.0043 33.8323H22.994L23.5187 34.2753L23.48 35.4989L29.4935 32.641L26.5673 35.0591L23.0289 37.4894H16.9558L13.4197 35.0492L10.4717 32.6338Z"
                                            fill="#C0AC9D" />
                                        <path
                                            d="M22.2191 30.231L23.0748 30.8354L23.5763 34.8361L22.8506 34.2234H17.1513L16.4395 34.8485L16.9244 30.8357L17.7804 30.231H22.2191Z"
                                            fill="#161616" />
                                        <path
                                            d="M37.9395 0.351562L39.9998 6.53242L38.7131 12.7819L39.6293 13.4887L38.3895 14.4346L39.3213 15.1542L38.0875 16.2779L38.8449 16.8264L36.8347 19.1742L28.5894 16.7735L28.5179 16.7352L22.5762 11.723L37.9395 0.351562Z"
                                            fill="#763E1A" />
                                        <path
                                            d="M2.06031 0.351562L17.4237 11.723L11.4819 16.7352L11.4105 16.7735L3.16512 19.1742L1.15488 16.8264L1.91176 16.2783L0.678517 15.1542L1.60852 14.4354L0.350209 13.4868L1.30098 12.7795L0 6.53265L2.06031 0.351562Z"
                                            fill="#763E1A" />
                                        <path
                                            d="M28.1861 16.2485L36.9226 18.7921L39.7609 27.5398L32.2728 27.5398L27.1133 27.6049L30.8655 20.2912L28.1861 16.2485Z"
                                            fill="#F5841F" />
                                        <path
                                            d="M11.8139 16.2485L9.13399 20.2912L12.8867 27.6049L7.72971 27.5398H0.254883L3.07728 18.7922L11.8139 16.2485Z"
                                            fill="#F5841F" />
                                        <path
                                            d="M25.5283 5.17383L23.0847 11.7736L22.5661 20.6894L22.3677 23.4839L22.352 30.6225H17.6471L17.6318 23.4973L17.4327 20.6869L16.9139 11.7736L14.4707 5.17383H25.5283Z"
                                            fill="#F5841F" />
                                    </svg>
                                    <span
                                        class="flex-1 ms-3 whitespace-nowrap capitalize">{{ $campaign->title }}</span>
                                </div>
                                <div class="h-40" x-show="openDrawer" x-cloak>
                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque voluptatum
                                        nam labore laboriosam vel corporis quisquam saepe, aspernatur quo eveniet,
                                        facilis expedita sint ut harum doloribus laborum omnis esse provident.</p>

                                    
                                   <div class="flex space-x-3 items-center">
                                    <div class="mt-2">
                                        @if (json_decode($emails, true) != null)
                                            @if (count(json_decode($emails, true)) > 0)
                                                <select class="rounded-lg border-2 border-gray-200   text-sm font-semibold bg-gray-50">
                                                    <option value="" selected disabled>Emails</option>
                                                    @foreach (json_decode($emails, true) ?? [] as $email)
                                                        <option value="{{ $email }}">{{ $email }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        @endif
                                    </div>
                                    <a href="{{ $invitationLink }}">Invitation Link</a>
                                   </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>

                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // window.addEventListener('refreshPage', function() {
                //     location.reload();
                // });
                Livewire.on('refreshPage', () => {
                    location.reload();
                });
            });
        </script>

    </div>
