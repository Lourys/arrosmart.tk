<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

  public function index()
	{
		$this->twig->display('auth/index');
	}
}
