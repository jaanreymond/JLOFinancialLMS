<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Applications | JLO</title>
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
        $result = mysqli_query($db, "SELECT * FROM `customer` c INNER JOIN `customerloan` cl on cl.CustomerId = c.CustomerId where cl.IsApproved = 0");
    ?>

     <!-- Content -->

     <div class="container-fluid flex-grow-1 container-p-y">
         <div class="card">
                <h5 class="card-header">Loan Applications</h5>

                <div id="userTable" class="table-responsive text-nowrap">
                <div class="container mb-5 py-3">
                    <table class="table table-striped table-hover" id="loanApplicationTable" style="width:100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Applicant Name</th>
                            <th>Loan Amount</th>
                            <th>Date Applied</th>
                            <th style='text-align:center'>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                                               <?php
                                                    while ($row = $result->fetch_assoc()) {

                                                      $action_element = '
                                                        <div  class="btn-group" role="group">
                                                            <button class="btn btn-success btnApprove"><i class="bx bx-check"></i> Approve</button>
                                                            <button class="btn btn-danger btnDecline"><i  class="bx bx-x"></i> Decline</button>
                                                        </div>
                                                      ';

                                                      $action_details = '<div class="dropdown">
                                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                      </button>
                                                      <div class="dropdown-menu">
                                                        <a class="dropdown-item btnMoreInfo" style="text-transform:none"><i class="bx bx-zoom-in me-1"></i> More Info</a>
                                                        <a class="dropdown-item btnViewDocument" style="text-transform:none"><i class="bx bx-file me-1"></i> Uploaded Document</a>
                                                      </div>
                                                    </div>';
                                                      
                                                         
                                                        echo "
                                                        <tr  class='text-center' row-id='" . $row['CustomerLoanId'] . "' row-cId='".$row['CustomerId']."'>
                                                            <th scope='row' style='text-align:left'>".$action_details."</th>
                                                            <td style='text-align:left' ref='" . $row['LastName'] . "'><b>" . $row['LastName'] . ', ' . $row['FirstName'] . "</b></td>
                                                            <td style='text-align:left' ref='" . $row['LoanAmount'] . "'><b>₱ " . $row['LoanAmount'] . "</b></td>
                                                            <td style='text-align:left' ref='" . $row['DateCreated'] . "'>" . gmdate("M d, Y H:i:s", strtotime($row['DateCreated'])) . "</td>
                                                            <td><div class='row justify-content-center'>" .
                                                            $action_element .
                                                            "</td></tr>";
                                                    }
                                                ?>
                        </tbody>
                    </table>
                </div>
               
                </div>
              </div>
              

    <!-- Document Modal -->
    <div class="modal fade" id="documentModal" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Uploaded Document</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <!-- <div class="col mb-3">
                                        <img src="" class="img-thumbnail" id="fileImage" alt="Customer Documents">
                                  </div> -->

                                  <div class="col-md-12">
                                        <label for="">Document 1:</label>
                                    </div>
                                    <div class="col-md-12 text-center">
                                    <img src="" class="img-thumbnail" id="fileImage" alt="Customer Documents">
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Document 2:</label>
                                    </div>
                                    <div class="col-md-12 text-center">
                                    <img src="" class="img-thumbnail" id="fileImage2" alt="Customer Documents">
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                    </div>
                </div>
            </div>
        </div>
    <!-- end -->
    
    <!-- info modal -->
    <div class="modal fade" id="moreInfoModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="exampleModalLabel3">Applicant Information</h3>
                              <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <fieldset>
                                <h5>Personal Information</h5>
                                <table width="100%" class="table">
                                    <tr>
                                        <td>First Name: </td>
                                        <td><b id="fname">Seris Vritra</b></td>
                                        <td>Last Name: </td>
                                        <td><b id="lname">Seris Vritra</b></td>
                                        <td rowspan="3">
                                            <div style="text-align:center">
                                                <img id="customerImage" src="#" alt="customer" style="width:150px;height:100px"><br>
                                                <small class="my-1">Customer Image</small>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Birth Date: </td>
                                        <td><b id="bdate">Jun 23, 2023</b></td>
                                        <td>Birth Place: </td>
                                        <td><b id="bplace">Seris Vritra</b></td>
                                    </tr>
                                    <tr>
                                        <td>Gender: </td>
                                        <td><b id="gender">Seris Vritra</b></td>
                                        <td>Civil Status: </td>
                                        <td><b id="cstatus">Jun 23, 2023</b></td>
                                    </tr>
                                    <tr>
                                        <td>Age: </td>
                                        <td><b id="age">Seris Vritra</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>

                                <h5>Contact Information</h5>
                                <table width="100%" class="table">
                                    <tr>
                                        <td>Contact Number: </td>
                                        <td><b id="cnumber">Seris Vritra</b></td>
                                        <td>Email Address: </td>
                                        <td><b id="emailAdd">Seris Vritra</b></td>
                                    </tr>
                                </table>

                                <h5>Address Information</h5>
                                <table width="100%" class="table">
                                    <tr>
                                        <td>Present Address: </td>
                                        <td><b id="presentAddress">Seris Vritra</b></td>
                                        <td>City: </td>
                                        <td><b id="city">Seris Vritra</b></td>
                                    </tr>
                                    <tr>
                                        <td>Province: </td>
                                        <td><b id="province">Seris Vritra</b></td>
                                        <td>Zip Code: </td>
                                        <td><b id="zipCode">Seris Vritra</b></td>
                                    </tr>
                                    <tr>
                                        <td>Residence Type: </td>
                                        <td><b id="residence">Seris Vritra</b></td>
                                        <td>Monthly If Rented: </td>
                                        <td><b id="monthlyrent">Seris Vritra</b></td>
                                    </tr>
                                </table>

                                <h5>Income Information</h5>
                                <table width="100%" class="table">
                                    <tr>
                                        <td>Nature of Income: </td>
                                        <td><b id="natureofincome">Seris Vritra</b></td>
                                        <td>Profession: </td>
                                        <td><b id="iiprofession">Seris Vritra</b></td>
                                    </tr>
                                    <tr>
                                        <td>Income Address: </td>
                                        <td><b id="incomeaddress">Seris Vritra</b></td>
                                        <td>Daily Sales: </td>
                                        <td><b id="dailysales">Seris Vritra</b></td>
                                    </tr>
                                    <tr>
                                        <td>Monthly Earnings: </td>
                                        <td colspan="3"><b id="monthlyearnings">Seris Vritra</b></td>
                                    </tr>
                                </table>

                                <h5>More Information</h5>
                                <table width="100%" class="table">
                                     <tr>
                                        <td>Father Name: </td>
                                        <td><b id="fatherfname">Seris Vritra</b></td>
                                        <td>Father Profession: </td>
                                        <td><b id="fatherlname">Seris Vritra</b></td>
                                    </tr>
                                    <tr>
                                        <td>Mother Name: </td>
                                        <td><b id="motherfname">Seris Vritra</b></td>
                                        <td>Mother Profession: </td>
                                        <td><b id="motherlname">Seris Vritra</b></td>
                                    </tr>
                                    <tr>
                                        <td>Spouse First Name: </td>
                                        <td><b id="sfname">Seris Vritra</b></td>
                                        <td>Spouse Last Name: </td>
                                        <td><b id="slname">Seris Vritra</b></td>
                                    </tr>
                                    <tr>
                                        <td>Profession: </td>
                                        <td><b id="sprofession">Seris Vritra</b></td>
                                        <td>Contact Number: </td>
                                        <td><b id="scontactno">Seris Vritra</b></td>
                                    </tr>
                                </table>
                              </fieldset>                    
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                              </button>
                            </div>
                          </div>
                        </div>
    </div>
    <!-- end -->
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
            $('#la-menu').addClass('active');
            
            $('#loanAppMenuLink').attr({'href':'javascript:void(0);'});

            $('#loanApplicationTable').dataTable();

            $(document).on("click", ".btnApprove", function(e) {

                $id = e.target.closest("tr").getAttribute("row-id");
                swal({
                    title: "Are you sure you want to approve this application?",
                    text: "This action cannot be undone!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#71dd37",
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
                                "ApproveLoanApplication": 1,
                                "customerLoanId": $id
                            },
                            success: function(response) {
                              console.log(response);
                                if (response.includes("error")) {
                                    swal("Error Encountered", "Loan Application already exist.", "error");
                                } else {
                                    swal({
                                        title: "Loan application successfully approved.",
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
                })
            });

            $(document).on("click", ".btnDecline", function(e) {

                $id = e.target.closest("tr").getAttribute("row-id");
                swal({
                    title: "Are you sure you want to decline this application?",
                    text: "This action cannot be undone!",
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
                                "DeclineLoanApplication": 1,
                                "customerLoanId": $id
                            },
                            success: function(response) {
                            console.log(response);
                                if (response.includes("error")) {
                                    swal("Error Encountered", "Loan Application already exist.", "error");
                                } else {
                                    swal({
                                        title: "Loan application successfully declined.",
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
                })
             });


            $(document).on("click", ".btnMoreInfo", function(e) {

                $id = e.target.closest("tr").getAttribute("row-cId");
                $.ajax({
                            url: "/JLOFinancial/methods/loanController.php",
                            type: 'POST',
                            data: {
                                "GetCustomerInfo": 1,
                                "customerId": $id,
                            },
                            success: function(response) {
                              console.log(response);
                                if (response.includes("error")) {
                                    swal("Error Encountered", "No Record Found.", "error");
                                } else {
                                    response = JSON.parse(response);
                                    $('#fname').html(response.FirstName);
                                    $('#lname').html(response.LastName);
                                    $('#bdate').html(response.DateOfBirth);
                                    $('#bplace').html(response.BirthPlace);
                                    $('#gender').html(response.Gender);
                                    $('#cstatus').html(response.CivilStatus);
                                    $('#age').html(response.Age);
                                    $('#customerImage').attr({"src":"../custDocuments/"+response.FileName+""});
                                    
                                    $('#cnumber').html(response.MobileNumber);
                                    $('#emailAdd').html(response.EmailAddress);

                                    $('#presentAddress').html(response.PresentAddress);
                                    $('#city').html(response.City);
                                    $('#province').html(response.Province);
                                    $('#zipCode').html(response.ZipCode);
                                    $('#residence').html(response.ResidenceType);
                                    $('#monthlyrent').html(response.MonthlyIfRented);

                                    $('#natureofincome').html(response.NatureOfIncome);
                                    $('#iiprofession').html(response.Profession);
                                    $('#incomeaddress').html(response.IncomeAddress);
                                    $('#dailysales').html(response.DailySales);
                                    $('#monthlyearnings').html(response.MonthlyEarnings);

                                    $('#sfname').html(response.SpouseFname);
                                    $('#slname').html(response.SpouseLname);
                                    $('#sprofession').html(response.SpouseProfession);
                                    $('#scontactno').html(response.SpousePhoneNo);
                                    $('#fatherfname').html(response.FatherName);
                                    $('#fatherlname').html(response.FatherProfession);
                                    $('#motherfname').html(response.MotherName);
                                    $('#motherlname').html(response.MotherProfession);
                                   

                                    $('#moreInfoModal').modal('show');
                                }
                            }
                  });
            })


            $(document).on("click", ".btnViewDocument", function(e) {
                $id = e.target.closest("tr").getAttribute("row-cId");
                $.ajax({
                            url: "/JLOFinancial/methods/loanController.php",
                            type: 'POST',
                            data: {
                                "GetCustomerDocument": 1,
                                "customerId": $id,
                            },
                            success: function(response) {
                                if (response.includes("error")) {
                                    swal("Error Encountered", "No File Found.", "error");
                                } else {
                                    response = JSON.parse(response);
                                   console.log(response);
                                    var fileName = '../custDocuments/' + response.FileName;
                                    $('#fileImage').attr({"src": fileName})

                                    var fileName2 = '../custDocuments/' + response.FileName2;
                                    $('#fileImage2').attr({"src": fileName2})
                                    $('#documentModal').modal('show');
                                }
                            }
                  });
              
            })
    });
</script>
</html>