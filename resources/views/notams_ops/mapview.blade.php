
@extends('layouts.notam_layout',array('1'=>'1'))
@section('content')
<script src="{{url('/app/js/jquery-1.11.3.min.js')}}" type="text/javascript"></script>  

<style>
    #map {
        width: 100%;
        height: 100%;
    }
    .close_icon{
            font-size: 33px !important;
    color: red;
    right: -8px;
    position: absolute;
    top: -14px;
    }
    #notams{
        /*position: absolute;
        top: 42px;
        margin-top: 0;
        width: 44%;
        background: rgba(255, 255, 255, 0.9);
        left: 30px;
        display: none;*/
        visibility: hidden;
    }
    #notams1{
        /*position: absolute;*/
        /*top: 42px;*/
        margin-top: 0;
        /*width: 44%;*/
        /*background: rgba(255, 255, 255, 0.9);*/
        /*left: 30px;*/
        /*display: none;*/
        /*visibility: hidden;*/
    }
    .info-icon{
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 16px !important;
        /*border: 2px solid #000;*/
        width: 25px;
        height: 25px;
        border-radius: 12px;
        text-align: center;
        padding-top: 2px;
        color: red;
        z-index: 10;
    }
    .qline{
        margin-left: 10px;
        float: right;
        font-size: 13px;
    }
    .notam-number{
        position: relative;
        font-weight: bold;
        padding-left: 0px !important;
    }
    .notam-strip{
        width: 100%;
        margin: 7px 0px;
        padding: 7px 7px;
        /*border: 1px solid #d5d5d5;*/
        float: left;
        border-radius: 5px;
        font-size: 13px;
        font-family: 'pt_sansregular';
        background: #fff;
        margin: 0 !important;
    }
    .desc{
        text-align: justify;
        font-weight: bold;
        font-size: 14px;
        line-height: 1.2;
        margin-top:5px !important;
        white-space: pre-line; 
    }
    .time-strip{
        /*margin-top: 5px !important;*/
    }
</style>


