    angular.module('eflight', [])
        .filter('unsafe', function($sce) {
            return function(val) {
                return $sce.trustAsHtml(val);
            };
        })
        .controller('superviseCtrl', function($scope, $http) {
            angular.element(document).ready(function() {
                $(".fakeloader").hide();
            });
            $scope.tabStatus = [true, false, false, false];
            $scope.pageindex = 0;
            $scope.enableDescriptionTextarea = [];
            $scope.tooltipFlag = [];
            $scope.resultArr = [];
            $scope.firArr = ['vi', 've', 'va', 'vo'];
            $scope.region = {
                'vi': 'DELHI REGION ( VIDF )',
                've': 'KOLKATA REGION ( VECF )',
                'vo': 'CHENNAI REGION ( VOMF )',
                'va': 'MUMBAI REGION ( VABF )',
            }
            $scope.fir = 'vi';
            $scope.offset = 0;
            $scope.limit = 100;
            $scope.operationLog = {};
            // $scope.operationLog[].editPdf = [];
            // $scope.operationLog.editText = [];
            // $scope.operationLog.editEmail = [];
            $http.get(base_url + '/notams/supervise/stats')
                .success(function(data) {
                    console.log(data);
                    $scope.statsData = data;

                    $scope.getPendingNotams($scope.fir, $scope.offset, $scope.limit)
                });
            $scope.is_active_checkbox = [];
            $scope.enable_email_checkbox = [];
            $scope.desc = [];

            $scope.getPendingNotams = function(fir, offset, limit) {
                $http.get('getpending?fir=' + fir + '&offset=' + offset + '&limit=' + limit)
                    .success(function(pendingData) {
                        console.log(pendingData)
                        $scope.total_count = pendingData.count;
                        $scope.resultArr = $scope.resultArr.concat(pendingData.data);
                        $scope.fetchingResult = false;
                        if ($scope.resultArr.length == 0 && $scope.total_count == 0) {
                            $scope.showErrMessage = true;
                        } else {
                            $scope.showErrMessage = false;
                        }
                        $scope.last_updatedTime = pendingData.last_updatedTime;
                        // console.log($scope.resultArr.length);
                    })

            }
            angular.element(document).ready(function() {
                angular.element(document).bind("scroll", function(e) {
                    var body = document.getElementById("body");
                    $('.bg-overlay').css('height', body.scrollHeight);
                    // console.log(body.scrollHeight, body.scrollTop, body.offsetHeight);
                    // console.log(body.scrollHeight - body.scrollTop);
                    if (body.scrollHeight - body.scrollTop < 2500) {
                        if ($scope.fetchingResult == false) {
                            $scope.fetchingResult = true;

                            // console.log($scope.offset , Math.floor($scope.statsData[$scope.fir] / $scope.limit))
                            if (($scope.offset + 1) >= Math.floor($scope.statsData[$scope.fir] / $scope.limit)) {
                                $scope.offset++;
                                console.log();
                                var remaining = $scope.statsData[$scope.fir] - $scope.offset * $scope.limit;
                                $scope.getPendingNotams($scope.fir, $scope.offset, remaining)

                                console.log('end', $scope.offset);
                                return;
                            }
                            $scope.offset++;
                            console.log('bottom reached', $scope.offset);

                            $scope.getPendingNotams($scope.fir, $scope.offset, $scope.limit)
                        }
                    }
                });
            });

            $scope.closeModal = function() {
                location.href = base_url + "/notams";
            };

            $scope.prev = function() {
                console.log('prev', $scope.pageindex);
                if ($scope.pageindex == 0) {
                    return;
                };
                $scope.pageindex--;
                $scope.tabStatus = [false, false, false, false];
                $scope.tabStatus[$scope.pageindex] = true;
                $("html, body").animate({ scrollTop: 0 }, 500);
                $scope.enableDescriptionTextarea = [];
                $scope.tooltipFlag = [];
                $scope.fir = $scope.firArr[$scope.pageindex]
                $scope.offset = 0;
                $scope.resultArr = [];
                $scope.is_active_checkbox = [];
                $scope.enable_email_checkbox = [];
                $scope.desc = [];
                $scope.getPendingNotams($scope.fir, $scope.offset, $scope.limit);

            };
            $scope.next = function() {
                if ($scope.pageindex == 3) {
                    $scope.pageindex++;
                    return;
                }

                $scope.pageindex++;
                $scope.tabStatus = [false, false, false, false];
                $scope.tabStatus[$scope.pageindex] = true;
                // console.log('next', $scope.pageindex);
                $("html, body").animate({ scrollTop: 0 }, 500);
                $scope.enableDescriptionTextarea = [];
                $scope.tooltipFlag = [];
                $scope.fir = $scope.firArr[$scope.pageindex]
                $scope.offset = 0;
                $scope.resultArr = [];
                $scope.is_active_checkbox = [];
                $scope.enable_email_checkbox = [];
                $scope.desc = [];
                $scope.getPendingNotams($scope.fir, $scope.offset, $scope.limit);
            };
            $scope.submit = function() {
                $http.get(base_url + '/notams/supervise/updatelastseen')
                    .success(function(data) {
                        console.log(data);
                        $("#alert-model-box").modal();
                        $scope.headerTitleMessage = "Message";
                        $scope.errMessage = "Verified successfully";
                    });
            }
            $scope.updateStatus = function(val, notam_no) {
                console.log(val, notam_no);
                console.log('pageindex', $scope.pageindex);
                if ($scope.operationLog[$scope.firArr[$scope.pageindex]] == undefined) {
                    $scope.operationLog[$scope.firArr[$scope.pageindex]] = {};
                    $scope.operationLog[$scope.firArr[$scope.pageindex]].editPdf = [];
                }
                if ($scope.operationLog[$scope.firArr[$scope.pageindex]].editPdf == undefined) {
                    $scope.operationLog[$scope.firArr[$scope.pageindex]].editPdf = [];
                }
                if ($scope.operationLog[$scope.firArr[$scope.pageindex]].editPdf.indexOf(notam_no) == -1) {
                    $scope.operationLog[$scope.firArr[$scope.pageindex]].editPdf.push(notam_no);
                }
                console.log($scope.operationLog);
                // return;
                var obj = {};
                obj['_token'] = $('meta[name="_token"]').attr('content');
                obj['id'] = notam_no;
                obj['status'] = $scope.is_active_checkbox[val];
                $http({
                        method: 'POST',
                        url: base_url + '/notams/updatestatus',
                        data: obj,
                    })
                    .success(function(data) {
                        console.log(data);
                    });
            };
            $scope.toggleEmailStatus = function(val, notam_no) {
                console.log(val, notam_no);
                // return;
                if ($scope.operationLog[$scope.firArr[$scope.pageindex]] == undefined) {
                    $scope.operationLog[$scope.firArr[$scope.pageindex]] = {};
                    $scope.operationLog[$scope.firArr[$scope.pageindex]].editEmail = [];
                }
                if ($scope.operationLog[$scope.firArr[$scope.pageindex]] || $scope.operationLog[$scope.firArr[$scope.pageindex]].editEmail == undefined) {
                    $scope.operationLog[$scope.firArr[$scope.pageindex]].editEmail = [];
                }
                if ($scope.operationLog[$scope.firArr[$scope.pageindex]].editEmail.indexOf(notam_no) == -1) {
                    $scope.operationLog[$scope.firArr[$scope.pageindex]].editEmail.push(notam_no);

                }
                console.log($scope.operationLog);

                var obj = {};
                obj['_token'] = $('meta[name="_token"]').attr('content');
                obj['id'] = notam_no;
                obj['status'] = $scope.enable_email_checkbox[val];
                $http({
                        method: 'POST',
                        url: base_url + '/notams/updateemailstatus',
                        data: obj,
                    })
                    .success(function(data) {
                        // console.log();

                    });
            };
            $scope.updateNotams = function(id, cur_data) {
                var obj = {};
                obj['_token'] = $('meta[name="_token"]').attr('content');
                obj['desc'] = $scope.desc[id];
                // console.log(obj);
                // return;
                if ($scope.operationLog[$scope.firArr[$scope.pageindex]] == undefined) {
                    $scope.operationLog[$scope.firArr[$scope.pageindex]] = {};
                    $scope.operationLog[$scope.firArr[$scope.pageindex]].editText = [];
                }
                if ($scope.operationLog[$scope.firArr[$scope.pageindex]] || $scope.operationLog[$scope.firArr[$scope.pageindex]].editText == undefined) {
                    $scope.operationLog[$scope.firArr[$scope.pageindex]].editText = [];
                }
                if ($scope.operationLog[$scope.firArr[$scope.pageindex]].editText.indexOf(cur_data.notam_no) == -1) {
                    $scope.operationLog[$scope.firArr[$scope.pageindex]].editText.push(cur_data.notam_no);

                }
                console.log($scope.operationLog);

                $scope.inlineEdit(id);

                $http({
                        method: 'POST',
                        url: base_url + '/notams/update?id=' + cur_data.notam_no,
                        data: obj,
                    })
                    .success(function(data) {
                        console.log(data);
                        if (data.Status == "Success") {
                            cur_data.description = $scope.desc[id];
                            // console.log()
                            // location.reload();
                            // console.log($('#desc' + id).val())
                            // $('.non-editable' + id).html(obj['desc']);
                            // console.log($('.non-editable' + id));
                            // console.log($('#desc' + id));
                        }
                    });
            };
            $scope.inlineEdit = function(id) {
                $scope.enableDescriptionTextarea[id] = !$scope.enableDescriptionTextarea[id];
            };
            $scope.open_tooltip = function(index) {
                $scope.tooltipFlag[index] = true;
                $('.bg-overlay').show();
            };
            $scope.close_tooltip = function(index) {
                $scope.tooltipFlag[index] = false;
                $('.bg-overlay').hide();
            };
        });
