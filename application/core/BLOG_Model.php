<?php
class BLOG_Model extends CI_Model
{
    protected $_tablename = '';
    protected $_primary_key = "id";
    protected $_primary_filter = "intval";
    protected $_order_by = '';
    protected $_rules = array();
    protected $_timestamps = false;
    
    public function __construct() {
        parent::__construct();
    }
    public function get($id = null, $single = FALSE)
    {
        if($id != NULL)
        {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->where($this->_primary_key,$id);
            $method = "row";
        }
        elseif($single == TRUE)
        {
            $method = "row";
        }
        else
        {
            $method = "result";
        }
        
        $this->db->order_by($this->_order_by);
        
        return $this->db->get($this->_tablename)->$method();
    }
    public function get_by($where, $single = FALSE)
    {
        $this->db->where($where);
        return $this->get(null,$single);
        
    }
    public function save($data, $id = null)
    {
        //set timestamps
        if($this->_timestamps == TRUE)
        {
            $now = data('Y-m-d H:i:s');
            $id ||$data['created'] = $now;
            $data['modified'] = $now;
        }
        //insert
        if($id == null)
        {
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = null;
            $this->db->set($data);
            $this->db->insert($this->_tablename);
            $id = $this->db->insert_id();
        }
        //update
        else
        {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_tablename);
        }
        return $id;
    }
    public function delete($id)
    {
        $filter = $this->_primary_filter;
        $id = $filter($id);
        
        if(!$id)
        {
            return false;
        }
        $this->db->where($this->_primary_key, $id);
        $this->db->limit(1);
        $this->db->delete($this->_tablename);
    }
}

