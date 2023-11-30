<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection Report | JLO</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/photologo.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="../assets/vendor/css/dataTables.bootstrap5.min.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <script src="../assets/js/config.js"></script>

    <link href="../assets/plugins/sweet-alert/sweetalert.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php $path = $_SERVER['DOCUMENT_ROOT'];
    include_once($path . "/JLOFinancial/db/config.php");
    include_once($path . "/JLOFinancial/methods/sessionChecker.php");
    ?>

    <?php include($path . "/JLOFinancial/comp/collectorNavbar.php") ?>

    <?php
    $result = mysqli_query($db, "SELECT * FROM `customer`
                                     where customerid in (select customerid from `customerloan` where IsApproved = 1 group by customerid)");
    ?>

    <!-- Content -->
    <div class="container flex-grow-1 container-p-y">
        <div class="card">
            <h4 class="card-header">Monthly Collection Report</h4>

            <div class="container text-nowrap mb-3 py-3">
                <div class="row mb-5">
                    <div class="col-md-5">
                        <span>Collection Date:</span>
                        <div class="input-group">
                            <input class="form-control" id="collectionDate" type="date" value="<?php echo date('Y-m-d'); ?>">
                            <span id="daySelected" class="input-group-text">₱</span>
                        </div>
                    </div>
                </div>

                <!-- tabs -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="nav-align-top mb-4">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                                        Active Accounts
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">
                                        Past Due Accounts
                                    </button>
                                </li>
                            </ul> 
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                                    <div class="activeDiv">
                                        <table id="activeTable" class="table table-responsive">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Name</th>
                                                    <th>Daily</th>
                                                    <th>Payment</th>
                                                    <th>Last Date Paid</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                                    <div class="pastdueDiv">
                                            <table id="pastdueTable" class="table table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th>Name</th>
                                                        <th>Daily</th>
                                                        <th>Payment</th>
                                                        <th>Last Date Paid</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                            </div>

                            <div style="background-color: #D9D9D9" class="row py-3">
                                        <div class="col-md-6">
                                            <table width="100%">
                                                <tr>
                                                    <td><b>Schedule Collection</b></td>
                                                    <td><input id="scheduleCollection" type="text" value="₱ 0.00" readonly/> </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Past Due Accounts</b></td>
                                                    <td><input id="pastDueAccounts" type="text" value="₱ 0.00" readonly/> </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Active Accounts</b></td>
                                                    <td><input id="activeAccounts" type="text" value="₱ 0.00" readonly/> </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table width="100%">
                                                    <tr>
                                                        <td><b>Total Collection</b></td>
                                                        <td><input id="totalCollection" type="text" value="₱ 0.00"  readonly/> </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Cash Breakdown</b></td>
                                                        <td><input id="cashBreakDown" type="button" data-bs-toggle="modal" data-bs-target="#cashBreakdownModal" value="Cash Breakdown" readonly/></td>
                                                    </tr>
                                            </table>
                                        </div>
                                    </div>

                        </div>
                    </div>
                </div>
                <!-- end of tabs -->
            </div>
        </div>
    </div>
    <?php include($path . "/JLOFinancial/comp/footer.php") ?>


     <!-- cash breakdown-->
                <div class="col-lg-4 col-md-3">
                      <div class="mt-3">
                        <!-- Modal -->
                        <div class="modal fade" id="cashBreakdownModal" data-bs-backdrop="static" tabindex="-1">
                          <div class="modal-dialog">
                            <form class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="backDropModalTitle">Cash Breakdown</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                              <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="">COLLECTOR: <b><?php echo $_SESSION['user-es']['FirstName'].' '.$_SESSION['user-es']['LastName'] ?></b></label>
                                </div>
                                <div class="col-md-6">
                                    <label for="">DATE: <b id="cb-date"></b></label>
                                </div>
                              </div>

                              <div class="row mb-3"> 
                                <div class="col-md-12">
                                    <input type="text" id="cb-id" value="0" hidden>
                                    <table class="table-bordered" width="100%">
                                        <tr class="text-center ">
                                            <th>PIECES</th>
                                            <th>TOTAL</th>
                                        </tr>
                                        <tr>
                                            <td>1000</td>
                                            <td class="text-center" id="bythousand" oninput="restrictToNumbers(this)" contenteditable="true"></td>
                                        </tr>
                                        <tr>
                                            <td>500</td>
                                            <td class="text-center" id="byfivehundred" oninput="restrictToNumbers(this)" contenteditable="true"></td>
                                        </tr>
                                        <tr>
                                            <td>200</td>
                                            <td class="text-center" id="bytwohundred" oninput="restrictToNumbers(this)" contenteditable="true"></td>
                                        </tr>
                                        <tr>
                                            <td>100</td>
                                            <td class="text-center" id="byonehundred" oninput="restrictToNumbers(this)" contenteditable="true"></td>
                                        </tr>
                                        <tr>
                                            <td>50</td>
                                            <td class="text-center" id="byfifty" oninput="restrictToNumbers(this)" contenteditable="true"></td>
                                        </tr>
                                        <tr>
                                            <td>20</td>
                                            <td class="text-center"  id="bytwenty" oninput="restrictToNumbers(this)" contenteditable="true"></td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td class="text-center" id="byten" oninput="restrictToNumbers(this)" contenteditable="true"></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td class="text-center" id="byfive" oninput="restrictToNumbers(this)" contenteditable="true"></td>
                                        </tr>
                                    </table>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-12" style="text-align:right">
                                    <span>TOTAL COLLECTION</span> <input type="text" value="0" id="cb-totalCollection" readonly>
                                </div>
                              </div>
                                
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="button" class="btn btn-primary" id="saveBtn">Save</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

    <!-- end -->



</body>
<script src="../assets/vendor/js/jquery-370.js"></script>
<script src="../assets/vendor/js/jquery.dataTables.min.js"></script>
<script src="../assets/vendor/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#d-menu').removeClass('active');
        $('#mu-menu').removeClass('active');
        $('#cm-menu').removeClass('active');
        $('#cr-menu').addClass('active');
        $('#la-menu').removeClass('active');
        $('#ph-menu').removeClass('active');
        $('#collectionReportMenuLink').attr({
            'href': 'javascript:void(0);'
        });

        $('#collectionDate').on('change', function() {
            //get day
            if ($(this).val() != "") {
                const date = new Date($(this).val());
                const dayOfWeek = date.toLocaleDateString('en-US', {
                    weekday: 'long'
                });
                $('#daySelected').html(dayOfWeek);
            } else {
                $('#daySelected').html('');
            }

            $('#scheduleCollection').val($('#collectionDate').val());
            $('#cb-date').html($('#collectionDate').val());
            var collectionDate =  $('#collectionDate').val();

            $.ajax({
            url: "/JLOFinancial/methods/collectionreportController.php",
            type: 'POST',
            data: {
                "GetDailyCollection": 1,
                "CollectionDate" : collectionDate
            },
            success: function(response) {
                    $('#activeTable tbody').html('');
                    $('#pastdueTable tbody').html('');
                    
                    var data = JSON.parse(response);
                    console.log(data);
                    var activeData = '';
                    var counter = 1;
                    for(var i = 0; i < data.ActiveAccounts.length; i++){
                        activeData += '<tr  row-id="'+data.ActiveAccounts[0].CustomerLoanId+'" row-paymentId="'+data.ActiveAccounts[0].PaymentId+'"><td class="text-center">'+counter+'</td>'
                        + '<td>'+data.ActiveAccounts[0].CustomerName+'</td>'
                        + '<td>'+data.ActiveAccounts[0].DailyPayment+'</td>'
                        + '<td>'+(data.ActiveAccounts[0].AmountPaid == null ? "0" : data.ActiveAccounts[0].AmountPaid)+'</td>'
                        + '<td>'+data.ActiveAccounts[0].LastDatePaid+'</td>'
                        + '</tr>';                        
                        counter ++;
                    } 
                    
                    $('#activeTable tbody').append(activeData);

                    var pastdueData = '';
                    var counter2 = 1;
                    for(var i = 0; i < data.PastDueAccounts.length; i++){
                        pastdueData += '<tr  row-id="'+data.PastDueAccounts[0].CustomerLoanId+'" row-paymentId="'+data.PastDueAccounts[0].PaymentId+'"><td class="text-center">'+counter2+'</td>'
                        + '<td>'+data.PastDueAccounts[0].CustomerName+'</td>'
                        + '<td>'+data.PastDueAccounts[0].DailyPayment+'</td>'
                        + '<td>'+(data.PastDueAccounts[0].AmountPaid == null ? "0" : data.PastDueAccounts[0].AmountPaid)+'</td>'
                        + '<td>'+data.PastDueAccounts[0].LastDatePaid+'</td>'
                        + '</tr>';                        
                        counter2 ++;
                    } 
                    
                    $('#pastdueTable tbody').append(pastdueData);

                    RepopulateSummary();

            }
            });


            //CASHBREAKDOWN
            var cbdata = {
                'GetCashBreakDown': 1,
                'collectionDate' : $('#collectionDate').val()
            };

            $.ajax({
                    url: "/JLOFinancial/methods/cashbreakdownController.php",
                    type: 'POST',
                    data: cbdata,
                    success: function(response) {
                        if(response != ""){
                            var responseData = JSON.parse(response);
                            $('#totalCollection').val('₱ ' + responseData['TotalCollection']);
                            $('#cb-id').val(responseData['CashBreakDownId']);
                            $('#bythousand').html(responseData['ByThousand']);
                            $('#byfivehundred').html(responseData['ByFiveHundred']);
                            $('#bytwohundred').html(responseData['ByTwoHundred']);
                            $('#byonehundred').html(responseData['ByOneHundred']);
                            $('#byfifty').html(responseData['ByFifty']);
                            $('#bytwenty').html(responseData['ByTwenty']);
                            $('#byten').html(responseData['ByTen']);
                            $('#byfive').html(responseData['ByFive']);
                            $('#cb-totalCollection').val(responseData['TotalCollection']);
                        }else{
                            $('#totalCollection').val('₱ 0.00');
                            $('#cb-id').val("0");
                            $('#bythousand').html('');
                            $('#byfivehundred').html('');
                            $('#bytwohundred').html('');
                            $('#byonehundred').html('');
                            $('#byfifty').html('');
                            $('#bytwenty').html('');
                            $('#byten').html('');
                            $('#byfive').html('');
                            $('#cb-totalCollection').val('0');
                        }
                    }
                })


        })

        $('#collectionDate').trigger('change');


    });

    function RepopulateSummary(){
        var totalActive = 0;
        var totalPastdue = 0;

        for(var i = 1; i <= $('#activeTable tbody')[0].rows.length; i++){
            totalActive += parseFloat($('#activeTable')[0].rows[i].cells[3].innerHTML);
        }

        for(var i = 1; i <= $('#pastdueTable tbody')[0].rows.length; i++){
            totalPastdue += parseFloat($('#pastdueTable')[0].rows[i].cells[3].innerHTML);
        }
        console.log(totalPastdue);
        $('#pastDueAccounts').val('₱ ' + totalPastdue.toLocaleString());
        $('#activeAccounts').val('₱ ' + totalActive.toLocaleString());
    }

    function ComputeCBTotal(){
        var thousand = ($('#bythousand').html() == "" ? 0 : $('#bythousand').html());
        var byfivehundred = ($('#byfivehundred').html() == "" ? 0 : $('#byfivehundred').html());
        var bytwohundred = ($('#bytwohundred').html() == "" ? 0 : $('#bytwohundred').html());
        var byonehundred = ($('#byonehundred').html() == "" ? 0 : $('#byonehundred').html());
        var byfifty = ($('#byfifty').html() == "" ? 0 : $('#byfifty').html());
        var bytwenty = ($('#bytwenty').html() == "" ? 0 : $('#bytwenty').html());
        var byten = ($('#byten').html() == "" ? 0 : $('#byten').html());
        var byfive = ($('#byfive').html() == "" ? 0 : $('#byfive').html());

        var total = (thousand * 1000) + (byfivehundred * 500) + (bytwohundred * 200) + (byonehundred * 100) + (byfifty * 50) + (bytwenty * 20) + (byten * 10) + (byfive * 5);
        $('#cb-totalCollection').val(total);
    }

    function restrictToNumbers(element) {
    var content = element.textContent;

    var decimalOnly = content.replace(/[^0-9.]/g, '');

    element.textContent = decimalOnly;
    }

    $(document).on('input',"#bythousand",function(){
        ComputeCBTotal();
    });
    $(document).on('input',"#byfivehundred",function(){
        ComputeCBTotal();
    });
    $(document).on('input',"#bytwohundred",function(){
        ComputeCBTotal();
    });
    $(document).on('input',"#byonehundred",function(){
        ComputeCBTotal();
    });
    $(document).on('input',"#byfifty",function(){
        ComputeCBTotal();
    });
    $(document).on('input',"#bytwenty",function(){
        ComputeCBTotal();
    });
    $(document).on('input',"#byten",function(){
        ComputeCBTotal();
    });
    $(document).on('input',"#byfive",function(){
        ComputeCBTotal();
    });

    $('#saveBtn').on('click', function(){
        var thousand = ($('#bythousand').html() == "" ? 0 : $('#bythousand').html());
        var byfivehundred = ($('#byfivehundred').html() == "" ? 0 : $('#byfivehundred').html());
        var bytwohundred = ($('#bytwohundred').html() == "" ? 0 : $('#bytwohundred').html());
        var byonehundred = ($('#byonehundred').html() == "" ? 0 : $('#byonehundred').html());
        var byfifty = ($('#byfifty').html() == "" ? 0 : $('#byfifty').html());
        var bytwenty = ($('#bytwenty').html() == "" ? 0 : $('#bytwenty').html());
        var byten = ($('#byten').html() == "" ? 0 : $('#byten').html());
        var byfive = ($('#byfive').html() == "" ? 0 : $('#byfive').html());
        var total = $('#cb-totalCollection').val();
        var collectionDate = $('#collectionDate').val();
        var cbid = $('#cb-id').val();



        if(total == 0){
                    swal("Cash Breakdown Failed","Fill up all fields!","error");
                    return;
                }

                var data = {};
                data = {
                        "AddCashBreakDown": 1,
                        "collectionDate": collectionDate,
                        "thousand": thousand,
                        "byfivehundred": byfivehundred,
                        "bytwohundred":bytwohundred,
                        "byonehundred":byonehundred,
                        "byfifty" : byfifty,
                        "bytwenty" : bytwenty,
                        "byten" : byten,
                        "byfive" : byfive,
                        "total" : total,
                        "cbid" : cbid
                };
                $.ajax({
                    url: "/JLOFinancial/methods/cashbreakdownController.php",
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        if (response.includes("Successful")) {
                            swal({
                                title: "Cash Breakdown successfully Saved!",
                                timer: 1400,
                                type: 'success',
                                showConfirmButton: true
                            });
                            $('#totalCollection').val('₱ ' + total.toLocaleString());
                            $("#cashBreakdownModal").modal('hide');
                        } else {
                            swal({
                                title: 'An Error Occurred!',
                                text: response,
                                timer: 1400,
                                type: 'error',
                                showConfirmButton: true
                            });
                            console.log(response);
                        }
                    }
                });
    });
