<?php
// Include your database connection code here
$host = 'localhost'; // Replace with your database host
$dbname = 'loandb'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    // You might want to handle the connection error more gracefully in a production environment
}

// Password change logic
if (isset($_POST["changePassword"])) {
    $username = $_POST["username"];
    $newPassword = $_POST["newPassword"];

    // You may want to add additional validation here, e.g., checking if the username and new password are not empty

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the user's password in the database
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = ?");
    $stmt->execute([$hashedPassword, $username]);

    // Check if the update was successful
    if ($stmt->rowCount() > 0) {
        echo "Password updated successfully";
    } else {
        echo "Failed to update password";
    }

    exit; // Stop further execution after password update
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login | JLO</title>
   <!-- Favicon -->
   <link rel="icon" type="image/x-icon" href="./assets/img/photologo.png" />


	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link
	href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
	rel="stylesheet" />

	<link rel="stylesheet" href="./assets/vendor/fonts/boxicons.css" />

	<!-- Core CSS -->
	<link rel="stylesheet" href="./assets/vendor/css/core.css" class="template-customizer-core-css" />
	<link rel="stylesheet" href="./assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
	<link rel="stylesheet" href="./assets/css/demo.css" />
	<link rel="stylesheet" href="./assets/css/login.css" />

	<!-- Vendors CSS -->
	<link rel="stylesheet" href="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
	<link rel="stylesheet" href="./assets/vendor/libs/apex-charts/apex-charts.css" />

	<!-- Page CSS -->
	<link href="./assets/plugins/sweet-alert/sweetalert.min.css" rel="stylesheet" type="text/css"/>

	<!-- Helpers -->
	<script src="./assets/vendor/js/helpers.js"></script>
	<script src="./assets/js/config.js"></script>
</head>
<body>
    <section class="vw-100 login-form-container">
    <a class="navbar-brand" href="./index.php" style ="margin-left: 20px;">
            <img src="./assets/img/jlofinanciallogo-2@2x.png" width="190px" height="40px" alt="Logo2" />
        </a>
        <div class="p-5 text-center text-lg-start">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-lg-0 mx-auto px-5">
                    <div class="card shadow m-5">
                    <div class="card-body p-5">
    <form method="POST" id="loginForm">
    <div class="form-group text-center">
            <!-- Replace this with the provided logo code -->
            <img src="assets/img/photologo.png" alt="" width="50" height="40" />
            <h3 class="font-weight-bold" style="color: #007bff; /* Text color: Primary Blue */ margin-top: 1rem;">Login</h3>
        </div>

        <div class="form-group mb-3">
            <label class="float-left mb-2" for="logUsername">Username</label>
            <input type="text" class="form-control" id="logUsername" aria-describedby="emailHelp" placeholder="Enter Username">
        </div>
        <div class="form-group">
            <label class="float-left mb-2" for="logPassword">Password</label>
            <input type="password" class="form-control" id="logPassword" placeholder="Enter Password">
        </div>
        <button type="submit" id="Loginbtn" class="btn btn-primary mt-4 btn-block form-control mb-3">Sign In</button>
        <div class="text-center mt-3">
        <a id="forgotpasswordLink" href="forgotpassword.php">Forgot Password?</a>
</div>
    </form>
</div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="./assets/vendor/libs/jquery/jquery.js"></script>
    <script src="./assets/vendor/libs/popper/popper.js"></script>
    <script src="./assets/vendor/js/bootstrap.js"></script>
    <script src="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="./assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="./assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="./assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="./assets/js/dashboards-analytics.js"></script>

    <script src="./assets/plugins/sweet-alert/sweetalert.min.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
    $(document).ready(function () {
    $('#loginForm').on('submit', function (e) {
        e.preventDefault();
        var username = $('#logUsername').val();
        var password = $('#logPassword').val();

        if (username == "" || password == "") {
            swal("Error", "Fill up all fields!", "error");
            return;
        }

        var data = {
            "Login": 1,
            "username": username,
            "password": password
        }

        $.ajax({
            url: "/JLOFinancial/methods/authController.php",
            type: 'POST',
            data: data,
            success: function (response) {
                if (response.includes("Successful")) {
                    var role = response.replace('Successful|', '');
                    if (role == 'Admin') {
                        window.location.href = "/JLOFinancial/admin/dashboard.php";
                    } else if (role == 'Collector') {
                        window.location.href = "/JLOFinancial/collector/dashboard.php";
                    }
                } else {
                    // Clear input fields on login failure
                    $('#logUsername').val('');
                    $('#logPassword').val('');

                    // Check for specific error messages and display accordingly
                    if (response.includes("Invalid username")) {
                        swal("Login Failed", "Invalid username, please try again.", "error");
                    } else if (response.includes("Invalid password")) {
                        swal("Login Failed", "Invalid password, please try again.", "error");
                    } else {
                        swal("Login Failed", response, "error");
                    }
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                swal("Error", "An error occurred during login. Please try again.", "error");
            }
        });
    });

    // Event listener for the "Forgot Password?" link
    $('#forgotPasswordLink').on('click', function (e) {
        e.preventDefault();
        // Redirect to the forgot password page
        window.location.href = $(this).attr('href');
    });

    // Event listener for the "Forgot Password?" link
    $('#forgotPasswordLink').on('click', function (e) {
        e.preventDefault();
        // Redirect to the forgot password page
        window.location.href = $(this).attr('href');
    });

    // Additional code to handle the password change form submission
    $('#forgotPasswordForm').on('submit', function (e) {
        e.preventDefault();
        var newPassword = $('#newPassword').val();
        var confirmPassword = $('#confirmPassword').val();

        if (newPassword === "" || confirmPassword === "") {
            swal("Error", "Fill up all fields!", "error");
            return;
        }

        var changePasswordData = {
            "changePassword": 1,
            "username": username, // Make sure to have the username available here
            "newPassword": newPassword,
            "confirmPassword": confirmPassword
        }

        // Make an AJAX request to update the password
        $.ajax({
            url: "/JLOFinancial/methods/authController.php",
            type: 'POST',
            data: changePasswordData,
            success: function (response) {
                if (response.includes("Password updated successfully")) {
                    // Optionally, you can redirect the user or show a success message
                    swal("Success", "Password updated successfully!", "success");
                } else {
                    // Handle password update failure
                    swal("Error", response, "error");
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                swal("Error", "An error occurred during password update. Please try again.", "error");
            }
        });
    });
});
</script>
</body>
</html>