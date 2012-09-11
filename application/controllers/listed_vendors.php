<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class listed_vendors extends CI_Controller {
	
	public function index()
	{
		redirect('listed_vendors/all_vendors');
	}

	public function all_vendors() 
	{
		$this->load->model('Vendor_model');

		$data['page_title'] = 'listed vendors';
		
		
		$pagination_default = 0;
		if(is_numeric($this->uri->segment(3))) 
		{
			$pagination_default = $this->uri->segment(3);
		}

		$data['total_results'] = $this->Vendor_model->count_all_allowed();
		$data['allowed_vendors'] = $this->Vendor_model->get_all_allowed_vendors($pagination_default);

		$data['breadcrumbs_set'] = $data['total_results'].' Total Vendors';

		$base_url = base_url();
		$config['base_url'] = "{$base_url}listed_vendors/all_vendors";
		$config['total_rows'] = $data['total_results'];
		$config['per_page'] = 8; 
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->output->enable_profiler(FALSE);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('all_vendors/allowed_index', $data);
		$this->load->view('templates/footer');
				
	}

	public function individual_vendor($vendor_id = 1.2)
	{
		$this->load->helper('inflector');
		$this->load->model('Vendor_model');
		$this->load->model('Vendor_model');

		$vendor_id = $this->uri->segment(3, 0);
		$ind_vendor = $this->Vendor_model->get_individual_allowed_vendor($vendor_id);

		foreach ($ind_vendor as $row)
		{
			$data['allowed_name'] = $row->allowed_name;
			$data['allowed_url'] =	$row->allowed_url;
			$data['allowed_tagline'] = $row->allowed_tagline;
			$data['allowed_body'] = $row->allowed_body;
			$data['allowed_image_url'] = $row->allowed_image_url;
			$data['allowed_id'] = $row->allowed_id;
		}


		$data['page_title'] = $data['allowed_name'];
		$data['vend_juices'] = $this->Vendor_model->get_vendors_juices($vendor_id);
		$data['breadcrumbs_set'] = $data['allowed_name'];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('all_vendors/ind_vendor', $data);
		$this->load->view('templates/footer');
		//var_dump($ind_vendor);
		//echo '<br/> <br/>';
		//var_dump($data['vend_juices']);
	}

	public function new_vendor() 
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Vendor_model');
		$this->load->helper('url');
		$this->load->helper('ckeditor');

				$data['ckeditor'] = array(
							'id' 	=> 	'content',
							'path'	=>	'js/ckeditor',
							'config' => array(
										'width' 	=> 	"550px",	//Setting a custom width
										'height' 	=> 	'300px',	//Setting a custom height
										'toolbar' 	=> array(
													array('Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat'),
													array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo'),
													array('Link','Unlink','Anchor'),
													array('Styles','Format','Font','FontSize', '-', 'TextColor'),
													array('Image','Table','HorizontalRule','Smiley','SpecialChar'),
											)
							));

		$data['page_title'] = 'Submit a new vendor';
		$data['breadcrumbs_set'] = "New vendor";
		$data['form_sucess'] = "You sucessfully added a new vendor.";
		$data['upload_error'] = 'no error';
		$data['upload_data_array'] = '';
//Debug info
		$data['session_info_ip'] = $this->session->userdata('ip_address');
		$data['session_info_agent'] = $this->session->userdata('user_agent');


//Tank auth library data
		$data['user_data_id'] = $this->tank_auth->get_user_id();
		$data['user_data_logged'] = $this->tank_auth->is_logged_in();


//Form authentication rules
		$this->form_validation->set_rules('vendor_name', 'Vendor Name', 'required|is_unique[vendors.name]|max_length[45]|trim');
		$this->form_validation->set_rules('url_link','Vendor Link','required|max_length[45]|trim|prep_url');
		$this->form_validation->set_rules('tagline','Tagline','max_length[50]');
		$this->form_validation->set_rules('allowed_body','Body','max_length[2000]');
		$this->form_validation->set_rules('image_url_link', 'Image Link', 'max_length[120]|prep_url');
		$this->form_validation->set_rules('userfile', 'File upload', 'callback_check_upload');

			if($data['user_data_logged']) 
			{

				if ($this->form_validation->run() === FALSE) 
				{

				$this->load->view('templates/header', $data);
				$this->load->view('templates/navigation', $data);	
				$this->load->view('vendors/submit_vendor', $data);
				$this->load->view('templates/footer');
				}

				else 
				{

				$this->Vendor_model->submit_allowed_vendor($data['user_data_id']);
				$new_session_data = $this->input->post('vendor_name');
 				$this->session->set_flashdata('vendor_selection', $new_session_data);
				redirect('vendors/submit');
				//$this->Vendor_model->submit_allowed_vendor($data['user_data_id']);
				//$this->load->view('templates/header', $data);
				//$this->load->view('templates/navigation', $data);
				//$this->load->view('vendors/success');
				//$this->load->view('templates/footer', $data);
				//redirect('vendors/submit');
				}
			}
				else 
				{
				redirect('/auth/login/');
				}
		}

	public function edit_allowed_vendor()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Vendor_model');

		$data['page_title'] = 'Submit a new vendor';
		$data['breadcrumbs_set'] = "New vendor";
		$data['form_sucess'] = "You sucessfully added a new vendor.";
		$data['upload_error'] = 'no error';
		$data['upload_data_array'] = '';
