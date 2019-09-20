<?php

class indexController extends Controller {
	public function index() {
        
        if(!$this->user->isUser())
            $this->response->redirect('/login');
        $lvl = $this->user->getLvl();
        $this->data['lvl'] = $lvl;
        
        $this->load->model('report');
        
        if(isset($this->request->post['add'])){
            $this->reportModel->addItem(array('writer' => $this->request->post['date'],
                                              'description' => $this->request->post['name'],
                                              'date' => $this->request->post['object'],
                                              'cost' => $this->request->post['sum']));
        }
        elseif(isset($this->request->post['rem'])){
            if($lvl == '0')
                $this->reportModel->deleteItems(array('id' => $this->request->post['id'],));
        }
        $this->data['reports'] = $this->reportModel->getItems();
        
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('report/index', $this->data);
	}
}
?>