<?php

class indexController extends Controller {
	public function index() {
        
        if(!$this->user->isUser())
            $this->response->redirect('/login');
        $lvl = $this->user->getLvl();
        $this->data['lvl'] = $lvl;
        
        //print_r($this->request->post);
        
        $this->load->model('stock');
        if(isset($this->request->post['add_item'])){
            $this->stockModel->addItem(array('mark' => $this->request->post['mark'], 'name' => $this->request->post['name'], 'provider' => $this->request->post['provider'], 'type_car' => $this->request->post['type_car'], 'count' => $this->request->post['count'], 'cost' => $this->request->post['cost']));
        }
        if(isset($this->request->post['new_count']))
            if($lvl == '0')
                $this->stockModel->updateItems(array('count' => $this->request->post['count']), array('id' => $this->request->post['id']));
        if(isset($this->request->post['new_cost']))
            if($lvl == '0')
                $this->stockModel->updateItems(array('cost' => $this->request->post['cost']), array('id' => $this->request->post['id']));
        if(isset($this->request->post['rem'])){
            if($lvl == '0')
                $this->stockModel->deleteItems(array('id' => $this->request->post['id']));
        }
        $this->data['stock'] = $this->stockModel->getItems();
        
        $this->config->js = array('stock');
        
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('stock/index', $this->data);
	}
    
    public function search(){
        
        if(!$this->user->isUser())
            $this->response->redirect('/login');
        $lvl = $this->user->getLvl();
        
        $words = $this->request->post['words'];
        
        $this->load->model('stock');
        
        $stock = $this->stockModel->query("SELECT * FROM `stock` WHERE `mark` LIKE '%".$words."%' OR `name` LIKE '%".$words."%' OR `provider` LIKE '%".$words."%' OR `type_car` LIKE '%".$words."%'");
        foreach($stock as $key => $det){
            $det[$key]['lvl'] = $lvl;
        }
        echo json_encode($stock);
        return false;
    }
}
?>