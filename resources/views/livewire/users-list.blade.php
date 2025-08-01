    <div class="w-1/3 my-10" wire:poll.visible>

        <div class="mx-auto mb-4">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Users list</h2>
        </div>

        @if (session('success'))
            <div class="p-4 mt-6 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert" x-data="{
                isShow: true,
            }"
                x-init="setTimeout(() => isShow = false, 1500)" x-show="isShow">
                {{ session('success') }}
            </div>
        @endif

        <form class="max-w-lg mx-auto" wire:submit="search">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input wire:model.live.debounce.250ms="query" type="search" id="default-search"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search User(s)..." required />
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>

        <ul role="list" class="divide-y divide-gray-100">
            @foreach ($this->users as $user)
                <li class="flex justify-between gap-x-6 py-5">
                    <div class="flex min-w-0 gap-x-4">
                        <img src="{{ $user->avatar ?? asset('img/default-avatar.jpeg') }}" alt=""
                            class="size-12 flex-none rounded-full object-cover bg-gray-50" />
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm/6 font-semibold text-gray-900">{{ $user->name }}</p>
                            <p class="mt-1 truncate text-xs/5 text-gray-500">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end self-center">
                        <p class="mt-1 text-xs/5 text-gray-500">Joined {{ $user->created_at->diffForHumans() }}
                        </p>
                        <div class="flex items-center text-xs/5 mt-1" x-data>
                            <a href="/users/{{ $user->id }}" class="text-xs/5 text-blue-500 inline-block mr-1">Edit
                            </a>|
                            </p>
                            <button
                                x-on:click.prevent="
                                    if(confirm('Yakin ingin menghapus data?')) {
                                        $wire.deleteUser({{ $user->id }});
                                    }"
                                class="text-xs/5 text-red-500 inline-block ml-1 cursor-pointer">Delete
                            </button>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        {{ $this->users->links() }}
    </div>
