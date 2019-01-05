<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Auth extends Base_controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
    }


    public function login_post()
    {
        $res = $this->user->authenticate();
        $this->response($res);
    }

    public function register_post()
    {
        $res = $this->user->register();
        $this->response($res);
    }


}