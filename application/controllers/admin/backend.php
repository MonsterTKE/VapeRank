 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller 
{
	
	function index() 
	{
		$this->load->model('Vendor_model');
		$this->load->model('Rating_model');
		$data['post_data'] = 'Default';
		if ($this->tank_auth->is_logged_in() && $this->tank_auth->get_username() === 'MonsterTKE') {

		if ($this->form_validation->run() === FALSE) 
		{
			$data['result'] = $this->Vendor_model->get_vendor_names();
			$data['post_data'] = $this->input->post('vendors');

			$this->load->view('admin/a_backend', $data);
		}
	}
		else {
			redirect(base_url());
		}
	}

}
?>