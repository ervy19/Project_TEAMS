<?php

class Assigned_Role extends Eloquent {

	protected $table ='assigned_roles';

	protected $fillable = array('user_id', 'role_id');

	protected $guarded = 'id';

	protected $appends = array('role_name');

	public function getRoleNameAttribute()
	{
		$role = Role::find($this->role_id);

		if($role)
		{
			return $role->name;
		}
		else
		{
			return '';
		}
	}
}

?>