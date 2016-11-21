<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Store_images_model extends CI_Model {

    private $_table  =   'tbl_stores_images';
	public function __construct(){
         parent::__construct();
    }
    

    public function getImage($id_store,$type = 0, $statuscp = 1)
    {
        $this->db->where('id_store', $id_store);
        $this->db->where('type', $type);
        $this->db->where('statuscp', $statuscp);
        $this->db->order_by('last_modified', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getImage1($id_store,$type = 0, $statuscp = 1,$status = 1)
    {
        $this->db->where('id_store', $id_store);
        $this->db->where('type', $type);
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        $this->db->order_by('last_modified', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getImageById($id)
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