<?php

namespace App\Helpers;

/**
 * Constants classes
 */
class Constant
{
	/*
	* Default count data per page
	*/
	public const COUNT_PER_PAGE = 10;

	/**
	* User genders
	**/
	public const USERS_GENDERS = [
		'M',
		'F'
	];

	/**
	* User Roles
	**/
	public const USER_ROLES = [
		'admin' => 'admin',
		'teacher' => 'teacher',
		'student' => 'student'
	];

	/*
	* Default date format
	*/
	public const DATE_FORMAT = 'd/m/Y';
}
