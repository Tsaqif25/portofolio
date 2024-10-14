<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tool') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg"> 
                <form method="POST" action="{{ route('admin.tools.update', $tool->id) }}" enctype="multipart/form-data"> 
                    @csrf
                    @method('PUT')
                    
                    <!-- Name Field -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $tool->name)" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Tagline Field -->
                    <div class="mt-4">
                        <x-input-label for="tagline" :value="__('Tagline')" />
                        <x-text-input id="tagline" class="block mt-1 w-full" type="text" name="tagline" :value="old('tagline', $tool->tagline)" required autofocus autocomplete="tagline" />
                        <x-input-error :messages="$errors->get('tagline')" class="mt-2" />
                    </div>

                    <!-- Logo Field (File Upload) -->
                    <div class="mt-4">
                        <x-input-label for="logo" :value="__('Logo')" />
                        <x-text-input id="logo" class="block mt-1 w-full" type="file" name="logo" />
                        <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update Tool
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
