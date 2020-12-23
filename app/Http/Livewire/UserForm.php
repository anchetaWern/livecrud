<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class UserForm extends Component
{

    public $user_id;
    public $name;
    public $email;
    public $age;
    public $address;


    protected $listeners = ['triggerEdit'];


    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|min:10',
            'email' => 'required|email|min:10',
            'age' => 'required|integer',
            'address' => 'required|min:10',
        ]);

        if ($this->user_id) {
            User::find($this->user_id)
                ->update([
                    'name' => $this->name,
                    'email' => $this->email,
                    'age' => $this->age,
                    'address' => $this->address,
                ]);

            $this->dispatchBrowserEvent('user-saved', ['action' => 'updated', 'user_name' => $this->name]);
        } else {
            User::create(array_merge($validated, [
                'user_type' => 'user',
                'password' => bcrypt($this->email)
            ]));

            $this->dispatchBrowserEvent('user-saved', ['action' => 'created', 'user_name' => $this->name]);
        }

        $this->resetForm();
        $this->emitTo('live-table', 'triggerRefresh');
    }


    public function resetForm()
    {
        $this->user_id = null;
        $this->name = null;
        $this->email = null;
        $this->age = null;
        $this->address = null;
    }


    public function triggerEdit($user)
    {
        $this->user_id = $user['id'];
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->age = $user['age'];
        $this->address = $user['address'];

        $this->emit('dataFetched', $user);
    }


    public function render()
    {
        return view('livewire.user-form');
    }
}
