<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_attribute_model extends CI_Model {

    private $_table  =   'tbl_products_attr';
	public function __construct(){
         parent::__construct();
    }	

    public function getAttr($id_parent,$type = 1)
    {
        $this->db->where('id_parent', $id_parent);
        $this->db->where('type', $type);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getAttr1($id_parent,$type = 1,$status = 1)
    {
        $this->db->where('id_parent', $id_parent);
        $this->db->where('type', $type);
        $this->db->where('status', $status);
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
    
    public function deleteparent($id_parent)
    {
        $this->db->where('id_parent', $id_parent);
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