<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | JLO</title>
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
    
    <?php include($path . "/JLOFinancial/comp/adminNavbar.php") ?>

    <?php 
        $result = mysqli_query($db, "SELECT * FROM `customer`
                                     where customerid in (select customerid from `customerloan` where IsApproved = 1 group by customerid)");

        $customerPayment = mysqli_query($db, "SELECT p.*, c.*, cl.Balance as `Balance`, u.FirstName as `userfname`, u.LastName as `userlname` FROM `payment` p
                                      INNER JOIN `customer` c on c.customerid = p.customerid
                                      INNER JOIN `customerloan` cl on cl.customerloanid = p.customerloanid
                                      INNER JOIN `users` u on u.userid = p.collectorid 
                                      where IsVoid = 0 ORDER BY PaymentDate DESC");
    ?>

     <!-- Content -->

     <div class="container flex-grow-1 container-p-y">
         <div class="card">
                <div class="row">
                    <div class="col-md-6">
                      <h5 class="card-header">User Profile &nbsp;<small><a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true"  title data-bs-original-title="<i class='bx bx-trending-up bx-xs' ></i> <span>Click to Edit Profile</span>"  id="btnEdit" class=""><i class='bx bx-edit-alt'></i></a></small></h5>
                    </div>
                    <div class="col-md-6 px-4">
                      <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#changePasswordModal" style="float:right;margin-top:24px"><i class="bx bx-cog"></i> &nbsp;Change Password</button>
                    </div>
                </div>
                <div class="card-body container text-nowrap mb-1 py-3" >
                    <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">First Name</label>
                            <input class="form-control" type="text" name="lastName" id="firstName" value='<?php echo $_SESSION['user-es']['FirstName'] ?>' disabled/>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value='<?php echo $_SESSION['user-es']['LastName'] ?>' disabled/>
                          </div>
                        
                          <div class="col-md-6">
                            <label for="lastName" class="form-label">Username</label>
                            <input class="form-control" type="text" name="lastName" id="userName" value='<?php echo $_SESSION['user-es']['Username'] ?>' disabled/>
                          </div>
                          <div class="col-md-6">
                            <label for="lastName" class="form-label">Role</label>
                            <input class="form-control" style="text-align:center" type="text" name="lastName" id="userRole" value='<?php echo $_SESSION['user-es']['Role'] ?>' disabled/>
                          </div>
                    </div>
                </div>  
                <div class="card-footer btns" style="display:none">
                    <button class="btn btn-info" id="btnSave"><i class='bx bx-save'></i> &nbsp;Save Changes</button>
                    <button class="btn btn-secondary" id="btnCancel"><i class='bx bx-x'></i> &nbsp;Cancel</button>
                </div>
        </div>
    </div>
              
    <?php include($path . "/JLOFinancial/comp/footer.php") ?>

<!-- Change Password Modal -->
                <div class="col-lg-4 col-md-3">
                      <div class="mt-3">
                        <!-- Modal -->
                        <div class="modal fade" id="changePasswordModal" data-bs-backdrop="static" tabindex="-1">
                          <div class="modal-dialog">
                            <form class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="backDropModalTitle">Change Password</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                
                                <div class="row">
                                  <div class="col mb-3">
                                     <label for="currentPassword" class="form-label">Current Password<span class="text-danger">*</span></label>
                                     <input type="password" id="currentPassword" class="form-control" placeholder="Enter Current Password" aria-label="CPassword" autofocus/>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col mb-3">
                                     <label for="newPassword" class="form-label">New Password<span class="text-danger">*</span></label>
                                     <input type="password" id="newPassword" class="form-control" placeholder="Enter New Password" aria-label="CPassword" autofocus/>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col mb-3">
                                     <label for="confirmPassword" class="form-label">Confirm Password<span class="text-danger">*</span></label>
                                     <input type="password" id="confirmPassword" class="form-control" placeholder="Enter Confirm Password" aria-label="CPassword" autofocus/>
                                  </div>
                                </div>
                                
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="button" class="btn btn-primary" id="changePasswordBtn">Change Password</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php include '/JLOFinancial/modal-content.php'; ?>
    <!-- end -->

</body>
<script src="../assets/vendor/js/jquery-370.js"></script>
<script src="../assets/vendor/js/jquery.dataTables.min.js"></script>
<script src="../assets/vendor/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function(){
        $('#d-menu').removeClass('active');
        $('#mu-menu').removeClass('active');
        $('#cm-menu').removeClass('active');
        $('#prof-menu').addClass('active');
        $('#cr-menu').removeClass('active');
        $('#la-menu').removeClass('active');
        $('#ph-menu').removeClass('active');
        $('#profMenuLink').attr({
            'href': 'javascript:void(0);'
        });



        $(document).on("click", "#btnEdit", function() {
                $("#firstName, #lastName, #userName").removeAttr("disabled");
                $("#firstName").focus();
                $(".btns").show();
         });

         $('#btnCancel').on('click', function(){
            location.reload();
         })

         $('#btnSave').on('click', function(){
            var firstName = $('#firstName').val().trim();
            var lastName = $('#lastName').val().trim();
            var userName = $('#userName').val().trim();

            if(firstName == "" || lastName == "" || userName == ""){
                swal("Update Failed","Fill up all fields!","error");
                return;
            }

            swal({
                    title: "Are you sure you want to save this changes?",
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
                            url: "/JLOFinancial/methods/userController.php",
                            type: 'POST',
                            data: {
                                "UpdateProfile": 1,
                                "firstName": firstName,
                                "lastName": lastName,
                                "userName": userName,
                            },
                            success: function(response) {
                                if (response.includes("error")) {
                                    swal("Error Encountered", "User cannot be updated.", "error");
                                } else {
                                    swal({
                                        title: "User Successfully Updated!",
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


         $('#changePasswordBtn').on('click', function(){
            var currentPassword = $('#currentPassword').val();
            var newPassword = $('#newPassword').val();
            var confirmPassword = $('#confirmPassword').val();

            if(currentPassword == "" || newPassword == "" || confirmPassword == ""){
                swal("Change Password Failed","Fill up all fields!","error");
                return;
            }

            if(newPassword != confirmPassword){
                swal("Change Password Failed","Password does not match!","error");
                return;
            }

            swal({
                    title: "Are you sure you want to change your password?",
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
                            url: "/JLOFinancial/methods/userController.php",
                            type: 'POST',
                            data: {
                                "ChangePassword": 1,
                                "currentPassword": currentPassword,
                                "newPassword": newPassword
                            },
                            success: function(response) {

                                if(response.includes("Successful")){
                                    swal({
                                        title: "Password Successfully Updated!",
                                        timer: 1400,
                                        type: 'success',
                                        showConfirmButton: true
                                    });

                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 1500)
                                }else{
                                    swal("Error Encountered", response, "error");
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