<?php

class a_jazzy extends CI_Controller {
	
	function callback($a = null,$b = null,$c = null,$d = null) {
		$this->load->library('tank_auth');
		//echo date('Y-m-d H:i:s');
		//$this->load->view('ajax/flash', $data);
	}

    function show($var, $var2) {

        $data['user'] = $var2;
        $data['number'] = $var;
        

        $this->load->view('ajax/flash', $data);
 		}

    function welcome($hello) {

        $ajax = ajax();
        $ajax->success($hello, 3);
    }

        function post_sample()
    {
        echo 'Response is<pre>'.print_r($_POST,1).'</pre>';
    }
}