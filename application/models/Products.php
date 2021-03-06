<?php

class Products extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_products($data){
    	$this->db->insert_batch('products', $data);
    	return true;
    }

    public function get_products(){
        $query = $this->db->get('products');

        foreach ($query->result_array() as $row){
                $data[] = $row;
        }

        if($data){
            return $data;
        }else
            return false;
    }

    public function get_last_product(){
        $this->db->select('max(id_product) as last_id');
        $query = $this->db->get('products');

        $data = $query->row_array();

        if($data){
            return $data;
        }else
            return false;
    }

    public function put_product(){
        $data = array_values($this->input->post());
        $set = array(
            'name' => $data[1],
            'pack' => $data[2],
            'soldby' => $data[3],
            'subcategory' => $data[4],
            'category' => $data[5]
        );
        
        $this->db->where('id_product', $data[0]);
        $this->db->update('products', $set);
    }

    public function del_product(){
        $this->db->delete('products', array('id_product' => $this->input->post('id')));
    }

    public function post_product(){
        $data = array_values($this->input->post());
        $new = array(
            'name' => $data[1],
            'pack' => $data[2],
            'soldby' => $data[3],
            'subcategory' => $data[4],
            'category' => $data[5]
        );
        
        $this->db->insert('products', $new);
    }
}

?>