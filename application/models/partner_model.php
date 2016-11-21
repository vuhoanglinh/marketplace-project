<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Partner_model extends CI_Model {

    private $_table  =   "tbl_partner";
	public function __construct(){
        parent::__construct();
    }

    public function getPartner($statuscp = 1,$status = 1)
    {
        $this->db->order_by('last_modified', 'DESC');
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getPartner1($statuscp = 1)
    {
        $this->db->order_by('last_modified', 'DESC');
        $this->db->where('statuscp', $statuscp);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getPartnerLimit($start,$limit,$statuscp = 1)
    {
        $this->db->order_by('last_modified', 'DESC');
        $this->db->where('statuscp', $statuscp);
        $this->db->limit($limit,$start);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getPartnerTrash()
    {
    	$this->db->order_by('last_modified', 'DESC');
        $this->db->where('statuscp', '0');
     	$query = $this->db->get($this->_table);
     	return $query->result();
    }

    public function getPartnerByCodeOrName($key,$statuscp = 1)
    {
        $condition  =   "`statuscp` = $statuscp AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";       
        $this->db->order_by("last_modified", "desc");
        $this->db->where($condition);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getPartnerByCodeOrNameLimit($key,$start,$limit,$statuscp = 1)
    {
        $condition  =   "`statuscp` = $statuscp AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";       
        $this->db->order_by("last_modified", "desc");
        $this->db->where($condition);
        $this->db->limit($limit,$start);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getPartnerTrashByCodeOrName($key)
    {
        $condition  =   "`statuscp` = 0 AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";
        $this->db->order_by("last_modified", "desc");
        $this->db->where($condition);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getPartnerByid($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->_table);
        $this->db->limit(1);
        return $query->result();        
    }

    public function getPartnerByCode($code)
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

    public function getPartnerByName($name)
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

    public function getPartnerAnotherCode($id, $code)
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

    public function getPartnerAnotherName($id, $name)
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