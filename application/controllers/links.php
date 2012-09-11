 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Links extends CI_Controller {

	function index()
	{
		redirect('links/irc_chat');
	}

	function irc_chat()
	{
		$data['page_title'] = 'web chat';
		$data['breadcrumbs_set'] = '#VapeRank on irc.esper.net';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('links/irc');
		$this->load->view('templates/footer');
	}

	function about()
	{
		$data['page_title'] = 'About Vaperank';
		$data['breadcrumbs_set'] = 'All about this Project.';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('links/about');
		$this->load->view('templates/footer');
	}
}