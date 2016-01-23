<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Other extends Base_manager {

    public function __construct() {
        parent::__construct();
    }

    public function page_not_found() {
        $head = $this->get_head();
        $header = $this->get_header();
        $nav = $this->get_nav();
        $breadcrumbs = $this->get_breadcrumbs($data = array('text_class' => 'Page Not Found'));
        $content = $this->load->view($this->_view . 'other/page_not_found', NULL, TRUE);
        $footer = $this->get_footer();
        $this->master_page($head, $header, $nav, $breadcrumbs, $content, $footer);
    }

}
