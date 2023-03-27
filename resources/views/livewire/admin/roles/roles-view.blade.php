<div>

    <div>
        <x-jet-label for="nombre" value="{{ __('Nombre') }}" />
        <x-jet-input id="nombre" wire:model.lazy="nombre" class="block mt-1" type="text" name="nombre"/>
    </div>

    <div class="my-4">
        <h2>Permisos del rol: {{ $data->name }}</h2>
    </div>

    <div class="grid md:grid-cols-1 lg:grid-cols-5 gap-4">
        @foreach ($permissions as $item)
            <div class="p-2 overflow-hidden rounded-lg border border-gray-200 shadow-md grid grid-cols-3 gap-6">

                <x-jet-input  id="permission_{{ $item->id }}" wire:model.lazy="permissions_use" value="{{ $item->id }}" type="checkbox"/>
                <x-jet-label class="col-span-2" for="permission_{{ $item->id }}" value="{{ $item->name }}" /> 
            </div>
        @endforeach
    </div>

    <div class="my-5 flex justify-center">
        
        <x-jet-action-message class="mr-3 my-2" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:click="update" wire:loading.attr="disabled">
            {{ __('Guardar') }}
        </x-jet-button>
    </div>

</div>
