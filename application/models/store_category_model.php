<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_category_model extends CI_Model {
	private $_table  =    "tbl_stores_category";
	public function __construct(){
        parent::__construct();
    }

    public function getCategory($id_store,$id_parent = 0,$statuscp = 1)
    {
        $this->db->where('id_store',$id_store);
        $this->db->where('statuscp', $statuscp);
        $this->db->where('id_parent',$id_parent);
        $query = $this->db->get($this->_table);
        return $query->result();  
    }

    public function getCategoryLimit($id_store,$start,$limit,$id_parent = 0,$statuscp = 1)
    {
        $this->db->where('id_store',$id_store);
        $this->db->where('statuscp', $statuscp);
        $this->db->where('id_parent',$id_parent);
        $this->db->limit($limit,$start);
        $query = $this->db->get($this->_table);
        return $query->result();  
    }

    public function getParent($id_store,$statuscp = 1,$status = 1)
    {
        $this->db->where('id_store',$id_store);
         $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        $this->db->where('id_parent','0');
        $query = $this->db->get($this->_table);
        return $query->result();  
    }

    public function getChild($id_parent,$statuscp = 1,$status = 1)
    {
        $this->db->where('id_parent',$id_parent);
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getLikeName($id_store,$key,$id_parent = 0,$statuscp = 1)
    {        
        $this->db->where('id_store',$id_store);
        $this->db->where('id_parent',$id_parent);
        $this->db->order_by('last_modified', 'DESC');
        $condition  =   "`statuscp` = $statuscp AND `id_parent` = 0 AND `name` LIKE '%$key%'";
        $this->db->where($condition);
        $query  =   $this->db->get($this->_table);
        return $query->result();        
    }

    public function getLikeNameLimit($id_store,$key,$start,$limit,$id_parent = 0,$statuscp = 1)
    {        
        $this->db->where('id_store',$id_store);
        $this->db->where('id_parent',$id_parent);
        $this->db->order_by('last_modified', 'DESC');
        $condition  =   "`statuscp` = $statuscp AND `id_parent` = 0 AND `name` LIKE '%$key%'";
        $this->db->where($condition);
        $this->db->limit($limit,$start);
        $query  =   $this->db->get($this->_table);
        return $query->result();        
    }

    public function getParentLikeName($id_store,$key)
    {        
        $this->db->where('id_store',$id_store);
        $this->db->order_by('last_modified', 'DESC');
        $condition  =   "`statuscp` = 1 AND `id_parent` = 0 AND `name` LIKE '%$key%'";
        $this->db->where($condition);
        $query  =   $this->db->get($this->_table);
        return $query->result();        
    }

    public function getChildrenLikeName($key,$id_parent)
    {        
        $this->db->order_by('last_modified', 'DESC');
        $condition  =   "`statuscp` = 1 AND `id_parent` = $id_parent AND `name` LIKE '%$key%'";
        $this->db->where($condition);
        $query  =   $this->db->get($this->_table);
        return $query->result();        
    }

    public function getCategoryById($id)
    {
        $this->db->where('id', $id);
        $this->db->order_by("sort", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getParentByName($id_store,$name)
    {        
        $this->db->where('id_store',$id_store);
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

    public function getByName($name,$id_parent)
    {        
        $this->db->where('id_parent', $id_parent);
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

    public function getAnotherByName($id,$name,$id_parent)
    {        
        $this->db->where('id !=',$id);
        $this->db->where('id_parent', $id_parent);
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

    public function getParentByTitle($title,$id_store)
    {        
        $this->db->where('id_store',$id_store);
        $this->db->where('title', $title);
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

    public function getByTitle($title,$id_parent)
    {
        $this->db->where('id_parent', $id_parent);
        $this->db->where('title', $title);
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

    public function getAnotherByTitle($id,$title,$id_parent)
    {        
        $this->db->where('id !=',$id);
        $this->db->where('id_parent', $id_parent);
        $this->db->where('title', $title);
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

    public function updateParent($arrayName, $id_parent)
    {
        $this->db->where('id_parent', $id_parent);
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
            if($this->getCategoryById($id))
            {
                $query  =   $this->getCategoryById($id);
                foreach ($query as $rows) {
                    $id_parent  =   $rows->id_parent;
                }
                if($id_parent == 0)
                {
                    $this->db->where('id_parent',$id);
                    $this->db->update($this->_table,$arrayName);
                }
            }
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
            $query  =   $this->getCategoryById($id);
            foreach ($query as $rows) {
                $id_parent  =   $rows->id_parent;
            }
            if($id_parent == 0)
            {
                $this->db->where('id_parent',$id);
                $this->db->update($this->_table,$arrayName);
            }
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
            $query  =   $this->getCategoryById($id);
            foreach ($query as $rows) {
                $id_parent  =   $rows->id_parent;
            }
            if($id_parent == 0)
            {
                $this->db->where('id_parent',$id);
                $this->db->update($this->_table,$arrayName);
            }
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function delete($id)
    {
        if($this->getCategoryById($id))
        {
            $query  =   $this->getCategoryById($id);
            foreach ($query as $rows) {
                $id_parent  =   $rows->id_parent;
            }
            if($id_parent == 0)
            {
                $this->db->where('id_parent',$id);
                $this->db->delete($this->_table);
            }
        }

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