<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends CI_Model {

  private  $_table  =   "tbl_users";
	public function __construct(){
         parent::__construct();
     }

     //Lấy toàn bộ danh sách các menu từ bảng tbl_menu_config
     public function getALLUser()
     {
        $this->db->order_by('last_modified', 'DESC');
     	  $query = $this->db->get($this->_table);
        	return $query->result();
     }

     public function getUserLogin($username, $password, $code)
     {
          $this->db->select('id,name,username,password,avatar,group,status,statuscp');
          $this->db->from($this->_table);
          $this->db->where('username', $username);
          $this->db->where('md5_pass', md5($password));
          $this->db->where('code', $code);
          $this->db->where('group', '1');
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

    public function getUserLoginLevel($username, $password, $code)
     {
          $this->db->select('id,name,username,password,avatar,group,status,statuscp');
          $this->db->from($this->_table);
          $this->db->where('username', $username);
          $this->db->where('md5_pass', md5($password));
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

     public function getUserById($id)
     {
          $this->db->where('id', $id);
          $this->db->limit(1);
          $query  =  $this->db->get($this->_table);
          if($query->num_rows() > 0)
          {
            return $query->result();
          }
          else
          {
            return FALSE;
          }
     }

     public function getUserName($username)
     {
          $this->db->select('id,name,username,password,avatar,group');
          $this->db->from($this->_table);
          $this->db->where('username', $username);
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

     public function getUserByCodeOrName($key)
     {
        $this->db->order_by('last_modified', 'DESC');
        $condition  =   "`statuscp` = 1 AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";        
        $this->db->where($condition);
        $query = $this->db->get($this->_table);
        return $query->result();
     }     

     public function insertUser($arrayName)
     {
        if($this->db->insert($this->_table,$arrayName))
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

     public function getIdForUser()
     {
        $query = $this->db->query("SELECT MAX(id) + 1 as id FROM `".$this->_table."` LIMIT 1");
        return $query->result();
     }
}
?>