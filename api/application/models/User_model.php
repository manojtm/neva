<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class User_model extends Base_model
{

    private $__base_tbl;
    
    function __construct()
    {
        parent::__construct();
        $this->__base_tbl = 'user';
    }

    public function authenticate()
    {
        $data = array();
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $res = $this->db->select('id, first_name, last_name, archive')
                        ->from($this->__base_tbl)
                        ->where('email', $username)
                        ->where('password', md5($password))
                        ->get()
                        ->first_row('array');
        if ( $res ) {
            if ( $res['archive'] ) {
                $data['msg'] = 'Profile is Inactive!. Please re-register with new email id to proceed.';
                $data['status'] = -1;
            }
            else {
                unset($res['archive']);
                $this->session->set_userdata($res);
                $data['msg'] = 'Login success. Loading dashboard';
                $data['status'] = 1;
                $data['data'] = $res;
            }
        }
        else {
            $data['msg'] = 'Username or Password is wrong';
            $data['status'] = 0;
        }
        return $data;
    }

    public function register()
    {
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $check_user_exists = $this->db->select('id')
                                    ->from($this->__base_tbl)
                                    ->where('email', $username)
                                    ->get()
                                    ->first_row();
        if ( $check_user_exists ) {
            $data = array(
                'msg' => 'The Username exists. Login to continue',
                'status' => 0
            );
        }
        else {
            $new_user = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $username,
                'password' => md5($password)
            );
            $this->db->insert($this->__base_tbl, $new_user);
            $data = array(
                'msg' => 'Account created!. Login to cotinue.',
                'status' => 1
            );
        }
        return $data;
    }

}