<?php

namespace App\Livewire;

use App\Models\Company;
use Livewire\Component;

class JobsByCompanyFilter extends Component
{
    public string $search = '';
    public string $status = '';
    public Company $company;


    public function mount($id)
    {
        $this->company = Company::findOrFail($id);
    }
    
    public function getJobsProperty()
    {
        $query = $this->company
            ->jobOffers()
            ->with('applications');

        if ($this->search !== '') {
            $query->where('title', 'like', "%{$this->search}%");
        }

        if ($this->status !== '') {
            $query->where('is_closed', $this->status);
        }

        return $query->latest()->get();
    }

public function render()
{
    return view('livewire.jobs-by-company-filter')
        ->extends('layouts.app')
        ->section('content');
}
}