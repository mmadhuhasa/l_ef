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
   
    .controller('navlogv2Ctrl', function($scope, $http, $q) {
        $scope.navlogv2 = {};
        $scope.navlogv2.text =`VOBG — VIDP (December 06, 2018) in VTJUI (CL35) 
Mach 0.80
Created Dec 06 2018 0532Z
ETE Distance    Avg Wind    ETD ETA TOW ELW
2h20m   941nm   21kt head (287°/056)    1645Z   1905Z   35100 lbs   30961 lbs
Block Fuel  Taxi Fuel   Flight Fuel Reserve Fuel    Alternate Fuel VIJP Extra Fuel  Landing Fuel            
10000 lbs   350 lbs 4489 lbs    800 lbs 1161 lbs    3550 lbs    5511 lbs        
Route
BIA Q22 HIA
WIND        SPD KT  DIST NM FUEL LB     TIME    
Waypoint    Airway  HDG CRS ALT CMP DIR/SPD ISA TAS GS  LEG REM USED    REM ACT LEG REM ETE ACT
VOBG        -   -   2912    -   098/011 +13 0   0   -   941 350 9650        -   2:20    -   
BIA
BENGALURU 116.8
DCT 018 016 FL163   H5  059/007 +13 297 292 16  925 621 9379        0:03    2:17    0:03    
MOTRI   Q22 010 010 FL338   T4  280/017 +15 383 387 50  875 1059    8941        0:08    2:09    0:11    
LATID   Q22 007 010 FL392   T23 238/034 +8  432 456 27  848 1213    8787        0:03    2:06    0:14    
-TOC-   Q22 007 010 FL430   T9  266/036 -3  427 436 24  824 1332    8668        0:04    2:02    0:18    
VIRAM   Q22 007 010 FL430   H4  282/039 -7  460 456 29  795 1428    8572        0:04    1:58    0:22    
BOSGA   Q22 005 010 FL430   H4  282/043 -7  460 456 51  744 1597    8403        0:06    1:52    0:28    
SAKRO   Q22 004 010 FL430   H5  282/047 -7  461 456 22  722 1668    8332        0:03    1:49    0:31    
HIA
HYDERABAD 113.8
Q22 003 010 FL430   H3  278/053 -6  461 459 40  682 1799    8201        0:05    1:44    0:36    
600-VIDP    DCT 348 355 FL430   H16 278/055 -6  461 445 82  600 2075    7925        0:11    1:33    0:47    
500-VIDP    DCT 347 355 FL430   H21 280/061 -5  463 442 100 500 2414    7586        0:14    1:19    1:01    
400-VIDP    DCT 347 354 FL430   H26 284/066 -4  464 438 100 400 2757    7243        0:14    1:05    1:15    
300-VIDP    DCT 346 354 FL430   H31 288/067 -3  465 433 100 300 3103    6897        0:14    0:51    1:29    
200-VIDP    DCT 346 354 FL430   H36 292/067 -3  464 429 100 200 3450    6550        0:14    0:37    1:43    
100-VIDP    DCT 346 353 FL430   H39 296/067 -3  465 426 100 100 3798    6202        0:14    0:23    1:57    
-TOD-   DCT 341 353 FL430   H37 301/035 +1  431 394 21  79  3887    6113        0:03    0:20    2:00    
VIDP    DCT 341 353 778 H27 299/070 -3  256 229 79  -   4489    5511        0:20    -   2:20    
Alternate Route: DCT
VIDP        341 353 778 H27 299/070 -3  256 229 -   126 -   5511        -   0:26    -   
-TOC-   DCT 214 213 FL220   T2  306/025 +7  301 303 22  104 352 5159        0:05    0:21    0:05    
-TOD-   DCT 214 213 FL220   H6  301/033 +6  426 420 59  45  675 4836        0:08    0:13    0:13    
VIJP    DCT 214 213 1265    T1  307/023 +8  199 200 45  -   1161    4350        0:13    -   0:26    
Winds Aloft FL 360 (ISA: -56°C) FL 380 (ISA: -56°C) FL 400 (ISA: -56°C) FL 430 (ISA: -56°C) FL 450 (ISA: -56°C)
(COMP) WIND ISA (COMP) WIND ISA (COMP) WIND ISA (COMP) WIND ISA (COMP) WIND ISA
BIA (T22) 227/026   +11 (T20) 223/023   +3  (T20) 223/023   +3  (T8) 256/017    -5  (H3) 291/018    -12
MOTRI   (T23) 236/035   +10 (T20) 240/033   +2  (T20) 240/033   +2  (T3) 270/028    -5  (H10) 296/030   -12
LATID   (T23) 236/035   +10 (T20) 240/033   +2  (T20) 240/033   +2  (T4) 270/028    -5  (H10) 296/030   -12
-TOC-   (T24) 243/044   +10 (T18) 251/042   +2  (T18) 251/042   +2  (T1) 276/039    -5  (H14) 296/041   -12
VIRAM   (T25) 243/044   +10 (T18) 251/042   +2  (T18) 251/042   +2  (T1) 275/039    -5  (H13) 295/040   -12
BOSGA   (T25) 248/052   +10 (T16) 257/050   +2  (T16) 257/050   +2  (H0) 276/047    -5  (H13) 292/048   -11
SAKRO   (T18) 256/054   +10 (T12) 262/053   +3  (T12) 262/053   +3  (T1) 275/053    -4  (H9) 285/054    -10
HIA (T18) 256/053   +10 (T12) 262/053   +3  (T12) 262/053   +3  (T1) 275/053    -4  (H9) 285/054    -11
600-VIDP    (H16) 279/052   +10 (H18) 280/056   +4  (H18) 280/056   +4  (H20) 280/060   -3  (H22) 281/063   -9
500-VIDP    (H24) 289/052   +9  (H26) 286/059   +4  (H26) 286/059   +4  (H25) 283/064   -2  (H24) 281/067   -8
400-VIDP    (H32) 297/055   +8  (H32) 294/058   +3  (H32) 294/058   +3  (H31) 289/065   -1  (H30) 285/071   -6
300-VIDP    (H38) 299/062   +7  (H38) 299/062   +3  (H38) 299/062   +3  (H36) 293/067   -2  (H35) 290/069   -6
200-VIDP    (H43) 301/067   +7  (H41) 300/066   +3  (H41) 300/066   +3  (H37) 295/066   -2  (H33) 290/065   -6
100-VIDP    (H54) 303/079   +7  (H53) 304/077   +3  (H53) 304/077   +3  (H46) 300/072   -2  (H40) 297/067   -5
-TOD-   (H54) 303/079   +7  (H53) 304/077   +3  (H53) 304/077   +3  (H46) 300/072   -2  (H40) 297/067   -5
2h14m (-0:06), 4657 lbs 
Avg wind comp: H18  2h16m (-0:04), 4475 lbs 
Avg wind comp: H19  2h17m (-0:03), 4317 lbs 
Avg wind comp: H19  2h20m (-0:01), 4150 lbs 
Avg wind comp: H19  2h22m (+0:02), 4070 lbs 
Avg wind comp: H21
Flight Information Region   EET ENTRY   EXIT    DISTANCE
VOMF - CHENNAI  -   1645Z   1740Z   397nm
VABF - MUMBAI   0:55    1740Z   1825Z   331nm
VIDF - DELHI    1:41    1825Z   1905Z   213nm
Airport WX  TWR/CTAF    CLR GND ELEV    LONGEST RWY
VOBG    128.25  123.5   N/A N/A 2912    09 / 27 10846 ft
VIDP    126.4   125.85  121.95  121.9   778 11 / 29 14534 ft
VIJP    126.6   125.25  N/A N/A 1265    09 / 27 11178 ft
Summary & Times
Tail    VTJUI (CL35)
Profile Mach 0.80
Distance    941nm
ETD 1645Z
ETE 2h20m
ETA 1905Z
Route   BIA Q22 HIA
Fuel & Weights
Block Fuel  10000 lbs
Taxi Fuel   350 lbs
Flight Fuel 4489 lbs
Reserve Fuel    800 lbs
Alt Fuel VIJP   1161 lbs
Extra Fuel  3550 lbs
Payload 800 lbs
ZFW 25450 lbs
TOW 35100 lbs
ELW 30961 lbs
Notes
Out:    In: Block time:
Off:    On: Flight time:
Start:  Stop:   Hobbs time:
Start:  Rem:    Fuel used:`;
        $("[data-toggle = 'popover']").popover({
            html: true,
            trigger: "hover"
        });
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
            // setTimeout(function() {
            //     var regex = new RegExp("^[a-zA-Z0-9/()\b \n\-]+$");
            //     var val = $(e.target).val().replace('\n', '');
            //     if (regex.test(val)) {} else {
            //         errorPopover('SOME FIELDS ARE NOT PASTED CORRECTLY, PLEASE CHECK.');
            //     }
            // }, 1000);

        });

        function closePopover() {
            $('#shortfpl').popover('destroy');
            $('#shortfpl').css("border", "none");
        }
        function findAttribute(lineArr,key,cb,numeric){
            lineArr.map(function(data){
                if(data.toLowerCase().indexOf(key)!=-1){
                    var result = data.toLowerCase().replace(key,'').replace('lbs','');
                    if(numeric){
                        result = result.match(/\d+/g).map(Number);
                    }
                  cb(result);
                }
            })
        }
         $scope.export = function(){
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
   
        $scope.process = function() {
            console.log($scope.navlogv2);
            var lineArr=$scope.navlogv2.text.split('\n');
            console.log(lineArr);
            // console.log();
            // if(lineArr[0].indexOf())
            if(lineArr[2].indexOf('Created')!=-1){
                lineArr.splice(2,1);
            }
            $scope.navlogv2.date_of_flight = moment(lineArr[0].split('(')[1].split(')')[0],'DD MMM , YYYY').format('DD-MMM-YYYY');
            $scope.navlogv2.depAerodrome = lineArr[0].split('—')[0];
            $scope.navlogv2.destAerodrome = lineArr[0].split('—')[1].split('(')[0];
            $scope.navlogv2.callsign = 'VT'+lineArr[0].split('VT')[1].split(' ')[0];
            
            // $scope.navlogv2.ete = lineArr[3].split(' ')[0].replace('h','hrs ').replace('m','mins ');
            // $scope.navlogv2.distance = lineArr[3].split(' ')[1];
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
            $scope.navlogv2.landingFuel = fuelArr[fuelArr.length-2];

            $scope.navlogv2.route = lineArr[7];


            findAttribute(lineArr,'payload',function(res){
                $scope.navlogv2.load = res;
            });
            findAttribute(lineArr,'zfw',function(res){
                $scope.navlogv2.zfw = res;
            });
            findAttribute(lineArr,'ete',function(res){
                $scope.navlogv2.ete = res;
                if($scope.navlogv2.ete.split('h').length==2){
                    $scope.navlogv2.tripTime = $scope.navlogv2.ete.split('h')[0]+':'+$scope.navlogv2.ete.split('h')[1].split('m')[0];
                }
            });
            findAttribute(lineArr,'eta',function(res){
                $scope.navlogv2.eta = res;
            });
            findAttribute(lineArr,'tow',function(res){
                $scope.navlogv2.tow = res;
            });
            findAttribute(lineArr,'elw',function(res){
                $scope.navlogv2.elw = res;
            });


            // -
            findAttribute(lineArr,'block fuel',function(res){
                $scope.navlogv2.blockFuel = res;
            });
            findAttribute(lineArr,'taxi fuel',function(res){
                $scope.navlogv2.taxiFuel = res;
            });
            findAttribute(lineArr,'flight fuel',function(res){
                $scope.navlogv2.flightFuel = res;
                $scope.navlogv2.tripFuel = parseInt($scope.navlogv2.flightFuel)-parseInt($scope.navlogv2.taxiFuel);
                $scope.navlogv2.contingency = Math.round($scope.navlogv2.tripFuel*0.05)<150?150:Math.round($scope.navlogv2.tripFuel*0.05);

            });
            findAttribute(lineArr,'extra fuel',function(res){
                $scope.navlogv2.extraFuel = res;
                $scope.navlogv2.extraTime = Math.floor(parseInt($scope.navlogv2.extraFuel)/1181)+':'+((parseInt($scope.navlogv2.extraFuel)%1181)*60).toString().substr(0,2);

            });
            findAttribute(lineArr,'alt fuel',function(res){
                $scope.navlogv2.altnFuel = res;
            },true);
            findAttribute(lineArr,'reserve fuel',function(res){
                $scope.navlogv2.reserveFuel = res;
                $scope.navlogv2.totalFuel = parseInt($scope.navlogv2.taxiFuel)+parseInt($scope.navlogv2.tripFuel)+parseInt($scope.navlogv2.contingency)+parseInt($scope.navlogv2.altnFuel)+parseInt($scope.navlogv2.reserveFuel)+parseInt($scope.navlogv2.extraFuel);
            });

            // findAttribute(lineArr,'alt fuel',function(res){
            //     $scope.navlogv2.altnFuel = res;
            // });            
            
            // route
                captureRoute(lineArr);
            // end
            $scope.navlogv2.tas_ext= lineArr[1].split('Created')[0];
            $scope.export();
        }
        function routeMapping(){
            console.log("route",$scope.navlogv2.routeArr);
            var routeKeys = $scope.navlogv2.routeArr[0].split(' ');
            var formattedRoute = [];

            for (var i = 1; i < $scope.navlogv2.routeArr.length; i++) {
                var routeObj = {};

                var routeObjArr = $scope.navlogv2.routeArr[i].split(' ');
                for (var j = 0; j < routeObjArr.length; j++) {

                    if(j==1){
                      if(isNaN(parseInt(routeObjArr[j]))){
                        routeObj[routeKeys[j]]=routeObjArr[j];
                      }
                      else{
                        routeObjArr.splice(j,1);
                        j--;
                      }  
                    }
                    else{
                        if(routeObj[routeKeys[j]]){
                            if(routeObj[routeKeys[j]+"_1"]){
                                routeObj[routeKeys[j]+"_2"]=routeObjArr[j];

                            }
                            else{
                                routeObj[routeKeys[j]+"_1"]=routeObjArr[j];

                            }
                            
                        }
                        else{
                          routeObj[routeKeys[j]]=routeObjArr[j];
                        }
                    }

                      
                }

                formattedRoute.push(angular.copy(routeObj));
            }
            console.log(formattedRoute);
            // $scope.navlogv2.tripTime = formattedRoute[0].ACT;

            var fLevelArr=[];
            var tasArr=[];
            $scope.navlogv2.isa=0;
            var isaCount=0;
            for (var i = 0; i < formattedRoute.length; i++) {
                if(formattedRoute[i].ALT){
                    fLevelArr.push(parseInt(formattedRoute[i].ALT.replace('FL','')));
                     tasArr.push(parseInt(formattedRoute[i].TAS.replace('FL','')));
                }
                if(formattedRoute[i].ISA){
                    isaCount++;
                    $scope.navlogv2.isa=$scope.navlogv2.isa+parseInt(formattedRoute[i].ISA);
                    $scope.navlogv2.isa = $scope.navlogv2.isa/isaCount;
                }
                
                if(formattedRoute[i].Waypoint=='-TOC-'){
                    var sumLeg=parseInt(formattedRoute[i].LEG)+parseInt(formattedRoute[i-1].LEG);
                    $scope.navlogv2.climb = sumLeg+' NM in  '+formattedRoute[i].REM_2+' mins '+formattedRoute[i].USED+' Lbs';
                }
                if(formattedRoute[i].Waypoint=='-TOD-'){
                    var diffFuel = formattedRoute[i+1].USED-formattedRoute[i].USED-350;
                    $scope.navlogv2.descent = formattedRoute[i].REM+' NM in  '+formattedRoute[i].LEG_1+' mins '+diffFuel+' Lbs';


                }
            }
            $scope.navlogv2.isa = Math.round($scope.navlogv2.isa);
            $scope.navlogv2.fLevel = fLevelArr.sort(function(a,b){
                return b-a;
            });
            $scope.navlogv2.tas = tasArr.sort(function(a,b){
                return b-a;
            });

        }

        function captureRoute(lineArr){
            var capture = -1;
            $scope.navlogv2.routeArr=[];
            lineArr.map(function(data){
                if(data.toLowerCase().indexOf('alternate route:')!=-1){
                    capture = 0;
                    routeMapping();
                }
                if(data.toLowerCase().indexOf('waypoint')!=-1 && capture==-1){
                    capture=1;
                }
                if(capture == 1){
                    $scope.navlogv2.routeArr.push(data);
                }
                
            })
        }
    })
