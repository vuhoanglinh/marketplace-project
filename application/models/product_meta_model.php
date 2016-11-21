<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_meta_model extends CI_Model {

    private $_table  =   'tbl_products_meta';
	public function __construct(){
         parent::__construct();
    }

    public function getByMeta($id_meta)
    {
        $this->db->where('id_meta', $id_meta);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getByCategory($id_category)
    {
        $this->db->where('id_category', $id_category);
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
        
}