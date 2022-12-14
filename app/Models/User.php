<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function isAdmin()
    {
        $isAdmin = false;
        foreach ($this->roles AS $role) {
            if ($role->id == \App\Http\Middleware\UserIsAdmin::ADMIN_ROLE_ID) {
                $isAdmin = true;
                break;
            }
        }
        return $isAdmin;
    }

    public function hasAnyRole($roles)
    {
        $rolesOfThisUser = $this->roles->map->name_en->toArray();
        if (!is_array($roles)) {
            $roles = [$roles];
        }

        $rolesOfThisUser = array_map('mb_strtolower', $rolesOfThisUser);
        $roles = array_map('mb_strtolower', $roles);
        
        foreach ($roles as $role) {
            if (in_array($role, $rolesOfThisUser)) {
                return true;
            }
        }
        
        return false;
    }
}
