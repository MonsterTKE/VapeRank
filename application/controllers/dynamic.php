 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dynamic extends CI_Controller {

	function vote()
	{
		if($this->input->is_ajax_request())
		{
		    $this->load->model('Vendor_model');
            $this->load->model('Rating_model');

		    $data = array(	'username' => $this->tank_auth->get_username(),
		    				'new_votes' => false,
		    				'has_voted' => true,
		    				'juice_post' => $this->input->post('juice_id'),
		    				'vote_post_direction' => $this->input->post('vote_direction'),);

		    $user_id = $this->tank_auth->get_user_id();
    
    		    if($data['username'])
    		    {
    		    	if(!$this->Rating_model->can_vote($data['juice_post'], $user_id))
    		    	{
    		    		$juice_result = $this->Vendor_model->get_individual_juice('vendors', 'vendors.id', $data['juice_post']);
    
    		    		$current_votes = $juice_result[0]->$data['vote_post_direction'];                                 
    		    		$data['new_votes'] = $current_votes + 1;
    		    		$data['has_voted'] = false;
    
    		    		$this->Rating_model->vote_increment($data['vote_post_direction'], $data['juice_post'], $data['new_votes'], $user_id);
    		    		echo json_encode($data);
    		    	}
    		    	else
    		    	{
    		    		$data['new_votes'] = false;
    		    		echo json_encode($data);
    		    	}
    		    }
    		    else
    		    {
    		    	$data['username'] = false;
    		    	echo json_encode($data);
    		    	die();
		    	}
		}
		else
		{
			redirect();
		}
	}

	function comment()
	{
		if($this->input->is_ajax_request())
		{

	    	$data = array(	'username' => $this->tank_auth->get_username(),
		    				'new_votes' => false,
		    				'has_voted' => true,
		    				'juice_post' => $this->input->post('juice_id'),
		    				'comment_post' => $this->input->post('comment'),);

	    	$user_data_id = $this->tank_auth->get_user_id();
			
			if($data['comment_post'])
			{	
				$this->load->model('Rating_model');
				$this->Rating_model->add_comment($user_data_id, $data['juice_post'], $data['comment_post']);
				echo json_encode(true);
			}
			else
			{
				echo json_encode(false);
			}		
		}
		else
		{
			redirect();
		}
	}
}