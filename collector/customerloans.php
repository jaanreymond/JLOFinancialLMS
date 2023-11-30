<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers | JLO</title>
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
        $custId = $_GET['id'];
        $customerQuery = mysqli_query($db, "SELECT * FROM `customer` c
                                            where c.customerid = ".$custId);
        $resultCustomerDetails = mysqli_fetch_all($customerQuery, MYSQLI_ASSOC);

        $customerLoanQuery = mysqli_query($db, "SELECT * FROM `customerloan` 
        where customerid = ".$custId);
    ?>

     <!-- Content -->

     <div class="container flex-grow-1 container-p-y">
         <div class="card">
            <div class="b-block my-3 mx-4">
                <a href="./customer.php" class="btn btn-sm btn-outline-secondary" style="display:inline-block"><i class="bx bx-left-arrow-alt"></i></a>
            </div>
                <h5 class="card-header text-center" style="padding:5px !important">Customer Loans</h5>
                <div class="mx-3 my-2">
                    <table>
                        <tr>
                            <td style="text-align:right">Customer Name:</td>
                            <td>&nbsp; <?php echo $resultCustomerDetails[0]['LastName'].', '.$resultCustomerDetails[0]['FirstName']; ?></td>
                        </tr>
                        <tr>
                            <td style="text-align:right">Mobile Number:</td>
                            <td>&nbsp; <?php echo $resultCustomerDetails[0]['MobileNumber']; ?></td>
                        </tr>
                        <tr>
                            <td style="text-align:right">Email:</td>
                            <td>&nbsp; <?php echo $resultCustomerDetails[0]['EmailAddress']; ?></td>
                        </tr>
                    </table>
                </div>
                <hr class="mb-0"><br>
                <div id="userTable" class="table-responsive">
                            <table class="table table-bordered table-hover mb-5">
                                <thead>
                                <tr>
                                    <th>Loan Amount</th>
                                    <th>Loan Term</th>
                                    <th>Date Loaned</th>
                                    <th>Balance</th>
                                    <th>Daily Payment</th>
                                    <th>Status</th>
                                    <th style="text-align:center">Actions</th>
                                    <!-- <th style='text-align:center'>Approved By</th> -->
                                </tr>
                                </thead>
                                <tbody>
                                         <?php
                                                                while ($row = $customerLoanQuery->fetch_assoc()) {
                                                                    
                                                                    $action_element = '';

                                                                    
                                                                    $status_element = '<b class="text-success">Active</b>';
                                                                    $overdued_element = '<button class="btn btn-sm btn-danger btnIsOverdued"><i class="bx bx-calendar-exclamation"></i>&nbsp; Set as Overdued</button>';

                                                                    if($row['IsOverdued'] == 1){
                                                                        $status_element = '<b class="text-warning">Overdued</b>';
                                                                        $overdued_element = '<button class="btn btn-sm btn-success btnIsOverdued"><i class="bx bx-check"></i>&nbsp; Set as Active</button>';
                                                                    }
                                                                    
                                                                    if($row['Balance'] != 0 ){
                                                                        $action_element = '
                                                                        <div  class="btn-group" role="group">
                                                                            <a class="btn btn-sm btn-primary " href="./customerloandetail.php?id='.$row['CustomerId'].'&clId='.$row['CustomerLoanId'].'" ><i class="bx bx-detail"></i>&nbsp; Details </a>
                                                                            <a class="btn btn-sm btn-warning " href="./delinquent.php?id='.$row['CustomerId'].'&clId='.$row['CustomerLoanId'].'" ><i class="bx bx-user-x"></i>&nbsp; Delinquent </a>
                                                                            '.$overdued_element.'
                                                                            </div>';
                                                                    }


                                                                    echo "
                                                                    <tr  class='text-center' row-id='" . $row['CustomerLoanId'] . "' row-status ='".$row['IsOverdued']."'>
                                                                        <td style='text-align:left' ref='" . $row['LoanAmount'] . "'>₱ " . $row['LoanAmount'] . "</td>
                                                                          <td style='text-align:left' ref='" . $row['LoanTerm'] . "'>" . $row['LoanTerm'] . " Months</td>
                                                                        <td style='text-align:left' ref='" . $row['DateCreated'] . "'>" . gmdate("M d, Y", strtotime($row['DateCreated'])) . "</td>
                                                                        <td style='text-align:left' ref='" . $row['Balance'] . "'>₱ " . $row['Balance'] . "</td>
                                                                        <td style='text-align:left' ref='" . $row['DailyPayment'] . "'>₱ " . $row['DailyPayment'] . "</td>
                                                                        <td style='text-align:left'>" . $status_element . "</td>
                                                                        <td style='text-align:center' ref='" . $row['DailyPayment'] . "'>" . $action_element . "</td>
                                                                    </tr>";
                                                                        
                                                                }
                                                            ?>

                                </tbody>
                            </table>
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
            $('#cm-menu').addClass('active');
            $('#cr-menu').removeClass('active');
            $('#ph-menu').removeClass('active');
            $('#la-menu').removeClass('active');
            $('#customerMenuLink').attr({'href':'javascript:void(0);'});


            $(document).on("click", ".btnIsOverdued", function(e) {
                $id = e.target.closest("tr").getAttribute("row-id");
                $stats = e.target.closest("tr").getAttribute("row-status");

                $statsval = ($stats == '0' ? 1 : 0);
                $statsMessage = ($stats == '0' ? 'Overdued' : 'Active');
                swal({
                    title: "Are you sure you want to set this status to "+$statsMessage+"?",
                    // text: "You will not be able to recover this user after deletion!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Confirm",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "/JLOFinancial/methods/loanController.php",
                            type: 'POST',
                            data: {
                                "SetOverdued": 1,
                                "loanId": $id,
                                "status": $statsval
                            },
                            success: function(response) {
                              console.log(response);
                                if (response.includes("error")) {
                                    swal("Error Encountered", "Loan cannot be updated.", "error");
                                } else {
                                    swal({
                                        title: "Status successfully set to "+$statsMessage+".",
                                        timer: 1400,
                                        type: 'success',
                                        showConfirmButton: true
                                    });0

                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 1500)
                                }
                            }
                        });
                    } else {
                        swal.close();
                    }
                });
              
            })

    });
</script>
</html>