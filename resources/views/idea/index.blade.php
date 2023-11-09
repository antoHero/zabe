<x-app-layout>
    <div class="filters flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-6">
        <div class="w-full md:w-1/3">
            <select name="category" id="category" class="w-full rounded-xl border-none px-4 py-2">
                <option value="All Categories">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full md:w-1/3">
            <select name="other_filters" id="other_filters" class="w-full rounded-xl border-none px-4 py-2">
                <option value="No Filter">No Filter</option>
                <option value="Top Voted">Top Voted</option>
                <option value="My Ideas">My Ideas</option>
            </select>
        </div>
        <div class="w-full md:w-2/3 relative">
            <input type="search" placeholder="Find an idea" class="w-full rounded-xl bg-white border-none placeholder-gray-900 px-4 py-2 pl-8">
            <div class="absolute top-0 flex itmes-center h-full ml-2">
                <svg class="w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div>
    <div class="ideas-container space-y-6 my-8">
        @foreach ($ideas as $idea)
            <div
                x-data
                @click="
                    const clickedItem = $event.target
                    const target = clickedItem.tagName.toLowerCase();
                    const ignoreTags = ['button', 'svg', 'path', 'a'];
                    if(!ignoreTags.includes(target)) {
                        clickedItem.closest('.idea-container').querySelector('.idea-link').click();
                    }
                "
                class="idea-container hover:shadow-ideaCard transition duration-150 ease-in bg-white rounded-xl flex cursor-pointer"
            >
                <div class="hidden md:block border-r border-gray-100 px-5 py-8">
                    <div class="text-center">
                        <div class="font-semibold text-2xl">12</div>
                        <div class="text-gray-500">votes</div>
                    </div>
                    <div class="mt-8">
                        <button class="w-20 bg-gray-200 font-bold text-xxs uppercase rounded-xl px-4 py-3 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in">
                            vote
                        </button>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row flex-1 px-2 py-6">
                    <div class="flex-none mx-2 md:mx-0">
                        <a href="#">
                            <img src="{{ $idea->user->getAvatar()  }}" alt="avatar" class="w-14 h-14 rounded-xl">
                        </a>
                    </div>
                    <div class="flex flex-col justify-between mx-2 md:mx-4 w-full">
                        <h4 class="text-xl font-semibold mt-2 md:mt-0">
                            <a href="{{ route('idea.show', $idea->slug ) }}" class="idea-link hover:underline">{{ $idea->title }}</a>
                        </h4>
                        <div class="text-gray-600 mt-4 line-clamp-3">
                            {{ $idea->description }}
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <div class="flex flex-col md:flex-row md:items-center text-xs font-semibold space-x-2 text-gray-400">
                                <div>{{ $idea->created_at->diffForHumans() }}</div>
                                <div>&bull;</div>
                                <div>{{ $idea->category->name }}</div>
                                <div>&bull;</div>
                                <div class="text-gray-900">Comments (3)</div>
                            </div>
                            <div
                                x-data="{ isOpen: false }"
                                class="flex items-center space-x-2 mt-4 md:mt-0"
                            >
                                <div class="bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">
                                    open
                                </div>
                                <button
                                    @click="isOpen = !isOpen"
                                    class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in px-3 py-2 flex items-center justify-center"
                                >
                                    <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)"></svg>
                                    <ul
                                        x-cloak
                                        x-show.transition.origin.top.left.duration.500ms="isOpen"
                                        @click.away="isOpen = false"
                                        @keydown.escape.window="isOpen = false"
                                        class="absolute w-[11rem] text-left ml-56 mt-12 font-semibold bg-white shadow-dialogCard shadow-lg rounded-xl py-3"
                                    >
                                        <li><a href="#" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Mark as spam</a></li>
                                        <li><a href="#" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Delete post</a></li>
                                    </ul>
                                </button>
                            </div>
                            <div class="flex items-center md:hidden mt-4 md:mt-0">
                                <div class="bg-gray-100 text-center rounded-xl h-10 px-4 py-2 pr-8">
                                    <div class="text-sm font-bold leading-none">12</div>
                                    <div class="text-xxs font-semibold leading-none text-gray-400">Votes</div>
                                </div>
                                <button
                                    class="w-20 bg-gray-200 border border-gray-200 font-bold text-xxs uppercase rounded-xl hover:border-gray-400 transition duration-150 ease-in px-4 py-3 -mx-5"
                                >
                                    Vote
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="my-8">
        {{ $ideas->links() }}
    </div>
</x-app-layout>
