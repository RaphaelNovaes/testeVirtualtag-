<?php

class Block_ip extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_ip($ip){
    	$dt = date("Y-m-d H:i:s", time()+120);
    	$this->db->insert('block_ip', array('ip' => $ip, 'dt_allow' => $dt, 'attemps' => 1));
    	$insert_id = $this->db->insert_id();

    	return true;
    }

    public function get_ip($ip){

    	$this->db->where('ip', $ip);
    	$query = $this->db->get('block_ip');

    	$row = $query->row_array();

    	if($row){
    		return $row;
    	}else{
    		$this->insert_ip($ip);
    		return true;
    	}
    }

    public function update_ip($ip){
    	$dt = date("Y-m-d H:i:s", time()+120);
    	$this->db->set('attemps', 'attemps+1', false);
    	$this->db->set('dt_allow', "$dt", true);
    	$this->db->where('ip', "$ip");
    	$this->db->update('block_ip');
    	return true;
    }

    public function delete_ip($ip){
    	$this->db->where('ip', $ip);
    	$this->db->delete('block_ip');
    	return true;
    }
}

?>