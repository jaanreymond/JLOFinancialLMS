<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | JLO</title>
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
</head>

<body>
  <?php $path = $_SERVER['DOCUMENT_ROOT'];
  include_once($path . "/JLOFinancial/methods/sessionChecker.php");

  if ($_SESSION['user-es']['Role'] != 'Collector') {
    header("Location: /JLOFinancial/auth.php");
  }
  ?>
  <?php include($path . "/JLOFinancial/comp/collectorNavbar.php") ?>

  <!-- Content -->

  <div class="container flex-grow-1 container-p-y">
    <h4>Summary</h4>

    <!-- Collections Overview -->
    <div class="row">
      <div class="col-md-4 order-1 mb-4">
        <div class="card h-100">
          <div class="card-header">
            <h5>Total Daily Collection</h5>
          </div>
          <div class="card-body px-0">
            <div id="dailyTotalCollection" style="text-align: -webkit-center;"></div>

          </div>
        </div>
      </div>

      <div class="col-md-4 order-1 mb-4">
        <div class="card h-100">
          <div class="card-header">
            <h5>Daily Active Collection</h5>
          </div>
          <div class="card-body px-0">
            <div id="dailyActiveCollection" style="text-align: -webkit-center;"></div>
          </div>
        </div>
      </div>


      <div class="col-md-4 col-lg-4 order-1 mb-4">
        <div class="card h-100">
          <div class="card-header">
            <h5>Total Overdue Collection</h5>
          </div>
          <div class="card-body px-0">
            <div id="dailyOverDuedCollection" style="text-align: -webkit-center;"></div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Collections Overview -->

     <!-- Expense Overview -->
     <div class="row">
                <div class="col-md-12 order-1">
                  <div class="card">
                    <div class="card-header">
                      <h5 style="margin-bottom: 0px !important">Monthly Collection</h5>
                    </div>
                    <div class="card-body px-0">
                        <div class="container row">
                            <div class="col-md-4">
                                  <label class="mb-2">Collected Yesterday</label>
                                  <h2 id="collectedYesterday"></h2>
                            </div>
                            <div class="col-md-4">
                                  <label class="text-primary mb-2">Collected Today</label>
                                  <h2 id="collectedToday" class="text-primary"></h2>
                            </div>
                            <div class="col-md-12">
                                  <div class="card-header" style="margin-bottom:0px">
                                  <h5>Overall Collection</h5>
                                </div>
                                <div id="MonthlyCollectionChart"></div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
     </div>
    
         <!--/ Expense Overview -->

  </div>

  <?php include($path . "/JLOFinancial/comp/footer.php") ?>
