<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// $role = Role::create(['name' => 'writer']);

class RolesView extends Component
{
    public $id_use;
    public $data;
    public $nombre;
    public $permissions;
    public $permissions_use = [];

    public function mount()
    {
        $this->data = Role::where('id', $this->id_use)->firstOrFail();

        $this->permissions_use = $this->data->permissions->pluck('id');

        $this->permissions = Permission::get();
        $this->nombre = $this->data->name;
    }

    public function rules(){
        return [
            'nombre' => 'required|string|max:255|unique:'.config('permission.table_names.roles', 'roles').',name,'.$this->id_use,
        ];
    }

    public function update()
    {
        $this->nombre = trim($this->nombre);
        $this->validate();

        $this->data->update([
            'name' => $this->nombre
        ]);
        $permissions = $this->permissions_use ?? [];
        $this->data->syncPermissions($permissions);
        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.admin.roles.roles-view');
    }
}
