<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_model extends CI_Model {

    private $_table  =   'tbl_products';
	public function __construct(){
         parent::__construct();
    }

    public function getHomeList($start = 0,$limit = 0,$id_store = 0,$id_store_category = 0,$id_category = 0,$key = "",$statuscp = 1,$status = 1)
    {
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        $this->db->where('home', '1');
        $this->db->where('active', '1');
        

        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }

        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }
        if($limit != 0) {
            $this->db->limit($limit,$start);
        }
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getFutureList($id_store = 0,$id_store_category = 0,$id_category = 0,$key = "",$statuscp = 1,$status = 1)
    {
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }

        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getFutureListLimit($id_store = 0,$start,$limit,$id_store_category = 0,$id_category = 0,$key = "",$statuscp = 1,$status = 1)
    {
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }
        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }

        $this->db->limit($limit,$start);
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getListOld($id_store = 0,$id_store_category = 0,$id_category = 0,$key = "",$statuscp = 1,$status = 1)
    {        
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }

        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }

        $this->db->where('statuscp', $statuscp);
        $this->db->order_by('date_added');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getListOldLimit($id_store = 0,$start,$limit,$id_store_category = 0,$id_category = 0,$key = "",$statuscp = 1,$status = 1)
    {
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }

        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }

        $this->db->limit($limit,$start);
        $this->db->order_by('date_added');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getMostViewList($id_store = 0,$id_store_category = 0,$id_category = 0,$key = "",$statuscp = 1,$status = 1)
    {
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }

        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }

        $this->db->order_by('view', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getMostViewListLimit($id_store = 0,$start,$limit,$id_store_category = 0,$id_category = 0,$key = "",$statuscp = 1,$status = 1)
    {
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category_parent);
        }

        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }

        $this->db->order_by('view', 'DESC');
        $this->db->limit($limit,$start);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getLitteViewList($id_store = 0,$id_store_category = 0,$id_category = 0,$key = "",$statuscp = 1,$status = 1)
    {
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }

        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }

        $this->db->order_by('view');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getLitteViewListLimit($id_store = 0,$start,$limit,$id_store_category = 0,$id_category = 0,$key = "",$statuscp = 1,$status = 1)
    {
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }

        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }

        $this->db->order_by('view');
        $this->db->limit($limit,$start);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getHighPrice($id_store = 0,$id_store_category = 0,$id_category = 0,$key = "",$statuscp = 1,$status = 1)
    {
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }

        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }

        $this->db->order_by('s_price', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getHighPriceLimit($id_store = 0,$start,$limit,$id_store_category = 0,$id_category = 0,$key = "",$statuscp = 1,$status = 1)
    {
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }

        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }

        $this->db->order_by('s_price', 'DESC');
        $this->db->limit($limit,$start);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getLowPrice($id_store = 0,$id_store_category = 0,$id_category = 0,$key = "",$statuscp = 1,$status = 1)
    {
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }

        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }

        $this->db->order_by('s_price');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getLowPriceLimit($id_store = 0,$start,$limit,$id_store_category = 0,$id_category = 0,$key = "",$statuscp = 1,$status = 1)
    {
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }

        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }
        
        $this->db->order_by('s_price');
        $this->db->limit($limit,$start);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getHot($id_store = 0,$id_store_category = 0,$id_category = 0,$key = "",$type = 2,$statuscp = 1,$status = 1)
    {
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        $this->db->where('type', $type);
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }

        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }

        $this->db->order_by('last_modified','desc');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getHotLimit($id_store = 0,$start,$limit,$id_store_category = 0,$id_category = 0,$key = "",$type = 2,$statuscp = 1,$status = 1)
    {        
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        $this->db->where('type', $type);
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }

        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }
        
        $this->db->order_by('last_modified','desc');
        $this->db->limit($limit,$start);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getSale($id_store = 0,$id_store_category = 0,$id_category = 0,$key = "",$statuscp = 1,$status = 1)
    {
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }

        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }
        $this->db->order_by('s_price','desc');
        $this->db->order_by('(s_price / price) - 1','desc');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getSaleLimit($id_store = 0,$start,$limit,$id_store_category = 0,$id_category = 0,$key = "",$statuscp = 1,$status = 1)
    {
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }

        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }
        $this->db->order_by('(s_price / price) - 1');
        $this->db->limit($limit,$start);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getNotActive($id_store = 0,$id_store_category = 0,$id_category = 0,$key = "",$active = 0,$statuscp = 1,$status = 1)
    {
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        $this->db->where('active', $active);
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }

        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }

        $this->db->order_by('date_added','desc');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getNotActiveLimit($id_store = 0,$start,$limit,$id_store_category = 0,$id_category = 0,$key = "",$active = 0,$statuscp = 1,$status = 1)
    {        
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        $this->db->where('active', $active);
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }

        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }
        
        $this->db->order_by('date_added','desc');
        $this->db->limit($limit,$start);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getActive($type = 0,$id_store = 0,$id_store_category = 0,$id_category = 0,$key = "",$active = 1,$statuscp = 1,$status = 1)
    {
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        $this->db->where('active', $active);
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }

        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }
        switch ($type) {
            case 0:
                $this->db->order_by('date_added', 'DESC'); // Get future actived product
                break;
            case 1:
                $this->db->order_by('date_added'); // Get olded actived product
                break;
            case 2:
                $this->db->order_by('view', 'DESC'); // Get mostview actived product
                break;
            case 3:
                $this->db->order_by('view', 'DESC'); // Get lowview actived product
                break;
            case 4:
                $this->db->order_by('s_price', 'DESC'); // Get high price actived product
                break;
            case 5:
                $this->db->order_by('s_price'); // Get low price actived product
                break;
            case 6:
                $this->db->where('type', 2); // Get hot actived product
                break;
            case 7:
                $this->db->where('type', 2); // Get hot actived product
                break;
            case 8:
                $this->db->order_by('(s_price / price) - 1');
                $this->db->order_by('date_added', 'DESC'); // Get future actived product
                break;
            case 9:
                $this->db->order_by('(s_price / price) - 1');
                break;
            default:
                $this->db->order_by('date_added', 'DESC'); // Get future actived product
                break;
        }
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getActiveLimit($type = 0,$id_store = 0,$start,$limit,$id_store_category = 0,$id_category = 0,$key = "",$active = 1,$statuscp = 1,$status = 1)
    {        
        if($id_store != 0){
            $this->db->where('id_store', $id_store);
        }
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        $this->db->where('active', $active);
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }

        if($key != "") {
            $this->db->like('name', $key);
            $this->db->or_like('code', $key);
        }
        
        switch ($type) {
            case 0:
                $this->db->order_by('date_added', 'DESC'); // Get future actived product
                break;
            case 1:
                $this->db->order_by('date_added'); // Get olded actived product
                break;
            case 2:
                $this->db->order_by('view', 'DESC'); // Get mostview actived product
                break;
            case 3:
                $this->db->order_by('view', 'DESC'); // Get lowview actived product
                break;
            case 4:
                $this->db->order_by('s_price', 'DESC'); // Get high price actived product
                break;
            case 5:
                $this->db->order_by('s_price'); // Get low price actived product
                break;
            case 6:
                $this->db->where('type', 2); // Get hot actived product
                break;
            case 7:
                $this->db->where('type', 2); // Get hot actived product
                break;
            case 8:
                $this->db->where('home', 1); 
                $this->db->order_by('date_added', 'DESC'); // Get future actived product
                break;
            case 9:
                $this->db->order_by('(s_price / price) - 1');
                break;
            default:
                $this->db->order_by('date_added', 'DESC'); // Get future actived product
                break;
        }
        $this->db->limit($limit,$start);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getList($id_store,$statuscp = 1)
    {
        $this->db->where('id_store', $id_store);
        $this->db->where('statuscp', $statuscp);
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getListLimit($id_store,$start,$limit,$statuscp = 1)
    {
        $this->db->where('id_store', $id_store);
        $this->db->where('statuscp', $statuscp);
        $this->db->limit($limit,$start);
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getListKey($id_store,$key,$statuscp = 1)
    {
    	$this->db->where('id_store', $id_store);
        $condition  =   "`statuscp` = $statuscp AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";        
        $this->db->order_by("date_added", "desc");
        $this->db->where($condition);    
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getListKeyLimit($id_store,$key,$start,$limit,$statuscp = 1)
    {
    	$this->db->where('id_store', $id_store);
        $condition  =   "`statuscp` = $statuscp AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";        
        $this->db->order_by("date_added", "desc");
        $this->db->where($condition);        
        $this->db->limit($limit,$start);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getLike($id_store,$id_product,$limit,$statuscp = 1,$status = 1)
    {
        
        $this->db->where('id_store', $id_store);
        $this->db->where('id !=', $id_product);
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        $this->db->limit($limit);        
        $this->db->order_by('s_price', 'DESC');
        $query  =   $this->db->get($this->_table);
        
        return $query->result();
    }

    public function getLike2($id_category = 0,$id_store_category = 0,$pmin = 0,$pmax = 0,$limit = 0, $active = 1, $status = 1, $statuscp = 1)
    {
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        $this->db->where('active', $active);
        if($pmin != 0 || $pmax != 0) {
            $condition  =   "s_price >= ".$pmin." AND s_price <= ".$pmax;
            $this->db->where($condition);
        }
        if($id_store_category != 0) {
            $this->db->where('id_store_category',$id_store_category);
            $this->db->or_where('id_store_category_parent',$id_store_category);
        }
        
        if($id_category != 0) {            
            $this->db->where('id_category',$id_category);
            $this->db->or_where('id_category_parent',$id_category);
        }
        $this->db->limit($limit);
        $this->db->order_by('s_price', 'DESC');
        $query  =   $this->db->get($this->_table);        
        return $query->result();
    }

    public function getListByCategory($id_category,$statuscp = 1)
    {
        $this->db->where('id_category', $id_category);
        $this->db->where('statuscp', $statuscp);
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getListLimitByCategory($id_category,$start,$limit,$statuscp = 1)
    {
        $this->db->where('id_category', $id_category);
        $this->db->where('statuscp', $statuscp);
        $this->db->limit($limit,$start);
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getListKeyByCategory($id_category,$key,$statuscp = 1)
    {
    	$this->db->where('id_category', $id_category);
        $condition  =   "`statuscp` = $statuscp AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";        
        $this->db->order_by("date_added", "desc");
        $this->db->where($condition);    
        $this->db->limit($limit,$start);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getListLimitKeyByCategory($id_category,$key,$start,$limit,$statuscp = 1)
    {
    	$this->db->where('id_category', $id_category);
        $condition  =   "`statuscp` = $statuscp AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";        
        $this->db->order_by("date_added", "desc");
        $this->db->where($condition);    
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getListBySTCategory($id_store_category,$statuscp = 1)
    {
        $this->db->where('id_store_category', $id_store_category);
        $this->db->where('statuscp', $statuscp);
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getListBySTCategory1($id_store_category,$statuscp = 1,$status = 1)
    {
        $this->db->where('id_store_category', $id_store_category);
        //$this->db->or_where('id_store_category_parent', $id_store_category);
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getListBySTCategoryPR($id_store_category_parent,$statuscp = 1,$status = 1)
    {
        $this->db->where('id_store_category_parent', $id_store_category_parent);
        $this->db->where('status', $status);
        $this->db->where('statuscp', $statuscp);
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getListLimitBySTCategory($id_store_category,$start,$limit,$statuscp = 1)
    {
        $this->db->where('id_store_category', $id_store_category);
        $this->db->where('statuscp', $statuscp);
        $this->db->limit($limit,$start);
        $this->db->order_by('date_added', 'DESC');
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getListKeyBySTCategory($id_store_category,$key,$statuscp = 1)
    {
    	$this->db->where('id_store_category', $id_store_category);
        $condition  =   "`statuscp` = $statuscp AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";        
        $this->db->order_by("date_added", "desc");
        $this->db->where($condition);    
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getListKeyLimitBySTCategory($id_store_category,$key,$start,$limit,$statuscp = 1)
    {
    	$this->db->where('id_store_category', $id_store_category);
        $condition  =   "`statuscp` = $statuscp AND (`code` LIKE '%$key%' OR `name` LIKE '%$key%')";        
        $this->db->order_by("date_added", "desc");
        $this->db->where($condition);    
        $this->db->limit($limit,$start);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function getListById($id)
    {
        $this->db->where('id', $id);
        $this->db->limit(1);
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getName($name,$id = 0)
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

    public function getTitle($title,$id = 0)
    {
        if($id != 0) {
            $this->db->where('id !=', $id);
        }
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

    public function getId()
    {
        $query = $this->db->query("SELECT MAX(id) + 1 as id FROM `".$this->_table."` LIMIT 1");
        return $query->result();
    }

}