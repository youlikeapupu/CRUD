<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

    // public $table = 'user';

    function __construct() {
        parent::__construct();
        //載入資料庫行為
        $this->load->model('Members_model');
        $this->load->library('form_validation');
        $this->table = 'user';
    }

    public function index()
    {
        //echo $this->my_function->test();
        $this->load->view('login');
    }

    public function reg()
    {
        //echo $this->my_function->test();
        $this->load->view('register');
    }

    public function list()
    {
        $table = $this->table;
        $info = array( 'id', 'email', 'name', 'gender');
        $where = "";
        $data['r'] = $this->crud->reads($table, $info, $where);

        $this->load->view('show',$data);
    }

    public function show()
    {
        $id = $this->uri->segment(3);
        $num = 1;
        $table = $this->table;
        $info = array( 'id', 'email', 'name', 'gender','lv');
        $where = "WHERE id =".$id;
        $data['r'] = $this->crud->read($table, $info, $num, $where);
        $data['r'] = $data['r']->row();

        $this->load->view('info',$data);
    }

    public function login()
    {
        // print_r($_POST);
        // echo count($_POST);
        // die();
        $table = $this->table;
        $p = $_POST;
        $status = 'error';
        $message = 'Err';
        //驗證欄位
        $vail = $this->form_validation;
        $vail->set_rules('email', 'Email', 'required');
        $vail->set_rules('password', 'Password', 'required');
        if (count($p) == 2) {
            $email = $p['email'];
            $members_data = $this->Members_model->login($table,$email);
            $status = 'sucess';
            $message = 'OK';
        }
        $r_arr = array('status' => $status,
                       'message' => $message);
        echo json_encode($r_arr);

    }

    public function register()
    {
        // echo count($_POST);
        // die();
        $table = $this->table;
        $p = $_POST;
        $status = 'error';
        $message = 'Err';
        $url = base_url('index.php/Member/reg');
        //驗證欄位
        $vail = $this->form_validation;
        $vail->set_rules('email', 'Email', 'required');
        $vail->set_rules('password', 'Password', 'required');
        $vail->set_rules('name', 'Name', 'required');
        if ($vail->run() === FALSE)
        {
            echo json_encode(array('status' => $status,
                                   'message' => validation_errors(),
                                   'r_url' => $url
                            ));
            return false;
        }
        //驗證帳號是否重複
        if (count($p['email']) > 0) {
            $email = $p['email'];
            $u_arr = array();
            $user_q = $this->Members_model->get_id($table);
            foreach ($user_q->result() as $u) {
                //echo $u->email.'<br />';
                array_push($u_arr,$u->email);
            }

            //echo $this->crud->test();
            if (in_array($email, $u_arr)) {
                echo json_encode(array('status' => $status,
                                       'message' => '帳號重複註冊',
                                       'r_url' => $url
                                ));
                return false;
            }
            //die;

        }
        //註冊
        if (count($p) == 5) {
            $en_pwd = $this->my_function->pw_encrypt($p['password']);
            $data = array('email' => $p['email'],
                          'lv' => $p['account'],
                          'name' => $p['name'],
                          'password' => $en_pwd,
                          'gender' => $p['gender'],
                          'created_at' => date("Y-m-d H:i:s")
                    );
            //$this->Members_model->signup($data,$table);
            $r = $this->crud->create($data,$table);
            $status = 'sucess';
            $message = 'OK';
            $url = base_url('index.php/Member');
        }

        $r_arr = array('status' => $status,
                        'message' => $message,
                        'r_url' => $url);
        echo json_encode($r_arr);
    }

    public function edit()
    {
        $id = $this->uri->segment(3);
        $table = $this->table;
        $p = $_POST;
        $data = array('email' => $p['email'],
                      'lv' => $p['lv'],
                      'name' => $p['name'],
                      //'password' => $en_pwd,
                      'gender' => $p['gender'],
                      'update_at' => date("Y-m-d H:i:s")
                    );
        $this->crud->update($data, $table, $id);
        redirect(base_url('index.php/Member/list'));
    }

    public function del_user()
    {
        $table = $this->table;
        $status = 'error';
        $message = 'ERR';

        if (count($_POST) == 1) {
            $id = $_POST['id'];
            $this->crud->delete($table,$id);
            $status = 'sucess';
            $message = 'OK';
        }

        $r_arr = array('status' => $status,
                        'message' => $message,
                      );
        echo json_encode($r_arr);
    }

}
