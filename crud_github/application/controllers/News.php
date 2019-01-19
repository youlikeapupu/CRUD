<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

    // public $table = 'user';

    function __construct() {
        parent::__construct();
        //載入資料庫行為
        $this->load->model('Members_model');
        $this->load->library('form_validation');
        $this->table = 'posts';
    }

    public function index()
    {
        //echo $this->my_function->test();
        $this->load->view('login');
    }

    public function creates()
    {
        //echo $this->my_function->test();
        $this->load->view('news_c');
    }

    public function create()
    {
        //print_r($_POST);
        $table = $this->table;
        $p = $_POST;
        $data = array('title' => $p['title'],
                      'depiction' => $p['depiction']
                      // 'created_at' => ''
                    );
        $data_k_arr = array('title','depiction','created_at');
        $r = $this->crud->creates($data, $table, $data_k_arr);

        print_r($r);
        die();
    }

}
