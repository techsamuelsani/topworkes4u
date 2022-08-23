<?php
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
$today= new Carbon('today');
$oneMonth=Carbon::parse($today->subMonth(1))->format('Y-m-d');
$payments=App\Payment::where('order_number','NOT LIKE','balance%')->get();;
$paymentSum=$payments->sum('total');
$rechargeSum=App\Recharge::where('status','1')->sum('amountDollers');
$orders=App\Order::with('payment')->where([['status','!=','completed'],['status','!=','canceled']])->get();
$activeSum=$orders->sum('payment.total');
$accountSum=App\User::sum('balance');
$withdrawals=App\Withdrawal::where('status','Withdarawal Sent')->get();
$withdrawalSum=$withdrawals->sum('amount');
$orders=App\Order::with('payment')->where('status','completed')->get();
$completedSum=$orders->sum('payment.total');
$o=new App\Order;
$o1=$o->lastMonthSum();
$y1=$o->lastYearSum();



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="\css\vendor\simple-line-icons.css">
	<link rel="stylesheet" href="\css\vendor\font-awesome.min.css">
	<link rel="stylesheet" href="\css\style.css">
	<!-- favicon -->
	<link rel="icon" href="favicon.ico">
	<title>Lancerr.net | Admin</title>
	<style>
		.graph-stats-list-item{
			max-height: 100px !important;
			margin-bottom:15px;
			width: 30%;
		}
	</style>
</head>
<body>

