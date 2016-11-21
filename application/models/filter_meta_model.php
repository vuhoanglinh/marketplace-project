<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filter_meta_model extends CI_Model {
	private $_table  =    "tbl_filter_meta";
	public function __construct(){
        parent::__construct();
    }

    public function getmeta($id_filter)
    {	
    	$this->db->where('id_filter', $id_filter);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getmetalimit($id_filter,$start,$limit)
    {   
        $this->db->where('id_filter', $id_filter);
        $this->db->limit($limit,$start);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getLikeKey($id_filter,$key)
    {
    	$this->db->where('id_filter', $id_filter);
        $this->db->like('name', $key);
        $query  =   $this->db->get($this->_table);
        return $query->result();        
    }

    public function getLikeKeyLimit($id_filter,$key,$start,$limit)
    {
        $this->db->where('id_filter', $id_filter);
        $this->db->like('name', $key);
        $this->db->limit($limit,$start);
        $query  =   $this->db->get($this->_table);
        return $query->result();        
    }

    public function getByName($id_filter,$name)
    {

        $this->db->where('id_filter', $id_filter);
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

    public function getByNameId($id_filter,$id,$name)
    {
    	$this->db->where('id_filter', $id_filter);
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

    public function deleteidfilter($id_filter)
    {
        $this->db->where('id_filter', $id_filter);
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