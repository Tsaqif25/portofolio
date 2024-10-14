<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg"> 
                <form method="POST" action="{{ route('admin.project-assign-tool.store',$project) }}" enctype="multipart/form-data"> 
                    @csrf
                        <h1>Assign Tool</h1>
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
                        <x-input-label for="category" :value="__('Tool')" />
                        <select id="tool_id" name="tool_id" class="block mt-1 w-full border border-slate-300 rounded-xl" required>
                            @forelse ($tools as $tool )
                                
                     
                            <option value="" disabled selected> Select Category </option>
                            <option value="{{ $tool->id }}">{{ $tool->name }}</option>
                            @empty
                            <option value="">Chose Tool Below</option>
                        @endforelse
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <!-- Cover Image Field (File Upload) -->
            

                    <!-- About Field (Textarea) -->
               

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Assign Tool
                        </button>
                    </div>
                </form>
                <hr class="my-10">
                <h3 class="text-xl text-indigo">Existing Tool</h3>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                    @forelse ($project->tools as $item)
                    <div class="item-card flex flex-row justify-between items-center">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($item->logo) }}" alt="" class="rounded-2xl object-cover w-[90px] h-[90px]">
                            <div class="flex flex-col">
                                <h3 class="text-indigo-950 text-xl font-bold">{{ $item->name }}</h3>
                                <p class="text-sm text-slate-400">
                                    {{ $item->tagline }}
                                </p>
                            </div>
                        </div> 
                        <div class="hidden md:flex flex-row items-center gap-x-3">
                       
                            <form action="{{ route('admin.project_tools.destroy', $item->pivot->id) }}" method="POST"> 
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                                    Delete
                                </button>
                            </form> 
                        </div>
                    </div> 
                    @empty
                    <p>No Tools Available</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
