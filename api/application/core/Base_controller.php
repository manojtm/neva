<?php
/**
 * 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Base_controller extends REST_Controller
{
    
    function __construct()
    {
        parent::__construct();
    }
}