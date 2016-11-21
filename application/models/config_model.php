<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Config_model extends CI_Model {

    private $_table  =   'tbl_config';
	public function __construct(){
         parent::__construct();
    }

    public function getSeo($code)
    {
    	$this->db->select('name,keyword,description,extention');
        $this->db->from($this->_table);
        $this->db->where('type', '1');
        $this->db->where('code', $code);
        $this->db->limit(1);          
        $query = $this->db->get();
        if($query->num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }

    public function getSystem()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('type', '0');
        $this->db->where('code', 'web');
        $this->db->limit(1);          
        $query = $this->db->get();
        if($query->num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }

    public function getSupport()
    {
        $this->db->select('extention');
        $this->db->from($this->_table);
        $this->db->where('type', '2');
        $this->db->where('code', 'dt');
        $this->db->limit(1);          
        $query = $this->db->get();
        return $query->result();
    }

    public function uploadSeo($code,$name,$keyword,$description,$extention)
    {
        $datestring         =   "%Y/%m/%d %h:%i:%s";
        $last_modified      =   mdate($datestring, time() - 60*60);

        $arrayName          = array(
            'name'          => $name, 
            'keyword'       => $keyword, 
            'description'   => $description, 
            'extention'     => $extention,
            'last_modified' => $last_modified
        );
        $this->db->where('type', '1');
        $this->db->where('code', $code);
        if($this->db->update($this->_table,$arrayName)){
            return TRUE;
        }        
        else {
            return FALSE;
        }
    }

    public function uploadSystem($arrayName)
    { 
        
        $this->db->where('type', '0');
        $this->db->where('code', 'web');
        if($this->db->update($this->_table,$arrayName)){
            return TRUE;
        }        
        else {
            return FALSE;
        }
    }

    public function uploadSuport($arrayName)
    { 
        
        $this->db->where('type', '2');
        $this->db->where('code', 'dt');
        if($this->db->update($this->_table,$arrayName)){
            return TRUE;
        }        
        else {
            return FALSE;
        }
    }

}
?>