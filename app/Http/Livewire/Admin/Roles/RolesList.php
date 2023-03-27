<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Models\User;
use Livewire\Component;
use App\Models\Admin\Clave;
use Spatie\Permission\Models\Role;

use Laravel\Jetstream\ConfirmsPasswords;

// use Spatie\Permission\Models\Permission;

class RolesList extends Component
{
    use ConfirmsPasswords;
    protected $listeners = ['render'];

    protected $queryString = [
        'search_nombre' => ['except' => '']
    ];

    public function rules(){
        return [
            'nombre' => 'required|min:2|unique:roles,nombre,'.$this->id_use,
        ];
    }

    // public $password_test = true;

    public $search_nombre = '';

    public $show = false;
    public $id_use = '';
    public $nombre = '';

    public $nombre_delete = false;
    public $show_no_delete = false;
    public $show_confirmation_delete = false;
    
    public function password_test(){
        $this->ensurePasswordIsConfirmed();
        dd('llego');
    }
        

    public function showModalEdit($id, $nombre){
        $this->id_use = $id;
        $this->show = true;
        $this->nombre = $nombre;
    }

    

    public function clouseModal(){
        $this->id_use = '';
        $this->show = false;
        $this->nombre = '';
    }

    public function update(){

        $this->nombre = trim($this->nombre);
        $this->validate();

        $categoria = Role::where('id', $this->id_use)->first();

        $categoria->update([
            'nombre' => $this->nombre
        ]);

        $this->show = false;
    }

    public function confirmation_delete($id, $nombre){

        $this->id_use = $id;
        $this->nombre_delete = $nombre;
        $this->show_confirmation_delete = true;

    }

    public function delete(){

        $role = Role::where('id', $this->id_use)->first();

        // $claves = User::role($role->name)->count();
        // dd($claves);

        if($role->users->count()){
            $this->show_confirmation_delete = false;
            $this->show_no_delete = true;
        }else{
            // $this->show_no_delete = true;
            // $this->nombre_delete = $nombre;
            $this->show_confirmation_delete = false;
            Role::where('id', $this->id_use)->delete();
        }

    }

    public function render()
    {
        if ($this->search_nombre != '') {
            $data = Role::where('name', 'like', '%'.$this->search_nombre.'%')->get();
        }else{
            $data = Role::get();
        }

        return view('livewire.admin.roles.roles-list', compact('data'));
    }
}
