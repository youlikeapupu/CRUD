<?php
class Members_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function login($table,$email){
        $q= $this->db->select('id,email,password')->from($table)->where('email',$email)->get();
        return $q;
    }

    // //透過email 取得會員帳號
    // public function get_account($table,$email){
    //     $q= $this->db->select('id,email')->from($table)->where('email',$email)->get(1);
    //     return $q;
    // }

    //註冊
    public function signup($member_arr,$table){
        $this->db->insert($table, $member_arr);
    }

    //參數化新增的方式
    public function signup_q($member_arr,$table){
        // $date=date("Y-m-d H:i:s");
        // $password_encrypted = $this->my_encrypt($member_arr['pass'],EN_KEY);

        $query = $this->db->query("INSERT INTO $table  (`id`,`product`,`status`) VALUES('1','鉛筆','缺貨');");

        $this->db->insert($table, $member_arr);
    }

    public function get_id($table){
        $q= $this->db->select('id,email')->from($table)->get();
        return $q;
    }

    public function update_pass($table,$email){

        $password=substr(md5(rand()),0,8);
        $password_encrypted = $this->my_encrypt($password,EN_KEY);
        $up_data = array(
            'pwd' => $password_encrypted
            );

        $this->db->where('email', $email);
        $this->db->update($table, $up_data);
        return $password;
    }

}
?>