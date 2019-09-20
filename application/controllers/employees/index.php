<?php

class indexController extends Controller {
	public function index() {
        
        if(!$this->user->isUser())
            $this->response->redirect('/login');
        $lvl = $this->user->getLvl();
        $this->data['lvl'] = $lvl;
        
        $this->load->model('employee');
        if(isset($this->request->post['add'])){
            $this->employeeModel->addItem(array('name' => $this->request->post['name'], 'contact' => $this->request->post['contact'], 'description' => $this->request->post['description']));
        }
        elseif(isset($this->request->post['rem'])){
            if($lvl == '0')
                $this->employeeModel->deleteItems(array('id' => $this->request->post['id']));
        }
        $this->data['employees'] = $this->employeeModel->getItems();
        
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('employees/index', $this->data);
	}
}
?>