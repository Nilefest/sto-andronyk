<?php

class indexController extends Controller {
	public function index() {
        
        $this->config->css = array();
        
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('work/index', $this->data);
	}
	public function more() {
        
        $this->config->css = array();
        
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('work/more', $this->data);
	}
}
?>