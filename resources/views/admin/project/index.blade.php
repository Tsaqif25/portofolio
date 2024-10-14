<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Projects') }}
            </h2>
            <a href="{{ route('admin.project.create') }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                Add New
            </a>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                @forelse ($projects as $project)
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
                    <div class="hidden md:flex flex-row items-center gap-x-3">
                        <a href="{{ route('admin.project-assign-tool',$project) }}" class="font-bold py-4 px-6 bg-indigo-950 text-white rounded-full">
                            Add Tools
                        </a>
                       <a href="{{ route('admin.project_schrenshoot.create',$project) }}" class="font-bold py-4 px-6 bg-indigo-950 text-white rounded-full">
                            Add Screnshoot
                        </a>
                    </div>
                    <div class="hidden md:flex flex-row items-center gap-x-3">
                        <a href="{{ route('admin.project.edit', $project) }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Edit
                        </a>
                        <form action="{{ route('admin.project.destroy', $project) }}" method="POST"> 
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                                Delete
                            </button>
                        </form> 
                    </div>
                </div> 
                @empty
                <p>Item Tidak Tersedia</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
