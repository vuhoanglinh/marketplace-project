<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_detail_model extends CI_Model {
	private $_table  =    "tbl_news_detail";
	public function __construct(){
        parent::__construct();
    }

    public function getNews($id_category = "",$code="",$home = 0,$key = "",$statuscp = 1, $status = 1)
    {        
        if($id_category != "")
        {
            $this->db->where('id_category', $id_category);
        }
        if($code != "")
        {
            $this->db->where('code', $code);
        }
        if($key != "") {
            $this->db->like('name', $key);
        }
        $this->db->where('home',$home);
        $this->db->where('statuscp',$statuscp);
        $this->db->where('status',$status);
        $this->db->order_by('date_added', 'desc');
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getNewsLimit($id_category = "",$code = "",$home = 0,$start,$limit,$key = "",$statuscp = 1, $status = 1)
    {   
        if($id_category != "")
        {
            $this->db->where('id_category', $id_category);
        }
        if($code != "")
        {
            $this->db->where('code', $code);
        }
        if($key != "") {
            $this->db->like('name', $key);
        }
        $this->db->where('home',$home);
        $this->db->where('statuscp',$statuscp);
        $this->db->where('status',$status);
        $this->db->order_by('date_added', 'desc');
        $this->db->limit($limit,$start);
        $query = $this->db->get($this->_table);        
        return $query->result();
    }

    public function getNews2($id_category = "",$key = "",$statuscp = 1, $status = 1)
    {   
        if($id_category != "")
        {
            $this->db->where('id_category', $id_category);
        }
        
        if($key != "") {
            $this->db->like('name', $key);
        }
        
        $this->db->where('statuscp',$statuscp);
        $this->db->where('status',$status);
        $this->db->order_by('date_added', 'desc');
        $query = $this->db->get($this->_table);
        return $query->result();
    }
    public function getNewsLimit2($id_category = "",$start,$limit,$key = "",$statuscp = 1, $status = 1)
    {   
        if($id_category != "")
        {
            $this->db->where('id_category', $id_category);
        }
        
        if($key != "") {
            $this->db->like('name', $key);
        }
        $this->db->where('statuscp',$statuscp);
        $this->db->where('status',$status);
        $this->db->order_by('date_added', 'desc');
        $this->db->limit($limit,$start);
        $query = $this->db->get($this->_table);        
        return $query->result();
    }

    public function getNews1($id_category = "",$key = "",$statuscp = 1)
    {        
        if($id_category != "")
        {
            $this->db->where('id_category', $id_category);
        }
        if($key != "") {
            $this->db->like('name', $key);
        }
        $this->db->where('statuscp',$statuscp);
        $this->db->order_by('date_added', 'desc');
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getNews1Limit($id_category = "",$start,$limit,$key = "",$statuscp = 1)
    {        
        if($id_category != "")
        {
            $this->db->where('id_category', $id_category);
        }
        if($key != "") {
            $this->db->like('name', $key);
        }
        $this->db->limit($limit,$start);
        $this->db->where('statuscp',$statuscp);
        $this->db->order_by('date_added', 'desc');
        $query = $this->db->get($this->_table);
        $this->db->limit($limit,$start);
        return $query->result();
    }

    public function getNewsByID($id = "")
    {        
        $this->db->where('id', $id);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getNewsByName($name = "",$id_category,$id = 0)
    {
        $bool = FALSE;
        if($id != 0){
            $this->db->where('id !=', $id);
        }
        $this->db->where('name', $name);
        $this->db->where('id_category', $id_category);
        $query = $this->db->get($this->_table);
        if($query->num_rows() > 0)
        {
            $bool = TRUE;
        }
        return $bool;
    }

    public function getNewsByTitle($title = "",$id_category,$id = 0)
    {
        $bool = FALSE;
        if($id != 0){
            $this->db->where('id !=', $id);
        }
        $this->db->where('title', $title);
        $this->db->where('id_category', $id_category);
        $query = $this->db->get($this->_table);
        if($query->num_rows() > 0)
        {
            $bool = TRUE;
        }
        return $bool;
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