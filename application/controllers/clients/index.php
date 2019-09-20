<?php

class indexController extends Controller {
	public function index() {
        if(!$this->user->isUser())
            $this->response->redirect('/login');
        $lvl = $this->user->getLvl();
        $this->data['lvl'] = $lvl;
        
        $this->load->model('clients');
        
        if(isset($this->request->post['add'])){
            $this->clientsModel->addItem(array('name' => $this->request->post['name'], 'contact' => $this->request->post['contact'], 'car_mark' => $this->request->post['car_mark'], 'car_num' => $this->request->post['car_num']));
        }
        elseif(isset($this->request->post['rem'])){
            if($lvl == '0')
                $this->clientsModel->deleteItems(array('id' => $this->request->post['id']));
        }
        $this->data['clients'] = $this->clientsModel->getItems();
        
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('clients/index', $this->data);
	}
    
	public function more($id = false) {
        if(!$this->user->isUser())
            $this->response->redirect('/login');
        $lvl = $this->user->getLvl();
        
        if(!$id) $this->response->redirect('/clients');
        $this->load->model('clients');
        $this->load->model('work');
        $this->load->model('work_op');
        
        if(isset($this->request->post['save'])){
            $this->clientsModel->updateItems(array('name' => $this->request->post['name'], 'contact' => $this->request->post['contact'], 'car_mark' => $this->request->post['car_mark'], 'car_num' => $this->request->post['car_num']), array('id' => $id));
        }
        $this->data['client'] = $this->clientsModel->getItems(array(), array('id' => $id))[0];
        $works = $this->workModel->getItems(array(), array('cl_id' => $id));
        foreach($works as $key => $work){
            $ops = $this->work_opModel->getItems(array(), array('w_id' => $work['id']));
            $works[$key]['description'] = '<ul>';
            $works[$key]['cost'] = '0';
            foreach($ops as $op)
            {
                $works[$key]['description'] .= '<li>'.$op['description'].' = '.$op['cost'].'</li>';
                $works[$key]['cost'] += 1 * $op['cost'];
            }
            $works[$key]['description'] .= '</ul>';
        }
        $this->data['works'] = $works;
        
        
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('clients/more', $this->data);
	}
    
    public function search(){
        
        if(!$this->user->isUser())
            $this->response->redirect('/login');
        $lvl = $this->user->getLvl();
        
        $words = $this->request->post['words'];
        
        $this->load->model('clients');
        
        $clients = $this->clientsModel->query("SELECT * FROM `clients` WHERE `name` LIKE '%".$words."%' OR `contact` LIKE '%".$words."%' OR `car_mark` LIKE '%".$words."%' OR `car_num` LIKE '%".$words."%'");
        foreach($clients as $key => $client){
            $clients[$key]['lvl'] = $lvl;
        }
        echo json_encode($clients);
        return false;
    }
}
?>