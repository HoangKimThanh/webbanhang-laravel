// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
// $(document).ready(function () {
//     showBarChart();
// })

function showBarChart() {
    var myBarChart = $('#myBarChart');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "admin-ajax",
        type: 'POST',
        processData: false, contentType: false,
        data: {
            period: period
        },
        dataType: 'json',
        success: function (data) {
            let newData = data.js.revenues;

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
                                callback: function (label, index, labels) {
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
}