</body>
<script>
  $(document).ready(function() {
    $('#d-menu').addClass('active');
    $('#mu-menu').removeClass('active');
    $('#cm-menu').removeClass('active');
    $('#la-menu').removeClass('active');
    $('#cr-menu').removeClass('active');
    $('#ph-menu').removeClass('active');

    $('#dashBoardMenuLink').attr({
      'href': 'javascript:void(0);'
    });


    $.ajax({
      url: "/JLOFinancial/methods/dashboardController.php",
      type: 'POST',
      data: {
        "GetDashBoardData": 1
      },
      success: function(response) {
        var data = JSON.parse(response);
        
        $('#collectedYesterday').html('₱' + parseFloat(data.YesterdayCollection).toLocaleString());
        $('#collectedToday').html('₱' + parseFloat(data.totalCollection).toLocaleString());

        // first block
        var options = {
          series: [100],
          chart: {
            height: 250,
            type: 'radialBar',
          },
          plotOptions: {
            radialBar: {
              hollow: {
                size: '70%',
                image: '../assets/img/landing/activeloan.png',
                imageWidth: 52,
                imageHeight: 52,
                imageClipped: false,
                imageOffsetY: -20
              },
              dataLabels: {
                name: {
                  fontSize: '26px',
                  offsetY: 30,
                },
                value: {
                  fontSize: '13px',
                  offsetY: 40,
                  fontWeight: 600,
                  color: '#566a7f',
                },
                total: {
                  show: true,
                  label: '₱ ' + parseFloat(data.totalCollection).toLocaleString(),

                  formatter: function(w) {
                    // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                    return 'Total Loans'
                  }
                }
              }
            }
          }
        };

        var chart = new ApexCharts(document.querySelector("#dailyTotalCollection"), options);
        chart.render();


        // end first block

        //2nd block

        var getPercentage = (parseFloat(data.ActiveCollection) / parseFloat(data.totalCollection)) * 100;

        var options2 = {
          series: [getPercentage],
          chart: {
            height: 250,
            type: 'radialBar',
          },
          plotOptions: {
            radialBar: {
              hollow: {
                size: '70%',
                image: '../assets/img/landing/activeloan.png',
                imageWidth: 52,
                imageHeight: 52,
                imageClipped: false,
                imageOffsetY: -20
              },
              dataLabels: {
                name: {
                  fontSize: '26px',
                  offsetY: 30,
                },
                value: {
                  fontSize: '13px',
                  offsetY: 40,
                  fontWeight: 600,
                  color: '#566a7f',
                },
                total: {
                  show: true,
                  label: '₱ ' + parseFloat(data.ActiveCollection).toLocaleString(),

                  formatter: function(w) {
                    // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                    return 'Active Loans'
                  }
                }
              }
            }
          }
        };

        var activeChart = new ApexCharts(document.querySelector("#dailyActiveCollection"), options2);
        activeChart.render();

        // end of 2nd block

        //3rd block
        var getPercentage2 = (parseFloat(data.OverDueCollection) / parseFloat(data.totalCollection)) * 100;
        // ff3e1d
        var options3 = {
          series: [getPercentage2],
          chart: {
            height: 250,
            type: 'radialBar',
          },
          plotOptions: {
            radialBar: {
              hollow: {
                size: '70%',
                image: '../assets/img/landing/overdue.png',
                imageWidth: 52,
                imageHeight: 52,
                imageClipped: false,
                imageOffsetY: -20
              },
              dataLabels: {
                name: {
                  fontSize: '26px',
                  offsetY: 30,
                },
                value: {
                  fontSize: '13px',
                  offsetY: 40,
                  fontWeight: 600,
                  color: '#566a7f',
                },
                total: {
                  show: true,
                  label: '₱ ' + parseFloat(data.OverDueCollection).toLocaleString(),

                  formatter: function(w) {
                    // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                    return 'Overdued Loans'
                  }
                }
              }
            }
          },
          colors: ['#ff3e1d']
        };

        var overDueChart = new ApexCharts(document.querySelector("#dailyOverDuedCollection"), options3);
        overDueChart.render();
        // end of 3rd block

      


      }
    });


    $.ajax({
      url: "/JLOFinancial/methods/dashboardController.php",
      type: 'POST',
      data: {
        "GetMonthlyCollection": 1
      },
      success: function(response) {

          var data = JSON.parse(response);
          // monthly
          var dataMonthly = [];
          for(var i = 1; i <= 12; i++){

            var hasVal = false;
            for(j = 0; j < data.length; j++){
              if(parseInt(data[j].Month) == i){
                dataMonthly.push(parseFloat(data[j].TotalSum))
                hasVal = true;
              }
            }
            
            if(hasVal == false){
              dataMonthly.push(0);
            }
          }

          var options5 = {
          series: [{
          name: 'Collection',
          data: [dataMonthly[0], dataMonthly[1], dataMonthly[2], dataMonthly[3], dataMonthly[4], dataMonthly[5], dataMonthly[6], dataMonthly[7], dataMonthly[8], dataMonthly[9], dataMonthly[10], dataMonthly[11]]
        }],
          chart: {
          height: 350,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 10,
            dataLabels: {
              position: 'top', // top, center, bottom
            },
          }
        },
        dataLabels: {
          enabled: true,
          formatter: function (val) {
            return '₱ ' + val.toLocaleString();
          },
          offsetY: -20,
          style: {
            fontSize: '12px',
            colors: ["#304758"]
          }
        },
        
        xaxis: {
          categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          position: 'top',
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            fill: {
              type: 'gradient',
              gradient: {
                colorFrom: '#D8E3F0',
                colorTo: '#BED1E6',
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              }
            }
          },
          tooltip: {
            enabled: true,
          }
        },
        yaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false,
          },
          labels: {
            show: false,
            formatter: function (val) {
              return '₱ ' + val.toLocaleString();
            }
          }
        
        },
        // title: {
        //   text: 'Monthly Inflation in Argentina, 2002',
        //   floating: true,
        //   offsetY: 330,
        //   align: 'center',
        //   style: {
        //     color: '#444'
        //   }
        // }
        };

        var MonthlyCollectionChart = new ApexCharts(document.querySelector("#MonthlyCollectionChart"), options5);
        MonthlyCollectionChart.render();

        // end of monthly

      }
    });
    

  })
</script>

</html>