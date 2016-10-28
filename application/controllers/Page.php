<?php
class page extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pages_m');

    }        
    
    public function index()
    {
        $pages = $this->pages_m->get_by(array('slug' => 'slug2'));
        var_dump($pages);
    }
    public function add()
    {
        $data = array(
            'order' => 2,
            
        );
        $id = $this->pages_m->save($data,2);
        print_r($id);
    }
}
