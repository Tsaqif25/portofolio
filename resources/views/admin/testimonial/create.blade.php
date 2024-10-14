<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Testimonial') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('admin.testimonial.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Name Field -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Role Field -->
                    <div class="mt-4">
                        <x-input-label for="role" :value="__('Role')" />
                        <x-text-input id="role" class="block mt-1 w-full" type="text" name="role" :value="old('role')" required />
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <!-- Logo Field (File Upload) -->
                    <div class="mt-4">
                        <x-input-label for="logo" :value="__('Logo')" />
                        <x-text-input id="logo" class="block mt-1 w-full" type="file" name="logo" required />
                        <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                    </div>

                    <!-- Testimonial Field (Textarea) -->
                    <div class="mt-4">
                        <x-input-label for="testimonial" :value="__('Testimonial')" />
                        <textarea name="testimonial" id="testimonial" cols="30" rows="5" class="border border-slate-300 rounded-xl w-full" required>{{ old('testimonial') }}</textarea>
                        <x-input-error :messages="$errors->get('testimonial')" class="mt-2" />
                    </div>

                    <!-- Rate Field -->
                    <div class="mt-4">
                        <x-input-label for="rate" :value="__('Rate (1-5)')" />
                        <x-text-input id="rate" class="block mt-1 w-full" type="number" name="rate" :value="old('rate')" min="1" max="5" required />
                        <x-input-error :messages="$errors->get('rate')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Add New Testimonial
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
