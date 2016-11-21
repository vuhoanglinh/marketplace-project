<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Store_themes_model extends CI_Model {

    private $_table  =   'tbl_stores_themes';
	public function __construct(){
         parent::__construct();
    }

    public function getThemesById($id)
    {
    	$this->db->where('id', $id);
        $this->db->limit(1);
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();
    }

    public function getThemesByName($name = "",$id = 0)
    {
        if($id != 0) {
            $this->db->where('id !=', $id);    
        }
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

    public function getThemesByFolder($folder = "",$id = 0)
    {
        if($id != 0) {
            $this->db->where('id !=', $id);    
        }
        $this->db->where('folder', $folder);
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

    public function getThemes($statuscp = 1)
    {
    	$this->db->order_by('last_modified', 'DESC');
    	$this->db->where('statuscp', $statuscp);
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();
    }

    public function getThemesLimit($start,$limit,$statuscp = 1)
    {
    	$this->db->order_by('last_modified', 'DESC');
    	$this->db->where('statuscp', $statuscp);
    	$this->db->limit($limit,$start);
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();
    }

    public function getThemesLikeName($key,$statuscp = 1)
    {
        $this->db->order_by('last_modified', 'DESC');
        $this->db->where('statuscp', $statuscp);
        $this->db->like('name',$key);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getThemesLikeNameLimit($key,$start,$limit,$statuscp = 1)
    {
        $this->db->order_by('last_modified', 'DESC');
        $this->db->where('statuscp', $statuscp);
        $this->db->like('name',$key);
        $this->db->limit($limit,$start);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getThemes1($statuscp = 1,$status = 1)
    {
    	$this->db->order_by('date_added', 'DESC');
    	$this->db->where('status', $status);
    	$this->db->where('statuscp', $statuscp);
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();
    }

    public function getThemes1Limit($start,$limit,$statuscp = 1,$status = 1)
    {
    	$this->db->order_by('date_added', 'DESC');
    	$this->db->where('status', $status);
    	$this->db->where('statuscp', $statuscp);
    	$this->db->limit($limit,$start);
    	$query 	=	$this->db->get($this->_table);
    	return $query->result();
    }

    public function getThemes1LikeName($key,$statuscp = 1,$status = 1)
    {
        $this->db->order_by('date_added', 'DESC');
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        $this->db->like('name',$key);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getThemes1LikeNameLimit($key,$start,$limit,$statuscp = 1,$status = 1)
    {
        $this->db->order_by('date_added', 'DESC');
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        $this->db->like('name',$key);
        $this->db->limit($limit,$start);
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
}