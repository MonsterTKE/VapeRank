<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function index()
	{

		$this->load->model('User_model');
		$this->load->model('Banner_model');
		$this->load->model('Rating_model');

		if (!$this->tank_auth->is_logged_in())
		{
			redirect(base_url('auth/login'));
		}

		$pagination_default = 0;
		if(is_numeric($this->uri->segment(3)))
		{
			$pagination_default = $this->uri->segment(3);
		}

		$user_data_name = $this->tank_auth->get_username();
		$user_data_id = $this->tank_auth->get_user_id();

	//This data is going to the view.
			$data['results'] = $this->User_model->get_all_submissions($user_data_id, $pagination_default);


			$data['page_title'] = 'Edit submissions';
			$data['breadcrumbs_set'] = "Your submissions";
	//Debug info
			$data['session_info_ip'] = $this->session->userdata('ip_address');
			$data['session_info_agent'] = $this->session->userdata('user_agent');


	//Tank auth library data
			$data['user_data_id'] = $this->tank_auth->get_user_id();
			$data['user_data_logged'] = $this->tank_auth->is_logged_in();

			$base_url = base_url();
			$config['base_url'] = "{$base_url}user/index/";
			$config['total_rows'] = $this->User_model->count_all_submissions($data['user_data_id']);
			$config['per_page'] = 5;
			$config['uri_segment'] = 3;

			$this->pagination->initialize($config);

		$data['sidebar_count'] = $this->Banner_model->count_all_banners($data['user_data_id']);
		$data['sidebar'] = $this->Banner_model->show_all_user_banners($data['user_data_id']);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('users/user_main', $data);
		$this->load->view('modals/vote_modal', $data);
		$this->load->view('templates/footer', $data);
	}

	function edit_submission($juice_id)
	{
			$this->load->model('User_model');
			$this->load->model('Vendor_model');
			$this->load->helper('form');
			$this->load->library('form_validation');


			$juice_result = $this->Vendor_model->get_individual_juice('vendors', 'vendors.id', $juice_id);
				if (!$juice_result)
				{
					show_404();
				}
			foreach($juice_result as $jd)
			{
			$data['v_id'] = $jd->id;
			$data['v_j_name'] = $jd->name;
			$data['v_v_name'] = $jd->allowed_name;
			$data['v_url'] = $jd->allowed_url;
			$data['v_image'] = $jd->url_image;
			$data['v_desc'] = $jd->description;
			$data['v_created'] = $jd->created;
			$data['v_modified'] = $jd->modified;
			$data['v_user'] = $jd->user_id;
			$data['v_category'] = $jd->category;
			$data['v_votes_up'] = $jd->votes_up;
			$data['v_votes_down'] = $jd->votes_down;
			$data['v_banned'] = $jd->banned;
			$data['v_username'] = $jd->username;
			}

			$data['page_title'] = 'Edit submissions';
			$data['breadcrumbs_set'] = "Edit {$data['v_j_name']}";
			$data['form_sucess'] = "You sucessfully edited {$data['v_j_name']}.";
	//Debug info
			$data['session_info_ip'] = $this->session->userdata('ip_address');
			$data['session_info_agent'] = $this->session->userdata('user_agent');


	//Tank auth library data
			$data['user_data_id'] = $this->tank_auth->get_user_id();
			$data['user_data_logged'] = $this->tank_auth->is_logged_in();

		$this->form_validation->set_rules('vendor_name', 'Vendor', 'required|max_length[45]|trim');
		$this->form_validation->set_rules('description','Description','required|max_length[500]');
		$this->form_validation->set_rules('category', 'Category', 'required');

			if($data['user_data_logged'])
			{
				if(!empty($data['v_modified']))
				{
					$data['form_sucess'] ="Sorry about that, but you can only edit a submission one time";
				$this->load->view('templates/header', $data);
				$this->load->view('templates/navigation', $data);
				$this->load->view('vendors/success', $data);
				$this->load->view('templates/footer', $data);
				}

				elseif ($this->form_validation->run() === FALSE)
				{

				$this->load->view('templates/header', $data);
				$this->load->view('templates/navigation', $data);
				$this->load->view('users/edit_submission', $data);
				$this->load->view('templates/footer', $data);
				}

				else
				{
				$this->User_model->edit_submission($data['user_data_id'], $data['v_id']);
				$this->load->view('templates/header', $data);
				$this->load->view('templates/navigation', $data);
				$this->load->view('vendors/success', $data);
				$this->load->view('templates/footer', $data);
				}
			}
				else
				{
				redirect('/auth/login/');
				}
		}

}