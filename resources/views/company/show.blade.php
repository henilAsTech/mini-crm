<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Company Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <a href="{{ route('companies.index') }}" class="text-blue-500 hover:text-blue-700">Back to Companies List</a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Company Information</h3>
                            
                            <div class="mb-3">
                                <label class="block text-gray-600 text-sm font-bold mb-1">Name:</label>
                                <p class="text-gray-900">{{ $company->name }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="block text-gray-600 text-sm font-bold mb-1">Email:</label>
                                <p class="text-gray-900">{{ $company->email ?? '-' }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="block text-gray-600 text-sm font-bold mb-1">Website:</label>
                                <p class="text-gray-900">
                                    @if($company->website)
                                        <a href="{{ $company->website }}" target="_blank" class="text-blue-600 hover:underline">{{ $company->website }}</a>
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="text-gray-600 text-sm font-bold mb-1">Logo:</label>
                                @if($company->logo)
                                    <img src="{{ asset('storage/logos/' . $company->logo) }}" alt="Logo" class="h-16 w-16 rounded">
                                @else
                                    <p class="text-gray-900">No logo uploaded</p>
                                @endif
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-4">Employees ({{ $company->employees->count() }})</h3>
                            @if($company->employees->count() > 0)
                                <ul class="space-y-2">
                                    @foreach($company->employees as $employee)
                                        <li class="border-b pb-2">
                                            <a href="{{ route('employees.show', $employee) }}" class="text-blue-600 hover:underline">
                                                {{ $employee->fullname }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-500">No employees yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
