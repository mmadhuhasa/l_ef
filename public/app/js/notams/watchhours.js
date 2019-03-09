angular.module('navlog', ['multipleDatePicker'], function($interpolateProvider) {
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
    .controller('watchHoursCtrl', function($scope, $http, $location) {
        $scope.watchHours = {};
        $scope.edit_watchHours = {};
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
        $scope.disableWeekCheck = {
            'Sun': false,
            'Mon': false,
            'Tue': false,
            'Wed': false,
            'Thu': false,
            'Fri': false,
            'Sat': false
        };
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
                        minLength: 3,
                    });


                });    
            $("#aerodrome").on("autocompleteselect", function(event, ui) {
                $scope.edit_watchHours.aerodrome = ui.item.label;
                $scope.edit_watchHours.aerodrome_name = ui.item.value.split('-')[1];
                $scope.edit_watchHours.daterange = undefined;
                $scope.edit_watchHours.notams = undefined;

                $scope.reset();
                $http.get(base_url + '/watchhours/getpreviousdata?code=' + ui.item.label)
                    .success(function(data) {
                        //console.log(data);
                        $scope.previousData = data;
                    });
            });
            
            function checkDayExist(day, data) {
                for (var i = 0; i < data.length; i++) {
                    //console.log('exist', data[i])
                    if (data[i].data.name == day) {
                        return { status: true, data: data[i], pos: i };
                    }
                }
                return { status: false };
            }
            
            $scope.edit = function(id) {

                //$scope.timingArr.splice(index, 1);
                $http.get(base_url + '/watchhours/aerodromelist')
                    .then(function(data) {
                        var aerodromelist = data.data;
                        $("#aerodrome").autocomplete({
                            source: aerodromelist,
                            max: 10,
                            minLength: 3,
                        });


                    });
                    
                $http.get(base_url + '/watchhours/getWatchhoursInfo?id=' + $("#record_id").val())
                    .success(function(data) {
                        //console.log('getWatchhoursInfo')
                        var obj = {};
                        $scope.maxPageIndex = 0;
                         $scope.disableWeekCheck = {
                            'Sun': false,
                            'Mon': false,
                            'Tue': false,
                            'Wed': false,
                            'Thu': false,
                            'Fri': false,
                            'Sat': false
                        };
                        $scope.edit_watchHours.aerodrome = data.aerodrome;
                        $scope.edit_watchHours.notamnumber = data.notam_no;
                        $scope.edit_watchHours.notams = data.notams;
                        $scope.edit_watchHours.remarks = data.remarks;
                        $scope.edit_watchHours.startAt = data.remarks;
                        $scope.edit_watchHours.endAt = data.remarks;
                        //console.log('data.watchHours', data.watchhours);
                        for (var val in data.watchhours) {
                            for (var i = 0; i < data.watchhours[val].length; i++) {
                                if(data.watchhours[val][i]!=' - '){
                                if (obj[data.watchhours[val][i]]) {
                                    obj[data.watchhours[val][i]] = obj[data.watchhours[val][i]] + ',' + val.substring(0, 3);
                                } else {
                                    obj[data.watchhours[val][i]] = val.substring(0, 3);
                                }
                                }
                            };
                        }
                        //console.log('obj', obj);
                        $scope.edit_showCalendar = true;
                        $scope.startAt = moment(data.w_start_date);
                        $scope.beginMonth = angular.copy($scope.startAt);
                        $scope.endAt = moment(data.w_end_date);

                        $http.get(base_url+'/watchhours_search_airport?code%5B%5D='+$scope.edit_watchHours.aerodrome)
                        .then(function(success){
                            $scope.edit_watchHours.aerodrome_name = success.data;
                        })
                        setTimeout(function() {
                            $scope.edit_watchHours.daterange = data.start_date_formatted + ' to ' + data.end_date_formatted;
                            $scope.edit_load();
                            setDaysAllowedFirst();
                            // $scope.timingArr = [];
                            var i = 0;
                            var pagePostion = {};

                            //console.log('obj', obj);
                            for (var val in obj) {
                                $scope.timingArr = [];
                              //  console.log('Ad', val, obj[val]);
                                if (pagePostion[obj[val]] == undefined) {
                                    pagePostion[obj[val]] = $scope.pageData.length;

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
                                // $scope.pageData[edit_pageIndex] = [];
                                if(!$scope.pageData[edit_pageIndex]){
                                    $scope.pageData[edit_pageIndex] = [];
                                }
                                // $scope.pageData[i] = [];
                                // console.log('edit_pageIndex',edit_pageIndex);

                                var selectedWeekDaysShortName = obj[val].split(',');
                                for (var j = 0; j < selectedWeekDaysShortName.length; j++) {
                                    var remarksAttrName = $scope.weekNameShort[selectedWeekDaysShortName[j]].toLowerCase() + '_remarks';
                                    var pageobj = {
                                        name: $scope.weekNameShort[selectedWeekDaysShortName[j]],
                                        timing: $scope.timingArr,
                                        remarks: data[remarksAttrName]
                                    }
                                   // console.log('pageData', $scope.pageData[edit_pageIndex]);

                                    var checkDayExistData = checkDayExist(pageobj.name, $scope.pageData[edit_pageIndex]);
                                    if (checkDayExistData.status) {
                                        var timing = checkDayExistData.data.timing;
                                        $scope.timingArr = timing.concat($scope.timingArr);
                                        pageobj.timing = $scope.timingArr;
                                        $scope.pageData[edit_pageIndex][checkDayExistData.pos] = { data: pageobj, timing: $scope.timingArr };
                                    } else {

                                        $scope.pageData[edit_pageIndex].push({ data: pageobj, timing: $scope.timingArr });
                                    }
                                    $scope.resultArr[edit_pageIndex] = obj;

                                };
                                i++;

                            }
                            //console.log('page post', pagePostion);
                            var selectedWeekDaysForPageArr = [];
                           console.log('pagelength=', $scope.pageData);
                            for (var i = 0; i < $scope.pageData[$scope.pageIndex].length; i++) {
                                selectedWeekDaysForPageArr.push($scope.pageData[$scope.pageIndex][i]['data'].name.toLowerCase().substring(0, 3));
                            }
                            $scope.timingArr = $scope.pageData[$scope.pageIndex][0]['timing'];
                            $scope.edit_watchHours.remarks = $scope.pageData[$scope.pageIndex][0]['data']['remarks'];
                            $scope.$broadcast('setWeekValues', {
                                data: { '0000': '' }
                            });
                            $scope.$broadcast('setWeekValues', {
                                data: { '0000': selectedWeekDaysForPageArr.join() }
                            });
                            $scope.$digest();
                            //console.log('timingArr', $scope.timingArr)
                            $http.get(base_url + '/watchhours/getpreviousdata?code=' + $("#aerodrome").val())
                            .success(function(data) {
                                $scope.previousData = data;
                            });
                        }, 1000);

                    });
            };

        });
        $scope.startAt = moment();
        $scope.endAt = moment();
        //$scope.startload=function($scope){
        //$scope.reset();
        //$scope.showCalendar = false;
        //console.log($scope); 
        //}
        $scope.onDateChange = function() {
           // console.log('datechange');
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
        $scope.onEdit_DateChange = function() {
            //console.log('datechange');
            $scope.startAt = moment($scope.edit_watchHours.daterange.split('to')[0]);
            $scope.beginMonth = angular.copy($scope.startAt);
            $scope.endAt = moment($scope.edit_watchHours.daterange.split('to')[1]);
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
            $scope.reset_date();
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
            if($("input[name='radio-category']:checked").val()=="closed")
                return false;
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
        $scope.Edit_changeType = function() {
            // $scope.watchHours.type= $scope.edit_watchHours.type ;
            if ($scope.edit_watchHours.type == "all") {
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
            for (var i = 0; i < 7; i++) {
                // console.log($scope.resultArr[i]);
                // console.log($scope.resultArr[i].timingArr);
                if ($scope.resultArr[i] && $scope.resultArr[i].timing == undefined) {
                    return false;
                }
            };
            return true;
        }

        $scope.edit_save = function() {
           if ($("#aerodrome").val() == '' || $("#aerodrome").val().length<=3) {
               $("#aerodrome").focus();
               return;
           }
           /*if ($scope.edit_watchHours.notamnumber == undefined) {
               $("#notamnumber").focus();
               return;
           }*/
           if ($("#notams").val() == '' || $("#notams").val().length<8) {
               $("#notams").focus();
               return;
           }

            $scope.pageData[$scope.pageIndex] = [];
            var disableWeekCheckkeys = Object.keys($scope.disableWeekCheck);
            for (var i = 0; i < $scope.selectedWeekDays.length; i++) {
                if ($scope.selectedWeekDays[i]) {
                    //$scope.disableWeekCheck[disableWeekCheckkeys[i]]=true;
                    for (var j = 0; j < $scope.timingArr.length; j++) {
                        $scope.timingArr[j].starttimeIST = moment.utc(angular.copy($scope.timingArr[j].starttime), "HHmm").utcOffset("+05:30").format("HHmm");
                        $scope.timingArr[j].endtimeIST = moment.utc($scope.timingArr[j].endtime, "HHmm").utcOffset("+05:30").format("HHmm");
                    };
                    if ($scope.edit_watchHours.type == "closed") {
                       $scope.timingArr=[];
                       $scope.timingArr[0]={};
                        $scope.timingArr[0].starttime = "0000";
                        $scope.timingArr[0].endtime = "0000";
                        console.log('inside close');

                    }
                    var obj = {
                        name: $scope.weekDaysName[i],
                        timing: $scope.timingArr,
                        remarks: $scope.edit_watchHours.remarks
                    }

                    $scope.pageData[$scope.pageIndex].push({ data: obj, timing: $scope.timingArr });
                    $scope.resultArr[i] = obj;
                }
            };

            var current_page_data = $scope.pageData[$scope.pageIndex];

            if (current_page_data[0] == undefined) {
                $scope.errMessage = "Please choose days";
                $("#msg").html("Please choose days");
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
            $scope.edit_watchHours.remarks = undefined;
            /* sumit code for disable*/
            for (var k = 0; k < $scope.selectedWeekDays.length; k++) {
                if ($scope.selectedWeekDays[k]) {
                    $scope.disableWeekCheck[disableWeekCheckkeys[k]]=true;
                 }
             }
            /* sumit code for disable*/        
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
                // $scope.watchHours.remarks = $scope.pageData[$scope.pageIndex][0]['remarks'];
                $scope.edit_watchHours.remarks = $scope.pageData[$scope.pageIndex][0]['data']['remarks'];
                //console.log($scope.timingArr)
                $scope.$broadcast('setWeekValues', {
                    data: { '0000': '' }
                });
                $scope.$broadcast('setWeekValues', {
                    data: { '0000': selectedWeekDaysForPageArr.join() }
                });
            }
            $scope.finalResultArr = angular.copy($scope.resultArr);
            $("#radio1").attr('checked',false);
            $("#radio2").attr('checked',false);
            $("#radio3").attr('checked',false);
            $scope.edit_watchHours.type='';
           /*var radio=$("input[type='radio'][name='radio-category']:checked").val();
           if(radio=='closed'){
                  alert("HII");
               $("#start1,#start2,#start3,#start4,#start5,#end1,#end2,#end3,#end4,#end5").prop('readonly', true).val('');
            }
            else{
                alert("HELLO");
              $("#start1,#start2,#start3,#start4,#start5,#end1,#end2,#end3,#end4,#end5").removeAttr('readonly');
            }
            */
        }
        $scope.save = function() {
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
            // console.log($scope.resultArr);

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
                // $scope.watchHours.remarks = $scope.pageData[$scope.pageIndex][0]['remarks'];
                $scope.watchHours.remarks = $scope.pageData[$scope.pageIndex][0]['data']['remarks'];
                //console.log($scope.timingArr)
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
            //console.log($scope.timingArr);
            // console.log($scope.pageData[$scope.pageIndex]);
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
        $scope.edit_load = function() {
           // console.log('edit_load')
            if ($scope.edit_watchHours.aerodrome == undefined) {
                $("#aerodrome").focus();
                return;
            }
            /*if ($scope.edit_watchHours.notamnumber == undefined) {
                $("#notamnumber").focus();
                return;
            }*/
            if ($scope.edit_watchHours.notams == undefined) {
                $("#notams").focus();
                return;
            }
            $scope.reset();
            $scope.edit_showCalendar = true;
            $scope.selectedNotamDates = [];

            $scope.startAt = moment($scope.edit_watchHours.daterange.split('to')[0]);
            $scope.beginMonth = angular.copy($scope.startAt);
            $scope.endAt = moment($scope.edit_watchHours.daterange.split('to')[1]);
            $scope.edit_watchHours.startAt = $scope.startAt.format('YYYY-MM-DD');
            $scope.edit_watchHours.endAt = $scope.endAt.format('YYYY-MM-DD');
            // console.log('watchHours.startAt='+$scope.watchHours.startAt);
            // console.log('watchHours.endAt='+$scope.watchHours.endAt);
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
        $scope.load = function() {
            //console.log('load')
            // if ($scope.watchHours.aerodrome == undefined) {
            //     $("#aerodrome").focus();
            //     return;
            // }
            /*if ($scope.watchHours.notamnumber == undefined) {
                $("#notamnumber").focus();
                return;
            }*/
            // if ($scope.watchHours.notams == undefined) {
            //     $("#notams").focus();
            //     return;
            // }
            $scope.reset();
            $scope.showCalendar = true;
            $scope.selectedNotamDates = [];

            $scope.startAt = moment($scope.watchHours.daterange.split('to')[0]);
            $scope.beginMonth = angular.copy($scope.startAt);
            $scope.endAt = moment($scope.watchHours.daterange.split('to')[1]);
            $scope.watchHours.startAt = $scope.startAt.format('YYYY-MM-DD');
            $scope.watchHours.endAt = $scope.endAt.format('YYYY-MM-DD');
            // console.log('watchHours.startAt='+$scope.watchHours.startAt);
            // console.log('watchHours.endAt='+$scope.watchHours.endAt);
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
           // console.log('weekDayClick',data);
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
                $scope.disableWeekCheck = {
                    'Sun': false,
                    'Mon': false,
                    'Tue': false,
                    'Wed': false,
                    'Thu': false,
                    'Fri': false,
                    'Sat': false
                 };            
            $scope.showSubmitBtn = false;
            $scope.edit_watchHours.type = undefined;
            $scope.pageIndex = 0;
            setDaysAllowedFirst();
        };
        
        $scope.reset_date = function() {
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
            //$scope.timingArr = [];
            // $scope.timingArr[0] = {
            //     starttime: '',
            //     endtime: ''
            // };
            $scope.disableWeekCheck = {
                    'Sun': false,
                    'Mon': false,
                    'Tue': false,
                    'Wed': false,
                    'Thu': false,
                    'Fri': false,
                    'Sat': false
            };   
            $scope.selectedWeekDays = [];
            $scope.showSubmitBtn = false;
            $scope.edit_watchHours.type = undefined;
            $scope.pageIndex = 0;
            $scope.maxPageIndex = 0;
             $(".notify-bg-v").fadeOut(); 
            setDaysAllowedFirst();
        }; 

        $scope.submit = function() {
            //console.log($scope.resultArr);
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
            $scope.watchHours._token = $('meta[name="_token"]').attr('content');

            // console.log(base_url);
            $http({
                method: 'POST',
                url: base_url + '/watchhours',
                data: $scope.watchHours
            }).success(function(data) {
                $scope.errMessage = data.message;
                if (data.status == 1) {
                    var code = $scope.watchHours.aerodrome;
                    $scope.reset();
                    $scope.showCalendar = false;
                    $scope.watchHours = {};
                    $("html, body").animate({ scrollTop: 0 }, 2000);
                    $("#error_success").html('WatchHours Updated Successfully').removeClass('hide');
                    setTimeout(function() { $("#error_success").addClass('hide'); }, 3000);
                    $.ajax({
                        url: base_url + "/watchhours_airport/search?code=" + code,
                        success: function(data) {
                            $("#add_watchours").hide('100');
                            $("#watchhours_list").html(data);
                            $("#watchhours_list").show();
                        }
                    });

                }
                if (data.status == 0)
                    $("#watchhours").modal();
            })
        };
        $scope.update = function() {
            //console.log('update');
            //console.log($scope.resultArr);
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
                };
            };
            $scope.edit_watchHours.startAt = moment($scope.edit_watchHours.daterange.split('to')[0]).format('YYYY-MM-DD');

            $scope.edit_watchHours.endAt = moment($scope.edit_watchHours.daterange.split('to')[1]).format('YYYY-MM-DD');

            $scope.edit_watchHours.data = finalArr;
            // console.log($scope.edit_watchHours);
            // return;
            $http({
                method: 'PUT',
                url: base_url + '/watchhours/' + $('#record_id').val(),
                data: $scope.edit_watchHours
            }).success(function(data) {
                $scope.errMessage = data.message;
                if (data.status == 1) {
                    var code = $scope.edit_watchHours.aerodrome;
                    var d_range=$scope.edit_watchHours.daterange;
                    $scope.reset();
                    $scope.edit_showCalendar = false;
                    $scope.edit_watchHours = {};
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    // $("#error_success").html('WatchHours Updated Successfully').removeClass('hide');
                    $.growl({title: '', location: 'tc', size: 'large', message: 'SUCCESSFULLY UPDATED '+code+' - '+ data.airport_name[0]+' AIRPORT WATCH HOURS FOR '+d_range.toUpperCase()});
                    setTimeout(function() { $("#error_success").addClass('hide'); }, 3000);
                    $.ajax({
                        url: base_url + "/watchhours_airport/newsearch?code=" + code,
                        success: function(data) {
                            $("#edit_watchours").hide(100);
                            $("#watchhours_list").show();
                            $("#watchhours_list").html(data);
                            $("#singleBorder,.searchBlock").show(300);
                            /* */
                        }
                    });
                }
                if (data.status != 1){
                    $("#msg").html(data.message); 
                    $("#watchhours").modal();
                  }
            })
        };
        $scope.setAllWeekDays = function(weekindex, status) {
           // console.log('setAllWeekDays');
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
                        if(endMoment.diff(firstDate,'days')>=0){
                         $scope.selectedNotamDates.push(angular.copy(firstDate.add(0, 'days')));
                        }
                    } else {
                        var newDateTobAdded = angular.copy(firstDate.add(7, 'days'));
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