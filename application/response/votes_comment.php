<?php

class Votes_comment extends CI_controller {

	   function vote($juice_id, $vote_direction) {

        $this->load->model('Vendor_model');
        $this->load->model('Rating_model');

        $data['page_title'] = 'Add rating';
        $data['user_data_id'] = $this->tank_auth->get_user_id();
        $data['user_data_logged'] = $this->tank_auth->is_logged_in();
        $user_name = $this->tank_auth->get_username();

        $data['vote_result'] = 'good deal';
        $data['ajax_message'] = '';
        $data['switch_var'] = '';

        $juice_result = $this->Vendor_model->get_individual_juice('vendors', 'vendors.id', $juice_id);

        foreach($juice_result as $jd) {

            $data['v_id'] = $jd->id;
            $data['v_j_name'] = $jd->name;
            $data['v_v_name'] = $jd->vendor_name;
            $data['v_url'] = $jd->url_link;
            $data['v_image'] = $jd->url_image;
            $data['v_desc'] = $jd->description;
            $data['v_created'] = $jd->created;
            $data['v_modified'] = $jd->modified;
            $data['v_user'] = $jd->user_id;
            $data['v_category'] = $jd->category;
            $data['v_votes_up'] = $jd->votes_up;
            $data['v_votes_down'] = $jd->votes_down;
            $data['v_banned'] = $jd->banned;
        }


        $data['vote_increment_model'] = '';

        $data['vote_column'] = 'error';

        //    function can_vote($juice_id, $user_id
        if ($data['user_data_logged']) {
        $has_voted = $this->Rating_model->can_vote($juice_id, $data['user_data_id']);
    	}
    	else {
    		redirect('/auth/login/');
    	}

        	if($data['user_data_logged']) {
            	if (!$has_voted) {
                    if($vote_direction === 'down') {
                        $data['vote_column'] = 'votes_down';
                        $data['vote_increment_model'] = $data['v_votes_down'] + 1;
                    }
                    elseif($vote_direction === 'up') {
                        $data['vote_column'] = 'votes_up';
                        $data['vote_increment_model'] = $data['v_votes_up'] + 1;
                    }
                    else {
                        $data['vote_result'] = "something wrong";
                    }

                	//function vote_increment($column, $id, $vote_increment)
                    $this->Rating_model->vote_increment($data['vote_column'], $juice_id, $data['vote_increment_model'], $data['user_data_id']);

                   //$redirect_to_comments = 'rating/comment/'$juice_id;
                	$data['ajax_message'] = "Thanks for voting {$user_name}!";
                    $data['switch_var'] = '1';
                	$this->load->view('ajax/flash', $data);
                }
                else {
                	$data['ajax_message'] = "Sorry {$user_name}, you already voted for \"{$data['v_j_name']}\"!";
                    $data['switch_var'] = '2';
                	$this->load->view('ajax/flash', $data);
                }
            }
        
        else {
            redirect('/auth/login/');
        }
    }

    private function get_session(){
    	$id = $this->tank_auth->get_username();
    	$logged = $this->tank_auth->is_logged_in();
    	echo $id, $logged;
    }

    function tester() {
    	echo $this->get_session();
    	    }

    function test_1() {
    	echo "working";
    } 
}