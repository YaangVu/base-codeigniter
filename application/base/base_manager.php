<?php

/**
 * Description of Base_manager
 *
 * 
 * @author: giangvt.sami@gmail.com
 * @version: 1.0.0
 * 
 * @param: bao gồm các function có nhiệm vụ xuất dữ liệu ra view
 * @param: các function có tiền tố "_function" để kiểm tra điều kiện, ko tương tác trực tiếp với view
 */
class Base_manager extends CI_Controller {

    /**
     *
     * Khai báo biến mặc định
     * @var $_view: folder chứa file view mặc định
     * @var $_themes_lib: folder chứa các file img, css, js mặc định
     * @var $_themes_custom: folder chứa các file img, css, js của người khác thêm vào
     * @var $_logo: đường dẫn đến file logo 
     * @var $_favicon: đường dẫn đến file .ico 
     */
    var $_view = '';
    var $_view_custom = '';
    var $_view_default = '';
    var $_view_base = '';
    var $_themes_lib = '';
    var $_themes_custom = '';
    var $_logo = '';
    var $_favicon = '';
    var $_data_themes = array();
    var $_title = '';

    /**
     * Khai báo action default của form
     * Kiểm tra class + method hiện tại
     */
    var $_class = '';
    var $_method = '';
    var $_action = '';

    /**
     * Biến để tạo session
     * @var $_user_data: đường dẫn đến file logo 
     * @var $_user_custom: đường dẫn đến file logo 
     */
    var $_user_data = array();
    var $_user_custom = array();

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->_setting_config();
    }

    public function index() {
        $head = $this->get_head();
        $header = $this->get_header();
        $nav = $this->get_nav();
        $breadcrumbs = $this->get_breadcrumbs();
        $content = $this->get_content();
        $footer = $this->get_footer();
        $this->master_page($head, $header, $nav, $breadcrumbs, $content, $footer);
    }

    public function _setting_config() {
        $this->_view = 'backend/';
        $this->_view_default = 'backend/default/';
        $this->_view_base = 'backend/base/';

        $this->_themes_lib = base_url('themes/libs/');
        $this->_themes_custom = base_url('themes/backend/');

        $this->_logo = base_url('themes/libs/images/logo/logo.png');
        $this->_favicon = base_url('themes/libs/images/logo/favicon.ico');

        $this->_class = $this->router->fetch_class();
        $this->_method = $this->router->fetch_method();

        if (!$this->_title) {
            $this->_title = 'Dashboard';
        }
    }

    public function get_head($data = array()) {
        $data_return = $this->load->view('backend/base/' . 'head', $data, TRUE);
        $data_return .= (file_exists(APPPATH . $this->_view_custom . '/head.php')) ? $this->load->view(APPPATH . $this->_view_custom . 'head', $data, TRUE) : '';
        return $data_return;
    }

    public function get_header($data = array()) {
        $data_return = $this->load->view($this->_view_base . 'header', $data, TRUE);
        return $data_return;
    }

    public function _get_nav_data($data = array()) {
        $data[] = array(
            'text' => 'Dashboard',
            'icon' => 'fa-tachometer',
            'url' => site_url('admin'),
            'class' => 'index'
        );
        $data[] = array(
            'text' => 'Quản lý thành viên',
            'icon' => 'fa-user',
            'url' => site_url('admin'),
            'class' => 'user',
            'child' => array(
                array(
                    'text' => 'Tạo mới thành viên',
                    'url' => site_url('admin/user/ajax_form'),
                    'method' => 'demo',
                    'class_html' => 'e_ajax_link'
                ),
                array(
                    'text' => 'Danh sách thành viên',
                    'url' => site_url('admin/user'),
                    'method' => 'index',
                ),
            )
        );

        //Kiểm tra data để in ra breadcrumb
        foreach ($data as $key => $val) {
            if ($val['class'] == $this->_class) {
                $data_return['text_class'] = $val['text'];
                if (isset($val['child'])) {
                    foreach ($val['child'] as $key_child => $val_child) {
                        $data_return['text_method'] = ($val_child['method'] == $this->_method) ? $val_child['text'] : '';
                        if ($data_return['text_method'] != '') {
                            break;
                        }
                    }
                }
            } else {
                continue;
            }
        }
        $data_return['data_nav'] = $data;
        return $data_return;
    }

    public function get_nav($data = array()) {
        if (!$data) {
            $data = $this->_get_nav_data(array());
        }
        $data_return = $this->load->view($this->_view_base . 'nav', $data, TRUE);
        return $data_return;
    }

    public function _get_content_data($data = array()) {
        return $data;
    }

    public function get_content($data = array()) {
        return NULL;
    }

    public function get_breadcrumbs($data = array()) {
        $data_return = $this->load->view($this->_view_base . 'breadcrumbs', $data, TRUE);
        return $data_return;
    }

    public function get_footer($data = array()) {
        $data_return = $this->load->view($this->_view_base . 'footer', $data, TRUE);
        return $data_return;
    }

    public function master_page($head, $header, $nav, $breadcrumbs, $content, $footer, $modal_form = NULL) {
        $data = array();
        $data['head'] = $head;
        $data['header'] = $header;
        $data['nav'] = $nav;
        $data['breadcrumbs'] = $breadcrumbs;
        $data['content'] = $content;
        $data['footer'] = $footer;
        $data['modal_form'] = $modal_form;
        $this->load->view($this->_view_base . 'master_page', $data);
    }

    /**
     * Hàm kiểm tra có là email hay không?
     * @param String $email địa chỉ email cần kiểm tra
     * @return boolean
     */
    protected function _validate_email($email) {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
    }

    public function _validate() {
        
    }

    public function _check_permission() {
        
    }

}
