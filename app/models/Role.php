<?php

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	protected $guarded = 'id';

    protected $appends = array('all_permissions');

    public function getAllPermissionsAttribute()
    {
    	$permissions = Permission_Role::where('role_id','=',$this->id)
    					->get();

    	if(!$permissions->isEmpty())
    	{
    		return $permissions;
    	}
    	else
    	{
    		return '';
    	}
    }
}