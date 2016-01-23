<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Base_controller {

    public function __construct() {
        parent::__construct();
    }

    function setting_class() {
        $this->setting = array(
            'class' => 'index',
            'model' => 'm_user',
            'view' => 'user',
            'title' => 'Quản lý thành viên',
            'field_table' => array(
                'id' => 'ID',
                'name' => 'Tên đăng nhập',
                'email' => 'Email',
                'phone' => 'Số điện thoại',
                'age' => 'Tuổi'
            ),
            'field_form' => array(
                'Họ và tên' => array(
                    'type' => 'text',
                    'name' => 'name',
                    'maxlength' => '255',
                    'required' => 'required',
                    'disable' => 'disable',
                    'num_col' => 4
                ),
                'Họ và tên' => array(
                    'type' => 'text',
                    'name' => 'name',
                    'maxlength' => '255',
                    'required' => 'required',
                    'disable' => 'disable',
                    'num_col' => 4
                ),
                'Họ và tên' => array(
                    'type' => 'text',
                    'name' => 'name',
                    'maxlength' => '255',
                    'required' => 'required',
                    'disable' => 'disable',
                    'num_col' => 4
                ),
            ),
            'field_rule' => array()
        );
    }

    public function demo() {
        parent::index();
    }

    public function index() {
//        $param = array(
//            array('name' => 'sdfsfse', 'email' => 'sgs@sesg.eg1', 'password' => 'seges', 'sdfsdf' => 'sdfsdf'),
//            array('name' => 'sdfsfse', 'email' => 'sgs@sesg.eg2', 'password' => 'seges', 'sdfsdf' => 'sdfsdf'),
//            array('name' => 'sdfsfse', 'email' => 'sgs@sesg.eg3', 'password' => 'seges', 'sdfsdf' => 'sdfsdf'),
//            array('name' => 'sdfsfse', 'email' => 'sgs@sesg.eg4', 'password' => 'seges', 'sdfsdf' => 'sdfsdf'),
//            array('name' => 'sdfsfse', 'email' => 'sgs@sesg.eg5', 'password' => 'seges', 'sdfsdf' => 'sdfsdf'),
//            array('name' => 'sdfsfse', 'email' => 'sgs@sesg.eg6', 'password' => 'seges', 'sdfsdf' => 'sdfsdf'),
//        );
//        $param = array('name' => 'sdfsfse', 'email' => 'sgs@sesg.eg1', 'password' => 'seges', 'sdfsdf' => 'sdfsdf');
//        $param = $this->filter_data_insert($param);
//        echo '<pre>';
//        var_dump($param);
//        exit;
//        $this->table->insert($param);
        parent::index();
    }

}
