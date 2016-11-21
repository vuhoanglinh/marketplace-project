<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filter_model extends CI_Model {
	private $_table  =    "tbl_filter";
	public function __construct(){
        parent::__construct();
    }

    public function getfilter()
    {
    	$this->db->order_by('last_modified', 'DESC');
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getfilterlimit($start,$limit)
    {
        $this->db->order_by('last_modified', 'DESC');        
        $this->db->limit($limit,$start);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getLikeKey($key)
    {
        $this->db->order_by('last_modified', 'DESC');
        $this->db->like('name', $key);
        $query  =   $this->db->get($this->_table);
        return $query->result();        
    }

    public function getLikeKeyLimit($key,$start,$limit)
    {
        $this->db->order_by('last_modified', 'DESC');
        $this->db->like('name', $key);
        $this->db->limit($limit,$start);
        $query  =   $this->db->get($this->_table);
        return $query->result();        
    }

    public function getfilterbyid($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getfilterByName($name)
    {
    	$this->db->where('name',$name);
        $query = $this->db->get($this->_table);
        if($query->num_rows() > 0)
        {
        	return TRUE;
        }
        else
        {
        	return FALSE;
        }
    }

    public function getfilterByNameId($id,$name)
    {
    	$this->db->where('id !=',$id);
    	$this->db->where('name',$name);
        $query = $this->db->get($this->_table);
        if($query->num_rows() > 0)
        {
        	return TRUE;
        }
        else
        {
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