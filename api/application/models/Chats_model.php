<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Chats_model extends Base_model
{

    private $__base_tbl;
    
    function __construct()
    {
        parent::__construct();
        $this->__base_tbl = 'chat';
    }

    public function new_message()
    {
        $message = $this->input->post('message');
        $friend_to = $this->input->post('friend_to');

        $new_message = array(
            'from_friend' => $this->__userid,
            'to_friend' => $friend_to,
            'message' => $message
        );
        $this->db->insert($this->__base_tbl, $new_message);
        return TRUE;
    }

    public function load_chats()
    {
        $data = array();

        $fid = $this->input->get('fid');

        $qry = "SELECT id, from_friend, to_friend, message,created_on 
                FROM chat 
                WHERE from_friend = $this->__userid 
                AND to_friend = $fid
                OR 
                from_friend = $fid
                AND to_friend = $this->__userid";
        $res = $this->db->query($qry)->result();
        
        return $res;

    }


}