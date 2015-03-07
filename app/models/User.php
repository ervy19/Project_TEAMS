<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements ConfideUserInterface
{
    use ConfideUser;
    use HasRole;

    protected $guarded = 'id';

    protected $appends = array('name','all_roles');

    public function getNameAttribute()
    {
    	$supervisors = Supervisor::where('user_id','=',$this->id)
    						->where('isActive','=',true)
    						->first();

    	if($supervisors)
    	{
    		return $supervisors->name;
    	}
    	else
    	{
    		$hr_account = HR_Account::where('user_id','=',$this->id)
    						->where('isActive','=',true)
    						->first();

    		if($hr_account)
    		{
    			return $hr_account->name;
    		}
    		else
    		{
    			return '';
    		}
    	}
    }

    public function getAllRolesAttribute()
    {
        $roles = Assigned_Role::where('user_id','=',$this->id)
                        ->get();

        if(!$roles->isEmpty())
        {
            return $roles;
        }
        else
        {
            return '';
        }
    }
    
    protected $table ='users';

	protected $fillable = array('id', 'username', 'email', 'password', 'confirmation_code', 'remember_token', 'confirmed');

}
