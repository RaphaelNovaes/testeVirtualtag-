<?php

class Usuarios extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_user(){
    	$this->db->insert('users', $this->input->post());
    	$insert_id = $this->db->insert_id();

    	return array($insert_id, $this->input->post('nome'));
    }

    public function get_user($id){
    	$this->db->where('id_user', $id);
    	$query = $this->db->get('users');

    	$row = $query->row_array();

    	if($row){
    		return $row;
    	}else
    		return false;
    }

    public function valid_user($user, $pass){
    	$this->db->where('login', $user);
    	$this->db->where('pass', $pass);
    	$query = $this->db->get('users');

    	$row = $query->row_array();

    	if($row){
    		return $row;
    	}else
    		return false;
    }

    public function change_pass($login, $pass){
        $this->db->set('pass', "'$pass'", false);
        $this->db->where('login', "$login");
        $this->db->update('users');
        return true;
    }

    public function valid_login($user){
        $this->db->select('id_user, nome');
        $this->db->where('login', $user);
        $query = $this->db->get('users');

        $row = $query->row_array();

        if($row){
            return true;
        }else
            return false;
    }
}

?>