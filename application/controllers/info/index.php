<?php

class indexController extends Controller {
	public function index() {
        if(!$this->user->isUser())
            $this->response->redirect('/login');
        $lvl = $this->user->getLvl();
        $this->data['lvl'] = $lvl;
        
        $this->load->model('employee');
        $this->load->model('clients');
        $this->load->model('work');
        $this->load->model('work_op');
        $this->load->model('stock');
        
        if(isset($this->request->post['new_count']))
            if($lvl == '0')
                $this->stockModel->updateItems(array('count' => $this->request->post['count']), array('id' => $this->request->post['id']));
        if(isset($this->request->post['new_cost']))
            if($lvl == '0')
                $this->stockModel->updateItems(array('cost' => $this->request->post['cost']), array('id' => $this->request->post['id']));
        /*elseif(isset($this->request->post['rem'])){
            if($lvl == '0')
                $this->stockModel->deleteItems(array('id' => $this->request->post['id']));
        }/**/
        
        $this->data['employee'] =  $this->employeeModel->colInKey($this->clientsModel->getItems());
        $this->data['clients'] =  $this->clientsModel->colInKey($this->clientsModel->getItems());
        $this->data['stock'] = $this->stockModel->query('SELECT * FROM `stock` WHERE `count` <= 10');
        $works = $this->workModel->getItems(array(), array('date_fin' => ''));
        foreach($works as $key => $work){
            $ops = $this->work_opModel->getItems(array(), array('w_id' => $work['id']));
            $works[$key]['description'] = '';
            $works[$key]['cost'] = '0';
            foreach($ops as $op)
            {
                $works[$key]['description'] .= $op['description'].' = '.$op['cost'].'; ';
                $works[$key]['cost'] += 1 * $op['cost'];
            }
            $this->data['total'] += 1 * $works[$key]['cost'];
        }
        $this->data['works'] = $works;
        
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('info/index', $this->data);
	}
}
?>