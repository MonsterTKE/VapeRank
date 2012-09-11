<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rating extends CI_Controller {

	function __construct() {
		parent::__construct();
	}	

	function index() {

		$data['page_title'] = 'Vote';
		$data['session_info_ip'] = $this->session->userdata('ip_address');
		$data['session_info_agent'] = $this->session->userdata('user_agent');






		$this->load->view('templates/header', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('rating/comment', $data);
		$this->load->view('templates/footer');
	}

   function add($juice_id, $vote_direction) {

        $this->load->model('Vendor_model');
        $this->load->model('Rating_model');
//debug info and standard outputs.
        $data['page_title'] = 'Add rating';
        $data['session_info_ip'] = $this->session->userdata('ip_address');
        $data['session_info_agent'] = $this->session->userdata('user_agent');
        $data['user_data_id'] = $this->tank_auth->get_user_id();
        $data['user_data_logged'] = $this->tank_auth->is_logged_in();

        $data['vote_result'] = 'good deal';

        if (!$this->uri->segment(3)) {
            die("That is an invalid URL.");
        }
        else {
        $juice_result = $this->Vendor_model->get_individual_juice('vendors', 'vendors.id', $juice_id);
        }

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

        //$data['vote_increment_up'] = $data['v_votes_up'] + 1;
        //$data['vote_increment_down'] = $data['v_votes_down'] + 1;

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
                    if($this->uri->segment(4) === 'down') {
                        $data['vote_column'] = 'votes_down';
                        $data['vote_increment_model'] = $data['v_votes_down'] + 1;
                    }
                    elseif($this->uri->segment(4) === 'up') {
                        $data['vote_column'] = 'votes_up';
                        $data['vote_increment_model'] = $data['v_votes_up'] + 1;
                    }
                    else {
                        $data['vote_result'] = "something wrong";
                    }

                	//function vote_increment($column, $id, $vote_increment)
                    $this->Rating_model->vote_increment($data['vote_column'], $juice_id, $data['vote_increment_model'], $data['user_data_id']);

                   //$redirect_to_comments = 'rating/comment/'$juice_id;
                   redirect(base_url());

                }
                else {
                    $this->load->view('templates/header', $data);
                	$this->load->view('errors/vote_sorry', $data);
                    $this->load->view('templates/footer');
                }
            }
        
        else {
            redirect('/auth/login/');
        }
    }
//UPDATE `ratings` SET `user_id`=0;
     function comment() {
        $this->load->model('Rating_model');
        $this->load->model('Vendor_model');

        $this->form_validation->set_rules('comments', 'Comments', 'trim|required|max_length[500]');
        $this->form_validation->set_rules('juice_id', 'Juice_id', 'required|xss_clean');

        $data['ajax_message'] = 'sorry, something went wrong.';
        $data['switch_var'] = 0;

        $comment = $this->input->post('comments', TRUE);
        $juice_id = $this->input->post('juice_id', TRUE);
        $user_data_id = $this->tank_auth->get_user_id();

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
        

        if ($this->form_validation->run() == FALSE) {
            redirect(base_url());
        }
        else {
            $this->Rating_model->add_comment($user_data_id, $juice_id, $comment);
            redirect("/vendors/individual/{$data['v_id']}");
        }
    }
}