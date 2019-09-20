<?php

class indexController extends Controller {
	public function index() {
        
        if(!$this->user->isUser())
            $this->response->redirect('/login');
        $lvl = $this->user->getLvl();
        $this->data['lvl'] = $lvl;
        
        $this->load->model('clients');
        $this->load->model('employee');
        $this->load->model('work');
        $this->load->model('work_op');
        
        $this->data['clients'] = $this->clientsModel->colInKey($this->clientsModel->getItems());
        $this->data['employee'] = $this->employeeModel->colInKey($this->employeeModel->getItems());
        
        if(isset($this->request->post['add']))
            $this->workModel->addItem(array('emp_id' => $this->request->post['emp_id'], 'cl_id' => $this->request->post['cl_id'], 'date_st' => $this->request->post['date_st']));
        elseif(isset($this->request->post['rem'])){
            if($lvl == '0')
                $this->workModel->deleteItems(array('id' => $this->request->post['id'],));
        }
        $works = $this->workModel->getItems();
        $this->data['total'] = 0;
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
        
        $this->data['date_min'] = $this->workModel->getMin('date_st');
        $this->data['date_max'] =$this->workModel->getMax('date_fin');
        $this->data['count'] = $this->workModel->getCount();
        
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('work/index', $this->data);
	}
    
	public function more($id = false) {
        
        $this->load->model('clients');
        $this->load->model('employee');
        $this->load->model('stock');
        $this->load->model('work_op');
        $this->load->model('work');
        $this->load->model('report');
        
        $stock = $this->stockModel->colInKey($this->stockModel->getItems());
        
        $this->data['clients'] = $this->clientsModel->colInKey($this->clientsModel->getItems());
        $this->data['employee'] = $this->employeeModel->colInKey($this->employeeModel->getItems());
        
        $this->data['work'] = $this->workModel->getItems(array(), array('id' => $id))[0];
        if($this->data['work']['date_fin'] == ''){
            if(isset($this->request->post['save'])){
                $this->workModel->updateItems(array('emp_id' => $this->request->post['emp_id'], 'cl_id' => $this->request->post['cl_id'], 'date_st' => $this->request->post['date_st'], 'date_fin' => $this->request->post['date_fin']), array('id' => $this->request->post['id']));
                if($this->request->post['date_fin'] != ''){
                    $writer = '<a href="/work/more/'.$this->request->post['id'].'">Работа #'.$this->request->post['id'].'</a>';
                    $description = '';
                    $cost = 0;
                    $ops = $this->work_opModel->getItems(array(), array('w_id' => $this->request->post['id']));
                    foreach($ops as $op)
                    {
                        $description .= $op['description'].' = '.$op['cost'].'; ';
                        $cost += 1 * $op['cost'];
                    }
                    $this->reportModel->addItem(array('writer' => $writer,
                                                      'description' => $description,
                                                      'date' => $this->request->post['date_fin'],
                                                      'cost' => $cost));
                }
            }
            elseif(isset($this->request->post['rem'])){
                if($lvl == '0')
                    $this->work_opModel->deleteItems(array('id' => $this->request->post['id']));
            }
            elseif(isset($this->request->post['det'])){
                $description = $stock[$this->request->post['detail']]['name']."(".$stock[$this->request->post['detail']]['mark'].") ".$this->request->post['count']." по ".$stock[$this->request->post['detail']]['cost'];
                $cost = 1 * $this->request->post['count'] * $stock[$this->request->post['detail']]['cost'];
                $this->work_opModel->addItem(array('w_id' => $this->request->post['w_id'],
                                                   'description' => $description,
                                                   'cost' => $cost));
                $this->stockModel->updateItems(array('count' => $stock[$this->request->post['detail']]['count'] - $this->request->post['count']), array('id' => $this->request->post['detail']));
            }
            elseif(isset($this->request->post['op'])){
                $this->work_opModel->addItem(array('w_id' => $this->request->post['w_id'],
                                                   'description' => $this->request->post['description'],
                                                   'cost' => $this->request->post['cost']));
            }
        }
        
        $this->data['work'] = $this->workModel->getItems(array(), array('id' => $id))[0];
        $this->data['work_op'] = $this->work_opModel->getItems(array(), array('w_id' => $id));
        $this->data['stock'] = $this->stockModel->getItems();
        
        $this->data['edit'] = false;
        if($this->data['work']['date_fin'] == '')
            $this->data['edit'] = true;
        
        $this->config->js = array('work_more');
        $this->config->css = array('work_more');
        
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('work/more', $this->data);
	}
}
?>