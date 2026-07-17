<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JobOffer;

class JobsSearch extends Component
{
    public string $search = '' ;
    public string $workMode = '' ;
    public string $contract = '' ;

    public function getJobsProperty() {
        $query = JobOffer::query();

        $query->where('is_closed', 0);

        if ($this->search != '') {
            $query->where('title', 'like', "%{$this->search}%");
        }

        if ($this->contract != '') {
            $query->where('contract_type', $this->contract);
        }

        if ($this->workMode != '') {
            $query->where('work_mode', $this->workMode);
        }

        return $query->latest()->get();
    }


    public function render()
    {
        return view('livewire.jobs-search');
    }
}
