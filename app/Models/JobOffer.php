<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\Application;


class JobOffer extends Model
{
    protected $fillable = [
        'company_id',
        'title',
        'description',
        'contract_type',
        'image',
        'is_closed'
    ];

    // relation one to many with company model 
    public function company() {
        return $this->belongsTo(Company::class);
    }

    // relation one to many with application model 
    public function applications() {
        return $this->hasMany(Application::class);
    }
}
