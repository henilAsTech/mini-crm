<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Company') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Update Company') }}
                            </h2>
                        </header>

                        <form method="post" action="{{ route('companies.update', $company->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div>
                                <div class="flex items-center gap-1">
                                    <x-input-label for="name" :value="__('Name')" />
                                    <span class="text-danger">*</span>
                                </div>

                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autocomplete="name" value="{{ old('name', $company->name) }}" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" autocomplete="email" value="{{ old('email', $company->email) }}" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="website" :value="__('Website')" />
                                <x-text-input id="website" name="website" type="text" class="mt-1 block w-full" autocomplete="website" value="{{ old('website', $company->website) }}" />
                                <x-input-error :messages="$errors->get('website')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="logo" :value="__('Logo')" />
                                @if ($company->logo)
                                    <img src="{{ asset('storage/logos/' . $company->logo) }}" alt="logo" class="mb-2 mt-1 w-20 h-20 object-cover rounded-full"/>
                                @else
                                    <img src="{{ asset('logo.png') }}" alt="default logo" class="mb-2 mt-1 w-20 h-20 object-cover rounded-full"/>
                                @endif
                                <input
                                    id="logo"
                                    name="logo"
                                    type="file"
                                    accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-700
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-gray-100 file:text-gray-700
                                        hover:file:bg-gray-200"
                                />

                                <p class="mt-1 text-sm text-gray-500">
                                    Minimum dimensions: 100 × 100 pixels
                                </p>

                                <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                            </div>


                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                                <a href="{{ route('companies.index') }}"
                                    class="inline-block px-4 py-2 bg-gray-200 text-gray-800 rounded">
                                    Back
                                </a>
                            </div>
                        </form>
                    </section>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
