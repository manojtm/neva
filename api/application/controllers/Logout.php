<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Logout extends Base_controller
{
    
    function __construct()
    {
        parent::__construct();
    }


    public function index_get()
    {
        $this->session->sess_destroy();

        $data = array(
            'msg' => 'You have been logged out',
            'status' => true
        );
        $this->response($data);
    }


}