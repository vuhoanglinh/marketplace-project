<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Emailcategory_model extends CI_Model {

    private $_table  =    'tbl_email_category';
	public function __construct(){
        parent::__construct();
    }

    public function getCategory()
    {
    	$this->db->order_by('last_modified', 'DESC');
    	$this->db->where('statuscp', '1');
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();    	
    }

    public function getCategoryTrash()
    {
        $this->db->order_by('last_modified', 'DESC');
        $this->db->where('statuscp', '0');
        $query  =   $this->db->get($this->_table);
        return $query->result();        
    }

    public function getCategoryByCodeOrName($key)
    {
    	$this->db->order_by('last_modified', 'DESC');
    	$condition  =   "`statuscp` = 1 AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";        
        $this->db->where($condition);
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();    	
    }

    public function getCategoryTrashByCodeOrName($key)
    {
        $this->db->order_by('last_modified', 'DESC');
        $condition  =   "`statuscp` = 0 AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";        
        $this->db->where($condition);
        $query  =   $this->db->get($this->_table);
        return $query->result();        
    }

    public function getEmailctByCode($code)
    {
        $this->db->where('code', $code);
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

    public function getEmailctById($id)
    {
        $this->db->where('id', $id);
        $this->db->limit(1);
        $query = $this->db->get($this->_table);
        return $query->result();        
    }

    public function getEmailctByName($name)
    {
        $this->db->where('name', $name);
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

    public function getEmailctAnotherCode($id, $code)
    {
        $this->db->where('id !=', $id);
        $this->db->where('code', $code);
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

    public function getEmailctAnotherName($id, $name)
    {
        $this->db->where('id !=', $id);
        $this->db->where('name', $name);
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

    public function insertEmailCategory($arrayName)
    { 
        if($this->db->insert($this->_table,$arrayName)){
            return TRUE;
        }        
        else {
            return FALSE;
        }
    }

    public function updateEmailCategory($arrayName, $id)
    {
        $this->db->where('id', $id);
        if($this->db->update($this->_table, $arrayName)){
            return TRUE;
        }        
        else {
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
?>