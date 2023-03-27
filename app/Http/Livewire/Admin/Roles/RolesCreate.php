<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RolesCreate extends Component
{
    public $show = false;
    public $nombre = '';

    protected $rules = [
        'nombre' => 'required|min:2|unique:proyectos',
    ];

    public function showModal()
    {
        $this->show = true;
        $this->nombre = '';
    }

    public function clouseModal()
    {
        $this->show = false;
        $this->nombre = '';
    }

    public function create()
    {

        $this->nombre = trim($this->nombre);
        $this->validate();

        Role::create([
            'name' => $this->nombre,
            'guard_name' => 'web'
        ]);

    
        $this->emit('render');
        $this->nombre = '';
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.admin.roles.roles-create');
    }
}
