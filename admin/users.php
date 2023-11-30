<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users | JLO</title>
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

  if ($_SESSION['user-es']['Role'] != 'Admin') {
    header("Location: /JLOFinancial/auth.php");
  }
  ?>

  <?php include($path . "/JLOFinancial/comp/adminNavbar.php") ?>

  <?php
  $result = mysqli_query($db, "SELECT * FROM `users`");
  ?>

  <!-- Content -->

  <div class="container-fluid flex-grow-1 container-p-y">
    <div class="card">
      <h5 class="card-header">Users</h5>
      <div style="display:inline-block" class="mx-3 mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#backDropModal">
          <i class="bx bx-user-plus"></i> &nbsp;Add User
        </button>
      </div>


      <div id="userTable" class="table-responsive text-nowrap">
        <table class="table mb-5">
          <thead>
            <tr>
              <th>UserId</th>
              <th>Last Name</th>
              <th>First Name</th>
              <th>Username</th>
              <th>Role</th>
              <th>Email</th>
              <th>Date Registered</th>
              <th>Status</th>
              <th style='text-align:center'>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {

              $statusName = 'Active';
              $status = 'badge bg-label-primary me-1';
              if ($row['IsActive'] != 1) {
                $status = 'badge bg-label-danger me-1';
                $statusName = 'Inactive';
              }

              $editStats = ($statusName == 'Active' ? 'Inactive' : 'Active');

              $action_element = '  <div class="dropdown">
                                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                      </button>
                                                      <div class="dropdown-menu">
                                                        <a class="dropdown-item btnModify" 
                                                          ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                                        >
                                                        <a class="dropdown-item btnDelete"
                                                          ><i class="bx bx-block me-1"></i> Set to ' . $editStats . '</a
                                                        >
                                                      </div>
                                                    </div>';


              echo "
                                                        <tr  class='text-center' row-id='" . $row['UserId'] . "' row-status='" . $editStats . "'>
                                                            <th scope='row' style='text-align:left'>" . $row['UserId'] . "</th>
                                                            <td style='text-align:left' ref='" . $row['LastName'] . "'>" . $row['LastName'] . "</td>
                                                            <td style='text-align:left' ref='" . $row['FirstName'] . "'>" . $row['FirstName'] . "</td>
                                                            <td style='text-align:left' ref='" . $row['Username'] . "'>" . $row['Username'] . "</td>
                                                            <td style='text-align:left' ref='" . $row['Role'] . "'>" . $row['Role'] . "</td>
                                                            <td style='text-align:left' ref='" . $row['Email'] . "'>" . $row['Email'] . "</td>
                                                            <td style='text-align:left' ref='" . $row['DateCreated'] . "'>" . $row['DateCreated'] . "</td>
                                                            <td style='text-align:left' ref='" . $row['IsActive'] . "'><label class='" . $status . "' >" . $statusName . "</label></td>
                                                            <td><div class='row justify-content-center'>" .
                $action_element .
                "</td></tr>";
            }
            ?>

          </tbody>
        </table>
      </div>
    </div>

    <?php include($path . "/JLOFinancial/comp/footer.php") ?>

    <!-- Modal Backdrop -->
    <div class="col-lg-4 col-md-3">
      <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
          <div class="modal-dialog">
            <form class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row g-2 mb-3">
                  <div class="col mb-0">
                    <label for="nameBackdrop" class="form-label">First Name</label>
                    <input type="text" id="regFName" class="form-control" placeholder="Enter First Name" />
                  </div>
                  <div class="col mb-0">
                    <label for="nameBackdrop" class="form-label">Last Name</label>
                    <input type="text" id="regLName" class="form-control" placeholder="Enter Last Name" />
                  </div>
                </div>

                <div class="row">
                  <div class="col mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">Role</label>
                    <select class="form-select" id="regRole" aria-label="Default select example">
                      <option value="" selected>Select a role</option>
                      <option value="Admin">Admin</option>
                      <option value="Collector">Collector</option>
                      <!-- <option value="Encoder">Encoder</option> -->
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col mb-3">
                    <label for="nameBackdrop" class="form-label">Email Address</label>
                    <input type="text" id="email-address" class="form-control" placeholder="Enter email address" />
                  </div>
                </div>


                <div class="row g-2 mb-3">
                  <div class="col mb-0">
                    <label for="emailBackdrop" class="form-label">Username</label>
                    <input type="text" id="regUsername" class="form-control" placeholder="Enter Username" />
                  </div>
                  <div class="col mb-0">
                    <label for="dobBackdrop" class="form-label">Password</label>
                    <input type="password" id="regPassword" class="form-control" placeholder="Enter Password" />
                  </div>
                </div>



              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary" id="saveBtn">Save</button>
              </div>
          </div>
      
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit -->
  <div class="col-lg-4 col-md-3">
    <div class="mt-3">
      <!-- Modal -->
      <div class="modal fade" id="editUserModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
          <form class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editUserModalTitle">Edit User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="text" id="modUserId" hidden />
              <div class="row g-2 mb-3">
                <div class="col mb-0">
                  <label for="nameBackdrop" class="form-label">First Name</label>
                  <input type="text" id="modFName" class="form-control" placeholder="Enter First Name" />
                </div>
                <div class="col mb-0">
                  <label for="nameBackdrop" class="form-label">Last Name</label>
                  <input type="text" id="modLName" class="form-control" placeholder="Enter Last Name" />
                </div>
              </div>

              <div class="row">
                <div class="col mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">Role</label>
                  <select class="form-select" id="modRole" aria-label="Default select example">
                    <option value="" selected>Select a role</option>
                    <option value="Admin">Admin</option>
                    <option value="Collector">Collector</option>
                    <option value="Encoder">Encoder</option>
                  </select>
                </div>
              </div>


              <div class="row mb-3">
                <div class="col mb-0">
                  <label for="emailBackdrop" class="form-label">Username</label>
                  <input type="text" id="modUsername" class="form-control" placeholder="Enter Username" />
                </div>
              </div>

              <div class="row mb-3">
                <div class="col mb-0">
                  <label for="emailBackdrop" class="form-label">Password</label>
                  <input type="password" id="modPassword" class="form-control" placeholder="Enter Password" />
                </div>
              </div>

              <div class="row g-2">
                <div class="col mb-0">
                  <label for="emailBackdrop" class="form-label">Email</label>
                  <input type="text" id="modEmail" class="form-control" placeholder="Enter Email" />
                </div>
              </div>

              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="button" class="btn btn-warning" id="btnUpdate">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

