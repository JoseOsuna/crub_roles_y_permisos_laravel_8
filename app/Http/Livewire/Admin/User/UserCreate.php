<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserCreate extends Component
{
    public $texto = 'Crear Usuario';
    public $show = false;

    public $name = '';
    public $email = '';
    public $password = '';
    public $rol = [];
    public $activo = 1;

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => 'required|min:6',
        'rol' => 'required',
        'activo' => 'required',
    ];

    public function reset_data()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->rol = [];
    }

    public function showModal()
    {$this->show = true;
        $this->reset_data();
    }

    public function clouseModal()
    {
        $this->show = false;
        $this->reset_data();
    }

    public function create()
    {

        $this->name = trim($this->name);
        $this->password = trim($this->password);
        $this->validate();

        $user = User::create([
            'name'  => $this->name,
            'email' => $this->email,
            'activo' => $this->activo,
            'password' => Hash::make($this->password)
        ]);

        $user->syncRoles($this->rol);

        $this->reset_data();

        $this->emit('render');
        $this->nombre = '';
        $this->show = false;
    }

    public function render()
    {
        // Role::whereNotIn('name', ['role A'])->get();
        $roles = Role::get();
        return view('livewire.admin.user.user-create', compact('roles'));
    }
}
