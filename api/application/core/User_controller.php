<?php
/**
 * 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class User_controller extends REST_Controller
{

    protected $__userid;
    
    function __construct()
    {
        parent::__construct();
        
        if ( ! $this->session->userdata('id') ) $this->response( array('msg' => 'You are logged out.', 'status' => 1) );

        $this->__userid = $this->session->userdata('id');
    }
}