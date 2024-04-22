<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Candidate') }}
        </h2>
    </x-slot>


    

    <div>
        <form method="POST" action="{{route('candidates.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') ?? $validatedData['name'] ?? '' }}" class="form-input rounded-md shadow-sm mt-1 block w-full" required autofocus>
            </div>


            <div class="mb-4">
                <label for="picture" class="block text-sm font-medium text-gray-700">Picture</label>
                <input type="file" name="picture" id="picture" class="form-input rounded-md shadow-sm mt-1 block w-full">
            </div>


            <div class="mb-4">
                <label for="positions_id" class="block text-sm font-medium text-gray-700">Position ID</label>
                <input type="text" name="positions_id" id="positions_id" value="{{ old('positions_id') ?? $validatedData['positions_id'] ?? '' }}" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
            </div>

            <x-input-error :messages="$errors->get('message')"  />
            <x-primary-button>{{ __('Register Candidates') }}</x-primary-button>
        </form>
    </div>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3>Candidates</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Picture</th>
                                <th>Position</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidates as $candidate)
                            <tr>
                                <td>{{ $candidate->name }}</td>
                                <td>
                                    @if($candidate->pictureUrl)
                                    <img src="{{ asset('storage/' . $candidate->pictureUrl) }}" alt="candidates pic" style="max-width: 100px;">
                                    @else
                                    No Picture
                                    @endif
                                </td>
                                <td>{{ $candidate->position?->name ?? 'No Position' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
