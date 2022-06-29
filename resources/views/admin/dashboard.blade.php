@extends('admin.layouts.main')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card text-white bg-info mb-4">
                        <div class="card-body">Lượt truy cập: {{ $totalVisitors }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#myLineChart">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card text-white bg-secondary mb-4">
                        <div class="card-body">Khách hàng: {{ $totalUsers }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="customers-show.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Hóa đơn: {{ $totalInvoices }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="invoices-show.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Doanh thu: {{ $totalRevenues }}đ</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#myBarChart">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Lượt truy cập
                        </div>
                        <div class="card-body"><canvas id="myLineChart" width="100%" height="40"></canvas></div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Doanh thu
                        </div>
                        <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            So sánh doanh thu:
                            <select name="period" id="period">
                                <option value="0">Tuần này với tuần trước</option>
                                <option value="1">Tháng này với tháng trước</option>
                                <option value="2">Năm này với năm trước</option>
                            </select>
                        </div>
                        <div class="card-body"><canvas id="myMultiLine" width="100%" height="40"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2022</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('backend/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
        $(document).ready(function() {
            // showBarChart();
            var myLineChart = $('#myLineChart');
            // console.log(myLineChart);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.ajax') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                data: {
                    period: period
                },
                dataType: 'json',
                success: function(data) {
                    var newData = data.result.visitors;

                    var arrDate = [];
                    var arrVisitors = [];

                    for (const key in newData) {
                        arrDate.push(newData[key].date);
                        arrVisitors.push(newData[key].visitors);
                    }

                    new Chart(myLineChart, {
                        type: 'line',
                        data: {
                            labels: arrDate,
                            datasets: [{
                                label: 'Lượt truy cập: ',
                                fill: false,
                                lineTension: 0,
                                backgroundColor: "rgba(0,0,255,1.0)",
                                borderColor: "rgba(0,0,255,0.1)",
                                data: arrVisitors
                            }],
                        },
                        options: {
                            title: {
                                display: false,
                                text: 'Lượt truy cập: '
                            },
                            legend: {
                                display: false
                            },
                            scales: {
                                xAxes: [{
                                    display: false,
                                }],
                                yAxes: [{
                                    ticks: {
                                        min: 0,
                                        stepSize: 1
                                    }
                                }]
                            }
                        }
                    })
                }
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            var myBarChart = $('#myBarChart');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.ajax') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                data: {
                    period: period
                },
                dataType: 'json',
                success: function(data) {
                    let newData = data.result.revenues;

                    let arrMonths = [];
                    let arrRenevue = [];

                    for (const key in newData) {
                        arrMonths.push(newData[key].month);
                        arrRenevue.push(newData[key].revenue);
                    }

                    arrStringMonths = [
                        'January',
                        'February',
                        'March',
                        'April',
                        'May',
                        'June',
                        'July',
                        'August',
                        'September',
                        'October',
                        'November',
                        'December'
                    ];

                    new Chart(myBarChart, {
                        type: 'bar',
                        data: {
                            labels: arrMonths,
                            datasets: [{
                                label: "Renevue",
                                backgroundColor: "rgba(2,117,216,1)",
                                borderColor: "rgba(2,117,216,1)",
                                data: arrRenevue,
                            }],
                        },
                        options: {
                            scales: {
                                xAxes: [{
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Month'
                                    },
                                    time: {
                                        unit: 'month'
                                    },
                                    gridLines: {
                                        display: false
                                    },
                                    ticks: {
                                        // maxTicksLimit: 6
                                        callback: function(label, index, labels) {
                                            return arrStringMonths[label - 1];
                                        }
                                    }
                                }],
                                yAxes: [{
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'VND'
                                    },
                                    ticks: {
                                        // min: 0,
                                        // max: 15000,
                                        // maxTicksLimit: 5

                                    },
                                    gridLines: {
                                        display: true
                                    }
                                }],
                            },
                            legend: {
                                display: false
                            }
                        }
                    })
                }
            });

        })
    </script>
    <script>
        $(document).ready(function() {
            function create_chart() {
                let period = $('#period').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.ajax') }}",
                    type: 'POST',
                    data: {
                        period: period
                    },
                    dataType: 'json',
                    success: function(data) {
                        let newData = data.result.compare;
                        let last = newData.last ?? {};
                        let current = newData.current ?? {};

                        let arrDayOfWeek = [0, 1, 2, 3, 4, 5, 6];
                        let arrDateOfMonth = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17,
                            18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31
                        ];
                        let arrMonthOfYear = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

                        let arrIndex = [];
                        let arrAlterIndex = [];

                        let textLabelLast = '';
                        let textLabelCurrent = '';
                        let textLabelString = '';

                        switch (period) {
                            case '0':
                                textLabelLast = 'Tuần trước: ';
                                textLabelCurrent = 'Tuần này: ';
                                textLabelString = 'Thứ'
                                arrIndex = arrDayOfWeek;
                                arrAlterIndex = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday',
                                    'Saturday', 'Sunday'
                                ];
                                break;

                            case '1':
                                textLabelLast = 'Tháng trước: ';
                                textLabelCurrent = 'Tháng này: ';
                                textLabelString = 'Ngày';
                                arrIndex = arrDateOfMonth;
                                arrAlterIndex = arrIndex;
                                break;

                            case '2':
                                textLabelString = 'Năm'
                                textLabelLast = 'Năm trước: ';
                                textLabelCurrent = 'Năm này: ';
                                arrIndex = arrMonthOfYear;
                                arrAlterIndex = [
                                    'January',
                                    'February',
                                    'March',
                                    'April',
                                    'May',
                                    'June',
                                    'July',
                                    'August',
                                    'September',
                                    'October',
                                    'November',
                                    'December'
                                ];
                                break;

                            default:
                                break;
                        }

                        let arrRevenueLast = [];
                        let arrRevenueCurrent = [];

                        for (const value of arrIndex) {
                            if (typeof last == 'undefined') {
                                arrRevenueLast.push(0);
                            } else {
                                if (typeof last[value] == 'undefined') {
                                    arrRevenueLast.push(0);
                                } else {
                                    arrRevenueLast.push(last[value])
                                }
                            }

                            if (typeof current == 'undefined') {
                                arrRevenueCurrent.push(0);
                            } else {
                                if (typeof current[value] == 'undefined') {
                                    arrRevenueCurrent.push(0);
                                } else {
                                    arrRevenueCurrent.push(current[value]);
                                }
                            }
                        }

                        new Chart(myMultiLine, {
                            type: "line",
                            data: {
                                labels: arrAlterIndex,
                                datasets: [{
                                    label: textLabelCurrent,
                                    data: arrRevenueCurrent,
                                    borderColor: "green",
                                    fill: false
                                }, {
                                    label: textLabelLast,
                                    data: arrRevenueLast,
                                    borderColor: "red",
                                    fill: false
                                }]
                            },
                            options: {
                                legend: {
                                    display: true
                                },
                                scales: {
                                    xAxes: [{
                                        scaleLabel: {
                                            display: true,
                                            labelString: textLabelString,
                                        }
                                    }],
                                }
                            }
                        });
                    }
                })
            }
            $('#period').change(create_chart);

            create_chart();
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>

@endsection
