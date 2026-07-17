<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Company;
use App\Models\JobOffer;
use App\Models\CandidateProfile;

class NavbarSearch extends Component
{
    public string $search = '';

    public function getResultsProperty()
    {
        if (strlen($this->search) < 2) {
            return [
                'users' => collect(),
                'companies' => collect(),
                'jobs' => collect(),
            ];
        }

        return [
            'users' => User::role('candidate')
                ->where('name', 'like', "%{$this->search}%")
                ->limit(5)
                ->get(),

            'companies' => Company::where('name', 'like', "%{$this->search}%")
                ->limit(5)
                ->get(),

        ];
    }
}
