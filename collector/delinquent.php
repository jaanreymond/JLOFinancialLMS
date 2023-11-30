<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delinquent | JLO</title>
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
        where customerloanid = ".$custLoanId);
         $resultCustomerLoanDetails = mysqli_fetch_all($customerLoanQuery, MYSQLI_ASSOC);

         $delinquentQuery = mysqli_query($db, "SELECT * FROM `delinquent` 
                                          where CustomerId = ".$custId." AND LoanId =". $custLoanId ."");

    ?>

     <!-- Content -->
 <div class="container flex-grow-1 container-p-y">
         <div class="card">
                <div class="b-block my-3 mx-4">
                    <a href="./customerloans.php?id=<?php echo $custId; ?>" class="btn btn-sm btn-outline-secondary" style="display:inline-block"><i class="bx bx-left-arrow-alt"></i></a>
                    <h5 class="text-center card-header">Delinquent</h5>
                </div>
                <div class="row mx-3 mb-3">
                <div class="col-md-6">
                    <table>
                                    <tr>
                                            <td style="text-align:right">Customer Name:</td>
                                            <td>&nbsp; <b><?php echo $resultCustomerDetails[0]['LastName'].', '.$resultCustomerDetails[0]['FirstName']; ?></b></td>
                                 </tr>
                    </table>
                </div>
                <div class="col-md-6">
                        <button style="float:right" type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addDelinquentModal">
                          <i class="bx bx-user-plus"></i> &nbsp;Add Delinquent
                        </button>
                </div>
             

                     
                </div>

                <div class="container text-nowrap mb-3 py-2" >
                   
                <table id="delinquencyTable" width="100%" class="table table-bordered table-hover mb-5">
                                <thead>
                                <tr class="bg-primary">
                                    <th style='text-align:center;color:#fff'><b>No.</b></th>
                                    <th style="color:#fff"><b>Delinquency Date</b></th>
                                    <th style="color:#fff"><b>Amount</b></th>
                                    <th style="color:#fff"><b>Status</b></th>
                                    <th style="color:#fff;text-align:center"><b>Actions</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                                          <?php
                                                                $no = 1;
                                                                while ($row = $delinquentQuery->fetch_assoc()) {
                                                                  
                                                                   $actionName = 'Recovered';
                                                                   $statusElem = '<b class="text-danger">Pending</b>';
                                                                   $action_element = '  <div class="dropdown">
                                                                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                                          </button>
                                                                          <div class="dropdown-menu">
                                                                            <a class="dropdown-item btnUpdateStatus">
                                                                            <i class="bx bx-check me-1"></i>Set to '.$actionName.'</a>
                                                                          </div>
                                                                        </div>';

                                                                   if($row['Status'] == 'Recovered'){
                                                                      $statusElem = '<b class="text-success">Recovered</b>';
                                                                      $actionName = 'Pending';
                                                                      $action_element = '  <div class="dropdown">
                                                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                                      </button>
                                                                      <div class="dropdown-menu">
                                                                        <a class="dropdown-item btnUpdateStatus">
                                                                        <i class="bx bx-block me-1"></i>Set to '.$actionName.'</a>
                                                                      </div>
                                                                    </div>';
                                                                   }

                                                                   

                                                                    echo "
                                                                    <tr class='text-center' row-id='" . $row['DelinquentId'] . "' row-status='".$row['Status']."'>
                                                                        <td style='text-align:center'>" . $no . "</td>
                                                                        <td style='text-align:left' ref='" . $row['DelinquencyDate'] . "'>" . $row['DelinquencyDate'] . "</td>
                                                                        <td style='text-align:left' ref='" . $row['Amount'] . "'>₱ " . $row['Amount'] . "</td>
                                                                        <td style='text-align:left' ref='" . $row['Status'] . "'>" . $statusElem . "</td>
                                                                        <td style='text-align:center'>" . $action_element . "</td>
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

      <!-- delinquent modal -->
 <div class="col-lg-4 col-md-3">
                      <div class="mt-3">
                        <!-- Modal -->
                        <div class="modal fade" id="addDelinquentModal" data-bs-backdrop="static" tabindex="-1">
                          <div class="modal-dialog">
                            <form class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="backDropModalTitle">New Delinquent</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                
                              <div class="row">
                                  <div class="col mb-3">
                                     <label for="exampleFormControlSelect1" class="form-label">Delinquency Date<span class="text-danger">*</span></label>
                                     <div class="input-group">
                                     <input type="text" id="customerId" value="<?php echo $custId; ?>" hidden/>
                                     <input type="text" id="customerLoanId" value="<?php echo $custLoanId; ?>" hidden/>
                                     <input type="date" id="delinquencyDate" class="form-control" value="<?php echo date('Y-m-d'); ?>"  placeholder="Enter Delinquency Date" aria-label="DelinquencyDate" autofocus/>
                                    </div>
                                  </div>
                                </div>

                                
                                <div class="row">
                                  <div class="col mb-3">
                                     <label for="exampleFormControlSelect1" class="form-label">Daily Amount<span class="text-danger">*</span></label>
                                     <div class="input-group">
                                        <span class="input-group-text">₱</span>
                                        <input type="number" id="dailyAmount" class="form-control" value="<?php echo $resultCustomerLoanDetails[0]['DailyPayment'] ?>" placeholder="Enter Amount Paid" aria-label="Amount" autofocus/>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col mb-3">
                                     <label for="exampleFormControlSelect1" class="form-label">Status<span class="text-danger">*</span></label>
                                      <select class="form-select" id="status" aria-label="Default select example">
                                        <option value="Pending" selected>Pending</option>
                                        <option value="Recovered">Recovered</option>
                                      </select>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="button" class="btn btn-primary" id="createBtn">Create Delinquent</button>
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
            
            $('#delinquencyTable').dataTable();

        $('#createBtn').on('click', function(){

            var delinquencyDate = $('#delinquencyDate').val();
            var status = $('#status').val();
            var dailyAmount = $('#dailyAmount').val();
            var customerId = $('#customerId').val();
            var customerLoanId = $('#customerLoanId').val();

            var data = {};
            data = {
                    "AddDelinquent": 1,
                    "delinquencyDate": delinquencyDate,
                    "status": status,
                    "dailyAmount": dailyAmount,
                    "customerId":customerId,
                    "customerLoanId":customerLoanId
            };

            $.ajax({
                url: "/JLOFinancial/methods/delinquentController.php",
                type: 'POST',
                data: data,
                success: function(response) {
                    if (response.includes("Successful")) {
                        swal({
                            title: "Deliquent record successfully Added!",
                            timer: 1400,
                            type: 'success',
                            showConfirmButton: true
                        });

                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);

                    } else {
                      console.log(response);
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


         $(document).on("click", ".btnUpdateStatus", function(e) {
                $id = e.target.closest("tr").getAttribute("row-id");
                $stats = e.target.closest("tr").getAttribute("row-status");
                
                // $statsval = ($stats == '0' ? 1 : 0);
                $statsMessage = ($stats == 'Pending' ? 'Recovered' : 'Pending');
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
                            url: "/JLOFinancial/methods/delinquentController.php",
                            type: 'POST',
                            data: {
                                "UpdateStatus": 1,
                                "delinquentId": $id,
                                "status": $statsMessage
                            },
                            success: function(response) {
                              console.log(response);
                                if (response.includes("error")) {
                                    swal("Error Encountered", "Record cannot be updated.", "error");
                                } else {
                                    swal({
                                        title: "Status successfully set to "+$statsMessage+".",
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
    });
</script>
</html>