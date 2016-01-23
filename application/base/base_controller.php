<?php

/**
 * Description of Base_controller
 *
 * @author: giangvt.sami@gmail.com
 * @version: 1.0.0
 * 
 * @param: bao gồm các function xử lý các tính toán logic
 * @param: thường dùng để quản lý, tương tác với database
 */
abstract class Base_controller extends Base_manager {

    var $_unique = array();
    var $_foreign = true;

    /**
     * Biến var $_display_table để custom hiển thị mặc định table
     */
    var $_display_table = array(
        'limit' => 10,
        'start' => 0,
        'search_string' => '',
        'begin_time' => '',
        'end_time' => ''
    );

    /**
     * Biến var $_field_search search datatable theo 1 string
     */
    var $_field_search = array();

    /**
     * Mảng config setting được dùng trong các hàm quản lý
     * Biến này được mô tả chi tiết trong các lớp kế thừa
     * Cấu trúc mảng:
     * Array (
     *      "class"         => "", String: Tên class
     *      "view"          => "", String: Tên view
     *      "model"         => "", String: Tên model
     *      "title"         => "", String: Tiêu đề hiển thị
     *      'field_table'   => array()    : các cột có trong bảng hiển thị
     *      'field_form'    => array()    : các trường có trong form insert + view + eidt
     *      'field_rule'    => array()    : 
     * )
     * @var Array
     */
    var $setting = Array(
        'class' => '',
        'view' => '',
        'model' => '',
        'title' => '',
        'keywords' => array(),
        'field_table' => array(),
        'field_form' => array(),
        'field_rule' => array(),
    );
    var $_sesssion;

    public function __construct() {
        parent::__construct();
        $this->load->model($this->setting['model'], 'table');
        $this->_field = $this->table->get_field();
        $this->_unique = $this->table->get_unique();
        $this->_exception = $this->table->get_exception();
        $this->_field_search = $this->table->get_field_search();

        $this->_display_table['begin_time'] = date('d/m/Y') . ' 00:00:00';
        $this->_display_table['end_time'] = date('d/m/Y') . ' 23:59:59';
        $display_table = $this->_display_table;
        if ($this->session->userdata($this->_class . 'display_table') === NULL || $this->session->userdata($this->_class . 'display_table') === FALSE) {
            $this->session->set_userdata($this->_class . 'display_table', $display_table);
        }
        $this->_sesssion = $this->session->userdata($this->_class . 'display_table');
    }

    public function index() {
        $head = $this->get_head();
        $header = $this->get_header();
        $nav = $this->get_nav();
        $breadcrumbs = $this->get_breadcrumbs();
        $footer = $this->get_footer();
        $content = $this->get_content();
        $this->master_page($head, $header, $nav, $breadcrumbs, $content, $footer);
    }

    public function _setting_config() {
        //Chạy hàm setting_class() để lấy dữ liệu khai báo từ controller
        $this->setting_class();
        $this->_view_custom = (!empty($this->setting['view']) && file_exists(APPPATH . 'views/backend/' . $this->setting['view'])) ? 'backend/' . $this->setting['view'] . '/' : $this->_view;
        $this->_title = $this->setting['title'];
        parent::_setting_config();
    }

    abstract function setting_class();

    public function _get_content_data($data = array()) {
        if (!$data) {
            $data = $this->session->userdata('display_table');
        }
        if ($this->_field_search && $data['search_string']) {
            $like = array($data['search_string'] => $this->_field_search);
        } else {
            $like = '';
        }
        $limit = $data['limit'];
        $start = $data['start'];
        $data_return['data'] = $this->table->get_list('', $limit, $start, '', $like);
        return $data_return['data'];
    }

    public function get_content($data = array()) {
        $data['data_url'] = site_url('admin/' . $this->_class . '/ajax_list_data');
        $data_return = file_exists(APPPATH . $this->_view_custom . '/content.php') ? $this->load->view($this->_view_custom . 'content', $data, TRUE) : $this->load->view($this->_view_base . 'content', $data, TRUE);
        return $data_return;
    }

