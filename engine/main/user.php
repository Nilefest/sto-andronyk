<?php

class User {
	private $registry;
    
	private $user = array();

  	public function __construct($registry) {
		$this->registry = $registry;
        $this->logged();
        if(isset($this->registry->request->get['logout']))
            $this->logout();
  	}

    public function login($login, $password){
        $this->registry->session->data['andr_sto_login'] = $login;
        $this->registry->session->data['andr_sto_password'] = $password;
		$this->logged();
    }
    
    public function logged(){
		if (isset($this->registry->session->data['andr_sto_login'])) {
			//$query = $this->registry->db->query("SELECT * FROM `users` WHERE `login` = '".$this->registry->session->data['andr_sto_login']."' AND `password` = '".$this->registry->session->data['andr_sto_password']."'");
			$query = $this->registry->db->query("SELECT * FROM `users` WHERE `login` = '".$this->registry->session->data['andr_sto_login']."' AND `password` = '".md5($this->registry->session->data['andr_sto_password'])."'");
            if(!empty($query)) $this->user = $query[0];
            else $this->logout();
        }
    }
    
  	public function logout() {
		unset($this->registry->session->data['andr_sto_login']);
		unset($this->registry->session->data['andr_sto_password']);
        $this->user = array();
  	}
  
  	public function isUser() {
        if(empty($this->user)) return false;
        return true;
  	}
    
    public function getLvl(){
        return $this->user['lvl'];
    }
}
?>
