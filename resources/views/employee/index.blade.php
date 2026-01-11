<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee') }}
        </h2>
    </x-slot>

    <div class="py-6 w-full">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('employees.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase">
                            {{ __('Add New Employee') }}
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 border">ID</th>
                                    <th class="px-4 py-2 border">First Name</th>
                                    <th class="px-4 py-2 border">Last Name</th>
                                    <th class="px-4 py-2 border">Company Name</th>
                                    <th class="px-4 py-2 border sm:table-cell">Email</th>
                                    <th class="px-4 py-2 border">Phone</th>
                                    <th class="px-4">Profile Picture</th>
                                    <th class="px-4 py-2 border">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($employees as $key => $employee)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border">{{ $employees->firstItem() + $key }}</td>
                                        <td class="px-4 py-2 border">{{ $employee->first_name ?? '-' }}</td>
                                        <td class="px-4 py-2 border">{{ $employee->last_name ?? '-' }}</td>
                                        <td class="px-4 py-2 border">{{ $employee->company->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 border sm:table-cell">
                                            {{ $employee->email ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2 border">
                                            {{ $employee->phone ?? '-' }}    
                                        </td>
                                        <td class="px-4 py-2 border">
                                            <img src="{{ asset('storage/profile_pictures/' . $employee->profile_picture ?? 'logo.png') }}" alt="profile" class="mb-2 mt-1 w-20 h-20 object-cover rounded-full"/>
                                        </td>
                                        <td class="px-4 py-2 border">
                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('employees.edit', $employee->id) }}" class="text-blue-600 hover:underline">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="{{ route('employees.show', $employee->id) }}" class="text-blue-600 hover:underline">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <button type="submit" class="text-red-600 hover:underline ms-4" onclick="return confirm('Are you sure you want to delete this employee?')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-4 py-2 border text-center">
                                            No employees found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6 flex justify-center">
                        {{ $employees->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
