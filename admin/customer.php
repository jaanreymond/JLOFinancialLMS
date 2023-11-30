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
    
    <?php include($path . "/JLOFinancial/comp/adminNavbar.php") ?>

    <?php 
        $result = mysqli_query($db, "SELECT * FROM `customer`
                                     where customerid in (select customerid from `customerloan` where IsApproved = 1 group by customerid)");
    ?>

     <!-- Content -->

     <div class="container-fluid flex-grow-1 container-p-y">
         <div class="card">
                <h5 class="card-header">Customers</h5>

                <div class="container text-nowrap mb-5 py-3">
                  <table id="customerTable" class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Customer Name</th>
                        <th>BirthDate</th>
                        <th>Contact Number</th>
                        <th style='text-align:center'>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                                              <?php
                                                    while ($row = $result->fetch_assoc()) {

                                                      $action_element = '
                                                        <div  class="btn-group" role="group">
                                                            <a class="btn btn-primary btnMoreDetails" href="./customerdetails.php?id='.$row['CustomerId'].'" >More Details <i class="bx bx-chevrons-right"></i> </a>
                                                        </div>
                                                      ';
                                                         
                                                        echo "
                                                        <tr  class='text-center' row-id='" . $row['CustomerId'] . "'>
                                                            <td style='text-align:left' ref='" . $row['LastName'] . "'>" . $row['LastName'] . ', ' . $row['FirstName'] . "</td>
                                                            <td style='text-align:left' ref='" . $row['LastName'] . "'>" . gmdate("M d, Y", strtotime($row['DateOfBirth'])) . "</td>
                                                            <td style='text-align:left' ref='" . $row['LastName'] . "'>" . $row['MobileNumber'] . "</td>
                                                            <td><div class='row justify-content-center'>" .$action_element.
                                                            "</td></tr>";
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
            $('#la-menu').removeClass('active');
            $('#customerMenuLink').attr({'href':'javascript:void(0);'});

            $('#customerTable').dataTable();

    });
</script>
</html>