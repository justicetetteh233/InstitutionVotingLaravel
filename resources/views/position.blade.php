<x-app-layout>
    <div>
        <form method="POST" action="{{route('positions.store')}}">
            @csrf
            <label for="name">Name:</label>
            <input type="text" id="name" name="name"><br>
            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea><br><br>
            <x-input-error :messages="$errors->get('message')"  />
            <x-primary-button>{{ __('Approve Position') }}</x-primary-button>
        </form>
    </div>


    <div>
        @foreach ($positions as $position)
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <div>
                    <div>
                        <span class="text-gray-800">{{ $position->user->name }}</span>
                        <small class="ml-2 text-sm text-gray-600">{{ $position->created_at->format('j M Y, g:i a') }}</small>
                        <p class="mt-4 text-lg text-gray-900">{{ $position->name }}</p>
                        <small class="ml-2 text-sm text-gray-600">{{ $position->description }}</small>

                        @unless ($position->created_at->eq($position->updated_at))
                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                        @endunless

                        <div>
                        @if ($position->user->is(auth()->user()))
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('positions.edit', $position)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>

                                        <form method="POST" action="{{ route('positions.destroy', $position) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('positions.index', $position)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                        @endif

                        </div>

                    </div>
                </div>
            </div>
            
        @endforeach
    </div>
</x-app-layout>



