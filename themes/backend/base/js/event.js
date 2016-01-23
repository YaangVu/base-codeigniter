var app = angular.module('admin-page', ['ngSanitize']);
app.controller('ajax_list_data', ['$scope', '$http', function ($scope, $http) {
        $scope.condition = {
            availableOptions: [{val: '10', name: '10'}, {val: '25', name: '25'}, {val: '50', name: '50'}, {val: '100', name: '100'}],
            limit: {val: $('#limitCon').attr('dataLimit'), name: $('#limitCon').attr('dataLimit')}
        };
        ajax_list_data($scope, $http);
        $scope.bind_list_data = function (currentPage) {
            $scope.currentPage = currentPage;
            ajax_list_data($scope, $http);
        };
        $scope.checkAll = function () {
            console.log($scope.test);
            $scope.user = angular.copy($scope.test);
        };
    }]);
app.directive('dir', function ($compile, $parse) {
    return {
        restrict: 'E',
        link: function (scope, element, attr) {
            scope.$watch(attr.content, function () {
                element.html($parse(attr.content)(scope));
                $compile(element.contents())(scope);
            }, true);
        }
    };
});