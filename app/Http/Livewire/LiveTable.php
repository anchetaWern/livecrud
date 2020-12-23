<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\User;

class LiveTable extends Component
{
    use WithPagination;

    public $sortField = 'name';
    public $sortAsc = true;
    public $search = '';

    protected $listeners = ['delete', 'triggerRefresh' => '$refresh'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }


    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        $this->dispatchBrowserEvent('user-deleted', ['user_name' => $user->name]);
    }


    public function render()
    {
        return view('livewire.live-table', [
            'users' => User::search($this->search)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->simplePaginate(10),
        ]);
    }
}
