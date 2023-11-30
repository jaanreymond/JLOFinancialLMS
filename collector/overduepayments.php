<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overdue Payments | JLO</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/photologo.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

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

    <link href="../assets/plugins/sweet-alert/sweetalert.min.css" rel="stylesheet" type="text/css"/>
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

        $customerPayment = mysqli_query($db, "SELECT p.*, c.*, cl.Balance as `Balance`, u.FirstName as `userfname`, u.LastName as `userlname` FROM `payment` p
                                      INNER JOIN `customer` c on c.customerid = p.customerid
                                      INNER JOIN `customerloan` cl on cl.customerloanid = p.customerloanid
                                      INNER JOIN `users` u on u.userid = p.collectorid 
                                      where IsVoid = 0 AND p.IsOverdued = 1 ORDER BY PaymentDate DESC");
    ?>

     <!-- Content -->

     <div class="container flex-grow-1 container-p-y">
         <div class="card">
                <h5 class="card-header">Overdue Payments</h5>

                <div class="container text-nowrap mb-3 py-3" >
                   
                <table id="paymentTable" width="100%" class="table table-hover mb-5">
                                <thead>
                                <tr class="bg-danger">
                                    <th style='text-align:center;color:#fff'><b>No.</b></th>
                                    <th style="color:#fff"><b>Account</b></th>
                                    <th style="color:#fff"><b>Amount Paid</b></th>
                                    <th style="color:#fff"><b>Penalty</b></th>
                                    <th style="color:#fff"><b>Date Paid</b></th>
                                    <th style="color:#fff"><b>Balance</b></th>
                                    <th style="color:#fff"><b>P. Method</b></th>
                                    <th style="color:#fff"><b>Collector</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                                          <?php
                                                                $no = 1;
                                                                while ($row = $customerPayment->fetch_assoc()) {
                                                                    echo "
                                                                    <tr class='text-center' row-id='" . $row['PaymentId'] . "' row-status='".$row['IsVoid']."'>
                                                                        <td style='text-align:center'>" . $no . "</td>
                                                                        <td style='text-align:left' ref='" . $row['CustomerId'] . "'>" . $row['LastName'] .', '. $row['FirstName'] . "</td>
                                                                        <td style='text-align:left' ref='" . $row['PaymentAmount'] . "'>₱ " . $row['PaymentAmount'] . "</td>
                                                                        <td style='text-align:left' ref='" . $row['Penalty'] . "'>₱ " . $row['Penalty'] . "</td>
                                                                        <td style='text-align:left' ref='" . $row['PaymentDate'] . "'>" . gmdate("M d, Y", strtotime($row['PaymentDate'])) . "</td>
                                                                        <td style='text-align:left' ref='" . $row['Balance'] . "'>₱ " . $row['Balance'] . "</td>
                                                                        <td style='text-align:left' ref='" . $row['PaymentMethod'] . "'>" . $row['PaymentMethod'] . "</td>
                                                                        <td style='text-align:left' ref='" . $row['CollectorId'] . "'>" . $row['userfname'] .' '. $row['userlname'] . "</td>
                                                                    </tr>";
                                                                    $no++;
                                                                }
                                                            ?>

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
<script>
    $(document).ready(function(){
            $('#d-menu').removeClass('active');
            $('#mu-menu').removeClass('active');
            $('#cm-menu').removeClass('active');
            $('#cr-menu').removeClass('active');
            $('#ph-menu').removeClass('active');
            $('#od-menu').addClass('active');
            $('#la-menu').removeClass('active');
            $('#overduePaymentsMenuLink').attr({'href':'javascript:void(0);'});
            $('#paymentTable').dataTable();
    });
</script>
</html>