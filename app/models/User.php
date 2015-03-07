<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements ConfideUserInterface
{
    use ConfideUser;
    use HasRole;

    protected $table ='users';

	protected $fillable = array('id', 'username', 'email', 'password', 'confirmation_code', 'remember_token', 'confirmed');

	protected $guarded = 'id';
}
