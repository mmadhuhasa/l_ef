angular.module('navlog', [], function($interpolateProvider) {
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

                    // if (value > 2359) {
                    //     value = "2359";
                    // }
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
    .controller('notamsFilterCtrl', function($scope, $http, $location) {
        
        $scope.notamsFilter = {};
        $scope.showResetBtn = false;
        $scope.notamsFilter.fromdate = moment().format('DD-MMM-YYYY');
        $scope.notamsFilter.todate = moment().add(4, 'days').format('DD-MMM-YYYY');
        $scope.notamsFilter.airportCodeArr = [];
        $scope.airportcodeDisableArr = [];
        $scope.disableFromDate = false;
        $scope.disableToDate = false;
        $scope.disableStartTime = false;
        $scope.disableEndTime = false;
        $scope.showAdvanceSearch = false;
        $scope.notamsFilter.searchType = 'normal';
        // $scope.notamsFilter.radius = 20;
        $scope.notamsFilter.timeFormat = 'utc';
        var locationDataArr = $location.absUrl().split('/');
        if (locationDataArr[locationDataArr.length - 1] == 'notams') {
            $scope.routenotams = "routenotams";
        } else {
            $scope.routenotams = "";
        }
        $('.dt_loading').hide();

        // Datepicker code
        var currentTime = new Date();
        var month = currentTime.getMonth() + 1
        var day = currentTime.getDate();
        var year = currentTime.getFullYear()
        var todaydate = year + "-" + month + "-" + day;
        var day2 = currentTime.getDate() + 1;
        var seconddate = year + "-" + month + "-" + day2;
        var day3 = currentTime.getDate() + 2;
        var thirddate = year + "-" + month + "-" + day3;
        var day4 = currentTime.getDate() + 3;
        var fourthdate = year + "-" + month + "-" + day4;
        var day5 = currentTime.getDate() + 4;
        var fifthdate = year + "-" + month + "-" + day5;
        var readonlyDays = [todaydate, seconddate, thirddate, fourthdate, fifthdate];
        var date = new Date();
        var min_date = new Date();
        var max_date = new Date();
        max_date.setDate(min_date.getDate() + 4);
        $(function() {
            // Datepicker code
            $(".datepicker").datepicker({
                showOn: 'both',
                buttonImage: base_url + '/media/ananth/images/calender-icon1.png',
                buttonImageOnly: true,
                minDate: min_date,
                maxDate: max_date,
                showOtherMonths: true,
                selectOtherMonths: true,
                showAnim: "slide",
                dateFormat: 'dd-M-yy',
                beforeShowDay: function(date) {
                    var m = date.getMonth(),
                        d = date.getDate(),
                        y = date.getFullYear();
                    for (i = 0; i < readonlyDays.length; i++) {
                        if ($.inArray(y + '-' + (m + 1) + '-' + d, readonlyDays) != -1) {
                            //return [false];
                            return [true, 'dp-highlight-date', ''];
                        }
                    }
                    return [true];
                },
                onSelect: function () {
                    $('.notify-bg-v').hide();
                }
            });

            $(".datepicker").datepicker("option", "dateFormat", "dd-M-yy");
            $(".datepicker").datepicker("setDate", new Date());
            $(".to_datepicker").datepicker({
                showOn: 'both',
                buttonImage: base_url + '/media/ananth/images/calender-icon1.png',
                buttonImageOnly: true,
                minDate: min_date,
                maxDate: max_date,
                showOtherMonths: true,
                selectOtherMonths: true,
                showAnim: "slide",
                dateFormat: 'dd-M-yy',
                beforeShowDay: function(date) {
                    var m = date.getMonth(),
                        d = date.getDate(),
                        y = date.getFullYear();
                    for (i = 0; i < readonlyDays.length; i++) {
                        if ($.inArray(y + '-' + (m + 1) + '-' + d, readonlyDays) != -1) {
                            //return [false];
                            return [true, 'dp-highlight-date', ''];
                        }
                    }
                    return [true];
                },
                onSelect: function () {
                    $('.notify-bg-v').hide();
                   
                }
            });

            $(".to_datepicker").datepicker("option", "dateFormat", "dd-M-yy");
            $(".to_datepicker").datepicker("setDate", max_date);

            $('.notamnumber').on('keypress', function(e) {
                var numRegex = new RegExp("^[0-9\b ]+$");
                var aplharegex = new RegExp("^[a-zA-Z\b]+$");
                var eRegex = new RegExp("^[eE\b ]+$");
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                if (e.charCode == 0) {
                    return true;
                }

                if (e.target.value.length < 1) {
                    if (aplharegex.test(str)) {
                        console.log('aplharegex')
                        return true;
                    }
                } else if (e.target.value.length <= 5) {
                    if (numRegex.test(str)) {
                        console.log('numRegex')

                        return true;
                    }
                } else if (e.target.value.length >= 6) {
                    if (numRegex.test(str)) {
                        console.log('numRegex')

                        return true;
                    }
                }
                console.log('val ' + e.target.value.length)

                e.preventDefault();
                return false;
            });
            $('.airportcodevalid').on('keypress', function(e) {
                var regex = new RegExp("^[a-zA-Z\b]+$");
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                if (e.charCode == 0) {
                    return true;
                }

                if (regex.test(str)) {
                    setTimeout(function() {
                        var count = ($scope.notamsFilter.airportcode.match(/,/g) || []).length;
                        if ($scope.notamsFilter.airportcode.length == 4 && $scope.notamsFilter.airportcode.length % 4 == 0) {
                            $scope.notamsFilter.airportcode = $scope.notamsFilter.airportcode + ',';
                        } else if ($scope.notamsFilter.airportcode.length > 4 && $scope.notamsFilter.airportcode.length < 32 && ($scope.notamsFilter.airportcode.length - count) % 4 == 0) {
                            $scope.notamsFilter.airportcode = $scope.notamsFilter.airportcode + ',';
                        }
                        console.log($scope.notamsFilter.airportcode);
                        $scope.notamsFilter.airportcode = $scope.notamsFilter.airportcode.replace(',,', ',');
                        console.log($scope.notamsFilter.airportcode);
                        $scope.$digest();

                    }, 120);

                    return true;
                }
                e.preventDefault();
                return false;
            });

            if ($('#airportcode_hidden').val() != undefined) {
                for (var i = 0; i < $('#airportcode_hidden').val().split(',').length; i++) {
                    $scope.notamsFilter.airportCodeArr[i] = $('#airportcode_hidden').val().split(',')[i]
                    $scope.airportcodeDisableArr[i] = true;
                };

                $('#airportcode_hidden').remove();
            }
            if ($('#fromdate_hidden').val() != undefined) {
                $scope.notamsFilter.fromdate = $('#fromdate_hidden').val();
                $scope.disableFromDate = true;
                $('#fromdate_hidden').remove();
            }
            if ($('#todate_hidden').val() != undefined) {
                $scope.disableToDate = true;
                $scope.notamsFilter.todate = $('#todate_hidden').val();
                $('#todate_hidden').remove();
            }
            if ($('#startTime_hidden').val() != undefined) {
                $scope.disableStartTime = true;
                $scope.notamsFilter.startTime = $('#startTime_hidden').val();
                $('#startTime_hidden').remove();
            }
            if ($('#endTime_hidden').val() != undefined) {
                $scope.disableEndTime = true;
                $scope.notamsFilter.endTime = $('#endTime_hidden').val();
                $('#endTime_hidden').remove();
            }
            if ($('#notamNumber_hidden').val() != undefined) {
                $scope.notamsFilter.notamNumber = $('#notamNumber_hidden').val();
                $('#notamNumber_hidden').remove();
            }
            if ($('#routeNotams_hidden').val() != undefined) {
                $scope.notamsFilter.routeNotams = $('#routeNotams_hidden').val();
                $('#routeNotams_hidden').remove();
            }
            if ($('#notamCategory_hidden').val() != undefined) {
                $scope.notamsFilter.notamCategory = $('#notamCategory_hidden').val();
                $('#notamCategory_hidden').remove();
            }
            if (Object.keys($scope.notamsFilter).length >= 3 && $scope.notamsFilter.airportCodeArr[0] != undefined) {
                $scope.filterNotams();
            }

            $(document).on('keypress', '.select2-search__field', function(e)
               {
                  if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode==0))
                  return true;
                  else
                  return false;
               });
            function formatState (state){
                // console.log(state);
                // console.log(state.text.split('')[0]);
                 // state.text.split('')[0];
                 return $('<span>'+state.text.split('-')[0]+'</span>')
               }
            $('#tag_list').select2({
           placeholder: "SEARCH UP TO 7 AIRPORT NOTAMS",
           minimumInputLength: 3,
           templateSelection: formatState,
           language: {
                noResults: function (params) {
               return ;
               }
           },
           ajax: {
               url: '/notams/findAirport',
               dataType: 'json',
               data: function (params) {
                   return {
                       q: $.trim(params.term)
                   };
               },
               processResults: function (data) {
                console.log(data);
                // data.concat(['VIDF?','VABF','VECF','VOMF',])
                   return {
                       results: data
                   };
               },
               cache: true
           }
       });

        });
        $http.get(base_url + '/notams/getcategorylist')
            .then(function(data) {
                var categoryList = data.data;
                console.log('categoryList',categoryList)
                var categoryList =['AIRSPACE-AERODROME',
                                   'ROUTE',
                                   'RUNWAY',
                                   'TAXIWAY',
                                   'STAND-BAY-APRON',
                                   'COMMUNICATION-EQUIPMENT'
                                    ]
                                      $(".select2-search__field").addClass('aerodrome-input_capitalize');
           $(".aerodrome-input_capitalize").attr('maxlength','3');
                $("#notamCategory").autocomplete({
                    source: categoryList,
                    max: 10,
                    minLength: 0,
                }).focus(function(){            
         
            $(this).data("uiAutocomplete").search();
        });

            })

        $("[data-toggle = 'popover']").popover({
            html: true,
            trigger: "manual"
        });

        $("input").on('keyup', function(e) {
            setTimeout(function() {
                validation(e.target.id);
            }, 100);
        });
        
        $("#airportcode1").keypress(function(event){
             var notams=$(this).val();
             return alphanumericValidation(event);
         });
        $("#startTime1").keypress(function(event){
             var value=$(this).val();
             if(value.length==2)
                $("#startTime2").focus();             
         });
        $("#startTime2").keypress(function(event){
             var value=$(this).val();
             if(value.length==2)
                $("#endTime1").focus();             
         });
        $("#endTime1").keypress(function(event){
             var value=$(this).val();
             if(value.length==2)
                $("#endTime2").focus();             
         });

        
        function alphanumericValidation(event){
            var notams_key_code=event.which || event.keyCode;
            if((notams_key_code>=32 && notams_key_code<=64)||(notams_key_code>=91 && notams_key_code<=96)||(notams_key_code>=123 && notams_key_code<=127))
                    return false;
        }
         function numericValidation(notams){
              var notams_key_code=event.which || event.keyCode;
                  if(notams_key_code==48||(notams_key_code>=49 && notams_key_code<=57))
                    return true;
                  else
                    return false;
         }

        function errorPopover(id, message) {
            $(id).popover({
                trigger: 'manual',
            });
            $(id).attr('data-content', message);
            $(id).css("border", "red solid 1px ");
            $(id).popover('show');
        }

        function closePopover(id) {
            $(id).popover('destroy');
            $(id).css("border", "1px solid #999");
        }

        function validation(id) {
            switch (id) {
                case 'airportcode1':
                    if ($scope.notamsFilter.airportCodeArr[0].length < 3) {
                        errorPopover('#airportcode1', 'Airport is Mandatory');
                    } else {
                        closePopover('#airportcode1');
                    }
                    break;
                case 'startTime':
                    if ($scope.notamsFilter.startTime < 0 || $scope.notamsFilter.startTime > 2359) {
                        errorPopover('#startTime', 'Min 0000 and Max 2359');
                    } else {
                        closePopover('#startTime');
                    }
                    break;
                case 'endTime':
                    if ($scope.notamsFilter.endTime < 0 || $scope.notamsFilter.endTime > 2359) {
                        errorPopover('#endTime', 'Min 0000 and Max 2359');
                    } else {
                        closePopover('#endTime');
                    }
                    break;
                case 'notamNumber':
                    if ($scope.notamsFilter.notamNumber.length == 5) {
                        console.log($scope.notamsFilter.notamNumber.indexOf('/'));
                        console.log($scope.notamsFilter.notamNumber);
                        if ($scope.notamsFilter.notamNumber.indexOf('/') == -1)
                            $scope.notamsFilter.notamNumber = $scope.notamsFilter.notamNumber + '/';
                        $scope.$digest();
                    }
                    if ($scope.notamsFilter.notamNumber.length < 8) {
                        errorPopover('#notamNumber', 'Only Aplhabets, Numbers / Character allowed. Eg: A1234/17');
                    } else {
                        closePopover('#notamNumber');
                    }
                    break;

            }
        }

        function isFormvalid() {
            if ($scope.notamsFilter.airportcode == undefined || $scope.notamsFilter.airportcode == "") {
                errorPopover('#airportcode1', 'Airport is Mandatory');
                return false;
            }
            if ($scope.showAdvanceSearch == true && $scope.notamsFilter.airportcode.length != 4) {
                errorPopover('#airportcode1', 'Min. & Max. 4 Characters');
                return false;
            }
            if ($scope.showAdvanceSearch == true && ($scope.notamsFilter.radius > 150 || $scope.notamsFilter.radius == undefined || $scope.notamsFilter.radius == "")) {
                errorPopover('#radius', 'Min. 5 NM & Max  150 NM');
                return false;
            }

            return true
        };
        $scope.onradiusChange = function() {
            if (($scope.notamsFilter.radius > 150 || $scope.notamsFilter.radius == undefined || $scope.notamsFilter.radius == "")) {
                console.log('err');
                errorPopover('#radius', 'Min. 5 NM & Max  150 NM');
            } else {
                closePopover('#radius');
            }
        }
        $scope.onNotamNumberBlur = function() {
            if ($scope.notamsFilter.notamNumber == "") {
                closePopover('#notamNumber');
            }
        };
        $scope.onAirportCodeChangeOfRadialSearch = function() {
            if ($scope.notamsFilter.airportcode.length == 4) {
                var nextId = '#radius';
                closePopover('#airportcode1');
                $(nextId).focus()
            }
        }
        $scope.onAirportCodeChange = function(index) {
            if ($scope.notamsFilter.airportCodeArr[index].length == 4) {
                var nextId = '#airportcode' + (parseInt(index) + 2);
                closePopover('#airportcode1');
                $(nextId).focus()
            }
        }
        $scope.changeTab = function(index, id) {
            id = '#' + id;
            $scope.tabContentFlagArr = [];
            if (Array.isArray($scope.responseData.notams_array) == true) {
                for (var i = 0; i < $scope.responseData.notams_array.length; i++) {
                    $scope.tabContentFlagArr.push(false);
                }
            } else {
                for (key in $scope.responseData.notams_array) {
                    $scope.tabContentFlagArr.push(false);
                }
            }
            $scope.tabContentFlagArr[index] = !$scope.tabContentFlagArr[index];
        }
        $scope.downloadAll = function() {
            $scope.notamsFilter._token = $('meta[name="_token"]').attr('content');
            $.redirect(base_url + '/notams/download', $scope.notamsFilter);
            // $.redirect(base_url + '/notams/fplnotams', $scope.notamsFilter, 'POST', '_blank');
        }
        $scope.downloadNotams = function(code) {
            $scope.notamsFilter._token = $('meta[name="_token"]').attr('content');
            $.redirect(base_url + '/notams/download/' + code, $scope.notamsFilter);
        }
        $scope.searchTypeChange = function(val) {
            console.log(val)
            if (val == 'normal') {
                $scope.showAdvanceSearch = false;

            } else {
                $scope.notamsFilter.airportcode = undefined;
                $scope.showAdvanceSearch = true;
            }
        };

        $scope.reset = function() {
            $scope.showResetBtn = false;
            $scope.notamsFilter = {};
            $scope.notamsFilter.fromdate = moment().format('DD-MMM-YYYY');
            $scope.notamsFilter.todate = moment().add(4, 'days').format('DD-MMM-YYYY');
            $scope.notamsFilter.airportCodeArr = [];
            $scope.notamsFilter.timeFormat = 'utc';
            $scope.responseData = undefined;
            $scope.showAdvanceSearch = false;
            $scope.notamsFilter.searchType = 'normal';
        };
        
        $scope.datepickerClick = function(){
            $('.notify-bg-v').show();
        }

        $scope.filterNotams = function(reqFrom) {
            $scope.notamsFilter.advance_search = $scope.showAdvanceSearch;
            if ($scope.showAdvanceSearch == false) {
                $scope.notamsFilter.airportcode = $scope.notamsFilter.airportCodeArr.join();
            }

            if (reqFrom != 'routenotams' && !isFormvalid()) {
                return;
            } else if (reqFrom == 'routenotams') {
                $scope.notamsFilter.airportcode = undefined;
                $scope.notamsFilter.notamNumber = undefined;
                $scope.notamsFilter.notamCategory = undefined;
                $scope.notamsFilter.airportCodeArr = [];
                if ($scope.notamsFilter.routeNotams == undefined || $scope.notamsFilter.routeNotams == "") {
                    errorPopover('#routeNotams', 'Please enter Route');
                    return;
                } else {
                    closePopover('#routeNotams');
                    closePopover('#airportcode');
                }
            }
            $scope.showResetBtn = true;
            $scope.notamsFilter.notamCategory = $('#notamCategory').val();
            $scope.notamsFilter.startDateFmt = moment($scope.notamsFilter.fromdate).format('YYMMDD');
            $scope.notamsFilter.endDateFmt = moment($scope.notamsFilter.todate).format('YYMMDD');;
            var notamsFilterQuery = angular.copy($scope.notamsFilter);
            if(notamsFilterQuery.startTime1!=undefined) 
                notamsFilterQuery.startTime =notamsFilterQuery.startTime1+''+notamsFilterQuery.startTime2;
            if(notamsFilterQuery.endTime1!=undefined)
                notamsFilterQuery.endTime =notamsFilterQuery.endTime1+''+notamsFilterQuery.endTime2;

            $('.notify-bg-v').show();
            $http({
                method: 'POST',
                url: base_url + '/notams/filter',
                data: notamsFilterQuery,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                'Content-Type': 'application/json',
            }).success(function(data) {
                console.log(data);
                $('.notify-bg-v').hide();
                $scope.responseData = data;
                $scope.tabContentFlagArr = [];
                if (Object.keys($scope.responseData.notams_array).length > 1 || $scope.responseData.notams_array.length > 1) {
                    $scope.showSaveAll = true;
                }
                for (var i = 0; i < $scope.responseData.notams_array.length; i++) {
                    if (i == 0) {
                        $scope.tabContentFlagArr.push(true);
                    } else {
                        $scope.tabContentFlagArr.push(false);
                    }
                };
                if (Array.isArray($scope.responseData.notams_array) == true) {
                    for (var i = 0; i < $scope.responseData.notams_array.length; i++) {
                        if (i == 0) {
                            $scope.tabContentFlagArr.push(true);
                        } else {
                            $scope.tabContentFlagArr.push(false);
                        }
                    }
                } else {
                    var i = 0;
                    for (key in $scope.responseData.notams_array) {
                        if (i == 0) {
                            $scope.tabContentFlagArr.push(true);
                        } else {
                            $scope.tabContentFlagArr.push(false);
                        }
                        i++;
                    }
                }
            });
        }
    });
