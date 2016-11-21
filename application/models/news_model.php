<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model {
	private $_table  =    "tbl_news_category";
	public function __construct(){
        parent::__construct();
    }

    public function getList($statuscp = 1,$status = 1)
    {
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        $this->db->order_by("sort", "desc");
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getList1($statuscp = 1)
    {
        $this->db->where('statuscp', $statuscp);
        $this->db->order_by("sort", "desc");
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getList1Limit($start,$limit,$statuscp = 1)
    {
    	$this->db->where('statuscp', $statuscp);
        $this->db->order_by("sort", "desc");
    	$this->db->limit($limit,$start);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getListLikeName($key,$statuscp = 1)
    {
    	$this->db->where('statuscp', $statuscp);
    	$this->db->like('name',$key);
        $this->db->order_by("sort", "desc");
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getListLikeNameLimit($key,$start,$limit,$statuscp = 1)
    {
    	$this->db->where('statuscp', $statuscp);
    	$this->db->like('name',$key);
    	$this->db->limit($limit,$start);
        $this->db->order_by("sort", "desc");
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getID($id = 0)
    {
        $this->db->where('id', $id);       
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getCode($code,$id = 0)
    {
        if($id != 0) {
            $this->db->where('id !=', $id);
        }
        $this->db->where('code', $code);
        $query = $this->db->get($this->_table);
        if($query->num_rows() > 0){
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function getName($name,$id = 0)
    {
        if($id != 0) {
            $this->db->where('id !=', $id);
        }
        $this->db->where('name', $name);
        $query = $this->db->get($this->_table);
        if($query->num_rows() > 0){
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function getTitle($title,$id = 0)
    {
        if($id != 0) {
            $this->db->where('id !=', $id);
        }
        $this->db->where('title', $title);
        $query = $this->db->get($this->_table);
        if($query->num_rows() > 0){
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function insert($arrayName)
    { 
        if($this->db->insert($this->_table,$arrayName)){
            return TRUE;
        }        
        else {
            return FALSE;
        }
    }

    public function update($arrayName, $id)
    {
        $this->db->where('id', $id);
        if($this->db->update($this->_table, $arrayName)){
            return TRUE;
        }        
        else {
            return FALSE;
        }
    }

    public function movetrash($id)
    {
        $this->db->where('id', $id);
        $arrayName = array('statuscp' => '0');
        if($this->db->update($this->_table,$arrayName))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function outtrash($id)
    {
        $this->db->where('id', $id);
        $arrayName = array('statuscp' => '1');
        if($this->db->update($this->_table,$arrayName))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function updatestatus($id,$status)
    {
        $this->db->where('id', $id);
        $arrayName = array('status' => $status);
        if($this->db->update($this->_table,$arrayName))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        if($this->db->delete($this->_table))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}