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
          
          if ($_SESSION['user-es']['Role'] != 'Admin') {
            header("Location: /JLOFinancial/auth.php");
        }
    ?>
    
    <?php include($path . "/JLOFinancial/comp/adminNavbar.php") ?>

    <?php 
        $custId = $_GET['id'];
        $customerQuery = mysqli_query($db, "SELECT * FROM `customer` c
                                     INNER JOIN `customeraddress` ca on ca.customeraddressid = c.addressid
                                     where c.customerid = ".$custId);
        $resultCustomerDetails = mysqli_fetch_all($customerQuery, MYSQLI_ASSOC);

        $customerLoanQuery = mysqli_query($db, "SELECT * FROM `customerloan`  cl
                                                INNER JOIN `users` u on u.UserId = cl.ApprovedById
                                                where customerid = ".$custId);

          $customerPayment = mysqli_query($db, "SELECT * FROM `payment` p
                                                INNER JOIN `users` u on u.userid = p.collectorid 
                                                where CustomerId = ".$custId);
    ?>

     <!-- Content -->

     <!-- <div class="container-fluid flex-grow-1 container-p-y">
         <div class="card">
           
        </div>
    </div> -->
    <div class="container-fluid flex-grow-1 container-p-y">
            <div class="b-block my-3 mx-4">
                <a href="./customer.php" class="btn btn-outline-secondary" style="display:inline-block"><i class="bx bx-left-arrow-alt"></i> Back</a>
            </div>
            <!-- <div class="b-block my-3 mx-4">
                 <h5 class="card-header">Customer Details</h5>
            </div> -->
                <div class="container-fluid">
                  <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills nav-fill mb-2" role="tablist">
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link active"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-pills-justified-home"
                          aria-controls="navs-pills-justified-home"
                          aria-selected="true">
                          <i class="tf-icons bx bx-user me-1"></i><span class="d-none d-sm-block"> Customer Information</span>
                        </button>
                      </li>
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-pills-justified-documents"
                          aria-controls="navs-pills-justified-documents"
                          aria-selected="false">
                          <i class="tf-icons bx bx-file me-1"></i><span class="d-none d-sm-block"> Uploaded Documents</span>
                        </button>
                      </li>
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-pills-justified-profile"
                          aria-controls="navs-pills-justified-profile"
                          aria-selected="false">
                          <i class="tf-icons bx bx-dollar-circle me-1"></i><span class="d-none d-sm-block"> Loans</span>
                        </button>
                      </li>
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-pills-justified-messages"
                          aria-controls="navs-pills-justified-messages"
                          aria-selected="false">
                          <i class="tf-icons bx bx-history me-1"></i><span class="d-none d-sm-block"> Payment History</span>
                        </button>
                      </li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">

<!-- start customer details -->

                      <h5 class="card-header">Customer Details</h5>
                      <hr class="my-3" />
                      <div class="row">
                          <div class="mb-3 col-md-4">
                            <label for="firstName" class="form-label">First Name</label>
                            <input
                              class="form-control"
                              type="text"
                              id="firstName"
                              name="firstName"
                              value='<?php echo $resultCustomerDetails[0]['FirstName'] ?>'
                              readonly/>
                          </div>
                          <div class="mb-3 col-md-4">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['LastName'] ?>' readonly/>
                          </div>
                          <div class="mb-3 col-md-4">
                            <label for="lastName" class="form-label">Age</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['Age'] ?>' readonly/>
                          </div>
                          <div class="mb-3 col-md-3">
                            <label for="lastName" class="form-label">Birth Date</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['DateOfBirth'] ?>' readonly/>
                          </div>
                          <div class="mb-3 col-md-3">
                            <label for="lastName" class="form-label">Birth Place</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['BirthPlace'] ?>' readonly/>
                          </div>
                          <div class="mb-3 col-md-3">
                            <label for="lastName" class="form-label">Gender</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['Gender'] ?>' readonly/>
                          </div>
                          <div class="mb-3 col-md-3">
                            <label for="lastName" class="form-label">Civil Status</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['CivilStatus'] ?>' readonly/>
                          </div>
                    </div>
                    <br class="my-2">
                     <h5 class="card-header">Contact Information</h5>
                     <hr class="my-3" />
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Email Address</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['EmailAddress'] ?>' readonly/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Contact Number</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['MobileNumber'] ?>' readonly/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Present Address</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['PresentAddress'] ?>' readonly/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">City</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['City'] ?>' readonly/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Province</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['Province'] ?>' readonly/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Zip Code</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['ZipCode'] ?>' readonly/>
                        </div>
                    </div>

                    <br class="my-2">
                     <h5 class="card-header">Income Information</h5>
                     <hr class="my-3" />
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Nature of Income</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['NatureOfIncome'] ?>' readonly/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Profession</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['Profession'] ?>' readonly/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Income Address</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['IncomeAddress'] ?>' readonly/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Daily Sales</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['DailySales'] ?>' readonly/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Monthly Earnings</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['MonthlyEarnings'] ?>' readonly/>
                        </div>
                    </div>

                    
                    <br class="my-2">
                     <h5 class="card-header">More Information</h5>
                     <hr class="my-3" />
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Father Name</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['FatherName'] ?>' readonly/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Father Profession</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['FatherProfession'] ?>' readonly/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">MotherName</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['MotherName'] ?>' readonly/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Mother Profession</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['MotherProfession'] ?>' readonly/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Spouse First Name</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['SpouseFname'] ?>' readonly/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Spouse Last Name</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['SpouseLname'] ?>' readonly/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Spouse Profession</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['SpouseProfession'] ?>' readonly/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Spouse Contact Number</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $resultCustomerDetails[0]['SpousePhoneNo'] ?>' readonly/>
                        </div>
                    </div>
<!-- end -->

                      </div>

                      <!-- start of uploaded documents -->
                      <div class="tab-pane fade" id="navs-pills-justified-documents" role="tabpanel">
                        
                        <h5 class="card-header">Uploaded Documents</h5><br>
                        <div class="row">
                          <div class="col-md-12">
                            <label for="">Document 1:</label>
                          </div>
                          <div class="col-md-12 text-center">
                            <img src="<?php echo '../custDocuments/'.$resultCustomerDetails[0]['FileName'] ?>" width="30%" height="300px" alt="">
                          </div>
                          <div class="col-md-12">
                            <hr>
                          </div>
                          <div class="col-md-12">
                            <label for="">Document 2:</label>
                          </div>
                          <div class="col-md-12 text-center">
                            <img src="<?php echo '../custDocuments/'.$resultCustomerDetails[0]['FileName2'] ?>" width="30%" height="300px" alt="">
                          </div>
                        </div>
                      </div>
                      <!-- end uploaded documents-->




                      <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                        
                      <!-- start of loans -->
                      <h5 class="card-header">Loans</h5><br>
                      <div id="userTable" class="table-responsive text-nowrap">
                            <table class="table mb-5">
                                <thead>
                                <tr style="background-color: rgba(105, 108, 255, 0.16) !important; color: #696cff">
                                    <th>Loan Amount</th>
                                    <th>Loan Term</th>
                                    <th>Date Loaned</th>
                                    <th>Balance</th>
                                    <th>Daily Payment</th>
                                    <th style='text-align:center'>Approved By</th>
                                </tr>
                                </thead>
                                <tbody>
                                         <?php
                                                                while ($row = $customerLoanQuery->fetch_assoc()) {
                                                              
                                                                    echo "
                                                                    <tr  class='text-center' row-id='" . $row['CustomerLoanId'] . "'>
                                                                        <td style='text-align:left' ref='" . $row['LoanAmount'] . "'>₱ " . $row['LoanAmount'] . "</td>
                                                                        <td style='text-align:left' ref='" . $row['LoanTerm'] . "'>" . $row['LoanTerm'] . " Days</td>
                                                                        <td style='text-align:left' ref='" . $row['DateCreated'] . "'>" . gmdate("M d, Y H:i:s", strtotime($row['DateCreated'])) . "</td>
                                                                        <td style='text-align:left' ref='" . $row['Balance'] . "'>₱ " . $row['Balance'] . "</td>
                                                                        <td style='text-align:left' ref='" . $row['DailyPayment'] . "'>₱ " . $row['DailyPayment'] . "</td>
                                                                        <td style='text-align:center' ref='" . $row['LastName'] . "'>" . $row['LastName'] . ', ' . $row['FirstName'] . "</td>
                                                                        </tr>";
                                                                        
                                                                }
                                                            ?>

                                </tbody>
                            </table>
                    </div>

                    <!-- loan ends -->

                      </div>
                      <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                      
                      <!-- start of payment history -->
                        <h5 class="card-header my-2">Payment History</h5><br>
                        <div id="userTable" class="table-responsive text-nowrap">
                            <table class="table mb-5">
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
                                                                      <a class="dropdown-item btnVoid">
                                                                      <i class="bx bx-check-shield me-1"></i> '.$actionName.'</a>
                                                                    </div>
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
                        <!-- end -->
                      </div>
                    </div>
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
            $('#cm-menu').addClass('active');
            $('#la-menu').removeClass('active');
            $('#customerMenuLink').attr({'href':'javascript:void(0);'});

            $('#customerTable').dataTable();

    });
</script>
</html>