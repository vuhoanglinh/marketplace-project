<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slideshow_model extends CI_Model {
	private $_table  =    "tbl_slideshow";
	public function __construct(){
        parent::__construct();
    }

    public function getSlide($status = 1)
    {
        $this->db->where('status',$status);        
        $this->db->order_by('last_modified', 'desc');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getList($key = "",$status = "")
    {
    	if($key != "") {
    		$this->db->like('name',$key);
    	}

    	if($status != "") {
    		$this->db->where('status',$status);
    	}
    	$this->db->order_by('last_modified', 'desc');
    	$query	=	$this->db->get($this->_table);
    	return $query->result();
    }

    public function getID($id = "")
    {
    	$this->db->where('id',$id);
    	$query	=	$this->db->get($this->_table);
    	return $query->result();
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