<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_contact_model extends CI_Model {
	private $_table  =    "tbl_stores_contact";
	public function __construct(){
        parent::__construct();
    }

    public function getList1($id_store,$active = 0)
    {
        $this->db->where('id_store', $id_store);
        $this->db->where('active', $active);
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getList($id_store)
    {
        $this->db->where('id_store', $id_store);
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getListLimit($id_store,$start,$limit)
    {
        $this->db->where('id_store', $id_store);
        $this->db->limit($limit,$start);
        $this->db->order_by('date_added', 'DESC');
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
