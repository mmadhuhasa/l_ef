@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.min.js"></script>
<link rel="stylesheet" href="{{url('media/lr_hrtimeline/css/style.css')}}"> <!-- Resource style -->
<script src="{{url('media/lr_hrtimeline/js/modernizr.js')}}"></script>
<div class="page">
    <style>
        
        .p-t-15{padding-top:15px}
        .cust-container {margin:10px auto;background: #fff;padding: 0;}
        .lr_heading {text-align: center;padding: 7px 0;font-weight: 600;font-size: 15px;color: #fff;
                     background: #a6a6a6;
                     background: -moz-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
                     background: -webkit-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
                     background: -o-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
                     background: -ms-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
                     background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
                     filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6a6a6', endColorstr='#a6a6a6', GradientType=1 );
                     border-radius: 3px 3px 0 0;
        }
        .nav_add_icons{padding-left: 0;}
        .nav_add_icons .fa {color: #f1292b;font-size: 17px;}
        .nav_add_icons img {width: 90%;margin-bottom: 4px;padding-left: 5px;}
        .add_user_icon{text-align: left;padding-left: 10px;}
        .lr_cust_table {margin-top: 10px;}
        .lr_cust_table, .lr_cust_table th, .lr_cust_table td {border: 1px solid #555 !important;}
        .lr_cust_table th {background: #f5f5f5;text-align: center;font-family: inherit;text-transform: uppercase;font-weight: bold;font-size: 13px;color: #000;padding: 5px 0 !important;}
        .lr-expired {color:#ff0000;}
        .lr-expired:hover,.lr-expired:focus {color:#ff0000;}
        .lr-valid {color: #22b14c;}
        .lr-valid:hover, .lr-valid:focus {color: #22b14c;}
        .lr-due {color: #ff7f27;}
        .lr-due:hover, .lr-due:focus {color: #ff7f27;}
        .lr-expired, .lr-valid, .lr-due {font-weight: bold;font-size: 14px;text-transform: capitalize;}
        .red_round, .green_round, .orange_round {width: 16px;height: 16px;border-radius: 50%;display: inline-block;padding-right: 15px;vertical-align: middle;}
        .red_round {background: red;}
        .green_round {background: #22b14c;}
        .orange_round {background: #ff7f27;}
        .slno {width: 6%;}
        .crname{width: 24%;}
        .lictype{width:36%;}
        .days2go{width: 10%;}
        .expdate{width: 10%;}
        .action_icons{width: 13%;}
        .tooltip_rel{position: relative; display: inline;}
        .tooltip_cust {position: absolute;top: -25px;left: 5px;padding: 1px 11px;color: #eee;border-radius: 4px;visibility: hidden;font-size: 10px;text-transform: capitalize;font-weight: normal; box-shadow: 0 0 1px 1px #ccc; background: #333333; z-index: 999999; width: 85px; text-align: center;}
        .tooltip_rel:hover .tooltip_cust{visibility: visible;}
        .sort_icons{float: right;margin-top:-2px;}
        .sort_icons a:hover,.sort_icons a:focus {text-decoration: none;}
        .sort_icons .fa {display: block;padding: 0;margin: 0;font-size: 16px;width: 20px;height: 13px;margin-top: -3px;}
        .sort_icons .fa:hover {color:#f1292b;}
        .expired_font, .valid_font, .due_font{text-align: center;font-weight: bold;font-size: 13px;text-transform: uppercase;}
        .expired_font .fa, .valid_font .fa, .due_font .fa {font-size: 16px;padding: 0 10px;}
        .expired_font,.expired_font a:hover,.expired_font a:focus {color:#ff0000;}
        .valid_font,.valid_font a:hover,.valid_font a:focus{color:#000000;}
        .due_font,.due_font a:hover,.due_font a:focus{color: #555555;}
        .modal-addlicense, .modal-addUser {width:800px;background: #fff;border-radius:6px;}
        .modal-pdfreport, .modal-deleteLicense{width: 400px;background: #fff;border-radius:6px;}
        .form_add_license select.form-control{background-position: 95% 11px;color:#222}
        .form_add_license .ui-datepicker-trigger {width:17px; height:20px;right: 22px;top: 6px;}
        .form_add_license .datepicker {text-align: left;}
        .ui-datepicker{z-index: 9999 !important;}
        .dl_sure_text{text-align: center;text-transform: uppercase;font-weight: bold;font-size: 13px;margin-bottom: 10px;}
        .form_add_license textarea.form-control::-webkit-input-placeholder { /* Chrome/Opera/Safari */
            text-align: left;
        }
        .form_add_license textarea.form-control::-moz-placeholder { /* Firefox 19+ */
            text-align: left;
        }
        .form_add_license textarea.form-control:-ms-input-placeholder { /* IE 10+ */
            text-align: left;
        }
        .form_add_license textarea.form-control:-moz-placeholder { /* Firefox 18- */
            text-align: left;
        }
        /*        Upload button in edit Section*/
        .newbtnv1{line-height: 1;}
        .file {visibility: hidden;position: absolute;}
        .uploadimage1{height: 25px;}
        .browsebtn{padding: 0;height: 25px;}
        /*      End of Upload button in edit Section*/

        /*        Edit Section*/
        .edit_left_caption {font-weight: bold;font-size: 14px;}
        .license_type_font {font-weight: bold;font-size: 14px;}
        /*        End of Edit Section*/

    </style>
    <script>
        angular.module("lrModule", [])
                .controller("lrController", function ($scope) {
                    $scope.expired = true;
                    $scope.valid = false;
                    $scope.due = false;
                    $scope.tabChange = function (status) {
                        if (status == 'expired') {
                            $scope.expired = true;
                            $scope.valid = false;
                            $scope.due = false;
                        } else if (status == 'valid') {
                            $scope.expired = false;
                            $scope.valid = true;
                            $scope.due = false;
                        } else if (status == 'due') {
                            $scope.expired = false;
                            $scope.valid = false;
                            $scope.due = true;
                        }
                    };

                    //History Toggle Button function starts here
                    $scope.historyValue = false;
                    $scope.historyToggle = function () {
                        $scope.historyValue = !$scope.historyValue;
                        $scope.editValue = false;
                    };

                    //Edit Toggle Button function starts here
                    $scope.editValue = false;
                    $scope.editToggle = function () {
                        $scope.editValue = !$scope.editValue;
                        $scope.historyValue = false;
                    };

                    //Update Remarks Section
                    $scope.remarksText = "Enter Some Remarks Text";
                    $scope.remarksTextBox = false;
                    $scope.remarksTextLabel = true;
                    $scope.remarksTextBoxShow = function () {
                        $scope.remarksTextLabel = false;
                        $scope.remarksTextBox = true;
                    };
                    $scope.updateRemarks = function () {
                        $scope.remarksTextLabel = true;
                        $scope.remarksTextBox = false;
                    };

                });

        $(document).ready(function () {
            $('#date1').datepicker();
            $('#date1').datepicker('setDate', 'today');
            $("#date1").datepicker("option", "dateFormat", "yy-mm-dd");
        });

        //Upload file button in edit license section
        $(document).on('click', '.browse', function () {
            var file = $(this).parent().parent().parent().find('.file');
            file.trigger('click');
        });
        $(document).on('change', '.file', function () {
            $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
        });
        //End of Upload file button in edit license section
        
    </script>
    @include('includes.new_header',[])

    <main ng-app="lrModule" ng-controller="lrController">
        <div class="container cust-container">
            <p class="lr_heading">LICENSE REMAINDER</p>
            <div class="row">
                <div class="col-md-4">
                    <div class="col-md-4 p-r-0"><span class="red_round"></span> <a href="#" class="lr-expired" ng-click="tabChange('expired')">Expired (4)</a></div>
                    <div class="col-md-4 p-r-0"><span class="green_round"></span> <a href="#" class="lr-valid" ng-click="tabChange('valid')">Valid (47)</a></div>
                    <div class="col-md-4 p-r-0"><span class="orange_round"></span> <a href="#" class="lr-due" ng-click="tabChange('due')">Due (8)</a></div>
                </div>
                <div class="col-md-offset-6 col-md-2 nav_add_icons">
                    <div class="col-md-4 text-right p-r-10 tooltip_rel"><a data-target="#addLicense" data-toggle="modal" style="cursor:pointer;"><i class="fa fa-plus"></i></a><span class="tooltip_cust">ADD LICENSE</span></div>
                    <div class="col-md-4 tooltip_rel"><a data-target="#pdfreport" data-toggle="modal" style="cursor:pointer;"><i class="fa fa-file-pdf-o"></i></a><span class="tooltip_cust">VIEW PDF</span></div>
                    <div class="col-md-4 add_user_icon tooltip_rel"><a data-target="#addUser" data-toggle="modal" style="cursor:pointer;"><i class="fa fa-user-plus"></i></a><span class="tooltip_cust">ADD USER</span></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">

                        <!--Expired Table-->
                        <table class="table table-bordered table-responsive lr_cust_table" ng-show="expired">
                            <tr>
                                <th class="slno">sl.no</th>
                                <th class="crname">crew name<span class="sort_icons"><a href="#"><i class="fa fa-caret-up"></i></a><a href="#"><i class="fa fa-caret-down"></i></a></span></th>
                                <th class="lictype">license type<span class="sort_icons"><a href="#"><i class="fa fa-caret-up"></i></a><a href="#"><i class="fa fa-caret-down"></i></a></span></th>
                                <th class="days2go">days to go<span class="sort_icons"><a href="#"><i class="fa fa-caret-up"></i></a><a href="#"><i class="fa fa-caret-down"></i></a></span></th>
                                <th class="expdate">expiry date<span class="sort_icons"><a href="#"><i class="fa fa-caret-up"></i></a><a href="#"><i class="fa fa-caret-down"></i></a></span></th>
                                <th class="action_icons">actions</th>
                            </tr>
                            <tr class="expired_font">
                                <td>227</td>
                                <td>pilot4client2</td>
                                <td>commercial pilot license</td>
                                <td>-216</td>
                                <td>07-jun-2016</td>
                                <td>
                                    <div class="tooltip_rel"><a ng-click="historyToggle()" style="cursor:pointer"><i class="fa fa-history"></i></a><span class="tooltip_cust">View History</span></div>
                                    <div class="tooltip_rel"><a ng-click="editToggle()" style="cursor:pointer"><i class="fa fa-pencil-square"></i></a><span class="tooltip_cust">Edit License</span></div>
                                    <div class="tooltip_rel"><a data-target="#deleteLicense" data-toggle="modal" style="cursor:pointer"><i class="fa fa-trash"></i></a><span class="tooltip_cust">Delete License</span></div>
                                </td>
                            </tr>

                            <!--Horizontal TimeLine Section Starts Here-->
                            <tr ng-show="historyValue">
                                <td colspan="6">
                                    <section class="cd-horizontal-timeline">
                                        <div class="timeline">
                                            <div class="events-wrapper">
                                                <div class="events">
                                                    <ol>
                                                        <li><a href="#0" data-date="16/01/2014" class="selected">16 Jan</a></li>
                                                        <li><a href="#0" data-date="28/02/2014">28 Feb</a></li>
                                                        <li><a href="#0" data-date="20/04/2014">20 Mar</a></li>
                                                        <li><a href="#0" data-date="20/05/2014">20 May</a></li>
                                                        <li><a href="#0" data-date="09/07/2014">09 Jul</a></li>
                                                        <li><a href="#0" data-date="30/08/2014">30 Aug</a></li>
                                                        <li><a href="#0" data-date="15/09/2014">15 Sep</a></li>
                                                        <li><a href="#0" data-date="01/11/2014">01 Nov</a></li>
                                                        <li><a href="#0" data-date="10/12/2014">10 Dec</a></li>
                                                        <li><a href="#0" data-date="19/01/2015">29 Jan</a></li>
                                                        <li><a href="#0" data-date="03/03/2015">3 Mar</a></li>
                                                    </ol>

                                                    <span class="filling-line" aria-hidden="true"></span>
                                                </div> <!--events -->
                                            </div> <!--events-wrapper -->

                                            <ul class="cd-timeline-navigation">
                                                <li><a href="#0" class="prev inactive">Prev</a></li>
                                                <li><a href="#0" class="next">Next</a></li>
                                            </ul> <!--cd-timeline-navigation -->
                                        </div> <!--timeline -->

                                        <div class="events-content">
                                            <ol>
                                                <li class="selected" data-date="16/01/2014">
                                                    <h2>Horizontal Timeline</h2>
                                                    <em>January 16th, 2014</em>
                                                    <p>	
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                    </p>
                                                </li>

                                                <li data-date="28/02/2014">
                                                    <h2>Event title here</h2>
                                                    <em>February 28th, 2014</em>
                                                    <p>	
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                    </p>
                                                </li>

                                                <li data-date="20/04/2014">
                                                    <h2>Event title here</h2>
                                                    <em>March 20th, 2014</em>
                                                    <p>	
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                    </p>
                                                </li>

                                                <li data-date="20/05/2014">
                                                    <h2>Event title here</h2>
                                                    <em>May 20th, 2014</em>
                                                    <p>	
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                    </p>
                                                </li>

                                                <li data-date="09/07/2014">
                                                    <h2>Event title here</h2>
                                                    <em>July 9th, 2014</em>
                                                    <p>	
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                    </p>
                                                </li>

                                                <li data-date="30/08/2014">
                                                    <h2>Event title here</h2>
                                                    <em>August 30th, 2014</em>
                                                    <p>	
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                    </p>
                                                </li>

                                                <li data-date="15/09/2014">
                                                    <h2>Event title here</h2>
                                                    <em>September 15th, 2014</em>
                                                    <p>	
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                    </p>
                                                </li>

                                                <li data-date="01/11/2014">
                                                    <h2>Event title here</h2>
                                                    <em>November 1st, 2014</em>
                                                    <p>	
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                    </p>
                                                </li>

                                                <li data-date="10/12/2014">
                                                    <h2>Event title here</h2>
                                                    <em>December 10th, 2014</em>
                                                    <p>	
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                    </p>
                                                </li>

                                                <li data-date="19/01/2015">
                                                    <h2>Event title here</h2>
                                                    <em>January 19th, 2015</em>
                                                    <p>	
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                    </p>
                                                </li>

                                                <li data-date="03/03/2015">
                                                    <h2>Event title here</h2>
                                                    <em>March 3rd, 2015</em>
                                                    <p>	
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                    </p>
                                                </li>
                                            </ol>
                                        </div> <!--events-content-->
                                    </section>
                                </td>
                            </tr>
                            <!--End of Horizontal Timeline -->

                            <tr ng-show="editValue">
                                <td colspan="6">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="edit_left_caption">License Type: </span><span class="license_type_font">test license</span>
                                        </div>
                                        <div class="col-md-4">
                                            <span class="edit_left_caption">Expiry Date: </span><span>insert a date picker required with conform and cancel buttons</span>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="col-md-4 edit_left_caption">Attachments </div>
                                            <div class="col-md-8 p-0">
                                                <div class="form-group">
                                                    <input type="file" name="img[]" class="file">
                                                    <div class="input-group col-xs-12">

                                                        <input type="text" class="form-control input-lg uploadimage1" disabled placeholder="Upload Image">
                                                        <span class="input-group-btn">
                                                            <button class="browse btn newbtnv1 browsebtn" type="button">Browse</button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-1 edit_left_caption p-0">Remarks: </div>
                                            <div class="col-md-11 p-0">
                                                <span ng-bind="remarksText"  ng-click="remarksTextBoxShow()" ng-show="remarksTextLabel"></span>
                                                <div class="col-md-12 p-0"  ng-show="remarksTextBox">
                                                    <textarea class="form-control" rows="5" style="margin-bottom:10px;" ng-model="remarksText"></textarea>
                                                    <button type="button" class="btn newbtnv1" ng-click="updateRemarks()">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        </table>

                        <!--Valid Table-->
                        <table class="table table-bordered table-responsive lr_cust_table" ng-show="valid">
                            <tr>
                                <th class="slno">sl.no</th>
                                <th class="crname">crew name<span class="sort_icons"><a href="#"><i class="fa fa-caret-up"></i></a><a href="#"><i class="fa fa-caret-down"></i></a></span></th>
                                <th class="lictype">license type<span class="sort_icons"><a href="#"><i class="fa fa-caret-up"></i></a><a href="#"><i class="fa fa-caret-down"></i></a></span></th>
                                <th class="days2go">days to go<span class="sort_icons"><a href="#"><i class="fa fa-caret-up"></i></a><a href="#"><i class="fa fa-caret-down"></i></a></span></th>
                                <th class="expdate">expiry date<span class="sort_icons"><a href="#"><i class="fa fa-caret-up"></i></a><a href="#"><i class="fa fa-caret-down"></i></a></span></th>
                                <th class="action_icons">actions</th>
                            </tr>
                            <tr class="valid_font">
                                <td>227</td>
                                <td>pilot4client2</td>
                                <td>commercial pilot license</td>
                                <td>-216</td>
                                <td>07-jun-2016</td>
                                <td>
                                    <a href="#"><i class="fa fa-history"></i></a>
                                    <a href="#"><i class="fa fa-pencil-square"></i></a>
                                    <a href="#"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        </table>

                        <!--Due Table-->
                        <table class="table table-bordered table-responsive lr_cust_table" ng-show="due">
                            <tr>
                                <th class="slno">sl.no</th>
                                <th class="crname">crew name<span class="sort_icons"><a href="#"><i class="fa fa-caret-up"></i></a><a href="#"><i class="fa fa-caret-down"></i></a></span></th>
                                <th class="lictype">license type<span class="sort_icons"><a href="#"><i class="fa fa-caret-up"></i></a><a href="#"><i class="fa fa-caret-down"></i></a></span></th>
                                <th class="days2go">days to go<span class="sort_icons"><a href="#"><i class="fa fa-caret-up"></i></a><a href="#"><i class="fa fa-caret-down"></i></a></span></th>
                                <th class="expdate">expiry date<span class="sort_icons"><a href="#"><i class="fa fa-caret-up"></i></a><a href="#"><i class="fa fa-caret-down"></i></a></span></th>
                                <th class="action_icons">actions</th>
                            </tr>
                            <tr class="due_font">
                                <td>227</td>
                                <td>pilot4client2</td>
                                <td>commercial pilot license</td>
                                <td>-216</td>
                                <td>07-jun-2016</td>
                                <td>
                                    <a href="#"><i class="fa fa-history"></i></a>
                                    <a href="#"><i class="fa fa-pencil-square"></i></a>
                                    <a href="#"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!--Modal Popups  -->
            <div id="addLicense" class="modal fade in" style=" padding-right: 17px;">
                <div class="modal-dialog modal-addlicense">
                <!-- addlicense modal -->
                    <header class="popupHeader"> <span class="header_title">ADD LICENSE</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
                    <section class="popupBody">  
                        <div class="row">
                            <div class="col-md-12 p-t-15">
                                <form class="form_add_license">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select class="form-control">
                                                    <option selected disabled>Select User</option>
                                                    <option>Pilot1Client2</option>
                                                    <option>Pilot2Client2</option>
                                                    <option>Pilot3Client2</option>
                                                    <option>Pilot4Client2</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <select class="form-control">
                                                    <option selected disabled>Select License Type</option>
                                                    <option> ATPL-Airline Transport Pilot License</option>
                                                    <option> ATPL-Airline Transport Pilot License</option>
                                                    <option> ATPL-Airline Transport Pilot License</option>
                                                    <option> ATPL-Airline Transport Pilot License</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="License No">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" id="date1" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" style="resize:vertical" placeholder="Remarks"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="file" id="upload_input">
                                            </div>
                                        </div>
                                        <div class="col-md-offset-6 col-md-2">
                                            <button class="form-control btn newbtnv1">Add license</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div id="pdfreport" class="modal fade in" style=" padding-right: 17px;">
                <div class="modal-dialog modal-pdfreport">
                    <header class="popupHeader"> <span class="header_title">ADD LICENSE</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
                    <section class="popupBody">
                        <div class="row">
                            <form class="form_pdfreport">
                                <div class="col-md-12 p-t-15">
                                    <div class="form-group">
                                        <select class="form-control">
                                            <option selected disabled>Select A User</option>
                                            <option>Pilot1Client2</option>
                                            <option>Pilot2Client2</option>
                                            <option>Pilot3Client2</option>
                                            <option>Pilot4Client2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-offset-4 col-md-4"><button class="form-control btn newbtnv1">pdfreport</button></div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>

            <div id="addUser" class="modal fade in" style=" padding-right: 17px;">
                <div class="modal-dialog modal-addUser">
                    <header class="popupHeader"> <span class="header_title">ADD USER</span><span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span></header>
                    <section class="popupBody">
                        <div class="row">
                            <form class="form_addUser">
                                <div class="col-md-12 p-t-15">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="emai id">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="password">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="1 OR 2 OR 3">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="mobile number">
                                        </div>
                                    </div>
                                    <div class="col-md-4"><button class="form-control btn newbtnv1">ADD USER</button></div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>

            <div id="deleteLicense" class="modal fade in" style=" padding-right: 17px;">
                <div class="modal-dialog modal-deleteLicense">
                    <header class="popupHeader"> <span class="header_title">DELETE LICENSE</span><span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span></header>
                    <section class="popupBody">
                        <div class="row">
                            <p class="dl_sure_text">are you sure want to delete this license?</p>
                            <div class="col-md-offset-3 col-md-3"><button class="btn newbtnv1">YES</button></div>
                            <div class="col-md-3"><button class="btn newbtn_blackv1">NO</button></div>
                        </div>
                    </section>
                </div>
            </div>

            <!--End of Modal Popups  -->
        </div>
    </main>
    <script src="{{url('media/lr_hrtimeline/js/jquery.mobile.custom.min.js')}}"></script>
    <script src="{{url('media/lr_hrtimeline/js/main.js')}}"></script>
    @include('includes.new_footer',[])
</div>
@stop