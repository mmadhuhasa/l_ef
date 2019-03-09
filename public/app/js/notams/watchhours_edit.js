angular.module('navlog_edit', ['multipleDatePicker'], function($interpolateProvider) {
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
    .controller('watchHoursEditCtrl', function($scope, $http, $location) {
        $scope.watchHours = {};
        // $scope.watchHours.aerodrome = 'VABB';
        // $scope.watchHours.notamnumber = 'A1034/17';
        $scope.weekDaysName = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $scope.weekNameShort = {
            'sun': 'Sunday',
            'mon': 'Monday',
            'tue': 'Tuesday',
            'wed': 'Wednesday',
            'thu': 'Thursday',
            'fri': 'Friday',
            'sat': 'Saturday'
        };
        $scope.weekdayArr = [false, false, false, false, false, false, false];
        $scope.selectedNotamDates = [];
        $scope.timingArr = [];
        $scope.timingArr[0] = {
            starttime: '',
            endtime: ''
        };
        $scope.pageData = [];
        $scope.pageIndex = 0;
        $scope.maxPageIndex = 0;
        $scope.resultArr = [];

        $scope.selectedWeekDays = [];
        $scope.daysAllowed = [];
        var selectedNotamDates = [];
        $(function() {
            // Datepicker code
            $(".datepicker").datepicker({
                showOn: 'both',
                buttonImage: base_url + '/media/ananth/images/calender-icon1.png',
                buttonImageOnly: true,
                showOtherMonths: true,
                selectOtherMonths: true,
                showAnim: "slide",
                dateFormat: 'dd-M-yy',

            });

            $(".datepicker").datepicker("option", "dateFormat", "dd-M-yy");
            $(".datepicker").datepicker("setDate", new Date());
            $(".to_datepicker").datepicker({
                showOn: 'both',
                buttonImage: base_url + '/media/ananth/images/calender-icon1.png',
                buttonImageOnly: true,
                showOtherMonths: true,
                selectOtherMonths: true,
                showAnim: "slide",
                dateFormat: 'dd-M-yy',

            });
            // $('input[name="daterange"]').daterangepicker();
            $(".to_datepicker").datepicker("option", "dateFormat", "dd-M-yy");
            $(".to_datepicker").datepicker("setDate", new Date());
            // Run the effect
            $("#effect").effect('slide', {}, 500, callback);
            $('input[name="daterange"]').daterangepicker({
                locale: {
                    format: 'DD-MMM-YYYY',
                    "separator": " to ",
                }
            });
            $scope.watchHours.daterange = undefined;

            function callback() {
                setTimeout(function() {
                    $("#effect").removeAttr("style").hide().fadeIn();

                }, 1000);
            };
            $http.get(base_url + '/watchhours/aerodromelist')
                .then(function(data) {
                    var aerodromelist = data.data;
                    $("#aerodrome").autocomplete({
                        source: aerodromelist,
                        max: 10,
                        minLength: 2,
                    });


                });
            $("#aerodrome").on("autocompleteselect", function(event, ui) {
                $scope.watchHours.aerodrome = ui.item.label;
                $http.get(base_url + '/watchhours/getpreviousdata?code=' + ui.item.label)
                    .success(function(data) {
                        // console.log(data);
                        $scope.previousData = data;
                    });
            });

            function checkDayExist(day, data) {
                for (var i = 0; i < data.length; i++) {
                    console.log('exist', data[i])
                    if (data[i].data.name == day) {
                        return { status: true, data: data[i], pos: i };
                    }
                }
                return { status: false };
            }
            $http.get(base_url + '/watchhours/getWatchhoursInfo?id=' + $("#record_id").val())
                .success(function(data) {
                    console.log('getWatchhoursInfo');
                    var obj = {};
                    //console.log(data);
                    $scope.watchHours.aerodrome = data.aerodrome;
                    $scope.watchHours.notamnumber = data.notam_no;
                    $scope.watchHours.notams = data.notams;
                    $scope.watchHours.remarks = data.remarks;
                    for (var val in data.watchhours) {
                        // console.log(val);
                        // console.log(data.watchhours[val])
                        // if()
                        for (var i = 0; i < data.watchhours[val].length; i++) {
                            if (obj[data.watchhours[val][i]]) {
                                obj[data.watchhours[val][i]] = obj[data.watchhours[val][i]] + ',' + val.substring(0, 3);
                            } else {
                                obj[data.watchhours[val][i]] = val.substring(0, 3);
                            }
                        };
                    }
                    // console.log('obj',obj);
                    $scope.showCalendar = true;
                    $scope.startAt = moment(data.w_start_date);
                    $scope.beginMonth = angular.copy($scope.startAt);
                    $scope.endAt = moment(data.w_end_date);

                    setTimeout(function() {
                        $scope.watchHours.daterange = data.start_date_formatted + ' to ' + data.end_date_formatted;
                        $scope.load();
                        setDaysAllowedFirst();
                        // $scope.timingArr = [];
                        var i = 0;
                        var pagePostion = {};

                        for (var val in obj) {
                            $scope.timingArr = [];
                            // console.log('Ad', val);
                            if (pagePostion[obj[val]] == undefined) {
                                pagePostion[obj[val]] = i;

                            }
                            var edit_pageIndex = pagePostion[obj[val]];

                            var weekObj = {};
                            weekObj[val] = obj[val];
                            if (val.split('-')[0].trim() == "CLOSED") {
                                $scope.timingArr.push({ starttime: "0000", endtime: "0000" });
                            } else {
                                $scope.timingArr.push({ starttime: val.split('-')[0].trim(), endtime: val.split('-')[1].trim() });
                            }
                            $scope.$broadcast('setWeekValues', {
                                data: weekObj
                            });
                            $scope.pageData[i] = [];

                            var selectedWeekDaysShortName = obj[val].split(',');
                            for (var j = 0; j < selectedWeekDaysShortName.length; j++) {
                                var remarksAttrName = $scope.weekNameShort[selectedWeekDaysShortName[j]].toLowerCase() + '_remarks';
                                var pageobj = {
                                    name: $scope.weekNameShort[selectedWeekDaysShortName[j]],
                                    timing: $scope.timingArr,
                                    remarks: data[remarksAttrName]
                                }
                                console.log('pageData', $scope.pageData[edit_pageIndex]);

                                var checkDayExistData = checkDayExist(pageobj.name, $scope.pageData[edit_pageIndex]);
                                if (checkDayExistData.status) {
                                    var timing = checkDayExistData.data.timing;
                                    $scope.timingArr = timing.concat($scope.timingArr);
                                    pageobj.timing = $scope.timingArr;
                                    $scope.pageData[edit_pageIndex][checkDayExistData.pos] = { data: pageobj, timing: $scope.timingArr };
                                } else {

                                    $scope.pageData[edit_pageIndex].push({ data: pageobj, timing: $scope.timingArr });
                                }


                            };

                            console.log('timingArr', $scope.timingArr);
                            // console.log($scope.pageData);
                            // $scope.$digest();
                            // $scope.$broadcast('setWeekValues', {
                            //     data: { '0000': 'sun,mon,tue,wed,thu,fri,sat' }
                            // });
                            i++;
                        }
                        console.log('page data ', $scope.pageData);
                        // $scope.pageIndex = 0;
                        var selectedWeekDaysForPageArr = [];
                        // console.log($scope.pageData[$scope.pageIndex])
                        // console.log($scope.pageIndex)
                        for (var i = 0; i < $scope.pageData[$scope.pageIndex].length; i++) {
                            selectedWeekDaysForPageArr.push($scope.pageData[$scope.pageIndex][i]['data'].name.toLowerCase().substring(0, 3));
                        }
                        $scope.timingArr = $scope.pageData[$scope.pageIndex][0]['timing'];
                        $scope.watchHours.remarks = $scope.pageData[$scope.pageIndex][0]['data']['remarks'];

                        console.log('timingArr', $scope.timingArr)
                        $scope.$broadcast('setWeekValues', {
                            data: { '0000': '' }
                        });
                        $scope.$broadcast('setWeekValues', {
                            data: { '0000': selectedWeekDaysForPageArr.join() }
                        });
                        $scope.$digest();
                        // console.log($scope.pageData)
                    }, 1000);

                });

        });
        $scope.startAt = moment();
        $scope.endAt = moment();
        $scope.onDateChange = function() {
            console.log('onDateChange');
            $scope.startAt = moment($scope.watchHours.daterange.split('to')[0]);
            $scope.beginMonth = angular.copy($scope.startAt);
            $scope.endAt = moment($scope.watchHours.daterange.split('to')[1]);
            $scope.watchHours.startAt = $scope.startAt.format('YYYY-MM-DD');
            $scope.watchHours.endAt = $scope.endAt.format('YYYY-MM-DD');

            if (($scope.endAt.month() == $scope.beginMonth.month() && $scope.endAt.year() == $scope.beginMonth.year()) && ($scope.endAt.month() == $scope.beginMonth.month() && $scope.endAt.year() == $scope.beginMonth.year())) {
                $scope.disableFuture = true;
                $scope.disablePast = true;

            } else if ($scope.endAt.month() == $scope.beginMonth.month() && $scope.endAt.year() == $scope.beginMonth.year()) {
                $scope.disableFuture = true;
                $scope.disablePast = false;

            } else if ($scope.startAt.month() == $scope.beginMonth.month() && $scope.startAt.year() == $scope.beginMonth.year()) {
                $scope.disablePast = true;
                $scope.disableFuture = false;

            } else {
                $scope.disableFuture = false;
                $scope.disablePast = false;

            }
        };

        function errorPopover(id, message) {
            $("[data-toggle = 'popover']").popover({
                html: true,
                trigger: "hover"
            });
            $(id).attr('data-content', message);
            $(id).popover('show');
            $(id).focus();
        }

        function closePopover(id) {
            $(id).popover('destroy');
            $(id).blur();
            // $(id).css("border", "lightgrey solid 1px");
        }
        $scope.addMore = function() {
            if ($scope.timingArr.length == 5) {
                return;
            }
            $scope.timingArr.push({
                starttime: '',
                endtime: ''
            });
        };
        $scope.remove = function(index) {
            $scope.timingArr.splice(index, 1);
        };
        $scope.changeType = function() {
            console.log('changeType');
            if ($scope.watchHours.type == "all") {
                $scope.$broadcast('setWeekValues', {
                    data: { '0000': 'sun,mon,tue,wed,thu,fri,sat' }
                });
                // $scope.sun = $scope.mon = $scope.tue = $scope.wed = $scope.thu = $scope.fri = $scope.sat = true;
                for (var i = 0; i < 7; i++) {
                    // $scope.setAllWeekDays(i, true);
                };
            } else {
                $scope.$broadcast('setWeekValues', {
                    data: { '0000': '' }
                });
                // $scope.sun = $scope.mon = $scope.tue = $scope.wed = $scope.thu = $scope.fri = $scope.sat = false;
                for (var i = 0; i < 7; i++) {
                    // $scope.setAllWeekDays(i, false);
                };
            }

        }

        function callback() {
            setTimeout(function() {
                $("#effect").removeAttr("style").hide().fadeIn();
            }, 1000);
        };

        function isAllDaysFilled() {
            console.log('isAllDaysFilled');
            for (var i = 0; i < 7; i++) {
                // console.log($scope.resultArr[i]);
                // console.log($scope.resultArr[i].timingArr);
                if ($scope.resultArr[i].timing == undefined) {
                    return false;
                }
            };
            return true;
        }

        $scope.save = function() {
            console.log('save', $scope.selectedWeekDays);
            $scope.pageData[$scope.pageIndex] = [];
            for (var i = 0; i < $scope.selectedWeekDays.length; i++) {
                if ($scope.selectedWeekDays[i]) {
                    for (var j = 0; j < $scope.timingArr.length; j++) {
                        $scope.timingArr[j].starttimeIST = moment.utc(angular.copy($scope.timingArr[j].starttime), "HHmm").utcOffset("+05:30").format("HHmm");
                        $scope.timingArr[j].endtimeIST = moment.utc($scope.timingArr[j].endtime, "HHmm").utcOffset("+05:30").format("HHmm");
                    };
                    if ($scope.watchHours.type == "closed") {
                        $scope.timingArr[0].starttime = "0000";
                        $scope.timingArr[0].endtime = "0000";
                    }
                    var obj = {
                        name: $scope.weekDaysName[i],
                        timing: $scope.timingArr,
                        remarks: $scope.watchHours.remarks
                    }

                    $scope.pageData[$scope.pageIndex].push({ data: obj, timing: $scope.timingArr });
                    $scope.resultArr[i] = obj;
                }
            };
            console.log('@@', $scope.resultArr);

            var current_page_data = $scope.pageData[$scope.pageIndex];

            if (current_page_data[0] == undefined) {
                $scope.errMessage = "Please choose days";
                $("#watchhours").modal();

                return;
            }
            for (var i = 0; i < current_page_data[0].timing.length; i++) {
                if (current_page_data[0].timing[i].starttime == "") {
                    $("#start" + (i + 1)).focus();
                    return;
                }
                if (current_page_data[0].timing[i].endtime == "") {
                    $("#end" + (i + 1)).focus();
                    return;
                }
                if (current_page_data[0].timing[i].starttime > current_page_data[0].timing[i].endtime) {
                    errorPopover("#end" + (i + 1), "End time less than Start time");
                    return;
                } else {
                    closePopover("#end" + (i + 1));
                }
                if (current_page_data[0].timing[i + 1] && current_page_data[0].timing[i].endtime > current_page_data[0].timing[i + 1].starttime) {
                    errorPopover("#start" + (i + 2), "Start time less than Previous end time");
                    return;
                } else {
                    closePopover("#start" + (i + 2));
                }
            };
            $scope.watchHours.remarks = undefined;


            if (isAllDaysFilled() && $scope.pageIndex == $scope.maxPageIndex) {
                $scope.showSubmitBtn = true;
            } else {
                setDaysAllowed();
                $scope.showPrev = true;
                $scope.pageIndex++;
                $scope.showSubmitBtn = false;
                $("#alldays").hide();
                $("#alldays").effect('slide', { direction: "right" }, 500, callback);
            }

            $scope.maxPageIndex = $scope.pageIndex > $scope.maxPageIndex ? $scope.pageIndex : $scope.maxPageIndex;

            // console.log($scope.maxPageIndex);
            if ($scope.pageData[$scope.pageIndex] == undefined && $scope.showSubmitBtn == false) {
                $scope.timingArr = [];
                $scope.$broadcast('setWeekValues', {
                    data: { '0000': '' }
                });
                $scope.timingArr[0] = {
                    starttime: '',
                    endtime: ''
                };
            } else if ($scope.showSubmitBtn == false) {

                var selectedWeekDaysForPageArr = [];
                for (var i = 0; i < $scope.pageData[$scope.pageIndex].length; i++) {
                    selectedWeekDaysForPageArr.push($scope.pageData[$scope.pageIndex][i]['data'].name.toLowerCase().substring(0, 3));
                }
                $scope.timingArr = $scope.pageData[$scope.pageIndex][0]['timing'];
                $scope.watchHours.remarks = $scope.pageData[$scope.pageIndex][0]['data']['remarks'];

                //console.log($scope.timingArr)
                if ($scope.timingArr[0].starttime == "0000" && $scope.timingArr[0].endtime == "0000") {
                    $scope.watchHours.type = "closed";
                }
                $scope.$broadcast('setWeekValues', {
                    data: { '0000': '' }
                });
                $scope.$broadcast('setWeekValues', {
                    data: { '0000': selectedWeekDaysForPageArr.join() }
                });
            }
            $scope.finalResultArr = angular.copy($scope.resultArr);
        }
        $scope.prev = function() {
            console.log('prev');
            $scope.pageIndex--;
            if ($scope.pageIndex == 0) {
                $scope.showPrev = false
            }
            $scope.showSubmitBtn = false;
            // console.log($scope.pageIndex);

            var selectedWeekDaysForPageArr = [];
            for (var i = 0; i < $scope.pageData[$scope.pageIndex].length; i++) {
                selectedWeekDaysForPageArr.push($scope.pageData[$scope.pageIndex][i]['data'].name.toLowerCase().substring(0, 3));
            }
            $scope.timingArr = $scope.pageData[$scope.pageIndex][0]['timing'];
            //console.log($scope.timingArr)
            $scope.watchHours.remarks = $scope.pageData[$scope.pageIndex][0]['data']['remarks'];

            $scope.$broadcast('setWeekValues', {
                data: { '0000': '' }
            });
            $scope.$broadcast('setWeekValues', {
                data: { '0000': selectedWeekDaysForPageArr.join() }
            });

            $("#alldays").hide();
            $("#alldays").effect('slide', { direction: "left" }, 600, callback);

        };

        function setDaysAllowed() {
            console.log('setDaysAllowed');
            $scope.daysAllowed = [];
            var startMoment = angular.copy($scope.startAt);
            var endMoment = angular.copy($scope.endAt);
            var startOfWeek = angular.copy(angular.copy(startMoment).startOf('week'));
            var numberOfWeeks = endMoment.diff(startMoment, 'days');
            selectedNotamDates = selectedNotamDates.concat(angular.copy($scope.selectedNotamDates));
            var selectedNotamDatesFormatted = [];
            for (var i = 0; i < selectedNotamDates.length; i++) {
                selectedNotamDatesFormatted[i] = selectedNotamDates[i].format('DD-MM-YY');
            };
            for (var i = 0; i <= numberOfWeeks; i++) {
                if (i == 0) {
                    var newDateTobAdded = angular.copy(startMoment.add(0, 'days'));
                    if (selectedNotamDatesFormatted.indexOf(newDateTobAdded.format('DD-MM-YY')) == -1) {
                        $scope.daysAllowed.push(newDateTobAdded);
                    }
                } else {
                    var newDateTobAdded = angular.copy(startMoment.add(1, 'days'));
                    if (selectedNotamDatesFormatted.indexOf(newDateTobAdded.format('DD-MM-YY')) == -1) {
                        $scope.daysAllowed.push(newDateTobAdded);
                    }
                }
            };

        }

        function setDaysAllowedFirst() {
            console.log('setDaysAllowedFirst');
            $scope.daysAllowed = [];
            var startMoment = angular.copy($scope.startAt);
            var endMoment = angular.copy($scope.endAt);
            var startOfWeek = angular.copy(angular.copy(startMoment).startOf('week'));
            var numberOfWeeks = endMoment.diff(startMoment, 'days');
            //console.log(numberOfWeeks);

            for (var i = 0; i <= numberOfWeeks; i++) {
                if (i == 0) {
                    var newDateTobAdded = angular.copy(startMoment.add(0, 'days'));

                    $scope.daysAllowed.push(newDateTobAdded);
                } else {
                    var newDateTobAdded = angular.copy(startMoment.add(1, 'days'));
                    $scope.daysAllowed.push(newDateTobAdded);
                }
            };
            //console.log($scope.daysAllowed);

        }
        $scope.load = function() {
            console.log('load');
            //console.log($scope.watchHours)
            if ($scope.watchHours.aerodrome == undefined) {
                $("#aerodrome").focus();
                return;
            }
            if ($scope.watchHours.notamnumber == undefined) {
                $("#notamnumber").focus();
                return;
            }
            $scope.reset();
            $scope.showCalendar = true;
            $scope.selectedNotamDates = [];

            $scope.startAt = moment($scope.watchHours.daterange.split('to')[0]);
            $scope.beginMonth = angular.copy($scope.startAt);
            $scope.endAt = moment($scope.watchHours.daterange.split('to')[1]);
            $scope.watchHours.startAt = $scope.startAt.format('YYYY-MM-DD');
            $scope.watchHours.endAt = $scope.endAt.format('YYYY-MM-DD');

            if (($scope.endAt.month() == $scope.beginMonth.month() && $scope.endAt.year() == $scope.beginMonth.year()) && ($scope.endAt.month() == $scope.beginMonth.month() && $scope.endAt.year() == $scope.beginMonth.year())) {
                $scope.disableFuture = true;
                $scope.disablePast = true;

            } else if ($scope.endAt.month() == $scope.beginMonth.month() && $scope.endAt.year() == $scope.beginMonth.year()) {
                $scope.disableFuture = true;
                $scope.disablePast = false;

            } else if ($scope.startAt.month() == $scope.beginMonth.month() && $scope.startAt.year() == $scope.beginMonth.year()) {
                $scope.disablePast = true;
                $scope.disableFuture = false;

            } else {
                $scope.disableFuture = false;
                $scope.disablePast = false;

            }
            setDaysAllowedFirst();
        }
        $scope.$on('weekDayClick', function(event, data) {
            console.log('weekDayClick');
            // console.log(data);
            var weekindex = '';
            switch (data.name) {
                case 'Sun':
                    weekindex = 0;
                    $scope.selectedWeekDays[weekindex] = data.val;
                    $scope.setAllWeekDays(weekindex, data.val);
                    break;
                case 'Mon':
                    weekindex = 1;
                    $scope.selectedWeekDays[weekindex] = data.val;
                    $scope.setAllWeekDays(weekindex, data.val);
                    break;
                case 'Tue':
                    weekindex = 2;
                    $scope.selectedWeekDays[weekindex] = data.val;
                    $scope.setAllWeekDays(weekindex, data.val);
                    break;
                case 'Wed':
                    weekindex = 3;
                    $scope.selectedWeekDays[weekindex] = data.val;
                    $scope.setAllWeekDays(weekindex, data.val);
                    break;
                case 'Thu':
                    weekindex = 4;
                    $scope.selectedWeekDays[weekindex] = data.val;
                    $scope.setAllWeekDays(weekindex, data.val);
                    break;
                case 'Fri':
                    weekindex = 5;
                    $scope.selectedWeekDays[weekindex] = data.val;
                    $scope.setAllWeekDays(weekindex, data.val);
                    break;
                case 'Sat':
                    weekindex = 6;
                    $scope.selectedWeekDays[weekindex] = data.val;
                    $scope.setAllWeekDays(weekindex, data.val);
                    break;
            }
        });
        $scope.monthChanged = function(newMonth, oldMonth) {
            console.log('monthChanged');

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
        $scope.reset = function() {
            console.log('reset');
            $scope.pageData = [];
            // $scope.resultArr = [];
            $scope.finalResultArr = [];
            $scope.resultArr = [{
                name: "Sunday"
            }, {
                name: "Monday"
            }, {
                name: "Tuesday"
            }, {
                name: "Wednesday"
            }, {
                name: "Thursday"
            }, {
                name: "Friday"
            }, {
                name: "Saturday"
            }];
            selectedNotamDates = [];
            $scope.daysAllowed = [];
            $scope.$broadcast('setWeekValues', {
                data: { '0000': '' }
            });
            $scope.timingArr = [];
            $scope.timingArr[0] = {
                starttime: '',
                endtime: ''
            };
            $scope.showSubmitBtn = false;
            $scope.watchHours.type = undefined;
            $scope.pageIndex = 0;
            setDaysAllowedFirst();
        };


        $scope.submit = function() {
            console.log('submit');
            console.log($scope.resultArr);
            $scope.finalResultArr = angular.copy($scope.resultArr);

            var finalArr = [];
            for (var i = 0; i < $scope.resultArr.length; i++) {

                for (var j = 0; j < $scope.resultArr[i].timing.length; j++) {
                    if (finalArr[j]) {
                        var openKeyName = $scope.resultArr[i].name.toLowerCase() + '_open';
                        var closeKeyName = $scope.resultArr[i].name.toLowerCase() + '_close';
                        var remarksKeyName = $scope.resultArr[i].name.toLowerCase() + '_remarks';
                        var obj = {};
                        if ($scope.resultArr[i].timing[j].starttime == "0000" && $scope.resultArr[i].timing[j].endtime == "0000") {
                            finalArr[j][openKeyName] = 'CLOSED';
                            finalArr[j][closeKeyName] = 'CLOSED';
                            finalArr[j][remarksKeyName] = $scope.resultArr[i].remarks;
                        } else {
                            finalArr[j][openKeyName] = $scope.resultArr[i].timing[j].starttime;
                            finalArr[j][closeKeyName] = $scope.resultArr[i].timing[j].endtime;
                            finalArr[j][remarksKeyName] = $scope.resultArr[i].remarks;
                        }

                        // finalArr[j].push(obj);
                    } else {
                        finalArr[j] = {};
                        var openKeyName = $scope.resultArr[i].name.toLowerCase() + '_open';
                        var closeKeyName = $scope.resultArr[i].name.toLowerCase() + '_close';
                        var remarksKeyName = $scope.resultArr[i].name.toLowerCase() + '_remarks';
                        var obj = {};
                        if ($scope.resultArr[i].timing[j].starttime == "0000" && $scope.resultArr[i].timing[j].endtime == "0000") {
                            finalArr[j][openKeyName] = 'CLOSED';
                            finalArr[j][closeKeyName] = 'CLOSED';
                            finalArr[j][remarksKeyName] = $scope.resultArr[i].remarks;
                        } else {
                            finalArr[j][openKeyName] = $scope.resultArr[i].timing[j].starttime;
                            finalArr[j][closeKeyName] = $scope.resultArr[i].timing[j].endtime;
                            finalArr[j][remarksKeyName] = $scope.resultArr[i].remarks;
                        }
                        // finalArr[j].push(obj);
                    }
                    // console.log($scope.resultArr[i].timing[j]);
                    // console.log($scope.resultArr[i].name.toLowerCase());
                };
            };
            // console.log(finalArr);
            // return;
            $scope.watchHours.data = finalArr;
            // console.log($scope.watchHours);
            // console.log(base_url);
            $http({
                method: 'PUT',
                url: base_url + '/watchhours/' + $('#record_id').val(),
                data: $scope.watchHours
            }).success(function(data) {
                //console.log(data);
                $scope.errMessage = data.message;
                if (data.status == 1) {
                    $scope.reset();
                    $scope.showCalendar = false;
                    $scope.watchHours = {};
                    window.location = "/watchhours";
                }

                $("#watchhours").modal();
            })
        };

        $scope.setAllWeekDays = function(weekindex, status) {
            console.log('setAllWeekDays');
            // console.log(weekindex, status);
            $scope.specificDateOnly = false;
            weekindex = parseInt(weekindex);
            $scope.weekdayArr[weekindex] = status;
            var startMoment = angular.copy($scope.startAt);
            var endMoment = angular.copy($scope.endAt);
            var startOfWeek = angular.copy(angular.copy(startMoment).startOf('week'));
            var numberOfWeeks = endMoment.diff(startMoment, 'weeks');
            var firstDate = angular.copy(startOfWeek.weekday(weekindex));

            if (status == true) {

                $scope.daily = false;

                for (var i = 0; i <= numberOfWeeks; i++) {
                    if (i == 0 && firstDate.diff(startMoment, 'days') >= 0) {
                        $scope.selectedNotamDates.push(angular.copy(firstDate.add(0, 'days')));
                    } else {
                        var newDateTobAdded = angular.copy(firstDate.add(7, 'days'));
                        // console.log(endMoment.format('DD-MM-YY'), newDateTobAdded.format('DD-MM-YY'));
                        // console.log(newDateTobAdded.diff(endMoment, 'days'));
                        if (newDateTobAdded.diff(endMoment, 'days') <= 0) {
                            $scope.selectedNotamDates.push(newDateTobAdded);
                        }
                    }

                };
            } else {
                for (var i = 0; i < $scope.selectedNotamDates.length; i++) {
                    if ($scope.selectedNotamDates[i].weekday() == weekindex) {
                        $scope.selectedNotamDates.splice(i, 1);
                        i--;
                    }
                };
                // $scope.resultArr.splice(weekindex, 1);
            }
        };
    });