angular.module('eflight', [])
    .controller('pasteLntCtrl', function($scope) {
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
            },
            'VTBSL': {
                maxtakeOffFuel: 6790,
                maxzeroFuelWt: 15100,
                maxtakeOffWt: 20200,
                maxLandWt: 18700
            },
            'VTFIU': {
                maxtakeOffFuel: 1638,
                maxzeroFuelWt: 5670,
                maxtakeOffWt: 6804,
                maxLandWt: 6804
            },
            'VTEPU': {
                maxtakeOffFuel: 1885,
                maxzeroFuelWt: 5590,
                maxtakeOffWt: 5980,
                maxLandWt: 5980
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
                    $scope.pasteLnt.from = dataSplittedWithNewLine[i].split('DEP :')[1].substring(0, 5).trim();
                }
                if (dataSplittedWithNewLine[i].split('DEST:').length > 1) {
                    $scope.pasteLnt.to = dataSplittedWithNewLine[i].split('DEST:')[1].substring(0, 4).trim();
                }
            };
        }


        function readFuelInfo() {
            var dataSplittedWithNewLine = $scope.pasteLnt.text.split('\n');
            console.log('callsign='+$scope.pasteLnt.callsign)
            for (var i = 0; i < dataSplittedWithNewLine.length; i++) {
                if (dataSplittedWithNewLine[i].split('LANDING FUEL :').length > 1) {
                    $scope.pasteLnt.landing_fuel = parseInt(dataSplittedWithNewLine[i].split('LANDING FUEL :')[1].split('LBS')[0].trim());
                }
                if (dataSplittedWithNewLine[i].split('LANDING FUEL:').length > 1) {
                    $scope.pasteLnt.landing_fuel = parseInt(dataSplittedWithNewLine[i].split('LANDING FUEL:')[1].split('LBS')[0].trim());
                }

                //if (dataSplittedWithNewLine[i].split('TAKE OFF FUEL :').length > 1) {
              //      $scope.pasteLnt.take_off_fuel = parseInt(dataSplittedWithNewLine[i].split('TAKE OFF FUEL :')[1].split('LBS')[0].trim());
              //  }
                if($scope.pasteLnt.callsign=="VTBSL"){
                  if (dataSplittedWithNewLine[i].split('TAKE OFF FUEL :').length > 1) {
                    $scope.pasteLnt.take_off_fuel = parseInt(dataSplittedWithNewLine[i].split('TAKE OFF FUEL :')[1].split('LBS')[0].trim())+200;
                  }
                  if (dataSplittedWithNewLine[i].split('TAKE OFF FUEL:').length > 1) {
                    $scope.pasteLnt.take_off_fuel = parseInt(dataSplittedWithNewLine[i].split('TAKE OFF FUEL:')[1].split('LBS')[0].trim())+200;
                  }
                }
                else if($scope.pasteLnt.callsign=="VTFIU"){
                  if (dataSplittedWithNewLine[i].split('TAKE OFF FUEL :').length > 1) {
                    $scope.pasteLnt.take_off_fuel = parseInt(dataSplittedWithNewLine[i].split('TAKE OFF FUEL :')[1].split('LBS')[0].trim())+45;
                  }
                  if (dataSplittedWithNewLine[i].split('TAKE OFF FUEL:').length > 1) {
                    $scope.pasteLnt.take_off_fuel = parseInt(dataSplittedWithNewLine[i].split('TAKE OFF FUEL:')[1].split('LBS')[0].trim())+45;
                  }
                }
                else if($scope.pasteLnt.callsign=="VTEPU"){
                  if (dataSplittedWithNewLine[i].split('TAKE OFF FUEL :').length > 1) {
                    $scope.pasteLnt.take_off_fuel = parseInt(dataSplittedWithNewLine[i].split('TAKE OFF FUEL :')[1].split('LBS')[0].trim())+30;
                  }
                  if (dataSplittedWithNewLine[i].split('TAKE OFF FUEL:').length > 1) {
                    $scope.pasteLnt.take_off_fuel = parseInt(dataSplittedWithNewLine[i].split('TAKE OFF FUEL:')[1].split('LBS')[0].trim())+30;
                  }
                }
                else{
                    if (dataSplittedWithNewLine[i].split('TAKE OFF FUEL :').length > 1) {
                         $scope.pasteLnt.take_off_fuel = parseInt(dataSplittedWithNewLine[i].split('TAKE OFF FUEL :')[1].split('LBS')[0].trim());
                    }
                    if (dataSplittedWithNewLine[i].split('TAKE OFF FUEL:').length > 1) {
                         $scope.pasteLnt.take_off_fuel = parseInt(dataSplittedWithNewLine[i].split('TAKE OFF FUEL:')[1].split('LBS')[0].trim());
                  }
               }
                if (dataSplittedWithNewLine[i].split('BLOCK FUEL :').length > 1) {
                    $scope.pasteLnt.block_fuel = dataSplittedWithNewLine[i].split('BLOCK FUEL :')[1].split('LBS')[0].trim();
                }
                if (dataSplittedWithNewLine[i].split('BLOCK FUEL:').length > 1) {
                    $scope.pasteLnt.block_fuel = dataSplittedWithNewLine[i].split('BLOCK FUEL:')[1].split('LBS')[0].trim();
                }
                if (dataSplittedWithNewLine[i].split('TRIP :').length > 1) {                 
                    $scope.pasteLnt.trip_fuel = dataSplittedWithNewLine[i].substring(12,17);
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
                $scope.pasteLnt.paxs = $scope.pasteLnt.text.split('P.O.B.:')[1].split('PAX')[0].trim();
            } else if ($scope.pasteLnt.text.split('PAX :')[1]) {
                if ($scope.pasteLnt.text.split('PAX :')[1].split(' ')[1] != "") {
                    $scope.pasteLnt.paxs = $scope.pasteLnt.text.split('PAX :')[1].split(' ')[1].trim();
                } else {
                    $scope.pasteLnt.paxs = $scope.pasteLnt.text.split('PAX :')[1].split(' ')[2].trim();
                }
                $scope.pasteLnt.paxs = parseInt($scope.pasteLnt.paxs);

            } else if ($scope.pasteLnt.text.split('PAX:')[1]) {
                $scope.pasteLnt.paxs = $scope.pasteLnt.text.split('PAX:')[1].split(' ')[1].trim();
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
            $scope.pasteLnt.date = moment(flightDate, 'DDMMMYY').format('DD-MMM-YYYY');
        }

        function readLoad() {
            $scope.pasteLnt.tripArr = [];
            var dataSplittedWithNewLine = $scope.pasteLnt.text.split('\n');
            for (var i = 0; i < dataSplittedWithNewLine.length; i++) {

                if (dataSplittedWithNewLine[i].split('LOAD').length > 1) {
                    $scope.pasteLnt.load = dataSplittedWithNewLine[i].split('LOAD')[1].replace(':', '').trim();
                    if ($scope.pasteLnt.callsign == "VTAVS") {
                 
                        $scope.pasteLnt.aft_baggage_compt_weight = $scope.pasteLnt.load - ($scope.pasteLnt.paxs * 165) - 25;
                    } 
                   else if ($scope.pasteLnt.callsign == "VTAUV") {
    
                        $scope.pasteLnt.aft_baggage_compt_weight = $scope.pasteLnt.load - ($scope.pasteLnt.paxs * 170);
                    } 
                    else {
                
                        $scope.pasteLnt.aft_baggage_compt_weight = $scope.pasteLnt.load - ($scope.pasteLnt.paxs * 165);
                    }
                }

                if (dataSplittedWithNewLine[i].split('LAND WT :').length > 1) {
                    $scope.pasteLnt.landWt = parseInt(dataSplittedWithNewLine[i].split('LAND WT :')[1].split('(')[0].trim());
                     if ($scope.pasteLnt.callsign == "VTFIU"||$scope.pasteLnt.callsign == "VTEPU") 
                        $scope.pasteLnt.maxLandWt = $scope.validationCondition[$scope.pasteLnt.callsign].maxLandWt;
                      else  
                     $scope.pasteLnt.maxLandWt = parseInt(dataSplittedWithNewLine[i].split('LAND WT :')[1].split('(MAX')[1].replace(')', '').trim());
                } else if (dataSplittedWithNewLine[i].split('LAND WT').length > 1) {
                    $scope.pasteLnt.landWt = parseInt(dataSplittedWithNewLine[i].split('LAND WT')[1].split('MLW')[0].trim());
                    // $scope.pasteLnt.maxLandWt = parseInt(dataSplittedWithNewLine[i].split('LAND WT :')[1].split('(MAX')[1].replace(')', '').trim());
                }
                if (dataSplittedWithNewLine[i].split('T.OFF WT :').length > 1) {
                    $scope.pasteLnt.takeOffWt = parseInt(dataSplittedWithNewLine[i].split('T.OFF WT :')[1].split('(')[0].trim());
                    $scope.pasteLnt.maxtakeOffWt = parseInt(dataSplittedWithNewLine[i].split('T.OFF WT :')[1].split('(MAX')[1].replace(')', '').trim());
                } 
                else if (dataSplittedWithNewLine[i].split('T.OFF WT').length > 1) 
                {
                     if ($scope.pasteLnt.callsign == "VTFIU") 
                        $scope.pasteLnt.takeOffWt = parseInt(dataSplittedWithNewLine[i].split('T.OFF WT:')[1].split('MTOW')[0].trim());
                     else   
                        $scope.pasteLnt.takeOffWt = parseInt(dataSplittedWithNewLine[i].split('T.OFF WT')[1].split('MTOW')[0].trim());
                    // $scope.pasteLnt.maxtakeOffWt = parseInt(dataSplittedWithNewLine[i].split('T.OFF WT')[1].split('(MAX')[1].replace(')', '').trim());

                }
               
                if (dataSplittedWithNewLine[i].split('ZERO FUEL:').length > 1) {
                    $scope.pasteLnt.zeroFuelWt = parseInt(dataSplittedWithNewLine[i].split('ZERO FUEL:')[1].split('(')[0].trim());
                    $scope.pasteLnt.maxzeroFuelWt = parseInt(dataSplittedWithNewLine[i].split('ZERO FUEL:')[1].split('(MAX')[1].replace(')', '').trim());
                } else if (dataSplittedWithNewLine[i].split('ZERO WT').length > 1) {
                    if ($scope.pasteLnt.callsign == "VTFIU"||$scope.pasteLnt.callsign == "VTEPU") 
                        $scope.pasteLnt.zeroFuelWt = parseInt(dataSplittedWithNewLine[i].split('ZERO WT :')[1].split('MZFW')[0].trim());
                    else
                       $scope.pasteLnt.zeroFuelWt = parseInt(dataSplittedWithNewLine[i].split('ZERO WT')[1].split('MZFW')[0].trim());
                    // $scope.pasteLnt.maxzeroFuelWt = parseInt(dataSplittedWithNewLine[i].split('ZERO FUEL:')[1].split('(MAX')[1].replace(')', '').trim());
                    console.log($scope.pasteLnt.zeroFuelWt);
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
            if ($scope.pasteLnt.callsign && ($scope.pasteLnt.zeroFuelWt > $scope.validationCondition[$scope.pasteLnt.callsign].maxzeroFuelWt)) {
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
        $scope.process = function() {
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
    

            var validationResponse = isValid();
            if (validationResponse.status == 0) {
                errorPopover("#pasteLntTextArea", validationResponse.message);
                return;
            }
            $scope.pasteLnt._token = $('meta[name="_token"]').attr('content');
            if($scope.pasteLnt.callsign=='VTBSL')
              $.redirect(base_url + '/loadtrim/' + $scope.pasteLnt.callsign.toLowerCase()+'_new', $scope.pasteLnt);  
            else 
            $.redirect(base_url + '/loadtrim/' + $scope.pasteLnt.callsign.toLowerCase(), $scope.pasteLnt);

        };
    });
