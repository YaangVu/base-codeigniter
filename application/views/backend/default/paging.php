<div class="row">
    <div class="col-xs-6">
        <div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">Showing <?php echo!$total_page ? '0 to 0 of 0 entries' : ($current_page - 1) * $limit + 1 . ' to ' . ($current_page * $limit < $total_record ? $current_page * $limit : $total_record) . ' of ' . $total_record . ' entries'; ?></div></div>
    <div class="col-xs-6">
        <div class="dataTables_paginate paging_simple_numbers">
            <ul class="pagination">
                <?php if (!$total_page) { //Nếu ko có bản ghi nào?>
                    <li class="paginate_button previous disabled"><a>Previous</a></li>
                    <li class="paginate_button next disabled"><a>Next</a></li>
                    <?php
                } else {
                    ?>
                    <li class="paginate_button previous <?php echo $current_page == 1 ? 'disabled' : ''; ?>"><a <?php if ($total_page && $current_page > 1) { ?>  ng-click="bind_list_data(currentPage = currentPage - 1)" <?php } ?>>Previous</a></li>
                    <li class="paginate_button <?php echo $current_page == 1 ? 'active' : ''; ?>"><a ng-click="bind_list_data(1)">1</a></li>
                    <?php
                    if ($total_page <= $link_display) { //Nếu tổng số trang < $link_display
                        for ($i = 2; $i < $total_page; $i++) {
                            ?>
                            <li class="paginate_button <?php echo $current_page == $i ? 'active' : ''; ?>"><a ng-click="bind_list_data(<?php echo $i; ?>)"><?php echo $i; ?></a></li>
                        <?php } ?>
                        <?php
                    } elseif ($current_page <= round($link_display / 2)) {
                        for ($i = 2; $i <= ($link_display - 2); $i++) {
                            ?>
                            <li class="paginate_button <?php echo $current_page == $i ? 'active' : ''; ?>"><a ng-click="bind_list_data(<?php echo $i; ?>)"><?php echo $i; ?></a></li>
                        <?php } ?>
                        <li class="paginate_button disabled"><a>…</a></li>
                    <?php } elseif ($current_page > $total_page - round($link_display / 2)) { ?>
                        <li class="paginate_button disabled"><a>…</a></li>
                        <?php for ($i = $total_page - ($link_display - 3); $i < $total_page; $i++) {
                            ?>
                            <li class="paginate_button <?php echo $current_page == $i ? 'active' : ''; ?>"><a ng-click="bind_list_data(<?php echo $i; ?>)"><?php echo $i; ?></a></li>
                            <?php
                        }
                    } else {
                        ?>
                        <li class="paginate_button disabled"><a>…</a></li>
                        <?php for ($i = ($current_page - 1); $i <= ($current_page + $link_display - 6); $i++) {
                            ?>
                            <li class="paginate_button <?php echo $current_page == $i ? 'active' : ''; ?>"><a ng-click="bind_list_data(<?php echo $i; ?>)"><?php echo $i; ?></a></li>
                        <?php } ?>
                        <li class="paginate_button disabled"><a>…</a></li>
                        <?php
                    }
                    if ($total_page > 1) {
                        ?>
                        <li class="paginate_button <?php echo $current_page == $total_page ? 'active' : ''; ?>"><a ng-click="bind_list_data(<?php echo $total_page; ?>)"><?php echo $total_page; ?></a></li>
                    <?php } ?>
                    <li class="paginate_button next <?php echo $current_page == $total_page ? 'disabled' : ''; ?>"><a <?php if ($total_page && $current_page < $total_page) { ?> ng-click="bind_list_data(currentPage = (!currentPage || currentPage == 1) ? 2 : currentPage + 1)" <?php } ?>>Next</a></li>
                    <?php } ?>
            </ul>
        </div>
    </div>
</div>