//Debug info
		$data['session_info_ip'] = $this->session->userdata('ip_address');
		$data['session_info_agent'] = $this->session->userdata('user_agent');


//Tank auth library data
		$data['user_data_id'] = $this->tank_auth->get_user_id();
		$data['user_data_logged'] = $this->tank_auth->is_logged_in();


//Form authentication rules
		$this->form_validation->set_rules('vendor_name', 'Vendor Name', 'required|is_unique[vendors.name]|max_length[45]|trim');
		$this->form_validation->set_rules('url_link','Vendor Link','required|max_length[45]|trim|prep_url');
		$this->form_validation->set_rules('tagline','Tagline','max_length[50]');
		$this->form_validation->set_rules('allowed_body','Body','max_length[2000]');
		$this->form_validation->set_rules('image_url_link', 'Image Link', 'max_length[120]|prep_url');
		$this->form_validation->set_rules('userfile', 'File upload', 'callback_check_upload');

		if($data['user_data_logged']) 
			{

				if ($this->form_validation->run() === FALSE) 
				{

				$this->load->view('templates/header', $data);
				$this->load->view('templates/navigation', $data);	
				$this->load->view('vendors/submit_vendor', $data);
				$this->load->view('templates/footer');
				}

				else 
				{
				$this->Vendor_model->submit_allowed_vendor($data['user_data_id']);
				redirect('vendors/submit');
				//$this->Vendor_model->submit_allowed_vendor($data['user_data_id']);
				//$this->load->view('templates/header', $data);
				//$this->load->view('templates/navigation', $data);
				//$this->load->view('vendors/success');
				//$this->load->view('templates/footer', $data);
				//redirect('vendors/submit');
				}
			}
				else 
				{
				redirect('/auth/login/');
				}
	}

	function check_upload()
	{
		if ( ! empty($_FILES['userfile']['name']))
		{
			$config['upload_path'] = './webroot/vendor_logos';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '0';
			$config['max_width']  = '150';
			$config['max_height']  = '150';
			$username = $this->tank_auth->get_user_id();
			$vendor_file = $this->input->post('vendor_name');
			$filename = $vendor_file."_".$username;
			$config['file_name'] = $filename;
			$config['overwrite'] = TRUE;
			$config['remove_spaces'] = TRUE;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload())
			{
			$this->form_validation->set_message('check_upload', 'Sorry the file must be 150 x 150 pixels or less.');
			
			return FALSE;
			}
		}
	}
}
?>