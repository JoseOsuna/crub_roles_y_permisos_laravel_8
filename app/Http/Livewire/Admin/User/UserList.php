<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserList extends Component
{
    use WithPagination;

    protected $listeners = ['render'];

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'per_page' => ['except' => 10]
    ];

    public function rules(){
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,name,'.$this->id_use],
            // 'telefono' => 'min:7',
            // 'password' => 'required|min:6',
            'rol' => 'required',
            'activo' => 'required',
        ];
    }

    public $search = '';
    public $per_page = 10;

    public $show = false;
    public $id_use = '';
    public $nombre = '';

    public $nombre_delete = false;
    public $show_no_delete = false;
    public $show_confirmation_delete = false;

    public $name = '';
    public $email = '';
    public $password = '';
    public $rol = [];
    public $activo = 1;



    public function showModalEdit($data){
        $this->id_use = $data['id'];
        $this->show = true;

        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->activo = $data['activo'];
        // $this->password = '';

        $roles_ids = [];
        foreach ($data['roles'] as $key => $value) {
            $roles_ids[] = $value['id'];
        }
        $this->rol = $roles_ids;
        
    }

    public function clouseModal(){
        $this->id_use = '';
        $this->show = false;
    }

    public function update(){

        $this->name = trim($this->name);
        $this->email = trim($this->email);
        $this->password = trim($this->password);

        $this->validate();

        $user = User::where('id', $this->id_use)->first();

        $user->syncRoles($this->rol);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'activo' => $this->activo,
        ]);

        $this->password = trim($this->password);

        if($this->password){
            $user->update([
                'password' => Hash::make($this->password)
            ]);
        }

        $this->show = false;
        $this->emit('render');
    }

    public function confirmation_delete($id, $nombre){

        $this->id_use = $id;
        $this->nombre_delete = $nombre;
        $this->show_confirmation_delete = true;

    }

    public function delete(){

        $user = User::where('id', $this->id_use)->with('passwords')->first();
        
        if($user->passwords){
            $this->show_confirmation_delete = false;
            $this->show_no_delete = true;
        }else{
            // $this->show_no_delete = true;
            // $this->nombre_delete = $nombre;
            $this->show_confirmation_delete = false;
            User::where('id', $this->id_use)->delete();
        }

    }
    public function render()
    {
        $roles = Role::get();
        $data = User::buscar($this->search)->paginate($this->per_page);
        return view('livewire.admin.user.user-list', compact('data', 'roles'));
    }
}