@include('admin.side');

    <!-- DASHBOARD BODY -->
    <div class="dashboard-body">
        <!-- DASHBOARD HEADER -->
        <div class="dashboard-header retracted">
            <!-- DB CLOSE BUTTON -->
            <a href="\admin" class="db-close-button">
               <img src="\images\dashboard\back-icon.png" alt="back-icon">
            </a>
            <!-- DB CLOSE BUTTON -->

			<!-- DB OPTIONS BUTTON -->
            <div class="db-options-button">
               <img src="\images\dashboard\db-list-right.png" alt="db-list-right">
			   <img src="\images\dashboard\close-icon.png" alt="close-icon">
            </div>
            <!-- DB OPTIONS BUTTON -->

            <!-- DASHBOARD HEADER ITEM -->
            <div style="width: 100%;" class="dashboard-header-item title">
                <!-- DB SIDE MENU HANDLER -->
                 <div class="db-side-menu-handler">
                    <img src="\images\dashboard\db-list-left.png" alt="db-list-left">
                </div>
                <!-- /DB SIDE MENU HANDLER -->
                <h6>Your Dashboard</h6>
            </div>
            <!-- /DASHBOARD HEADER ITEM -->





			<!-- DASHBOARD HEADER ITEM -->
            <div class="dashboard-header-item back-button">
                <a href="index-1.html" class="button mid dark-light">Back to Homepage</a>
            </div>
            <!-- /DASHBOARD HEADER ITEM -->
        </div>
        <!-- DASHBOARD HEADER -->

        <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">
            <!-- HEADLINE -->
            <div class="headline simple primary">
                <h4>Statistics</h4>
            </div>
            <!-- /HEADLINE -->

			<!-- GRAPH STATS LIST -->
			<div class="graph-stats-list">
				<!-- GRAPH STATS LIST ITEM -->
				<div class="graph-stats-list-item green">
					<h2>${{$paymentSum}}</h2>
					<p class="text-header">Total Card Payment</p>
					<p></p>
				</div>
				<!-- /GRAPH STATS LIST ITEM -->

				<!-- GRAPH STATS LIST ITEM -->
				<div class="graph-stats-list-item violet">
					<h2>${{$rechargeSum}}</h2>
					<p class="text-header">Total Recharge Payment</p>
				</div>
				<!-- /GRAPH STATS LIST ITEM -->

				<!-- GRAPH STATS LIST ITEM -->
				<div class="graph-stats-list-item red">
					<h2>${{$accountSum}}</h2>
					<p class="text-header">Total amount in accounts</p>
				</div>
				<!-- /GRAPH STATS LIST ITEM -->
				<hr class="line-separator">
				<!-- GRAPH STATS LIST ITEM -->
				<div class="graph-stats-list-item blue ">
					<p class="text-header">Total Payment of Active Orders</p>
					<h2>${{$activeSum}}</h2>
				</div>
				<!-- /GRAPH STATS LIST ITEM -->
				<div class="graph-stats-list-item green ">
					<p class="text-header">Total Withdrawals</p>
					<h2>${{$withdrawalSum}}</h2>
				</div>
				<div class="graph-stats-list-item violet ">
					<p class="text-header">Total Profit</p>
					<h2>${{$completedSum*0.1}}</h2>
				</div>
			</div>
			<!-- /GRAPH STATS LIST -->

			<!-- FORM BOX ITEMS -->
			<div class="form-box-items">
				<!-- FORM BOX ITEM -->
				<div class="form-box-item full has-chart-filter">
					<h4>Sum Income VS Sum Withdrawals (last 30 days)</h4>
					<hr class="line-separator">
					<canvas style="max-height: 400px;" class="main-activity-chart"></canvas>
					<!-- CHART FILTERS -->
					<div class="chart-filters">
						<!-- CHART FILTER -->
						<div class="chart-filter">
							<span class="sl-icon icon-tag primary"></span>
							<p class="text-header">Sales vs Withdrawal</p>
						</div>
						<!-- /CHART FILTER -->

					</div>
					<!-- /CHART FILTERS -->
				</div>
				<!-- /FORM BOX ITEM -->
			</div>
			<!-- /FORM BOX ITEMS -->

			<div class="clearfix"></div>

			<!-- FORM BOX ITEMS -->
			<div class="form-box-items">
				<!-- FORM BOX ITEM -->
				<div class="form-box-item full has-chart-filter">
					<h4>Sum Income VS Sum Withdrawals (last 12 months)</h4>
					<hr class="line-separator">
					<canvas style="max-height: 400px;" class="two-lines-chart"></canvas>
					<!-- CHART FILTERS -->

					<div class="chart-filters">
						<!-- CHART FILTER -->
						<div class="chart-filter">
							<!-- CHART LEGEND -->
							<div class="chart-legend inline">
								<!-- CHART LEGEND ITEM -->
								<div class="chart-legend-item">
									<div class="chart-legend-item-color blue"></div>
									<p>Total Income</p>
								</div>
								<!-- /CHART LEGEND ITEM -->

								<!-- CHART LEGEND ITEM -->
								<div class="chart-legend-item">
									<div class="chart-legend-item-color yellow"></div>
									<p>Total withdrawal</p>
								</div>
								<!-- /CHART LEGEND ITEM -->
							</div>
							<!-- /CHART LEGEND -->
						</div>
						<!-- /CHART FILTER -->

						<!-- CHART FILTER -->
						<div class="chart-filter">
							<form>
								<label for="period7" class="select-block">
									<select name="period7" id="period7">
										<option value="0">This Month</option>
										<option value="1" selected="">This Year</option>
									</select>
									<!-- SVG ARROW -->
									<svg class="svg-arrow">
										<use xlink:href="#svg-arrow"></use>
									</svg>
									<!-- /SVG ARROW -->
								</label>
							</form>
						</div>
						<!-- /CHART FILTER -->
					</div>
					<!-- /CHART FILTERS -->
				</div>
				<!-- /FORM BOX ITEM -->
			</div>
			<!-- /FORM BOX ITEMS -->
        </div>
        <!-- DASHBOARD CONTENT -->
    </div>
    <!-- /DASHBOARD BODY -->

	<div class="shadow-film closed"></div>

<!-- SVG ARROW -->
<svg style="display: none;">	
	<symbol id="svg-arrow" viewbox="0 0 3.923 6.64014" preserveaspectratio="xMinYMin meet">
		<path d="M3.711,2.92L0.994,0.202c-0.215-0.213-0.562-0.213-0.776,0c-0.215,0.215-0.215,0.562,0,0.777l2.329,2.329
			L0.217,5.638c-0.215,0.215-0.214,0.562,0,0.776c0.214,0.214,0.562,0.215,0.776,0l2.717-2.718C3.925,3.482,3.925,3.135,3.711,2.92z"></path>
	</symbol>
</svg>
<!-- /SVG ARROW -->

<!-- SVG PLUS -->
<svg style="display: none;">
	<symbol id="svg-plus" viewbox="0 0 13 13" preserveaspectratio="xMinYMin meet">
		<rect x="5" width="3" height="13"></rect>
		<rect y="5" width="13" height="3"></rect>
	</symbol>
</svg>
<!-- /SVG PLUS -->

