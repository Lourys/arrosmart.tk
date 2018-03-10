<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Authentication manager
 *
 * @property CI_Controller CI
 */
class Auth_Manager
{
  /**
   * Auth_Manager constructor.
   */
  function __construct()
  {
    $this->CI =& get_instance();
  }

  /**
   * Log user by username
   *
   * @param string $username
   * @param string $password
   *
   * @return object|null
   */
  function loginByUsername($username, $password)
  {
    // Simple check
    if (empty($username) || empty($password)) {
      return null;
    }


    return null;
  }

  /**
   * Log user by username
   *
   * @param string $email
   * @param string $password
   *
   * @return object|null
   */
  function loginByEmail($email, $password)
  {
    // Simple check
    if (empty($email) || empty($password)) {
      return null;
    }


    return null;
  }

  /**
   * Get user by id
   *
   * @param int $id
   *
   * @return object|null
   */
  function getUser($id)
  {
    // Simple check
    if (empty($id)) {
      return null;
    }


    return null;
  }

  /**
   * Check if user is logged
   *
   * @return bool
   */
  function isLogged()
  {
    return !is_null($this->CI->session->userdata('token')) ? true : false;
  }


  /**
   * Authenticate user
   *
   * @param string $token
   */
  function authenticate($token)
  {
    $this->CI->session->set_userdata(['token' => $token]);
  }


  /**
   * Logout current user
   */
  public function logout()
  {
    $this->CI->session->unset_userdata(array_keys($this->CI->session->userdata()));
    redirect(base_url());
  }
}
