<script>
    var multipleLineChart = document.getElementById('multipleLineChart').getContext('2d');

    var myMultipleLineChart = new Chart(multipleLineChart, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Masuk",
                borderColor: "#0275d8",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#0275d8",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                backgroundColor: 'transparent',
                fill: true,
                borderWidth: 2,
                data: [
                    {{ $masukAttendanceCount[0] }},
                    {{ $masukAttendanceCount[1] }},
                    {{ $masukAttendanceCount[2] }},
                    {{ $masukAttendanceCount[3] }},
                    {{ $masukAttendanceCount[4] }},
                    {{ $masukAttendanceCount[5] }},
                    {{ $masukAttendanceCount[6] }},
                    {{ $masukAttendanceCount[7] }},
                    {{ $masukAttendanceCount[8] }},
                    {{ $masukAttendanceCount[9] }},
                    {{ $masukAttendanceCount[10] }},
                    {{ $masukAttendanceCount[11] }}
                ]
            }, {
                label: "Terlambat",
                borderColor: "#000000",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#000000",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                backgroundColor: 'transparent',
                fill: true,
                borderWidth: 2,
                data: [
                    {{ $terlambatAttendanceCount[0] }},
                    {{ $terlambatAttendanceCount[1] }},
                    {{ $terlambatAttendanceCount[2] }},
                    {{ $terlambatAttendanceCount[3] }},
                    {{ $terlambatAttendanceCount[4] }},
                    {{ $terlambatAttendanceCount[5] }},
                    {{ $terlambatAttendanceCount[6] }},
                    {{ $terlambatAttendanceCount[7] }},
                    {{ $terlambatAttendanceCount[8] }},
                    {{ $terlambatAttendanceCount[9] }},
                    {{ $terlambatAttendanceCount[10] }},
                    {{ $terlambatAttendanceCount[11] }}
                ]
            }, {
                label: "Ijin",
                borderColor: "#5bc0de",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#5bc0de",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                backgroundColor: 'transparent',
                fill: true,
                borderWidth: 2,
                data: [
                    {{ $ijinAttendanceCount[0] }},
                    {{ $ijinAttendanceCount[1] }},
                    {{ $ijinAttendanceCount[2] }},
                    {{ $ijinAttendanceCount[3] }},
                    {{ $ijinAttendanceCount[4] }},
                    {{ $ijinAttendanceCount[5] }},
                    {{ $ijinAttendanceCount[6] }},
                    {{ $ijinAttendanceCount[7] }},
                    {{ $ijinAttendanceCount[8] }},
                    {{ $ijinAttendanceCount[9] }},
                    {{ $ijinAttendanceCount[10] }},
                    {{ $ijinAttendanceCount[11] }}
                ]
            }, {
                label: "Sakit",
                borderColor: "#f0ad4e",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#f0ad4e",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                backgroundColor: 'transparent',
                fill: true,
                borderWidth: 2,
                data: [
                    {{ $sakitAttendanceCount[0] }},
                    {{ $sakitAttendanceCount[1] }},
                    {{ $sakitAttendanceCount[2] }},
                    {{ $sakitAttendanceCount[3] }},
                    {{ $sakitAttendanceCount[4] }},
                    {{ $sakitAttendanceCount[5] }},
                    {{ $sakitAttendanceCount[6] }},
                    {{ $sakitAttendanceCount[7] }},
                    {{ $sakitAttendanceCount[8] }},
                    {{ $sakitAttendanceCount[9] }},
                    {{ $sakitAttendanceCount[10] }},
                    {{ $sakitAttendanceCount[11] }}
                ]
            }, {
                label: "Alpha",
                borderColor: "#d9534f",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#d9534f",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                backgroundColor: 'transparent',
                fill: true,
                borderWidth: 2,
                data: [
                    {{ $alphaAttendanceCount[0] }},
                    {{ $alphaAttendanceCount[1] }},
                    {{ $alphaAttendanceCount[2] }},
                    {{ $alphaAttendanceCount[3] }},
                    {{ $alphaAttendanceCount[4] }},
                    {{ $alphaAttendanceCount[5] }},
                    {{ $alphaAttendanceCount[6] }},
                    {{ $alphaAttendanceCount[7] }},
                    {{ $alphaAttendanceCount[8] }},
                    {{ $alphaAttendanceCount[9] }},
                    {{ $alphaAttendanceCount[10] }},
                    {{ $alphaAttendanceCount[11] }}
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'top',
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
            layout: {
                padding: {
                    left: 15,
                    right: 15,
                    top: 15,
                    bottom: 15
                }
            }
        }
    });
</script>
