<?php

class indexController extends Controller {
	public function index() {
        
        $this->config->css = array();
        
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('stock/index', $this->data);
	}
}
?>