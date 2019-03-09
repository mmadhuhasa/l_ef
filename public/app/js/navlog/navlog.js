angular.module('navlog', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    })
    .directive('fileModel', ['$parse', function($parse) {
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                element.bind('change', function() {
                    $parse(attrs.fileModel).assign(scope, element[0].files)
                    scope.$apply();
                });
            }
        };
    }])
    .controller('navlogCtrl', function($scope, $http) {
        $scope.navlog = {};
        $scope.navlogform = {};
        $scope.navlogform.minMax = '0';
        $scope.navlogform.date_of_flight = moment(new Date()).format('YYMMDD');
        $scope.paxArr = [];
        $scope.paxValue = 'PAX';
        $scope.speedValue = 'SPEED';
        $scope.progressbarVal = 0;
        $scope.responseVar = true;
        $scope.showResult = false;
        $scope.speedArr = ['N', 'M', 'K'];
        $scope.airportinfoWidthArr = ['5%', '10%', '8%', '5%', '', '9%', '4%', '', '4%', '7%'];
        $scope.showSuccessMessage = false;

        for (var i = 0; i < 14; i++) {
            $scope.paxArr.push(i);
        };

        angular.element(document).ready(function() {
            //UTC date
            var currentDate = $("#date_of_flight").val(); //document.getElementById("utcdate").value;
            var current_day = '';
            var current_month = '';
            var current_year = '';
            if (currentDate) {
                current_day = currentDate.substr(4, 2);
                current_month = currentDate.substr(2, 2) - 1;
                current_year = '20' + currentDate.substr(0, 2);
            }
            // Datepicker code


            $(".datepicker").datepicker({
                showOn: 'both',
                buttonImage: base_url + '/media/ananth/images/calender-icon1.png',
                buttonImageOnly: true,
                // minDate: min_date,
                // maxDate: max_date,
                showOtherMonths: true,
                selectOtherMonths: true,
                showAnim: "slide",
                dateFormat: 'yy-mm-dd',

            });
            $(".datepicker").datepicker("option", "dateFormat", "ymmdd");
            $(".datepicker").datepicker("setDate", currentDate);
            $("[data-toggle = 'popover']").popover({
                html: true,
                trigger: "hover"
            });

            $("[data-toggle = 'tooltip']").tooltip({
                html: true,
                trigger: "hover"
            });

            $("input").on('keyup', function(e) {
                setTimeout(function() {
                    checkValidOnKeyUp(e.target.id);
                }, 100);
            });
            $('.numeric').on('keypress', function(e) {
                var regex = new RegExp("^[0-9]+$");
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                if (regex.test(str)) {
                    return true;
                }
                e.preventDefault();
                return false;
            });

        });

        function addDays(theDate, days) {
            return new Date(theDate.getTime() + days * 24 * 60 * 60 * 1000);
        }

        function errorPopover(id, message) {
            $(id).popover({
                trigger: 'hover',
            });
            $(id).attr('data-content', message);
            $(id).css("border", "red solid 1px");
            $(id).popover('show');
        }

        function closePopover(id) {
            $scope.responseVar = true;
            $(id).popover('destroy');
            $(id).css("border", "lightgrey solid 1px");
        }
        var errorMessages = ['Min. 5 & Max. 7 Characters, only Alphabets & Numbers allowed',
            'Min. 3 & Max. 4 Characters, only Alphabets & Numbers allowed',
            'ICAO Codes only, use ZZZZ if no Code allocated for Departing Station (Min. & Max. 4 Alphabets)',
            'ICAO Codes only, use ZZZZ if no Code allocated for Destination Station (Min. & Max. 4 Alphabets)',
            'Min. 3 & Max. 3 Digits',
            'Min. 2 & Max. 150 Characters, only Alphabets Numbers and / Character only allowed',
            'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed',
            '',
        ];

        function checkValidOnKeyUp(id) {
            switch (id) {
                case 'registration':
                    //  registration
                    if ($scope.navlogform.registration == undefined || $scope.navlogform.registration.length < 5) {
                        errorPopover('#registration', errorMessages[0]);
                        $scope.responseVar = false;
                    } else {
                        closePopover('#registration');
                    }
                    break;
                case 'aircraftType':
                    //  aircraft type
                    if ($scope.navlogform.aircraftType == undefined || $scope.navlogform.aircraftType.length < 3) {
                        errorPopover('#aircraftType', errorMessages[1]);
                        $scope.responseVar = false;
                    } else {
                        closePopover('#aircraftType');
                    }
                    break;
                case 'departure':
                    // departure aerodrome
                    if ($scope.navlogform.departure == undefined || $scope.navlogform.departure.length < 4) {
                        errorPopover('#departure', errorMessages[2]);
                        $scope.responseVar = false;
                    } else {
                        closePopover('#departure');
                    }
                    break;
                case 'destination':
                    if ($scope.navlogform.destination == undefined || $scope.navlogform.destination.length < 4) {
                        errorPopover('#destination', errorMessages[3]);
                        $scope.responseVar = false;
                    } else {
                        closePopover('#destination');
                    }
                    break;
                case 'level':
                    if ($scope.navlogform.level == undefined || $scope.navlogform.level.length < 3) {
                        errorPopover('#level', errorMessages[4]);
                        $scope.responseVar = false;
                    } else {
                        closePopover('#level');
                    }
                    break;
                case 'route':
                    if ($scope.navlogform.route == undefined || $scope.navlogform.route.length < 2) {
                        errorPopover('#route', errorMessages[5]);
                        $scope.responseVar = false;
                    } else {
                        closePopover('#route');
                    }
                    break;
                case 'pic':
                    if ($scope.navlogform.pic == undefined || $scope.navlogform.pic.length < 2) {
                        errorPopover('#pic', errorMessages[6]);
                        $scope.responseVar = false;
                    } else {
                        closePopover('#pic');
                    }
                    break;
                case 'copilot':
                    if ($scope.navlogform.copilot == undefined || $scope.navlogform.copilot.length < 2) {
                        errorPopover('#copilot', errorMessages[6]);
                        $scope.responseVar = false;
                    } else {
                        closePopover('#copilot');
                    }
                    break;
                case 'cargo':
                    if ($scope.navlogform.cargo != undefined && $scope.navlogform.cargo.length < 2) {
                        errorPopover('#cargo', errorMessages[7]);
                        $scope.responseVar = false;
                    } else {
                        closePopover('#cargo');
                    }
                    break;
                case 'fuel':
                    if ($scope.navlogform.fuel != undefined && $scope.navlogform.fuel.length < 4) {
                        errorPopover('#fuel', errorMessages[8]);
                        $scope.responseVar = false;
                    } else {
                        closePopover('#fuel');
                    }
                    break;
                case 'copilot':
                    if ($scope.navlogform.copilot == undefined || $scope.navlogform.copilot.length < 2) {
                        errorPopover('#copilot', errorMessages[6]);
                        $scope.responseVar = false;
                    } else {
                        closePopover('#copilot');
                    }
                    break;
                case 'altn1':
                    if ($scope.navlogform.altn1 == undefined || $scope.navlogform.altn1.length < 4) {
                        errorPopover('#altn1', errorMessages[3]);
                        $scope.responseVar = false;
                    } else {
                        closePopover('#altn1');
                    }
                    break;
                case 'level1':
                    if ($scope.navlogform.level1 == undefined || $scope.navlogform.level1.length < 3) {
                        errorPopover('#level1', errorMessages[4]);
                        $scope.responseVar = false;
                    } else {
                        closePopover('#level1');
                    }
                    break;
                case 'altnroute':
                    if ($scope.navlogform.altnroute == undefined || $scope.navlogform.altnroute.length < 2) {
                        errorPopover('#altnroute', errorMessages[5]);
                        $scope.responseVar = false;
                    } else {
                        closePopover('#altnroute');
                    }
                    break;
                case 'takeoffAltn':
                    if ($scope.navlogform.takeoffAltn == undefined || $scope.navlogform.takeoffAltn.length < 4) {
                        errorPopover('#takeoffAltn', errorMessages[3]);
                        $scope.responseVar = false;
                    } else {
                        closePopover('#takeoffAltn');
                    }
                    break;
                case 'takeofflevel':
                    if ($scope.navlogform.takeofflevel == undefined || $scope.navlogform.takeofflevel.length < 3) {
                        errorPopover('#takeofflevel', errorMessages[4]);
                        $scope.responseVar = false;
                    } else {
                        closePopover('#takeofflevel');
                    }
                    break;
                case 'takeoffRoute':
                    if ($scope.navlogform.takeoffRoute == undefined || $scope.navlogform.takeoffRoute.length < 2) {
                        errorPopover('#takeoffRoute', errorMessages[5]);
                        $scope.responseVar = false;
                    } else {
                        closePopover('#takeoffRoute');
                    }
                    break;
            }
        }

        function isFormvalid() {
            $scope.responseVar = true;
            //  registration
            if ($scope.navlogform.registration == undefined || $scope.navlogform.registration.length < 5) {
                errorPopover('#registration', errorMessages[0]);
                $scope.responseVar = false;
            } else {
                closePopover('#registration');
            }
            //  aircraft type
            if ($scope.navlogform.aircraftType == undefined || $scope.navlogform.aircraftType.length < 3) {
                errorPopover('#aircraftType', errorMessages[1]);
                $scope.responseVar = false;
            } else {
                closePopover('#aircraftType');
            }
            // departure aerodrome
            if ($scope.navlogform.departure == undefined || $scope.navlogform.departure.length < 4) {
                errorPopover('#departure', errorMessages[2]);
                $scope.responseVar = false;
            } else {
                closePopover('#departure');
            }
            if ($scope.navlogform.destination == undefined || $scope.navlogform.destination.length < 4) {
                errorPopover('#destination', errorMessages[3]);
                $scope.responseVar = false;
            } else {
                closePopover('#destination');
            }
            if ($scope.navlogform.level == undefined || $scope.navlogform.level.length < 3) {
                errorPopover('#level', errorMessages[4]);
                $scope.responseVar = false;
            } else {
                closePopover('#level');
            }
            if ($scope.navlogform.route == undefined || $scope.navlogform.route.length < 2) {
                errorPopover('#route', errorMessages[5]);
                $scope.responseVar = false;
            } else {
                closePopover('#route');
            }
            if ($scope.navlogform.pic == undefined || $scope.navlogform.level.length < 2) {
                errorPopover('#pic', errorMessages[6]);
                $scope.responseVar = false;
            } else {
                closePopover('#pic');
            }

            if ($scope.navlogform.copilot == undefined || $scope.navlogform.level.length < 2) {
                errorPopover('#copilot', errorMessages[6]);
                $scope.responseVar = false;
            } else {
                closePopover('#copilot');
            }
            if ($scope.navlogform.altn1 == undefined || $scope.navlogform.altn1.length < 4) {
                errorPopover('#altn1', errorMessages[3]);
                $scope.responseVar = false;
            } else {
                closePopover('#altn1');
            }
            if ($scope.navlogform.level1 == undefined || $scope.navlogform.level1.length < 3) {
                errorPopover('#level1', errorMessages[4]);
                $scope.responseVar = false;
            } else {
                closePopover('#level1');
            }
            if ($scope.navlogform.altnroute == undefined || $scope.navlogform.altnroute.length < 2) {
                errorPopover('#altnroute', errorMessages[5]);
                $scope.responseVar = false;
            } else {
                closePopover('#altnroute');
            }
            if ($scope.navlogform.takeoffAltn == undefined || $scope.navlogform.takeoffAltn.length < 4) {
                errorPopover('#takeoffAltn', errorMessages[3]);
                $scope.responseVar = false;
            } else {
                closePopover('#takeoffAltn');
            }
            if ($scope.navlogform.takeofflevel == undefined || $scope.navlogform.takeofflevel.length < 3) {
                errorPopover('#takeofflevel', errorMessages[4]);
                $scope.responseVar = false;
            } else {
                closePopover('#takeofflevel');
            }
            if ($scope.navlogform.takeoffRoute == undefined || $scope.navlogform.takeoffRoute.length < 2) {
                errorPopover('#takeoffRoute', errorMessages[5]);
                $scope.responseVar = false;
            } else {
                closePopover('#takeoffRoute');
            }
            return $scope.responseVar;
        }
        $scope.onChangeFuel = function() {
            if ($scope.navlogform.fuel != undefined) {
                $scope.navlogform.minMax = undefined;
            } else {
                $scope.navlogform.minMax = '0';
            }
        };
        $scope.process = function() {
            if (!isFormvalid()) {
                return;
            }
            if ($scope.navlogform.fuel == undefined || $scope.navlogform.fuel == '') {
                $scope.navlogform.fuelValue = $scope.navlogform.minMax == '0' ? 'MINIMUM' : 'MAXIMUM';
            } else {
                $scope.navlogform.fuelValue = $scope.navlogform.fuel;
            }
            $scope.processedNavlog = true;
            $http({
                method: 'POST',
                url: 'http://localhost:8080/pvtflightnew/public/api/navlog/process_nav_log',
                data: $scope.navlogform,
                'Content-Type': 'application/json',
            }).success(function(data) {


            })
        };

        $scope.changePax = function(val) {
            $scope.paxValue = val;
            $scope.navlogform.paxValue = val;
        };
        $scope.changeSpeed = function(val) {
            $scope.speedValue = val;
            $scope.navlogform.speedValue = val;

        };
        $scope.change = function() {
            console.log('$scope', $scope.navlog.dateStart)
                // $scope.navlog.dateTime = ;
        };
        $scope.preUpload = function() {
            $scope.showSuccessMessage = false;
            $scope.progressbarVal = 0;
            if ($scope.showResult) {
                $("#confbox").hide();
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
                $scope.showResult = !$scope.showResult;
                return;
            }
            $scope.modalData = {
                header: 'navlog',
                message: 'Do you wish to upload navlog ?',
                showLoader: false,
                showContent: true,
                showConfirmBtn: true
            };
            if (!valid()) {
                $scope.modalData.showConfirmBtn = false;
                $scope.modalData.message = 'Please dont leave navlog empty';
                $("#confbox").show();
            }
        }


        $scope.upload = function() {
            $scope.modalData.showConfirmBtn = false;
            $scope.modalData.showContent = false;
            $scope.modalData.showLoader = true;
            var interval = setInterval(function() {
                $scope.progressbarVal = $scope.progressbarVal + 1;
                $("#progress_bar").progressbar({ value: $scope.progressbarVal });
                $("#percentage").html($scope.progressbarVal + " %");
                if ($scope.progressbarVal >= 99) {
                    clearInterval(interval);
                }
            }, 100);
            $scope.showResult = !$scope.showResult;
            if ($scope.showResult) {
                readCallSign();
                // find source and destination
                readSourceAndDestination();
                readDateAndTime();
                readPaxTascruise();
                readmainRoute();
                readFuelInfo();
                readPilotInfo();
                readWindsClimbAndDescent();
                readAvgIsa();
                readFpl();
                readTripTimeAndFuel();
                readLevelTable();
                readAirportInfo();
                var temp;
                if ($scope.navlog.tripArr[$scope.navlog.tripArr.length - 2]['name'] == ' ALTN ' || $scope.navlog.tripArr[$scope.navlog.tripArr.length - 2]['name'] == 'ALTN ') {
                    $scope.navlog.altn2 = false;
                    temp = $scope.navlog.tripArr[$scope.navlog.tripArr.length - 2];
                    $scope.navlog.tripArr[$scope.navlog.tripArr.length - 2] = $scope.navlog.tripArr[$scope.navlog.tripArr.length - 3];
                    $scope.navlog.tripArr[$scope.navlog.tripArr.length - 3] = temp;
                }
                if ($scope.navlog.tripArr[$scope.navlog.tripArr.length - 2]['name'] == ' ALTN2') {
                    $scope.navlog.altn2 = true;
                    $scope.navlog.tripArr.splice($scope.navlog.tripArr.length - 4, 0, $scope.navlog.tripArr[$scope.navlog.tripArr.length - 3], $scope.navlog.tripArr[$scope.navlog.tripArr.length - 2]);
                    $scope.navlog.tripArr.splice($scope.navlog.tripArr.length - 3, 2);
                }
                console.log($scope.navlog)
                $http({
                    method: 'POST',
                    url: 'http://localhost:8080/pvtflightnew/public/api/navlog/email_navlog',
                    data: $scope.navlog,
                    'Content-Type': 'application/json',
                }).success(function(data) {
                    $scope.showSuccessMessage = true;
                    $("#confbox").hide();
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');
                })
            }

        }

        function readAirportInfo() {
            $scope.navlog.airportInfoArr = [];
            var numberOfLinesReaded = 0;
            var dataSplittedWithNewLine = $scope.navlog.text.split('\n');
            var airportInfoLineNumber;
            var unWantedLineCount = 0;
            for (var i = 0; i < dataSplittedWithNewLine.length; i++) {
                if (numberOfLinesReaded > 3 && dataSplittedWithNewLine[i].split('AIRPORT INFO').length == 1 && dataSplittedWithNewLine[i].split('ENROUTE WINDS').length > 1) {
                    break;
                }
                if (dataSplittedWithNewLine[i].split('AIRPORT INFO').length > 1 || airportInfoLineNumber < i) {
                    airportInfoLineNumber = i;
                    numberOfLinesReaded++;
                    var airportinfo = dataSplittedWithNewLine[i].split(' ');
                    // console.log(dataSplittedWithNewLine[i]);
                    if (airportinfo[0] == '')
                        airportinfo.splice(0, 1);
                    if (airportinfo.length == 10 && airportinfo[1] == 'RUNWAY') {
                        airportinfo.splice(1, 0, ' ');
                    }
                    $scope.navlog.airportInfoArr.push(airportinfo);
                }
            }
            for (var i = 0; i < $scope.navlog.airportInfoArr.length; i++) {
                // console.log($scope.navlog.airportInfoArr)
                if ($scope.navlog.airportInfoArr[i].length > 8) {
                    unWantedLineCount = i;
                    break;
                }
            };
            $scope.navlog.airportInfoArr.splice(0, unWantedLineCount);
        }

        function readCallSign() {
            var dataSplittedWithNewLine = $scope.navlog.text.split('\n');
            for (var i = 0; i < dataSplittedWithNewLine.length; i++) {
                if (dataSplittedWithNewLine[i].split(' [ ').length > 1) {
                    $scope.navlog.callSign = dataSplittedWithNewLine[i].split(' [ ')[0].substring(dataSplittedWithNewLine[i].split(' [ ')[0].length - 5, dataSplittedWithNewLine[i].split(' [ ')[0].length) + '  [' + dataSplittedWithNewLine[i].split(' [ ')[1].split(' ]')[0] + '] ';
                }
            }

        }

        function readLevelTable() {
            var dataSplittedWithNewLine = $scope.navlog.text.split('\n');
            var levelLineNumber;
            $scope.navlog.levelTable = [];
            for (var i = 0; i < dataSplittedWithNewLine.length; i++) {
                if (dataSplittedWithNewLine[i].split('FL WC ').length > 1 || levelLineNumber < i) {
                    levelLineNumber = i;
                    var tableAttrArr = dataSplittedWithNewLine[i].split(' ');
                    if ($scope.navlog.levelTable.length == 6) {
                        break;
                    }
                    if (tableAttrArr[0] == '' && tableAttrArr[6] != '1TON' && tableAttrArr[6] && isNaN(tableAttrArr[6]) && tableAttrArr[5].split('}').length == 1) {
                        tableAttrArr.splice(3, 0, '');
                    } else if (tableAttrArr[0] != '' && tableAttrArr[5] != '1TON' && isNaN(tableAttrArr[5]) && tableAttrArr[5].split('}').length == 1) {
                        tableAttrArr.splice(3, 0, '');
                    } else if (tableAttrArr[0] == '' && tableAttrArr[6] == undefined) {
                        tableAttrArr.splice(3, 0, '');
                    }
                    if (dataSplittedWithNewLine[i].split('{').length > 1) {
                        var levelTableObj = {
                            fl: tableAttrArr[0],
                            wc: tableAttrArr[1],
                            time: tableAttrArr[2],
                            trip: tableAttrArr[3],
                            kt: tableAttrArr[4],
                            ton: tableAttrArr[5]
                        }
                    } else if (tableAttrArr[0] == '') {
                        var levelTableObj = {
                            fl: tableAttrArr[1],
                            wc: tableAttrArr[2],
                            time: tableAttrArr[3],
                            trip: tableAttrArr[4],
                            kt: tableAttrArr[5],
                            ton: tableAttrArr[6]
                        }
                    } else {
                        var levelTableObj = {
                            fl: tableAttrArr[0],
                            wc: tableAttrArr[1],
                            time: tableAttrArr[2],
                            trip: tableAttrArr[3],
                            kt: tableAttrArr[4],
                            ton: tableAttrArr[5]
                        }
                    }
                    $scope.navlog.levelTable.push(levelTableObj);
                }
            }
            $scope.navlog.levelTable.splice(0, 1);
        }

        function readTripTimeAndFuel() {
            var tripStartLineNumber, dist, track;
            $scope.navlog.tripArr = [];
            var dataSplittedWithNewLine = $scope.navlog.text.split('\n');
            for (var i = 0; i < dataSplittedWithNewLine.length; i++) {
                if (dataSplittedWithNewLine[i].split('ZERO WT ').length > 1) {
                    $scope.navlog.zerowt = dataSplittedWithNewLine[i].split('ZERO WT ')[1].split(' ')[0];
                }
                if (dataSplittedWithNewLine[i].split('ZERO WT : ').length > 1) {
                    $scope.navlog.zerowt = dataSplittedWithNewLine[i].split('ZERO WT : ')[1].split(' ')[0];
                }
                if (dataSplittedWithNewLine[i].split('ZERO WT: ').length > 1) {
                    $scope.navlog.zerowt = dataSplittedWithNewLine[i].split('ZERO WT: ')[1].split(' ')[0];
                }

                if (dataSplittedWithNewLine[i].split('ZERO FUEL:').length > 1) {
                    $scope.navlog.zerowt = dataSplittedWithNewLine[i].split('ZERO FUEL:')[1].split(' ')[1];
                }

                if (dataSplittedWithNewLine[i].split('T.OFF WT').length > 1) {
                    $scope.navlog.takeoffwt = dataSplittedWithNewLine[i].split('T.OFF WT')[1].split('')[0] == ' ' ? dataSplittedWithNewLine[i].split('T.OFF WT')[1].split(' ')[2] : dataSplittedWithNewLine[i].split('T.OFF WT')[1].split(' ')[0];
                    if ($scope.navlog.takeoffwt == ':') {
                        $scope.navlog.takeoffwt = dataSplittedWithNewLine[i].split('T.OFF WT')[1].split(' ')[1];
                    }
                    if ($scope.navlog.takeoffwt == 'MTOW') {
                        $scope.navlog.takeoffwt = dataSplittedWithNewLine[i].split('T.OFF WT')[1].split(' ')[1];
                    }

                }
                if (dataSplittedWithNewLine[i].split('LAND WT : ').length > 1) {
                    $scope.navlog.landwt = dataSplittedWithNewLine[i].split('LAND WT : ')[1].split(' ')[0];
                }
                if ($scope.navlog.landwt == undefined && dataSplittedWithNewLine[i].split('LAND WT ').length > 1) {
                    $scope.navlog.landwt = dataSplittedWithNewLine[i].split('LAND WT ')[1].split(' ')[0];
                }
                if (dataSplittedWithNewLine[i].split('LOAD').length > 1) {
                    $scope.navlog.load = dataSplittedWithNewLine[i].split('LOAD')[1].replace(':', '');
                    if ($scope.navlog.load.split('CHOCKS').length > 1) {
                        $scope.navlog.load = $scope.navlog.load.split(' ')[1];
                    }
                }
                if (dataSplittedWithNewLine[i].split('DIST:').length > 1 && dataSplittedWithNewLine[i].split('(TRACK').length > 1) {
                    dist = dataSplittedWithNewLine[i].split('DIST:')[1].split('(TRACK')[0];
                    track = dataSplittedWithNewLine[i].split('DIST:')[1].split('(TRACK')[1].split(')')[0];
                } else if (dataSplittedWithNewLine[i].split('DIST:').length > 1 && dataSplittedWithNewLine[i].split('(').length > 1 && dataSplittedWithNewLine[i].split('(D').length == 1) {
                    dist = dataSplittedWithNewLine[i].split('DIST:')[1].split('(')[0];
                    track = dataSplittedWithNewLine[i].split('DIST:')[1].split('(')[1].split(')')[0];
                }
                if (dataSplittedWithNewLine[i].split('TRIP :').length > 1 || tripStartLineNumber < i) {
                    tripStartLineNumber = i;
                    if (dataSplittedWithNewLine[i].split('------------').length > 1) {
                        break;
                    }
                    var obj = {
                        name: dataSplittedWithNewLine[i].substring(0, dataSplittedWithNewLine[i].indexOf(':')),
                        time: dataSplittedWithNewLine[i].split(': ')[1].split(' ')[0],
                        fuel: dataSplittedWithNewLine[i].split(': ')[1].split(' ')[1].split('  ')[0],
                    };
                    if (obj.name == ' ALTN ' || obj.name == 'ALTN ' || obj.name == ' ALTN1' || obj.name == ' ALTN2') {
                        if (obj.fuel == '0') {
                            obj.dist = dataSplittedWithNewLine[i].substring(15, dataSplittedWithNewLine[i].length).replace(/\(/g, "").replace(/\)/g, "");
                        } else {
                            obj.dist = dataSplittedWithNewLine[i].split(obj.fuel)[1].replace(/\(/g, "").replace(/\)/g, "");
                        }

                    }
                    // 
                    $scope.navlog.tripArr.push(obj);
                    if ($scope.navlog.tripArr.length == 2) {
                        $scope.navlog.tripArr[1].dist = dist;
                        $scope.navlog.tripArr[1].track = track;
                    }
                }
            }
            var obj = {
                name: dataSplittedWithNewLine[tripStartLineNumber + 1].substring(0, dataSplittedWithNewLine[tripStartLineNumber + 1].indexOf(':')),
                time: dataSplittedWithNewLine[tripStartLineNumber + 1].split(': ')[1].split(' ')[0],
                fuel: dataSplittedWithNewLine[tripStartLineNumber + 1].split(': ')[1].split(' ')[1].split('  ')[0],
            };

            $scope.navlog.tripArr.push(obj);
        }

        function readFpl() {
            $scope.navlog.fplArr = [];
            var fplStartLineNumber;
            var dataSplittedWithNewLine = $scope.navlog.text.split('\n');
            for (var i = 0; i < dataSplittedWithNewLine.length; i++) {

                if (dataSplittedWithNewLine[i].split('(FPL-').length > 1 || fplStartLineNumber < i) {
                    fplStartLineNumber = i;
                    if (dataSplittedWithNewLine[i].split('ATC FLIGHT').length > 1 || dataSplittedWithNewLine[i].split('......').length > 1) {
                        continue;
                    }
                    $scope.navlog.fplArr.push(dataSplittedWithNewLine[i]);
                    if (dataSplittedWithNewLine[i].split('C/').length > 1) {
                        break;
                    }
                }
            }
            for (var i = 1; i < $scope.navlog.fplArr.length; i++) {
                if ($scope.navlog.fplArr[i].split('')[0] != '-') {
                    $scope.navlog.fplArr[i - 1] = $scope.navlog.fplArr[i - 1] + ' ' + $scope.navlog.fplArr[i];
                    $scope.navlog.fplArr.splice(i, 1);
                    i = 0;
                }

            };
            // $scope.navlog.fplArr.join(' ');
            // $scope.navlog.fplArr=$scope.navlog.fplArr.split('-')
        }

        function readAvgIsa() {
            var dataSplittedWithNewLine = $scope.navlog.text.split('\n');
            for (var i = 0; i < dataSplittedWithNewLine.length; i++) {
                if (dataSplittedWithNewLine[i].split('(AVG ISA)').length > 1) {
                    $scope.navlog.avgIsa = dataSplittedWithNewLine[i].split('Kts (AVG ISA)')[0] + ' Kts';
                }
            }
        }

        function readWindsClimbAndDescent() {
            var dataSplittedWithNewLine = $scope.navlog.text.split('\n');
            for (var i = 0; i < dataSplittedWithNewLine.length; i++) {
                if (dataSplittedWithNewLine[i].split('WINDS :').length > 1) {
                    $scope.navlog.wind = dataSplittedWithNewLine[i].split('WINDS :')[1].split('Descent:')[0];
                } else if (dataSplittedWithNewLine[i].split('WIND:').length > 1) {
                    $scope.navlog.wind = dataSplittedWithNewLine[i].split('WIND:')[1].split('Descent:')[0];
                } else if (dataSplittedWithNewLine[i].split('WINDS:').length > 1) {
                    $scope.navlog.wind = dataSplittedWithNewLine[i].split('WINDS:')[1].split('Descent:')[0];
                }
                if (dataSplittedWithNewLine[i].split('Climb :').length > 1) {
                    $scope.navlog.climb = dataSplittedWithNewLine[i].split('Climb :')[1].split('LBS')[0];
                }
                if (dataSplittedWithNewLine[i].split('Climb :').length > 1) {
                    $scope.navlog.climb = dataSplittedWithNewLine[i].split('Climb :')[1].split('Lbs')[0];
                }
                if (dataSplittedWithNewLine[i].split('Descent:').length > 1) {
                    $scope.navlog.descent = dataSplittedWithNewLine[i].split('Descent:')[1];
                    return;
                }

            }
        }

        function valid() {
            if ($scope.navlog.text == "" || $scope.navlog.text == undefined) {
                return false
            }
            return true;
        }

        function readPilotInfo() {
            var dataSplittedWithNewLine = $scope.navlog.text.split('\n');
            for (var i = 0; i < dataSplittedWithNewLine.length; i++) {
                if (dataSplittedWithNewLine[i].split('PIC: ').length > 1) {
                    $scope.navlog.pilot = dataSplittedWithNewLine[i].split('PIC: ')[1].split('FO:')[0];
                    $scope.navlog.copilot = dataSplittedWithNewLine[i].split('PIC: ')[1].split('FO:')[1];
                }
            }
        }

        function readFuelInfo() {
            var dataSplittedWithNewLine = $scope.navlog.text.split('\n');
            for (var i = 0; i < dataSplittedWithNewLine.length; i++) {
                if (dataSplittedWithNewLine[i].split('COMPUTED FUEL:').length > 1) {
                    if (dataSplittedWithNewLine[i].split('COMPUTED FUEL:')[1].split('LBS')[0].length < 10)
                        $scope.navlog.computedFuel = dataSplittedWithNewLine[i].split('COMPUTED FUEL:')[1].split('LBS')[0] + ' LBS';
                    else
                        $scope.navlog.computedFuel = dataSplittedWithNewLine[i].split('COMPUTED FUEL:')[1].split('Lbs')[0] + ' LBS';
                }
                if (dataSplittedWithNewLine[i].split('BLOCK FUEL :').length > 1) {
                    $scope.navlog.blockFuel = dataSplittedWithNewLine[i].split('BLOCK FUEL :')[1].split('LBS')[0] + ' LBS';
                }
                if (dataSplittedWithNewLine[i].split('LANDING FUEL :').length > 1) {
                    $scope.navlog.landingFuel = dataSplittedWithNewLine[i].split('LANDING FUEL :')[1].split('LBS')[0] + ' LBS';
                }
                if (dataSplittedWithNewLine[i].split('LANDING FUEL:').length > 1) {
                    $scope.navlog.landingFuel = dataSplittedWithNewLine[i].split('LANDING FUEL:')[1].split('LBS')[0] + ' LBS';
                }
                if (dataSplittedWithNewLine[i].split('TAKE OFF FUEL :').length > 1) {
                    $scope.navlog.takeOffFuel = dataSplittedWithNewLine[i].split('TAKE OFF FUEL :')[1].split('LBS')[0] + ' LBS';
                }
                if (dataSplittedWithNewLine[i].split('MIN. TRIP FUEL:').length > 1) {
                    $scope.navlog.minFuel = dataSplittedWithNewLine[i].split('MIN. TRIP FUEL:')[1].split('LBS')[0] + ' LBS';
                }
                if (dataSplittedWithNewLine[i].split('MAX. TRIP FUEL:').length > 1) {
                    $scope.navlog.maxFuel = dataSplittedWithNewLine[i].split('MAX. TRIP FUEL:')[1].split('LBS')[0] + ' LBS';
                }
            }
        }

        function readmainRoute() {
            var dataSplittedWithNewLine = $scope.navlog.text.split('\n');
            for (var i = 0; i < dataSplittedWithNewLine.length; i++) {
                if (dataSplittedWithNewLine[i].split('ROUTE: ').length > 1) {
                    $scope.navlog.mainroute = 'MAIN ROUTE: ' + dataSplittedWithNewLine[i].split('ROUTE: ')[1];
                }
            }
        }

        function readPaxTascruise() {
            if ($scope.navlog.text.split('P.O.B.:')[1]) {
                $scope.navlog.pax = $scope.navlog.text.split('P.O.B.:')[1].split('PAX')[0];
            } else if ($scope.navlog.text.split('PAX :')[1]) {
                $scope.navlog.pax = $scope.navlog.text.split('PAX :')[1].split(' ')[1];
            } else if ($scope.navlog.text.split('PAX:')[1]) {
                $scope.navlog.pax = $scope.navlog.text.split('PAX:')[1].split(' ')[1];
            } else {
                console.log('pax not found');
            }
            if ($scope.navlog.text.split('TAS = ')[1]) {
                if ($scope.navlog.text.split('TAS = ')[1].split(')')[0].length < 8) {
                    $scope.navlog.tas = $scope.navlog.text.split('TAS = ')[1].split(')')[0];
                } else
                    $scope.navlog.tas = $scope.navlog.text.split('TAS = ')[1].split('Kts')[0] + 'KTS';

            } else if ($scope.navlog.text.split('TAS :')[1]) {
                $scope.navlog.tas = $scope.navlog.text.split('TAS :')[1].split('KTS')[0] + 'KTS';
                $scope.navlog.cruise = $scope.navlog.text.split('TAS :')[1].split('KTS')[1].split(' ')[1];
            } else {
                console.log('tas not found');
            }
            if ($scope.navlog.text.split('CRUISE:')[1]) {
                if ($scope.navlog.text.split('CRUISE:')[1].split('(')[0].length < 15)
                    $scope.navlog.cruise = $scope.navlog.text.split('CRUISE:')[1].split('(')[0];
                else
                    $scope.navlog.cruise = $scope.navlog.text.split('CRUISE:')[1].split('TAS')[0];

            } else {
                console.log('cruise not found');
            }

        }

        function readDateAndTime() {
            var dateSplitWithTagNavLog = $scope.navlog.text.split(' NAV LOG');
            if (dateSplitWithTagNavLog.length == 1) {
                alert('Date Format Error');
                return;
            }
            var flightDate = dateSplitWithTagNavLog[0].substring(dateSplitWithTagNavLog[0].length - 7, dateSplitWithTagNavLog[0].length)
            $scope.navlog.flightDate = moment(flightDate, 'DDMMMYY').format('DD-MMM-YY');
            $scope.navlog.flightTime = 'DEP TIME : ' + dateSplitWithTagNavLog[1].split('ETD')[1].substring(0, 20);
            $scope.navlog.flightDepTime = $scope.navlog.flightTime.replace(/[)(]/g, '').split('ETA')[0];
            $scope.navlog.flightArrTime = 'ARR TIME :' + $scope.navlog.flightTime.replace(/[)(~-]/g, '').split('ETA')[1];
        }

        function readSourceAndDestination() {
            var dataSplittedWithNewLine = $scope.navlog.text.split('\n');
            for (var i = 0; i < dataSplittedWithNewLine.length; i++) {
                if (dataSplittedWithNewLine[i].split('DEP :').length > 1) {
                    $scope.navlog.source = dataSplittedWithNewLine[i].split('DEP :')[1].substring(0, 5);
                }
                if (dataSplittedWithNewLine[i].split('DEST:').length > 1) {
                    $scope.navlog.destination = dataSplittedWithNewLine[i].split('DEST:')[1].substring(0, 4);
                }
            };
        }




        // $scope.navlog.latitude1 = "8.8932";
        // $scope.navlog.longitude1 = "76.6141";
        // $scope.navlog.latitude2 = "12.9716";
        // $scope.navlog.longitude2 = "77.5946";
        // $scope.navlog.latitude1 = "1953";
        // $scope.navlog.longitude1 = "7736";
        // $scope.navlog.latitude2 = "1258";
        // $scope.navlog.longitude2 = "7735";

        $scope.compute = function() {
            console.log()
            if ($scope.navlog.longitude1.indexOf('.') > 0 || $scope.navlog.latitude1.indexOf('.') > 0 || $scope.navlog.longitude2.indexOf('.') > 0 || $scope.navlog.latitude2.indexOf('.') > 0) {
                alert('Wrong format');
                return;
            }
            $scope.navlog.distance = getDistanceFromLatLonInKm(dmstoDecimal($scope.navlog.latitude1), dmstoDecimal($scope.navlog.longitude1), dmstoDecimal($scope.navlog.latitude2), dmstoDecimal($scope.navlog.longitude2));
            $scope.navlog.bearing = getBearing(dmstoDecimal($scope.navlog.latitude1), dmstoDecimal($scope.navlog.longitude1), dmstoDecimal($scope.navlog.latitude2), dmstoDecimal($scope.navlog.longitude2));
            $scope.navlog.distanceNm = $scope.navlog.distance * 0.539957;
        }

        function dmstoDecimal(cord) {
            // console.log(cord.length,parseFloat(cord.substring(cord.length - 2, cord.length)));
            // console.log(cord)
            var result = cord.substring(0, cord.length - 2) + '.' + (parseFloat(cord.substring(cord.length - 2, cord.length)) / 60).toString().replace('0.', '');
            // console.log('cord:' + cord + ' : - ' + result);
            return result;
        }

        function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
            var R = 6371; // Radius of the earth in km
            var dLat = deg2rad(lat2 - lat1); // deg2rad below
            var dLon = deg2rad(lon2 - lon1);
            var a =
                Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            var d = R * c; // Distance in km
            return d;
        }

        function deg2rad(deg) {
            return deg * (Math.PI / 180)
        }

        function toDegrees(angle) {
            return angle * (180 / Math.PI);
        }

        function radians(n) {
            return n * (Math.PI / 180);
        }

        function degrees(n) {
            return n * (180 / Math.PI);
        }

        function getBearing(startLat, startLong, endLat, endLong) {
            startLat = radians(startLat);
            startLong = radians(startLong);
            endLat = radians(endLat);
            endLong = radians(endLong);

            var dLong = endLong - startLong;

            var dPhi = Math.log(Math.tan(endLat / 2.0 + Math.PI / 4.0) / Math.tan(startLat / 2.0 + Math.PI / 4.0));
            if (Math.abs(dLong) > Math.PI) {
                if (dLong > 0.0)
                    dLong = -(2.0 * Math.PI - dLong);
                else
                    dLong = (2.0 * Math.PI + dLong);
            }

            return (degrees(Math.atan2(dLong, dPhi)) + 360.0) % 360.0;
        }
    })
    .controller('shortfplCtrl', function($scope, $http, $q) {
        $scope.shortFpl = {};
        $scope.pbnLineAttr = ['PBN', 'DEP', 'NAV', 'DOF', 'REG', 'EET', 'SEL', 'CODE', 'OPR', 'ALTN', 'PER', 'TALT', 'RALT', 'RMK'];
        $("[data-toggle = 'popover']").popover({
            html: true,
            trigger: "hover"
        });
        $scope.foreignerPilots = [
            { name: 'JEFFREY LYNN MOORE', country: 'USA' },
            { name: 'JOSE MARIA', country: 'SPANISH' },
            { name: 'THOMAS HOY', country: 'USA' },
            { name: 'DAVID GOURLAY', country: 'SCOTTISH' }
        ];

        function errorPopover(message) {
            $('#shortfpl').popover({
                trigger: 'hover',
            });
            $('#shortfpl').attr('data-content', message);
            $('#shortfpl').css("border", "red solid 1px");
            $('#shortfpl').popover('show');


        }
        $('#shortfpl').on('keypress', function(e) {
            var regex = new RegExp("^[a-zA-Z0-9/()\b \n\-]+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (e.charCode == 0 || e.charCode == 13) {
                return true;
            }
            if (regex.test(str)) {
                return true;
            }
            e.preventDefault();
            return false;
        });
        $('#shortfpl').bind('paste', function(e) {
            setTimeout(function() {
                var regex = new RegExp("^[a-zA-Z0-9/()\b \n\-]+$");
                var val = $(e.target).val().replace('\n', '');
                if (regex.test(val)) {} else {
                    errorPopover('SOME FIELDS ARE NOT PASTED CORRECTLY, PLEASE CHECK.');
                }
            }, 1000);

        });

        function closePopover() {
            $('#shortfpl').popover('destroy');
            $('#shortfpl').css("border", "none");
        }

        function splitAttr(attr) {
            console.log(attr);
            for (var i = $scope.pbnLineAttr.indexOf(attr) + 1; i < $scope.pbnLineAttr.length; i++) {
                if ($scope.shortFpl.splitShortFpl[5].split(attr + '/')[1].indexOf($scope.pbnLineAttr[i]) != -1) {
                    return $scope.shortFpl.splitShortFpl[5].split(attr + '/')[1].split($scope.pbnLineAttr[i])[0].trim();
                }
            };
        };
        $scope.process = function() {
            if ($scope.shortFpl.text == undefined || $scope.shortFpl.text == '') {
                errorPopover('SOME FIELDS ARE NOT PASTED CORRECTLY, PLEASE CHECK.');
                return;
            }
            $scope.shortFpl.splitShortFpl = $scope.shortFpl.text.split('\n');
            for (var i = 0; i < $scope.shortFpl.splitShortFpl.length; i++) {
                $scope.shortFpl.splitShortFpl[i] = $scope.shortFpl.splitShortFpl[i].trim();
            };
            if ($scope.shortFpl.splitShortFpl[0].substring(0, 5) != '(FPL-' || $scope.shortFpl.splitShortFpl[$scope.shortFpl.splitShortFpl.length - 1].substring(0, 2) != 'C/' || $scope.shortFpl.splitShortFpl[$scope.shortFpl.splitShortFpl.length - 1].substring($scope.shortFpl.splitShortFpl[$scope.shortFpl.splitShortFpl.length - 1].length - 1) != ')') {
                errorPopover('SOME FIELDS ARE NOT PASTED CORRECTLY, PLEASE CHECK.');
                return;
            }
            var regex = new RegExp("^[a-zA-Z0-9/()\b \n\-]+$");

            if (!regex.test($scope.shortFpl.text)) {
                errorPopover('SOME FIELDS ARE NOT PASTED CORRECTLY, PLEASE CHECK.');
            }
            for (var i = 4; i < $scope.shortFpl.splitShortFpl.length; i++) {

                if ($scope.shortFpl.splitShortFpl[i].substring(0, 1) != '-') {
                    $scope.shortFpl.splitShortFpl[i - 1] = $scope.shortFpl.splitShortFpl[i - 1].concat(' ' + $scope.shortFpl.splitShortFpl[i]);
                    $scope.shortFpl.splitShortFpl.splice(i, 1);
                    i--;
                } else {
                    break;
                }
            };
            for (var i = 6; i < $scope.shortFpl.splitShortFpl.length; i++) {

                if ($scope.shortFpl.splitShortFpl[i].substring(0, 1) != '-') {
                    $scope.shortFpl.splitShortFpl[i - 1] = $scope.shortFpl.splitShortFpl[i - 1].concat(' ' + $scope.shortFpl.splitShortFpl[i]);
                    $scope.shortFpl.splitShortFpl.splice(i, 1);
                    i--;
                } else {
                    break;
                }
            };

            /* call sign */
            $scope.shortFpl.aircraft_callsign = $scope.shortFpl.splitShortFpl[0].split('-')[1];
            /* flight rule*/
            $scope.shortFpl.flight_rules = $scope.shortFpl.splitShortFpl[0].split('-')[2].split('')[0];
            /* flight type*/
            $scope.shortFpl.flight_type = $scope.shortFpl.splitShortFpl[0].split('-')[2].split('')[1];
            /* aircraft type*/
            $scope.shortFpl.aircraft_type = $scope.shortFpl.splitShortFpl[1].split('/')[0].substring(1, $scope.shortFpl.splitShortFpl[1].split('/')[0].length);
            /* weight*/
            $scope.shortFpl.weight_category = $scope.shortFpl.splitShortFpl[1].split('/')[1].substring(0, 1);

            /* Transponder Mode*/
            if ($scope.shortFpl.splitShortFpl[1].split('/').length > 2 && $scope.shortFpl.splitShortFpl[1].split('/')[2].length == 1) {
                $scope.shortFpl.transponder = $scope.shortFpl.splitShortFpl[1].split('/')[2].substring(0, 1);
            }
            /* Equipments*/
            if ($scope.shortFpl.splitShortFpl[1].split('/').length > 2 && $scope.shortFpl.splitShortFpl[1].split('/')[2].length > 1) {
                $scope.shortFpl.equipment = $scope.shortFpl.splitShortFpl[1].split('-')[2].split('/')[0] + '/' + $scope.shortFpl.splitShortFpl[1].split('-')[2].split('/')[1];
            } else {
                $scope.shortFpl.equipment = $scope.shortFpl.splitShortFpl[1].split('-')[2].split('/')[0];
            }
            $scope.shortFpl.departure_aerodrome = $scope.shortFpl.splitShortFpl[2].replace('-', '').substring(0, 4);
            $scope.shortFpl.departure_time_hours = $scope.shortFpl.splitShortFpl[2].replace('-', '').substring(4, 6);
            $scope.shortFpl.departure_time_minutes = $scope.shortFpl.splitShortFpl[2].replace('-', '').substring(6, 8);
            if ($scope.shortFpl.departure_aerodrome == 'ZZZZ') {
                $scope.shortFpl.departure_latlong = $scope.shortFpl.splitShortFpl[5].split('DEP/')[1].split(' ')[0]
                $scope.shortFpl.departure_station = $scope.shortFpl.splitShortFpl[5].split('DEP/')[1].split(' ')[1]
            }

            /* pre speed*/
            $scope.shortFpl.crushing_speed_indication = $scope.shortFpl.splitShortFpl[3].substring(1, 2);
            /* speed*/
            $scope.shortFpl.crushing_speed = $scope.shortFpl.splitShortFpl[3].substring(2, 6);
            /* pre level*/
            $scope.shortFpl.flight_level_indication = $scope.shortFpl.splitShortFpl[3].substring(6, 7);
            /* level*/
            $scope.shortFpl.flight_level = $scope.shortFpl.splitShortFpl[3].substring(7, 10);
            /* route*/
            $scope.shortFpl.route = $scope.shortFpl.splitShortFpl[3].substring(11);
            /* destination aerodrome*/
            $scope.shortFpl.destination_aerodrome = $scope.shortFpl.splitShortFpl[4].substring(1, 5);
            if ($scope.shortFpl.destination_aerodrome == 'ZZZZ') {
                $scope.shortFpl.destination_latlong = $scope.shortFpl.splitShortFpl[5].split('DEST/')[1].split(' ')[0]
                $scope.shortFpl.destination_station = $scope.shortFpl.splitShortFpl[5].split('DEST/')[1].split(' ')[1]
            }
            /* total flying time*/
            $scope.shortFpl.total_flying_hours = $scope.shortFpl.splitShortFpl[4].substring(5, 7);
            $scope.shortFpl.total_flying_minutes = $scope.shortFpl.splitShortFpl[4].substring(7, 9);

            /* first alternative aero_drome*/
            $scope.shortFpl.first_alternate_aerodrome = $scope.shortFpl.splitShortFpl[4].substring(10, 14);
            /* second alternative aero_drome*/
            $scope.shortFpl.second_alternate_aerodrome = $scope.shortFpl.splitShortFpl[4].substring(15, 19);




            /* pbn */
            if ($scope.shortFpl.splitShortFpl[5].split('PBN/')[1] != undefined) {
                $scope.shortFpl.pbn = splitAttr('PBN');
            }
            /* DOF */
            $scope.shortFpl.date_of_flight = $scope.shortFpl.splitShortFpl[5].split('DOF/')[1].split(' ')[0];
            // console.log($scope.shortFpl.date_of_flight);
            // console.log();
            $scope.shortFpl.date_of_flight = moment($scope.shortFpl.date_of_flight, 'YYMMDD').format('DD-MMM-YYYY');
            // return;
            /* nav */
            if ($scope.shortFpl.splitShortFpl[5].split('NAV/')[1] != undefined) {
                $scope.shortFpl.nav = splitAttr('NAV');
            }

            /* CODE */
            if ($scope.shortFpl.splitShortFpl[5].split('CODE/')[1] != undefined) {
                $scope.shortFpl.code = splitAttr('CODE');
            }
            /* take_off_altn */
            if ($scope.shortFpl.splitShortFpl[5].split('TALT/')[1] != undefined) {
                $scope.shortFpl.take_off_altn = splitAttr('TALT');
            }
            /* route_altn */
            if ($scope.shortFpl.splitShortFpl[5].split('RALT/')[1] != undefined) {
                $scope.shortFpl.route_altn = splitAttr('RALT');
            }
            /* registration */
            $scope.shortFpl.registration = splitAttr('REG');
            /* fir crossing time */
            if ($scope.shortFpl.splitShortFpl[5].split('EET/')[1] != undefined) {
                $scope.shortFpl.fir_crossing_time = splitAttr('EET');
            }

            /* sel */
            if ($scope.shortFpl.splitShortFpl[5].split('SEL/')[1] != undefined) {
                $scope.shortFpl.sel = splitAttr('SEL');
            }
            /* operator */
            // if ($scope.shortFpl.splitShortFpl[5].indexOf('PER/') != -1 && ($scope.shortFpl.splitShortFpl[5].indexOf('PER/') < $scope.shortFpl.splitShortFpl[5].indexOf('ALTN/'))) {
            //     $scope.shortFpl.operator = $scope.shortFpl.splitShortFpl[5].split('OPR/')[1].split('PER/')[0];
            // } else {
            $scope.shortFpl.operator = splitAttr('OPR');
            // }
            /* performance */
            if ($scope.shortFpl.splitShortFpl[5].split('PER/')[1] != undefined) {
                $scope.shortFpl.per = splitAttr('PER');
            }
            /* ALTERNATE STATION */
            if ($scope.shortFpl.splitShortFpl[5].split('ALTN/')[1] != undefined) {
                $scope.shortFpl.alternate_station = splitAttr('ALTN');
            }
            /* remarks*/
            if ($scope.shortFpl.splitShortFpl[5].split('RMK/')[1] == undefined) {
                errorPopover('Remark is missing');
                // alert('Remark should be on the same line of alternative aerodrome');
                return;
            }
            $scope.shortFpl.remarks = $scope.shortFpl.splitShortFpl[5].split('RMK/')[1];




            /* Credit checking */
            if ($scope.shortFpl.remarks.indexOf('NO CREDIT') > -1) {
                $scope.shortFpl.remarks = $scope.shortFpl.remarks.replace('NO CREDIT FACILITY', '');
                $scope.shortFpl.credit = 'NO';
            } else if ($scope.shortFpl.remarks.indexOf('CREDIT') > -1) {
                $scope.shortFpl.remarks = $scope.shortFpl.remarks.replace('CREDIT FACILITY AVAILABLE WITH AAI', '');
                $scope.shortFpl.remarks = $scope.shortFpl.remarks.replace('CREDIT FACILITY AVAILABLE', '');
                $scope.shortFpl.credit = 'YES';
            }
            /* Foreigner checking*/
            if ($scope.shortFpl.remarks.indexOf('FOREIGNER') > -1 && $scope.shortFpl.remarks.indexOf('NO FOREIGNER') == -1) {
                $scope.shortFpl.foreigner = 'YES';
                $scope.shortFpl.foreigner_nationality = $scope.shortFpl.remarks.substring($scope.shortFpl.remarks.indexOf('FOREIGNER ON BOARD') + 18);
                $scope.shortFpl.remarks = $scope.shortFpl.remarks.replace('FOREIGNER ON BOARD', '');
                $scope.shortFpl.remarks = $scope.shortFpl.remarks.replace($scope.shortFpl.foreigner_nationality, '');

            } else {
                $scope.shortFpl.remarks = $scope.shortFpl.remarks.replace('ALL INDIANS ON BOARD NO FOREIGNER', '');
                $scope.shortFpl.foreigner = 'NO';
            }
            /* tcas checking*/
            if ($scope.shortFpl.remarks.indexOf('TCAS EQUIPPED') > -1) {
                $scope.shortFpl.remarks = $scope.shortFpl.remarks.replace('TCAS EQUIPPED', '');
                $scope.shortFpl.tcas = 'YES';
            } else {
                $scope.shortFpl.tcas = 'NO';
            }
            /* endurance*/
            $scope.shortFpl.endurance_hours = $scope.shortFpl.splitShortFpl[6].split('E/')[1].split(' ')[0].substring(0, 2);
            $scope.shortFpl.endurance_minutes = $scope.shortFpl.splitShortFpl[6].split('E/')[1].split(' ')[0].substring(2, 4);

            /* DINGHIES */
            if ($scope.shortFpl.splitShortFpl[6].split('D/')[1] != undefined) {
                /* number */
                console.log($scope.shortFpl.splitShortFpl[6].split('D/')[1].split(' ')[0].length);
                if ($scope.shortFpl.splitShortFpl[6].split('D/')[1].split(' ')[0].length == 2) {
                    $scope.shortFpl.number = $scope.shortFpl.splitShortFpl[6].split('D/')[1].split(' ')[0];
                } else {
                    $scope.shortFpl.number = $scope.shortFpl.splitShortFpl[6].split('D/')[1].split(' ')[0].slice(1, 3);
                }
                /* capacity */
                if ($scope.shortFpl.splitShortFpl[6].split('D/')[1].split(' ')[1].length == 2) {
                    $scope.shortFpl.capacity = $scope.shortFpl.splitShortFpl[6].split('D/')[1].split(' ')[1];
                } else {
                    $scope.shortFpl.capacity = $scope.shortFpl.splitShortFpl[6].split('D/')[1].split(' ')[1].slice(1, 3);
                }
                if ($scope.shortFpl.splitShortFpl[6].split('D/')[1].split(' ')[2] == 'C') {
                    $scope.shortFpl.cover = 'YES';
                    $scope.shortFpl.color = $scope.shortFpl.splitShortFpl[6].split('D/')[1].split(' ')[3];
                }
            }
            $scope.shortFpl.aircraft_color = $scope.shortFpl.splitShortFpl[$scope.shortFpl.splitShortFpl.length - 2].split('/')[1];
            /*emergency radio*/
            $scope.shortFpl.emergency_radio = $scope.shortFpl.splitShortFpl[6].split('R/')[1].split(' ')[0];

            if ($scope.shortFpl.emergency_radio.indexOf('U') != -1) {
                $scope.shortFpl.emergency_uhf = 'YES';
            }
            if ($scope.shortFpl.emergency_radio.indexOf('V') != -1) {
                $scope.shortFpl.emergency_vhf = 'YES';
            }
            if ($scope.shortFpl.emergency_radio.indexOf('E') != -1) {
                $scope.shortFpl.emergency_elba = 'YES';
            }
            /* survival */
            if ($scope.shortFpl.splitShortFpl[6].split('S/')[1] != undefined) {
                $scope.shortFpl.survival = $scope.shortFpl.splitShortFpl[6].split('S/')[1].split(' ')[0];
                if ($scope.shortFpl.survival.indexOf('P') != -1) {
                    $scope.shortFpl.polar = 'YES';
                }
                if ($scope.shortFpl.survival.indexOf('D') != -1) {
                    $scope.shortFpl.desert = 'YES';
                }
                if ($scope.shortFpl.survival.indexOf('M') != -1) {
                    $scope.shortFpl.maritime = 'YES';
                }
                if ($scope.shortFpl.survival.indexOf('J') != -1) {
                    $scope.shortFpl.jungle = 'YES';
                }
            }
            /*jacket */
            if ($scope.shortFpl.splitShortFpl[6].split('J/')[1] != undefined) {
                $scope.shortFpl.jacket = $scope.shortFpl.splitShortFpl[6].split('J/')[1].split(' ')[0];
                if ($scope.shortFpl.jacket.indexOf('L') != -1) {
                    $scope.shortFpl.light = 'YES';
                }
                if ($scope.shortFpl.jacket.indexOf('F') != -1) {
                    $scope.shortFpl.floures = 'YES';
                }
                if ($scope.shortFpl.jacket.indexOf('U') != -1) {
                    $scope.shortFpl.jacket_uhf = 'YES';
                }
                if ($scope.shortFpl.jacket.indexOf('V') != -1) {
                    $scope.shortFpl.jacket_vhf = 'YES';
                }
            }
            /* pax */
            $scope.shortFpl.pax = $scope.shortFpl.splitShortFpl[6].split('P/')[1].split(' ')[0];
            /* pilot */
            $scope.shortFpl.pilot_in_command = $scope.shortFpl.splitShortFpl[$scope.shortFpl.splitShortFpl.length - 1].split('/')[1].replace(')', '').trim();
            // console.log($scope.shortFpl.pilot_in_command);
            for (var i = 0; i < $scope.foreignerPilots.length; i++) {
                if ($scope.foreignerPilots[i].name == $scope.shortFpl.pilot_in_command) {
                    $scope.shortFpl.foreigner = 'YES';
                    $scope.shortFpl.foreigner_nationality = $scope.foreignerPilots[i].country;
                }
            };
            if ($scope.shortFpl.departure_aerodrome == 'VCCC' || $scope.shortFpl.departure_aerodrome == 'VCBI' || $scope.shortFpl.destination_aerodrome == 'VCCC' || $scope.shortFpl.destination_aerodrome == 'VCBI') {
                $scope.shortFpl.foreigner = 'YES';
                $scope.shortFpl.foreigner_nationality = 'SRI LANKAN';
            }
            // return;
            $scope.pilot_in_command = $scope.shortFpl.pilot_in_command;

            var data = "";
            var deferred = $q.defer();

            $http({
                url: base_url + "/fpl/get_pilot_details",
                method: "POST",
                data: { "pilot_name": $scope.pilot_in_command },
                cache: false,
                async: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
            }).success(function(data, status, headers, config) {
                deferred.resolve(data);
                $scope.shortFpl.mobile_number = data.mobilenum;
            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });


            var promiseB = deferred.promise.then(function(result) {
                return $scope.shortFpl.mobile_number = result.mobilenum;
            });

            $scope.shortFpl.is_process = 1;

            // return false;
            // validation conditions
            var currentDate = new Date();
            currentDate.setHours(0);
            currentDate.setMinutes(0);
            currentDate.setSeconds(0);
            currentDate.setMilliseconds(0);
            //Anand
//            if ((moment.utc(new Date()).add(30, 'minutes') > moment.utc($scope.shortFpl.departure_time_hours + ':' + $scope.shortFpl.departure_time_minutes, 'hh:mm')) && moment($scope.shortFpl.date_of_flight, 'DD-MMM-YYYY').diff(moment(currentDate), 'days') == 0) {
//                errorPopover('check departure_time');
//                // alert('check departure_time');
//                return;
//            }
            if (moment($scope.shortFpl.date_of_flight, 'DD-MMM-YYYY').diff(moment(currentDate).add(4, 'days'), 'days') > 0 || moment($scope.shortFpl.date_of_flight, 'DD-MMM-YYYY').diff(moment(currentDate).add(4, 'days'), 'days') < -4) {
                errorPopover('Departure date should be current date or next 4 days');
                // alert('Departure date should be current date or next 4 days');
                return;
            }
            if ($scope.shortFpl.departure_time_hours == "00" && $scope.shortFpl.departure_time_minutes == "00") {
                errorPopover('Min Departure time is 0005');
                return;
            }
            console.log($scope.shortFpl);
            if ($scope.shortFpl.aircraft_type.trim().length != 4) {
                errorPopover('Min. & Max. 4 Characters, only Alphabets & Numbers allowed for Aircraft Type');
                return;
            }
            $.redirect(base_url + '/shortfpl/fullfpl', { 'arg': $scope.shortFpl, '_token': $('meta[name="_token"]').attr('content') });
        };
    })
    .controller('notamsCtrl', function($scope, $http, $timeout) {
        $scope.notamForm = {};
        function listToMatrix(data) {
            var offset = 18;
            var result = [];
            for (var i = 0; i < (data.length / offset); i++) {
                result[i] = [];
                for (var j = 0; j < offset; j++) {
                    result[i].push(data[(i * offset) + j])
                };
            };

            return result;
        }  

        if(window.location.href.indexOf('/upload')!=-1){
            var notams_name_space='/notams';
        }
        else{
            var notams_name_space='/notamsops';
        }

        $http.get(base_url+notams_name_space + '/getnotamcount')
            .then(function(data) {
                console.log(data);
                $scope.individualAirportNotamCount = {};
                if(notams_name_space=='/notams'){
                $scope.individualAirportNotamCount = listToMatrix(data.data.individualAirportNotamCount);

                }
                else{
                $scope.individualAirportNotamCount['vi'] = listToMatrix(data.data.individualAirportNotamCount['VI']);
                $scope.individualAirportNotamCount['ve'] = listToMatrix(data.data.individualAirportNotamCount['VE']);
                $scope.individualAirportNotamCount['va'] = listToMatrix(data.data.individualAirportNotamCount['VA']);
                $scope.individualAirportNotamCount['vo'] = listToMatrix(data.data.individualAirportNotamCount['VO']);
              
                }
             console.log($scope.individualAirportNotamCount)
                $scope.airportCount=data.data.airport_count;
                for (key in data.data.lastUpdatedTime) {
                    switch (key) {
                        case 'va':
                            $scope.newlyAddedCountVa = 0;
                            $scope.totalCountVa = data.data.notamsCount[key];
                            $scope.notUpdatedCountVa = data.data.notUpdatedNotamsCount[key];

                            if (data.data.lastUpdatedTime[key] != 'NA') {
                                $scope.lastUpdatedTimeVa = moment.utc(data.data.lastUpdatedTime[key]).utcOffset("+05:30").format('DD-MMM-YYYY HH:mm') + " IST";
                            } else {
                                $scope.lastUpdatedTimeVa = data.data.lastUpdatedTime[key];
                            }
                            break;
                        case 've':
                            $scope.newlyAddedCountVe = 0;
                            $scope.totalCountVe = data.data.notamsCount[key];
                            $scope.notUpdatedCountVe = data.data.notUpdatedNotamsCount[key];
                            if (data.data.lastUpdatedTime[key] != 'NA') {
                                $scope.lastUpdatedTimeVe = moment.utc(data.data.lastUpdatedTime[key]).utcOffset("+05:30").format('DD-MMM-YYYY HH:mm') + " IST";
                            } else {
                                $scope.lastUpdatedTimeVe = data.data.lastUpdatedTime[key];
                            }

                            break;
                        case 'vo':
                            $scope.newlyAddedCountVo = 0;
                            $scope.totalCountVo = data.data.notamsCount[key];
                            $scope.notUpdatedCountVo = data.data.notUpdatedNotamsCount[key];
                            if (data.data.lastUpdatedTime[key] != 'NA') {
                                $scope.lastUpdatedTimeVo = moment.utc(data.data.lastUpdatedTime[key]).utcOffset("+05:30").format('DD-MMM-YYYY HH:mm') + " IST";
                            } else {
                                $scope.lastUpdatedTimeVo = data.data.lastUpdatedTime[key];
                            }

                            break;
                        case 'vi':
                            $scope.newlyAddedCountVi = 0;
                            $scope.totalCountVi = data.data.notamsCount[key];
                            $scope.notUpdatedCountVi = data.data.notUpdatedNotamsCount[key];
                            console.log($scope.notUpdatedCountVi);
                            if (data.data.lastUpdatedTime[key] != 'NA') {
                                $scope.lastUpdatedTimeVi = moment.utc(data.data.lastUpdatedTime[key]).utcOffset("+05:30").format('DD-MMM-YYYY HH:mm') + " IST";
                            } else {
                                $scope.lastUpdatedTimeVi = data.data.lastUpdatedTime[key];
                            }
                            break;
                    }
                }

            });
        $scope.uploadFirNotams = function(fir) {
            var id = 'upload_input_' + fir;
            document.getElementById(id).click();
        };
        $scope.openAirportModal = function(id){
            $scope.airportList=$scope.individualAirportNotamCount[id][0].concat($scope.individualAirportNotamCount[id][1]);
            $('#airport-alert-box').modal();
            var firObj = {
                'vi': 'Delhi Region',
                'va': 'Mumbai Region',
                'vo': 'Chennai Region',
                've': 'Kolkata Region',
            }
            $scope.regionName = firObj[id];
        };
        $scope.noNewNotamUpdate = function(key) {
            console.log($scope.noNewNotam, key);
            $http.get(base_url + '/notams/updatelasttime?fir=' + key)
                .success(function(data) {
                    console.log(data)
                })
        }

        $scope.onFileUpload = function(key) {
            var firObj = {
                'vi': 'Delhi Region',
                'va': 'Mumbai Region',
                'vo': 'Chennai Region',
                've': 'Kolkata Region',
            }
            if (!$scope.notamForm[key] || $scope.notamForm[key].length == 0) {
                return;
            }
            if ($scope.notamForm[key][0].type != 'application/vnd.ms-excel') {
                alert('Invalid file format');
                return;
            }
            if ($scope.notamForm[key][0].name.indexOf(key.toUpperCase()) == -1) {
                alert('Wrong file is uploading for the ' + firObj[key]);
                return;
            };
            $('#notam-pg-box').modal({ backdrop: 'static', keyboard: false })
            $('#notam-pg-box').modal('show');
            $scope.progressbarVal = 0;
            $scope.incrementVariable = 0.3;
            $("#loaderText").html("Uploading Notams ...");
            var interval = setInterval(function() {
                $scope.progressbarVal = $scope.progressbarVal + $scope.incrementVariable;
                $("#progress_bar").progressbar({ value: $scope.progressbarVal });
                $("#percentage").html($scope.progressbarVal + " %");
                $("#percentage2").html(Math.round($scope.progressbarVal) + " %");
                if ($scope.progressbarVal >= 77) {
                    $scope.incrementVariable = 0.09;
                }
                if ($scope.progressbarVal >= 99) {
                    clearInterval(interval);
                }
            }, 100);
            var formData = new FormData(this);
            formData.append('token', $('meta[name="_token"]').attr('content'));
            formData.append('file', $scope.notamForm[key][0]);
            $http({
                    method: 'POST',
                    url: base_url + '/notams/uploadxls',
                    data: formData,
                    headers: {
                        'Content-Type': undefined
                    },
                }).success(function(data) {
                    console.log(data);
                    switch (key) {
                        case 'vi':
                            $scope.newlyAddedCountVi = data.newlyAdded;
                            break;
                        case 'vo':
                            $scope.newlyAddedCountVo = data.newlyAdded;
                            break;
                        case 've':
                            $scope.newlyAddedCountVe = data.newlyAdded;
                            break;
                        case 'va':
                            $scope.newlyAddedCountVa = data.newlyAdded;
                            break;
                    }

                    $timeout(function() {
                        $('#notam-pg-box').modal('hide');
                    });
                    // get count call

                    $http.get(base_url +notams_name_space + '/getnotamcount')
                        .then(function(data) {
                            $scope.individualAirportNotamCount = listToMatrix(data.data.individualAirportNotamCount);

                            for (key in data.data.lastUpdatedTime) {
                                switch (key) {
                                    case 'va':
                                        $scope.totalCountVa = data.data.notamsCount[key];
                                        // $scope.lastUpdatedTimeVa= moment(data.data.lastUpdatedTime[key]).tz("UTC+5.30").format('DD-MMM-YYYY HH:mm')+" IST";
                                        $scope.notUpdatedCountVa = data.data.notUpdatedNotamsCount[key];

                                        if (data.data.lastUpdatedTime[key] != 'NA') {
                                            $scope.lastUpdatedTimeVa = moment.utc(data.data.lastUpdatedTime[key]).utcOffset("+05:30").format('DD-MMM-YYYY HH:mm') + " IST";
                                        } else {
                                            $scope.lastUpdatedTimeVa = data.data.lastUpdatedTime[key];
                                        }
                                        break;
                                    case 've':
                                        $scope.totalCountVe = data.data.notamsCount[key];
                                        // $scope.lastUpdatedTimeVe=data.data.lastUpdatedTime[key];
                                        $scope.notUpdatedCountVe = data.data.notUpdatedNotamsCount[key];
                                        if (data.data.lastUpdatedTime[key] != 'NA') {
                                            $scope.lastUpdatedTimeVe = moment.utc(data.data.lastUpdatedTime[key]).utcOffset("+05:30").format('DD-MMM-YYYY HH:mm') + " IST";
                                        } else {
                                            $scope.lastUpdatedTimeVe = data.data.lastUpdatedTime[key];
                                        }
                                        break;
                                    case 'vo':
                                        $scope.totalCountVo = data.data.notamsCount[key];
                                        // $scope.lastUpdatedTimeVo=data.data.lastUpdatedTime[key];
                                        $scope.notUpdatedCountVo = data.data.notUpdatedNotamsCount[key];
                                        if (data.data.lastUpdatedTime[key] != 'NA') {
                                            $scope.lastUpdatedTimeVo = moment.utc(data.data.lastUpdatedTime[key]).utcOffset("+05:30").format('DD-MMM-YYYY HH:mm') + " IST";
                                        } else {
                                            $scope.lastUpdatedTimeVo = data.data.lastUpdatedTime[key];
                                        }
                                        break;
                                    case 'vi':
                                        $scope.totalCountVi = data.data.notamsCount[key];
                                        // $scope.lastUpdatedTimeVi=data.data.lastUpdatedTime[key];
                                        $scope.notUpdatedCountVi = data.data.notUpdatedNotamsCount[key];
                                        if (data.data.lastUpdatedTime[key] != 'NA') {
                                            $scope.lastUpdatedTimeVi = moment.utc(data.data.lastUpdatedTime[key]).utcOffset("+05:30").format('DD-MMM-YYYY HH:mm') + " IST";
                                        } else {
                                            $scope.lastUpdatedTimeVi = data.data.lastUpdatedTime[key];
                                        }
                                        break;
                                }
                            }

                        })


                    // end 
                })
                .error(function(data) {
                    alert('failed to fetch latest notams');
                    $('#notam-pg-box').modal('hide');
                    $('.notify-bg-v').css('display', 'none');
                    $('.notification-block .v_notfications').css('z-index', '999999');
                });
        }
        $scope.$watch('notamForm.vi', function() {
            $scope.onFileUpload('vi');
        });
        $scope.$watch('notamForm.ve', function() {
            $scope.onFileUpload('ve');
        });
        $scope.$watch('notamForm.vo', function() {
            $scope.onFileUpload('vo');
        });
        $scope.$watch('notamForm.va', function() {
            $scope.onFileUpload('va');
        });

        $scope.fetchNotamBasedOnFir = function(fir) {
            $('#notam-pg-box').modal({ backdrop: 'static', keyboard: false })
            $('#notam-pg-box').modal('show');
            $scope.progressbarVal = 0;
            $scope.incrementVariable = 0.3;
            $("#loaderText").html("Fetching Notams ...");
            var interval = setInterval(function() {
                $scope.progressbarVal = $scope.progressbarVal + $scope.incrementVariable;
                $("#progress_bar").progressbar({ value: $scope.progressbarVal });
                $("#percentage").html($scope.progressbarVal + " %");
                $("#percentage2").html(Math.round($scope.progressbarVal) + " %");
                if ($scope.progressbarVal >= 77) {
                    $scope.incrementVariable = 0.09;
                }
                if ($scope.progressbarVal >= 99) {
                    clearInterval(interval);
                }
            }, 100);

            // $('.notify-bg-v').css('display', 'block');
            // $('.notification-block .v_notfications').css('z-index', '1');
            $http.get(base_url + '/notamsops/fetchnotams_fir?fir=' + fir)
                .then(function(data) {
                    $scope.progressbarVal = 98;
                    console.log(data);
                    $scope.newNotamsCount = data.data.newNotamsCount;
                    $('.notify-bg-v').css('display', 'none');
                    $('.notification-block .v_notfications').css('z-index', '999999');

                    if (data.status == 404) {
                        alert('Internal server Error Occured')
                    }
                    $http.get(base_url +notams_name_space + '/getnotamcount')
                        .then(function(data) {
                             $scope.individualAirportNotamCount = {};
                $scope.individualAirportNotamCount['vi'] = listToMatrix(data.data.individualAirportNotamCount['VI']);
                $scope.individualAirportNotamCount['ve'] = listToMatrix(data.data.individualAirportNotamCount['VE']);
                $scope.individualAirportNotamCount['va'] = listToMatrix(data.data.individualAirportNotamCount['VA']);
                $scope.individualAirportNotamCount['vo'] = listToMatrix(data.data.individualAirportNotamCount['VO']);
               console.log($scope.individualAirportNotamCount)
                $scope.airportCount=data.data.airport_count;
                
                            for (key in data.data.lastUpdatedTime) {
                                switch (key) {
                                    case 'va':
                                        $scope.totalCountVa = data.data.notamsCount[key];
                                        // $scope.lastUpdatedTimeVa= moment(data.data.lastUpdatedTime[key]).tz("UTC+5.30").format('DD-MMM-YYYY HH:mm')+" IST";
                                        $scope.lastUpdatedTimeVa = moment.utc(data.data.lastUpdatedTime[key]).utcOffset("+05:30").format('DD-MMM-YYYY HH:mm') + " IST";

                                        break;
                                    case 've':
                                        $scope.totalCountVe = data.data.notamsCount[key];
                                        // $scope.lastUpdatedTimeVe=data.data.lastUpdatedTime[key];
                                        $scope.lastUpdatedTimeVe = moment.utc(data.data.lastUpdatedTime[key]).utcOffset("+05:30").format('DD-MMM-YYYY HH:mm') + " IST";

                                        break;
                                    case 'vo':
                                        $scope.totalCountVo = data.data.notamsCount[key];
                                        // $scope.lastUpdatedTimeVo=data.data.lastUpdatedTime[key];
                                        $scope.lastUpdatedTimeVo = moment.utc(data.data.lastUpdatedTime[key]).utcOffset("+05:30").format('DD-MMM-YYYY HH:mm') + " IST";

                                        break;
                                    case 'vi':
                                        $scope.totalCountVi = data.data.notamsCount[key];
                                        // $scope.lastUpdatedTimeVi=data.data.lastUpdatedTime[key];
                                        $scope.lastUpdatedTimeVi = moment.utc(data.data.lastUpdatedTime[key]).utcOffset("+05:30").format('DD-MMM-YYYY HH:mm') + " IST";

                                        break;
                                }
                            }

                        });
                    if (data.data.message == 'success') {

                        switch (fir) {
                            case 'va':
                                $scope.newlyAddedCountVa = data.data.updated_count;
                                $scope.totalCountVa = data.data.total_count;
                                break;
                            case 've':
                                $scope.newlyAddedCountVe = data.data.updated_count;
                                $scope.totalCountVe = data.data.total_count;
                                break;
                            case 'vo':
                                $scope.newlyAddedCountVo = data.data.updated_count;
                                $scope.totalCountVo = data.data.total_count;
                                break;
                            case 'vi':
                                $scope.newlyAddedCountVi = data.data.updated_count;
                                $scope.totalCountVi = data.data.total_count;
                                break;
                        }

                        $timeout(function() {
                            $('#notam-pg-box').modal('hide');
                        });
                    }
                })
                .catch(function(data) {
                    alert('failed to fetch latest notams');
                    $('#notam-pg-box').modal('hide');
                    $('.notify-bg-v').css('display', 'none');
                    $('.notification-block .v_notfications').css('z-index', '999999');
                });
        }
    })
    .controller('notamsFirCtrl', function($scope, $http, $timeout) {
        $http.get(base_url + '/notamsops/getnotambyfir?id=va')
            .success(function(data) {
                console.log(data);
            });
    });
