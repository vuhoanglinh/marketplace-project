<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Storegroup_model extends CI_Model {

    private $_table     =   'tbl_stores_group';
	public function __construct(){
         parent::__construct();
    }

    public function getStoreGroup($statuscp = 1, $status = 1)
    {
    	$this->db->order_by('last_modified', 'DESC');
        $this->db->where('status', $status);
    	$this->db->where('statuscp', $statuscp);
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();
    }

    public function getStoreGroup1($statuscp = 1)
    {
        $this->db->order_by('last_modified', 'DESC');
        $this->db->where('statuscp', $statuscp);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getStoreGroupLimit($start,$limit,$statuscp = 1)
    {
        $this->db->order_by('last_modified', 'DESC');
        $this->db->where('statuscp', $statuscp);
        $this->db->limit($limit,$start);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getStoreGroupTrash()
    {
    	$this->db->order_by('last_modified', 'DESC');
    	$this->db->where('statuscp', '0');
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();
    }

    public function getStoreGroupById($id)
    {
    	$this->db->order_by('last_modified', 'DESC');
    	$this->db->where('id', $id);
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();
    }

    public function getStoreGroupByCode($code)
    {
    	$this->db->order_by('last_modified', 'DESC');
    	$this->db->where('code', $code);
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();
    }

    public function getStoreGroupByName($name)
    {
    	$this->db->order_by('last_modified', 'DESC');
    	$this->db->where('name', $name);
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();
    }

    public function getStoreGroupAnotherCode($id,$code)
    {
    	$this->db->order_by('last_modified', 'DESC');
    	$this->db->where('id !=', $id);
        $this->db->where('code', $code);
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();
    }

    public function getStoreGroupAnotherName($id,$name)
    {
        $this->db->order_by('last_modified', 'DESC');
        $this->db->where('id !=', $id);
        $this->db->where('name', $name);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getStoreGroupByCodeOrName($key,$statuscp = 1)
    {
    	$this->db->order_by('last_modified', 'DESC');
    	$condition  =   "`statuscp` = $statuscp AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";
        $this->db->where($condition);
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();    	
    }

    public function getStoreGroupByCodeOrNameLimit($key,$start,$limit,$statuscp = 1)
    {
        $this->db->order_by('last_modified', 'DESC');
        $condition  =   "`statuscp` = $statuscp AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";
        $this->db->where($condition);
        $this->db->limit($limit,$start);
        $query  =   $this->db->get($this->_table);
        return $query->result();        
    }

    public function getStoreGroupTrashByCodeOrName($key)
    {
    	$this->db->order_by('last_modified', 'DESC');
    	$condition  =   "`statuscp` = 0 AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";
        $this->db->where($condition);
    	$query 	=	$this->db->get($this->_table);
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

}