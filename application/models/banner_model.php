<?php

class Banner_model extends CI_Model {

	function __construct() {
      parent::__construct();
    }

    function get_banner($user_id, $juice_id) {

        if ($user_id == 0 || $juice_id == 0)
        {
        	show_404();
        }
        else
        {
        $query = $this->db->query("SELECT banners.*, users.username, vendors.name,votes_up,votes_down,vendor_name,allowed_vendors.*
        							FROM `banners`
        							JOIN `users` ON users.id = banners.b_user_id
        							JOIN `vendors` ON banners.b_juice_id = vendors.id
                      JOIN `allowed_vendors` ON allowed_vendors.allowed_id = vendors.a_vendor_id
        							WHERE banners.b_user_id = $user_id
        							AND banners.b_juice_id = $juice_id;");
        return $query->result();
    	}
    }

   	function save_banner_data($user_data_id, $juice_id, $quit_date, $cost_day)
   	{
   	$update = $this->get_banner($user_data_id, $juice_id);
   	foreach ($update as $ud)
   		{
   		$b_banner_id =$ud->b_id;
   		}

   	if($update)
   	{
   		    $data = array(
		    'cost_day' => $cost_day,
        'quit_date' => date($quit_date),
        'b_juice_id' => $juice_id,
        'banner_type' => $this->input->post('wrapper_check'),
        'b_modified' => date('Y-m-d H:i:s'),
        'b_user_id' => $user_data_id,
        'b_per_day' => $this->input->post('smokes')
		);
   		$this->db->where('b_id', $b_banner_id);
        return $this->db->update('banners', $data);
   	}
   	else
   	{
        	$data = array(
		    'cost_day' => $cost_day,
        'quit_date' => date($quit_date),
        'b_juice_id' => $juice_id,
        'banner_type' => $this->input->post('wrapper_check'),
        'b_created' => date('Y-m-d H:i:s'),
        'b_user_id' => $user_data_id,
        'b_per_day' => $this->input->post('smokes')
		);
        return $this->db->insert('banners', $data);
    }
	}

    function count_all_banners($user_data_id)
    {
        $query = $this->db->query("SELECT * FROM `banners` WHERE `b_user_id` = $user_data_id;");
        return $query->num_rows();
    }

    function show_all_user_banners($user_data_id)
    {
        $query = $this->db->query("SELECT * FROM `banners` WHERE `b_user_id` = $user_data_id;");
        return $query->result();
    }

    function delete($banner_id)
    {
      $this->db->delete('banners', array('b_id' => $banner_id));
    }
}