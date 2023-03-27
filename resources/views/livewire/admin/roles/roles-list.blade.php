<div class="">
    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md">

        <div class="my-1 p-3">
            <div class="grid grid-cols-2 gap-4">
                <div class="">

                </div>
                <div class="flex justify-end">
                    <div class="">
                        <x-jet-label for="search_nombre" value="{{ __('Nombre') }}" />
                        <x-jet-input id="search_nombre" wire:model="search_nombre" class="block" type="text" name="search_nombre"/>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="my-6">
            <x-jet-confirms-password wire:then="password_test">
                <x-jet-button type="button" wire:loading.attr="disabled">
                    {{ __('Enable') }}
                </x-jet-button>
            </x-jet-confirms-password>
        </div> --}}

        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <thead class="bg-gray-50">
                <tr>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">ID</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Nombre</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @forelse ($data as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $item->id }}</td>
                        <td class="px-6 py-4">
                            {{ $item->name }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($item->name != 'super-admin')
                                <div class="flex justify-end gap-4">
                                    @can('roles.edit')
                                        <a x-data="{ tooltip: 'Edite' }" href="{{ route('roles.show', $item->id) }}">
                                            <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="h-6 w-6"
                                            x-tooltip="tooltip"
                                            >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                                            />
                                            </svg>
                                        </a>
                                    @endcan
                                    @can('roles.delete')
                                        @if ($item->id != 2 or auth()->user()->rol == 'super-admin')
                                            <button x-data="{ tooltip: 'Delete' }" wire:click="confirmation_delete({{ $item->id }}, '{{$item->name}}')">
                                                <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                stroke="currentColor"
                                                class="h-6 w-6"
                                                x-tooltip="tooltip"
                                                >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                                />
                                                </svg>
                                            </button>
                                        @endif
                                    @endcan
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-center" colspan="3">No hay datos disponibles</td>
                </tr>
                @endforelse
            </tbody>
        </table>


    </div>


    <x-jet-confirmation-modal wire:model="show_confirmation_delete" id="">
        <x-slot name="title">
            Rol: {{ $nombre_delete }}
        </x-slot>
    
        <x-slot name="content">

            <div>
                Seguro que quiere eliminar el rol: <b>{{ $nombre_delete }}</b>.
            </div>

        </x-slot>
    
        <x-slot name="footer">

            <x-jet-secondary-button wire:click="$toggle('show_confirmation_delete')" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Eliminar rol') }}
            </x-jet-secondary-button>

    
        </x-slot>
    </x-jet-confirmation-modal>

    <x-jet-dialog-modal wire:model="show_no_delete" id="">
        <x-slot name="title">
            No se puede eliminar el rol: {{ $nombre_delete }}
        </x-slot>
    
        <x-slot name="content">

            <div>
                No se puede eliminar el rol <b>{{ $nombre_delete }}</b> ya que hay usuarios con este rol.
            </div>

        </x-slot>
    
        <x-slot name="footer">

            <x-jet-secondary-button wire:click="$toggle('show_no_delete')" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>
    
        </x-slot>
    </x-jet-dialog-modal>
</div>