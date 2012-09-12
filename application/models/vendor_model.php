<?php

class Vendor_model extends CI_Model {

	function __construct() {
      parent::__construct();
    }

/* I was a retard when I started building this site, I did not think clearly enough about the function names and such. vendors == juice
and allowed_vendors == vendors. I am too lazy to change now.
*/
    function get_all_vendors($limit, $category) {

        /* we gonna change dis to
    ["id"]=>
    ["name"]=>
    ["a_vendor_id"]=>
    ["vendor_name"]=>
    ["url_link"]=>
    ["url_image"]=>
    ["description"]=>
    ["created"]=>
    ["modified"]=>
    ["user_id"]=>
    ["category"]=>
    ["votes_up"]=>
    ["votes_down"]=>
    ["banned"]=>
    ["username"]=>
    ["allowed_id"]=>
    ["allowed_name"]=>
    ["allowed_url"]=>
    ["allowed_image_url"]=>
    ["allowed_tagline"]=>
    ["allowed_user_id"]=>
    ["allowed_created"]=>
    ["allowed_modified"]=>

*/
        $query = $this->db->query("SELECT vendors.*, users.username, allowed_vendors.*,categories.*
                                    FROM `vendors`
                                    JOIN `users` ON users.id = vendors.user_id
                                    JOIN `allowed_vendors` ON allowed_vendors.allowed_id = vendors.a_vendor_id
                                    JOIN `categories` ON categories.categories_category_id = vendors.vendors_category_id
                                    WHERE `vendors_category_id` = $category
                                    ORDER BY votes_up DESC
                                    LIMIT $limit, 8;");

        //$query = $this->db->query("SELECT vendors.*, users.username FROM `vendors` JOIN `users` ON users.id = vendors.user_id WHERE `category` = $category ORDER BY votes_up DESC LIMIT $limit, 8;");

        return $query->result();
    }


    function get_individual_juice($table, $target_field, $source_data) {
        $query = $this->db->query("SELECT vendors.*, users.username, allowed_vendors.*,categories.*
                                    FROM `vendors`
                                    JOIN `users` ON users.id = vendors.user_id
                                    JOIN `allowed_vendors` ON allowed_vendors.allowed_id = vendors.a_vendor_id
                                    JOIN `categories` ON categories.categories_category_id = vendors.vendors_category_id
                                    WHERE $target_field = $source_data;");

        return $query->result();

    }

    function submit_new_vendor($user_data_id) {

        $name = $this->input->post('vendors');
        $vend_id = $this->Vendor_model->get_vendor_id($name);


    	$data = array(
		'name' => $this->input->post('name'),
		'a_vendor_id' => $vend_id['a_vendor_id'],
        'vendors_category_id' => $this->input->post('category'),
        'description' => $this->input->post('description'),
        'created' => date('Y-m-d H:i:s'),
        'user_id' => $user_data_id
		);
		return $this->db->insert('vendors', $data);
    }

    function count_all_rows($category)
    {
        $query = $this->db->query("SELECT * FROM `vendors` WHERE `vendors_category_id` = $category;");
        return $query->num_rows();
    }

    function get_vendor_names()
    {
        $result = array();
        $query = $this->db->query('SELECT DISTINCT `allowed_name` FROM `allowed_vendors` ORDER BY `allowed_name`;');


        foreach ($query->result() as $row)
        {
            $result[$row->allowed_name] = $row->allowed_name;
        }
        $result = array_merge(array('Vendor' => 'Vendor'), $result);
        return $result;
    }

    function count_all_allowed()
    {
        $query = $this->db->query("SELECT * FROM `allowed_vendors` WHERE 1;");
        return $query->num_rows();
    }

    function count_all_allowed_juices($id)
    {
        $query = $this->db->query("SELECT * FROM `vendors` WHERE `a_vendor_id` = $id;");
        return $query->num_rows();
    }

    function submit_allowed_vendor($user_data_id) {

        $data = array(
        'allowed_name' => $this->input->post('vendor_name'),
        'allowed_url' => $this->input->post('url_link'),
        'allowed_image_url' => $this->input->post('image_url_link'),
        'allowed_tagline' => $this->input->post('tagline'),
        'allowed_body' => $this->input->post('allowed_body'),
        'allowed_created' => date('Y-m-d H:i:s'),
        'allowed_user_id' => $user_data_id
        );

        if ($data['allowed_image_url'] === '')
        {
            $data['allowed_image_url'] = '/webroot/vendor_logos/default_logo.png';
        }
        if ( ! empty($_FILES['userfile']['name']))
        {
            $image_data = $this->upload->data();
            $image_loc = $image_data['file_name'];
            $data['allowed_image_url'] = '/webroot/vendor_logos/'.$image_loc;
        }
        return $this->db->insert('allowed_vendors', $data);
    }

//Still working on this. Need to make sure to get the correct id.
        function edit_allowed_vendor($user_data_id) {

        $data = array(
        'allowed_url' => $this->input->post('url_link'),
        'allowed_image_url' => $this->input->post('image_url_link'),
        'allowed_tagline' => $this->input->post('tagline'),
        'allowed_body' => $this->input->post('allowed_body'),
        'allowed_modified' => date('Y-m-d H:i:s'),
        );

        if ($data['allowed_image_url'] === '')
        {
            $data['allowed_image_url'] = '/webroot/vendor_logos/default_logo.png';
        }
        if ( ! empty($_FILES['userfile']['name']))
        {
            $image_data = $this->upload->data();
            $image_loc = $image_data['file_name'];
            $data['allowed_image_url'] = '/webroot/vendor_logos/'.$image_loc;
        }
        $this->db->where('id', $id);
        return $this->db->update('allowed_vendors', $data);
    }

    function get_all_allowed_vendors($pagination)
    {
        $this->db->limit(8, $pagination);
        $this->db->order_by('allowed_name', 'asc');
        $query = $this->db->get('allowed_vendors');
        return $query->result();
    }

    function get_individual_allowed_vendor($vendor_id)
    {
        $query = $this->db->get_where('allowed_vendors', array('allowed_id' => $vendor_id));
        return $query->result();
    }

    function get_vendor_id($name)
    {
        $query = $this->db->query("SELECT `allowed_id` FROM `allowed_vendors` WHERE `allowed_name` = '$name';");

        $result = $query->result();

        foreach($result as $row)
        {
            $vendor_val['a_vendor_id'] = $row->allowed_id;
        }
        return $vendor_val;
    }
    function get_vendors_juices($vendor_id)
    {
        $query = $this->db->get_where('vendors', array('a_vendor_id' => $vendor_id));
        return $query->result();
    }
}