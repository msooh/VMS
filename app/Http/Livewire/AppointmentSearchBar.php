<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AppointmentSearchBar extends Component
{
    public $query;

    public $appointments;

    public function mount()
    {
        $this->query = '';
        $this->appointments = [];
    }

    public function updateQuery()
    {
        $this->appointments =Appointment::select('name')->where('name', 'like', '%' . $this->query . '%')
        ->get()
        ->toArray();
    }
    public function render()
    {
        return view('livewire.appointment-search-bar');
    }
}
