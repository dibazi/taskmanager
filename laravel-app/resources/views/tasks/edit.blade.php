<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Task details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="assign_by" class="block font-medium text-sm text-gray-700">Assign by: {{ $users->find($task->assign_by)->name ?? 'Unknown User' }}</label>

                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="assign_to" class="block font-medium text-sm text-gray-700">Assign to</label>
                            <select name="assign_to" id="assign_to" class="form-select rounded-md shadow-sm mt-1 block w-1/2">
                                
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('assign_to') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('assign_to')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="dead_line" class="block font-medium text-sm text-gray-700">Dead line</label>
                        <input type="date" name="dead_line" id="dead_line" value="{{ $task->dead_line }}" class="form-input rounded-md shadow-sm mt-1 block w-1/2" />
                        @error('dead_line')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                        <textarea name="description" id="description" class="form-input rounded-md shadow-sm mt-1 block w-1/2">{{ $task->description ?? old('description') }}</textarea>
                        @error('description')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                        <select name="status" id="status" class="form-select rounded-md shadow-sm mt-1 block w-1/2">
                            <option value="incomplete" {{ old('status') == 'incomplete' ? 'selected' : '' }}>Incomplete</option>
                            <option value="complete" {{ old('status') == 'complete' ? 'selected' : '' }}>Complete</option>
                        </select>
                        @error('status')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <input type="hidden" name="assign_by" id="assign_by" value="{{ Auth::user()->id }}" />
                        @error('assign_by')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror

                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Update
                        </button>
                    </div>
                </form>
   
            </div>
        </div>
    </div>
</x-app-layout>
