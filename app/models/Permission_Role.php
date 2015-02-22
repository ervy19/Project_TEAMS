<?php

class Permission_Role extends Eloquent {

	protected $table ='permission_role';

	protected $fillable = array('permission_id', 'role_id');

	protected $guarded = 'id';

	protected $appends = array('permission_name');

	public function getPermissionNameAttribute()
	{
		$permission = Permission::find($this->permission_id);

		if($permission)
		{
			return $permission->display_name;
		}
		else
		{
			return '';
		}
	}
}

?>