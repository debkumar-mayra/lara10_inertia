<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'string',
    ];

    // protected $append = ['role_name'];


    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }


    public function getRoleNameAttribute()
    {
        if ($this->roles()->exists())
            return $this->roles()->first()->name;
        else
            return 0;
    }
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getDobAttribute($val)
    {
        return $val ? date('m-d-Y', strtotime($val)) : null;
    }


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['name'] ?? null, function ($query, $search) {
            $query->WhereRaw("concat(first_name,' ', last_name) like '%" . trim($search) . "%' ");
        });

        $query->when($filters['email'] ?? null, function ($query, $search) {
            $query->where('email','like', "%" . trim($search) . "%");
        });

        $query->when($filters['phone'] ?? null, function ($query, $search) {
            $query->where('phone','like', "%" . trim($search) . "%");
        });

        $query->when(isset($filters['active']) ?? null, function ($query, $search) use($filters){
            $query->where('active',$filters['active']);
        });
    }

    public function scopeOrdering($query, array $filters)
    {
        $query->when($filters['fieldName'] ?? null, function ($query, $search) use($filters){
            $query->orderBy($search,$filters['shortBy']);
        });
    }

}
