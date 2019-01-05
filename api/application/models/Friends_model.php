<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Friends_model extends Base_model
{

    private $__base_tbl;
    
    function __construct()
    {
        parent::__construct();
        $this->__base_tbl = 'friend';
    }

    public function load_friends()
    {
        $data = array();

        $query = "select DISTINCT user_1, user_2, u1.first_name as u1_f, u1.last_name as u1_l, u2.first_name as u2_f, u2.last_name as u2_l
                  from friend f1 
                  left join user u1 on f1.user_1 = u1.id 
                  left join user u2 on f1.user_2 = u2.id 
                  where user_1 = $this->__userid or user_2 = $this->__userid";

        $res = $this->db->query($query)->result('array');
        
        if ( $res ) {
            foreach ($res as $key => $value) {
                if ( $value['user_1'] == $this->__userid ) {
                    $data[] = array(
                        'id' => $value['user_2'],
                        'first_name' => $value['u2_f'],
                        'last_name' => $value['u2_l']
                    );
                }
                else {
                    $data[] = array(
                        'id' => $value['user_1'],
                        'first_name' => $value['u1_f'],
                        'last_name' => $value['u1_l']
                    );
                }
            }
        }

        return $data;

    }

    public function add_friend_post()
    {
        $friend_email = $this->input->post('friend_email');

        $res = $this->db->select('id')
                        ->from('user')
                        ->where('email', $friend_email)
                        ->where('archive', false)
                        ->get()
                        ->first_row();
        if ( $res ) {

            $check_friend_exists = $this->db->select('user_2')
                                            ->from($this->__base_tbl)
                                            ->where('user_1', $this->__userid)
                                            ->where('user_2', $res->id)
                                            ->where('archive', false)
                                            ->get()
                                            ->result();
            if ( $check_friend_exists ) {

                $data['msg'] = 'You and '.$friend_email.' are already Friends. No need to add.';
                $data['status'] = 0;
            }
            else {
                $map_friend = array(
                    'user_1' => $this->__userid,
                    'user_2' => $res->id
                );
                $this->db->insert($this->__base_tbl, $map_friend);

                $data['msg'] = $friend_email.' has been added as your Friend.';
                $data['status'] = 1;

            }
        }
        else {
            $data['msg'] = 'Your Friend have not registered with us. Can not add now. Please inform to register first.';
            $data['status'] = -1;
        }

        return $data;

    }

}