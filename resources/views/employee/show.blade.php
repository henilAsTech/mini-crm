<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <a href="{{ route('employees.index') }}" class="text-blue-500 hover:text-blue-700"> Back to Employees List</a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Personal Information</h3>
                            @if($employee->profile_picture)
                                <div class="mb-4">
                                    <img src="{{ asset('storage/profile_pictures/' . $employee->profile_picture) }}" alt="Profile" class="h-24 w-24 rounded-full">
                                </div>
                            @endif

                            <div class="mb-3">
                                <label class="block text-gray-600 text-sm font-bold mb-1">Full Name:</label>
                                <p class="text-gray-900">{{ $employee->fullname }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="block text-gray-600 text-sm font-bold mb-1">Email:</label>
                                <p class="text-gray-900">{{ $employee->email ?? '-' }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="block text-gray-600 text-sm font-bold mb-1">Phone:</label>
                                <p class="text-gray-900">{{ $employee->phone ?? '-' }}</p>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-4">Company Information</h3>
                            
                            <div class="mb-3">
                                <label class="block text-gray-600 text-sm font-bold mb-1">Company:</label>
                                <p class="text-gray-900">
                                    <a href="{{ route('companies.show', $employee->company) }}" class="text-blue-600 hover:underline">
                                        {{ $employee->company->name }}
                                    </a>
                                </p>
                            </div>

                            @if($employee->company->logo)
                                <div class="mb-3">
                                    <label class="block text-gray-600 text-sm font-bold mb-1">Company Logo:</label>
                                    <img src="{{ asset('storage/logos/' . $employee->company->logo) }}" alt="Company Logo" class="h-16 w-16 rounded">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>