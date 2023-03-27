<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="container mx-auto pt-4">

        @can('roles.create')
            <div class="my-5 flex justify-end">
                @livewire('admin.roles.roles-create')
            </div>
        @endcan

        <div class="mb-6">
            @livewire('admin.roles.roles-list')
        </div>

    </div>
</x-app-layout>