<?php

class headerController extends Controller {

	public function index() {
                
        $this->data['title'] = $this->config->title;
        $this->data['description'] = $this->config->description;
        $this->data['keywords'] = $this->config->keywords;
		
		$this->data['activesection'] = $this->document->getActiveSection();
		$this->data['activeitem'] = $this->document->getActiveItem();

		if(isset($this->session->data['error'])) {
			$this->data['error'] = $this->session->data['error'];
			unset($this->session->data['error']);
		}
		
		if(isset($this->session->data['warning'])) {
			$this->data['warning'] = $this->session->data['warning'];
			unset($this->session->data['warning']);
		}
		
		if(isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		}
        
        $this->data['css'] = $this->config->css;
	
		return $this->load->view('common/header', $this->data);
	}
}
?>
