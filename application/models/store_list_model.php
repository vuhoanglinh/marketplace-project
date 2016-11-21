<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_list_model extends CI_Model {
	private $_table  =    "tbl_stores_list";
	public function __construct(){
        parent::__construct();
    }

    public function getList($id_store,$statuscp = 1)
    {
        $this->db->where('id_store', $id_store);
        $this->db->where('statuscp', $statuscp);
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getListLimit($id_store,$start,$limit,$statuscp = 1)
    {
        $this->db->where('id_store', $id_store);
        $this->db->where('statuscp', $statuscp);
        $this->db->limit($limit,$start);
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getListKey($id_store,$key,$statuscp = 1)
    {
    	$this->db->where('id_store', $id_store);
        $condition  =   "`statuscp` = $statuscp AND `name` LIKE '%$key%'";        
        $this->db->order_by("date_added", "desc");
        $this->db->where($condition);    
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getListKeyLimit($id_store,$key,$start,$limit,$statuscp = 1)
    {
    	$this->db->where('id_store', $id_store);
        $condition  =   "`statuscp` = $statuscp AND `name` LIKE '%$key%'";        
        $this->db->order_by("date_added", "desc");
        $this->db->where($condition);        
        $this->db->limit($limit,$start);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getListById($id)
    {
        $this->db->where('id', $id);
        $this->db->limit(1);
        $query  =   $this->db->get($this->_table);
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

    public function updatestatuscp($id,$statuscp = 1)
    {
        $this->db->where('id', $id);
        $arrayName = array('statuscp' => $statuscp);
        if($this->db->update($this->_table,$arrayName))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}