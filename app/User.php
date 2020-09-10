<?php

namespace App;

use Auth;
use Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'email',
        'password',
        'name',
        'last_login_at',
        'last_login_ip',
    ];


  public function roles()
  {
    return $this->belongsToMany('App\Role','user_role','user_id','role_id');
  }

  public function hasAnyRoles($roles)
  {
      if (is_array($roles)){
        foreach ($roles as $role){
          if($this->hasRole($role)){
            return true;
          }
        }
      } else {
        if($this->hasRole($roles)){
          return true;
        }
      }
      return false;
  }

  public function hasRole($role){
    if($this->roles()->where('name', $role)->first()){
      return true;
    }
    return false;
  }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Check if user is online
    public function isOnline()
    {
      return Cache::has('user-is-online-'.$this->id);
    }
}