    public function ajax_list_data() {
        //$data = $this->_get_content_data($data);
        $data = $this->input->post();
        if (!$data) {
            $data = $this->_sesssion;
        } else {
            $data['current_page'] = isset($data['current_page']) && is_numeric($data['current_page']) ? $data['current_page'] : 1;
            $data['order'] = (isset($data['order']) && isset($data['order']['column']) && isset($data['order']['type'])) ? $data['order'] : array('column' => $this->table->get_key(), 'type' => 'DESC');
            $data['limit'] = isset($data['limit']) && $data['limit'] ? $data['limit'] : $this->_sesssion['limit'];
            $data['searchStr'] = isset($data['searchStr']) ? $data['searchStr'] : '';
            $this->_sesssion = $this->session->set_userdata($this->_class . 'display_table', $data);
        }
        $data['link_display'] = 7; //Số button hiển thị trên thanh Paging
        $where = NULL;
        $like = NULL;
        $_field_search = $this->table->get_field_search();
        foreach ($_field_search as $val) {
            if ($data['searchStr']) {
                $like[$val] = $data['searchStr'];
            }
        }
        $data['total_record'] = $this->table->get_count($where, $like);
        $data['field'] = $this->setting['field_table'];
        $data['list_data'] = $this->table->get_list($where, $data['limit'], $data['current_page'], $data['order'], $like);
        $data['total_page'] = ceil($data['total_record'] / $data['limit']);
        $data['paging'] = $this->load->view($this->_view_default . 'paging', $data, TRUE);
        $data_return['html'] = file_exists(APPPATH . $this->_view_custom . '/table.php') ? $this->load->view($this->_view_default . 'table', $data, TRUE) : $this->load->view($this->_view_default . 'table', $data, TRUE);
        $data_return['status'] = 1;
        echo json_encode($data_return);
        return $data_return;
    }

    public function ajax_form($data = array()) {
        if (!$data) {
            $data = $this->input->post();
        }
        //Kiểm tra dữ liệu gửi lên có đúng là 1 trong 3 action: insert, view, edit
        if ($data['action'] == 'insert') {
            $data_return = $this->insert($data);
        } elseif ($data['action'] == 'view') {
            
        } elseif ($data['action'] == 'edit') {
            
        } else {
            $data_return['status'] = 0;
            $data_return['msg'] = 'Dữ liệu gửi lên không hợp lệ';
        }
        if (!isset($data_return['callback'])) {
            $data_return['callback'] = 'custom_function';
        }
        echo json_encode($data_return);
        return TRUE;
    }

    public function insert($data = array()) {
        $this->_action = site_url('admin/' . $this->_class . '/insert_save/');
        $data_return['status'] = 1;
        $data_return['msg'] = 'hsuhgeks';
        $data_return['url'] = $this->_action;
        return $data_return;
    }

    public function insert_save() {
        
    }

    public function delete($data = array()) {
        
    }

    public function really_delete() {
        
    }

    public function view($data = array()) {
        
    }

    public function edit($data = array()) {
        
    }

    public function edit_save() {
        
    }

    public function search() {
        
    }

    public function _check_unique($data = array()) {
        $unique = $this->_unique;
        $data_check = array();
        $data_return = array();
        //Nếu ko có trường dữ liệu nào cần check trùng thì return true
        if (!count($unique)) {
            $data_return['status'] = 1;
            $data_return['msg'] = '';
            return $data_return;
        }
        foreach ($unique as $key => $value) {
            if (isset($data[$value])) {
                $data_check[$value] = $data[$value];
            }
        }
        $result = $this->table->check_unique($data_check);
        if (!count($result)) {
            $data_return['status'] = 1;
            $data_return['msg'] = '';
            return $data_return;
        }
        $data_return['status'] = 0;
        $data_return['msg'] = 'Dữ liệu đã tồn tại trong hệ thống.';
        return $data_return;
    }

    public function get_modal($data = array()) {
        $data_return = $this->load->view($this->_view_default . 'modal.php', $data, TRUE);
        return $data_return;
    }

    /**
     * Hàm lọc dữ liệu trước khi insert vào DB
     * @param [array]-$data: dữ liệu cần lọc
     * @return [array]-$data: dữ liệu sau khi được lọc
     */
    public function filter_data_insert($data) {
        if ($this->_exception) {
            return $data;
        }
        foreach ($data as $key => $val) {
            //Nếu $data = array(array($key => $val), array($key => $val),  array($key => $val));
            if (is_array($val)) {
                foreach ($val as $k => $v) {
                    if (!in_array($k, $this->_field)) {
                        unset($data[$key][$k]);
                    }
                }
            } elseif (!in_array($key, $this->_field)) {
                unset($data[$key]);
            }
        }
        return $data;
    }

}
