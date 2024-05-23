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
                        <label for="assign_by" class="block font-medium text-sm text-gray-700">Assign by: {{ $users->find($task->assign_by)->name ?? 'Unknown User' }}</label>
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="assign_to" class="block font-medium text-sm text-gray-700">Assign to: {{ $users->find($task->assign_to)->name ?? 'Unknown User' }}</label>
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="dead_line" class="block font-medium text-sm text-gray-700">Dead line: {{ $task->dead_line }}</label>
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="description" class="block font-medium text-sm text-gray-700">Description: {{ $task->description ?? old('description', '') }}</label>
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="status" class="block font-medium text-sm text-gray-700">Status: {{ $task->status }}</label>
                    </div>

                </form>
   
            </div>
        </div>
    </div>
</x-app-layout>