<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8kpfNY_zchycTS1zvLHMgxE3W1N06EkY&callback=initMap">
</script>
<div id="map"></div>
<script type="text/javascript">
    $(function () {
        $('.fa').on('click', function () {
            $('#notams').toggle();

        });
        // console.log();
       
    });


    function initMap() {
        if (document.getElementById('map') == null) {
            // return;
        }
        var cordArr =<?php print_r(json_encode($cords)); ?>;
        console.log(cordArr);
                var blank_map_styles = [{
            "featureType": "all",
            "elementType": "all",
            "stylers": [{
                "visibility": "on"
            }]
        }, {
            "featureType": "all",
            "elementType": "labels",
            "stylers": [{
                "visibility": "off"
            }]
        }, {
            "featureType": "administrative.province",
            "elementType": "all",
            "stylers": [{
                "visibility": "on"
            }]
        }, {
            "featureType": "landscape",
            "elementType": "all",
            "stylers": [{
                "visibility": "on"
            }, {
                "color": "#f8f8f8"
            }]
        }, {
            "featureType": "landscape.man_made",
            "elementType": "all",
            "stylers": [{
                "visibility": "off"
            }]
        }, {
            "featureType": "landscape.natural.landcover",
            "elementType": "all",
            "stylers": [{
                "visibility": "off"
            }]
        }, {
            "featureType": "landscape.natural.terrain",
            "elementType": "all",
            "stylers": [{
                "visibility": "off"
            }]
        }, {
            "featureType": "poi",
            "elementType": "all",
            "stylers": [{
                "visibility": "off"
            }]
        }, {
            "featureType": "road",
            "elementType": "all",
            "stylers": [{
                "visibility": "off"
            }]
        }, {
            "featureType": "transit",
            "elementType": "all",
            "stylers": [{
                "visibility": "on"
            }]
        }, {
            "featureType": "transit.station.airport",
            "elementType": "all",
            "stylers": [{
                "visibility": "on"
            }]
        }, {
            "featureType": "water",
            "elementType": "geometry.fill",
            "stylers": [{
                "color": "#d4e6e6"
            }]
        }];
        // if (cord == undefined)
        //     return;
        // console.log(cordArr)
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: cordArr[0],
            disableDefaultUI: true,
            styles: blank_map_styles,
        });

         var infowindow =  new google.maps.InfoWindow({
          content: document.getElementById("notams").outerHTML.replace('id="notams"','id="notams1"')
        });
        // console.log(typeof document.getElementById("notams").outerHTML);  
         var marker = new google.maps.Marker({
                position: cordArr[0],
                map: map,
                icon:'../media/map-icon.png'
                // draggable:true,
            });
         marker.addListener('click', function() {
            
           
            // infowindow.setContent(document.getElementById("notams").outerHTML);
          infowindow.open(map, marker);
                var buton= document.getElementsByClassName('gm-ui-hover-effect');
            buton[0].innerHTML= '<i class="fa fa-times-circle close_icon"></i>';

        });
         marker.addListener('mouseover', function() {
       
          
            // infowindow.setContent(document.getElementById("notams").outerHTML);
          infowindow.open(map, marker);
           var buton= document.getElementsByClassName('gm-ui-hover-effect');
            buton[0].innerHTML= '<i class="fa fa-times-circle close_icon"></i>';
        });
          marker.addListener('mouseout', function() {
            // infowindow.setContent(document.getElementById("notams").outerHTML);
          // infowindow.close();
        });
         
        for (var i = 0; i < cordArr.length; i++) {
           
            if (i != 0 && cordArr.length>1) {
                var flightPath = new google.maps.Polyline({
                    path: [cordArr[i - 1], cordArr[i]],
                    geodesic: true,
                    strokeColor: 'rgba(255, 0, 255, 0.7)',
                    strokeOpacity: 1.0,
                    strokeWeight: 3
                });
                flightPath.setMap(map);
            } else if(cordArr.length>1) {
                var flightPath = new google.maps.Polyline({
                    path: [cordArr[cordArr.length - 1], cordArr[i]],
                    geodesic: true,
                    strokeColor: 'rgba(255, 0, 255, 0.7)',
                    strokeOpacity: 1.0,
                    strokeWeight: 3
                });
                flightPath.setMap(map);
            }

            // }


        };
        // // for mid point

        // //-- Define radius function
        // if (typeof(Number.prototype.toRad) === "undefined") {
        //     Number.prototype.toRad = function() {
        //         return this * Math.PI / 180;
        //     }
        // }

        // //-- Define degrees function
        // if (typeof(Number.prototype.toDeg) === "undefined") {
        //     Number.prototype.toDeg = function() {
        //         return this * (180 / Math.PI);
        //     }
        // }

        // //-- Define middle point function
        // function middlePoint(cord1, cord2) {
        //     lat1 = cord1.lat;
        //     lng1 = cord1.lng;
        //     lat2 = cord2.lat;
        //     lng2 = cord2.lng;
        //     //-- Longitude difference
        //     var dLng = (lng2 - lng1).toRad();

        //     //-- Convert to radians
        //     lat1 = lat1.toRad();
        //     lat2 = lat2.toRad();
        //     lng1 = lng1.toRad();

        //     var bX = Math.cos(lat2) * Math.cos(dLng);
        //     var bY = Math.cos(lat2) * Math.sin(dLng);
        //     var lat3 = Math.atan2(Math.sin(lat1) + Math.sin(lat2), Math.sqrt((Math.cos(lat1) + bX) * (Math.cos(lat1) + bX) + bY * bY));
        //     var lng3 = lng1 + Math.atan2(bY, Math.cos(lat1) + bX);

        //     //-- Return result
        //     // return [lng3.toDeg(), lat3.toDeg()];
        //     return { lat: lat3.toDeg(), lng: lng3.toDeg(), title: '' };
        // }


        // // end
        // google.maps.Marker.prototype.setLabel = function(label) {
        //     this.label = new MarkerLabel({
        //         map: this.map,
        //         marker: this,
        //         text: label
        //     });
        //     this.label.bindTo('position', this, 'position');
        // };

        // var MarkerLabel = function(options) {

        //     // console.log(options.marker.labeltype);
        //     // setTimeout(function() {
        //     this.setValues(options);
        //     this.span = document.createElement('span');
        //     if (options.marker.labeltype == 'waypoint') {
        //         this.span.className = 'map-marker-label';
        //     } else if (options.marker.labeltype == 'distance') {
        //         this.span.className = 'map-marker-label-waypoint';
        //     } else {
        //         this.span.className = 'map-marker-label-routename';
        //     }
        //     // }, 1);

        // };

        // MarkerLabel.prototype = $.extend(new google.maps.OverlayView(), {
        //     onAdd: function() {
        //         this.getPanes().overlayImage.appendChild(this.span);
        //         var self = this;
        //         this.listeners = [
        //             google.maps.event.addListener(this, 'position_changed', function() {
        //                 self.draw();
        //             })
        //         ];
        //     },
        //     draw: function() {
        //         var text = String(this.get('text'));
        //         var position = this.getProjection().fromLatLngToDivPixel(this.get('position'));
        //         this.span.innerHTML = text;
        //         this.span.style.left = (position.x - (markerSize.x / 2)) - (text.length * 3) + 10 + 'px';
        //         this.span.style.top = (position.y - markerSize.y + 40) + 'px';
        //     }
        // });

        // var waypointArr = [];
        // var labelArr = [];
        // var routeNameArr = [];
        // // console.log(cord);
        // for (var j = 0; j < cord.length; j++) {
        //     for (var i = 1; i < cord[j].length - 1; i++) {

        //         waypointArr[i] = new google.maps.Marker({
        //             position: cord[j][i],
        //             map: map,
        //             labeltype: 'waypoint',
        //             label: cord[j][i].title + '\n' + cord[j][i - 1].distance + ' ' + cord[j][i - 1].radial,
        //             icon: {
        //                 path: google.maps.SymbolPath.CIRCLE,
        //                 scale: 2,
        //                 strokeColor: "rgba(255, 255, 255, 0)",
        //             }
        //         });
        //         labelArr[i] = new google.maps.Marker({
        //             position: middlePoint(cord[j][i - 1], cord[j][i]),
        //             map: map,
        //             labeltype: 'distance',
        //             label: cord[j][i - 1].distance + ' ' + cord[j][i - 1].radial,
        //             icon: {
        //                 path: google.maps.SymbolPath.CIRCLE,
        //                 scale: 2,
        //                 strokeColor: "rgba(255, 255, 255, 0)",
        //             }
        //         });
        //         routeNameArr[i] = new google.maps.Marker({
        //             position: middlePoint(cord[j][i - 1], cord[j][i]),
        //             map: map,
        //             labeltype: 'route',
        //             label: cord[j][i - 1].route,
        //             icon: {
        //                 path: google.maps.SymbolPath.CIRCLE,
        //                 scale: 2,
        //                 strokeColor: "rgba(255, 255, 255, 0)",
        //             }
        //         });

        //         waypointArr[i].setMap(null);
        //         labelArr[i].setMap(null);
        //         routeNameArr[i].setMap(null);
        //     };

        //     var lastIndex = cord[j].length - 1;
        //     labelArr[lastIndex] = new google.maps.Marker({
        //         position: middlePoint(cord[j][lastIndex - 1], cord[j][lastIndex]),
        //         map: map,
        //         labeltype: 'distance',
        //         label: cord[j][i - 1].distance + ' ' + cord[j][i - 1].radial,
        //         fontSize: '50',
        //         icon: {
        //             path: google.maps.SymbolPath.CIRCLE,
        //             scale: 2,
        //             strokeColor: "rgba(255, 255, 255, 0)",
        //         }
        //     });
        //     routeNameArr[lastIndex] = new google.maps.Marker({
        //         position: middlePoint(cord[j][lastIndex - 1], cord[j][lastIndex]),
        //         map: map,
        //         labeltype: 'route',
        //         label: cord[j][i - 1].route,
        //         fontSize: '50',
        //         icon: {
        //             path: google.maps.SymbolPath.CIRCLE,
        //             scale: 2,
        //             strokeColor: "rgba(255, 255, 255, 0)",
        //         }
        //     });

        //     labelArr[lastIndex].setMap(null);
        //     routeNameArr[lastIndex].setMap(null);
        // }
        // var depAirportMarkerLatLng = cord[0][0];
        // var depAirportMarker = new google.maps.Marker({
        //     position: depAirportMarkerLatLng,
        //     map: map,
        //     icon: base_url + '/media/aero_icon_from.png',
        // });
        // var depAirportinfowindowcontent = '<div id="content">' +
        //     '<div id="bodyContent">' +
        //     '' + depAirportMarkerLatLng.title +
        //     '</div>' +
        //     '</div>';
        // var depAirportinfowindow = new google.maps.InfoWindow({
        //     content: depAirportinfowindowcontent
        // });
        // depAirportMarker.addListener('click', function() {
        //     depAirportinfowindow.open(map, depAirportMarker);
        // });
        // // depAirportinfowindow.open(map, depAirportMarker);
        // var arrivalAirportMarkerLatLng = cord[0][cord[0].length - 1];

        // var arrivalAirportMarker = new google.maps.Marker({
        //     position: arrivalAirportMarkerLatLng,
        //     map: map,
        //     icon: base_url + '/media/aero_icon_to.png'

        // });
        // var arrivalAirportinfowindowcontent = '<div id="content">' +
        //     '<div id="bodyContent">' +
        //     '' + arrivalAirportMarkerLatLng.title +
        //     '</div>' +
        //     '</div>';
        // var arrivalAirportinfowindow = new google.maps.InfoWindow({
        //     content: arrivalAirportinfowindowcontent
        // });
        // arrivalAirportMarker.addListener('click', function() {
        //     arrivalAirportinfowindow.open(map, arrivalAirportMarker);
        // });
        // // arrivalAirportinfowindow.open(map, arrivalAirportMarker);
        // if (cord[1]) {

        //     var altnAirportMarkerLatLng = cord[1][cord[1].length - 1];
        //     var altnAirportMarker = new google.maps.Marker({
        //         position: altnAirportMarkerLatLng,
        //         map: map,
        //         icon: base_url + '/media/aero_icon_to.png'
        //     });
        //     var altnAirportinfowindowcontent = '<div id="content">' +
        //         '<div id="bodyContent">' +
        //         '' + altnAirportMarkerLatLng.title +
        //         '</div>' +
        //         '</div>';
        //     var altnAirportinfowindow = new google.maps.InfoWindow({
        //         content: altnAirportinfowindowcontent
        //     });
        //     altnAirportMarker.addListener('click', function() {
        //         altnAirportinfowindow.open(map, altnAirportMarker);
        //     });
        //     // altnAirportinfowindow.open(map, altnAirportMarker);
        // }

        // var flightPlanCoordinates = cord;
        // for (var j = 0; j < flightPlanCoordinates.length; j++) {
        //     for (var i = 1; i < flightPlanCoordinates[j].length; i++) {
        //         if (i == 1) {
        //             if (j == 1) {
        //                 var flightPath = new google.maps.Polyline({
        //                     path: [flightPlanCoordinates[j][i - 1], flightPlanCoordinates[j][i]],
        //                     geodesic: true,
        //                     strokeColor: 'green',
        //                     strokeOpacity: 1.0,
        //                     strokeWeight: 3
        //                 });
        //             } else {
        //                 var flightPath = new google.maps.Polyline({
        //                     path: [flightPlanCoordinates[j][i - 1], flightPlanCoordinates[j][i]],
        //                     geodesic: true,
        //                     strokeColor: 'rgba(255, 0, 255, 0.7)',
        //                     strokeOpacity: 1.0,
        //                     strokeWeight: 3
        //                 });
        //             }

        //             flightPath.setMap(map);
        //         } else {
        //             if (j == 1) {
        //                 var flightPath = new google.maps.Polyline({
        //                     path: [flightPlanCoordinates[j][i - 1], flightPlanCoordinates[j][i]],
        //                     icons: [{
        //                         icon: {
        //                             path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
        //                             strokeColor: '#0000ff',
        //                             scale: 1.5,

        //                         },
        //                         offset: '0%'
        //                     }],
        //                     geodesic: true,
        //                     strokeColor: 'green',
        //                     strokeOpacity: 1.0,
        //                     strokeWeight: 3
        //                 });
        //             } else {
        //                 var flightPath = new google.maps.Polyline({
        //                     path: [flightPlanCoordinates[j][i - 1], flightPlanCoordinates[j][i]],
        //                     icons: [{
        //                         icon: {
        //                             path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
        //                             strokeColor: '#0000ff',
        //                             scale: 1.5,

        //                         },
        //                         offset: '0%'
        //                     }],
        //                     geodesic: true,
        //                     strokeColor: 'rgba(255, 0, 255, 0.7)',
        //                     strokeOpacity: 1.0,
        //                     strokeWeight: 3
        //                 });
        //             }
        //             flightPath.setMap(map);
        //         }

        //     };
        // };


        // google.maps.event.addListener(map, 'zoom_changed', function(e) {
        //     console.log(map.zoom);
        //     $(".map-marker-label").css('visibility', 'hidden');
        //     $(".map-marker-label-waypoint").css('visibility', 'hidden');
        //     for (var j = 0; j < cord.length; j++) {

        //         for (var i = 1; i < cord[j].length - 1; i++) {
        //             if (map.zoom >= 6) {
        //                 setTimeout(function() {
        //                     $(".map-marker-label").map(function() {
        //                         $(this).css('visibility', 'visible');
        //                     })
        //                 }, 1000);
        //                 waypointArr[i].setMap(map);

        //             } else {
        //                 setTimeout(function() {
        //                     $(".map-marker-label").map(function() {
        //                             $(this).css('visibility', 'hidden');
        //                         })
        //                         // $(".map-marker-label-routename").map(function() {
        //                         //     $(this).css('visibility', 'visible');
        //                         // })

        //                 }, 1000);
        //                 waypointArr[i].setMap(null);
        //             }
        //             if (map.zoom > 7) {
        //                 setTimeout(function() {
        //                     // $(".map-marker-label-waypoint").map(function() {
        //                     //     $(this).css('visibility', 'visible');
        //                     // })
        //                     $(".map-marker-label-routename").map(function() {
        //                         // $(this).css('visibility', 'hidden');
        //                         $(this).css('font-size', '10px');

        //                     })
        //                     $(".map-marker-label").map(function() {
        //                         $(this).css('font-size', '10px');
        //                     })

        //                 }, 1000);
        //                 labelArr[i].setMap(map);
        //                 labelArr[cord[j].length - 1].setMap(map);
        //             } else {
        //                 setTimeout(function() {
        //                     // $(".map-marker-label-waypoint").map(function() {
        //                     //     $(this).css('visibility', 'hidden');
        //                     // })
        //                     $(".map-marker-label-routename").map(function() {
        //                         $(this).css('visibility', 'visible');
        //                     })
        //                 }, 1000);
        //                 labelArr[i].setMap(null);
        //                 labelArr[cord[j].length - 1].setMap(null);

        //             }
        //             if (map.zoom <= 5) {
        //                 setTimeout(function() {
        //                     $(".map-marker-label-routename").map(function() {
        //                         $(this).css('visibility', 'hidden');
        //                     })
        //                 }, 1000);
        //             }
        //         };
        //     };

        // });
    }