<script>
  $(document).ready(function() {
    $('#d-menu').removeClass('active');
    $('#mu-menu').addClass('active');
    $('#cm-menu').removeClass('active');
    $('#la-menu').removeClass('active');
    $('#userMenuLink').attr({
      'href': 'javascript:void(0);'
    });

    // insert user
    $('#saveBtn').on('click', function() {

      var firstname = $('#regFName').val();
      var lastname = $('#regLName').val();
      var username = $('#regUsername').val();
      var password = $('#regPassword').val();
      var role = $('#regRole').val();
      var emailAddress = $('#email-address').val();

      if (firstname == '' || lastname == '' || role == "" || username == "" || password == "" || emailAddress == '') {
        swal("Register Failed", "Fill up all fields!", "error");
        return;
      }

      var data = {};
      data = {
        "RegisterUser": 1,
        "firstname": firstname,
        "lastname": lastname,
        "username": username,
        "password": password,
        "role": role,
        "email": emailAddress,
      };

      $.ajax({
        url: "/JLOFinancial/methods/userController.php",
        type: 'POST',
        data: data,
        success: function(response) {
          if (response.includes("Successful")) {
            swal({
              title: "User successfully Registered!",
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


    $(document).on("click", ".btnDelete", function(e) {
      $id = e.target.closest("tr").getAttribute("row-id");
      $stats = e.target.closest("tr").getAttribute("row-status");
      $statsval = ($stats == 'Inactive' ? 0 : 1);
      console.log($statsval);

      swal({
        title: "Are you sure you want to set this to " + $stats + "?",
        // text: "You will not be able to recover this user after deletion!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Confirm",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false
      }, function(isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: "/JLOFinancial/methods/userController.php",
            type: 'POST',
            data: {
              "ChangeUserStatus": 1,
              "userId": $id,
              "status": $statsval
            },
            success: function(response) {
              console.log(response);
              if (response.includes("error")) {
                swal("Error Encountered", "User is already deleted.", "error");
              } else {
                swal({
                  title: "User successfully set to " + $stats + ".",
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


    $(document).on("click", ".btnModify", function(e) {
      $id = e.target.closest("tr").getAttribute("row-id");
      $.ajax({
        url: "/JLOFinancial/methods/userController.php",
        type: 'POST',
        data: {
          "GetUser": 1,
          "userId": $id
        },
        success: function(response) {
          if (response.includes("error")) {
            swal("No changes detected", "Please double check your new entries.");
          } else {
            response = JSON.parse(response);
            $("#modUserId").val($id);
            $("#modFName").val(response.FirstName);
            $("#modLName").val(response.LastName);
            $("#modUsername").val(response.Username);
            $("#modEmail").val(response.Email);
            $("#modPassword").val(response.Password);
            $("#modRole").val(response.Role);
            $('#editUserModal').modal('show');
          }
        }
      });
    })

    $("#btnUpdate").on("click", function() {
      var modUserId = $("#modUserId").val();
      var modFirstname = $("#modFName").val();
      var modLastname = $("#modLName").val();
      var modUsername = $("#modUsername").val();
      var modRole = $("#modRole").val();
      var modPassword = $("#modPassword").val();
      var modEmail = $("#modEmail").val();

      if (modFirstname == "" || modLastname == "" || modRole == "" || modEmail == "") {
        swal("Error", "Empty Field/s Detected", "error");
      } else {
        var data = {
          'UpdateUser': 1,
          'modUserId': modUserId,
          'modFirstname': modFirstname,
          'modLastname': modLastname,
          'modUsername': modUsername,
          'modRole': modRole,
          'modEmail': modEmail
        };

        $.ajax({
          url: "/JLOFinancial/methods/userController.php",
          type: 'POST',
          data: data,
          success: function(response) {
            if (response.includes("success")) {
              swal({
                title: "User Successfully Edited!",
                timer: 1400,
                type: 'success',
                showConfirmButton: true
              });
              setTimeout(function() {
                window.location.reload();
              }, 1500)
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
      }
    });
  });
</script>

</html>