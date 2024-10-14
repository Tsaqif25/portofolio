<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg"> 
                <div class="flex flex-row items-center gap-x-3">
                 
                    <div class="flex flex-col">
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $projectOrder->name }}</h3>
                        <p class="text-sm text-slate-400">
                            {{ $projectOrder->email }}
                        </p>
                    </div>
                </div> 
                <hr class="my-10">
                <h3 class="text-xl text-indigo">Brief</h3>
                    <p>{{$projectOrder->brief }}</p>
                    <p>{{$projectOrder->category }}</p>
                    <p> $ {{$projectOrder->budget }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
