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
    public function get(){}
    public function getBy(){}
    public function save(){}
    public function delete(){}
}

