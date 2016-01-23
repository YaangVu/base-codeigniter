<div class="page-content" ng-controller="ajax_list_data">
    <div class="page-header">
        <h1>
            <?php echo isset($text_method) ? ucfirst($text_method) : ucfirst($text_class); ?>
        </h1>
    </div><!-- /.page-header -->

    <!-- PAGE CONTENT BEGINS -->
    <div class="table-header">
        Results for "<?php echo isset($text_method) ? ucfirst($text_method) : ucfirst($text_class); ?>"
    </div>
    <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">
        <div class="row">
            <div class="col-xs-6">
                <div class="dataTables_length" id="dynamic-table_length">
                    <!--<label>Display <select aria-controls="dynamic-table" class="form-control input-sm e_data_ajax_table" ng-model="data.selectedOption" ng-options="option.name for option in data.availableOptions track by option.id" ng-change="bind_list_data()"></select> records</label>-->
                    <label>Display <select dataLimit="<?php echo $this->session->userdata($this->_class . 'display_table')['limit']; ?>" name="mySelect" id="limitCon" ng-options="option.name for option in condition.availableOptions track by option.val" ng-model="condition.limit" ng-change="bind_list_data()" ></select> records</label>
                </div>
            </div>
            <div class="col-xs-6"><div id="dynamic-table_filter" class="dataTables_filter"><label>Search:<input ng-change="bind_list_data()" ng-model="condition.searchStr" name="search_string" type="search" class="form-control input-sm e_data_ajax_table" placeholder="" ng-model-options="{debounce: 500}"></label></div></div>
        </div>
        <!--table-->
        <dir class="e_data_table" linkData="<?php echo $data_url; ?>" content='myTable'></dir>
    </div>
</div><!-- /.page-content -->