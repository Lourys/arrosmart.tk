<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

  public function index()
	{
		$this->twig->display('welcome_message');
	}
}
