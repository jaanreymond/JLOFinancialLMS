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
        $custLoanId = $_GET['clId'];

        $customerQuery = mysqli_query($db, "SELECT * FROM `customer` c
                                            where c.customerid = ".$custId);
        $resultCustomerDetails = mysqli_fetch_all($customerQuery, MYSQLI_ASSOC);

        $customerLoanQuery = mysqli_query($db, "SELECT * FROM `customerloan` 
                                         where CustomerLoanId = ".$custLoanId);

        $resultCustomerLoan = mysqli_fetch_all($customerLoanQuery, MYSQLI_ASSOC);


        $customerPayment = mysqli_query($db, "SELECT * FROM `payment` p
                                              INNER JOIN `users` u on u.userid = p.collectorid 
                                              where CustomerLoanId = ".$custLoanId);
    ?>

     <!-- Content -->

     <div class="container flex-grow-1 container-p-y">
         <div class="card">
            <div class="b-block my-3 mx-4">
                <a href="./customerloans.php?id=<?php echo $custId; ?>" class="btn btn-sm btn-outline-secondary" style="display:inline-block"><i class="bx bx-left-arrow-alt"></i></a>
            </div>
                <div class="mx-3 mb-3">
                      <button
                          style="float:right"
                          type="button"
                          class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#addPaymentModal">
                          <i class="bx bx-plus"></i> &nbsp;Add New Payment
                        </button>
                </div>
                <div class="mx-3 my-2 row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h6>Customer Details</h6>
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
                                <hr >
                                <table>
                                     <tr>
                                        <td style="text-align:right">Status:</td>
                                        <td>
                                                <?php 
                                                if($resultCustomerLoan[0]['IsOverdued'] == 0){
                                                    echo '&nbsp; <b class="text-success">Active</b>';
                                                }else{
                                                    echo '&nbsp; <b class="text-danger">Overdued</b>';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right">Loan Term:</td>
                                        <td>&nbsp; <?php echo $resultCustomerLoan[0]['LoanTerm']; ?> Days</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right">Loan Date:</td>
                                        <td>&nbsp; <?php echo  gmdate("M d, Y", strtotime($resultCustomerLoan[0]['DateCreated'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right">Maturity Date:</td>
                                        <td>&nbsp; <?php echo  date('M d, Y', strtotime($resultCustomerLoan[0]['DateCreated'] . ' + '.$resultCustomerLoan[0]['LoanTerm'].' days')); ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right">Daily Payment:</td>
                                        <td>&nbsp; ₱ <?php echo $resultCustomerLoan[0]['DailyPayment']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right">Remaining Balance:</td>
                                        <td><h5 style="margin-bottom:0px">&nbsp; ₱ <?php echo $resultCustomerLoan[0]['Balance'] ?></h5></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                               <h6>Loan Details</h6>
                                <table>
                                    <tr>
                                        <td style="text-align:right">Notarial Fee</td>
                                        <td>&nbsp; ₱ <?php echo $resultCustomerLoan[0]['NotarialFee'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right">Processing Fee:</td>
                                        <td>&nbsp; ₱ <?php echo $resultCustomerLoan[0]['ProcessingFee'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right">Service Fee:</td>
                                        <td>&nbsp; ₱ <?php echo $resultCustomerLoan[0]['ServiceFee'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right">Insurance:</td>
                                        <td>&nbsp; ₱ <?php echo $resultCustomerLoan[0]['Insurance'] ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right">Loan Amount:</td>
                                        <td>&nbsp; ₱ <?php echo $resultCustomerLoan[0]['LoanAmount'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right">Interest Rate:</td>
                                        <td>&nbsp; <?php 
                                        $totalInterest = $resultCustomerLoan[0]['LoanAmount'] * ($resultCustomerLoan[0]['InterestRate'] / 100);
                                        echo "₱ $totalInterest"." (16%)";
                                        
                                        ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right">Loan Total:</td>
                                        <td><h5 style="margin-bottom:0px">&nbsp; ₱ <?php echo $resultCustomerLoan[0]['LoanTotal'] ?></h5></td>
                                    </tr>
                                 </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <hr class="mb-0"><br>
                <h5 class="card-header text-center">Payment History</h5>
                <div id="paymentTable" class="container table-responsive table-bordered  text-nowrap">
                            <table class="table table-hover mb-5">
                                <thead>
                                <tr style="background-color: rgba(105, 108, 255, 0.16) !important; color: #696cff">
                                    <th>Amount Paid</th>
                                    <th>Penalty</th>
                                    <th>Date Paid</th>
                                    <th>Payment Method</th>
                                    <th>Collector</th>
                                    <th style="text-align:center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                                          <?php
                                                                while ($row = $customerPayment->fetch_assoc()) {
                                                                    
                                                                    $actionName = 'Set to Void';

                                                                    if($row['IsVoid'] != 0)
                                                                    {
                                                                        $actionName = 'Set to Valid';
                                                                    }

                                                                  if($row['IsVoid'] == 0)
                                                                  {

                                                                    $action_element = '  <div class="dropdown">
                                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                      <i class="bx bx-dots-vertical-rounded"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                      <a class="dropdown-item btnReceipt"><i class="bx bx-printer me-1"></i> Print Receipt</a>
                                                                      <a class="dropdown-item btnVoid">
                                                                      <i class="bx bx-block me-1"></i> '.$actionName.'</a>
                                                                    </div>
                                                                  </div>';

                                                                    echo "
                                                                    <tr class='text-center' row-id='" . $row['PaymentId'] . "' row-status='".$row['IsVoid']."'>
                                                                        <td style='text-align:left' ref='" . $row['PaymentAmount'] . "'>₱ " . $row['PaymentAmount'] . "</td>
                                                                        <td style='text-align:left' ref='" . $row['Penalty'] . "'>₱ " . $row['Penalty'] . "</td>
                                                                        <td style='text-align:left' ref='" . $row['PaymentDate'] . "'>" . gmdate("M d, Y H:i:s", strtotime($row['PaymentDate'])) . "</td>
                                                                        <td style='text-align:left' ref='" . $row['PaymentMethod'] . "'>" . $row['PaymentMethod'] . "</td>
                                                                        <td style='text-align:left' ref='" . $row['CollectorId'] . "'>" . $row['LastName'] .', '. $row['FirstName'] . "</td>
                                                                        <td style='text-align:center'>" . $action_element . "</td>
                                                                    </tr>";
                                                                  }
                                                                  else{

                                                                    $action_element = '<div class="dropdown">
                                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                      <i class="bx bx-dots-vertical-rounded"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                      <a class="dropdown-item btnReceipt"><i class="bx bx-printer me-1"></i> Print Receipt</a>
                                                                      <a class="dropdown-item btnVoid">
                                                                      <i class="bx bx-check-shield me-1"></i> '.$actionName.'</a>
                                                                    </div>
                                                                    <div>
                                                                    </dov
                                                                  </div>';

                                                                    echo "
                                                                        <tr  class='text-center text-danger' row-id='" . $row['PaymentId'] . "' row-status='".$row['IsVoid']."'>
                                                                            <td style='text-align:left' ref='" . $row['PaymentAmount'] . "'>₱ " . $row['PaymentAmount'] . "</td>
                                                                            <td style='text-align:left' ref='" . $row['Penalty'] . "'>₱ " . $row['Penalty'] . "</td>
                                                                            <td style='text-align:left' ref='" . $row['PaymentDate'] . "'>" . gmdate("M d, Y H:i:s", strtotime($row['PaymentDate'])) . "</td>
                                                                            <td style='text-align:left' ref='" . $row['PaymentMethod'] . "'>" . $row['PaymentMethod'] . "</td>
                                                                            <td style='text-align:left' ref='" . $row['CollectorId'] . "'>" . $row['LastName'] .', '. $row['FirstName'] . "</td>
                                                                            <td style='text-align:center'>" . $action_element . "</td>
                                                                        </tr>";
                                                                  }

                                                                }
                                                            ?>

                                </tbody>
                            </table>
                    </div>
              </div>
              
    <?php include($path . "/JLOFinancial/comp/footer.php") ?>

    <!-- payment modal -->
 <!-- Modal Backdrop -->
                <div class="col-lg-4 col-md-3">
                      <div class="mt-3">
                        <!-- Modal -->
                        <div class="modal fade" id="addPaymentModal" data-bs-backdrop="static" tabindex="-1">
                          <div class="modal-dialog">
                            <form class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="backDropModalTitle">New Payment</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                
                              <div class="row">
                                  <div class="col mb-3">
                                     <label for="exampleFormControlSelect1" class="form-label">Amount Paid<span class="text-danger">*</span></label>
                                     <div class="input-group">
                                     <input type="text" id="customerId" value="<?php echo $resultCustomerLoan[0]['CustomerId']; ?>" hidden/>
                                     <input type="text" id="customerLoanId" value="<?php echo $resultCustomerLoan[0]['CustomerLoanId']; ?>" hidden/>
                                     <input type="text" id="loanStatus" value="<?php echo $resultCustomerLoan[0]['IsOverdued'] ?>" hidden>
                                        <span class="input-group-text">₱</span>
                                        <input type="number" id="amountPaid" class="form-control" placeholder="Enter Amount Paid" aria-label="Amount" autofocus/>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col mb-3">
                                     <label for="exampleFormControlSelect1" class="form-label">Payment Method<span class="text-danger">*</span></label>
                                      <select class="form-select" id="paymentMethod" aria-label="Default select example">
                                        <option value="Cash" selected>Cash</option>
                                        <option value="BanktoBank">Bank to Bank</option>
                                        <option value="Gcash">Gcash</option>
                                        <!-- <option value="Encoder">Encoder</option> -->
                                      </select>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col mb-3">
                                     <label for="exampleFormControlSelect1" class="form-label">Set Penalty Amount</label>
                                     <div class="input-group">
                                        <span class="input-group-text">₱</span>
                                        <input type="number" id="penalty" class="form-control" value="0.00" placeholder="Enter Amount Paid" aria-label="Amount" autofocus/>
                                    </div>
                                  </div>
                                </div>
                                
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="button" class="btn btn-primary" id="saveBtn">Save Payment</button>
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
    $(document).ready(function(){
            $('#d-menu').removeClass('active');
            $('#mu-menu').removeClass('active');
            $('#cm-menu').addClass('active');
            $('#la-menu').removeClass('active');
            $('#cr-menu').removeClass('active');
            $('#ph-menu').removeClass('active');
            $('#customerMenuLink').attr({'href':'javascript:void(0);'});

            $(document).on("click", ".btnVoid", function(e) {
                $id = e.target.closest("tr").getAttribute("row-id");
                $stats = e.target.closest("tr").getAttribute("row-status");
                $statsval = ($stats == '0' ? 1 : 0);
                $statsMessage = ($stats == '0' ? 'Void' : 'Valid');
                swal({
                    title: "Are you sure you want to set this payment to "+$statsMessage+"?",
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
                            url: "/JLOFinancial/methods/paymentController.php",
                            type: 'POST',
                            data: {
                                "VoidPayment": 1,
                                "paymentId": $id,
                                "status": $statsval
                            },
                            success: function(response) {
                              console.log(response);
                                if (response.includes("error")) {
                                    swal("Error Encountered", "Payment cannot be updated.", "error");
                                } else {
                                    swal({
                                        title: "Payment successfully set to "+$statsMessage+".",
                                        timer: 1400,
                                        type: 'success',
                                        showConfirmButton: true
                                    });

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

            
            $(document).on("click", ".btnReceipt", function(e) {
                $id = e.target.closest("tr").getAttribute("row-id");
                        $.ajax({
                            url: "/JLOFinancial/methods/paymentController.php",
                            type: 'POST',
                            data: {
                                "GetReceipt": 1,
                                "paymentId": $id,
                            },
                            success: function(response) {
                              var pdata = JSON.parse(response);
                              
                              var receiptContent = `
                                            <style>
                                        /* Define CSS styles for the receipt */
                                        .receipt {
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            color: #333;
                                            margin: 10px;
                                            border: 2px solid #000;
                                            padding: 20px;
                                            background-color: #f9f9f9;
                                            box-shadow: 3px 3px 5px #888888;
                                        }
                                        h3 {
                                            font-size: 24px;
                                            color: #000;
                                            border-bottom: 2px solid #000;
                                            padding-bottom: 10px;
                                        }
                                        p {
                                            margin: 5px 0;
                                            fontsize: 13px;
                                        }
                                    </style>
                              
                                    <div class="receipt">
                                        <h3 style="text-align:center">Payment Receipt</h3>
                                        <h5><i>JLO Financial Advisory Services</i></h5>
                                        <p>Collector: <b>`+pdata['userfname'] +` ` + pdata['userlname']+`</b></p><br>
                                        <div>
                                            <p>Date: `+pdata['PaymentDateSTR']+`</p>
                                            <p>Account: <b>`+pdata['FirstName'] +` ` + pdata['LastName']+`</b></p>
                                            <p>Amount: ₱ `+ pdata['PaymentAmount']+`</p>
                                            <p>Payment Method: `+ pdata['PaymentMethod']+`</p>
                                            <p>Transaction ID: `+pdata['PaymentId']+`</p>
                                        </div>
                                    </div>`;
                                // Create a new window or iframe to display the receipt content
                                var printWindow = window.open('', '', 'width=800,height=600');
                                printWindow.document.open();
                                printWindow.document.write(receiptContent);
                                printWindow.document.close();

                                // Initiate the print dialog
                                printWindow.print();
                                printWindow.close();
                            }
                        });
            })

            $('#saveBtn').on('click', function(){

                var amountPaid = $('#amountPaid').val();
                var paymentMethod = $('#paymentMethod').val();
                var penalty = $('#penalty').val();
                var customerId = $('#customerId').val();
                var customerLoanId = $('#customerLoanId').val();
                var loanStatus = $('#loanStatus').val();

                if(amountPaid == '' || amountPaid == '0'){
                    swal("Payment Failed","Fill up all fields!","error");
                    return;
                }

                var data = {};
                data = {
                        "AddPayment": 1,
                        "amountPaid": amountPaid,
                        "paymentMethod": paymentMethod,
                        "penalty": penalty,
                        "customerId":customerId,
                        "customerLoanId":customerLoanId,
                        "loanStatus" : loanStatus
                };
                $.ajax({
                    url: "/JLOFinancial/methods/paymentController.php",
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        if (response.includes("Successful")) {
                            swal({
                                title: "Payment successfully Added!",
                                timer: 1400,
                                type: 'success',
                                showConfirmButton: true
                            });

                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);

                        } else {
                            swal({
                                title: 'An Error Occurred!',
                                text: response,
                                timer: 1400,
                                type: 'error',
                                showConfirmButton: true
                            });
                        }
                    }
                });
            })

    });
</script>
</html>