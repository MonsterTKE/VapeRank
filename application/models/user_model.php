<?php

class User_model extends CI_Model {

	function __construct() {
      parent::__construct();
    }

        function get_all_submissions($user_id, $limit)
        {
        $query = $this->db->query("SELECT vendors.*, users.username, allowed_vendors.*,categories.*
                                    FROM `vendors`
                                    JOIN `users` ON users.id = vendors.user_id
                                    JOIN `allowed_vendors` ON allowed_vendors.allowed_id = vendors.a_vendor_id
                                    JOIN `categories` ON categories.categories_category_id = vendors.vendors_category_id
                                    WHERE vendors.user_id = $user_id
                                    ORDER BY votes_up DESC
                                    LIMIT $limit, 8;");

        //$query = $this->db->query("SELECT vendors.*, users.username FROM `vendors` JOIN `users` ON users.id = vendors.user_id WHERE vendors.user_id = $user_id ORDER BY votes_up DESC LIMIT $limit, 10;");
        return $query->result();
    	}

    	function edit_submission($user_data_id, $id)
    	{
        $data = array(
        'name' => $this->input->post('vendor_name'),
        'description' => $this->input->post('description'),
        'category' => $this->input->post('category'),
        'modified' => date('Y-m-d H:i:s'),
        'user_id' => $user_data_id
        );
        $this->db->where('id', $id);
        return $this->db->update('vendors', $data);
    	}

    	function count_all_submissions($user)
    	{
    		return $this->db
    		->where('user_id', $user)
    		->count_all_results('vendors');
    	}
}