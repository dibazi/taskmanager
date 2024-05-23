<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Task details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <form method="post" action="{{ route('tasks.store') }}">
                    @csrf

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="assign_by" class="block font-medium text-sm text-gray-700">Assign to</label>
                        <input type="text" name="assign_by" id="assign_by" id="assign_by" value="{{ $users->find($task->assign_by)->name ?? 'Unknown User' }}" class="form-input rounded-md shadow-sm mt-1 block w-1/2"
                            value="{{ old('assign_by', '') }}" />
                        @error('assign_by')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="assign_to" class="block font-medium text-sm text-gray-700">Assign to</label>
                        <input type="text" name="assign_to" id="assign_to" id="assign_to" value="{{ $users->find($task->assign_to)->name ?? 'Unknown User' }}" class="form-input rounded-md shadow-sm mt-1 block w-1/2"
                            value="{{ old('assign_to', '') }}" />
                        @error('assign_by')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="dead_line" class="block font-medium text-sm text-gray-700">Dead line</label>
                        <input type="date" name="dead_line" id="dead_line" value="{{ $task->dead_line }}" class="form-input rounded-md shadow-sm mt-1 block w-1/2"
                            value="{{ old('dead_line', '') }}" />
                        @error('dead_line')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                        <textarea name="description" id="description" class="form-input rounded-md shadow-sm mt-1 block w-1/2">{{ $task->description ?? old('description', '') }}</textarea>
                        @error('description')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <input type="hidden" name="assign_to" id="assign_to" value="{{ Auth::user()->id }}" />
                    @error('assign_to')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </form>
   
            </div>
        </div>
    </div>
</x-app-layout>
