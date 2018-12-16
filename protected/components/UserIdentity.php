<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public $_id;
	public function authenticate()
	{
		$record=Users::model()->find('(username=:username  or email=:username)and role =5',array(':username'=>$this->username));
        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->password!==$this->password)
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else if($record->role ==1 || $record->role ==3)
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
			$this->_id					=	$record->id;
			$this->username				=	$record->username;
			Yii::app()->session['user'] = $record;
			yii::app()->session['id']=$record->id;
			$this->errorCode=self::ERROR_NONE;
		}
        return !$this->errorCode;
	}
	
	public function getId(){
        return $this->_id;
    }
}