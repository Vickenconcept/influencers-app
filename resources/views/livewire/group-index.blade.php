<div class="overflow-y-auto h-screen pb-28">
    <div >
        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:justify-between my-10">

            <div class="">
                <select wire:model.live="sortOrder"
                class="form-control md:!w-[110px] grow">
                <option value="latest">Latest</option>
                <option value="oldest">Oldest</option>
            </select>

            </div>
            <div class="flex items-center space-x-3">
               <div>
                <input type="text" wire:model.live="search" id="name"
                class="form-control md:!w-[310px] grow"
                placeholder="Enter Group name" required />
               </div>
                <div>
                    <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                class="btn !whitespace-nowrap"
                type="button">
                <i class="bx bx-plus text-md"></i>Create Group
            </button>
                </div>
            </div>
           

            <!-- Main modal -->
            <div id="authentication-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow ">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                            <h3 class="text-xl font-semibold text-gray-900 ">
                                Create Group
                            </h3>
                            <button type="button"
                                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="authentication-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <form class="space-y-4" action="{{ route('groups.store') }}" method="post">
                                @csrf
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Name
                                        *</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control "
                                        placeholder="Enter Group name" required />
                                </div>
                                <div>
                                    <label for="description"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">Description</label>
                                    <textarea name="description" id="description"
                                        class="form-control"></textarea>
                                </div>

                                <button type="submit"
                                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Create
                                    Group</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <ul class="w-full  divide-gray-200  grid sm:grid-cols-3 gap-5">
            @foreach ($groups as $group)
                <div class="p-4 bg-gray-50  rounded-2xl shadow-sm space-y-14 border-2 hover:!border-blue-400 ">
                    <div class="flex justify-between">
                        <span
                            class="  rounded-full">
                            {{-- {{ $group->image }} --}}
                            @if ($group->latestInfluencer)
                                @php
                                    $content = json_decode($group->latestInfluencer->content);
                                @endphp
                                <img src="{{ $content->avatar?: asset('images/logo.png') }}" alt="" class="rounded-full size-8">
                            @endif
                        </span>

                        <div class="space-y-4">
                                <a  href="{{ route('groups.show', ['group' => $group->id]) }}"
                                    class="bg-gray-200 hover:bg-blue-500 group  px-3 py-2 rounded-md text-sm flex items-center delay-100 transition-all duration-500 ease-in-out">
                                    <i
                                        class="bx bx-show font-medium group-hover:text-white mr-1 text-lg delay-100 transition-all duration-500 ease-in-out"></i>
                                    <span
                                        class="group-hover:text-white delay-100 transition-all duration-500 ease-in-out">Preview</span>
                                </a>

                        </div>
                    </div>
                    <div class="flex justify-between mt-10">
                        <div>
                            <p class="font-medium text-md capitalize">
                                {{ $group->name }}
                            </p>
                            <p class="text-sm text-gray-500 capitalize">
                                {{ $group->description }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="md:col-span-3">
                {{ $groups->links() }}
            </div>
        </ul>
    </div>
</div>
