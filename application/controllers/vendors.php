 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendors extends CI_Controller {

	public function index($sort = 'default')
	{
		$this->load->model('Vendor_model');
		$this->load->model('Rating_model');
		$this->load->library('user_agent');

		$base_url_modifier = 'default';

		$pagination_default = 0;
		$category = '';
		$category_c = '';
		$data['sort_order'] = 'Best <em>Overall</em>, By Votes.';
		$this->output->enable_profiler(TRUE);
/*
****************************************************************************************************************************
******* Setup and handle pagination links using the Uri data                                                         *******
******* I really really need to investigate a better way to do this                                                  *******
****************************************************************************************************************************
*/

		if ($this->uri->segment(3) === 'Tobacco')
		{
			$category = 1;
			$category_c ='Tobacco';
			$base_url_modifier = 'Tobacco';
			$data['sort_order'] = 'Best <em>Tobacco</em>, By Votes.';
		}
		elseif ($this->uri->segment(3) === 'Fruit')
		{
			$category = 2;
			$category_c ='Fruit';
			$base_url_modifier = 'Fruit';
			$data['sort_order'] = 'Best <em>Fruit</em>, By Votes.';
		}
		elseif ($this->uri->segment(3) === 'Sweet')
		{
			$category = 3;
			$category_c ='Sweet';
			$base_url_modifier = 'Sweet';
			$data['sort_order'] = 'Best <em>Sweet</em>, By Votes.';
		}
		elseif ($this->uri->segment(3) === 'Bakery')
		{
			$category = 4;
			$category_c ='Bakery';
			$base_url_modifier = 'Bakery';
			$data['sort_order'] = 'Best <em>Bakery</em>, By Votes.';
		}
		elseif ($this->uri->segment(3) === 'Organic')
		{
			$category = 5;
			$category_c ='Organic';
			$base_url_modifier = 'Organic';
			$data['sort_order'] = 'Best <em>Organic</em>, By Votes.';
		}
		elseif ($this->uri->segment(3) === 'Menthol')
		{
			$category = 6;
			$category_c ='Menthol';
			$base_url_modifier = 'Menthol';
			$data['sort_order'] = 'Best <em>Menthol</em>, By Votes.';
		}
		elseif ($this->uri->segment(3) === 'Coffee')
		{
			$category = 7;
			$category_c ='Coffee';
			$base_url_modifier = 'Coffee';
			$data['sort_order'] = 'Best <em>Coffee</em>, By Votes.';
		}
		elseif ($this->uri->segment(3) === 'Vg')
		{
			$category = 8;
			$category_c ='100% Vg';
			$base_url_modifier = 'Vg';
			$data['sort_order'] = 'Best <em>100% Vg</em>, By Votes.';
		}
		elseif ($this->uri->segment(3) === 'Other')
		{
			$category = 9;
			$category_c ='Other/Specialty';
			$base_url_modifier = 'Other/Specialty';
			$data['sort_order'] = 'Best <em>Other/Specialty</em>, By Votes.';
		}
		else
		{
			$category = '1 OR 1=1';
			$category_c ='default OR 1';
		}
/* ***Not sure what I am doing with this line here, But it isnt breaking anything and I dont want to remove it.
	I set the default variable passed to SQL to zero based on the URI segment of the page, this stops Injections as the variable is
	Set to '0' initially, only when passing an is_numeric check is it set to the correct value.
*/
		if(is_numeric($this->uri->segment(4)))
		{
			$pagination_default = $this->uri->segment(4);
		}

		//$config['count_comments'] = $this->db->where('category', $category)->where('category', $id)->get('ratings')->num_rows;
		$data['page_title'] = "E-Juice Listing";
		$data['result'] = $this->Vendor_model->get_all_vendors($pagination_default, $category);
		$data['session_info_ip'] = $this->session->userdata('ip_address');
		$data['session_info_agent'] = $this->session->userdata('user_agent');
		$data['load_breadcrumbs'] = TRUE;
		$data['total_results'] = $this->Vendor_model->count_all_rows($category);

		$base_url = base_url();
		$config['base_url'] = "{$base_url}vendors/index/{$base_url_modifier}";
		$config['total_rows'] = $data['total_results'];
		$config['per_page'] = 8;
		$config['uri_segment'] = 4;

		$this->pagination->initialize($config);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('vendors/vendor', $data);
		$this->load->view('modals/vote_modal');
		$this->load->view('templates/footer');
	}

	public function submit()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Vendor_model');

		$data['page_title'] = 'Submit a new juice';
		$data['breadcrumbs_set'] = "Add a juice";
		$data['form_sucess'] = "You sucessfully added A Juice.";
//Debug info
		$data['session_info_ip'] = $this->session->userdata('ip_address');
		$data['session_info_agent'] = $this->session->userdata('user_agent');


//Tank auth library data
		$data['user_data_id'] = $this->tank_auth->get_user_id();
		$data['user_data_logged'] = $this->tank_auth->is_logged_in();

//Form data iteration for vendors
		$data['list_form_vendors'] = $this->Vendor_model->get_vendor_names();
//Form authentication rules
		$data['dropdown_default'] = 'Vendor';

		$this->form_validation->set_rules('name', 'Name', 'required|is_unique[vendors.name]|max_length[45]|trim');
		$this->form_validation->set_rules('vendors', 'Vendor', 'required|callback_check_vendor_field');
		$this->form_validation->set_rules('description','Description','required|max_length[500]');
		$this->form_validation->set_rules('category', 'Category', 'required');

			if($data['user_data_logged'])
			{

				if ($this->form_validation->run() === FALSE)
				{
					$sess_check = $this->session->flashdata('vendor_selection');
					if($sess_check)
					{
						$data['dropdown_default'] = $sess_check;
					}
				$this->load->view('templates/header', $data);
				$this->load->view('templates/navigation', $data);
				$this->load->view('vendors/submit', $data);
				$this->load->view('templates/footer');
				}

				else
				{
				$this->Vendor_model->submit_new_vendor($data['user_data_id']);
				$this->load->view('templates/header', $data);
				$this->load->view('templates/navigation', $data);
				$this->load->view('vendors/success');
				$this->load->view('templates/footer', $data);
				}
			}
				else
				{
				redirect('/auth/login/');
				}
		}

	public function individual($id = 1.2)
	{
		$this->load->model('Vendor_model');
		$this->load->model('Rating_model');

		//*********************************

		$data['session_info_ip'] = $this->session->userdata('ip_address');
		$data['session_info_agent'] = $this->session->userdata('user_agent');
		//*********************************
		//Check and get database results

		$data['juice_result'] = $this->Vendor_model->get_individual_juice('vendors', 'vendors.id', $id);
		if (!$data['juice_result'])
		{
			show_404();
		}
			// Send this data to the view to iterate.
		$pagination_default = 0;
		if(is_numeric($this->uri->segment(4)))
		{
			$pagination_default = $this->uri->segment(4);
		}

			$data['rating_result'] = $this->Rating_model->show_all_comments($id, $pagination_default);
			$comment_counter = $this->Rating_model->count_all_comments($id);
			$data['comment_count'] = count($comment_counter);
			// /vendors/individual.php

			$data['page_title'] = $data['juice_result'][0]->name;
			/* I set the default variable passed to SQL to zero based on the URI segment of the page, this stops Injections as the variable is
			Set to '0' initially, only when passing an is_numeric check is it set to the correct value.
			*/
			$base_url = base_url();
			$config['base_url'] = "{$base_url}vendors/individual/{$id}";
			$config['total_rows'] = $data['comment_count'];
			$config['per_page'] = 5;
			$config['uri_segment'] = 4;

			$this->pagination->initialize($config);


			$this->load->view('templates/header', $data);
			$this->load->view('templates/navigation', $data);
			$this->load->view('vendors/individual', $data);
			$this->load->view('modals/vote_modal', $data);
			$this->load->view('templates/footer');
		}

		function check_vendor_field($str)
		{
			if($str === 'Vendor')
			{
				$this->form_validation->set_message('check_vendor_field', 'The %s field is required and cannot be "Vendor".');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
}
?>