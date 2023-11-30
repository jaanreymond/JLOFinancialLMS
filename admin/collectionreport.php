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

    <?php include($path . "/JLOFinancial/comp/adminNavbar.php") ?>

    <?php
            $result = mysqli_query($db, "SELECT * FROM `users` WHERE Role='Collector' and IsActive = 1");
    ?>

    <!-- Content -->
    <div class="container container-p-y">
        <div class="card">
            <h4 class="card-header">Monthly Collection Report</h4>
            <div class="container text-nowrap py-3">
                <div class="row mb-2">
                <div class="col-md-3">
                        <span>Collector</span>
                        <select id="collectorSelected" class="form-control" >
                        <?php 
                            $data = '';
                            while ($row = $result->fetch_assoc()) {
                                $data .= '<option value='.$row['UserId'].'>'.$row['LastName'].', '. $row['FirstName'] .'</option>';
                            }
                            echo $data;
                        ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <span>Date From:</span>
                        <input class="form-control" id="dtFrom" type="date" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="col-md-3">
                        <span>Date To:</span>
                        <input class="form-control" id="dtTo" type="date" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="col-md-3" style="align-self:end">
                        <button class="btn btn-primary" id="filterBtn"><i class="bx bx-filter"></i> &nbsp;Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container flex-grow-1 container-p-y" id="maindiv">
        <div class="card">
            <div class=" my-2 mx-2" style="text-align:right">
                 <button class="btn btn-primary" id="printBtn"><i class="bx bx-printer"></i> &nbsp;Print Report</button>
            </div>
            <div class="container text-nowrap py-3" id="printDiv">
                <i>JLO Financial Advisory Services</i><br>
                <b>Accounts Collection Report</b>
                <div class="row">
                    <div class="col-md-6">
                        <table>
                            <tr>
                                <td style="text-align:left; width:60%"><b>Last Post Date:</b></td>
                                <td><b id="dtoid"></b></td>
                            </tr>
                            <tr>
                                <td style="text-align:left"><b>Collection Date:</b></td>
                                <td><b id="dfromid"></b></td>
                            </tr>
                            <tr>
                                <td style="text-align:left"><b>Unit Code:</b></td>
                                <td>A1</td>
                            </tr>
                            <tr>
                                <td style="text-align:left"><b>Collector</b></td>
                                <td><b id="collectornameid"></b></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table>
                            <tr>
                                <td style="text-align:left; width:60%"><b>Total Collection:</b></td>
                                <td style="width:40%; border-bottom: 1px solid black"><b id="totalcollectionid"></b></td>
                            </tr>
                            <tr>
                                <td style="text-align:left"><b>P.O Collection:</b></td>
                                <td style="width:40%; border-bottom: 1px solid black"></td>
                            </tr>
                            <tr>
                                <td style="text-align:left"><b>Past Due Collection:</b></td>
                                <td style="width:40%; border-bottom: 1px solid black"><b id="pastduecollectionid"></b></td>
                            </tr>
                            <tr>
                                <td style="text-align:left"><b>Signature</b></td>
                                <td style="width:40%; border-bottom: 1px solid black"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <table id="collectionTable" class="my-3 table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th style="text-align:center">#</th>
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
                    <tbody>

                    </tbody>
                </table> 
            </div>
        </div>
    </div>
 



    <?php include($path . "/JLOFinancial/comp/footer.php") ?>
</body>
<script src="../assets/vendor/js/jquery-370.js"></script>
<script src="../assets/vendor/js/jquery.dataTables.min.js"></script>
<script src="../assets/vendor/js/dataTables.bootstrap5.min.js"></script>
<script src="../assets/js/jQuery.print.js"></script>

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

        $('#printBtn').on('click', function(){
            $('#maindiv').removeClass("container flex-grow-1 container-p-y");
            $('#printDiv').removeClass("container text-nowrap py-3");
            $('#printBtn').hide();
           $('#printDiv').print();
           $('#printBtn').show();
           $('#maindiv').addClass("container flex-grow-1 container-p-y");
           $('#printDiv').addClass("container text-nowrap py-3");
        });


        $('#filterBtn').on('click', function(){

            var CollectorId = $('#collectorSelected').val();
            var dtFrom = $('#dtFrom').val();
            var dtTo = $('#dtTo').val();
            console.log(CollectorId)
            console.log(dtFrom)
            console.log(dtTo)
            $.ajax({
                            url: "/JLOFinancial/methods/collectionreportController.php",
                            type: 'POST',
                            data: {
                                "CollectionReportData": 1,
                                "CollectorId": CollectorId,
                                "dFrom": dtFrom,
                                "dTo": dtTo,
                            },
                            success: function(response) {
                                $('#collectionTable tbody').html('');
                                var data = JSON.parse(response);
                                var collectionData = '';
                                var counter = 1;
                                console.log(data);
                                for(var i = 0; i < data.ActiveAccounts.length; i++){
                                    collectionData += '<tr><td class="text-center">'+counter+'</td>'
                                    + '<td>'+data.ActiveAccounts[i].CustomerName+'</td>'
                                    + '<td>'+data.ActiveAccounts[i].RangePayment+'</td>'
                                    + '<td>'+data.ActiveAccounts[i].DailyPayment+'</td>'
                                    + '<td>'+data.ActiveAccounts[i].Balance+'</td>'
                                    + '<td>'+data.ActiveAccounts[i].TotalPayments +'</td>'
                                    + '<td>'+data.ActiveAccounts[i].Penalty +'</td>'
                                    + '<td>'+data.ActiveAccounts[i].DeliquencyAmount+'</td>'
                                    + '<td>'+data.ActiveAccounts[i].MaturityDate +'</td>'
                                    + '<td>'+data.ActiveAccounts[i].LastDatePaid +'</td>'
                                    + '<td>'+data.ActiveAccounts[i].DelinquentDays+'</td>'
                                    + '</tr>';                        
                                    counter ++;
                                    console.log(collectionData);
                                } 
                                
                                $('#collectionTable tbody').append(collectionData);
                                
                                $('#dtoid').html(dtTo);
                                $('#dfromid').html(dtFrom);
                                $('#collectornameid').html(data.CollectorName);
                                $('#totalcollectionid').html(data.TotalCollection);
                                $('#pastduecollectionid').html(data.TotalPastDued);
                            }
                        });
             })
    });
</script>

</html>










<!-- 


   -->