<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_event_model extends CI_Model {
	private $_table  =    "tbl_stores_event";
	public function __construct(){
        parent::__construct();
    }

    public function getEvent($id_store,$status = 1)
    {
        $this->db->where('id_store', $id_store);
        $this->db->where('status', $status);        
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getEvent2($id_store,$status = 1)
    {
        $this->db->where('id_store', $id_store);
        $this->db->where('status <=', $status);        
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getEventLimit1($id_store,$start,$limit,$status = 1)
    {
        $this->db->where('id_store', $id_store);
        $this->db->where('status', $status);
        $this->db->limit($limit,$start);
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getEventLimit2($id_store,$start,$limit,$status = 1)
    {
        $this->db->where('id_store', $id_store);
        $this->db->limit($limit,$start);
        $this->db->where('status <=', $status); 
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getEventKey($id_store,$key,$status = 1)
    {
    	$this->db->where('id_store', $id_store);
        $condition  =   "`status` = $status AND `name` LIKE '%$key%'";      
        $this->db->order_by('date_added', 'DESC');
        $this->db->where($condition);     
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getEventKey2($id_store,$key,$status = 1)
    {
    	$this->db->where('id_store', $id_store);
        $condition  =   "`status` <= $status AND `name` LIKE '%$key%'";      
        $this->db->order_by('date_added', 'DESC');
        $this->db->where($condition);     
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getEventKeyLimit($id_store,$key,$start,$limit,$status = 1)
    {
    	$this->db->where('id_store', $id_store);
        $condition  =   "`status` = $status AND `name` LIKE '%$key%'";        
        $this->db->order_by("date_added", "desc");
        $this->db->where($condition);        
        $this->db->limit($limit,$start);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getEventKeyLimit2($id_store,$key,$start,$limit,$status = 1)
    {
    	$this->db->where('id_store', $id_store);
        $condition  =   "`status` >= $status AND `name` LIKE '%$key%'";        
        $this->db->order_by("date_added", "desc");
        $this->db->where($condition);        
        $this->db->limit($limit,$start);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getEventById($id)
    {
        $this->db->where('id', $id);
        $this->db->limit(1);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getEventByName($id_store,$name)
    {
    	$this->db->where('id_store', $id_store);
        $this->db->where('name', $name);
        $this->db->limit(1);
        $query  =   $this->db->get($this->_table);
        if($query->num_rows() > 0)
        {
        	return TRUE;
        }
        else
        {
        	return FALSE;
        }
    }

    public function getEventByNameID($id_store,$id,$name)
    {
    	$this->db->where('id_store', $id_store);
    	$this->db->where('id !=', $id);
        $this->db->where('name', $name);
        $query  =   $this->db->get($this->_table);
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
}