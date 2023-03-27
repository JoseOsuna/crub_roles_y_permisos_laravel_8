<div class="">
    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md">

        <div class="my-1 p-3">
            <div class="grid grid-cols-2 gap-4">
                <div class="">
                    <select wire:model="per_page" class="mt-5" name="per_page" id="per_page">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <div class="">
                        <x-jet-label for="search" value="{{ __('Nombre') }}" />
                        <x-jet-input id="search" wire:model="search" class="block" type="text" name="search"/>
                    </div>
                </div>
            </div>

        </div>

        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <thead class="bg-gray-50">
                <tr>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">ID</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Nombre</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Correo</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Estado</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Roles</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Fecha de Ingreso</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @forelse ($data as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $item->id }}</td>
                        <td class="px-6 py-4">{{ $item->name }}</td>
                        <td class="px-6 py-4">{{ $item->email }}</td>
                        <td class="px-6 py-4">
                            <div class="flex">
                                @if($item->activo)
                                    <div class="mx-1 px-2 py-1 font-semibold text-sm bg-green-500 text-white rounded-full shadow-sm">
                                        Activo
                                    </div>
                                @else
                                    <div class="mx-1 px-2 py-1 font-semibold text-sm bg-red-500 text-white rounded-full shadow-sm">
                                        Desactivado
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            {{-- @json($item->roles) --}}
                            <div class="flex">
                                @foreach ($item->roles as $value)
                                    <div class="mx-1 px-2 py-1 font-semibold text-sm bg-cyan-500 text-white rounded-full shadow-sm">
                                        {{ $value->name }}
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ $item->created_at }}</td>
                        <td class="px-6 py-4">
                            {{ $item->nombre }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-4">
                                @can('users.edit')
                                    @if((!in_array('super-admin', $item->roles->pluck('name')->toArray())))
                                        <button x-data="{ tooltip: 'Edite' }" wire:click="showModalEdit({{ $item }})">
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
                                        </button>
                                    @endif
                                @endcan
                                {{-- {!! $item->roles->pluck('name')->toArray() !!} --}}
                                @can('users.delete')
                                    @if(
                                        (!in_array('super-admin', $item->roles->pluck('name')->toArray()))
                                        and $item->id != auth()->user()->id
                                    )
                                        <button x-data="{ tooltip: 'Delete' }" wire:click="confirmation_delete({{ $item->id }}, '{{$item->nombre}}')">
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
                        </td>
                    </tr>
                @empty
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-center" colspan="3">No hay datos disponibles</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        
        <div class="px-4 py-3 sm:px-6">
            {{ $data->appends($_GET)->links() }}
        </div>

    </div>

    <x-jet-dialog-modal wire:model="show" id="edit_category">
        <x-slot name="title">
            {{ __('Actualizar Usuario') }}
        </x-slot>
    
        <x-slot name="content">

            <div>
                <x-jet-label for="name_update" value="{{ __('Name') }}" />
                <x-jet-input id="name_update" class="block mt-1 w-full" type="text" name="name_update" wire:model.lazy="name" required autofocus autocomplete="name" />
                <x-jet-input-error for="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email_update" value="{{ __('Email') }}" />
                <x-jet-input id="email_update" class="block mt-1 w-full" type="email" name="email_update" wire:model.lazy="email" required />
                <x-jet-input-error for="email" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_update" value="{{ __('Password') }}" />
                <x-jet-input id="password_update" class="block mt-1 w-full" type="password" name="password_update"  wire:model.lazy="password" required autocomplete="new-password" />
                <x-jet-input-error for="password" />
            </div>

            <div class="mt-4">
                <x-jet-label class="mt-2" value="{{ __('Estado') }}" />
                <div class="flex">
                    <x-jet-input id="activo" class="mr-2" type="checkbox" name="activo"  wire:model.lazy="activo" required />
                    <x-jet-label for="activo" value="{{ __('Activo') }}" />
                    <x-jet-input-error for="activo" />
                </div>
            </div>

            <x-jet-label class="mt-2" value="{{ __('Escoja un Rol') }}" />
            <div class="grid grid-cols-3 gap-4">
                @foreach ($roles as $item)
                    @if (auth()->user()->rol == 'super-admin' and $item->name == 'super-admin')
                        <div class="form-check px-2">
                            <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="{{ $item->id }}" wire:model.lazy="rol" id="flexCheckDefault_{{ $item->id }}_update">
                            <label class="form-check-label inline-block text-gray-800" for="flexCheckDefault_{{ $item->id }}_update">
                                {{ $item->name }}
                            </label>
                            {{-- <x-jet-label for="flexCheckDefault_{{ $item->id }}_update" value="{{ $item->name }}" /> --}}
                        </div>
                    @else
                        @if ($item->name != 'super-admin')
                            <div class="form-check px-2">
                                <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="{{ $item->id }}" wire:model.lazy="rol" id="flexCheckDefault_{{ $item->id }}_update">
                                <label class="form-check-label inline-block text-gray-800" for="flexCheckDefault_{{ $item->id }}_update">
                                    {{ $item->name }}
                                </label>
                                {{-- <x-jet-label for="flexCheckDefault_{{ $item->id }}_update" value="{{ $item->name }}" /> --}}
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
            <x-jet-input-error for="rol" />

        </x-slot>
    
        <x-slot name="footer">

            <x-jet-secondary-button wire:click="clouseModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
    
            <x-jet-button class="ml-3" wire:click="update" wire:loading.attr="disabled">
                {{ __('Actualizar') }}
            </x-jet-button>
    
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-confirmation-modal wire:model="show_confirmation_delete" id="">
        <x-slot name="title">
            Usuario: {{ $nombre_delete }}
        </x-slot>
    
        <x-slot name="content">

            <div>
                Seguro que quiere eliminar el usuario: <b>{{ $nombre_delete }}</b>.
            </div>

        </x-slot>
    
        <x-slot name="footer">

            <x-jet-secondary-button wire:click="$toggle('show_confirmation_delete')" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Eliminar categoria') }}
            </x-jet-secondary-button>

    
        </x-slot>
    </x-jet-confirmation-modal>

    <x-jet-dialog-modal wire:model="show_no_delete" id="">
        <x-slot name="title">
            No se puede eliminar la categoria: {{ $nombre_delete }}
        </x-slot>
    
        <x-slot name="content">

            <div>
                No se puede eliminar la categoria <b>{{ $nombre_delete }}</b> ya que dependen contraseñas de este registro.
            </div>

        </x-slot>
    
        <x-slot name="footer">

            <x-jet-secondary-button wire:click="$toggle('show_no_delete')" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>
    
        </x-slot>
    </x-jet-dialog-modal>
</div>