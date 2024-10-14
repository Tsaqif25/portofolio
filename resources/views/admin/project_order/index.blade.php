<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Orders') }}
            </h2>
       
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                @forelse ($order as $order)
                <div class="item-card flex flex-row justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                    
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $order->name }}</h3>
                            <p class="text-sm text-slate-400">
                                {{ $order->category }}
                            </p>
                        </div>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $order->budget }}</h3>
                    </div> 
                 
              
                    <div class="hidden md:flex flex-row items-center gap-x-3">
                        <a href="{{route('admin.project_order.show', $order) }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Detailss
                        </a>
                   
                    </div>
                </div> 
                @empty
                <p>Item Tidak Tersedia</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
