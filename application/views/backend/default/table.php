<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <?php
            foreach ($field as $val) {
                echo '<th>' . $val . '</th>';
            }
            ?>
            <th class="center">
                <label class="pos-rel">
                    <!--<input type="checkbox" class="ace" ng-model="masterCheckbox" ng-true-value="'success'" ng-false-value="''" ng-click="demo()"/>-->
                    <input type="checkbox" class="ace" ng-click="checkAll()" ng-model="master_checkbox"/>
                    <span class="lbl"></span>
                </label>
            </th>
        </tr>
    </thead>

    <tbody>
        <?php
        $i = 1;
        foreach ($list_data as $row) {
            echo '<tr class="">';
            foreach ($field as $key => $val) {
                echo '<td>' . $row->$key . '</td>';
            }
            echo '<td class="center">
                    <label class="pos-rel">
                        <input type="checkbox" class="ace"  ng-click="isChecked($event)"/>
                        <span class="lbl"></span>
                    </label>
                </td>';
            echo '</tr>';
            $i++;
        }
        ?>
    </tbody>
</table>
<?php echo $paging; ?>