</script>


@foreach ($notams_array as $key)


@if( $key['is_primary']==1)

<div class="notam-strip row" id="notams">


    <div class="col-sm-5 margin-0 p-l-0" >
        <div class="p-l-0 col-sm-2 notam-number">
             <span  class="edit-icon"  ><!-- <i class="fa fa-pencil-square-o" aria-hidden="true"></i> -->{!! $key['aerodrome'] !!} {!! $key['notam_no'] !!} </span>
        </div>
    </div>  
    <div class=" col-sm-7 p-r-0 margin-0 p-l-0 qline-parent">
        <span class="qline">@if($key['decoded_qline']!="NA") CATEGORY: @else CATEGORY: @endif @if($key['decoded_qline']!="NA"){!! $key['decoded_qline'] !!} @else NA @endif </span>
         <!-- <span class="tooltip-rawdata">{!!  $key['raw_data'] !!}</span> -->
    </div>

    <div class=" margin-0 col-sm-12 p-lr-0 desc non-editable"> {!! $key['description'] !!} </div> 
    <div class=" col-sm-12 p-r-0 p-l-0" style="margin-top:5px;    line-height: 1.0;">
        <span class="to-date p-lr-0">  FROM: {!! $key['e_start_date_formatted'] !!}</span> 
        @if($key['e_end_date_formatted']=='31-Dec-9999')
        <span class="to-date p-lr-0">  TO: PERMANENT </span>
        @else
        <span class="to-date p-lr-0">  TO: {!! $key['e_end_date_formatted'] !!}</span>
        @endif
    </div>
    @if($key['raw_time'])
    <div class=" col-sm-12  p-l-0 margin-0 margin-b-5 time-strip raw-time"  >RAW TIME: <span style="display:inline-block;">{!! $key['raw_time'] !!}</span> <i class="fa fa-clock-o" style="cursor: pointer;" aria-hidden="true" ng-click="loadDatePicker($event, '{!! $key['e_start_date_formatted'] !!}', '{!! $key['e_end_date_formatted'] !!}', '{!! $key['notam_no'] !!}', '{!! $key['id'] !!}', '{!! $key['aerodrome
        '] !!}')"></i>
    </div> 
    @if( ($key['is_daily']  || $key['is_weekly']  || $key['is_date_specific'] ))
    hhi
    <div class=" col-sm-12  p-l-0 margin-0 margin-b-5 time-strip formatted-time" > FORMATTED TIME:
        @foreach($key['formatted_time'] as $val)
        <div style="/*    white-space: pre;
display: inline-block;
vertical-align: top*/"> 
            {!! $val['time'] !!}<i class="fa fa-pencil" style="cursor: pointer;" aria-hidden="true" ng-click="loadDatePicker($event, '{!! $key['e_start_date_formatted'] !!}', '{!! $key['e_end_date_formatted'] !!}', '{!! $key['notam_no'] !!}', '{!! $val['notam_id'] !!}', '{!! $key['aerodrome'] !!}', 'edit', '{!! $val['time'] !!}')"></i> 
        </div>
        @endforeach
    </div> 
    @endif 
    @else($key['time'])
    <div class=" col-sm-12  p-l-0 margin-0 margin-b-5 time-strip" style="line-height: 1.3;"> TIME: {!! $key['formatted_time'][0]['time'] !!}  
    </div> 
    @endif

    <div class=" margin-0 margin-b-5 height-strip">
        @if($key['height'])
        <div> HEIGHT: {!! $key['height'] !!} ALTITUDE: {!! $key['level'] !!}</div>  
        @endif  
    </div>
</div>
@endif

@endforeach
