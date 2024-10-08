<?php
require './template/header.php';
?><style>
  .mes-container {
    display: flex;
    flex-wrap: wrap;
  }

  .mes-item {
    width: 200px;
    margin: 5px;
    margin-left: 60px;
    padding: 10px;
    border: 1px solid #000;
    text-align: center;
  }
</style>
<?php if ($_SESSION['admin'] == 1) : ?>
  <div class="panel-header panel-header-lg">
    <canvas id="bigDashboardChart"></canvas>
  </div>
  <div class="content">
    <div class="row">
      <div class="col-lg-4">
        <div class="card card-chart">
          <div class="card-header">
            <h4 class="card-title">Todos los casos</h4>
            <div id="casosmes"></div>
          </div>

        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card card-chart">
          <div class="card-header">
            <h4 class="card-title">Todos los usuario</h4>
            <div id="loginmeses"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card card-chart">
          <div class="card-header">
            <h4 class="card-title">Todos los documentos</h4>
            <div id="adjuntodiv"></div>
          </div>

        </div>
      </div>
    </div>
    <div class="row">
      <!-- <div class="col-md-6">
      <div class="card  card-tasks">
        <div class="card-header ">
          <h5 class="card-category">Backend development</h5>
          <h4 class="card-title">Tasks</h4>
        </div>
        <div class="card-body ">
          <div class="table-full-width table-responsive">
            <table class="table">
              <tbody>
                <tr>
                  <td>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" checked>
                        <span class="form-check-sign"></span>
                      </label>
                    </div>
                  </td>
                  <td class="text-left">Sign contract for "What are conference organizers afraid of?"</td>
                  <td class="td-actions text-right">
                    <button type="button" rel="tooltip" title="" class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Edit Task">
                      <i class="now-ui-icons ui-2_settings-90"></i>
                    </button>
                    <button type="button" rel="tooltip" title="" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Remove">
                      <i class="now-ui-icons ui-1_simple-remove"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox">
                        <span class="form-check-sign"></span>
                      </label>
                    </div>
                  </td>
                  <td class="text-left">Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                  <td class="td-actions text-right">
                    <button type="button" rel="tooltip" title="" class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Edit Task">
                      <i class="now-ui-icons ui-2_settings-90"></i>
                    </button>
                    <button type="button" rel="tooltip" title="" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Remove">
                      <i class="now-ui-icons ui-1_simple-remove"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" checked>
                        <span class="form-check-sign"></span>
                      </label>
                    </div>
                  </td>
                  <td class="text-left">Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                  </td>
                  <td class="td-actions text-right">
                    <button type="button" rel="tooltip" title="" class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Edit Task">
                      <i class="now-ui-icons ui-2_settings-90"></i>
                    </button>
                    <button type="button" rel="tooltip" title="" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Remove">
                      <i class="now-ui-icons ui-1_simple-remove"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <i class="now-ui-icons loader_refresh spin"></i> Updated 3 minutes ago
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h5 class="card-category">All Persons List</h5>
          <h4 class="card-title"> Employees Stats</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th>
                  Name
                </th>
                <th>
                  Country
                </th>
                <th>
                  City
                </th>
                <th class="text-right">
                  Salary
                </th>
              </thead>
              <tbody>
                <tr>
                  <td>
                    Dakota Rice
                  </td>
                  <td>
                    Niger
                  </td>
                  <td>
                    Oud-Turnhout
                  </td>
                  <td class="text-right">
                    $36,738
                  </td>
                </tr>
                <tr>
                  <td>
                    Minerva Hooper
                  </td>
                  <td>
                    Curaçao
                  </td>
                  <td>
                    Sinaai-Waas
                  </td>
                  <td class="text-right">
                    $23,789
                  </td>
                </tr>
                <tr>
                  <td>
                    Sage Rodriguez
                  </td>
                  <td>
                    Netherlands
                  </td>
                  <td>
                    Baileux
                  </td>
                  <td class="text-right">
                    $56,142
                  </td>
                </tr>
                <tr>
                  <td>
                    Doris Greene
                  </td>
                  <td>
                    Malawi
                  </td>
                  <td>
                    Feldkirchen in Kärnten
                  </td>
                  <td class="text-right">
                    $63,542
                  </td>
                </tr>
                <tr>
                  <td>
                    Mason Porter
                  </td>
                  <td>
                    Chile
                  </td>
                  <td>
                    Gloucester
                  </td>
                  <td class="text-right">
                    $78,615
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div> -->
    </div>
  </div>
