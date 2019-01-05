<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Base_model extends CI_Model
{
    
    protected $__userid;
    protected $__username;

    function __construct()
    {
        parent::__construct();
        $this->__userid = $this->session->userdata('id');
    }
}