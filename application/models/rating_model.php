<?php

class Rating_model extends CI_Model {

	function __construct() {
      parent::__construct();
    }

   function show_all_comments($juice, $limit) //returns comments that are NOT NULL
    {

    	//$query = $this->db->query("SELECT * FROM `ratings` WHERE juice_id = $juice AND `comments` IS NOT NULL ORDER BY created DESC LIMIT $limit, 5;");
        $query = $this->db->query("SELECT ratings.*, users.username FROM `ratings` JOIN `users` ON users.id = ratings.user_id WHERE juice_id = $juice AND `comments` IS NOT NULL ORDER BY created DESC LIMIT $limit, 5;");
       return $query->result();
    }

    function count_all_comments($juice) //Counts all results in the above column
    {
        $query = $this->db->query("SELECT `comments` FROM `ratings` WHERE juice_id = $juice AND `comments` IS NOT NULL;" );
       return $query->result();

    }

    function add_comment($user_data_id, $juice_id, $comment) {
       // $query = $this->db->query("UPDATE `ratings` SET `comments`= $comment WHERE `juice_id` = $juice_id AND `user_id` = $user_data_id;");

        $data = array('comments' => $comment);

        $this->db->where('juice_id', $juice_id);
        $this->db->where('user_id', $user_data_id);
        $this->db->update('ratings', $data);
        return true;
    }

    function vote_increment($column, $id, $vote_increment, $user_data_id) {
    	$var = array($column => $vote_increment);
    	$var2 = array('user_id' => $user_data_id,
    				 'juice_id' => $id,
    				 'created' => date('Y-m-d H:i:s'));

    	$this->db->where('id', $id);
    	$this->db->update('vendors', $var);
    	$this->db->insert('ratings', $var2);
    }

    function can_vote($juice_id, $user_id) {
    	$query = $this->db->query("SELECT `juice_id`, `user_id` FROM `ratings` WHERE `juice_id` = $juice_id AND `user_id` = $user_id;");
    	return $query->result();
    }

}
