<?php

namespace TransitPro;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class User extends Authenticatable implements LogsActivityInterface {

   use EntrustUserTrait, PresentableTrait, LogsActivity;
   protected $presenter = 'TransitPro\Presenters\UserPresenter';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'password','email', 'display_name',
        'other_names', 'last_login_at', 'image', 'address', 'address2',
        'phone', 'phone2'
    ];

    protected $dates =['last_login_at'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value){
      if($value){
        $this->attributes['password'] = bcrypt($value);
      }
    }
    public function setOtherNamesAttribute($value){
      $this->attributes['other_names']=$value?:null;
    }
    public function setDisplayNameAttribute($value){
      //set display_name to value or concat user's name
      $this->attributes['display_name']=$value?:$this->name();
    }


    public function name()
    {
        $otherNames = $this->other_names?:'';

        return $this->first_name .' '.$otherNames.' '.$this->last_name;
    }

    public function canBeDeletedBy($editor)
   {
       // users can't delete themselves, right?
       return $this->canBeEditedBy($editor) && ( $this->id !== $editor->id );
   }
   public function canBeEditedBy($editor)
   {
       if ($this->id == $editor->id) {
           return true;
       } elseif ($this->isAdmin()) {
           return $editor->canEditAdmins();
       } elseif ($this->isModerator()) {
           return $editor->canEditModerators();
       } else {
           return $editor->canEditUsers();
       }
   }
   public function canSetRolesOnNewUser($roles)
   {
       if ($this->isSuperadmin()) {
           return true;
       }
       if (!$this->isAdmin()) {
           return false;
       }
       // we are admin.
       // allow to change any < admin roles
       if (!count($roles)) {
           return true;
       }
       // if roles contain some admin rights, disallow.
       $adminRoleIds = Role::whereIn('name', ['admin', 'superadmin'])->lists('id')->toArray();
       if (!array_intersect($adminRoleIds, $roles)) {
           return true;
       }
       return false;
   }
   public function canSetRolesOnAnotherUser(User $anotherUser, $roles)
   {
       if ($this->isSuperadmin()) {
           return true;
       }
       if (!$this->isAdmin() || $anotherUser->isAdmin()) {
           return false;
       }
       // we are admin, he is not.
       // allow to change any < admin roles
       if (!count($roles)) {
           return true;
       }
       // if roles contain some admin rights, disallow.
       $adminRoleIds = Role::whereIn('name', ['admin', 'superadmin'])->lists('id')->toArray();
       if (!array_intersect($adminRoleIds, $roles)) {
           return true;
       }
       return false;
   }
   public function canSetRoleOnAnotherUser(User $anotherUser, Role $role)
   {
       if ($this->isSuperadmin()) {
           return true;
       }
       if (!$this->isAdmin()) {
           return false;
       }
       return false;
   }

   public function isSuperadmin()
    {
        return $this->hasRole(['superadmin']);
    }
    public function isAdmin()
    {
        return $this->hasRole(['admin', 'superadmin']);
    }
    public function isStaff()
    {
        return $this->hasRole(['staff']);
    }
    public function isCustomer()
    {
        return $this->hasRole(['customer']);
    }
    public function canEditUsers()
    {
        return $this->can('users.edit');
    }
    public function canEditAdmins()
    {
        return $this->can('admins.edit');
    }

    public function getActivityDescriptionForEvent($eventName)
    {

        if ($eventName == 'created')
        {
            return 'User "' . $this->email.' ( '. $this->name() . ') " was created';
        }

        if ($eventName == 'updated')
        {
            return 'User "' . $this->email.' ( '. $this->name() . ') " was updated';
        }

        if ($eventName == 'deleted')
        {
            return 'User "' . $this->email.' ( '. $this->name() . ') " was deleted';
        }

        return '';
    }

}
