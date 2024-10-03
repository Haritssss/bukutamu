<?php
include_once('templates/header.php');
require_once('function.php');

// menghitung jumlah tamu
$result = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_tamu FROM buku_tamu");
$data = mysqli_fetch_assoc($result);
$jumlah_tamu = $data['jumlah_tamu'];

// query mendapatkan data tamu per hari\
$query = "SELECT tanggal, COUNT(*) AS jumlah_per_hari FROM buku_tamu GROUP by tanggal";
$result = mysqli_query($koneksi, $query);

// array untuk menampung data
$tanggal = [];
$jumlah_tamu_per_hari = [];

while ($row = mysqli_fetch_assoc($result)) {
    $tanggal[] = $row['tanggal'];
    $jumlah_tamu_per_hari[] = $row['jumlah_per_hari'];
}

// query untuk mendapatkan data dari distribusi tamu
$query = "SELECT bertemu, COUNT(*) AS jumlah FROM buku_tamu GROUP BY bertemu";
$result = mysqli_query($koneksi, $query);

$bertemu = [];
$jumlah_bertemu = [];

while ($row = mysqli_fetch_assoc($result)) {
    $bertemu[] = $row['bertemu'];
    $jumlah_bertemu[] = $row['jumlah'];
}

// query menampilkan data tamu hari ini
$today_date = date('Y-m-d');
$result = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM buku_tamu WHERE tanggal - '$today_date'");
$data_hari_ini = mysqli_fetch_assoc($result);

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard Admin</h1>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Jumlah Tamu</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_tamu ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Tamu Hari Ini</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data_hari_ini['total']; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Jumlah Tamu</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tamu</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Nama
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Bertemu Dg
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i> Kepentingan
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var ctx = document.getElementById("myPieChart").getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: <?= json_encode($bertemu) ?>, // Data bertemu dari PHP
                    datasets: [{
                        data: <?= json_encode($jumlah_bertemu) ?>, // Data jumlah bertemu dari PHP
                        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    cutoutPercentage: 80,
                },
            });

            var ctx = document.getElementById("myAreaChart").getContext('2d');
            var myAreaChart = new Chart(ctx, {
                type: 'line', // Ini adalah jenis chart, bisa diubah sesuai kebutuhan (misalnya: 'line', 'bar', dll.)
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "Agustus", "September", "Oktober", "November", "Desember"], // Label pada sumbu X
                    datasets: [{
                        label: "Jumlah Tamu",
                        data: [10, 30, 50, 20, 60, 80, 100, 50], // Ganti dengan data aktual dari database jika diperlukan
                        backgroundColor: "rgba(78, 115, 223, 0.05)", // Warna latar belakang
                        borderColor: "rgba(78, 115, 223, 1)", // Warna garis
                        borderWidth: 2,
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5,
                                padding: 10,
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }]
                    },
                    legend: {
                        display: false
                    },
                }
            });
        </script>


        <?php
        include_once('templates/footer.php')
        ?>