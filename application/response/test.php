<?php

class controller_test extends CI_Controller {
	
	function callback($a = null,$b = null,$c = null,$d = null)
	{

		$this->load->view('ajax/test', array('data' => $a .' '.$b.' '.$c.' '.$d));
	}

    function show($var, $var2) {
    
    echo $var;
    echo "<br />";
    echo $var2;
    }
}