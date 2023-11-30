 <!-- Layout wrapper -->
 <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="dashboard.php" class="app-brand-link">
            <span class="app-brand-logo demo"><img src="../assets/img/photologo.png" alt="" width="" height="35" /> </span>
              <span class="app-brand-logo demo"><img src="../assets/img/textlogo.png" alt="" width="148" height="35" /> </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item" id="d-menu">
              <a href="./dashboard.php" class="menu-link" id="dashBoardMenuLink">
                <i class="menu-icon tf-icons bx bx-category" ></i>
                <div data-i18n="Dashboard">Dashboard</div>
              </a>
            </li>
            <li class="menu-item" id="cm-menu">
              <a href="./customer.php" class="menu-link" id="customerMenuLink">
                <i class="menu-icon tf-icons bx bx-money-withdraw"></i>
                <div data-i18n="Dashboards">Customers</div>
              </a>
            </li>
            <li class="menu-item" id="cr-menu">
              <a href="./collectionreport.php" class="menu-link" id="collectionReportMenuLink">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div data-i18n="Dashboards">Collection Report</div>
              </a>
            </li>
            <li class="menu-item" id="od-menu">
              <a  href="./overduepayments.php" class="menu-link" id="overduePaymentsMenuLink">
                <i class="menu-icon tf-icons bx bx-calendar-exclamation"></i>
                <div data-i18n="Dashboards">Overdue Payments</div>
              </a>
            </li>
            <li class="menu-item" id="ph-menu">
              <a href="./paymenthistory.php" class="menu-link" id="paymentHistoryMenuLink">
                <i class="menu-icon tf-icons bx bx-calendar-week"></i>
                <div data-i18n="Dashboards">Payment History</div>
              </a>
            </li>
            <!-- <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <div data-i18n="Dashboards">Account Information</div>
              </a>
            </li> -->
            <!-- SETTINGS -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">S E T T I N G S</span></li>
            <li class="menu-item" id="prof-menu">
              <a
                href="./profile.php"
                target="_self"
                class="menu-link" id="profMenuLink">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Documentation">User Settings</div>
              </a>
            </li>
            <!-- <li class="menu-item">
              <a
                href="#"
                target="_self"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Help & Support</div>
              </a>
            </li> -->
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none ps-1 ps-sm-2"
                    placeholder="Search..."
                    aria-label="Search..." />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item lh-1 me-3">
                  <label for=""><?php echo $_SESSION['user-es']['FirstName'] . ' ' . $_SESSION['user-es']['LastName'] ?></label><br>
                  <small class="text-muted"><?php echo $_SESSION['user-es']['Role'] ?></small>
                </li>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../assets/img/user-avatar.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../assets/img/user-avatar.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-medium d-block"><?php echo $_SESSION['user-es']['FirstName'] . ' ' . $_SESSION['user-es']['LastName'] ?></span>
                            <small class="text-muted"><?php echo $_SESSION['user-es']['Role'] ?></small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="./profile.php">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="../logout.php">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
           
     