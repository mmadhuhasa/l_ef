angular.module('eflight', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    })
    .controller('combinedfplCtrl', function($scope, $http, $q) {
        $scope.shortFpl = {};
        $scope.enableProcess = false;
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

        // function errorPopover(message) {
        //     $('#shortfpl').popover({
        //         trigger: 'hover',
        //     });
        //     $('#shortfpl').attr('data-content', message);
        //     $('#shortfpl').css("border", "red solid 1px");
        //     $('#shortfpl').popover('show');


        // }
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
                if (regex.test(val)) {
                    closePopover('#shortfpl');
                } else {
                    errorPopover('#shortfpl', 'SOME FIELDS ARE NOT PASTED CORRECTLY, PLEASE CHECK.');
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
            if ($scope.enableProcess == false) {
                return;
            }
            if ($scope.shortFpl.text == undefined || $scope.shortFpl.text == '') {
                errorPopover('#shortfpl', 'SOME FIELDS ARE NOT PASTED CORRECTLY, PLEASE CHECK.');
                return;
            }
            $scope.shortFpl.splitShortFpl = $scope.shortFpl.text.split('\n');
            for (var i = 0; i < $scope.shortFpl.splitShortFpl.length; i++) {
                $scope.shortFpl.splitShortFpl[i] = $scope.shortFpl.splitShortFpl[i].trim();
            };
            if ($scope.shortFpl.splitShortFpl[0].substring(0, 5) != '(FPL-' || $scope.shortFpl.splitShortFpl[$scope.shortFpl.splitShortFpl.length - 1].substring(0, 2) != 'C/' || $scope.shortFpl.splitShortFpl[$scope.shortFpl.splitShortFpl.length - 1].substring($scope.shortFpl.splitShortFpl[$scope.shortFpl.splitShortFpl.length - 1].length - 1) != ')') {
                errorPopover('#shortfpl', 'SOME FIELDS ARE NOT PASTED CORRECTLY, PLEASE CHECK.');
                return;
            }
            var regex = new RegExp("^[a-zA-Z0-9/()\b \n\-]+$");

            if (!regex.test($scope.shortFpl.text)) {
                errorPopover('#shortfpl', 'SOME FIELDS ARE NOT PASTED CORRECTLY, PLEASE CHECK.');
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
                errorPopover('#shortfpl', 'Remark is missing');
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
            if ((moment.utc(new Date()).add(30, 'minutes') > moment.utc($scope.shortFpl.departure_time_hours + ':' + $scope.shortFpl.departure_time_minutes, 'hh:mm')) && moment($scope.shortFpl.date_of_flight, 'DD-MMM-YYYY').diff(moment(currentDate), 'days') == 0) {
                errorPopover('#shortfpl', 'check departure_time');
                // alert('check departure_time');
                return;
            }
            if (moment($scope.shortFpl.date_of_flight, 'DD-MMM-YYYY').diff(moment(currentDate).add(4, 'days'), 'days') > 0 || moment($scope.shortFpl.date_of_flight, 'DD-MMM-YYYY').diff(moment(currentDate).add(4, 'days'), 'days') < -4) {
                errorPopover('#shortfpl', 'Departure date should be current date or next 4 days');
                // alert('Departure date should be current date or next 4 days');
                return;
            }
            if ($scope.shortFpl.departure_time_hours == "00" && $scope.shortFpl.departure_time_minutes == "00") {
                errorPopover('#shortfpl', 'Min Departure time is 0005');
                return;
            }
            console.log($scope.shortFpl);
            if ($scope.shortFpl.aircraft_type.trim().length != 4) {
                errorPopover('#shortfpl', 'Min. & Max. 4 Characters, only Alphabets & Numbers allowed for Aircraft Type');
                return;
            }
            $.redirect(base_url + '/shortfpl/fullfpl', { 'arg': $scope.shortFpl, '_token': $('meta[name="_token"]').attr('content') });
        };


        // lnt scrap code

        $scope.pasteLnt = {};
        $scope.validationCondition = {
            'VTSSF': {
                maxtakeOffFuel: 3670,
                maxzeroFuelWt: 10000,
                maxtakeOffWt: 12500,
                maxLandWt: 11600
            },
            'VTAVS': {
                maxtakeOffFuel: 2750,
                maxzeroFuelWt: 8444,
                maxtakeOffWt: 10472,
                maxLandWt: 9766
            },
            'VTOBR': {
                maxtakeOffFuel: 9912,
                maxzeroFuelWt: 18450,
                maxtakeOffWt: 28000,
                maxLandWt: 23350
            },
            'VTVRL': {
                maxtakeOffFuel: 3650,
                maxzeroFuelWt: 10000,
                maxtakeOffWt: 12500,
                maxLandWt: 11600
            },
            'VTANF': {
                maxtakeOffFuel: 3650,
                maxzeroFuelWt: 10000,
                maxtakeOffWt: 12500,
                maxLandWt: 11600
            },
            'VTAUV': {
                maxtakeOffFuel: 20000,
                maxzeroFuelWt: 32000,
                maxtakeOffWt: 48200,
                maxLandWt: 38000
            }
        }

        function readCallSign() {
            var dataSplittedWithNewLine = $scope.pasteLnt.text.split('\n');
            for (var i = 0; i < dataSplittedWithNewLine.length; i++) {
                if (dataSplittedWithNewLine[i].split(' [ ').length > 1) {
                    $scope.pasteLnt.callsign = dataSplittedWithNewLine[i].split(' [ ')[0].substring(dataSplittedWithNewLine[i].split(' [ ')[0].length - 5, dataSplittedWithNewLine[i].split(' [ ')[0].length).trim();
                }
            }

        }

        function readSourceAndDestination() {
            var dataSplittedWithNewLine = $scope.pasteLnt.text.split('\n');
            for (var i = 0; i < dataSplittedWithNewLine.length; i++) {
                if (dataSplittedWithNewLine[i].split('DEP :').length > 1) {
                    $scope.pasteLnt.departure_aerodrome = dataSplittedWithNewLine[i].split('DEP :')[1].substring(0, 5).trim();
                }
                if (dataSplittedWithNewLine[i].split('DEST:').length > 1) {
                    $scope.pasteLnt.destination_aerodrome = dataSplittedWithNewLine[i].split('DEST:')[1].substring(0, 4).trim();
                }
            };
        }

        function readFuelInfo() {
            var dataSplittedWithNewLine = $scope.pasteLnt.text.split('\n');
            for (var i = 0; i < dataSplittedWithNewLine.length; i++) {
                if (dataSplittedWithNewLine[i].split('LANDING FUEL :').length > 1) {
                    $scope.pasteLnt.landing_fuel = parseInt(dataSplittedWithNewLine[i].split('LANDING FUEL :')[1].split('LBS')[0].trim());
                }
                if (dataSplittedWithNewLine[i].split('LANDING FUEL:').length > 1) {
                    $scope.pasteLnt.landing_fuel = parseInt(dataSplittedWithNewLine[i].split('LANDING FUEL:')[1].split('LBS')[0].trim());
                }
                if (dataSplittedWithNewLine[i].split('TAKE OFF FUEL :').length > 1) {
                    $scope.pasteLnt.take_off_fuel = parseInt(dataSplittedWithNewLine[i].split('TAKE OFF FUEL :')[1].split('LBS')[0].trim());
                }
                if (dataSplittedWithNewLine[i].split('TAKE OFF FUEL:').length > 1) {
                    $scope.pasteLnt.take_off_fuel = parseInt(dataSplittedWithNewLine[i].split('TAKE OFF FUEL:')[1].split('LBS')[0].trim());
                }
                if (dataSplittedWithNewLine[i].split('BLOCK FUEL :').length > 1) {
                    $scope.pasteLnt.block_fuel = dataSplittedWithNewLine[i].split('BLOCK FUEL :')[1].split('LBS')[0].trim();
                }
                if (dataSplittedWithNewLine[i].split('BLOCK FUEL:').length > 1) {
                    $scope.pasteLnt.block_fuel = dataSplittedWithNewLine[i].split('BLOCK FUEL:')[1].split('LBS')[0].trim();
                }
            }
        }
        //  function readFuelInfo() {
        //     var dataSplittedWithNewLine = $scope.pasteLnt.text.split('\n');
        //     for (var i = 0; i < dataSplittedWithNewLine.length; i++) {
        //         if (dataSplittedWithNewLine[i].split('COMPUTED FUEL:').length > 1) {
        //             if (dataSplittedWithNewLine[i].split('COMPUTED FUEL:')[1].split('LBS')[0].length < 10)
        //                 $scope.pasteLnt.computedFuel = dataSplittedWithNewLine[i].split('COMPUTED FUEL:')[1].split('LBS')[0].trim();
        //             else
        //                 $scope.pasteLnt.computedFuel = dataSplittedWithNewLine[i].split('COMPUTED FUEL:')[1].split('Lbs')[0].trim();
        //         }
        //         if (dataSplittedWithNewLine[i].split('COMPUTED FUEL :').length > 1) {
        //             if (dataSplittedWithNewLine[i].split('COMPUTED FUEL :')[1].split('LBS')[0].length < 10)
        //                 $scope.pasteLnt.computedFuel = dataSplittedWithNewLine[i].split('COMPUTED FUEL :')[1].split('LBS')[0].trim();
        //             else
        //                 $scope.pasteLnt.computedFuel = dataSplittedWithNewLine[i].split('COMPUTED FUEL :')[1].split('Lbs')[0].trim();
        //         }
        //         if (dataSplittedWithNewLine[i].split('BLOCK FUEL :').length > 1) {
        //             $scope.pasteLnt.blockFuel = dataSplittedWithNewLine[i].split('BLOCK FUEL :')[1].split('LBS')[0].trim();
        //         }
        //         if (dataSplittedWithNewLine[i].split('LANDING FUEL :').length > 1) {
        //             $scope.pasteLnt.landingFuel = dataSplittedWithNewLine[i].split('LANDING FUEL :')[1].split('LBS')[0].trim();
        //         }
        //         if (dataSplittedWithNewLine[i].split('LANDING FUEL:').length > 1) {
        //             $scope.pasteLnt.landingFuel = dataSplittedWithNewLine[i].split('LANDING FUEL:')[1].split('LBS')[0].trim();
        //         }
        //         if (dataSplittedWithNewLine[i].split('TAKE OFF FUEL :').length > 1) {
        //             $scope.pasteLnt.takeOffFuel = dataSplittedWithNewLine[i].split('TAKE OFF FUEL :')[1].split('LBS')[0].trim();
        //         }
        //          if (dataSplittedWithNewLine[i].split('TAKE OFF FUEL:').length > 1) {
        //             $scope.pasteLnt.takeOffFuel = dataSplittedWithNewLine[i].split('TAKE OFF FUEL:')[1].split('LBS')[0].trim();
        //         }
        //         if (dataSplittedWithNewLine[i].split('MIN. TRIP FUEL:').length > 1) {
        //             $scope.pasteLnt.minFuel = dataSplittedWithNewLine[i].split('MIN. TRIP FUEL:')[1].split('LBS')[0].trim();
        //         }
        //         if (dataSplittedWithNewLine[i].split('MAX. TRIP FUEL:').length > 1) {
        //             $scope.pasteLnt.maxFuel = dataSplittedWithNewLine[i].split('MAX. TRIP FUEL:')[1].split('LBS')[0].trim();
        //         }
        //     }
        // }
        function readPilotInfo() {
            var dataSplittedWithNewLine = $scope.pasteLnt.text.split('\n');
            for (var i = 0; i < dataSplittedWithNewLine.length; i++) {
                if (dataSplittedWithNewLine[i].split('PIC: ').length > 1) {
                    $scope.pasteLnt.pilot = dataSplittedWithNewLine[i].split('PIC: ')[1].split('FO:')[0].trim();
                    $scope.pasteLnt.co_pilot = dataSplittedWithNewLine[i].split('PIC: ')[1].split('FO:')[1].trim();
                }
            }
        }

        function readPaxTascruise() {
            if ($scope.pasteLnt.text.split('P.O.B.:')[1]) {
                $scope.pasteLnt.pax = $scope.pasteLnt.text.split('P.O.B.:')[1].split('PAX')[0].trim();
            } else if ($scope.pasteLnt.text.split('PAX :')[1]) {
                if ($scope.pasteLnt.text.split('PAX :')[1].split(' ')[1] != "") {
                    $scope.pasteLnt.pax = $scope.pasteLnt.text.split('PAX :')[1].split(' ')[1].trim();
                } else {
                    $scope.pasteLnt.pax = $scope.pasteLnt.text.split('PAX :')[1].split(' ')[2].trim();
                }
                $scope.pasteLnt.pax = parseInt($scope.pasteLnt.pax);

            } else if ($scope.pasteLnt.text.split('PAX:')[1]) {
                $scope.pasteLnt.pax = $scope.pasteLnt.text.split('PAX:')[1].split(' ')[1].trim();
            } else {
                console.log('pax not found');
            }
        }

        function readDateAndTime() {
            var dateSplitWithTagpasteLnt = $scope.pasteLnt.text.split(' NAV LOG');
            if (dateSplitWithTagpasteLnt.length == 1) {
                alert('Date Format Error');
                return;
            }
            var flightDate = dateSplitWithTagpasteLnt[0].substring(dateSplitWithTagpasteLnt[0].length - 7, dateSplitWithTagpasteLnt[0].length)
            $scope.pasteLnt.date_of_flight = moment(flightDate, 'DDMMMYY').format('YYMMDD');
        	/* ETD */ 
            $scope.pasteLnt.dep_time = dateSplitWithTagpasteLnt[1].split('ETD')[1].split('Z')[0].split(':').join('').trim();
            if($scope.pasteLnt.dep_time.length==3){
            	$scope.pasteLnt.dep_time='0'+$scope.pasteLnt.dep_time;
            }
        }

        function readLoad() {
            $scope.pasteLnt.tripArr = [];
            var dataSplittedWithNewLine = $scope.pasteLnt.text.split('\n');
            for (var i = 0; i < dataSplittedWithNewLine.length; i++) {

                if (dataSplittedWithNewLine[i].split('LOAD').length > 1) {
                    $scope.pasteLnt.load_wt = dataSplittedWithNewLine[i].split('LOAD')[1].replace(':', '').trim();
                    if ($scope.pasteLnt.callsign == "VTAVS") {

                        $scope.pasteLnt.aft_baggage_compt_weight = $scope.pasteLnt.load_wt - ($scope.pasteLnt.pax * 165) - 25;
                    } else if ($scope.pasteLnt.callsign == "VTAUV") {

                        $scope.pasteLnt.aft_baggage_compt_weight = $scope.pasteLnt.load_wt - ($scope.pasteLnt.pax * 170);
                    } else {

                        $scope.pasteLnt.aft_baggage_compt_weight = $scope.pasteLnt.load_wt - ($scope.pasteLnt.pax * 165);
                    }
                }

                if (dataSplittedWithNewLine[i].split('LAND WT :').length > 1) {
                    $scope.pasteLnt.landWt = parseInt(dataSplittedWithNewLine[i].split('LAND WT :')[1].split('(')[0].trim());
                    $scope.pasteLnt.maxLandWt = parseInt(dataSplittedWithNewLine[i].split('LAND WT :')[1].split('(MAX')[1].replace(')', '').trim());
                } else if (dataSplittedWithNewLine[i].split('LAND WT').length > 1) {
                    $scope.pasteLnt.landWt = parseInt(dataSplittedWithNewLine[i].split('LAND WT')[1].split('MLW')[0].trim());
                    // $scope.pasteLnt.maxLandWt = parseInt(dataSplittedWithNewLine[i].split('LAND WT :')[1].split('(MAX')[1].replace(')', '').trim());
                }
                if (dataSplittedWithNewLine[i].split('T.OFF WT :').length > 1) {
                    $scope.pasteLnt.takeOffWt = parseInt(dataSplittedWithNewLine[i].split('T.OFF WT :')[1].split('(')[0].trim());
                    $scope.pasteLnt.maxtakeOffWt = parseInt(dataSplittedWithNewLine[i].split('T.OFF WT :')[1].split('(MAX')[1].replace(')', '').trim());
                } else if (dataSplittedWithNewLine[i].split('T.OFF WT').length > 1) {
                    $scope.pasteLnt.takeOffWt = parseInt(dataSplittedWithNewLine[i].split('T.OFF WT')[1].split('MTOW')[0].trim());
                    // $scope.pasteLnt.maxtakeOffWt = parseInt(dataSplittedWithNewLine[i].split('T.OFF WT')[1].split('(MAX')[1].replace(')', '').trim());
                }
                if (dataSplittedWithNewLine[i].split('ZERO FUEL:').length > 1) {
                    $scope.pasteLnt.zero_fuel_wt = parseInt(dataSplittedWithNewLine[i].split('ZERO FUEL:')[1].split('(')[0].trim());
                    $scope.pasteLnt.maxzeroFuelWt = parseInt(dataSplittedWithNewLine[i].split('ZERO FUEL:')[1].split('(MAX')[1].replace(')', '').trim());
                } else if (dataSplittedWithNewLine[i].split('ZERO WT').length > 1) {
                    $scope.pasteLnt.zero_fuel_wt = parseInt(dataSplittedWithNewLine[i].split('ZERO WT')[1].split('MZFW')[0].trim());
                    // $scope.pasteLnt.maxzeroFuelWt = parseInt(dataSplittedWithNewLine[i].split('ZERO FUEL:')[1].split('(MAX')[1].replace(')', '').trim());
                }

            }

        }

        function isValid() {

            if ($scope.pasteLnt.callsign && ($scope.pasteLnt.landWt > $scope.validationCondition[$scope.pasteLnt.callsign].maxLandWt)) {
                return { status: 0, message: 'Landing Weight is exceeding Max Landing Weight' }
            }
            if ($scope.pasteLnt.callsign && ($scope.pasteLnt.takeOffWt > $scope.validationCondition[$scope.pasteLnt.callsign].maxtakeOffWt)) {
                return { status: 0, message: 'T.OFF Weight is exceeding Max T.OFF Weight' }
            }
            if ($scope.pasteLnt.callsign && ($scope.pasteLnt.zero_fuel_wt > $scope.validationCondition[$scope.pasteLnt.callsign].maxzeroFuelWt)) {
                return { status: 0, message: 'ZERO FUEL Weight is exceeding Max ZERO FUEL Weight' }
            }
            if ($scope.pasteLnt.callsign && ($scope.pasteLnt.take_off_fuel > $scope.validationCondition[$scope.pasteLnt.callsign].maxtakeOffFuel)) {
                return { status: 0, message: 'TAKE OFF FUEL  is exceeding Max TAKE OFF FUEL ' }
            }
            if ($scope.pasteLnt.landWt == undefined) {
                return { status: 0, message: 'Landing Weight is missing' };
            }
            return { status: 1 };
        }

        function errorPopover(id, message) {
            $("[data-toggle = 'popover']").popover({
                html: true,
                trigger: "manual"
            });
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
        $scope.next = function() {
            var lntInputValue = angular.copy($scope.pasteLnt.text);
            $scope.pasteLnt = {};
            $scope.pasteLnt.text = lntInputValue;
            if ($scope.pasteLnt.text == undefined) {
                errorPopover("#pasteLntTextArea", "Please don't leave the field empty");
                return;
            }
            if ($scope.pasteLnt.text.split(' NAV LOG').length == 1) {
                errorPopover("#pasteLntTextArea", "Data format error");
                return;
            }
            readCallSign();
            readSourceAndDestination();
            readFuelInfo();
            readPilotInfo();
            readDateAndTime();
            readPaxTascruise();
            readLoad();
            console.log($scope.pasteLnt);

            var validationResponse = isValid();
            if (validationResponse.status == 0) {
                errorPopover("#pasteLntTextArea", validationResponse.message);
                return;
            }
                    closePopover("#pasteLntTextArea");

            $scope.pasteLnt._token = $('meta[name="_token"]').attr('content');
            var req=angular.copy($scope.pasteLnt);
            delete req.text;
            delete req.tripArr;
            delete req.maxzeroFuelWt;
            delete req.maxtakeOffWt;
            delete req.maxLandWt;
            delete req.maxtakeOffFuel;
            console.log(req);
            // return;
            $http({
                    method: 'POST',
                    url: base_url + '/shortfpl/storeloadtrim',
                    data: req
                })
                .success(function(data) {
                    console.log(data);
            		$scope.enableProcess = true;
                })
                // $.redirect(base_url + '/loadtrim/' + $scope.pasteLnt.callsign.toLowerCase(), $scope.pasteLnt);

        };
    })
