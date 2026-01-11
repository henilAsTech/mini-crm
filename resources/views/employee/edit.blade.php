<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Update Employee') }}
                            </h2>
                        </header>

                        <form method="post" action="{{ route('employees.update', $employee->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div>
                                <div class="flex items-center gap-1">
                                    <x-input-label for="first_name" :value="__('First Name')" />
                                    <span class="text-danger">*</span>
                                </div>

                                <x-text-input id="firstName" name="first_name" type="text" class="mt-1 block w-full" autocomplete="name" :value="old('first_name', $employee->first_name)"/>
                                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                            </div>

                            <div>
                                <div class="flex items-center gap-1">
                                    <x-input-label for="last_name" :value="__('Last Name')" />
                                    <span class="text-danger">*</span>
                                </div>

                                <x-text-input id="lastName" name="last_name" type="text" class="mt-1 block w-full" autocomplete="name" :value="old('last_name', $employee->last_name)"/>
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                            </div>

                            <div>
                                <div class="flex items-center gap-1">
                                    <x-input-label for="company_id" :value="__('Company')" />
                                    <span class="text-danger">*</span>
                                </div>
                                <select id="company_id" name="company_id" class="mt-1 block w-full">
                                    <option value="">Select a company</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ old('company_id', $company->id) }}" {{ $employee->company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('company_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" autocomplete="email" :value="old('email', $employee->email)"/>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="phone" :value="__('Phone')" />
                                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" autocomplete="phone" :value="old('phone', $employee->phone)"/>
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="profile_picture" :value="__('Profile Picture')" />
                                <img src="{{ asset('storage/profile_pictures/' . $employee->profile_picture) }}" alt="logo" class="mb-2 mt-1 w-20 h-20 object-cover rounded-full"/>

                                <input
                                    id="profilePicture"
                                    name="profile_picture"
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
                                    Allowed Format: PNG, JPEG
                                </p>

                                <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
                            </div>


                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                                <a href="{{ route('employees.index') }}"
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
