<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Applications;

class ApplicationsFilter extends Component
{
    public string $status='';

    public function getApplicationsProperty() 
    {
        if(auth()->user()->hasRole('candidate')) 
        {
           $query = auth()->user()->applications();

           if($this->status !== '') {
               $query->where('status', $this->status);
           }

           return $query->latest()->get();
        }
    }

    public function render()
    {
        return view('livewire.applications-filter');
    }
}
