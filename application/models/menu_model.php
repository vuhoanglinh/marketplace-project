<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu_model extends CI_Model {

    private $_table  =    "tbl_menu_config";
	public function __construct(){
        parent::__construct();
    }

    //Lấy toàn bộ danh sách các menu từ bảng tbl_menu_config
    public function getALLMenu($status)
    {
        $this->db->where('statuscp', $status);
        $this->db->order_by("sort,last_modified", "desc");
     	$query = $this->db->get($this->_table);
     	return $query->result();
    }

    public function getMenu($status,$start,$limit)
    {
        $this->db->where('statuscp', $status);
        $this->db->order_by("sort,last_modified", "desc");
        $this->db->limit($limit,$start);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getMenuByCodeOrName($key,$status)
    {
        $condition  =   "`statuscp` = $status AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";        
        $this->db->order_by("sort,last_modified", "desc");
        //$this->db->where('statuscp', '1');
        $this->db->where($condition);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getMenuCN($key,$status,$start,$limit)
    {
        $condition  =   "`statuscp` = $status AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";        
        $this->db->order_by("sort,last_modified", "desc");
        $this->db->where($condition);        
        $this->db->limit($limit,$start);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getMenuTrashByCodeOrName($key)
    {
        $condition  =   "`statuscp` = 0 AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";
        
        //$this->db->like('code', $key);
        //$this->db->or_like('name', $key);   

        $this->db->order_by("sort,last_modified", "desc");
        //$this->db->where('statuscp', '1');
        $this->db->where($condition);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getMenu1($id_parent = 0,$status = 1,$statuscp = 1)
    {        
        $this->db->where('id_parent', $id_parent);
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        $this->db->order_by("sort");
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getParentMenu()
    {        
        $this->db->where('id_parent', '0');
        $this->db->where('statuscp', '1');
        $this->db->order_by("sort", "desc");
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getChildrenMenu($id_parent)
    {
        
        $this->db->where('id_parent', $id_parent);
        $this->db->where('statuscp', '1');
        $this->db->order_by("sort", "desc");
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getMenuByid($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->_table);
        $this->db->limit(1);
        if($query->num_rows() > 0) 
        {
            return $query->result();
        }
        else 
        {
            return FALSE;
        }
    }

    public function getMenuByCode($code)
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

    public function getMenuByCode1($code)
    {
        $this->db->where('code', $code);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getMenuByName($name)
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

    public function getMenuAnotherCode($id, $code)
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

    public function getMenuAnotherName($id, $name)
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


    public function insertMenu($arrayName)
    { 
        if($this->db->insert($this->_table,$arrayName)){
            return TRUE;
        }        
        else {
            return FALSE;
        }
    }

    public function updateMenu($arrayName, $id)
    {
        $this->db->where('id', $id);
        if($this->db->update($this->_table, $arrayName)){
            return TRUE;
        }        
        else {
            return FALSE;
        }
    }

    public function getMenuTrash()
    {
        $this->db->where('statuscp', '0');
        $this->db->order_by("sort", "desc");
        $query = $this->db->get($this->_table);
        return $query->result();
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
?>