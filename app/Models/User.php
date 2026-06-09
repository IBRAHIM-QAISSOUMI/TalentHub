<?php

namespace App\Models;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Company;
use App\Models\Application;
use App\Models\CandidateProfile;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // relation one to one with company model 
    public function company() {
        return $this->hasOne(Company::class);
    }



    // relation one to many with application model 
    public function applications() {
        return $this->hasMany(Application::class);
    }


    // relation one to one with candidateProfile model 
    public function candidateProfile() {
        return $this->hasOne(CandidateProfile::class);
    }


    // relation friendship
    public function sentFriendRequests()
    {
        return $this->hasMany(Friendship::class, 'sender_id');
    }

    public function receivedFriendRequests()
    {
        return $this->hasMany(Friendship::class, 'receiver_id');
    }
}
