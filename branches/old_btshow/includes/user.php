<?php
class User{
	private static $instance;

	public $userId = false;
	public $username = false;
	public $groupId = false;
	public $role = false;

	public static function getInstance(){
		if(!isset($instance)){
			$c=__CLASS__;
			self::$instance=new $c;
		}
		return self::$instance;
	}

	/** invoke once when the first time visit the user propertise */
	function  __construct(){
		if(!isset($username)){
			$username = $_COOKIE['SHW_USERNAME'];
			$token = $_COOKIE['SHW_TOKEN'];
			if(isset($token) || isset($username)){// if cookie not exist

			}else{
				$db = db::init();
				$sql = "select * from {$db->prefix}user where username = ? and token = ?";
				$ret = $db->queryf($sql,$username,$token);
				if($row = $ret->fetch_assoc()){
					$this->$userId = $row['id'];
					$this->$userGroupId =  $row['group_id'];
					$this->$role = $row['role'];
					$this->$username = $row['username'];
				}
			}
		}
	}

	/** user login */
	function dologin($username,$password,$cookie_expire){
		$db = db::init();
		$sql = "select * from {$db->prefix}user where username = ? and password = ?";
		$ret = $db->queryf($sql,$username,$password);
		if($row = $ret->fetch_assoc()){
			$this->$userId = $row['id'];
			$this->$userGroupId = $row['group_id'];
			$this->$role = $row['role'];
			$this->$username = $row['username'];
			
			//save token to user table
			$sql = "update {$db->prefix}user set token = ? where id = ?";
			$token = api_generate_rand_key();
			$ret = $db->queryf($sql,$token,$this->$userId);//TODO how to confirm db operation successed?
			setcookie("SHW_USERNAME",$this->$username,time()+$cookie_expire);
			setcookie("SHW_TOKEN",$token,time()+$cookie_expire);
			return true;
		}
		return false;
	}

	/** judge right */
	function judge($action, $object_owner_id = false, $object_owningteam_id = false){
		if ($this->userId == $object_owner_id){
			$required_scope = SCOPE_OWN;
		}elseif($this->groupId == $object_owningteam_id){
			$required_scope = SCOPE_TEAM;
		}else{
			$required_scope = SCOPE_ANY;
		}
		$scope = $sg_defined_rights[$action][ROLE_ANYONE];
		if($scope >= $required_scope){
			return true;
		}
		if($role){
			if($role && ROLE_USER){
				$scope = $sg_defined_rights[$action][ROLE_USER];
				if($scope >= $required_scope){
					return true;
				}
			}
			if($role && ROLE_CONFIRMED){
				$scope = $sg_defined_rights[$action][ROLE_CONFIRMED];
				if($scope >= $required_scope){
					return true;
				}
			}
			if($role && ROLE_UPLOADER){
				$scope = $sg_defined_rights[$action][ROLE_UPLOADER];
				if($scope >= $required_scope){
					return true;
				}
			}
			if($role && ROLE_TEAMLEADER){
				$scope = $sg_defined_rights[$action][ROLE_TEAMLEADER];
				if($scope >= $required_scope){
					return true;
				}
			}
			if($role && ROLE_SYSOP){
				$scope = $sg_defined_rights[$action][ROLE_SYSOP];
				if($scope >= $required_scope){
					return true;
				}
			}
			if($role && ROLE_DEVELOPER){
				$scope = $sg_defined_rights[$action][ROLE_DEVELOPER];
				if($scope >= $required_scope){
					return true;
				}
			}
		}
		return false;
	}
	
	/**
	 * Generate a random key using the methodology recommend in php.net/uniqid
	 * @return a unique random hex key
	 */
	function api_generate_rand_key() {
	  return md5(uniqid(mt_rand(), true));
	}
}