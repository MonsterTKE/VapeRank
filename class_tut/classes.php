<?php

class echoClass
{
	private $super;
	private $duper;
	private $stuper;
	protected $derper;
	public $data;

	function __construct($set_derper)
	{
		$this->derper = $set_derper;
       print "constructor has set\n" .' '. $this->derper['herp'];
	}

	public function math($x, $y)
	{
		$this->data = array(0 => 'herp',
						1 => 'derp',
						2 => 'burp',
						3 => $x * $y);

		 return $this->data;
	}

	public function echo_var($derp)
	{
		return $derp;
	}

	public function set_super($setter)
	{
		$this->super = $setter;
	}

	public function get_super()
	{
		return $this->super;
	}

}
