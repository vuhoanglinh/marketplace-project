<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Store_model extends CI_Model {

    private $_table  =   'tbl_stores';
	public function __construct(){
         parent::__construct();
    }

    public function getALLStore($statuscp = 1, $status = 1)
    {
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);        
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getLimitStore($start,$limit,$statuscp = 1, $status = 1)
    {
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);        
        $this->db->limit($limit,$start);
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getStore()
    {
    	$this->db->order_by('last_modified', 'DESC');
    	$this->db->where('statuscp', '1');
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();
    }

    public function getStore1($statuscp = 1)
    {
        $this->db->order_by('last_modified', 'DESC');
        $this->db->where('statuscp', $statuscp);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getStoreLimit($start,$limit,$statuscp = 1)
    {
        $this->db->order_by('last_modified', 'DESC');
        $this->db->where('statuscp', $statuscp);
        $this->db->limit($limit,$start);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getStoreBykey($key,$statuscp = 1)
    {
        $this->db->order_by('last_modified', 'DESC');
        $condition  =   "`statuscp` = $statuscp AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";
        $this->db->where($condition);
        $query      =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getStoreBykeyLimit($key,$start,$limit,$statuscp = 1)
    {
        $this->db->order_by('last_modified', 'DESC');
        $condition  =   "`statuscp` = $statuscp AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";
        $this->db->where($condition);
        $this->db->limit($limit,$start);
        $query      =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getStoreTrash()
    {
    	$this->db->order_by('last_modified', 'DESC');
    	$this->db->where('statuscp', '0');
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();
    }

    public function getStoreByGroup($id_group,$statuscp = 1)
    {
    	$this->db->order_by('last_modified', 'DESC');
    	$this->db->where('id_group', $id_group);
    	$this->db->where('statuscp', $statuscp);
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();
    }

    public function getStoreByGroupLimit($id_group,$start,$limit,$statuscp = 1)
    {
        $this->db->order_by('last_modified', 'DESC');
        $this->db->where('id_group', $id_group);
        $this->db->where('statuscp', $statuscp);
        $this->db->limit($limit,$start);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getStoreByGroupCodeName($id_group,$key,$statuscp = 1)
    {
    	$this->db->order_by('last_modified', 'DESC');
    	$this->db->where('id_group', $id_group);
    	$condition  =   "`statuscp` = $statuscp AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";
        $this->db->where($condition);
    	$query 		=	$this->db->get($this->_table);
    	return $query->result();
    }

    public function getStoreByGroupCodeNameLimit($id_group,$key,$start,$limit,$statuscp = 1)
    {
        $this->db->order_by('last_modified', 'DESC');
        $this->db->where('id_group', $id_group);
        $condition  =   "`statuscp` = $statuscp AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";
        $this->db->where($condition);
        $this->db->limit($limit,$start);
        $query      =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getStoreTrashByGroup($id_group)
    {
    	$this->db->order_by('last_modified', 'DESC');
    	$this->db->where('id_group', $id_group);
    	$this->db->where('statuscp', '0');
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();
    }

    public function getStoreTrashByGroupCodeName($id_group,$key)
    {
    	$this->db->order_by('last_modified', 'DESC');
    	$this->db->where('id_group', $id_group);
    	$condition  =   "`statuscp` = 0 AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";
        $this->db->where($condition);
    	$query 		=	$this->db->get($this->_table);
    	return $query->result();
    }

    public function getStoreById($id)
    {
    	$this->db->where('id', $id);
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();
    }

    public function getStoreByThemes($themes)
    {
        $this->db->where('themes', $themes);
        $query  =   $this->db->get($this->_table);
        return $query->num_rows();
    }

    public function getStoreByName($name)
    {
    	$this->db->where('name', $name);
    	$query 	=	$this->db->get($this->_table);
    	if($query->num_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function getStoreAnotherName($id,$name)
    {
        $this->db->where('id !=',$id);
        $this->db->where('name', $name);
        $query  =   $this->db->get($this->_table);
        if($query->num_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function getStoreByUsername($username)
    {
        $this->db->where('username', $username);
        $query  =   $this->db->get($this->_table);
        if($query->num_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function getStoreATUsername($id,$username)
    {
        $this->db->where('id !=',$id);
        $this->db->where('username', $username);
        $query  =   $this->db->get($this->_table);
        if($query->num_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function getStoreByTitle($title)
    {
        $this->db->where('title', $title);
        $query  =   $this->db->get($this->_table);
        if($query->num_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function getUserLogin($username,$password,$code)
    {
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $this->db->where('code', $code);
        $this->db->where('statuscp', '1');
        $this->db->limit(1);
        $query = $this->db->get($this->_table);
          if($query->num_rows() == 1)
          {
               return $query->result();
          }
          else
          {
               return false;
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

    public function deleteByGroup($id_group)
    {
        $this->db->where('id_group', $id_group);
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

    public function updatestatusByGroup($id_group,$status)
    {
        $this->db->where('id_group', $id_group);
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

    public function movetrashByGroup($id_group)
    {
        $this->db->where('id_group', $id_group);
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

    public function outtrashByGroup($id_group)
    {
        $this->db->where('id', $id_group);
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