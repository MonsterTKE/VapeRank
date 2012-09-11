<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

 /**
 * Contact Class 
 * 
 * @package VapeRank
 * @subpackage Front-end 
 * @category controller 
 * @author Jim Bulkowski 
 * Creation Date   : June 30, 2012
 */

class Contact extends CI_controller 
{
	var $CI;
    
    public function __construct()
	{
		parent::__construct();
        $this->CI =& get_instance();
	}

	function index()
	{
		$this->load->library('recaptcha');
        $this->load->library('form_validation');
        $this->lang->load('recaptcha');
        

        $config = array(
                            array('field' => 'user_name',               'label' => 'Your Name',                 'rules' => 'trim|required|min_length[5]|max_length[60]'), 
                            array('field' => 'user_email',              'label' => 'Your Email Address',        'rules' => 'trim|required|valid_email'), 
                            array('field' => 'message',                 'label' => 'Your Message',              'rules' => 'trim|required|min_length[5]|max_length[1000]'), 
                            array('field' => 'recaptcha_response_field','label' => 'lang:recaptcha_field_name', 'rules' => 'required|callback_check_captcha')
                        );

        $data['breadcrumbs_set'] = "Let us know what you think, if you dont want to wait click \"Live chat\"";
        $data['page_title'] = 'Contact Vaperank.';

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() != false)
        {
            $this->load->library('email');
            $to = $this->CI->config->item('contact_email');
            $body = $this->input->post('message');
            
            $this->email->to($this->CI->config->item('contact_email'));
			$this->email->from($this->input->post('user_email'), $this->input->post('user_name'));
			$this->email->subject($this->CI->config->item('contact_default_subject'));
			$this->email->message($this->input->post('message'));	
			if( $this->email->send() )
                $data['status'] = 'Your message was sent successfully';
            else
                $data['status'] = 'System failed to send you message. Please try again later';
            
        } //end main else
        else
        $data['recaptcha'] = $this->recaptcha->get_html();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/contact_form', $data);
        $this->load->view('templates/footer');

	}

	function check_captcha($val) 
     {
    	  if ($this->recaptcha->check_answer($this->input->ip_address(),$this->input->post('recaptcha_challenge_field'),$val))
    	    return true;
    	  else 
          {
    	    $this->form_validation->set_message('check_captcha',$this->lang->line('recaptcha_incorrect_response'));
    	    return false;
    	  }
	}
}