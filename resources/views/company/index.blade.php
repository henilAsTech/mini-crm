<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Company') }}
        </h2>
    </x-slot>

    <div class="py-6 w-full">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('companies.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase">
                            {{ __('Add New Company') }}
                        </a>
                    </div>
                    @if (session()->has('success'))
                        <div id="successMessage" class="alert alert-success mb-4 bg-green-100 text-white px-4 py-3 rounded border border-green-600" style="background-color: green;">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div id="errorMessage" class="alert alert-danger mb-4 bg-red-100 text-white border border-red-400 text-red-700 px-4 py-3 rounded" style="background-color: red">
                            {{ session()->get('error') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 border">ID</th>
                                    <th class="px-4 py-2 border">Name</th>
                                    <th class="px-4 py-2 border">Email</th>
                                    <th class="px-4 py-2 border">Website</th>
                                    <th class="px-4">Logo</th>
                                    <th class="px-4 py-2 border">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($companies as $key => $company)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border">{{ $companies->firstItem() + $key }}</td>
                                        <td class="px-4 py-2 border">{{ $company->name }}</td>
                                        <td class="px-4 py-2 border sm:table-cell">
                                            {{ $company->email ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2 border">
                                            @if ($company->website)
                                                <a href="{{ $company->website }}" target="_blank" class="text-blue-600 hover:underline" rel="noopener noreferrer">{{ $company->website }}</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 border">
                                            <img src="{{ asset('storage/logos/' . $company->logo ?? 'logo.png') }}" alt="logo" class="mb-2 mt-1 w-20 h-20 object-cover rounded-full"/>
                                        </td>
                                        <td class="px-4 py-2 border">
                                            <form action="{{ route('companies.destroy', $company->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('companies.edit', $company->id) }}" class="text-blue-600 hover:underline">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="{{ route('companies.show', $company->id) }}" class="text-blue-600 hover:underline">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <button type="submit" class="text-red-600 hover:underline ms-4" onclick="return confirm('Are you sure you want to delete this company?')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-2 border text-center">
                                            No companies found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6 flex justify-center">
                        {{ $companies->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
            const message = document.getElementById('successMessage') || document.getElementById('errorMessage');
            if (message) {
                message.style.transition = 'opacity 0.5s ease';
                message.style.opacity = '0';
                
                message.hide();
            }
        }, 3000); 
    </script>
</x-app-layout>
