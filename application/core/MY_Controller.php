<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Twig twig
 * @property Auth_Manager auth
 * @property Curl curl
 */
class MY_Controller extends CI_Controller
{

  public $data;

  /**
   * MY_Controller constructor.
   */
  public function __construct()
  {
    parent::__construct();
    require(APPPATH . 'third_party/Twig_Extensions/Assets_Extension.php');

    $this->load->helper('route_helper');
    $config = [
      'paths' => [
        APPPATH . 'views/'
      ]
    ];
    $config['cache'] = false;
    $this->load->library('twig', $config);
    $this->twig->getTwig()->addExtension(new Assets_Extension());
    $this->twig->addGlobal('this', $this);

    $this->data = [];

    $this->load->library('Auth_Manager', null, 'auth');
    $this->load->library('Curl', null, 'curl');
    if (!$this->auth->isLogged()) {
      if (isset($_GET['token'])) {
        $result = $this->curl->post(API_ADDRESS . 'refreshAccessToken', ['token' => $_GET['token']]);
        $token = json_decode($result, true)['token'];
        if (isset($token)) {
          $this->auth->authenticate($token);
        } else {
          redirect(current_url());
        }
      } elseif (current_url() != route('auth/index')) {
        redirect(route('auth/index') . '?redirect=' . urlencode(current_url()));
      }
    } else {
      $result = $this->curl->post(API_ADDRESS . 'checkAccessTokenValidity', ['token' => $this->session->userdata('token')]);
      if (!json_decode($result, true)['valid']) {
        $this->auth->logout();
      }
    }
  }
}
