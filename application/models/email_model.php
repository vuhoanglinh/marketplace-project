<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Email_model extends CI_Model {

    private $_table  =   'tbl_email_module';
	public function __construct(){
        parent::__construct();
    }

    public function getEmail()
    {
    	$this->db->order_by('last_modified', 'DESC');
    	$this->db->where('statuscp', '1');
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();    	
    }

    public function getEmailTrash()
    {
        $this->db->order_by('last_modified', 'DESC');
        $this->db->where('statuscp', '0');
        $query  =   $this->db->get($this->_table);
        return $query->result();        
    }

    public function getEmailByCategory($id)
    {
    	$this->db->order_by('last_modified', 'DESC');
    	$this->db->where('statuscp', '1');
    	$this->db->where('id_parent',$id);
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();    	
    }

    public function getEmailTrashByCategory($id)
    {
        $this->db->order_by('last_modified', 'DESC');
        $this->db->where('statuscp', '0');
        $this->db->where('id_parent',$id);
        $query  =   $this->db->get($this->_table);
        return $query->result();        
    }

    public function getEmailByCodeOrName($key,$id)
    {
    	$this->db->order_by('last_modified', 'DESC');
    	$condition  =   "`statuscp` = 1 AND `id_parent` = $id AND (`email` LIKE '%$key%' OR `name` LIKE '%$key%')";
        $this->db->where($condition);
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();    	
    }

    public function getEmailTrashByCodeOrName($key)
    {
        $this->db->order_by('last_modified', 'DESC');
        $condition  =   "`statuscp` = 0 AND (`email` LIKE '%$key%' OR `name` LIKE '%$key%')";
        $this->db->where($condition);
        $query  =   $this->db->get($this->_table);
        return $query->result();        
    }

    public function getById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->_table);
            return $query->result();         
    }

    public function getByEmail($email)
    {
        $this->db->where('email', $email);
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
    
    public function getByName($name)
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

    public function getAnotherEmail($id, $email)
    {
        $this->db->where('id !=', $id);
        $this->db->where('email', $email);
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

    public function getAnotherName($id, $name)
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

    public function deleteByParent($id_parent)
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

    public function updatestatusByParent($id_parent,$status)
    {        
        $this->db->where('id_parent', $id_parent);
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

    public function movetrashByParent($id_parent)
    {
        $this->db->where('id_parent', $id_parent);
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

    public function outtrashParent($id_parent)
    {
        $this->db->where('id_parent', $id_parent);
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

    public function getId()
    {
        $query = $this->db->query("SELECT MAX(id) + 1 as id FROM `".$this->_table."` LIMIT 1");
        return $query->result();
    }
}