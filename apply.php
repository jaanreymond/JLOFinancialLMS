<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Apply | JLO</title>
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
	<link rel="stylesheet" href="./assets/css/stepper.css" />

	<!-- Vendors CSS -->
	<link rel="stylesheet" href="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
	<link rel="stylesheet" href="./assets/vendor/libs/apex-charts/apex-charts.css" />
	<link rel="stylesheet" href="./assets/css/apply.css" />
	<link href="./assets/plugins/sweet-alert/sweetalert.min.css" rel="stylesheet" type="text/css"/>
	<!-- Page CSS -->

	<!-- Helpers -->
	<script src="./assets/vendor/js/helpers.js"></script>
	<script src="./assets/js/config.js"></script>
</head>
<body>
    <nav class="navbar navbar-light shadow-sm px-5 bg-white">
        <a href="./index.php" class="navbar-brand mb-0 h1 btn"><i class="bx bx-left-arrow-alt"></i> &nbsp; Application Form <span class="mx-5 badge bg-label-primary " style="font-size: 9px; text-transform:none !important">In Progress</span></a> 
    </nav>
	<section class="vw-100" >
		<div class="p-5 text-center text-lg-start">
			<div class="row align-items-center">
				<div class="col-lg-7 mb-lg-0 mx-auto px-5">  
					<div class="bs-stepper shadow-sm" style="background-color:White">
					<div class="bs-stepper-header mx-5" role="tablist">
						<!-- your steps here -->
						<div class="step" data-target="#personalinfo-part">
							<button type="button" class="step-trigger" role="tab" aria-controls="personalinfo-part" id="personalinfo-part-trigger">
								<span class="bs-stepper-circle" id="pi-circle">1</span>
								<!-- <span class="bs-stepper-label">Logins</span> -->
							</button>
						</div>

						<!-- extra step -->
						<div class="step" data-target="#extrapi-part">
							<button type="button" class="step-trigger" role="tab" aria-controls="extrapi-part" id="extrapi-part-trigger" style="margin:0px;padding:0px" >
								<span class="bs-stepper-circle" id="extrapi-line" style="height:3px;width:42px;margin:0px;padding:0px;line-height:normal;margin-bottom:2px;border-radius:0" ></span>
								<!-- <span class="bs-stepper-label">Various information</span> -->
							</button>
						</div>
						<!-- end extra step -->

						<div class="line" id="ip-line" style="max-width:42px"></div>
						<div class="step" data-target="#information-part">
							<button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger" >
								<span class="bs-stepper-circle" id="ip-circle">2</span>
								<!-- <span class="bs-stepper-label">Various information</span> -->
							</button>
						</div>

						<!-- extra step -->
						<div class="step" data-target="#soi-part">
							<button type="button" class="step-trigger" role="tab" aria-controls="soi-part" id="soi-part-trigger" style="margin:0px;padding:0px" >
								<span class="bs-stepper-circle" id="extraci-line" style="height:3px;width:42px;margin:0px;padding:0px;line-height:normal;margin-bottom:2px;border-radius:0" ></span>
							</button>
						</div>
						<!-- end extra step -->

						<div class="line" id="fc-line" style="max-width:42px"></div>
						<div class="step" data-target="#fc-part">
							<button type="button" class="step-trigger" role="tab" aria-controls="fc-part" id="fc-part-trigger">
								<span class="bs-stepper-circle" id="fc-circle">3</span>
							</button>
						</div>

                        	<!-- extra step -->
						<div class="step" data-target="#extraupload-part">
							<button type="button" class="step-trigger" role="tab" aria-controls="extraupload-part" id="extraupload-part-trigger" style="margin:0px;padding:0px" >
								<span class="bs-stepper-circle" id="extraupload-line" style="height:3px;width:42px;margin:0px;padding:0px;line-height:normal;margin-bottom:2px;border-radius:0" ></span>
							</button>
						</div>
						<!-- end extra step -->

						<div class="line" id="eu-line" style="max-width:42px"></div>
						<div class="step" data-target="#fourth-part">
						<button type="button" class="step-trigger" role="tab" aria-controls="fourth-part" id="fourth-part-trigger">
							<span class="bs-stepper-circle">4</span>
							<!-- <span class="bs-stepper-label">Various information</span> -->
						</button>
						</div>
					</div>
					<hr class="m-0 mb-3" />
                    <!-- style="min-height:450px" -->
					<div class="bs-stepper-content"> 
						<!-- your steps content here -->
						<div id="personalinfo-part" class="content fade" role="tabpanel" aria-labelledby="personalinfo-part-trigger">
							<h4>Personal Information</h4>
							<p>Please provide your accurate personal information to ensure a smooth application process. This may include details such as your full name, date of birth, contact information, and any other relevant details required for the application. </p>
							<!-- Personal Information div -->
								<div class="row g-2 mb-2">
									<div class="col mb-0">
										<label for="nameBackdrop" class="form-label">First Name<i class="text-danger">*</i></label>
										<input
										type="text"
										id="aFirstName"
										class="form-control"
										placeholder="Enter First Name" />
									</div>
									<div class="col mb-0">
									<label for="nameBackdrop" class="form-label">Last Name<i class="text-danger">*</i></label>
										<input
										type="text"
										id="aLastName"
										class="form-control"
										placeholder="Enter Last Name" />
									</div>
                                </div>
								<div class="row g-2 mb-2">
									<div class="col mb-0">
										<label for="nameBackdrop" class="form-label">Mobile Number<i class="text-danger">*</i></label>
										<input
										type="text"
										id="aMobileNo"
										class="form-control"
										placeholder="Enter your phone number"
										oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 11)" 
										required
										/>
									</div>
									<div class="col mb-0">
									<label for="nameBackdrop" class="form-label">Email Address<i class="text-danger">*</i></label>
										<input
										type="email"
										id="aEmail"
										class="form-control"
										placeholder="Enter your email address" />
									</div>
								  </div>
									<div class="row g-2 mb-2">
									<div class="col mb-0">
									<label for="aPresentAddress" class="form-label">Street Address<i class="text-danger">*</i></label>
									<input type="text" id="aPresentAddress" class="form-control" placeholder="Enter your street address" required />
								</div>

								<div class="row g-2 mb-2">
									<div class="col-md-6 mb-0">
										<label for="aBarangay" class="form-label">Barangay<i class="text-danger">*</i></label>
										<input type="text" id="aBarangay" class="form-control" placeholder="Enter your barangay" required />
									</div>
									<div class="col-md-6 mb-0">
										<label for="aCity" class="form-label">City/Municipality<i class="text-danger">*</i></label>
										<select id="aCity" class="form-select" required>
											<option value="" selected disabled>Select City/Municipality</option>
											<option value="Talisay City">Talisay City</option>
											<option value="Cebu City">Cebu City</option>
											<option value="Lapu-lapu City">Lapu-lapu City</option>
											<option value="Minglanilla City">Minglanilla City</option>
											<option value="Mandaue City">Mandaue City</option>
											<!-- Add more options as needed -->
										</select>
									</div>
								</div>
								<div class="row g-2 mb-3">
									<div class="col-md-6 mb-0">
										<label for="aProvince" class="form-label">Province<i class="text-danger">*</i></label>
										<select id="aProvince" class="form-select" required>
											<option value="" selected disabled>Select Province</option>
											<option value="Cebu">Cebu</option>
											<!-- Add more options as needed -->
										</select>
									</div>
									<div class="col-md-6 mb-0">
										<label for="aZipCode" class="form-label">Zip Code<i class="text-danger">*</i></label>
										<input type="text" id="aZipCode" class="form-control" placeholder="Enter your zip code" required />
									</div>
								</div>

								</div>
							<button class="btn btn-primary" style="display:block !important; width:100%" onclick="nextStepfunc('pi')">Continue <i class="bx bx-right-arrow-alt"></i></button>
							</div>
							<!-- end of div -->
						<!-- start of extra person info -->
						<div id="extrapi-part" class="content fade" role="tabpanel" aria-labelledby="extrapi-part-trigger" >
						<h4>Contact Information</h4>
							<p>Please provide your current and accurate contact information to ensure effective communication during the application process. </p>
							<!-- Contact Information div -->
								<div class="row g-2 mb-2">
									<div class="col mb-0">
										<label for="nameBackdrop" class="form-label">Date of Birth<i class="text-danger">*</i></label>
										<input
										type="date"
										id="aBirthDate"
										class="form-control"
										placeholder="Enter Date of Birth" onchange="calculateAge()"/>
									</div>
									<div class="col mb-0">
									<label for="nameBackdrop" class="form-label">Civil Status<i class="text-danger">*</i></label>
									<select name="civilstatus" id="aCivilStatus" class="form-select">
										<option value="">Select your Civil Status</option>
										<option value="Single">Single</option>
										<option value="Married">Married</option>
										<option value="Widowed">Widowed</option>
									</select>
									</div>
                                </div>
								<div class="row g-3 mb-2">
									<div class="col mb-0">
										<label for="nameBackdrop" class="form-label">Place of Birth<i class="text-danger">*</i></label>
										<input
										type="text"
										id="aBirthPlace"
										class="form-control"
										placeholder="Enter your birthplace" />
									</div>
									<div class="col mb-0">
										<label for="nameBackdrop" class="form-label">Gender<i class="text-danger">*</i></label>
										<select name="gender" id="aGender" class="form-select">
											<option value="">Select your Gender</option>
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
									</div>
									<div class="col mb-0">
										<label for="nameBackdrop" class="form-label">Age<i class="text-danger">*</i></label>
										<input
										type="number"
										id="aAge"
										class="form-control"
										placeholder="Enter your age" disabled/>
									</div>
								  </div>
								  <div class="row mb-2">
								  		 <label for="nameBackdrop" class="form-label">Residence<i class="text-danger">*</i></label>
										 <div class="mx-2 my-1">
												<!-- <input type="radio" class="btn-check btn-primary" name="options" id="aTemporary" autocomplete="off" checked>
												<label class="btn btn-info bnt-r" for="aTemporary" style="display:inline;width:auto;margin-right:15px">Temporary</label> -->

												<input type="radio" class="btn-check btn-primary" name="options" id="aRented" autocomplete="off" checked>
												<label class="btn btn-info bnt-r" for="aRented" style="display:inline;width:auto;margin-right:15px" onclick="divIsShown(true)">Rented</label>

												<!-- <input type="radio" class="btn-check btn-primary" name="options" id="aLivingWith" autocomplete="off">
												<label class="btn btn-info bnt-r" for="aLivingWith" style="display:inline;width:auto;margin-right:15px">Living With</label> -->

												<input type="radio" class="btn-check btn-primary" name="options" id="aOwned" autocomplete="off">
												<label class="btn btn-info bnt-r" for="aOwned" style="display:inline;width:auto;margin-right:15px" onclick="divIsShown(false)">Owned</label>
										 </div>
								  </div>
								<div class="row mb-3" id="monthlyifrenteddiv">
                                  <div class="col mb-0">
                                    <label for="aMonthlyIfRented" class="form-label">Monthly if rented<i class="text-danger">*</i></label>
									<input type="text" id="aMonthlyIfRented" class="form-control" placeholder="Enter Amount" />
                                  </div>
                                </div>
							<button class="btn btn-primary my-2" style="display:block !important; width:100%" onclick="nextStepfunc('pi-extra')">Continue <i class="bx bx-right-arrow-alt"></i></button>
							<button class="btn btn-secondary my-1" style="display:block !important; width:100%" onclick="stepper.previous()"><i></i> Back</button>
						</div>
						<!-- end of extra person info -->
						
						<!-- start of Family Background -->
						<div id="information-part" class="content fade" role="tabpanel" aria-labelledby="information-part-trigger" >
						<h4>Family Background</h4>
							<p>Please provide information about your family background to help us better understand your personal context and background. </p>
							<!-- Personal Information div -->
								
								<div class="row g-2 mb-2">
                                  <div class="col mb-0">
                                    <label for="aFatherFullName" class="form-label">Father's Name<i class="text-danger">*</i></label>
									<input type="text" id="aFatherFullName" class="form-control" placeholder="Enter your father's full name" />
                                  </div>
                                  <div class="col mb-0">
									<label for="aFatherProfession" class="form-label">Father's Profession</label>
                                    <input type="text" id="aFatherProfession" class="form-control" placeholder="Enter your father's profession" />
                                  </div>
                                </div>
								<div class="row g-2 mb-2">
                                  <div class="col mb-0">
                                    <label for="aMotherFullName" class="form-label">Mother's Name<i class="text-danger">*</i></label>
									<input type="text" id="aMotherFullName" class="form-control" placeholder="Enter your mother's full name" />
                                  </div>
                                  <div class="col mb-0">
									<label for="aMotherProfession" class="form-label">Mother's Profession</label>
                                    <input type="text" id="aMotherProfession" class="form-control" placeholder="Enter your mother's profession" />
                                  </div>
                                </div>

								<div class="row g-2 mb-2">
                                  <div class="col mb-0">
                                    <label for="aSpouseFirstName" class="form-label">Your Spouse/Partner</label>
									<input type="text" id="aSpouseFirstName" class="form-control" placeholder="Enter your spouse first name" />
                                  </div>
                                  <div class="col mb-0">
									<label for="aSpouseLastName" style="margin-bottom:8px">&nbsp;</label>
                                    <input type="text" id="aSpouseLastName" class="form-control" placeholder="Enter your spouse last name" />
                                  </div>
                                </div>
								<div class="row g-2 mb-2">
									<div class="col mb-0">
										<label for="nameBackdrop" class="form-label">Spouse Profession</label>
										<input
										type="text"
										id="aPartnerProfession"
										class="form-control"
										placeholder="Enter your partner's profession" />
									</div>
									<div class="col mb-0">
									<label for="aPartnerPhoneNo" class="form-label">Spouse Phone Number</label>
										<input
										type="email"
										id="aPartnerPhoneNo"
										class="form-control"
										placeholder="Enter your spouse phone number" />
									</div>
								  </div>
							<button class="btn btn-primary my-2" style="display:block !important; width:100%" onclick="nextStepfunc('ci')">Continue <i class="bx bx-right-arrow-alt"></i></button>
							<button class="btn btn-secondary my-1" style="display:block !important; width:100%" onclick="stepper.previous()"><i></i> Back</button>
						</div>
						<!-- end of Family Background -->

						<!-- extra family background -->
						<div id="soi-part" class="content fade" role="tabpanel" aria-labelledby="soi-part-trigger">
							<h4>Source of Income</h4>
							<p>Please specify the source of your income to help us assess your financial background accurately. </p>
								<div class="row mb-2">
									<div class="col mb-0">
										<label for="nameBackdrop" class="form-label">Nature of Income<i class="text-danger">*</i></label>
										<input
										type="text"
										id="aNatureOfIncome"
										class="form-control"
										placeholder="Enter nature of income" />
									</div>
                                </div>
								<div class="row mb-2">
									<div class="col mb-0">
										<label for="nameBackdrop" class="form-label">Profession<i class="text-danger">*</i></label>
										<input
										type="text"
										id="aPersonalProfession"
										class="form-control"
										placeholder="Enter your profession" />
									</div>
                                </div>
								<div class="row mb-2">
									<div class="col mb-0">
										<label for="nameBackdrop" class="form-label">Address<i class="text-danger">*</i></label>
										<input
										type="text"
										id="aAddressNOI"
										class="form-control"
										placeholder="Enter Address" />
									</div>
                                </div>
								<div class="row mb-2">
									<div class="col mb-0">
										<label for="nameBackdrop" class="form-label">Daily Sales<i class="text-danger">*</i></label>
										<input
										type="text"
										id="aDailySales"
										class="form-control"
										placeholder="Daily Sales" />
									</div>
                                </div>
								<div class="row mb-2">
									<div class="col mb-0">
										<label for="nameBackdrop" class="form-label">Monthly Earning<i class="text-danger">*</i></label>
										<input
										type="text"
										id="aMonthlyEarnings"
										class="form-control"
										value="0"
										placeholder="Type your Monthly earnings" />
									</div>
                                </div>
							<button class="btn btn-primary my-2" style="display:block !important; width:100%" onclick="nextStepfunc('soi-extra')">Continue <i class="bx bx-right-arrow-alt"></i></button>
							<button class="btn btn-secondary my-1" style="display:block !important; width:100%" onclick="stepper.previous()"><i></i> Back</button>
	
						</div>
						<!-- end extra -->

						<!-- financial calculator -->
						<div id="fc-part" class="content fade" role="tabpanel" aria-labelledby="fc-part-trigger" >
						<h4>Financial Calculator</h4>
							<p>This financial calculator helps you estimate your total income based on your salary and other income sources. Please enter the relevant information in the input fields below: </p>
							<table width="100%" class="mb-3">
								<tr>
									<td>
										<div class="row mb-2">
										<div class="col mb-0">
											<label for="nameBackdrop" class="form-label">Loan Amount<i class="text-danger">*</i></label>
											<input
											type="number"
											id="aLoanAmount"
											class="form-control"
											placeholder="P 0.00" />
										</div>
									</div>
									</td>
									<td rowspan="3">
										<div class="card shadow-none bg-transparent border border-primary mx-3">
											<div class="card-body">
                                            <small class="text-mute">Daily Payment</small>
                                            <table width="100%">
                                                <tr>
                                                    <td>
                                                        <span>₱ <h3 style="display:inline" id="aDailyPayment">100.00</h3></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small class="fs-11">Loan Total</small>
                                                    </td>
                                                    <td>
                                                        <small class="fs-11">Interest Rate</small>
                                                    </td>
                                                    <td>
                                                        <small class="fs-11">Notarial Fee</small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label id="aLoanTotal">₱ 0.00</label>
                                                    </td>
                                                    <td>
                                                        <label id="aInterestRate">8%</label>
                                                    </td>
                                                    <td>
                                                        <label id="aNotarialFee">₱ 0.00</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small class="fs-11">Processing Fee</small>
                                                    </td>
                                                    <td>
                                                        <small class="fs-11">Service Fee</small>
                                                    </td>
                                                    <td>
                                                        <small class="fs-11">Insurance</small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label id="aProcessingFee">₱ 0.00</label>
                                                    </td>
                                                    <td>
                                                        <label id="aServiceFee">₱ 0.00</label>
                                                    </td>
                                                    <td>
                                                        <label id="aInsurance">₱ 0.00</label>
                                                    </td>
                                                </tr>
                                            </table>
											</div>	
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="row mb-2">
											<div class="col mb-0">
												<label for="nameBackdrop" class="form-label">Loan Term<i class="text-danger">*</i></label>
                                                <div class="input-group mb-3">
                                                    <input type="number" id="aLoanTerm" class="form-control" min="1" value="1" placeholder="Enter number of days" aria-label="Loan Term" aria-describedby="basic-addon2">
                                                    <span class="input-group-text" id="basic-addon2">Days</span>
                                                </div>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
											<div class="row mb-2">
											<div class="col mb-0">
												<label for="nameBackdrop" class="form-label">Net Amount Released<i class="text-danger">*</i></label>
												<input
												type="text"
												id="aNetAmountReleased"
												class="form-control"
												placeholder="P 0.00" readonly/>
											</div>
										</div>
									</td>
								</tr>
							</table>	
							<button class="btn btn-primary my-2" style="display:block !important; width:100%" onclick="nextStepfunc('fc')">Continue <i class="bx bx-right-arrow-alt"></i></button>
							<button class="btn btn-secondary my-1" style="display:block !important; width:100%" onclick="stepper.previous()"><i></i> Back</button>

						</div>
						<!-- end of financial calculator -->

                        <!-- extra upload -->
                        <div id="extraupload-part" class="content fade" role="tabpanel" aria-labelledby="soi-part-trigger">
							<form method="post" id="uploadDocsForm"  enctype="multipart/form-data">
							<h4>Identity Documents</h4>
							<p>Please upload clear and valid copies of your identity documents to verify your identity. Accepted documents may include government-issued IDs, passports, or driver's licenses. Ensure that the documents are up-to-date and clearly visible. </p>
								<div class="row g-2 mb-3">
									<div class="col mb-0">
										<label for="nameBackdrop" class="form-label">Selfie with a proof<i class="text-danger">*</i></label>
                                        <div class="form-group files" >
                                            <input type="file" id="aUploadDocs" name="files[]" accept="image/*" multiple>
                                        </div>
									</div>	
                                    <div class="col mb-0"><center>
                                        <label for="nameBackdrop" class="form-label" style="margin-bottom: 8px;"> &nbsp;</label>
										<img src="./assets/img/selfie.png" alt="selfie">
                                        <label class="text-center">Take a Selfie with your ID</label><br>
                                        <small class="text-center" style="font-size: 10px;">Valid government Id accepted: Passport, UMID, Driver's License, National ID.</small>
                                        </center>
									</div>
                                </div>
                                <div class="row mb-3 mx-2">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="aTermsAndCondition" unchecked>
        <label class="form-check-label" for="aTermsAndCondition"> I have read and agree to the <a href="#" class="text-primary" id="termsLink">Terms & Conditions</a> and <a href="#" class="text-primary" id="privacyLink">Privacy Policy</a></label>
    </div>
