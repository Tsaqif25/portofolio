<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg"> 
                <form method="POST" action="{{ route('admin.project.update', $project->id) }}" enctype="multipart/form-data"> 
                    @csrf
                    @method('PUT')
                    
                    <!-- Name Field -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $project->name)" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Category Dropdown Field -->
                    <div class="mt-4">
                        <x-input-label for="category" :value="__('Category')" />
                        <select id="category" name="category" class="block mt-1 w-full border border-slate-300 rounded-xl" required>
                            <option value="" disabled>Select Category</option>
                            <option value="Web Development" {{ $project->category == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                            <option value="App Development" {{ $project->category == 'App Development' ? 'selected' : '' }}>App Development</option>
                            <option value="Graphic Designer" {{ $project->category == 'Graphic Designer' ? 'selected' : '' }}>Graphic Designer</option>
                            <option value="Digital Marketing" {{ $project->category == 'Digital Marketing' ? 'selected' : '' }}>Digital Marketing</option>
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <!-- Cover Image Field (File Upload) -->
                    <div class="mt-4">
                        <x-input-label for="cover" :value="__('Cover Image')" />
                        <x-text-input id="cover" class="block mt-1 w-full" type="file" name="cover" />
                        <x-input-error :messages="$errors->get('cover')" class="mt-2" />
                    </div>

                    <!-- About Field (Textarea) -->
                    <div class="mt-4">
                        <x-input-label for="about" :value="__('About')" />
                        <textarea name="about" id="about" cols="30" rows="5" class="border border-slate-300 rounded-xl w-full" required>{{ old('about', $project->about) }}</textarea>
                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update Project
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
