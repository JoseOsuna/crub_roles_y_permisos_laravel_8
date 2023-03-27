<div>
    <x-jet-button wire:click="showModal">
        {{ __('Crear Rol') }}
    </x-jet-button>


    <x-jet-dialog-modal wire:model="show" id="create_group">
        <x-slot name="title">
            {{ __('Crear Rol') }}
        </x-slot>
    
        <x-slot name="content">

            <div>
                <x-jet-label for="nombre" value="{{ __('Nombre') }}" />
                <x-jet-input id="nombre" wire:model.lazy="nombre" class="block mt-1 w-full" type="text" name="nombre" required autofocus />
                <x-jet-input-error for="nombre" />
            </div>

        </x-slot>
    
        <x-slot name="footer">

            <x-jet-secondary-button wire:click="clouseModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
    
            <x-jet-button class="ml-3" wire:click="create" wire:loading.attr="disabled">
                {{ __('Guardar Rol') }}
            </x-jet-button>
    
        </x-slot>
    </x-jet-dialog-modal>
</div>
