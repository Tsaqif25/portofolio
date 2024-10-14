<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg"> 
                <form method="POST" action="{{ route('admin.project_schrenshoot.store',$project) }}" enctype="multipart/form-data">
                    @csrf
                        <h1>Add Project Shrenshoot</h1>
                        <div class="item-card flex flex-row justify-between items-center">
                            <div class="flex flex-row items-center gap-x-3">
                                <img src="{{ Storage::url($project->cover) }}" alt="" class="rounded-2xl object-cover w-[90px] h-[90px]"> <!-- Menggunakan cover_image -->
                                <div class="flex flex-col">
                                    <h3 class="text-indigo-950 text-xl font-bold">{{ $project->name }}</h3>
                                    <p class="text-sm text-slate-400">
                                        {{ $project->category }}
                                    </p>
                                </div>
                            </div> 
                            {{-- <div class="hidden md:flex flex-col">
                                <p class="text-slate-500 text-sm">Category</p>
                                <h3 class="text-indigo-950 text-xl font-bold">{{ $project->category }}</h3> <!-- Menampilkan kategori -->
                            </div> --}}
    
                        </div> 
                    <!-- Category Dropdown Field -->
                    <div class="mt-4">
                        <x-input-label for="schrenshoot" :value="__('schrenshoot Image')" />
                        <x-text-input id="schrenshoot" class="block mt-1 w-full" type="file" name="schrenshoot" required autofocus />                        
                        <x-input-error :messages="$errors->get('schrenshoot')" class="mt-2" />
                    </div>

                    <!-- Cover Image Field (File Upload) -->
            
                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            add screnshoot
                        </button>
                    </div>
                </form>
                <hr class="my-10">
                <h3 class="text-xl text-indigo">Existing Screnshoot</h3>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                    @forelse ($project->schrenshoot as $schrenshoot)
                    <div class="item-card flex flex-row justify-between items-center">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($schrenshoot->schrenshoot) }}" alt="" class="rounded-2xl object-cover w-[90px] h-[90px]">
                            <div class="flex flex-col">
                                <h3 class="text-indigo-950 text-xl font-bold">{{ $schrenshoot->name }}</h3>
                                <p class="text-sm text-slate-400">
                                    {{ $schrenshoot->tagline }}
                                </p>
                            </div>
                        </div> 
                        <div class="hidden md:flex flex-row items-center gap-x-3">
                            <form action="" method="POST"> 
                            {{-- <form action="{{ route('admin.project_screnshoot.destroy',$schrenshoot->id) }}" method="POST">  --}}
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                                    Delete
                                </button>
                            </form> 
                        </div>
                    </div> 
                    @empty
                    <p>No schrenshoot Available</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>