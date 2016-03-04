<title><?php echo $this->_title; ?> - HỌC THÀNH TÀI</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<meta name="description" content="hocthanhtai.com.vn nơi chia sẻ kiến thức và thủ thuật sử dụng PHP, hướng dẫn học HTML CSS JAVASCRIP" />
<meta name="keywords" content="HTML,CSS,XML,JavaScript,Codeigniter" />
<meta name="author" content="giangvt.sami" />
<link href="<?php echo $this->_favicon; ?>" rel="shortcut icon" />

<!-- bootstrap & fontawesome -->
<link rel="stylesheet" href="<?php echo $this->_themes_lib; ?>/css/bootstrap.css" />
<link rel="stylesheet" href="<?php echo $this->_themes_lib; ?>/css/font-awesome.css" />

<!-- page specific plugin styles -->

<!-- text fonts -->
<link rel="stylesheet" href="<?php echo $this->_themes_lib; ?>/css/ace-fonts.css" />

<!-- ace styles -->
<link rel="stylesheet" href="<?php echo $this->_themes_lib; ?>/css/ace.css" />

<!-- ace settings handler -->
<script src="<?php echo $this->_themes_lib; ?>/js/ace-extra.js"></script>

<!--[if !IE]> -->
<script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo $this->_themes_lib; ?>/js/jquery.js'>" + "<" + "/script>");
</script>

<script type="text/javascript">
    if ('ontouchstart' in document.documentElement)
        document.write("<script src='<?php echo $this->_themes_lib; ?>/js/jquery.mobile.custom.js'>" + "<" + "/script>");
</script>

<script src="<?php echo $this->_themes_lib; ?>/js/bootstrap.js"></script>

<!-- ace scripts -->
<script src="<?php echo $this->_themes_lib; ?>/js/ace/elements.scroller.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/elements.colorpicker.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/elements.fileinput.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/elements.typeahead.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/elements.wysiwyg.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/elements.spinner.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/elements.treeview.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/elements.wizard.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/elements.aside.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/ace.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/ace.ajax-content.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/ace.touch-drag.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/ace.sidebar.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/ace.sidebar-scroll-1.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/ace.submenu-hover.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/ace.widget-box.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/ace.settings.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/ace.settings-rtl.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/ace.settings-skin.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/ace.widget-on-reload.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/ace.searchbox-autocomplete.js"></script>

<!-- the following scripts are used in demo only for onpage help and you don't need them -->
<link rel="stylesheet" href="<?php echo $this->_themes_lib; ?>/css/ace.onpage-help.css" />
<link rel="stylesheet" href="<?php echo $this->_themes_lib; ?>/docs/assets/js/themes/sunburst.css" />

<script type="text/javascript"> ace.vars['base'] = '<?php echo $this->_themes_lib; ?>';</script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/elements.onpage-help.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/ace/ace.onpage-help.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/docs/assets/js/rainbow.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/docs/assets/js/language/generic.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/docs/assets/js/language/html.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/docs/assets/js/language/css.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/docs/assets/js/language/javascript.js"></script>

<link rel="stylesheet" href="<?php echo $this->_themes_lib; ?>/css/jquery.jgrowl.min.css" />
<script src="<?php echo $this->_themes_lib; ?>/js/jquery.jgrowl.min.js"></script>

<!--AngularJS-->
<script src="<?php echo $this->_themes_lib; ?>/js/angular/angular.min.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/angular/angular-sanitize.min.js"></script>
<script src="<?php echo $this->_themes_lib; ?>/js/angular/checklist-model.js"></script>

<!--My css + js-->
<link rel="stylesheet" href="<?php echo $this->_themes_custom; ?>/base/css/style.css" />
<script src="<?php echo $this->_themes_custom; ?>/base/js/function.js"></script>
<script src="<?php echo $this->_themes_custom; ?>/base/js/event.js"></script>

<!--khai báo biến toàn cục trong các function js-->
<script> var _page_not_found = '<?php echo site_url('admin/other/page_not_found'); ?>';</script>