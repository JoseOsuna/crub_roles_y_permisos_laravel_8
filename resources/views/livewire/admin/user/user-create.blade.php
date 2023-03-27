<div>
    <x-jet-button wire:click="showModal">
        {{ $texto }}
    </x-jet-button>


    <x-jet-dialog-modal wire:model="show" id="create_group">
        <x-slot name="title">
            {{ __('Crear Usuario') }}
        </x-slot>
    
        <x-slot name="content">

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model.lazy="name" required autofocus autocomplete="name" />
                <x-jet-input-error for="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" wire:model.lazy="email" required />
                <x-jet-input-error for="email" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password"  wire:model.lazy="password" required autocomplete="new-password" />
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
                            <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="{{ $item->id }}" wire:model.lazy="rol" id="flexCheckDefault_{{ $item->id }}">
                            <label class="form-check-label inline-block text-gray-800" for="flexCheckDefault_{{ $item->id }}">
                                {{ $item->name }}
                            </label>
                        </div>
                    @else
                        @if ($item->name != 'super-admin')
                            <div class="form-check px-2">
                                <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="{{ $item->id }}" wire:model.lazy="rol" id="flexCheckDefault_{{ $item->id }}">
                                <label class="form-check-label inline-block text-gray-800" for="flexCheckDefault_{{ $item->id }}">
                                    {{ $item->name }}
                                </label>
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
    
            <x-jet-button class="ml-3" wire:click="create" wire:loading.attr="disabled">
                {{ __('Guardar Usuario') }}
            </x-jet-button>
    
        </x-slot>
    </x-jet-dialog-modal>
</div>
