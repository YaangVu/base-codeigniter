/* 
 * @descreption: Tổng hợp các hàm sử dụng
 * @author: giangvt.sami@gmail.com
 * @version: 1.0.0
 */

function e_ajax_form(obj, action) {
    var url = obj.attr('href');
    if (action !== 'insert' && action !== 'view' && action !== 'delete') {
//jgrow Thông báo action ko hợp lệ
        alert('sai action');
        return false;
    }
    if (action !== 'insert') {
        var id = obj.attr('data-id');
    }
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            action: action
        },
        dataType: 'json',
//        async: false,
        success: function (result) {
            if (result.status) {
                if (window[result.callback]) {
                    console.log("Gọi hàm: ", result.callback);
                    window[result.callback](result, obj);
                } else {
                    console.log("Không tìm thấy hàm yêu cầu:'", result.callback, "'-->Tự động gọi hàm xử lý mặc định 'default_ajax_form'");
                    default_ajax_form(result, obj);
                }
            } else {
                //jgrow báo lỗi
            }
        },
        error: function () {
            //jgrow Thông báo action ko hợp lệ
            alert('url không hợp lệ');
            return false;
        }
    });
}

function default_ajax_form(result, obj) {
    $('#modal-form form').attr('action', result.url);
    $('#modal-form form .modal-body').html(result.msg);
    $('#modal-form').modal({
        "backdrop": "static",
        "keyboard": true
    });
}

function ajax_list_data($scope, $http) {
    $http({
        method: 'POST',
        url: $('.e_data_table').attr('linkData'),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        },
        data: $.param({
            limit: $scope.condition.limit.val,
            searchStr: $scope.condition.searchStr,
            current_page: $scope.currentPage
        })
    }).then(function successCallback(response) {
        $scope.myTable = response.data.html;
    }, function errorCallback(response) {
        show_jgrow(0, 'Không tìm thấy hàm yêu cầu.');
    });
}

function show_jgrow(btn, msg, callback, obj) {
    if (btn) {
        var jgrow = "btn-success";
        var icon = 'fa-check';
    } else {
        var jgrow = "btn-danger";
        var icon = '';
    }
    $.jGrowl("<i class='fa " + icon + "' style='color:#fff; font-size: 20px;'> &nbsp" + msg + "</i> ", {
        closer: false,
        group: jgrow,
        position: 'top-right',
        sticky: false,
        animateOpen: {
            width: 'show',
            height: 'show'
        },
        afterOpen: function () {
            if (window[callback]) {
                console.log("Gọi hàm: ", callback);
                window[callback](obj);
            } else {
                console.log("Không tìm thấy hàm yêu cầu:'", callback);
            }
        }
    });
}

function page_not_found() {
    window.location.href = (_page_not_found);
}