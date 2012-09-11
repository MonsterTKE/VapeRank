<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends CI_Controller
{
	function index()
	{
		$data['derp'] = 'Hello Derp';

		$this->load->view('test',$data);
	}

	function bannergen($juice_id = FALSE)
	{
		$this->load->model('Vendor_model');
		$this->load->model('Rating_model');
		$this->load->model('Banner_model');
		$this->load->library('user_agent');
		$this->load->library('Calendar');

		$data['page_title'] = "E-Juice Listing";
		$data['session_info_ip'] = $this->session->userdata('ip_address');
		$data['session_info_agent'] = $this->session->userdata('user_agent');

		$is_logged_in = $this->tank_auth->is_logged_in();
		if(!$is_logged_in)
		{
			redirect('auth/login');
		}
//Lets get the name of the juice they picked
		$juice_result = $this->Vendor_model->get_individual_juice('vendors', 'vendors.id', $juice_id);

		foreach($juice_result as $jd)
		{
		$data['v_j_name'] = $jd->name;
		}

		$data['breadcrumbs_set'] = "Create your sweet VapeRank banner for \"{$data['v_j_name']}\" !";
		$user_data_id = $this->tank_auth->get_user_id();

		$this->form_validation->set_rules('smokes', 'How many smokes.', 'required|integer|less_than[100]');
		$this->form_validation->set_rules('cost', 'How much per pack.', 'required|decimal|less_than[15.00]');
		$this->form_validation->set_rules('wrapper_check', 'Sorry only one', 'required');

		if (!$juice_id || !$juice_result)
		{
			show_404();
		}
		elseif ($this->Banner_model->count_all_banners($user_data_id) >= 3)
			{
					$data['form_sucess'] ="Sorry about that, but you can only have 3 banners at a time, try deleting one.";
				$this->load->view('templates/header', $data);
				$this->load->view('templates/navigation', $data);
				$this->load->view('vendors/success', $data);
				$this->load->view('templates/footer', $data);
				$this->CI =& get_instance();
				$this->CI->output->_display();
				die();
			}

		if ($this->form_validation->run() === FALSE)
		{
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('banners/bannergen',$data);
		$this->load->view('templates/footer');
		}
		else
		{
		$data['smokes'] = $this->input->post('smokes', TRUE);
		$data['cost'] = $this->input->post('cost', TRUE) / 20;
		$data['cost_per_day'] = $data['smokes'] * $data['cost'];
		$data['m_quit'] = $this->input->post('month', TRUE);
		$data['d_quit'] = $this->input->post('day', TRUE);
		$data['y_quit'] = $this->input->post('year', TRUE);
		$data['date_arr'] = $data['y_quit'].$data['d_quit'].$data['m_quit'];

		$data['t_date'] =  mktime(0,0,0,$data['m_quit'],$data['d_quit'],$data['y_quit']) ;
		$data['t_time'] = unix_to_human($data['t_date']);

//*Send date to function, returns days
		$data['quit_int'] = $this->get_date_interval($data['t_date']);
		$data['quit_total'] = $data['quit_int'] * $data['cost_per_day'];
//Save banner data
		$this->Banner_model->save_banner_data($user_data_id, $juice_id, $data['t_date'], $data['cost_per_day']);
		redirect('user');
		}
	}


	private function get_date_interval($your_date)
	{
     $now = time(); // or your date as well
     //$your_date = strtotime($date);
     $datediff = $now - $your_date;
     $date_int = floor($datediff/(60*60*24));
     return $date_int;
	}

	function show_banner($user = NULL, $juice = NULL)
	{
		$this->load->model('Banner_model');

//Lets get the user data we need to build our banner.
		$banner_results = $this->Banner_model->get_banner($user, $juice);
		if (!$banner_results)
		{
			show_404();
		}
		foreach ($banner_results as $row) {

			$b_id = $row->b_id;
			$b_user_id = $row->b_user_id;
			$quit_date = $row->quit_date;
			$cost_day = $row->cost_day;
			$smokes_day = $row->b_per_day;
			$juice_id = $row->b_juice_id;
			$banner_type = $row->banner_type;
			$username = $row->username;
			$juice_name = $row->name;
			$vendor_name = $row->allowed_name;
			$votes_up = $row->votes_up;
			$votes_down = $row->votes_down;

		}
//Lets figure out what banner background we need to use for this image.


		$cache_file = "./webroot/banners/user_banners/{$juice_id}.{$username}.png";
		$cache_life = 21600; //caching time, in seconds
		$font = "webroot/fonts/verdanab.ttf";
		$font_sq = "webroot/fonts/Square.ttf";
		$font_kim = "webroot/fonts/kim.ttf";
		$font_euro = "webroot/fonts/euro.ttf";
		$font_luc = "webroot/fonts/lucon.ttf";
		$filemtime = @filemtime($cache_file);  // returns FALSE if file does not exist

		//Text positions.
		$px = 5;
		$px2 = 200;
		$px_vp = $px + 70;
		$px_sl = $px_vp;
		$px_mp = $px_sl + 15;
		$adapt_font ='10';
		$adapt_font2 ='10';
		clearstatcache();
		if (TRUE)//!$filemtime or time() - $filemtime >= $cache_life)
		{
		try
		{

		header("Content-type: image/png");
		$source_image ='';
		$tc1 = array("red" => 255, "green" => 255, "blue" => 255);
		$tc2 = array("red" => 255, "green" => 238, "blue" => 0);
		switch ($banner_type)
		{
			case 1: $source_image = 'webroot/banners/banner_blk.png';
					$tc1 = array("red" => 255, "green" => 255, "blue" => 255); //white
					$tc2 = array("red" => 0, "green" => 0, "blue" => 0); //black
			break;

			case 2: $source_image = 'webroot/banners/banner_wht.png';
			break;

			case 3: $source_image = 'webroot/banners/banner_blu.png';
					$tc1 = array("red" => 255, "green" => 255, "blue" => 255); //white
					$tc2 = array("red" => 255, "green" => 166, "blue" => 0); //orang
			break;

			case 4: $source_image = 'webroot/banners/banner_cir.png';
					$tc1 = array("red" => 0, "green" => 0, "blue" => 0); //black
					$tc2 = array("red" => 80, "green" => 0, "blue" => 255); //blue
			break;

			case 5: $source_image = 'webroot/banners/banner_dot.png';
			break;

			case 6: $source_image = 'webroot/banners/banner_stn.png';
					$tc1 = array("red" => 0, "green" => 0, "blue" => 0); //black
					$tc2 = array("red" => 255, "green" => 0, "blue" => 0); //blue
			break;
		}
		$im     = imagecreatefrompng($source_image);
		//$white = imagecolorallocate($im, 255, 255, 255);
		//$aqua = imagecolorallocate($im, 27, 204, 207);
		//$orange = imagecolorallocate($im, 255, 166, 0);
		//$black = imagecolorallocate($im, 0, 0, 0);
		//$blue = imagecolorallocate($im, 8, 0, 255);
		//$yellow = imagecolorallocate($im, 255, 238, 0);
		$color_top = imagecolorallocate($im, $tc1['red'],$tc1['green'],$tc1['blue']);
		$color_middle = imagecolorallocate($im, $tc2['red'],$tc2['green'],$tc2['blue']);

		$name_votes = "{$username} likes \"{$juice_name}\" From {$vendor_name}!";
//Sizing the upper string.
		$size_string = strlen($name_votes);
		if ($size_string <= 40)
			{
				$adapt_font = 10;
			}
		elseif ($size_string <= 50)
			{
				$adapt_font = 9;
			}
		elseif ($size_string <= 60)
			{
				$adapt_font = 8;
			}
		elseif ($size_string <= 70)
			{
				$adapt_font = 7;
			}
		elseif ($size_string < 80)
			{
				$adapt_font = 6;
			}
		elseif ($size_string >= 80)
			{
				$name_votes = "{$username} likes \"{$juice_name}\"";
				$size_string3 = strlen($name_votes);
				if ($size_string3 <= 60)
				{
					$adapt_font = 10;
				}
				if ($size_string3 <= 70)
				{
					$adapt_font = 7;
				}
				elseif ($size_string3 < 80)
				{
					$adapt_font = 6;
				}
				elseif ($size_string3 >= 80)
				{
					$adapt_font = 6;
				}
			}
		$name_vendor = "From {$vendor_name}";
		$interval = $this->get_date_interval($quit_date);
		$total_cost = $interval * $cost_day;
		$total_smokes = $interval * $smokes_day;
		$vote_output = "This Juice is liked by {$votes_up} others on";
		$output_string = '$'."{$total_cost} saved not smoking {$total_smokes} cigarettes, in {$interval} days!";
			if ($interval == 1)
				{
				$output_string = '$'."{$total_cost} saved not smoking {$total_smokes} cigarettes, in {$interval} day!";
				}
			elseif ($interval == 0)
				{
				$output_string = "I just started, check back tomorrow for totals.";
				}

//Sizing the font in the middle string.
		$size_string2 = strlen($output_string);
		if ($size_string2 >= 50)
			{
				$adapt_font2 = 9;
			}
//Finally we output all this junk to the browser.
		imagettftext($im, $adapt_font, 0, $px, 13, $color_top, $font, $name_votes);
		imagettftext($im, $adapt_font2, 0, $px, 34, $color_middle, $font, $output_string);
		imagettftext($im, 8, 0, $px, 55, $color_top, $font, $vote_output);

		imagepng($im, $cache_file);
		imagedestroy($im);
		readfile($cache_file);
		}
		catch (Exeption $e)
		{
		$myFile = "webroot/banners/log.txt";
		$fh = fopen($myFile, 'w') or die();
		fwrite($fh, $e);
		}
		}

		else
		{
		header("Content-type: image/png");
		readfile($cache_file);
			//$data['users_banner'] = base_url('webroot/banners/user_banners/$juice_id.$username.png');
			//$this->load->view('banners/banner_display', $data);
		//var_dump($cache_file);
		}
	}
	function delete_banner($user_data_id, $juice_id)
	{
		$this->load->model('Banner_model');
		$data['page_title'] = "Delete banner";

		$is_logged_in = $this->tank_auth->is_logged_in();
		if(!$is_logged_in)
		{
			redirect('auth/login');
		}

		$banner_results = $this->Banner_model->get_banner($user_data_id, $juice_id);
		if (!$banner_results)
		{
			show_404();
		}
		foreach ($banner_results as $row) {

			$b_id = $row->b_id;
			$b_user_id = $row->b_user_id;
			$quit_date = $row->quit_date;
			$cost_day = $row->cost_day;
			$smokes_day = $row->b_per_day;
			$juice_id = $row->b_juice_id;
			$banner_type = $row->banner_type;
			$username = $row->username;
			$juice_name = $row->name;
			$vendor_name = $row->vendor_name;
			$votes_up = $row->votes_up;
			$votes_down = $row->votes_down;

		}

		$this->form_validation->set_rules('delete', 'Thanks', 'required');
		$data['form_user_id'] = $b_user_id;
		$data['form_juice_id'] = $juice_id;
		$data['breadcrumbs_set'] = "Delete your banner for {$juice_name}!";
		if ($this->form_validation->run() === FALSE)
		{
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('banners/delete',$data);
		$this->load->view('templates/footer');
		}
		else
		{
		$data['delete_button'] = $this->input->post('delete', TRUE);
		$this->Banner_model->delete($b_id);
		redirect('user');

		}
	}
}