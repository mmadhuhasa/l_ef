  angular.module('eflight', [], function($interpolateProvider) {
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
      .controller('profileCtrl', function($scope, $http) {
          $scope.enableField = {};
          $scope.profile = {};
          $scope.tabIndex = [false, true, false, false];
          $scope.aero_code_list_fav_notam_airport = [];
          $scope.aero_code_list_wx = [];
          $scope.aero_code_list_fav_route = [];
          $scope.showEventList = true;

          var eventsArr = [{
              title: 'FLIGHTS',
              start: '2017-06-15T1600',
              className: "fpl-event",
          }, {
              title: 'LICENSE',
              start: '2017-06-15',
              className: "license-event",

          }, {
              title: 'FDTL',
              start: '2017-06-15T1600',
              className: "fpl-event fdtl-event",

          }];
          var eventData = {
              "monthly": [{
                  "id": 1,
                  "name": "FLIGHTS",
                  "startdate": "2017-06-15",
                  "enddate": "2017-06-15",
                  "starttime": "12:00",
                  "endtime": "2:00",
                  "color": "#FFB128",
                  "url": "",
                  "class": "fpl-event"
              }, {
                  "id": 2,
                  "name": "LICENSE",
                  "startdate": "2017-06-15",
                  "enddate": "",
                  "starttime": "12:00",
                  "endtime": "2:00",
                  "color": "#EF44EF",
                  "url": "",
                  "class": "license-event"
              }, {
                  "id": 12,
                  "name": "FDTL",
                  "startdate": "2017-06-15",
                  "enddate": "",
                  "starttime": "12:00",
                  "endtime": "2:00",
                  "color": "#EF44EF",
                  "url": "",
                  "class": "fpl-event fdtl-event"
              }]
          };

          $(function() {

              var availableTags = [];

              $http.get(base_url + '/getairportlist')
                  .success(function(data) {
                      availableTags = data;
                      for (var i = 0; i < availableTags.length; i++) {
                          availableTags[i] = availableTags[i].aero_id;
                      };
                      $("#aero_code_fav_route").autocomplete({
                          source: availableTags,
                          minLength: 2
                      });
                      $("#aero_code_wx").autocomplete({
                          source: availableTags,
                          minLength: 2
                      });
                      $("#aero_code_fav_notam_airport").autocomplete({
                          source: availableTags,
                          minLength: 2
                      });
                      $("[data-toggle = 'popover']").popover({
                          html: true,
                          trigger: "hover"
                      });


                      $("#aero_code_fav_notam_airport").on("autocompleteselect", function(event, ui) {
                          if ($scope.aero_code_list_fav_notam_airport.indexOf(ui.item.label) == -1 && $scope.aero_code_list_fav_notam_airport.length < 5) {
                              $scope.aero_code_list_fav_notam_airport.push(ui.item.label);
                              // $scope.savefavAerodrome('fav_aerodrome_notams', ui.item.label);
                          }
                          setTimeout(function() {

                              $scope.aero_code_fav_notam_airport = undefined;
                              $scope.$digest();
                          }, 100);
                      });
                      $("#aero_code_wx").on("autocompleteselect", function(event, ui) {
                          if ($scope.aero_code_list_wx.indexOf(ui.item.label) == -1 && $scope.aero_code_list_wx.length < 5) {
                              $scope.aero_code_list_wx.push(ui.item.label);
                              // $scope.savefavAerodrome('fav_aerodrome_weather', ui.item.label);
                          }
                          setTimeout(function() {
                              $scope.aero_code_wx = undefined;

                              $scope.$digest();
                          }, 100);
                      });
                      $("#aero_code_fav_route").on("autocompleteselect", function(event, ui) {
                          if ($scope.aero_code_list_fav_route.indexOf(ui.item.label) == -1 && $scope.aero_code_list_fav_route.length < 5) {
                              $scope.aero_code_list_fav_route.push(ui.item.label);
                              // $scope.savefavAerodrome('fav_routes', ui.item.label);
                          }
                          setTimeout(function() {
                              $scope.aero_code_fav_route = undefined;
                              $scope.$digest();
                          }, 100);
                      });

                  });
              $('#mycalendar').monthly({
                  mode: 'event',
                  events: eventData,
                  dataType: 'json',
                  dayNames: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                  monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                  dayClick: function(data) {
                      // console.log(data);
                      $scope.modalObj = {};
                      $scope.eventsList = eventsOnDay(data.format('YYYY-MM-DD'));
                      $scope.modalObj.title = data.format('DD-MMM-YYYY');
                      $scope.$digest();
                      $('.md-modal.md-effect-1').addClass('md-show');
                      $('.bg-overlay').show();
                  }
              });
              $('#calendar1').fullCalendar({
                  header: {
                      left: 'prev ',
                      center: 'title',
                      right: 'next'
                  },
                  height: 'auto',
                  defaultDate: '2017-06-12',
                  defaultView: 'listMonth',
                  navLinks: false, // can click day/week names to navigate views
                  editable: true,
                  eventLimit: true, // allow "more" link when too many events
                  columnFormat: 'dddd',
                  events: eventsArr
              });
              // Advance months
              $(document.body).on("click", " .monthly-next", function(event) {
                  $('#calendar1').fullCalendar('next');
              });

              // Go back in months
              $(document.body).on("click", " .monthly-prev", function(event) {
                  $('#calendar1').fullCalendar('prev');
              });
              $('.md-close').on('click', function() {
                  $('.bg-overlay').hide();
              })
              $(".m-d .monthly-indicator-wrap").each(function(index) {
                  var childrens = $(this).children();
                  if (childrens.length != 0) {
                      $(this).parent().addClass(childrens[0].classList[1]);
                  }
              });
              var body = document.getElementsByTagName("body");
              $('.bg-overlay').css('height', body[0].scrollHeight + 30);

              function eventsOnDay(date) {
                  var events = [];
                  for (var i = 0; i < eventData.monthly.length; i++) {
                      if (eventData.monthly[i].startdate == date) {
                          events.push(eventData.monthly[i]);
                      }
                  }
                  return events;
              }

              function removeExistingEvent(date, event) {
                  for (var i = 0; i < eventData.monthly.length; i++) {
                      if ((eventData.monthly[i].startdate == date) && (eventData.monthly[i].name != 'FLIGHTS' && eventData.monthly[i].name != 'LICENSE' && eventData.monthly[i].name != 'FDTL')) {
                          
                          eventData.monthly.splice(i, 1);
                          eventsArr.splice(i, 1);
                      }
                    
                  };
              }

              function isEventExist(date, event) {
                  for (var i = 0; i < eventData.monthly.length; i++) {
                      if ((eventData.monthly[i].startdate == date) && (eventData.monthly[i].name == 'FLIGHTS' || eventData.monthly[i].name == 'LICENSE' || eventData.monthly[i].name == 'FDTL') && event != 'TRAINING') {
                          return true;
                      }
                      if ((eventData.monthly[i].startdate == date) && (eventData.monthly[i].name == 'WEEK OFF' || eventData.monthly[i].name == 'TRAINING' || eventData.monthly[i].name == 'LEAVE')) {
                          return true;
                      }
                      if ((eventData.monthly[i].startdate == date) && (eventData.monthly[i].name == event)) {
                          return true;
                      }
                  };
                  return false;
              }

              $scope.hideModal = function() {
                  $scope.event = undefined;
                  $scope.showErrMessage = false;
                  $scope.showEventList = true;
                  $scope.showEventInput = false;
                  $('.md-modal.md-effect-1').removeClass('md-show');
                  $('.bg-overlay').hide();
              };
              $scope.addEvent = function() {
                  $scope.showEventInput = true;
                  $scope.showEventList = false;
              }
              $scope.edit = function() {
                  $scope.event = $scope.eventsList[0].name.toLowerCase();
                  $scope.showEventInput = true;
                  $scope.showEventList = false;
              }
              $scope.saveEvent = function() {
                  if ($scope.event == undefined) {
                      $scope.showErrMessage = true;
                      return;
                  } else {
                      $scope.showErrMessage = false;
                  }
                  var eventListViewObj = {
                      title: $scope.event.toUpperCase(),
                      start: moment($scope.modalObj.title, 'DD-MMM-YYYY').format('YYYY-MM-DD'), // 2017-06-08T1400
                      className: ''
                  };
                  var eventInCalendarObj = {
                      "id": 1,
                      "name": $scope.event.toUpperCase(),
                      "startdate": moment($scope.modalObj.title, 'DD-MMM-YYYY').format('YYYY-MM-DD'),
                      "enddate": moment($scope.modalObj.title, 'DD-MMM-YYYY').format('YYYY-MM-DD'),
                      "starttime": "",
                      "endtime": "",
                      "color": "",
                      "url": "",
                      "class": ""
                  };
                  removeExistingEvent(eventInCalendarObj.startdate, $scope.event.toUpperCase());
                  
                  if (isEventExist(eventInCalendarObj.startdate, $scope.event.toUpperCase())) {
                      $scope.hideModal();
                      return;
                  }

                  if ($scope.event == 'leave') {
                      eventInCalendarObj.class = 'leave-event';
                      eventListViewObj.className = 'leave-event';
                  } else if ($scope.event == 'week off') {
                      eventInCalendarObj.class = 'week-off-event';
                      eventListViewObj.className = 'week-off-event';

                  } else if ($scope.event == 'training') {
                      eventInCalendarObj.class = 'training-event';
                      eventListViewObj.className = 'training-event';
                  }
                  eventData.monthly.push(eventInCalendarObj);
                  eventsArr.push(eventListViewObj);
                  // console.log('eventsArr', eventsArr);
                  $('#mycalendar').remove();
                  $('#calendar1').remove();
                  $("#mycalendar-parent").append("<div id='mycalendar'></div>")
                  $("#calendar1-parent").append("<div id='calendar1'></div>")
                  $('#mycalendar').monthly({
                      mode: 'event',
                      events: eventData,
                      dataType: 'json',
                      dayNames: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                      monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                      dayClick: function(data) {
                          // console.log(data);
                          $scope.modalObj = {};
                          $scope.modalObj.title = data.format('DD-MMM-YYYY');
                          $scope.$digest();
                          $('.md-modal.md-effect-1').addClass('md-show');
                          $('.bg-overlay').show();
                      }
                  });
                  $('#calendar1').fullCalendar({
                      header: {
                          left: 'prev ',
                          center: 'title',
                          right: 'next'
                      },
                      height: 'auto',
                      defaultDate: '2017-06-12',
                      defaultView: 'listMonth',
                      navLinks: false, // can click day/week names to navigate views
                      editable: true,
                      eventLimit: true, // allow "more" link when too many events
                      columnFormat: 'dddd',
                      events: eventsArr
                  });
                  $(".m-d .monthly-indicator-wrap").each(function(index) {
                      var childrens = $(this).children();
                      if (childrens.length != 0) {
                          $(this).parent().addClass(childrens[0].classList[1]);
                      }
                  });
                  $scope.hideModal();
              }
              $scope.changePassword = function() {
                  var obj = {
                      email: $scope.profile.email,
                      old_password: $scope.profile.current_password,
                      password: $scope.profile.new_password,
                      password_confirmation: $scope.profile.confirm_password,
                      _token: $('meta[name="_token"]').attr('content')
                  };

                  if (obj.old_password == undefined || obj.password == undefined || obj.password_confirmation == undefined) {
                      $scope.errMessage = "Field are mandatory";
                      $("#watchhours").modal();
                      return;
                  }
                  if (obj.password != obj.password_confirmation) {
                      $scope.errMessage = "Password and confirm password is not matching";
                      $("#watchhours").modal();
                      return;
                  }

                  $http({
                      method: 'POST',
                      url: base_url + '/change_profile_password',
                      data: obj,
                  }).success(function(data) {
                      // console.log(data);
                      if (data.STATUS_CODE == 1) {
                          // console.log('success')
                          $scope.enableField['password'] = false;
                          $scope.profile.current_password = undefined;
                          $scope.profile.new_password = undefined;
                          $scope.profile.confirm_password = undefined;
                      } else {
                          // alert(data.STATUS_DESC);
                          $scope.errMessage = data.STATUS_DESC;
                          $("#watchhours").modal();
                      }
                  });
              };
              $scope.statsiconclick = function() {
                  // console.log('index');
                  $('#statsmodal').modal();
              }
              $scope.changeTab = function(index) {
                  $scope.tabIndex = [false, false, false, false];
                  $scope.tabIndex[index] = true;
                  if (index == 1) {
                      setTimeout(function() {
                          $('#calendar1').fullCalendar({
                              header: {
                                  left: 'prev ',
                                  center: 'title',
                                  right: 'next'
                              },
                              height: 'auto',
                              defaultDate: '2017-06-12',
                              defaultView: 'listMonth',
                              navLinks: false, // can click day/week names to navigate views
                              editable: true,
                              eventLimit: true, // allow "more" link when too many events
                              columnFormat: 'dddd',
                              events: eventsArr
                          });
                      }, 1000);

                  } else if (index == 2) {
                      var availableTags = [];

                      $http.get(base_url + '/getairportlist')
                          .success(function(data) {
                              availableTags = data;
                              for (var i = 0; i < availableTags.length; i++) {
                                  availableTags[i] = availableTags[i].aero_id;
                              };
                              $("#aero_code_fav_route").autocomplete({
                                  source: availableTags,
                                  minLength: 2
                              });
                              $("#aero_code_wx").autocomplete({
                                  source: availableTags,
                                  minLength: 2
                              });
                              $("#aero_code_fav_notam_airport").autocomplete({
                                  source: availableTags,
                                  minLength: 2
                              });
                              $("[data-toggle = 'popover']").popover({
                                  html: true,
                                  trigger: "hover"
                              });


                              $("#aero_code_fav_notam_airport").on("autocompleteselect", function(event, ui) {
                                  if ($scope.aero_code_list_fav_notam_airport.indexOf(ui.item.label) == -1 && $scope.aero_code_list_fav_notam_airport.length < 5) {
                                      $scope.aero_code_list_fav_notam_airport.push(ui.item.label);
                                      // $scope.savefavAerodrome('fav_aerodrome_notams', ui.item.label);
                                  }
                                  setTimeout(function() {
                                      // console.log('reset', $scope.aero_code_fav_notam_airport);

                                      $scope.aero_code_fav_notam_airport = undefined;
                                      // console.log('reset', $scope.aero_code_fav_notam_airport);
                                      $scope.$digest();
                                  }, 100);
                              });
                              $("#aero_code_wx").on("autocompleteselect", function(event, ui) {
                                  if ($scope.aero_code_list_wx.indexOf(ui.item.label) == -1 && $scope.aero_code_list_wx.length < 5) {
                                      $scope.aero_code_list_wx.push(ui.item.label);
                                      // $scope.savefavAerodrome('fav_aerodrome_weather', ui.item.label);
                                  }
                                  setTimeout(function() {
                                      $scope.aero_code_wx = undefined;

                                      $scope.$digest();
                                  }, 100);
                              });
                              $("#aero_code_fav_route").on("autocompleteselect", function(event, ui) {
                                  if ($scope.aero_code_list_fav_route.indexOf(ui.item.label) == -1 && $scope.aero_code_list_fav_route.length < 5) {
                                      $scope.aero_code_list_fav_route.push(ui.item.label);
                                      // $scope.savefavAerodrome('fav_routes', ui.item.label);
                                  }
                                  setTimeout(function() {
                                      $scope.aero_code_fav_route = undefined;
                                      $scope.$digest();
                                  }, 100);
                              });

                          });

                  }
              }
              $scope.getUserInfo = function() {
                  $http.get(base_url + '/getuser')
                      .success(function(data) {
                          // console.log(data);

                          $scope.profile = data.user_info;
                          // console.log($scope.profile);
                          // console.log($scope.profile.created_at);
                          $scope.profile.created_at_moment = moment($scope.profile.created_at).format('DD-MMM-YYYY');
                          $scope.profile.relativeUpdatedTime = moment($scope.profile.updated_at).startOf('hour').fromNow();

                          $scope.aero_code_list_fav_notam_airport = [];
                          $scope.aero_code_list_wx = [];
                          $scope.aero_code_list_fav_route = [];
                          for (var i = 0; i < data.fav_notams_aero.length; i++) {
                              $scope.aero_code_list_fav_notam_airport.push(data.fav_notams_aero[i].fav_aerodrome_notams);
                          };
                          for (var i = 0; i < data.fav_routes.length; i++) {
                              $scope.aero_code_list_fav_route.push(data.fav_routes[i].fav_routes);
                          };
                          for (var i = 0; i < data.fav_wx.length; i++) {
                              $scope.aero_code_list_wx.push(data.fav_wx[i].fav_aerodrome_weather);
                          };
                          $scope.master_aero_code_list_fav_notam_airport = angular.copy($scope.aero_code_list_fav_notam_airport);
                          $scope.master_aero_code_list_wx = angular.copy($scope.aero_code_list_wx);
                          $scope.master_aero_code_list_fav_route = angular.copy($scope.aero_code_list_fav_route);

                          $scope.profile.user_role_id = $scope.profile.user_role_id.toString();
                          $scope.profile.user_roles = ["EFLIGHT ADMIN", "EFLIGHT OPS", "OPERATOR ADMIN", "USER"];
                          if ($scope.profile.is_fpl == 1) {
                              $scope.profile.is_fpl_flag = true;
                          } else {
                              $scope.profile.is_fpl_flag = false;
                          }
                          if ($scope.profile.is_fdtl == 1) {
                              $scope.profile.is_fdtl_flag = true;
                          } else {
                              $scope.profile.is_fdtl_flag = false;
                          }
                          if ($scope.profile.is_lr == 1) {
                              $scope.profile.is_lr_flag = true;
                          } else {
                              $scope.profile.is_lr_flag = false;
                          }
                          if ($scope.profile.is_navlog == 1) {
                              $scope.profile.is_navlog_flag = true;
                          } else {
                              $scope.profile.is_navlog_flag = false;
                          }
                          if ($scope.profile.is_notams == 1) {
                              $scope.profile.is_notams_flag = true;
                          } else {
                              $scope.profile.is_notams_flag = false;
                          }
                          if ($scope.profile.is_runway == 1) {
                              $scope.profile.is_runway_flag = true;
                          } else {
                              $scope.profile.is_runway_flag = false;
                          }
                          if ($scope.profile.is_airports == 1) {
                              $scope.profile.is_airports_flag = true;
                          } else {
                              $scope.profile.is_airports_flag = false;
                          }
                          if ($scope.profile.is_weather == 1) {
                              $scope.profile.is_weather_flag = true;
                          } else {
                              $scope.profile.is_weather_flag = false;
                          }
                          $scope.masterProfileData = angular.copy($scope.profile);

                      });
              };
              $scope.getUserInfo();
              $scope.$watch('profile.file', function(file) {
                  // console.log(file);
                  if (file && (file[0].type != "image/jpeg" && file[0].type != "image/png")) {
                      $scope.errMessage = "Only jpeg and png images are allowed";
                      $("#watchhours").modal();

                      return;
                  }
                  if (file && file[0].size > 1048576) {
                      $scope.errMessage = "1 MB Max file size allowed";
                      $("#watchhours").modal();
                      return;

                  }

                  if (file) {
                      $scope.selectedFile = file[0].name;
                  }
              });
              $scope.uploadFile = function() {
                  $("input[type='file']").trigger('click');
              }
              $scope.emailChange = function() {
                  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

                  if (!re.test($scope.profile['email'])) {
                      $('#email').popover({
                          trigger: 'hover',
                      });
                      $('#email').attr('data-content', "Enter a Valid Email Address");
                      $('#email').css("border", "red solid 1px");
                      $('#email').popover('show');
                      return;
                  } else {
                      $('#email').popover('destroy');
                      $('#email').css("border", "1px solid #999");
                  }
              }
              $scope.saveField = function(name, id) {
                  if (name == 'mobile_number') {
                      if ($scope.profile[name].length < 10) {
                          $('#mobile_number').popover({
                              trigger: 'hover',
                          });
                          $('#mobile_number').attr('data-content', "Min and Max 10 digits");
                          $('#mobile_number').css("border", "red solid 1px");
                          $('#mobile_number').popover('show');
                          return;
                      }
                  }
                  if (name == 'email') {
                      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                      if (!re.test($scope.profile[name])) {
                          $('#email').popover({
                              trigger: 'hover',
                          });
                          $('#email').attr('data-content', "Enter a Valid Email Address");
                          $('#email').css("border", "red solid 1px");
                          $('#email').popover('show');
                          return;
                      }
                  }
                  $scope.enableField[name] = !$scope.enableField[name];
                  var obj = {};
                  obj.id = id;
                  obj[name] = $scope.profile[name];
                  obj._token = $('meta[name="_token"]').attr('content');
                  console.log(obj);
                  $http({
                      method: 'POST',
                      url: base_url + '/update_user',
                      data: obj,
                  }).success(function(data) {
                      console.log(data);
                      $scope.getUserInfo();
                  });
              };
              $scope.saveCheckBoxField = function(type) {
                  var keyNames = ['is_fpl_flag', 'is_notams_flag', 'is_weather_flag', 'is_runway_flag', 'is_airports_flag', 'is_fdtl_flag', 'is_navlog_flag', 'is_lr_flag'];
                  var name = ['is_fpl', 'is_notams', 'is_weather', 'is_runway', 'is_airports', 'is_fdtl', 'is_navlog', 'is_lr'];
                  $scope.enableField[type] = !$scope.enableField[type];
                  var obj = {};
                  obj.id = $scope.profile.id;

                  for (var i = 0; i < keyNames.length; i++) {
                      obj[name[i]] = ($scope.profile[keyNames[i]] == true) ? 1 : 0;
                  };

                  obj._token = $('meta[name="_token"]').attr('content');
                  console.log(obj);
                  $http({
                      method: 'POST',
                      url: base_url + '/update_user',
                      data: obj,
                  }).success(function(data) {
                      console.log(data);
                      $scope.getUserInfo();
                  });
              };
              $scope.removeModal = function(index, type) {
                  $scope.removalIndex = index;
                  $scope.removalType = type;
                  $("#profileModal").modal();
              };

              $scope.remove = function() {
                  var index = $scope.removalIndex;
                  var type = $scope.removalType;
                  $("#profileModal").modal('hide');
                  var obj = {};
                  obj.user_id = $scope.profile.id;
                  if (type == "airport") {
                      console.log('airport');
                      obj.aero_code = $scope.aero_code_list_fav_notam_airport[index];
                      obj.type = 'fav_aerodrome_notams';
                      $http({
                          method: 'PUT',
                          url: base_url + '/remove_fav',
                          data: obj,
                      }).success(function(data) {
                          console.log(data);
                      });
                      $scope.aero_code_list_fav_notam_airport.splice(index, 1);

                  } else if (type == "wx") {
                      obj.aero_code = $scope.aero_code_list_wx[index];
                      obj.type = 'fav_aerodrome_weather';
                      $http({
                          method: 'PUT',
                          url: base_url + '/remove_fav',
                          data: obj,
                      }).success(function(data) {
                          console.log(data);
                      });
                      $scope.aero_code_list_wx.splice(index, 1);

                  } else {
                      obj.aero_code = $scope.aero_code_list_fav_route[index];
                      obj.type = 'fav_routes';
                      $http({
                          method: 'PUT',
                          url: base_url + '/remove_fav',
                          data: obj,
                      }).success(function(data) {
                          console.log(data);
                      });
                      $scope.aero_code_list_fav_route.splice(index, 1);
                  }
              }
              $scope.editField = function(name) {
                  $scope.enableField[name] = !$scope.enableField[name];
              };
              $scope.savefavAerodrome = function(key, name) {
                  $scope.enableField[name] = !$scope.enableField[name];
                  console.log('reset', $scope.aero_code_fav_notam_airport);

                  var obj = {};
                  obj.user_id = $scope.profile.id;
                  obj.type = key;
                  // obj[key] = value;
                  if (key == "fav_aerodrome_notams") {
                      obj.value = $scope.aero_code_list_fav_notam_airport;
                  } else if (key == "fav_aerodrome_weather") {
                      obj.value = $scope.aero_code_list_wx;
                  } else {
                      obj.value = $scope.aero_code_list_fav_route;
                  }
                  obj._token = $('meta[name="_token"]').attr('content');
                  console.log(obj);
                  $http({
                      method: 'POST',
                      url: base_url + '/update_user_fav',
                      data: obj,
                  }).success(function(data) {
                      console.log(data);
                      $scope.getUserInfo();
                  });
              };
              $scope.closeField = function(name) {
                  $scope.enableField[name] = !$scope.enableField[name];
                  $scope.profile = angular.copy($scope.masterProfileData);
                  $scope.aero_code_list_fav_notam_airport = angular.copy($scope.master_aero_code_list_fav_notam_airport);
                  $scope.aero_code_list_wx = angular.copy($scope.master_aero_code_list_wx);
                  $scope.aero_code_list_fav_route = angular.copy($scope.master_aero_code_list_fav_route);
                  if (name == "fav_notam_aiport") {
                      $scope.savefavAerodrome('fav_aerodrome_notams');
                  }
                  if (name == "aero_code_wx") {
                      $scope.savefavAerodrome('fav_aerodrome_weather');
                  }
                  if (name == "aero_code_fav_route") {
                      $scope.savefavAerodrome('fav_routes');
                  }
              }

          })
      });
