<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_images_model extends CI_Model {

    private $_table  =   'tbl_products_images';
	public function __construct(){
         parent::__construct();
    }

    public function get()
    {
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getImage($id_parent)
    {
        $this->db->where('id_parent', $id_parent);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getImage1($id_parent,$status = 1)
    {
        $this->db->where('id_parent', $id_parent);
        $this->db->where('status', $status);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getId($id)
    {
        $this->db->where('id', $id);
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