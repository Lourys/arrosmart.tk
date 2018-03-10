<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

  public function index()
	{
    $this->data['title'] = 'Authentification';

		$this->twig->display('auth/index', $this->data);
	}

  public function authenticate()
  {
    $this->library->load('API_caller', null, 'api');

    $result = $this->api->call('getAccessToken', 'POST', $this->input->post());

    var_dump($result);
  }
}
