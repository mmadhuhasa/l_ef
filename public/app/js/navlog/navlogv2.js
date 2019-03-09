angular.module('navlog', [], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
})
    .directive('fileModel', ['$parse', function ($parse) {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                element.bind('change', function () {
                    $parse(attrs.fileModel).assign(scope, element[0].files)
                    scope.$apply();
                });
            }
        };
    }])

    .controller('navlogv2Ctrl', function ($scope, $http, $q) {
        $scope.navlogv2 = {};
        $scope.navlogv2Altn = {};
        $scope.disableMinMax = true;
        $scope.submitNavlog = false;
        $scope.submitBasicFields = false;

        $("[data-toggle = 'popover']").popover({
            html: true,
            trigger: "hover"
        });
        $('#shortfpl').on('keypress', function (e) {
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
        $scope.onPaste = function () {
            $scope.disableMinMax = false;

        }
        $('#navlog').bind('paste', function (e) {

            $scope.$digest();
        });
        $('#altnnavlog').bind('paste', function (e) {

        });

        function closePopover() {
            $('#shortfpl').popover('destroy');
            $('#shortfpl').css("border", "none");
        }
        function findAttribute(lineArr, key, cb, numeric) {
            lineArr.map(function (data) {
                if (data.toLowerCase().indexOf(key) != -1) {
                    var result = data.toLowerCase().replace(key, '').replace('lbs', '');
                    if (numeric) {
                        result = result.match(/\d+/g).map(Number);
                    }
                    cb(result);
                }
            })
        }
        $scope.export = function () {
            html2canvas(document.getElementById('exportthis'), {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 510,
                        }]
                    };
                    // pdfMake.createPdf(docDefinition).download("test.pdf");
                }
            });
        }
        $scope.next = function () {
            $("[data-toggle = 'popover']").popover({
                html: true,
                trigger: "hover"
            });
            if (!$scope.navlogv2.callsign_real || ($scope.navlogv2.callsign_real && $scope.navlogv2.callsign_real.length != 5)) {

                $("#aircraft_callsign2").attr('data-content', 'ICAO Codes only, use ZZZZ if no Code allocated for Destination Station (Min. & Max. 4 Alphabets)');
                $("#aircraft_callsign2").css("border", "red solid 1px");
                return;
            }
            else {
                $("#aircraft_callsign2").css("border", "1px solid #555");

            }
            if (!$scope.navlogv2.pilot) {
                $("#pilot").attr('data-content', 'Pilot name mandatory');
                $("#pilot").css("border", "red solid 1px");
                return;
            }
            else {
                $("#pilot").css("border", "1px solid #555");

            }
            if (!$scope.navlogv2.copilot) {
                $("#copilot").attr('data-content', 'Co Pilot name mandatory');
                $("#copilot").css("border", "red solid 1px");
                return;
            }
            else {
                $("#copilot").css("border", "1px solid #555");

            }
            if (!$scope.navlogv2.pilot_mobile) {
                $("#pilot_mobile").attr('data-content', 'Pilot mobile number mandatory');
                $("#pilot_mobile").css("border", "red solid 1px");
                return;
            }
            else {
                $("#pilot_mobile").css("border", "1px solid #555");

            }
            if (!$scope.navlogv2.copilot_mobile) {
                $("#copilot_mobile").attr('data-content', 'Co pilot mobile number mandatory');
                $("#copilot_mobile").css("border", "red solid 1px");
                return;
            }
            else {
                $("#copilot_mobile").css("border", "1px solid #555");

            }

            $scope.submitBasicFields = true;

        }
        $scope.filePlan = function () {
            console.log($scope.navlogv2);
            var data = {
                aircraft_callsign: $scope.navlogv2.callsign_real,
                departure_aerodrome: $scope.navlogv2.depAerodrome,
                destination_aerodrome: $scope.atcFpl.dest,
                departure_time_hours: $scope.navlogv2.etd.substring(0, 2),
                departure_time_minutes: $scope.navlogv2.etd.substring(2, 4),
                pilot_in_command: $scope.navlogv2.pilot,
                mobile_number: $scope.navlogv2.pilot_mobile,
                copilot: $scope.navlogv2.copilot,
                cabincrew: '',
                date_of_flight: $scope.atcFpl.dof,
                email: $('#email').val()
                // departure_station departure_station
                // departure_latlong departure_latlong
                // destination_station destination_station
                // destination_latlong destination_latlong
            }
            delete $scope.navlogv2.text;
            delete $scope.navlogv2Altn.text;
            var navlogRecords = {
                callsign: $scope.navlogv2.callsign_real,
                navlog_ext_data: $scope.navlogv2,
                navlog_ext_data_altn: $scope.navlogv2Altn,
                atc_fpl_data: $scope.atcFpl,
                pilot: $scope.navlogv2.pilot,
                copilot: $scope.navlogv2.copilot,
                pilot_mobile: $scope.navlogv2.pilot_mobile,
                copilot_mobile: $scope.navlogv2.copilot_mobile
            }
            var base_url = window.location.origin;
            console.log(navlogRecords);
            // return;
            $http({
                method: 'POST',
                url: base_url + '/api/fpl/process_quick_plan',
                data: data
            })
                .then(function (sucess) {
                    console.log(sucess)
                    var filingData = sucess.data.DATA;
                    filingData.user_mobile = $('#user_mobile').val();
                    filingData.email = $('#email').val();
                    if (sucess.data.STATUS_DESC == 'Success') {
                        $http({
                            method: 'POST',
                            url: base_url + '/api/fpl/file_the_process',
                            data: filingData
                        })
                            .then(function (sucess) {
                                if (sucess.data.STATUS_DESC == 'Success') {
                                    navlogRecords.fpl_id = 1;
                                    $http({
                                        method: 'POST',
                                        url: base_url + '/navlogv2',
                                        data: navlogRecords
                                    })
                                        .then(function (sucess) {
                                            location.href = '/fpl'
                                        });

                                }
                            });

                    }
                    else if (sucess.data.STATUS_DESC == 'Plan does not exist') {
                        var filingData = sucess.data.DATA;
                        filingData.user_mobile = $('#user_mobile').val();
                        filingData.email = $('#email').val();
                        filingData.flight_level = $scope.navlogv2.fLevel[0];
                        filingData.total_flying_hours = $scope.navlogv2.tripTime.split(':')[0];
                        filingData.total_flying_minutes = $scope.navlogv2.tripTime.split(':')[1];
                        filingData.endurance_hours = $scope.atcFpl.endurance.substring(2, 4);
                        filingData.endurance_minutes = $scope.atcFpl.endurance.substring(2, 4);
                        filingData.route = $scope.navlogv2.route;
                        filingData.first_alternate_aerodrome = $scope.navlogv2.altnAirport.trim();
                        filingData.fir_crossing_time = $scope.atcFpl.fir;

                        $http({
                            method: 'POST',
                            url: base_url + '/api/fpl/file_the_process',
                            data: filingData
                        })
                            .then(function (sucess) {
                                if (sucess.data.STATUS_DESC == 'Success') {
                                    navlogRecords.fpl_id = 1;
                                    $http({
                                        method: 'POST',
                                        url: base_url + '/navlogv2',
                                        data: navlogRecords
                                    })
                                        .then(function (sucess) {
                                            location.href = '/fpl'
                                        });

                                }
                            });
                    }
                })
        }
        $scope.final = function () {
            $scope.submitNavlog = true;
            $scope.navlogv2.callsign = $scope.navlogv2.callsign_real;
            $scope.navlogv2.etd_hr = $scope.navlogv2.etd.substring(0, 2);
            $scope.navlogv2.etd_mins = $scope.navlogv2.etd.substring(2, 4);
            var altnDataLineArr = $scope.navlogv2Altn.text.split('\n');
            $scope.navlogv2.altnRoute = altnDataLineArr[8];
            var capture = -1;
            $scope.navlogv2Altn.routeArr = [];


            // 

            $scope.navlogv2.takeOffWeight = 40600;
            $scope.navlogv2.landingWeight = 34150;
            $scope.navlogv2.zeroFuelWeight = 28200;
            $scope.navlogv2.basicWeight = 24630;
            // $scope.navlogv2.takeOffWeight =  40600;
            console.log($scope.navlogv2);
            console.log($scope.navlogv2Altn);
            // 
            altnDataLineArr.map(function (data) {
                if (data.toLowerCase().indexOf('winds') != -1) {
                    capture = 0;
                    routeMappingAltn();
                }
                if (data.toLowerCase().indexOf('waypoint') != -1 && capture == -1) {
                    capture = 1;
                }
                if (capture == 1) {
                    $scope.navlogv2Altn.routeArr.push(data);
                }

            })
           
            findAttribute(altnDataLineArr, 'ete', function (res) {
                $scope.navlogv2Altn.ete = res.replace('\t', '').replace('h', ':').replace('m', '');
                var destTime = moment($scope.navlogv2Altn.ete, 'HH:mm');
                var destTimeMins = (destTime.hour() * 60) + destTime.minute();
                $scope.navlogv2.tripTimeMoment.add(destTimeMins, 'minutes');
                $scope.navlogv2.totalTime = $scope.navlogv2.tripTimeMoment.format('HH:mm');
                if (altnDataLineArr[4].indexOf('head') != -1) {
                    var distance_wind = altnDataLineArr[4].split('head')[0].replace($scope.navlogv2Altn.ete.trim(), '');
                }
                else {
                    var distance_wind = altnDataLineArr[4].split('tail')[0].replace($scope.navlogv2Altn.ete.trim(), '');
                }
                // console.log(distance_wind);
                // console.log(distance_wind.split('nm'));
                if(distance_wind.split('nm')[0].split('\t')[1]){
                    $scope.navlogv2Altn.distance = distance_wind.split('nm')[0].split('\t')[1].replace(/[^\d]/g, '') + ' nm';
                }
                else{
                    $scope.navlogv2Altn.distance = distance_wind.split('nm')[0].replace('\t', '').replace(/[^\d]/g, '') + ' nm';
                }
            })
        }

        $scope.process = function () {
            $scope.atcFpl = {};
            console.log($scope.navlogv2);
            $scope.enableALtn = true;

            var lineArr = $scope.navlogv2.text.split('\n');
            console.log(lineArr);
            // console.log();
            // if(lineArr[0].indexOf())
            if (lineArr[2].indexOf('Created') != -1) {
                lineArr.splice(2, 1);
            }
            $scope.navlogv2.date_of_flight = moment(lineArr[0].split('(')[1].split(')')[0], 'MMM DD, YYYY').format('DD-MMM-YYYY');
            $scope.navlogv2.depAerodrome = lineArr[0].split('—')[0].trim();
            $scope.navlogv2.destAerodrome = lineArr[0].split('—')[1].split('(')[0];
            $scope.navlogv2.callsign = 'VT' + lineArr[0].split('VT')[1].split(' ')[0];

            // $scope.navlogv2.ete = lineArr[3].split(' ')[0].replace('h','hrs ').replace('m','mins ');
            // lineArr[3] = removeEmptyString(lineArr[3]);
            // $scope.navlogv2.distance = lineArr[3].split(' ')[1];
            // console.log(lineArr[3]);
            // $scope.navlogv2.avgWind = lineArr[3].split(' ')[2]+' '+lineArr[3].split(' ')[3];
            // $scope.navlogv2.etd = lineArr[3].split(' ')[4].replace('Z',' UTC');
            // $scope.navlogv2.eta = lineArr[3].split(' ')[5].replace('Z',' UTC');
            // $scope.navlogv2.tow = lineArr[3].split(' ')[6]+' '+lineArr[3].split(' ')[7].replace('lbs','');
            // $scope.navlogv2.elw = lineArr[3].split(' ')[8]+' '+lineArr[3].split(' ')[9].replace('lbs','');

            // $scope.navlogv2.blockFuel = lineArr[5].split(' ')[0]+' '+lineArr[5].split(' ')[1].replace('lbs','');
            // $scope.navlogv2.taxiFuel = lineArr[5].split(' ')[2]+' '+lineArr[5].split(' ')[3].replace('lbs','');
            // $scope.navlogv2.flightFuel = lineArr[5].split(' ')[4]+' '+lineArr[5].split(' ')[5];
            // $scope.navlogv2.reserveFuel = lineArr[5].split(' ')[6]+' '+lineArr[5].split(' ')[7];
            // $scope.navlogv2.altnFuel = lineArr[5].split(' ')[8]+' '+lineArr[5].split(' ')[9];
            // $scope.navlogv2.extraFuel = lineArr[5].split(' ')[10]+' '+lineArr[5].split(' ')[11];            
            var fuelArr = lineArr[5].split('lbs');
            $scope.navlogv2.landingFuel = fuelArr[fuelArr.length - 2];

            $scope.navlogv2.route = lineArr[7];

            findAttribute(lineArr, 'payload', function (res) {
                $scope.navlogv2.load = res;
            });
            findAttribute(lineArr, 'zfw', function (res) {
                $scope.navlogv2.zfw = res;
            });
            findAttribute(lineArr, 'ete', function (res) {
                $scope.navlogv2.ete = res.replace('\t', '').replace('h', 'hr').replace('m', 'mins');
                if ($scope.navlogv2.ete.split('h').length == 2) {
                    $scope.navlogv2.tripTime = $scope.navlogv2.ete.split('hr')[0] + ':' + $scope.navlogv2.ete.split('hr')[1].split('mins')[0];
                    var tripTime = moment($scope.navlogv2.tripTime, 'HH:mm');
                    setTimeout(function () {
                        var extraTime = moment($scope.navlogv2.extraTime, 'HH:mm');
                        var extraTimeMins = (extraTime.hour() * 60) + extraTime.minute();
                        tripTime.add(extraTimeMins, 'minutes');
                        tripTime.add(10, 'minutes');
                        tripTime.add(5, 'minutes');
                        tripTime.add(30, 'minutes');
                        $scope.navlogv2.tripTimeMoment = tripTime;
                        $scope.navlogv2.totalTime = tripTime.format('HH:mm');
                        $scope.atcFpl.endurance = tripTime.format('HHmm');
                        console.log(tripTime.format('HH:mm'));
                        $scope.$digest();
                        // console.log(extraTime.add(tripTime,'HH:mm').format('HH:mm'));
                    }, 2000)

                    if (lineArr[3].indexOf('head') != -1) {
                        var distance_wind = lineArr[3].split('head')[0].replace($scope.navlogv2.ete.trim(), '');
                    }
                    else {
                        var distance_wind = lineArr[3].split('tail')[0].replace($scope.navlogv2.ete.trim(), '');
                    }
                    // console.log(distance_wind);
                    // console.log(distance_wind.split('nm'));
                    if(distance_wind.split('nm')[0].split('\t')[1]){
                        $scope.navlogv2.distance = distance_wind.split('nm')[0].split('\t')[1].replace(/[^\d]/g, '') + ' nm';
                    }
                    else{
                        $scope.navlogv2.distance = distance_wind.split('nm')[0].replace('\t', '').replace(/[^\d]/g, '') + ' nm';
                    }
                    $scope.navlogv2.avgWind = distance_wind.split('nm')[1] + ' head';
                }
            });
            findAttribute(lineArr, 'eta', function (res) {
                $scope.navlogv2.eta = res.replace('\t', '').replace('z', '');
                $scope.navlogv2.eta = moment($scope.navlogv2.eta, 'HHmm').utcOffset(660).format('HHmm') + ' IST';
            });
            findAttribute(lineArr, 'etd', function (res) {
                $scope.navlogv2.etd = res.replace('\t', '').replace('z', '');;
                $scope.navlogv2.etd_ist = moment($scope.navlogv2.etd, 'HHmm').utcOffset(660).format('HHmm') + ' IST';


            });
            findAttribute(lineArr, 'tow', function (res) {
                $scope.navlogv2.tow = res;
            });
            findAttribute(lineArr, 'elw', function (res) {
                $scope.navlogv2.elw = res;
            });


            // -
            findAttribute(lineArr, 'block fuel', function (res) {
                $scope.navlogv2.blockFuel = res;
            });
            findAttribute(lineArr, 'taxi fuel', function (res) {
                $scope.navlogv2.taxiFuel = res;
            });
            findAttribute(lineArr, 'flight fuel', function (res) {
                $scope.navlogv2.flightFuel = res;
                $scope.navlogv2.tripFuel = parseInt($scope.navlogv2.flightFuel) - parseInt($scope.navlogv2.taxiFuel);
                $scope.navlogv2.contingency = Math.round($scope.navlogv2.tripFuel * 0.05) < 150 ? 150 : Math.round($scope.navlogv2.tripFuel * 0.05);

            });
            findAttribute(lineArr, 'extra fuel', function (res) {
                $scope.navlogv2.extraFuel = res;
                var extraHour = Math.floor(parseInt($scope.navlogv2.extraFuel) / 1181);
                var extraMin = ((parseInt($scope.navlogv2.extraFuel) % 1181) * 60).toString().substr(0, 2);
                $scope.navlogv2.extraTime = moment('0000', 'HHmm').add(parseInt(extraHour) * 60 + parseInt(extraMin), 'minutes').format('HH:mm');
                // $scope.navlogv2.extraTime = Math.floor(parseInt($scope.navlogv2.extraFuel) / 1181) + ':' + ((parseInt($scope.navlogv2.extraFuel) % 1181) * 60).toString().substr(0, 2);

            });
            findAttribute(lineArr, 'alt fuel', function (res) {
                $scope.navlogv2.altnFuel = res;
            }, true);
            findAttribute(lineArr, 'reserve fuel', function (res) {
                $scope.navlogv2.reserveFuel = res;
                $scope.navlogv2.totalFuel = parseInt($scope.navlogv2.taxiFuel) + parseInt($scope.navlogv2.tripFuel) + parseInt($scope.navlogv2.altnFuel) + parseInt($scope.navlogv2.reserveFuel) + parseInt($scope.navlogv2.extraFuel);
            });

            findAttribute(lineArr, 'alt fuel', function (res) {
                $scope.navlogv2.altnAirport = res.split('\t')[0].toUpperCase();
            });

            // route
            captureRoute(lineArr);
            // end
            $scope.navlogv2.tas_ext = lineArr[1].split('Created')[0];
            // $scope.export();
            $scope.generateATCfpl();
        }
        $scope.generateATCfpl = function () {
            $scope.atcFpl.callsign = $scope.navlogv2.callsign_real;
            if ($scope.navlogv2.depAerodrome != 'ZZZZ' && $scope.navlogv2.destAerodrome != 'ZZZZ') {
                $scope.atcFpl.flightRule = 'I';
            }
            else if ($scope.navlogv2.depAerodrome == 'ZZZZ' && $scope.navlogv2.destAerodrome != 'ZZZZ') {
                $scope.atcFpl.flightRule = 'Z';
            }
            else {
                $scope.atcFpl.flightRule = 'Y';
            }
            $scope.atcFpl.depAerodrome = $scope.navlogv2.depAerodrome;
            $scope.atcFpl.speed = $scope.navlogv2.tas[0];
            $scope.atcFpl.fLevel = $scope.navlogv2.fLevel[0];
            $scope.atcFpl.route = $scope.navlogv2.route;
            $scope.atcFpl.altnAirport = $scope.navlogv2.altnAirport;
            $scope.atcFpl.pax = $scope.navlogv2.load / 200;
            $scope.atcFpl.dest = $scope.navlogv2.destAerodrome.replace('\t', '').trim('');
            $scope.atcFpl.ete = $scope.navlogv2.ete.replace('hr', '').replace('mins', '').replace('\t', '').trim('');
            $scope.atcFpl.ete = $scope.atcFpl.ete.length == 3 ? '0' + $scope.atcFpl.ete : $scope.atcFpl.ete;
            $scope.atcFpl.etd = $scope.navlogv2.etd;
            console.log('####', $scope.atcFpl);

            if ($scope.navlogv2.depAerodrome[1] != $scope.navlogv2.destAerodrome[1]) {
                $scope.navlogv2.fir.splice(0, 1);
                $scope.navlogv2.fir.splice(0, 1);
                $scope.atcFpl.fir = $scope.navlogv2.fir.join(' ');

            }
            $scope.atcFpl.dof = moment($scope.navlogv2.date_of_flight, 'DD-MMM-YYYY').format('YYMMDD');

        }
        function removeEmptyString(input) {
            var temp = input.split(' ');
            for (var j = 0; j < temp.length; j++) {
                if (temp[j] == '') {
                    temp.splice(j, 1);
                    j--;
                }
            }
            return temp.join(' ');
        }
        function routeMappingAltn() {
            for (var i = 0; i < $scope.navlogv2Altn.routeArr.length; i++) {
                var temp = $scope.navlogv2Altn.routeArr[i].split(' ');
                for (var j = 0; j < temp.length; j++) {
                    if (temp[j] == '') {
                        temp.splice(j, 1);
                        j--;
                    }
                }
                // $scope.navlogv2Altn.routeArr[i] = temp.join(' ');
            }
            var routeKeys = $scope.navlogv2Altn.routeArr[0].split('\t');
            var formattedRoute = [];
            var prevWaypoint = '';
            var combineWaypoint = false;
            for (var i = 1; i < $scope.navlogv2Altn.routeArr.length; i++) {
                var routeObj = {};
                if (combineWaypoint) {
                    // $scope.navlogv2Altn.routeArr[i] = prevWaypoint +'\n'+$scope.navlogv2Altn.routeArr[i];
                    combineWaypoint = false;
                    var nxtrouteObjArr = $scope.navlogv2Altn.routeArr[i].split('\t');
                    if (nxtrouteObjArr.length != 1) {
                        $scope.navlogv2Altn.routeArr[i] = prevWaypoint + '\t' + $scope.navlogv2Altn.routeArr[i];
                    }
                    else {
                        $scope.navlogv2Altn.routeArr[i] = prevWaypoint + '\n' + $scope.navlogv2Altn.routeArr[i];
                    }
                }
                var routeObjArr = $scope.navlogv2Altn.routeArr[i].split('\t');
                if (routeObjArr.length == 1) {
                    prevWaypoint = routeObjArr[0];
                    combineWaypoint = true;
                    continue;
                }
                for (var j = 0; j < routeObjArr.length; j++) {

                    if (j == 1) {
                        if (isNaN(parseInt(routeObjArr[j]))) {
                            routeObj[routeKeys[j]] = routeObjArr[j];
                        }
                        else {
                            routeObjArr.splice(j, 1);
                            j--;
                        }
                    }
                    else {
                        if (routeObj[routeKeys[j]]) {
                            if (routeObj[routeKeys[j] + "_1"]) {
                                routeObj[routeKeys[j] + "_2"] = routeObjArr[j];

                            }
                            else {
                                routeObj[routeKeys[j] + "_1"] = routeObjArr[j];

                            }

                        }
                        else {
                            routeObj[routeKeys[j]] = routeObjArr[j];
                        }
                    }


                }


                formattedRoute.push(angular.copy(routeObj));
            }
            // console.log(formattedRoute);
            $scope.navlogv2Altn.formattedRoute = formattedRoute;
            // $scope.navlogv2Altn.tripTime = formattedRoute[0].ACT;

            var fLevelArr = [];
            var tasArr = [];
            $scope.navlogv2Altn.isa = 0;
            var isaCount = 0;
            for (var i = 0; i < formattedRoute.length; i++) {
                var fLevel = formattedRoute[i].ALT;

                if (fLevel && (fLevel.indexOf('fl') != -1 || fLevel.indexOf('FL') != -1)) {
                    fLevel = fLevel.replace('FL', '');
                    fLevel = fLevel.replace('fl', '');
                    if (!isNaN(fLevel)) {
                        fLevelArr.push(parseInt(fLevel));
                        tasArr.push(parseInt(formattedRoute[i].TAS.replace('FL', '')));
                    }
                }

                if (formattedRoute[i].ISA) {
                    isaCount++;
                    $scope.navlogv2Altn.isa = $scope.navlogv2Altn.isa + parseInt(formattedRoute[i].ISA);
                    $scope.navlogv2Altn.isa = $scope.navlogv2Altn.isa / isaCount;
                }

                if (formattedRoute[i].Waypoint == '-TOC-') {
                    var sumLeg = parseInt(formattedRoute[i].LEG) + parseInt(formattedRoute[i - 1].LEG);
                    $scope.navlogv2Altn.climb = sumLeg + ' NM in  ' + formattedRoute[i].REM_2 + ' mins ' + formattedRoute[i].USED + ' Lbs';
                }
                if (formattedRoute[i].Waypoint == '-TOD-') {
                    var diffFuel = formattedRoute[i + 1].USED - formattedRoute[i].USED - 350;
                    $scope.navlogv2Altn.descent = formattedRoute[i].REM + ' NM in  ' + formattedRoute[i].LEG_1 + ' mins ' + diffFuel + ' Lbs';


                }
            }

            $scope.navlogv2Altn.isa = Math.round($scope.navlogv2Altn.isa);
            $scope.navlogv2Altn.fLevel = fLevelArr.sort(function (a, b) {
                return b - a;
            });
            $scope.navlogv2Altn.tas = tasArr.sort(function (a, b) {
                return b - a;
            });
            if ($scope.navlogv2Altn.text.split('FL ' + $scope.navlogv2Altn.fLevel[0] + ' (ISA: ').length == 2) {
                $scope.navlogv2Altn.climbTemp = $scope.navlogv2Altn.text.split('FL ' + $scope.navlogv2Altn.fLevel[0] + ' (ISA: ')[1].split(' ')[0].replace(')', '').replace('FL', '');
            }

        }

        function routeMapping() {
            for (var i = 0; i < $scope.navlogv2.routeArr.length; i++) {
                var temp = $scope.navlogv2.routeArr[i].split(' ');
                for (var j = 0; j < temp.length; j++) {
                    if (temp[j] == '') {
                        temp.splice(j, 1);
                        j--;
                    }
                }
                // $scope.navlogv2.routeArr[i] = temp.join(' ');
            }
            var routeKeys = $scope.navlogv2.routeArr[0].split('\t');
            var formattedRoute = [];
            var prevWaypoint = '';
            var combineWaypoint = false;
            for (var i = 1; i < $scope.navlogv2.routeArr.length; i++) {
                var routeObj = {};
                if (combineWaypoint) {
                    // $scope.navlogv2.routeArr[i] = prevWaypoint +'\n'+$scope.navlogv2.routeArr[i];
                    combineWaypoint = false;
                    var nxtrouteObjArr = $scope.navlogv2.routeArr[i].split('\t');
                    if (nxtrouteObjArr.length != 1) {
                        $scope.navlogv2.routeArr[i] = prevWaypoint + '\t' + $scope.navlogv2.routeArr[i];
                    }
                    else {
                        $scope.navlogv2.routeArr[i] = prevWaypoint + '\n' + $scope.navlogv2.routeArr[i];
                    }
                }
                var routeObjArr = $scope.navlogv2.routeArr[i].split('\t');
                if (routeObjArr.length == 1) {
                    prevWaypoint = routeObjArr[0];
                    combineWaypoint = true;
                    continue;
                }
                for (var j = 0; j < routeObjArr.length; j++) {

                    if (j == 1) {
                        if (isNaN(parseInt(routeObjArr[j]))) {
                            routeObj[routeKeys[j]] = routeObjArr[j];
                        }
                        else {
                            routeObjArr.splice(j, 1);
                            j--;
                        }
                    }
                    else {
                        if (routeObj[routeKeys[j]]) {
                            if (routeObj[routeKeys[j] + "_1"]) {
                                routeObj[routeKeys[j] + "_2"] = routeObjArr[j];

                            }
                            else {
                                routeObj[routeKeys[j] + "_1"] = routeObjArr[j];

                            }

                        }
                        else {
                            routeObj[routeKeys[j]] = routeObjArr[j];
                        }
                    }


                }


                formattedRoute.push(angular.copy(routeObj));
            }
            // console.log(formattedRoute);
            $scope.navlogv2.formattedRoute = formattedRoute;
            // $scope.navlogv2.tripTime = formattedRoute[0].ACT;

            var fLevelArr = [];
            var tasArr = [];
            $scope.navlogv2.isa = 0;
            var isaCount = 0;
            for (var i = 0; i < formattedRoute.length; i++) {
                var fLevel = formattedRoute[i].ALT;

                if (fLevel && (fLevel.indexOf('fl') != -1 || fLevel.indexOf('FL') != -1)) {
                    fLevel = fLevel.replace('FL', '');
                    fLevel = fLevel.replace('fl', '');
                    if (!isNaN(fLevel)) {
                        fLevelArr.push(parseInt(fLevel));
                        tasArr.push(parseInt(formattedRoute[i].TAS.replace('FL', '')));
                    }
                }

                if (formattedRoute[i].ISA) {
                    isaCount++;
                    $scope.navlogv2.isa = $scope.navlogv2.isa + parseInt(formattedRoute[i].ISA);
                    $scope.navlogv2.isa = $scope.navlogv2.isa / isaCount;
                }

                if (formattedRoute[i].Waypoint == '-TOC-') {
                    var sumLeg = parseInt(formattedRoute[i].LEG) + parseInt(formattedRoute[i - 1].LEG);
                    $scope.navlogv2.climb = sumLeg + ' NM in  ' + formattedRoute[i].REM_2 + ' mins ' + formattedRoute[i].USED + ' Lbs';
                }
                if (formattedRoute[i].Waypoint == '-TOD-') {
                    var diffFuel = formattedRoute[i + 1].USED - formattedRoute[i].USED - 350;
                    $scope.navlogv2.descent = formattedRoute[i].REM + ' NM in  ' + formattedRoute[i].LEG_1 + ' mins ' + diffFuel + ' Lbs';


                }
            }

            $scope.navlogv2.isa = Math.round($scope.navlogv2.isa);
            $scope.navlogv2.fLevel = fLevelArr.sort(function (a, b) {
                return b - a;
            });
            $scope.navlogv2.tas = tasArr.sort(function (a, b) {
                return b - a;
            });
            if ($scope.navlogv2.text.split('FL ' + $scope.navlogv2.fLevel[0] + ' (ISA: ').length == 2) {
                $scope.navlogv2.climbTemp = $scope.navlogv2.text.split('FL ' + $scope.navlogv2.fLevel[0] + ' (ISA: ')[1].split(' ')[0].replace(')', '').replace('FL', '');
            }

        }
        function airportListMaping() {
            var airportListObj = {};
            $scope.navlogv2.airportListArr = [];
            airportListKey = $scope.navlogv2.airportArr[0].split('\t');
            $scope.navlogv2.airportArr.map(function (data) {
                var dataSplitted = data.split('\t');
                for (var i = 0; i < dataSplitted.length; i++) {
                    airportListObj[airportListKey[i] || 'default'] = dataSplitted[i];
                }
                $scope.navlogv2.airportListArr.push(angular.copy(airportListObj));
                // console.log(airportListObj)    
            })

        }
        function windListMapping() {
            $scope.navlogv2.windListArr = [];
            windListKey = $scope.navlogv2.windsArr[1].split('\t');
            $scope.navlogv2.avgWindTime = [];

            $scope.navlogv2.windsArr.map(function (data) {
                var windListObj = {};

                var dataSplitted = data.split('\t');
                // console.log("@@@@",data)    
                // console.log("@@@@",dataSplitted)    
                windListObj['airport'] = dataSplitted[0];
                windListObj['wind1'] = dataSplitted[1];
                windListObj['wind2'] = dataSplitted[3];
                windListObj['wind3'] = dataSplitted[5];
                windListObj['wind4'] = dataSplitted[7];
                windListObj['wind5'] = dataSplitted[9];
                windListObj['isa1'] = dataSplitted[2];
                windListObj['isa2'] = dataSplitted[4];
                windListObj['isa3'] = dataSplitted[6];
                windListObj['isa4'] = dataSplitted[8];
                windListObj['isa5'] = dataSplitted[10];
                if (dataSplitted[3] == undefined) {
                    // console.log(dataSplitted)
                    if (dataSplitted[0] && dataSplitted[1]) {
                        var time = dataSplitted[0];
                    }

                    if (dataSplitted[1]) {
                        var time = dataSplitted[0];
                        // console.log('new ',$scope.navlogv2.avgWindTime);
                        //   $scope.navlogv2.avgWindTime[$scope.navlogv2.avgWindTime.length-1].time=time;
                    }

                    // $scope.navlogv2.avgWindTime.push({ time: time, avgWind: dataSplitted[0] })
                    if (dataSplitted[0])
                        $scope.navlogv2.avgWindTime.push(dataSplitted[0].replace('Avg wind comp:', '\n Avg WIND:').replace(',', '\n'));
                    if (dataSplitted[1])
                        $scope.navlogv2.avgWindTime.push(dataSplitted[1].replace('Avg wind comp:', '\n Avg WIND:').replace(',', '\n'));
                    // console.log($scope.navlogv2.avgWindTime);

                }
                // for (var i = 0; i < dataSplitted.length; i++) {
                //     if(windListObj[windListKey[i]]){
                //        windListObj[windListKey[i]||'default'] = dataSplitted[i];
                //     }
                //     else{
                //        windListObj[windListKey[i]||'default'] = dataSplitted[i];
                //     }
                //   }
                $scope.navlogv2.windListArr.push(angular.copy(windListObj));
            })

        }
        function captureRoute(lineArr) {
            var capture = -1;
            var captureAirport = -1;
            var captureWinds = -1;
            var captureFir = -1;
            $scope.navlogv2.routeArr = [];
            $scope.navlogv2.airportArr = [];
            $scope.navlogv2.windsArr = [];
            $scope.navlogv2.fir = [];

            lineArr.map(function (data) {
                if (data.toLowerCase().indexOf('alternate route:') != -1) {
                    capture = 0;
                    routeMapping();
                }
                if (data.toLowerCase().indexOf('waypoint') != -1 && capture == -1) {
                    capture = 1;
                }
                if (data.toLowerCase().indexOf('twr/ctaf') != -1) {
                    captureAirport = 1
                }
                if (data.toLowerCase().indexOf('summary & times') != -1) {
                    captureAirport = 0
                    airportListMaping();
                }
                if (data.toLowerCase().indexOf('winds aloft') != -1) {
                    captureWinds = 1
                }
                if (data.toLowerCase().indexOf('flight information region') != -1) {
                    captureWinds = 0
                    windListMapping();
                }
                if (data.toLowerCase().indexOf('airport') != -1) {
                    captureFir = 0;
                }
                if (captureWinds == 0 && captureFir != 0) {
                    $scope.navlogv2.fir.push(data.split(' ')[0] + '' + data.split(' ')[2].split('\t')[1].replace('0:', '00'));
                }

                if (capture == 1) {
                    $scope.navlogv2.routeArr.push(data);
                }
                if (captureAirport == 1) {
                    $scope.navlogv2.airportArr.push(data);
                }
                if (captureWinds == 1) {
                    $scope.navlogv2.windsArr.push(data);
                }

            })
        }
    })
