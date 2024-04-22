<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('voters.update' , $voter) }}">
            @csrf
            @method('patch')

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder={{$voter->name}}><br>
            <label for="password">password:</label>
            <input type="text" id="password" name="password" placeholder={{$voter->password}}><br>
            <label for="email">email:</label>
            <input type="text" id="email" name="email" placeholder={{$voter->email}}><br>

            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('voters.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>