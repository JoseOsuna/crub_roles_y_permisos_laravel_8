<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('inicio') }}
        </h2>
    </x-slot>

    <div class="container mx-auto pt-4">
        <div class="my-5 flex justify-end">
            {{-- @livewire('admin.clave.clave-create') --}}
        </div>

        <div class="mb-6">
            {{-- @livewire('admin.clave.clave-list') --}}
        </div>

    </div>
</x-app-layout>
