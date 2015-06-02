<?php
class Validation {


	private $objForm;
	

	private $_error = array();
	

	public $_message = array(
		"first_name"	=> "Completeaza corect numele",
		"last_name"		=> "Completeaza corect prenumele",
		"address_1"		=> "Completeaza corect adresa 1",
		"address_2"		=> "Completeaza corect adresa 2",
		"town"			=> "Completeaza corect orasul",
		"county"		=> "Completeaza corect judetul",
		"post_code"		=> "Completeaza corect codul postal",
		"country"		=> "Selecteaza tara",
		"email"			=> "Completeaza corect adresa de email",
		"email_duplicate"	=> "Aceasta adresa de email este deja folosita!",
		"login"			=> "Username si / sau parola gresite",
		"password"		=> "Alege o parola",
		"confirm_password"	=> "Confirma parola",
		"password_mismatch"	=> "Parolele nu corespund",
		"category"		=> "Selecteaza o categorie",
		"name"			=> "Introdu un nume",
		"description"	=> "Introdu o descriere",
		"price"			=> "Introdu pretul",
		"name_duplicate"	=> "Numele introdus exista deja"
	);
	
	
	public $_expected = array();
	
	
	public $_required = array();
	
	public $_special = array();
	
	
	public $_post = array();
	
	
	public $_post_remove = array();
	
	public $_post_format = array();
	
	
	
	
	
	
	public function __construct($objForm) {
		$this->objForm = $objForm;
	}
	
	
	
	
	
	
	
	
	public function process() {
		if ($this->objForm->isPost() && !empty($this->_required)) {
	
			$this->_post = $this->objForm->getPostArray($this->_expected);
			if (!empty($this->_post)) {
				foreach($this->_post as $key => $value) {
					$this->check($key, $value);
				}
			}
		}
	}
	
	
	
	
	
	
	
	
	
	
	public function add2Errors($key) {
		$this->_errors[] = $key;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	public function check($key, $value) {
		if (!empty($this->_special) && array_key_exists($key, $this->_special)) {
			$this->checkSpecial($key, $value);
		} else {
			if (in_array($key, $this->_required) && empty($value)) {
				$this->add2Errors($key);
			}
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	public function checkSpecial($key, $value) {
		switch($this->_special[$key]) {
			case 'email':
			if (!$this->isEmail($value)) {
				$this->add2Errors($key);
			}
			break;
		}
	}
	
	
	
	
	
	
	
	
	
	
	public function isEmail($email = null) {
		if (!empty($email)) {
			$result = filter_var($email, FILTER_VALIDATE_EMAIL);
			return !$result ? false : true;
		}
		return false;
	}
	
	
	
	
	
	
	
	
	
	public function isValid() {
		$this->process();
		if (empty($this->_errors) && !empty($this->_post)) {
	
			if (!empty($this->_post_remove)) {
				foreach($this->_post_remove as $value) {
					unset($this->_post[$value]);
				}
			}
	
			if (!empty($this->_post_format)) {
				foreach($this->_post_format as $key => $value) {
					$this->format($key, $value);
				}
			}
			return true;
		}
		return false;
	}
	
	
	
	
	
	
	
	
	
	
	
	public function format($key, $value) {
		switch($value) {
			case 'password':
			$this->_post[$key] = Login::string2hash($this->_post[$key]);
			break;
		}
	}
	
	
	
	
	


	
	
	
	
	public function validate($key) {
		if (!empty($this->_errors) && in_array($key, $this->_errors)) {
			return $this->wrapWarn($this->_message[$key]);
		}
	}
	
	
	
	
	
	
	


	
	public function wrapWarn($mess = null) {
		if (!empty($mess)) {
			return "<span class=\"warn\">{$mess}</span>";
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	




}