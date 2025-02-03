<div class="h-full overflow-y-auto" x-data="{ tiktok_influencer_dettail: null, modalIsOpen: false }">
    {{-- Stop trying to control. --}}

    <div class="my-6" id="some-element">
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-lg">
            <h2 class="text-stone-700 text-xl font-bold">Apply filters</h2>
            <p class="mt-1 text-sm">Use filters to further refine search</p>
            <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <div class="flex flex-col">
                    <label for="name" class="text-stone-600 text-sm font-medium">Name</label>
                    <!-- Dropdown select for predefined ranges -->
                    <select wire:model="followersRange" wire:change="getFiltersByRange()"
                        class="mt-2 block w-full rounded-md border border-gray-200 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="0-10000">Less than 10k</option>
                        <option value="10000-50000">10k - 50k</option>
                        <option value="50000-500000">50k - 500k</option>
                        <option value="500000-1000000">500k - 1M</option>
                        <option value="1000000+">1M+</option>
                    </select>
                </div>


                <div class="flex flex-col">
                    <label for="minRange" class="text-stone-600 text-sm font-medium">Min Followers:</label>

                    <input type="number" id="minRange" wire:model="minRange" placeholder="Min followers"
                        min="0"
                        class="mt-2 block w-full rounded-md border border-gray-200 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>

                <div class="flex flex-col">
                    <label for="maxRange" class="text-stone-600 text-sm font-medium">Max Followers:</label>
                    <input type="number" id="maxRange" wire:model="maxRange" placeholder="Max followers"
                        min="0"
                        class="mt-2 block w-full rounded-md border border-gray-200 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex flex-col">
                    <label for="name" class="text-stone-600 text-sm font-medium">Country</label>
                    <select wire:model.live="country"
                        class="mt-2 block w-full rounded-md border border-gray-200 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="USA">United States</option>
                        <option value="Canada">Canada</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Brazil">Brazil</option>
                        <option value="Argentina">Argentina</option>
                        <option value="UK">United Kingdom</option>
                        <option value="France">France</option>
                        <option value="Germany">Germany</option>
                        <option value="Italy">Italy</option>
                        <option value="Spain">Spain</option>
                        <option value="China">China</option>
                        <option value="Japan">Japan</option>
                        <option value="India">India</option>
                        <option value="Australia">Australia</option>
                        <option value="South_Africa">South Africa</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Egypt">Egypt</option>
                        <option value="Russia">Russia</option>
                        <option value="South_Korea">South Korea</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Vietnam">Vietnam</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="isVerified" class="mt-2  w-full rounded-md border border-gray-200 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 flex items-center space-x-2">
                        <input type="checkbox" wire:model="isVerified" name="isVerified" id="isVerified" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500  focus:ring-2 "> <span class="font-bold">isVerified</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 grid w-full grid-cols-2 justify-end space-x-4 md:flex">
                <button wire:click="resetData()"
                    class="active:scale-95 rounded-lg bg-gray-200 px-8 py-2 font-medium text-gray-600 outline-none focus:ring hover:opacity-90">Reset</button>
                <button wire:click="getInfluencer()"
                    class="active:scale-95 rounded-lg bg-blue-600 px-8 py-2 font-medium text-white outline-none focus:ring hover:opacity-90">Search</button>
            </div>
        </div>
    </div>



    <div class="grid sm:grid-cols-3 gap-2">
        <!-- component -->
        @forelse ($details as $detail)
            <div class="relative bg-white p-3 rounded-lg shadow-md max-w-md w-full group">
                <ul
                    class="absolute top-0 right-0 z-10  divide-y bg-gray-50 shadow-sm  hidden group-hover:flex transition-all duration-300 ease-in-out">
                    <li class="p-2 hover:bg-gray-200 hover:shadow-md " title="Open profile in a new tab ">
                        <a href="" target="_blank" class="hover:text-blue-500 hover:underline ">
                            <i class="bx bx-link-external text-md"></i>
                        </a>
                    </li>
                    <li class="p-2 hover:bg-gray-200 hover:shadow-md " title="Add to store">
                        <button type="button" data-modal-target="crypto-modal" data-modal-toggle="crypto-modal"
                            @click="modalIsOpen = true ; tiktok_influencer_dettail = @js($detail['data']['basicTikTok'])"
                            wire:click="setInfluencer({{ json_encode($detail['data']['basicTikTok']) }})">
                            <i class='bx bx-plus'></i>
                        </button>



                    </li>
                </ul>
                <!-- Banner Profile -->
                <div class="relative">
                    <img src="{{ $detail['data']['basicTikTok']['avatar'] }}" alt="Banner Profile"
                        class="w-full rounded-t-lg h-32"
                        onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1735490246994-ea609f82f249?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwyfHx8ZW58MHx8fHx8';">
                    <img src="{{ $detail['data']['basicTikTok']['avatar'] }}" alt="Profile Picture"
                        class="absolute bottom-0 left-2/4 transform -translate-x-1/2 translate-y-1/2 w-24 h-24 rounded-full border-4 border-white"
                        onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1735490246994-ea609f82f249?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwyfHx8ZW58MHx8fHx8';">
                </div>
                <!-- User Info with Verified Button -->
                <div class="flex items-center mt-4">
                    <h2 class="text-xl font-bold text-gray-800 capitalize">
                        {{ $detail['data']['basicTikTok']['tiktokName'] }}
                    </h2>
                    @if ($detail['data']['basicTikTok']['isVerified'])
                        <button class=" px-2 py-1 rounded-full">
                            <svg fill="#4d9aff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px"
                                viewBox="0 0 536.541 536.541" xml:space="preserve" stroke="#4d9aff">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <g>
                                            <path
                                                d="M496.785,152.779c-3.305-25.085-16.549-51.934-38.826-74.205c-22.264-22.265-49.107-35.508-74.186-38.813 c-11.348-1.499-26.5-7.766-35.582-14.737C328.111,9.626,299.764,0,268.27,0s-59.841,9.626-79.921,25.024 c-9.082,6.965-24.235,13.238-35.582,14.737c-25.08,3.305-51.922,16.549-74.187,38.813c-22.277,22.271-35.521,49.119-38.825,74.205 c-1.493,11.347-7.766,26.494-14.731,35.57C9.621,208.422,0,236.776,0,268.27s9.621,59.847,25.024,79.921 c6.971,9.082,13.238,24.223,14.731,35.568c3.305,25.086,16.548,51.936,38.825,74.205c22.265,22.266,49.107,35.51,74.187,38.814 c11.347,1.498,26.5,7.771,35.582,14.736c20.073,15.398,48.421,25.025,79.921,25.025s59.841-9.627,79.921-25.025 c9.082-6.965,24.234-13.238,35.582-14.736c25.078-3.305,51.922-16.549,74.186-38.814c22.277-22.27,35.521-49.119,38.826-74.205 c1.492-11.346,7.766-26.492,14.73-35.568c15.404-20.074,25.025-48.422,25.025-79.921c0-31.494-9.621-59.848-25.025-79.921 C504.545,179.273,498.277,164.126,496.785,152.779z M439.256,180.43L246.477,373.209l-30.845,30.846 c-8.519,8.52-22.326,8.52-30.845,0l-30.845-30.846l-56.665-56.658c-8.519-8.52-8.519-22.326,0-30.846l30.845-30.844 c8.519-8.519,22.326-8.519,30.845,0l41.237,41.236L377.561,118.74c8.52-8.519,22.326-8.519,30.846,0l30.844,30.845 C447.775,158.104,447.775,171.917,439.256,180.43z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </button>
                    @endif

                </div>
                <div>
                    @if ($detail['data']['basicTikTok']['isPrivateAccount'])
                        <span class="text-xs font-bold rounded-xl bg-gray-200 px-2 py-1">
                            private
                        </span>
                    @else
                        <span class="text-xs font-bold rounded-xl bg-gray-200 px-2 py-1">
                            Public
                        </span>
                    @endif
                </div>
                <!-- Bio -->
                <p class="text-gray-700 mt-2">
                    {{ flatten_array($detail['data']['basicTikTok']['hashtags'], ' | ', 3) }} </p>
                <!-- Social Links -->
                <div class="flex items-center mt-4 space-x-4">
                    <a href="https://tiktok.com/{{ '@' . $detail['data']['basicTikTok']['tiktokId'] }}"
                        target="_blank" class="text-blue-500 hover:underline">
                        Tiktok
                        <i class="bx bx-link-external text-md"></i>
                    </a>
                </div>
                <!-- Separator Line -->
                <hr class="my-4 border-t border-gray-300">
                <!-- Stats -->
                <div class="flex justify-between text-gray-600 mx-2">
                    <div class="text-center">
                        <span
                            class="block font-bold text-lg">{{ format_number($detail['data']['basicTikTok']['followers']) }}</span>
                        <span class="text-xs">Followers</span>
                    </div>
                    <div class="text-center">
                        <span
                            class="block font-bold text-lg">{{ format_number($detail['data']['basicTikTok']['following']) }}</span>
                        <span class="text-xs">Following</span>
                    </div>
                    <div class="text-center">
                        <span
                            class="block font-bold text-lg">{{ format_number($detail['data']['basicTikTok']['videos']) }}</span>
                        <span class="text-xs">videos</span>
                    </div>
                    <div class="text-center">
                        <span
                            class="block font-bold text-lg">{{ format_number($detail['data']['basicTikTok']['hearts']) }}</span>
                        <span class="text-xs">hearts</span>
                    </div>
                </div>
            </div>
        @empty
        @endforelse


    </div>
    @if (count($details) > 0)
        <div class="py-20 mb-10 col-span-3 flex justify-center">
            <button wire:click="$dispatch('refreshPage')">Load More</button>
        </div>
    @endif









    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
        @keydown.esc.window="modalIsOpen = false" @click.self="modalIsOpen = false"
        class="fixed inset-0 z-40 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
        role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
            x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-md border border-neutral-300 bg-white text-neutral-600 ">
            <!-- Dialog Header -->
            <div class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4 ">
                <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-neutral-900 ">Add To Group
                    <span x-text="tiktok_influencer_dettail?.tiktokId"></span>
                </h3>
                <button @click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                        stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="px-4 py-8">
                <div class="relative bg-white rounded-lg shadow ">
                    <!-- Modal body -->
                    <div class="" x-data="{ tab: 'group_tab' }">
                        <p class="text-sm font-normal text-gray-500 ">Connect with one of
                            our available
                            wallet providers or create a new one.</p>
                        <ul class="my-4 space-y-3 h-[200px] overflow-y-auto" x-show="tab == 'group_tab'" x-cloak>
                            @foreach ($groups as $group)
                                <li>
                                    <label for="{{ $group->id }}"
                                        class=" cursor-pointer flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow ">
                                        <svg aria-hidden="true" class="h-4" viewBox="0 0 40 38" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M39.0728 0L21.9092 12.6999L25.1009 5.21543L39.0728 0Z"
                                                fill="#E17726" />
                                            <path
                                                d="M0.966797 0.0151367L14.9013 5.21656L17.932 12.7992L0.966797 0.0151367Z"
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
                                            class="flex-1 ms-3 whitespace-nowrap capitalize">{{ $group->name }}</span>
                                        <input id="{{ $group->id }}" wire:key="{{ $group->id }}"
                                            wire:model.live="selectedGroups" value="{{ $group->id }}"
                                            class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded "
                                            type="checkbox" />
                                    </label>
                                </li>
                            @endforeach

                        </ul>
                        <div>
                            <button x-show="tab == 'group_tab'" x-cloak type="button" @click="tab = 'add_group'"
                                class="inline-flex items-center text-xs font-bold text-gray-700 hover:underline"><i
                                    class="bx bx-plus"></i> Create New Group</button>
                            <button x-show="tab == 'add_group'" x-cloak type="button" @click="tab = 'group_tab'"
                                class="inline-flex items-center text-xs font-bold text-gray-700 hover:underline"><i
                                    class='bx bx-chevron-left'></i> Back</button>
                        </div>

                        <div x-show="tab == 'add_group'" x-cloak>
                            <div class="">
                                <form class="space-y-4" wire:submit="creatGroup()" method="post">
                                    <div>
                                        <label for="name"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Name *</label>
                                        <input type="text" name="name" id="name" wire:model.live="name"
                                            class="form-control" placeholder="Enter Group name" required />
                                    </div>
                                    <div>
                                        <label for="description"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Description</label>
                                        <textarea name="description" id="description" wire:model.live="description" class="form-control"></textarea>
                                    </div>
                                    <button type="submit" @click="tab = 'group_tab'" wire:loading.attr="disabled"
                                        wire:target="creatGroup"
                                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Create
                                        Group</button>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Dialog Footer -->
            <div
                class="flex flex-col-reverse justify-between gap-2 border-t border-neutral-300 bg-neutral-50/60 p-4  sm:flex-row sm:items-center md:justify-end">
                <button @click="modalIsOpen = false" type="button"
                    class="cursor-pointer whitespace-nowrap rounded-md px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-600 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0">Cancle</button>

                <button @click="modalIsOpen = false" type="button" @if (empty($selectedGroups)) disabled @endif
                    wire:click="addToGrop()"
                    class="cursor-pointer whitespace-nowrap rounded-md {{ empty($selectedGroups) ? 'bg-gray-400' : 'bg-black' }} bg-black px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 ">Upgrade
                    Now</button>

            </div>
        </div>
    </div>


    <div class="border-t border-gray-200 px-4 py-5 sm:p-0 w-full" wire:loading wire:target="getInfluencer">
        <div class="flex flex-col items-center justify-center bg-white fixed top-0 left-0 w-full h-screen z-50">
            <div class='flex space-x-2 justify-center items-center'>
                <span class='sr-only'>Loading...</span>
                <div class='h-8 w-8 bg-gray-900 rounded-full animate-bounce [animation-delay:-0.3s]'></div>
                <div class='h-8 w-8 bg-gray-700 rounded-full animate-bounce [animation-delay:-0.15s]'>
                </div>
                <div class='h-8 w-8 bg-gray-600 rounded-full animate-bounce'></div>
            </div>
            <div>Loading....</div>
        </div>
    </div>

</div>