<!-- SVG MINUS -->
<svg style="display: none;">
	<symbol id="svg-minus" viewbox="0 0 13 13" preserveaspectratio="xMinYMin meet">
		<rect y="5" width="13" height="3"></rect>
	</symbol>
</svg>
<!-- /SVG MINUS -->

<!-- jQuery -->
<script src="\js\vendor\jquery-3.1.0.min.js"></script>
<!-- XM Pie Chart -->
<script src="\js\vendor\jquery.xmpiechart.min.js"></script>
<!-- XM LineFill -->
<script src="\js\vendor\jquery.xmlinefill.min.js"></script>
<!-- Chartjs -->
<script src="\js\vendor\chart.min.js"></script>
<!-- bxSlider -->
<script src="\js\vendor\jquery.bxslider.min.js"></script>
<!-- XM Pie Chart -->
<script src="\js\vendor\jquery.xmpiechart.min.js"></script>
<!-- Side Menu -->
<script src="\js\side-menu.js"></script>
<!-- Dashboard Header -->
<script src="\js\dashboard-header.js"></script>
<!-- Dashboard Statistics -->
<script>
    (function($){
        function range(start, count) {
            return Array.apply(0, Array(count))
                .map(function (element, index) {
                    if ( index < 9 ) {
                        return String( '0' + ( index + start ) );
                    }
                    return String(index + start);
                });
        }

        Chart.defaults.global.defaultFontFamily = "'Titillium Web', sans-serif";
        Chart.defaults.global.defaultFontColor = "#222";
        Chart.defaults.global.defaultFontSize = 14;

        var ctx = $('.main-activity-chart'),
            data = {
                type: 'bar',
                data: {
                    labels: [@foreach($o1 as $o) '{{Carbon::parse($o->day)->format('d M')}}', @endforeach],
                    datasets: [
						  {label: 'Total sales $',
                            data: [@foreach($o1 as $o) '{{$o->sumIncome}}', @endforeach],
                            backgroundColor: "#00d7b3" },{label: 'Total withdrawals $',
                            data: [@foreach($o1 as $o) '-{{$o->sumWithdrawal}}', @endforeach],
                            backgroundColor: "#ea2e68" }
                    ]
                },
                options: {
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "#2b373a",
                        titleFontSize: 0,
                        titleSpacing: 0,
                        titleMarginBottom: -7,
                        bodyFontSize: 12,
                        bodyFontStyle: 'bold',
                        bodySpacing: 0,
                        cornerRadius: 2,
                        xPadding: 12,
                        yPadding: 14,
                        displayColors: true
                    },
                    scales: {
                        xAxes: [
                            {
                                stacked: true,
                                barThickness: 12,
                                gridLines: {
                                    display:false,
                                    color: "rgba(255,255,255,0)",
                                }
                            }
                        ],
                        yAxes: [
                            {
                                stacked: true,
                                gridLines: {
                                    color: "rgba(235, 235, 235, .5)",
                                    drawBorder: false,
                                    drawTicks: false,
                                    zeroLineColor: "rgba(235, 235, 235, .5)"
                                }
                            }
                        ]
                    }
                }
            },
            mainActivityChart = new Chart(ctx, data);
        var ctx9 = $('.two-lines-chart'),
            data9 = {
                type: 'line',
                data: {
                    labels: [@foreach($y1 as $y) '{{$y->month}}', @endforeach ],
                    datasets: [
                        {
                            data: [@foreach($y1 as $y) '{{$y->sumIncome}}', @endforeach ],
                            label: "Total Income $",
                            fill: false,
                            lineTension: 0,
                            borderWidth: 4,
                            borderColor: "#108fe9",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0,
                            borderJoinStyle: 'bevel',
                            pointBorderColor: "#00d7b3",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 4,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "#108fe9",
                            pointHoverBorderWidth: 4,
                            pointRadius: 5,
                            pointHitRadius: 10
                        }
                    ]
                },
                options: {
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "#2b373a",
                        titleFontSize: 0,
                        titleSpacing: 0,
                        titleMarginBottom: -7,
                        bodyFontSize: 10,
                        bodyFontStyle: 'bold',
                        bodySpacing: 0,
                        cornerRadius: 2,
                        xPadding: 12,
                        yPadding: 12,
                        displayColors: false
                    },
                    scales: {
                        xAxes: [
                            {
                                gridLines: {
                                    color: "rgba(235, 235, 235, .5)",
                                    drawBorder: false,
                                    zeroLineColor: "rgba(235, 235, 235, .5)"
                                }
                            }
                        ],
                        yAxes: [
                            {
                                gridLines: {
                                    color: "rgba(235, 235, 235, .5)",
                                    drawBorder: false,
                                    zeroLineColor: "rgba(235, 235, 235, .5)"
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }
                        ]
                    }
                }
            },
            twoLinesChart = new Chart(ctx9, data9);

        var ctx2 = $('.main-activity-pie-chart'),
            data2 = {
                type: 'doughnut',
                data: {
                    datasets: [
                        {
                            data: [50,25,25 ],
                            borderWidth: [ 0 , 0 ,0],
                            backgroundColor: [
                                "#03f1b6",
                                "#108fe9",
                                "#a01ae9"
                            ],
                            hoverBackgroundColor: [
                                "#03f1b6",
                                "#108fe9",
                                "#a01ae9"
                            ]
                        }
                    ]
                },
                options: {
                    legend: {
                        display: true
                    },
                    tooltips: {
                        enabled: true
                    },
                    cutoutPercentage: 70
                }
            },
            mainActivityPieChart = new Chart(ctx2, data2);

        var ctx3 = $('.colors-pie-chart'),
            data3 = {
                type: 'doughnut',
                name:'hello',
                data: {
                    datasets: [
                        {
                            data: [37, 47, 16],
                            borderWidth: [ 0 , 0, 0 ],
                            backgroundColor: [
                                "#7c5ac2",
                                "#03f1b6",
                                "#108fe9"
                            ],
                            hoverBackgroundColor: [
                                "#7c5ac2",
                                "#03f1b6",
                                "#108fe9"
                            ]
                        }
                    ]
                },
                options: {
                    legend: {
                        display: false
                    },
                    tooltips: {
                        enabled: false
                    },
                    cutoutPercentage: 75
                }
            },
            colorsPieChart = new Chart(ctx3, data3);

        var lineBars = [
            { name: 'pg1', percent: 86 },
            { name: 'pg2', percent: 60 },
            { name: 'pg3', percent: 95 }
        ];

        lineBars.forEach(function( pg ){
            $('.' + pg.name).xmlinefill({
                percent: pg.percent,
                fillWidth: 10,
                gradient: true,
                gradientColors: ['#10fac0', '#1cbdf9'],
                speed: 2,
                outline: true,
                outlineColor: "#eff0f4",
                resizable: true
            });
        });

        var ctx4 = $('.social-media-chart'),
            data4 = {
                type: 'bar',
                data: {
                    labels: ['\uf09a','\uf099','\uf0d5','\uf09e'],
                    datasets: [
                        {
                            label: '',
                            data: [ 350, 310, 325, 220 ],
                            backgroundColor: [
                                "#3b64a3",
                                "#39d1ed",
                                "#ee2857",
                                "#fbce32"
                            ]
                        },
                        {
                            label: '',
                            data: [ 50, 70, 25, 70 ],
                            backgroundColor: [
                                "#5781c2",
                                "#64e6fe",
                                "#fd527b",
                                "#ffe177"
                            ]
                        },
                        {
                            label: '',
                            data: [ 100, 70, 120, 80 ],
                            backgroundColor: [
                                "#dde8f7",
                                "#a8f1ff",
                                "#ff9eb5",
                                "#ffeeb3"
                            ]
                        }
                    ]
                },
                options: {
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "#2b373a",
                        titleFontSize: 0,
                        titleSpacing: 0,
                        titleMarginBottom: -7,
                        bodyFontSize: 10,
                        bodyFontStyle: 'bold',
                        bodySpacing: 0,
                        cornerRadius: 2,
                        xPadding: 12,
                        yPadding: 14,
                        displayColors: false
                    },
                    scales: {
                        xAxes: [
                            {
                                stacked: true,
                                barThickness: 34,
                                gridLines: {
                                    display: false
                                },
                                ticks: {
                                    fontFamily: 'FontAwesome',
                                    fontColor: "#b2b2b2"
                                }
                            }
                        ],
                        yAxes: [
                            {
                                stacked: true,
                                gridLines: {
                                    color: "rgba(235, 235, 235, 1)",
                                    borderDash: [ 5, 1 ],
                                    drawBorder: false,
                                    drawTicks: false,
                                    zeroLineColor: "rgba(235, 235, 235, 1)"
                                }
                            }
                        ]
                    }
                }
            },
            socialMediaChart = new Chart(ctx4, data4);

        var ctx5 = $('.single-bar-chart'),
            data5 = {
                type: 'bar',
                data: {
                    labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
                    datasets: [
                        {
                            label: 'Value 02',
                            data: [ 300, 400, 310, 500, 390, 420, 270 ],
                            backgroundColor: "#00d7b3"
                        },
                        {
                            label: 'Value 01',
                            data: [ 280, 210, 200, 170, 220, 170, 280 ],
                            backgroundColor: "#108fe9"
                        },
                        {
                            label: '',
                            data: [ 120, 90, 190, 30, 90, 110, 150 ],
                            backgroundColor: "#eff0f4"
                        }
                    ]
                },
                options: {
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "#2b373a",
                        titleFontSize: 0,
                        titleSpacing: 0,
                        titleMarginBottom: -7,
                        bodyFontSize: 10,
                        bodyFontStyle: 'bold',
                        bodySpacing: 0,
                        cornerRadius: 2,
                        xPadding: 12,
                        yPadding: 14,
                        displayColors: false
                    },
                    scales: {
                        xAxes: [
                            {
                                stacked: true,
                                barThickness: 16,
                                gridLines: {
                                    display: false,
                                    color: "rgba(255,255,255,0)",
                                }
                            }
                        ],
                        yAxes: [
                            {
                                stacked: true,
                                gridLines: {
                                    display: false,
                                    color: "rgba(255,255,255,0)",
                                }
                            }
                        ]
                    }
                }
            },
            singleBarChart = new Chart(ctx5, data5);

        var ctx6 = $('.lines-graph-chart'),
            data6 = {
                type: 'line',
                data: {
                    labels: range(1, 31),
                    datasets: [
                        {
                            label: "Sales",
                            data: [32, 42, 38, 40, 25, 28, 24, 14, 15, 5, 18, 15, 32, 30, 37, 25, 23, 27, 22, 20, 15, 40, 45, 34, 38, 50, 30, 35, 30, 30, 24],
                            fill: true,
                            lineTension: 0,
                            backgroundColor: "rgba(16, 143, 233, .4)",
                            borderColor: "#108fe9",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'bevel',
                            pointBorderColor: "#fff",
                            pointBackgroundColor: "#108fe9",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "#2b373a",
                            pointHoverBorderWidth: 6,
                            pointRadius: 4,
                            pointHitRadius: 10
                        }
                    ]
                },
                options: {
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "#2b373a",
                        titleFontSize: 0,
                        titleSpacing: 0,
                        titleMarginBottom: -7,
                        bodyFontSize: 10,
                        bodyFontStyle: 'bold',
                        bodySpacing: 0,
                        cornerRadius: 2,
                        xPadding: 12,
                        yPadding: 14,
                        displayColors: false
                    },
                    scales: {
                        xAxes: [
                            {
                                gridLines: {
                                    display: false
                                }
                            }
                        ],
                        yAxes: [
                            {
                                gridLines: {
                                    color: "#ebebeb",
                                    borderDash: [ 7, 2 ],
                                    drawBorder: false,
                                    drawTicks: false,
                                    zeroLineColor: "rgba(235, 235, 235, .5)"
                                }
                            }
                        ]
                    }
                }
            },
            linesGraphChart = new Chart(ctx6, data6);

        var ctx7 = $('.double-bar-chart'),
            data7 = {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [
                        {
                            label: '$kk',
                            data: [640, 500, 560, 690, 670, 560, 610, 530, 700, 550, 680, 510 ],
                            backgroundColor: "#108fe9"
                        },
                        {
                            label: '$mm',
                            data: [700, 510, 600, 640, 750, 510, 650, 600.43, 610, 600, 640, 590 ],
                            backgroundColor: "#00d7b3"
                        }
                    ]
                },
                options: {
                    legend: {
                        display: true
                    },
                    tooltips: {
                        backgroundColor: "#2b373a",
                        titleFontSize: 10,
                        titleFontColor: "#16ffd8",
                        titleSpacing: 0,
                        titleMarginBottom: 6,
                        bodyFontSize: 10,
                        bodyFontStyle: 'bold',
                        bodySpacing: 0,
                        cornerRadius: 2,
                        xPadding: 12,
                        yPadding: 12,
                        displayColors: false
                    },
                    scales: {
                        xAxes: [
                            {
                                barThickness: 16,
                                gridLines: {
                                    display: false
                                }
                            }
                        ],
                        yAxes: [
                            {
                                gridLines: {
                                    display: false
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }
                        ]
                    }
                }
            },
            doubleBarChart = new Chart(ctx7, data7);

        var ctx8 = $('.waves-chart'),
            data8 = {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [
                        {
                            data: [310, 420, 250, 340, 370, 250, 300, 270, 230, 390, 290, 380],
                            label: "$",
                            fill: true,
                            lineTension: 0.5,
                            backgroundColor: "rgba(16, 143, 233, .8)",
                            borderColor: "#108fe9",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0,
                            borderJoinStyle: 'bevel',
                            pointBorderColor: "#fff",
                            pointBackgroundColor: "#108fe9",
                            pointBorderWidth: 0,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "#2b373a",
                            pointHoverBorderWidth: 6,
                            pointRadius: 0,
                            pointHitRadius: 10
                        },
                        {
                            data: [580, 410, 700, 340, 250, 510, 520, 480, 680, 410, 490, 580],
                            fill: true,
                            label: "$",
                            lineTension: 0.5,
                            backgroundColor: "rgba(234, 46, 104, .8)",
                            borderColor: "#ea2e68",
                            borderCapStyle: 'bevel',
                            borderDash: [],
                            borderDashOffset: 0,
                            borderJoinStyle: 'bevel',
                            pointBorderColor: "#fff",
                            pointBackgroundColor: "#ea2e68",
                            pointBorderWidth: 0,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "#2b373a",
                            pointHoverBorderWidth: 6,
                            pointRadius: 0,
                            pointHitRadius: 10
                        }
                    ]
                },
                options: {
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "#2b373a",
                        titleFontSize: 10,
                        titleFontColor: "#16ffd8",
                        titleSpacing: 0,
                        titleMarginBottom: 6,
                        bodyFontSize: 10,
                        bodyFontStyle: 'bold',
                        bodySpacing: 0,
                        cornerRadius: 2,
                        xPadding: 12,
                        yPadding: 12,
                        displayColors: false
                    },
                    scales: {
                        xAxes: [
                            {
                                gridLines: {
                                    color: "#ebebeb",
                                    drawBorder: false,
                                    zeroLineColor: "rgba(235, 235, 235, .5)"
                                }
                            }
                        ],
                        yAxes: [
                            {
                                gridLines: {
                                    display: false
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }
                        ]
                    }
                }
            },
            wavesChart = new Chart(ctx8, data8);



        $('.bounce-pie-chart').xmpiechart({
            width: 200,
            height: 200,
            percent: 68,
            color: "#7c5ac2",
            fillWidth: 8,
            speed: 2,
            outline: true,
            linkPercent: '.bounce-perc-link'
        });

        var countryPieCharts = [
                { name: 'cc1', percent: [55, 45] },
                { name: 'cc2', percent: [60, 40] },
                { name: 'cc3', percent: [70, 30] },
                { name: 'cc4', percent: [74, 26] },
                { name: 'cc5', percent: [76, 24] },
                { name: 'cc6', percent: [80, 20] },
                { name: 'cc7', percent: [85, 15] },
                { name: 'cc8', percent: [90, 10] }
            ],
            countryPieChartsData = {
                type: 'doughnut',
                data: {
                    datasets: [
                        {
                            data: [],
                            borderWidth: [ 0 , 0 ],
                            backgroundColor: [
                                "#7c5ac2",
                                "#ffdc1b"
                            ],
                            hoverBackgroundColor: [
                                "#7c5ac2",
                                "#ffdc1b"
                            ]
                        }
                    ]
                },
                options: {
                    legend: {
                        display: false
                    },
                    tooltips: {
                        enabled: false
                    },
                    cutoutPercentage: 70
                }
            };

        countryPieCharts.forEach(function(item){
            countryPieChartsData.data.datasets[0].data = item.percent;
            var ctx = $('.'+item.name);
            new Chart(ctx, countryPieChartsData);
        });

        $('.numbers-slider').bxSlider({
            controls: false,
            auto: true,
            pause: 2000,
            pagerCustom: '.slider-pager'
        });
    })(jQuery);
</script>
</body>
<script>

</script>
</html>