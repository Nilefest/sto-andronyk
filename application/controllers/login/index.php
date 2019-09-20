<?php

class indexController extends Controller {
	public function index() {
        
        $this->config->css = array('login');
        
        if(isset($this->request->post['log-in'])){
            $this->user->login($this->request->post['login'], $this->request->post['password']);
            $this->response->redirect('/');
        }
        
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('login/index', $this->data);
	}
}
?>