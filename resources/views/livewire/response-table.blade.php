<div class="px-3 md:px-10 pb-20 overflow-y-auto h-screen">

    <div class="py-5 border-b flex flex-col md:flex-row justify-between items-center ">
        <div>
            <h3 class=" font-medium text-2xl">Response</h3>
        </div>

        <div class="flex flex-col md:items-center md:flex-row px-3 md:px-10   md:space-y-0 md:space-x-2  w-1/3 ">
            <select id="countries1" wire:model.live="status" class="form-control ">
                <option value="all">All</option>
                <option value="accepted">Accepted</option>
                <option value="declined">Declined</option>
            </select>

        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase ">
                <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 ">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 ">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">

                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($responses as $response)
                    @php
                        $influencer = \App\Models\Influencer::find($response->influencer_id);
                        $content = json_decode($influencer->content);
                        $emails = $influencer->emails;
                        $emailsList = implode(', ', json_decode($emails, true));
                    @endphp
                    <tr class="border-b border-gray-200 ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50  ">
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
                        </th>
                        <td class="px-6 py-4">
                            {{ $emailsList }}
                        </td>
                        <td class="px-6 py-4 bg-gray-50 ">
                            {{ $response->task_status }}
                        </td>
                        <td class="px-6 py-4" wire:ignore>

                            <button type="button" wire:click="deletResponse({{ $response->id }})"> <i
                                    class='bx bxs-trash text-xl text-red-500 hover:text-red-700'></i>
                            </button>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="bg-orange-100 text-orange-500 py-10 text-center rounded col-span-4" colspan="4">No
                            Data
                            Yet.</td>
                    </tr>
                @endforelse

            </tbody>
            {{ $responses->links() }}
        </table>
    </div>

</div>
