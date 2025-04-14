<x-layout>

    <!DOCTYPE html>
    <html dir="ltr" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex,nofollow">
        <title>Dashboard - IndoApril</title>
        <link rel="icon" type="image/png" sizes="16x16"
            href="http://45.64.100.26:88/ukk-kasir/public/assets/images/favicon.png">
        <link href="http://45.64.100.26:88/ukk-kasir/public/assets/libs/chartist/dist/chartist.min.css"
            rel="stylesheet">
        <link
            href="http://45.64.100.26:88/ukk-kasir/public/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css"
            rel="stylesheet">
        <link href="http://45.64.100.26:88/ukk-kasir/public/dist/css/style.min.css" rel="stylesheet">
        <link rel="stylesheet" href="http://45.64.100.26:88/ukk-kasir/public/plugins/swal2.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    </head>

    <body>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                                <li class="breadcrumb-item"><a href="index.html" class="link"><i
                                            class="mdi mdi-home-outline fs-4"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                        <h1 class="mb-0 fw-bold">Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h3>Selamat Datang, PETUGAS [that's not finished, stay tuned!]!</h3>
                                <div class="row">
                                    <div class="col-8">
                                        <canvas id="myChart" width="400" height="200"></canvas>
                                    </div>
                                    <div class="col-4">
                                        <canvas id="myChart2" width="400" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#salesTable').DataTable({
                    "language": {
                        "emptyTable": "Tidak ada data tersedia",
                        "search": "Cari:",
                        "lengthMenu": "Tampilkan _MENU_ entri",
                        "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                        "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": "Selanjutnya",
                            "previous": "Sebelumnya"
                        }
                    }
                });
            });
        </script>
        <script src="http://45.64.100.26:88/ukk-kasir/public/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="http://45.64.100.26:88/ukk-kasir/public/dist/js/app-style-switcher.js"></script>
        <script src="http://45.64.100.26:88/ukk-kasir/public/plugins/swal2.js"></script>
        <script src="http://45.64.100.26:88/ukk-kasir/public/dist/js/waves.js"></script>
        <script src="http://45.64.100.26:88/ukk-kasir/public/dist/js/sidebarmenu.js"></script>
        <script src="http://45.64.100.26:88/ukk-kasir/public/dist/js/custom.js"></script>
        <script src="http://45.64.100.26:88/ukk-kasir/public/assets/libs/chartist/dist/chartist.min.js"></script>
        <script
            src="http://45.64.100.26:88/ukk-kasir/public/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js">
        </script>
        <script src="http://45.64.100.26:88/ukk-kasir/public/dist/js/pages/dashboards/dashboard1.js"></script>
        <script>
            console.log(["13 March 2025", "14 March 2025", "16 March 2025", "19 March 2025", "20 March 2025", "21 March 2025",
                "22 March 2025", "23 March 2025", "24 March 2025", "25 March 2025", "26 March 2025", "27 March 2025",
                "28 March 2025", "29 March 2025", "30 March 2025", "31 March 2025", "01 April 2025", "02 April 2025",
                "03 April 2025", "04 April 2025", "05 April 2025", "06 April 2025", "07 April 2025"
            ]);
            console.log([13, 11, 4, 2, 3, 6, 24, 22, 22, 19, 24, 24, 29, 21, 21, 8, 11, 26, 45, 40, 46, 58, 110]);
            console.log(["ijoo", "ayam", "ruliminions", "Obat", "red orchid flowerr", "paracetamol", "Patrick", "toren",
                "kipas", "Bibit Toge", "apel"
            ]);
            console.log([75, 243, 66, 154, 64, 32, 7, 3, 8, 19, 8]);
            const ctx = document.getElementById('myChart').getContext('2d');
            const salesChart = new Chart(ctx, {
                type: 'bar', // Jenis grafik
                data: {
                    labels: ["13 March 2025", "14 March 2025", "16 March 2025", "19 March 2025", "20 March 2025",
                        "21 March 2025", "22 March 2025", "23 March 2025", "24 March 2025", "25 March 2025",
                        "26 March 2025", "27 March 2025", "28 March 2025", "29 March 2025", "30 March 2025",
                        "31 March 2025", "01 April 2025", "02 April 2025", "03 April 2025", "04 April 2025",
                        "05 April 2025", "06 April 2025", "07 April 2025"
                    ], // Menggunakan data dari controller
                    datasets: [{
                        label: 'Jumlah Penjualan',
                        data: [13, 11, 4, 2, 3, 6, 24, 22, 22, 19, 24, 24, 29, 21, 21, 8, 11, 26, 45, 40, 46,
                            58, 110
                        ], // Menggunakan data dari controller
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const ctx2 = document.getElementById('myChart2').getContext('2d');
            const myPieChart = new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: ["ijoo", "ayam", "ruliminions", "Obat", "red orchid flowerr", "paracetamol", "Patrick",
                        "toren", "kipas", "Bibit Toge", "apel"
                    ],
                    datasets: [{
                        label: 'Persentase Penjualan Produk',
                        data: [75, 243, 66, 154, 64, 32, 7, 3, 8, 19, 8],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Persentase Penjualan Produk'
                        }
                    }
                }
            });
        </script>
        <script>
            function notif(type, msg) {
                Swal.fire({
                    icon: type,
                    text: msg
                })
            }
        </script>
        <script>
            function HitData(urlPost, dataPost, typePost) {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: urlPost,
                        data: dataPost,
                        type: typePost,
                        headers: {
                            'X-CSRF-TOKEN': "Lwae60MB2gIQ7WELSbccuKKjcWHMR1DrOlOfIJS0"
                        },
                        success: (response) => {
                            resolve(response)
                        },
                        error: (error) => {
                            reject(error)
                        }
                    })
                })
            }
        </script>
    </body>

    </html>

</x-layout>
