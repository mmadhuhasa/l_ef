angular.module('notams', ['multipleDatePickerNotam'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    })
    .directive('numeric', ['$compile', '$log', function($compile, $log) {
        return {
            restrict: 'A',
            require: 'ngModel',
            link: function(scope, elem, attrs, ctrl) {
                attrs.$set("ngTrim", "false");
                ctrl.$parsers.push(function(value) {
                    var regex = new RegExp("^[0-9]+$");

                    value = value.replace(/[^0-9]/g, '');

                    if (value > 2359) {
                        value = "2359";
                    }
                    ctrl.$setViewValue(value);
                    ctrl.$render();
                    return value;
                });
                ctrl.$formatters.push(function(value) {
                    return value;
                });
            }
        };
    }])
    .directive('bsPopover', function() {
        return function(scope, element, attrs) {
            element.find("input[rel=popover]").popover({ placement: 'top', html: 'true', trigger: "hover" });
        };
    })
    .controller('recentNotamsCtrl', function($scope, $http, $window,$compile,$location) {
        $scope.inputArr = [];
        $scope.innerArr = [false, false];
        $scope.notamTimeObj = {};
        $scope.notamTimeObj.notamTime = [];
        $scope.inputArr.push(angular.copy($scope.innerArr));
        $scope.disableFuture = false;
        $scope.disablePast = false;
        $scope.showTimeSection = true;
        $scope.weekDaysName = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $scope.weekdayArr = [false, false, false, false, false, false, false];

        var url_string = window.location.href
        var url = new URL(url_string);
        $scope.code = url.searchParams.get('id');
        $scope.count = url.searchParams.get('count');

        $scope.loadDatePicker = function(event, start, end, notam_no, notam_id, aerodrome, type, time) {
            $scope.notamTimeObj = {};
            $scope.notamTimeObj.notamTime = [];

            $scope.notam_id = notam_id;
            $scope.disableFuture = false;
            $scope.disablePast = true;
            $scope.startAt = moment(start);
            $scope.endAt = moment(end);
            $scope.beginMonth = angular.copy($scope.startAt);
            $scope.notamTimeObj.notam_no = notam_no;
            $scope.notamTimeObj.aerodrome = aerodrome;
            $scope.notamTimeObj.type = 'new';

            // console.log($scope.disablePast);
            $scope.selectedNotamDates = [];
            $scope.daily = false;
            $('.notify-bg').show();
            $('.notify-bg').css('height', $(document).height());
            $('.notify-bg').css('opacity', 0.5);
            $scope.positionVarDatePicker = { left: event.pageX + 25, top: event.pageY, display: 'block' };
            $scope.$broadcast('onDaily', 'data');
            if (type) {
                // console.log();
                $scope.notamTimeObj.type = 'edit';
                $http.get(base_url + '/notamsops/getnotamtiming?id=' + notam_id)
                    .success(function(data) {
                        // console.log(data);
                        if (data[0].is_daily == 1) {
                            console.log('daily');
                            console.log(data);
                            $scope.daily = true;
                            $scope.dailyClick();
                            for (var i = 0; i < data.length; i++) {
                                $scope.notamTimeObj.notamTime = [];
                                $scope.notamTimeObj.notamTime[i] = {};
                                $scope.notamTimeObj.notamTime[i].start = data[i]['start_time'];
                                $scope.notamTimeObj.notamTime[i].end = data[i]['end_time'];
                            };

                        } else if (data[0].is_weekly == 1) {
                            var weekDayName = time.toLowerCase().substring(0, 3);
                            var weekTimeObj = {};
                            var weekDays = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
                            for (var i = 0; i < 7; i++) {
                                var argStartName = weekDays[i] + "_start_time";
                                var argEndName = weekDays[i] + "_end_time";
                                if (weekTimeObj[data[0][argStartName] + '-' + data[0][argEndName]]) {
                                    weekTimeObj[data[0][argStartName] + '-' + data[0][argEndName]] = weekTimeObj[data[0][argStartName] + '-' + data[0][argEndName]] + ',' + weekDays[i];
                                } else {
                                    if (data[0][argStartName]) {
                                        weekTimeObj[data[0][argStartName] + '-' + data[0][argEndName]] = weekDays[i];
                                    }
                                }
                            };
                            $scope.$broadcast('setWeekValues', {
                                data: weekTimeObj
                            });
                            console.log(weekTimeObj);
                            $scope.notamTimeObj.notamTime = [];
                            $scope.notamTimeObj.notamTime[0] = {};
                            $scope.notamTimeObj.notamTime[0].start = data[0][weekDayName + '_start_time'];
                            $scope.notamTimeObj.notamTime[0].end = data[0][weekDayName + '_end_time'];

                        } else if (data[0].is_date_specific == 1) {
                            $scope.specificDateOnly = true;
                            console.log('is date specific');
                            var notam_dates = data[0].notam_dates.split(',');
                            // console.log(notam_dates);

                            for (var i = 0; i < notam_dates.length; i++) {
                                $scope.selectedNotamDates.push(moment(notam_dates[i], 'DD-MM-YYYY'));
                            };
                            $scope.notamTimeObj.notamTime = [];
                            $scope.notamTimeObj.notamTime[0] = {};
                            $scope.notamTimeObj.notamTime[0].start = data[0]['datespecific_start_time'];
                            $scope.notamTimeObj.notamTime[0].end = data[0]['datespecific_end_time'];
                            // console.log($scope.selectedNotamDates);

                        }
                    });
            } else {
                console.log('new');
            }
        };
        $scope.monthChanged = function(newMonth, oldMonth) {

            if ($scope.endAt.month() == newMonth.month() && $scope.endAt.year() == newMonth.year()) {
                $scope.disableFuture = true;
                $scope.disablePast = false;
            } else if ($scope.startAt.month() == newMonth.month() && $scope.startAt.year() == newMonth.year()) {
                $scope.disablePast = true;
                $scope.disableFuture = false;
            } else {
                $scope.disableFuture = false;
                $scope.disablePast = false;
            }
        }
        $scope.addMore = function() {
            if ($scope.inputArr.length < 3) {
                $scope.inputArr.push(angular.copy($scope.innerArr));
            }
        }
        $scope.saveTiming = function() {
            $scope.notamTimeObj.notam_id = $scope.notam_id;
            $scope.notamTimeObj.specificDateOnly = false;

            if ($scope.notamTimeObj.isDaily == true) {

            } else if ($scope.notamTimeObj.isWeekly == true) {
                $scope.notamTimeObj.weekDaysStatus = $scope.weekdayArr;
            } else if ($scope.specificDateOnly == true) {
                $scope.notamTimeObj.specificDateOnly = true;
                var selectedNotamDates = [];
                for (var i = 0; i < $scope.selectedNotamDates.length; i++) {
                    selectedNotamDates.push($scope.selectedNotamDates[i].format('DD-MM-YYYY'));
                };
                $scope.notamTimeObj.selectedNotamDates = selectedNotamDates.join();
            }
            console.log($scope.notamTimeObj);
            if (!$scope.notamTimeObj.specificDateOnly && !$scope.notamTimeObj.isDaily && !$scope.notamTimeObj.isWeekly) {
                alert('Choose Type');
                return;
            }
            if ($scope.notamTimeObj.notamTime.length == 0) {
                alert('Choose Time');
                return;
            }

            // console.log($scope.notamTimeObj);

            // return;
            $('.date-picker-time').hide();
            if ($scope.notamTimeObj.type == 'edit') {
                $http({
                    method: 'POST',
                    url: base_url + '/notamsops/editnotamtime',
                    data: $scope.notamTimeObj,
                    'Content-Type': 'application/json',
                }).success(function(data) {
                    // console.log('data',data);
                    $('.notify-bg').hide();
                     el = document.getElementById('notam_timing_'+$scope.notamTimeObj.notam_id);
                     // console.log(el);
                     angular.element(el).html( $compile(data)($scope) );
                    $scope.checkPendingEdit($scope.code,$scope.count);

                })
            } else {
                $http({
                    method: 'POST',
                    url: base_url + '/notamsops/updatetime',
                    data: $scope.notamTimeObj,
                    'Content-Type': 'application/json',
                }).success(function(data) {
                    $('.notify-bg').hide();
                     el = document.getElementById('notam_timing_'+$scope.notamTimeObj.notam_id);
                     // console.log(el);
                     angular.element(el).html( $compile(data)($scope) );
                    $scope.checkPendingEdit($scope.code,$scope.count);

                })
            }



        };
        $scope.checkPendingEdit = function(code,count){
            if(count==null){
                count = 100000;
            }

             $http.get(base_url + '/notamsops/checkPendingEdit?code=' + code+'&count='+count)
                    .success(function(data) {
                        console.log(data);
                        $scope.count = data.count;
                    })
        }
        $scope.checkPendingEdit($scope.code,$scope.count);
        $scope.loadNotamTiming = function(notam_id){
             $http.get(base_url + '/notamsops/getnotamtiming?id=' + notam_id)
                    .success(function(data) {
                        console.log(data);
                    })
        }
        $scope.onTimeInputChange = function(event) {
            if ($('#' + event).val().length == 4) {
                if (event.indexOf('start') > -1) {
                    $('#end' + event.substring(event.length - 1, event.length )).focus();
                }
                // console.log(event.substring(event.length - 1, event.length));
            }
            console.log(event);
            for (var i = 0; i < $scope.notamTimeObj.notamTime.length; i++) {
                if ($scope.notamTimeObj.notamTime[i].start > $scope.notamTimeObj.notamTime[i].end) {
                    $scope.inputArr[i][1] = true;
                    $("#end" + (i + 1)).popover({
                        trigger: 'hover',
                    });
                    $("#end" + (i + 1)).attr('data-content', "End time less than start time");
                    $("#end" + (i + 1)).parent().addClass('error');
                    $("#end" + (i + 1)).popover('show');
                } else {
                    $("#end" + (i + 1)).popover('destroy');
                    $("#end" + (i + 1)).parent().removeClass('error');
                }
                if (i > 0 && ($scope.notamTimeObj.notamTime[i].start < $scope.notamTimeObj.notamTime[i - 1].end)) {
                    $scope.inputArr[i][0] = true;
                    $("#start" + (i + 1)).popover({
                        trigger: 'hover',
                    })
                    $("#start" + (i + 1)).attr('data-content', "Start time less than last end time");
                    $("#start" + (i + 1)).parent().addClass('error');
                    $("#start" + (i + 1)).popover('show');
                } else {
                    $("#start" + (i + 1)).popover('destroy');
                    $("#start" + (i + 1)).parent().removeClass('error');
                }
            };
        }
        $scope.changeTypeToSpecificDate = function() {
            if ($scope.specificDateOnly == true) {
                $scope.daily = false;
                $scope.sun = false;
                $scope.mon = false;
                $scope.tue = false;
                $scope.wed = false;
                $scope.thu = false;
                $scope.fri = false;
                $scope.sat = false;
                // $scope.selectedNotamDates = [];
            }
        }
        $scope.setAllWeekDays = function(weekindex, status) {
            $scope.specificDateOnly = false;
            weekindex = parseInt(weekindex);
            $scope.weekdayArr[weekindex] = status;
            var startMoment = angular.copy($scope.startAt);
            var endMoment = angular.copy($scope.endAt);
            var startOfWeek = angular.copy(angular.copy(startMoment).startOf('week'));
            var numberOfWeeks = endMoment.diff(startMoment, 'weeks');
            var firstDate = angular.copy(startOfWeek.weekday(weekindex));
            // console.log(numberOfWeeks);
            console.log(status);
            if (status == true) {
                console.log('true')
                $scope.notamTimeObj.isWeekly = true;
                $scope.notamTimeObj.isDaily = false;
                $scope.daily = false;

                for (var i = 0; i <= numberOfWeeks; i++) {
                    if (i == 0 && firstDate.diff(startMoment, 'days') >= 0) {
                        $scope.selectedNotamDates.push(angular.copy(firstDate.add(0, 'days')));
                    } else {
                        var newDateTobAdded = angular.copy(firstDate.add(7, 'days'));
                        if (newDateTobAdded.diff(endMoment, 'days') <= 0) {
                            $scope.selectedNotamDates.push(newDateTobAdded);
                        }
                    }

                    if (i > 400) {
                        break;
                    }
                };
            } else {
                for (var i = 0; i < $scope.selectedNotamDates.length; i++) {
                    if ($scope.selectedNotamDates[i].weekday() == weekindex) {
                        $scope.selectedNotamDates.splice(i, 1);
                        i--;
                    }
                };
            }
            console.log($scope.selectedNotamDates);
        };
        $scope.$on('weekDayClick', function(event, data) {
            // console.log(data);
            var weekindex = '';
            switch (data) {
                case 'Su':
                    weekindex = 0;
                    $scope.sun = !$scope.sun;
                    $scope.setAllWeekDays(weekindex, $scope.sun);
                    break;
                case 'Mo':
                    weekindex = 1;
                    $scope.mon = !$scope.mon;
                    $scope.setAllWeekDays(weekindex, $scope.mon);
                    break;
                case 'Tu':
                    weekindex = 2;
                    $scope.tue = !$scope.tue;
                    $scope.setAllWeekDays(weekindex, $scope.tue);
                    break;
                case 'We':
                    weekindex = 3;
                    $scope.wed = !$scope.wed;
                    $scope.setAllWeekDays(weekindex, $scope.wed);
                    break;
                case 'Th':
                    weekindex = 4;
                    $scope.thu = !$scope.thu;
                    $scope.setAllWeekDays(weekindex, $scope.thu);
                    break;
                case 'Fr':
                    weekindex = 5;
                    $scope.fri = !$scope.fri;
                    $scope.setAllWeekDays(weekindex, $scope.fri);
                    break;
                case 'Sa':
                    weekindex = 6;
                    $scope.sat = !$scope.sat;
                    $scope.setAllWeekDays(weekindex, $scope.sat);
                    break;
            }
        });
        $scope.dailyClick = function() {
            if ($scope.daily == undefined) {
                return;
            };
            $scope.notamTimeObj.isDaily = $scope.daily;
            if ($scope.daily) {
                $scope.$broadcast('onDaily', 'data');
                $scope.specificDateOnly = false;
                $scope.sun = false;
                $scope.mon = false;
                $scope.tue = false;
                $scope.wed = false;
                $scope.thu = false;
                $scope.fri = false;
                $scope.sat = false;
                var startAt = angular.copy($scope.startAt);
                for (var i = 0; i <= $scope.endAt.diff($scope.startAt, 'days'); i++) {
                    if (i == 0) {
                        $scope.selectedNotamDates.push(angular.copy(startAt.add(0, 'days')));
                    } else {
                        $scope.selectedNotamDates.push(angular.copy(startAt.add(1, 'days')));
                    }
                    if (i > 500) {
                        break;
                    }
                };
            } else {
                $scope.selectedNotamDates = [];
            }
        };
        $scope.closeCalendar = function() {
            $('.notify-bg').hide();
            $('.date-picker-time').hide();
        };
        $scope.removeRow = function(index) {
            $scope.inputArr.splice(index, 1);
            $scope.notamTimeObj.notamTime.splice(index, 1);
        }
        $scope.onTimeFocus = function(index, val) {
            if (val == 0) {
                $scope.inputArr[index][0] = true;
                $scope.inputArr[index][1] = false;
            } else {
                $scope.inputArr[index][0] = false;
                $scope.inputArr[index][1] = true;
            }
        }
        $scope.onTimeBlur = function(index, val) {
            if (val == 0) {
                $scope.inputArr[index][0] = false;
                $scope.inputArr[index][1] = false;
            } else {
                $scope.inputArr[index][0] = false;
                $scope.inputArr[index][1] = false;
            }
        };
        $scope.$watch('selectedNotamDates', function(newValue, oldValue) {

            if (newValue) {
                // console.log(newValue);
                // console.log(oldValue);
                if (newValue.length != 0 && (newValue.length - oldValue.length) == 1) {
                    // console.log('false');
                    // $scope.notamTimeObj.isWeekly = false;
                    $scope.notamTimeObj.isDaily = false;
                }
                // console.log(newValue);
                if (newValue.length > 0) {
                    $scope.showTimeSection = true;
                } else {
                    $scope.showTimeSection = true;

                }
                $scope.notamTimeObj.datesSelected = newValue;
            }
        }, true);
        // $('.numeric').on('keypress', function(e) {
        //     var regex = new RegExp("^[0-9]+$");
        //     var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        //     if (regex.test(str)) {
        //         return true;
        //     }
        //     e.preventDefault();
        //     return false;
        // });
        $('.notify-bg').on('click', function() {
            $('.notify-bg').hide();
            $('.date-picker-time').hide();
            $scope.selectedNotamDates = [];

        });
        // $('.fancy-input').focus(function() {
        //     $(this).attr("placeholder", '');
        //     $(this).parent().addClass('focused');
        // })
        // $('.fancy-input').blur(function() {
        //     console.log($(this).val());
        //     if ($(this).val() != undefined || $(this).val() != '') {
        //         $(this).parent().addClass('hasvalue');
        //     }
        //     $(this).attr("placeholder", $(this).attr('pname'));
        //     $(this).parent().removeClass('focused');
        // })
    })
