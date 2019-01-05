<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Dashboard extends User_controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Friends_model', 'friends');
        $this->load->model('Chats_model', 'chats');
    }


    public function load_friends_get()
    {
        $data['friends'] = $this->friends->load_friends();
        $tr = $this->load->view('friends_list', $data, true);
        $this->response($tr);
    }

    public function add_friend_post()
    {
        $res = $this->friends->add_friend_post();
        $this->response($res);
    }

    public function new_message_post()
    {
        $res = $this->chats->new_message();
        $this->response($res);
    }

    public function load_chats_get()
    {
        $data['chats'] = $this->chats->load_chats();
        $data['uid'] = $this->__userid;
        $res = $this->load->view('chats_list', $data, true);
        $this->response($res);
    }


}