</div>

<!-- Terms and Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Terms & Conditions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your Terms and Conditions content here -->
                <p>1. Eligibility: By using the Loan Management System, you affirm that you are at least 18 years old and capable of entering into a legally binding agreement.</p>
                <p>2. Loan Application: Submitting a loan application through this system does not guarantee approval...</p>
                <!-- Include other terms as needed -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Privacy Policy Modal -->
<div class="modal fade" id="privacyModal" tabindex="-1" role="dialog" aria-labelledby="privacyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="privacyModalLabel">Privacy Policy</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your Privacy Policy content here -->
                <p>1. Information Collection: We collect personal and financial information solely for the purpose of processing loan applications...</p>
                <p>2. Use of Information: The information collected is used to evaluate loan applications, determine eligibility...</p>
                <!-- Include other privacy policy points as needed -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Activate modals when their respective links are clicked
    document.getElementById('termsLink').addEventListener('click', function () {
        $('#termsModal').modal('show');
    });

    document.getElementById('privacyLink').addEventListener('click', function () {
        $('#privacyModal').modal('show');
    });
</script>
							<button type="button" class="btn btn-primary my-2" style="display:block !important; width:100%" onclick="nextStepfunc('id-extra')">Submit <i class="bx bx-send"></i></button>
							</form>
							<button class="btn btn-secondary my-1" style="display:block !important; width:100%" onclick="stepper.previous()"><i></i> Back</button>
						</div>
                        <!-- end extra  -->

						<div id="fourth-part" class="content fade" role="tabpanel" aria-labelledby="fourth-part-trigger">
							<div class="row my-5">
                                <center>
                                    <h3>Thank You! You're all set</h3>
                                    <small>Thank you for your application! We'll review it within</small><br>
                                    <small>3-4 business days and our team will contact you for</small><br>
                                    <small>the next steps in obtaining your loan.</small><br><br>

                                    <small>For any further inquiries, please contact us</small><br>
                                    <small><span class="text-primary">+63 000 000 0000</span> and <span class="text-primary">jlofinancialsystem@gmail.com</span></small><br>
                                </center>
                            </div>
                            <a class="btn btn-primary" style="display:block !important; width:100%" href="./index.php">Back to Home</i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>

   <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="./assets/vendor/libs/jquery/jquery.js"></script>
    <script src="./assets/vendor/libs/popper/popper.js"></script>
    <script src="./assets/vendor/js/bootstrap.js"></script>
    <script src="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="./assets/vendor/js/menu.js"></script>
	<script src="./assets/js/stepper.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script> -->
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
	var stepper = new Stepper($('.bs-stepper')[0])
	var data = [];
	var loanExtraInfo = [];
	var personInfo = [];
	var extraPersonInfo = [];
	var familyBackGround = [];
	var sourceOfIncome = [];
	var loaninfo = [];
	var uploaded = [];
	var _newFileName = '';
	var _newFileName2 = '';

	function divIsShown(param){
		//if truee meaning its rented
		if(param == true){
			$('#monthlyifrenteddiv').slideDown(300);
		}else{
			$('#monthlyifrenteddiv').slideUp(300);
		}
	}

	function calculateAge() {
            var dob = document.getElementById("aBirthDate").value;

            var today = new Date();
            var birthDate = new Date(dob);
            var age = today.getFullYear() - birthDate.getFullYear();

            if (today.getMonth() < birthDate.getMonth() || (today.getMonth() == birthDate.getMonth() && today.getDate() < birthDate.getDate())) {
                age--;
            }
            document.getElementById("aAge").value = age;
    }
		
	function nextStepfunc(stepName){
		
		if(stepName == "pi"){
			var firstName = $('#aFirstName').val();
			var lastName = $('#aLastName').val();
			var mobileNumber = $('#aMobileNo').val();
			var email = $('#aEmail').val();
			var presentAddress = $('#aPresentAddress').val();
			var city = $('#aCity').val();
			var province = $('#aProvince').val();
			var zipCode = $('#aZipCode').val();
			if(firstName == "" || lastName == "" || mobileNumber == "" || email == "" || presentAddress == "" || city == "" || province == "" || zipCode == ""){
				swal("Error", "Empty Field/s Detected", "error");
				return;
			}

			personInfo = {
				FirstName: firstName,
				LastName: lastName,
				MobileNumber: mobileNumber,
				Email: email,
				PresentAddress: presentAddress,
				City: city,
				Province: province,
				ZipCode: zipCode
			};

			$('#pi-circle').addClass('remainActive');
			stepper.next();
		}
		else if(stepName == "pi-extra"){
			var birthDate = $('#aBirthDate').val();
			var civilStatus = $('#aCivilStatus').val();
			var birthPlace = $('#aBirthPlace').val();
			var gender = $('#aGender').val();
			var age = $('#aAge').val();
			var monthlyIfRented = $('#aMonthlyIfRented').val();

			// var temporary = $('#aTemporary').is(':checked');
			var rented = $('#aRented').is(':checked');
			// var livingWith = $('#aLivingWith').is(':checked');
			var owned = $('#aOwned').is(':checked');
			var residency = "";
			// if(temporary == true){
			// 	residency = 'Temporary';
			// }
			// else if (livingWith == true){
			// 	residency = 'Living With';
			// }

			if (rented == true){
				residency = 'Rented';
			}
			else{
				residency = 'Owned';
			}

			if(rented == true && monthlyIfRented == ""){
				swal("Error", "Empty Field/s Detected", "error");
				return;
			}

			if(birthDate == "" || civilStatus == "" || birthDate == "" || gender == "" || age == "" ){
				swal("Error", "Empty Field/s Detected", "error");
				return;
			}
			if(age < '18')
			{
				swal("Warning","Sorry 18 below is not allowed","warning");
				return;
			}

			extraPersonInfo = {
				BirthDate: birthDate,
				CivilStatus: civilStatus,
				BirthPlace: birthPlace,
				Gender: gender,
				Age: age,
				MonthlyIfRented: (monthlyIfRented == "" ? 0 : monthlyIfRented),
				Residency: residency
			}
			$('#extrapi-line').addClass('remainActive');
			$('#ip-line').addClass('remainActiveLiners');
			stepper.next();
		}
		else if(stepName == "ci"){
			var spouseFName = $('#aSpouseFirstName').val();
			var spouseLName = $('#aSpouseLastName').val();
			var spouseProfession = $('#aPartnerProfession').val();
			var spousePhoneNo = $('#aPartnerPhoneNo').val();
			var aFatherFullName = $('#aFatherFullName').val();
			var aFatherProfession = $('#aFatherProfession').val();
			var aMotherFullName = $('#aMotherFullName').val();
			var aMotherProfession = $('#aMotherProfession').val();

			if(aFatherFullName == "" || aFatherProfession == "" || aMotherFullName == "" || aMotherProfession == ""){
				swal("Error", "Empty Field/s Detected", "error");
				return;
			}

			familyBackGround = {
				SFirstName: spouseFName,
				SLastName: spouseLName,
				SProfession: spouseProfession,
				SContactNo: spousePhoneNo,
				FatherFullName: aFatherFullName,
				FatherProfession: aFatherProfession,
				MotherFullName: aMotherFullName,
				MotherProfession: aMotherProfession,
			};

			// $('#extrapi-line').addClass('remainActive');
			$('#ip-circle').addClass('remainActive');
			stepper.next();
		}
		else if (stepName == "ci-extra"){
			
			if(natureOfIncome == "" || addressSOI == "" || dailySales == "" || monthlyEarnings == "" ){
				swal("Error", "Empty Field/s Detected", "error");
				return;
			}
			console.log('sadnasjdksan');
			$('#extraci-line').addClass('remainActive');
			// $('#fc-line').addClass('remainActive');
			stepper.next();
		}
        else if(stepName == "soi-extra"){
			// var loanAmount = $('#aLoanAmount').val();
			// var loanTerm = $('#aLoanTerm').val();
		
			var natureOfIncome = $('#aNatureOfIncome').val();
			var aPersonalProfession = $('#aPersonalProfession').val();
			var addressSOI = $('#aAddressNOI').val();
			var dailySales = $('#aDailySales').val();
			var monthlyEarnings = $('#aMonthlyEarnings').val();

			if(natureOfIncome == "" || addressSOI == "" || dailySales == "" || monthlyEarnings == "" || aPersonalProfession == "")
			{
				swal("Error", "Empty Field/s Detected", "error");
				return;
			}

			sourceOfIncome = {
				NatureOfIncome: $('#aNatureOfIncome').val(),
				AddressSOI: $('#aAddressNOI').val(),
				DailySales: $('#aDailySales').val(),
				MonthlyEarnings: $('#aMonthlyEarnings').val(),
				PersonalProfession : $('#aPersonalProfession').val()
			};

            $('#extraci-line').addClass('remainActive');
            $('#fc-line').addClass('remainActiveLiners');

            stepper.next();
        }
        else if(stepName == "fc"){
			loaninfo = {
				LoanAmount: $('#aLoanAmount').val(),
				LoanTerm: $('#aLoanTerm').val(),
				DailyPayment: $('#aDailyPayment').text()
			};

				
			if(loaninfo.LoanAmount == "" || loaninfo.LoanTerm == "")
			{
				swal("Error", "Empty Field/s Detected", "error");
				return;
			}

            $('#fc-circle').addClass('remainActive');
			stepper.next();
        }else if (stepName == "id-extra"){


			if($('#aUploadDocs').val() == ""){
				swal("Error", "Please upload a document!", "error");
				return;
			}

			var fileInput = document.getElementById('aUploadDocs');
            var uploadedFilesCount = fileInput.files.length;
			if (uploadedFilesCount !== 2) {
				swal("Error", "Please upload exactly two files.", "error");
                return;
            }

			if($('#aTermsAndCondition').is(":checked") == false){
				swal("Error", "Pleases check the Terms & Condition", "error");
				return;
			}

			swal({
				title: "Loan Application",
				text: "Are you sure you want to submit your application?",
				type: "info",
				showCancelButton: true,
				closeOnConfirm: false,
				showLoaderOnConfirm: true,
				}, function () {
				
				
				$('#uploadDocsForm').submit();
				
				uploaded = {
						CustomerFile: _newFileName,
						CustomerFile2: _newFileName2
				};
				
				data = {
					PI: personInfo,
					EPI: extraPersonInfo,
					FBG: familyBackGround,
					SOI: sourceOfIncome,
					LI: loaninfo,
					LEI: loanExtraInfo,
					UP: uploaded
				}
				var isSuccess = false;

				$.ajax({
                    url: "/JLOFinancial/methods/customerController.php",
                    type: 'POST',
					async: false,
                    data: {
                        "RegisterCustomer": 1,
                        "paramData": data
                    },
                    success: function(response) {
                        if (response.includes("error")) {
                            swal("No changes detected", "Please double check your entries.");
                        } else {
							isSuccess = true;
                        }
                    }
           		 });

				 if(isSuccess == true){
							setTimeout(function () {
								$('#extraupload-line').addClass('remainActive');
								$('#eu-line').addClass('remainActiveLiners');
								stepper.next();
								swal.close();
							}, 1000);
				 }
			});
        }
	}

	$(document).ready(function () {

		$('#uploadDocsForm').submit(function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				type: 'POST',
				url: "/JLOFinancial/methods/uploadFile.php",
				data: formData,
				async:false,
				processData: false,
				contentType: false,
				success: function (response) {
					var getResult = response.replace('successful-','');
					var splitResult = getResult.split('|');
					_newFileName = splitResult[0];
					_newFileName2 = splitResult[1];
				}
			});
		})

		$('#aLoanTerm').change(function(){
			var la = parseFloat($('#aLoanAmount').val());

			if(la != 0){
				var res = la / parseInt($('#aLoanTerm').val());
				$('#aDailyPayment').html(res.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2}));
			}
		});
		
		$('#aLoanAmount').on('keyup',function(){
			if($(this).val() >= 500){
				var loan = parseInt($('#aLoanAmount').val());
				$('#aLoanTerm').trigger('change');
				$('#aLoanTotal').val(parseInt(loan).toFixed(2));

				var processingFee = (2.5/100) * loan;
				var serviceFee = (1.2/100) * loan;
				var notarialFee = 0;
				var insuranceFee = getInsurance(loan);
				if(loan >= 5000){
					notarialFee = 100;
				}
				var netAmount = (loan - (processingFee + serviceFee + notarialFee + insuranceFee));


				var beginningBalance= ((8/100) * loan) + loan;

				$('#aLoanTotal').text('₱ ' + parseFloat(beginningBalance).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2}));
				$('#aInsurance').text('₱ ' + insuranceFee.toFixed(2));
				$('#aNotarialFee').text('₱ ' + notarialFee.toFixed(2));
				$('#aProcessingFee').text('₱ ' + processingFee.toFixed(2));
				$('#aServiceFee').text('₱ ' + serviceFee.toFixed(2));
				$('#aNetAmountReleased').val('₱ ' + netAmount.toFixed(2));

				loanExtraInfo = {
					BeginningBalance: beginningBalance,
					Insurance: insuranceFee,
					NotarialFee: notarialFee,
					ProcessingFee: processingFee,
					ServiceFee: serviceFee,
					NetAmountReleased: netAmount
				};
			}
			else{
				$('#aLoanTotal').text('₱ 0.00');
				$('#aInsurance').text('₱ 0.00');
				$('#aNotarialFee').text('₱ 0.00');
				$('#aProcessingFee').text('₱ 0.00');
				$('#aServiceFee').text('₱ 0.00');
				$('#aNetAmountReleased').val('');
			}
		});

	})

	function getInsurance(amount){
		if(amount >= 1000 && amount <= 15999){
			return 190;
		}
		else if(amount >= 16000 && amount <= 30999){
			return 360;
		}
		else if(amount >= 31000 && amount <= 50999){
			return 550;
		}
		else if(amount >= 51000 && amount <= 70999){
			return 800;
		}
		else if(amount >= 71000 && amount <= 100999){
			return 1100;
		}
		else if(amount >= 101000 && amount <= 150000){
			return 1600;
		}else{
			return 0;
		}
	}
</script>
</html>