</script>

</html>













<!-- junks -->
<!-- 
<i>JLO Financial Advisory Services</i><br>
        <b>Accounts Collection Report</b>
        <div class="row">
            <div class="col-md-6">
                <table>
                    <tr>
                        <td style="text-align:left; width:60%"><b>Last Post Date:</b></td>
                        <td>October 18, 2023</td>
                    </tr>
                    <tr>
                        <td style="text-align:left"><b>Collection Date:</b></td>
                        <td>October 19, 2023</td>
                    </tr>
                    <tr>
                        <td style="text-align:left"><b>Unit Code:</b></td>
                        <td>October 18, 2023</td>
                    </tr>
                    <tr>
                        <td style="text-align:left"><b>Collector</b></td>
                        <td>October 18, 2023</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table>
                    <tr>
                        <td style="text-align:left; width:60%"><b>Total Collection:</b></td>
                        <td style="width:40%; border-bottom: 1px solid black"></td>
                    </tr>
                    <tr>
                        <td style="text-align:left"><b>P.O Collection:</b></td>
                        <td style="width:40%; border-bottom: 1px solid black"></td>
                    </tr>
                    <tr>
                        <td style="text-align:left"><b>Past Due Collection:</b></td>
                        <td style="width:40%; border-bottom: 1px solid black"></td>
                    </tr>
                    <tr>
                        <td style="text-align:left"><b>Signature</b></td>
                        <td style="width:40%; border-bottom: 1px solid black"></td>
                    </tr>
                </table>
            </div>
        </div>
        <table class="my-3" width="100%">
            <thead>
                <tr>
                    <th style="text-align:center">No.</th>
                    <th style="text-align:center">Account Name</th>
                    <th style="text-align:center">Payment</th>
                    <th style="text-align:center">Daily Payment</th>
                    <th style="text-align:center">Loan Balance</th>
                    <th style="text-align:center">Total Payments</th>
                    <th style="text-align:center">Penalties</th>
                    <th style="text-align:center">Absences / Delinquent</th>
                    <th style="text-align:center">Maturity Date</th>
                    <th style="text-align:center">Last Date Paid</th>
                    <th style="text-align:center"># of Days Delinquent</th>
                </tr>
            </thead>
        </table> -->