<?php endif; ?>
<?php
require './template/footer.php';
?>

<script>
  const nombresMeses = [
    "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
  ];


  $(document).ready(function() {
    demo = {
      initPickColor: function() {
        $(".pick-class-label").click(function() {
          var new_class = $(this).attr("new-class");
          var old_class = $("#display-buttons").attr("data-class");
          var display_div = $("#display-buttons");
          if (display_div.length) {
            var display_buttons = display_div.find(".btn");
            display_buttons.removeClass(old_class);
            display_buttons.addClass(new_class);
            display_div.attr("data-class", new_class);
          }
        });
      },

      initDocChart: function() {
        chartColor = "#FFFFFF";

        // General configuration for the charts with Line gradientStroke
        gradientChartOptionsConfiguration = {
          maintainAspectRatio: false,
          legend: {
            display: false,
          },
          tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10,
          },
          responsive: true,
          scales: {
            yAxes: [{
              display: 0,
              gridLines: 0,
              ticks: {
                display: false,
              },
              gridLines: {
                zeroLineColor: "transparent",
                drawTicks: false,
                display: false,
                drawBorder: false,
              },
            }, ],
            xAxes: [{
              display: 0,
              gridLines: 0,
              ticks: {
                display: false,
              },
              gridLines: {
                zeroLineColor: "transparent",
                drawTicks: false,
                display: false,
                drawBorder: false,
              },
            }, ],
          },
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 15,
              bottom: 15,
            },
          },
        };
      },

      initDashboardPageCharts: function() {
        chartColor = "#FFFFFF";

        // General configuration for the charts with Line gradientStroke
        gradientChartOptionsConfiguration = {
          maintainAspectRatio: false,
          legend: {
            display: false,
          },
          tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10,
          },
          responsive: 1,
          scales: {
            yAxes: [{
              display: 0,
              gridLines: 0,
              ticks: {
                display: false,
              },
              gridLines: {
                zeroLineColor: "transparent",
                drawTicks: false,
                display: false,
                drawBorder: false,
              },
            }, ],
            xAxes: [{
              display: 0,
              gridLines: 0,
              ticks: {
                display: false,
              },
              gridLines: {
                zeroLineColor: "transparent",
                drawTicks: false,
                display: false,
                drawBorder: false,
              },
            }, ],
          },
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 15,
              bottom: 15,
            },
          },
        };

        gradientChartOptionsConfigurationWithNumbersAndGrid = {
          maintainAspectRatio: false,
          legend: {
            display: false,
          },
          tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10,
          },
          responsive: true,
          scales: {
            yAxes: [{
              gridLines: 0,
              gridLines: {
                zeroLineColor: "transparent",
                drawBorder: false,
              },
            }, ],
            xAxes: [{
              display: 0,
              gridLines: 0,
              ticks: {
                display: false,
              },
              gridLines: {
                zeroLineColor: "transparent",
                drawTicks: false,
                display: false,
                drawBorder: false,
              },
            }, ],
          },
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 15,
              bottom: 15,
            },
          },
        };

        var ctx = document.getElementById("bigDashboardChart").getContext("2d");

        var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
        gradientStroke.addColorStop(0, "#80b6f4");
        gradientStroke.addColorStop(1, chartColor);

        var gradientFill = ctx.createLinearGradient(0, 200, 0, 50);
        var myChart = new Chart(ctx, {
          type: "line",
          data: {
            labels: [
              "JAN",
              "FEB",
              "MAR",
              "APR",
              "MAY",
              "JUN",
              "JUL",
              "AUG",
              "SEP",
              "OCT",
              "NOV",
              "DEC",
            ],
            datasets: [{
              label: "Data",
              borderColor: chartColor,
              pointBorderColor: chartColor,
              pointBackgroundColor: "#1e3d60",
              pointHoverBackgroundColor: "#1e3d60",
              pointHoverBorderColor: chartColor,
              pointBorderWidth: 1,
              pointHoverRadius: 7,
              pointHoverBorderWidth: 2,
              pointRadius: 5,
              fill: true,
              backgroundColor: gradientFill,
              borderWidth: 2,
              data: [50, 150, 100, 190, 130, 90, 150, 160, 120, 140, 190, 95],
            }, ],
          },
          options: {
            layout: {
              padding: {
                left: 20,
                right: 20,
                top: 0,
                bottom: 0,
              },
            },
            maintainAspectRatio: false,
            tooltips: {
              backgroundColor: "#fff",
              titleFontColor: "#333",
              bodyFontColor: "#666",
              bodySpacing: 4,
              xPadding: 12,
              mode: "nearest",
              intersect: 0,
              position: "nearest",
            },
            legend: {
              position: "bottom",
              fillStyle: "#FFF",
              display: false,
            },
            scales: {
              yAxes: [{
                ticks: {
                  fontColor: "rgba(255,255,255,0.4)",
                  fontStyle: "bold",
                  beginAtZero: true,
                  maxTicksLimit: 5,
                  padding: 10,
                },
                gridLines: {
                  drawTicks: true,
                  drawBorder: false,
                  display: true,
                  color: "rgba(255,255,255,0.1)",
                  zeroLineColor: "transparent",
                },
              }, ],
              xAxes: [{
                gridLines: {
                  zeroLineColor: "transparent",
                  display: false,
                },
                ticks: {
                  padding: 10,
                  fontColor: "rgba(255,255,255,0.4)",
                  fontStyle: "bold",
                },
              }, ],
            },
          },
        });

        fetch("<?= getBaseUrl() ?>/controllers/login.php?op=count", {
            method: 'GET',
          })
          .then(response => {
            if (!response.ok) {
              throw new Error(`HTTP error: ${response.status}`);
            }
            return response.json();
          })
          .then(data => {
            const dataUsers = [];
            data.forEach(element => {
              dataUsers.push(parseInt(element.value));
            });
            ctx = document
              .getElementById("lineChartExampleWithNumbersAndGrid")
              .getContext("2d");
            gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
            gradientStroke.addColorStop(0, "#18ce0f");
            gradientStroke.addColorStop(1, chartColor);

            gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
            gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
            gradientFill.addColorStop(1, hexToRGB("#18ce0f", 0.4));

            myChart = new Chart(ctx, {
              type: "line",
              responsive: true,
              data: {
                labels: [
                  "JAN",
                  "FEB",
                  "MAR",
                  "APR",
                  "MAY",
                  "JUN",
                  "JUL",
                  "AUG",
                  "SEP",
                  "OCT",
                  "NOV",
                  "DEC",
                ],
                datasets: [{
                  label: "Email Stats",
                  borderColor: "#18ce0f",
                  pointBorderColor: "#FFF",
                  pointBackgroundColor: "#18ce0f",
                  pointBorderWidth: 2,
                  pointHoverRadius: 4,
                  pointHoverBorderWidth: 1,
                  pointRadius: 4,
                  fill: true,
                  backgroundColor: gradientFill,
                  borderWidth: 2,
                  data: dataUsers,
                }, ],
              },
              options: gradientChartOptionsConfigurationWithNumbersAndGrid,
            });

          });

        fetch("<?= getBaseUrl() ?>/controllers/adjunto.php?op=count", {
            method: 'GET',
          })
          .then(response => {
            if (!response.ok) {
              throw new Error(`HTTP error: ${response.status}`);
            }
            return response.json();
          })
          .then(data => {
            var e = document
              .getElementById("barChartSimpleGradientsNumbers")
              .getContext("2d");

            gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
            gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
            gradientFill.addColorStop(1, hexToRGB("#2CA8FF", 0.6));
            var a = {
              type: "bar",
              data: {
                labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Ocutubre", "Noviembre", "Diciembre"],
                datasets: [{
                  label: "Documentos activos",
                  backgroundColor: gradientFill,
                  borderColor: "#2CA8FF",
                  pointBorderColor: "#FFF",
                  pointBackgroundColor: "#2CA8FF",
                  pointBorderWidth: 2,
                  pointHoverRadius: 4,
                  pointHoverBorderWidth: 1,
                  pointRadius: 4,
                  fill: true,
                  borderWidth: 1,
                  data: data
                }]
              },
              options: {
                maintainAspectRatio: false,
                legend: {
                  display: false
                },
                tooltips: {
                  bodySpacing: 4,
                  mode: "nearest",
                  intersect: 0,
                  position: "nearest",
                  xPadding: 10,
                  yPadding: 10,
                  caretPadding: 10
                },
                responsive: 1,
                scales: {
                  yAxes: [{
                    gridLines: 0,
                    gridLines: {
                      zeroLineColor: "transparent",
                      drawBorder: false
                    }
                  }],
                  xAxes: [{
                    display: 0,
                    gridLines: 0,
                    ticks: {
                      display: false
                    },
                    gridLines: {
                      zeroLineColor: "transparent",
                      drawTicks: false,
                      display: false,
                      drawBorder: false
                    }
                  }]
                },
                layout: {
                  padding: {
                    left: 0,
                    right: 0,
                    top: 15,
                    bottom: 15
                  }
                }
              }
            };

            var viewsChart = new Chart(e, a);

          });


      },
    };
    fetch("<?= getBaseUrl() ?>/controllers/task.php?op=count", {
        method: 'GET',
      })
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error: ${response.status}`);
        }
        return response.json();
      })
      .then(data => {
        const mesesDiv = document.getElementById('casosmes');
        data.forEach((value, index) => {
          const mesDiv = document.createElement('div');
          mesDiv.className = 'mes-item';
          const nombreMes = nombresMeses[index]; // Obtener el nombre del mes correspondiente
          mesDiv.innerHTML = `<strong>${nombreMes}:</strong> ${value}`;
          mesesDiv.appendChild(mesDiv);
        });
      });


    fetch("<?= getBaseUrl() ?>/controllers/login.php?op=count", {
        method: 'GET',
      })
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error: ${response.status}`);
        }
        return response.json();
      })
      .then(data => {
        const mesesDiv = document.getElementById('loginmeses');
        data.forEach((item) => {
          const mesDiv = document.createElement('div');
          mesDiv.className = 'mes-item';
          const nombreMes = nombresMeses[item.mes - 1]; // Obtener el nombre del mes correspondiente
          mesDiv.innerHTML = `<strong>${nombreMes}:</strong> ${item.value}`;
          mesesDiv.appendChild(mesDiv);
        });
      });

    fetch("<?= getBaseUrl() ?>/controllers/adjunto.php?op=count", {
        method: 'GET',
      })
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error: ${response.status}`);
        }
        return response.json();
      })
      .then(data => {
        const mesesDiv = document.getElementById('adjuntodiv');
        data.forEach((value, index) => {
          const mesDiv = document.createElement('div');
          mesDiv.className = 'mes-item';
          const nombreMes = nombresMeses[index]; // Obtener el nombre del mes correspondiente
          mesDiv.innerHTML = `<strong>${nombreMes}:</strong> ${value}`;
          mesesDiv.appendChild(mesDiv);
        });
      });


    demo.initDashboardPageCharts();
  });
</script>

</body>

</html>