<?php $__env->startSection('content'); ?>

        <div class="container-fluid">
            <div class="card-header">
                <div class="row text-center" >
                </div>
            </div>
            <!-- Time -->
                    <div class="card-group">
                        <div class="card-body text-white" >

                            <div class="row card1-group">
                                <div class="col-lg-3 col-6">
                                        <div style="width: 100%; margin: auto;">
                                            <canvas id="abonnementChart"></canvas>

                                        </div>

                                </div>
                                <div class="col-lg-3 col-6">
                                        <div style="width: 100%; margin: auto;">
                                            <canvas id="monthlyChart"></canvas>
                                        </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                        <div style="width: 100%; margin: auto;">
                                            <canvas id="statusChart"></canvas>
                                        </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                        <div style="width: 100%; margin: auto;">
                                            <canvas id="versementsChart"></canvas>
                                        </div>
                                </div>
                            </div>
                            <div class="row card1-group">
                                

                                <div class="col-lg-3 col-6">
                                        <div style="width: 100%; margin: auto;">
                                            <canvas id="differenceChart"></canvas>
                                        </div>
                                </div>


                               
                            </div>

                        </div>
               </div> 
        </div>

        


                    

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/moment.min.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="<?php echo e(asset('adminlte/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')); ?>"></script>

<script>
        // Data from the Laravel controller
        const abonnementData = <?php echo json_encode($abonnementData, 15, 512) ?>;
        const monthlyData = <?php echo json_encode($monthlyData, 15, 512) ?>;
        const statusData = <?php echo json_encode($statusData, 15, 512) ?>;
        const versementsData = <?php echo json_encode($versementsData, 15, 512) ?>;
        const differenceData = <?php echo json_encode($differenceData, 15, 512) ?>;

        // Prepare data for the abonnement chart
        const abonnementLabels = abonnementData.map(item => item.abonnement);
        const abonnementValues = abonnementData.map(item => item.total);

        // Prepare data for the monthly chart
        const months = monthlyData.map(item => `${item.month}/${item.year}`);
        const monthlyCounts = monthlyData.map(item => item.total);

        // Prepare data for the status chart
        const statusLabels = statusData.map(item => `${item.month}/${item.year}`);
        const activeCounts = statusData.map(item => item.active);
        const expiredCounts = statusData.map(item => item.expired);

        // Prepare data for the versements chart
        const versementsLabels = versementsData.map(item => `${item.month}/${item.year}`);
        const versementsTotals = versementsData.map(item => item.total_amount);

        const differenceLabels = differenceData.map(item => item.month);
        const differenceValues = differenceData.map(item => item.difference);

        // Create abonnement chart
        const ctxAbonnement = document.getElementById('abonnementChart').getContext('2d');
        new Chart(ctxAbonnement, {
            type: 'bar',
            data: {
                labels: abonnementLabels,
                datasets: [{
                    label: 'Count of Inscriptions by Abonnement',
                    data: abonnementValues,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Red color with transparency
                    borderColor: 'rgba(255, 99, 132, 1)',      // Red color
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: '#000000' // Legend text color
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#000000' // Y-axis text color
                        },
                        title: {
                            display: true,
                            text: 'Count',
                            color: '#000000' // Y-axis title color
                        }
                    },
                    x: {
                        ticks: {
                            color: '#000000' // X-axis text color
                        },
                        title: {
                            display: true,
                            text: 'Abonnement',
                            color: '#000000' // X-axis title color
                        }
                    }
                }
            }
        });

        // Create monthly chart
        const ctxMonthly = document.getElementById('monthlyChart').getContext('2d');
        new Chart(ctxMonthly, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Number of Inscriptions per Month',
                    data: monthlyCounts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Different color
                    borderColor: 'rgba(75, 192, 192, 1)',      // Different color
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: '#000000' // Legend text color
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#000000' // Y-axis text color
                        },
                        title: {
                            display: true,
                            text: 'Number of Inscriptions',
                            color: '#000000' // Y-axis title color
                        }
                    },
                    x: {
                        ticks: {
                            color: '#000000' // X-axis text color
                        },
                        title: {
                            display: true,
                            text: 'Month/Year',
                            color: '#000000' // X-axis title color
                        }
                    }
                }
            }
        });

        // Create active vs. expired chart
        const ctxStatus = document.getElementById('statusChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'bar',
            data: {
                labels: statusLabels,
                datasets: [
                    {
                        label: 'Active Inscriptions',
                        data: activeCounts,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Blue color with transparency
                        borderColor: 'rgba(54, 162, 235, 1)',      // Blue color
                        borderWidth: 1
                    },
                    {
                        label: 'Expired Inscriptions',
                        data: expiredCounts,
                        backgroundColor: 'rgba(255, 159, 64, 0.2)', // Orange color with transparency
                        borderColor: 'rgba(255, 159, 64, 1)',      // Orange color
                        borderWidth: 1
                    }
                ]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: '#000000' // Legend text color
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#000000' // Y-axis text color
                        },
                        title: {
                            display: true,
                            text: 'Number of Inscriptions',
                            color: '#000000' // Y-axis title color
                        }
                    },
                    x: {
                        ticks: {
                            color: '#000000' // X-axis text color
                        },
                        title: {
                            display: true,
                            text: 'Month/Year',
                            color: '#000000' // X-axis title color
                        }
                    }
                }
            }
        });

        // Create versements chart
        const ctxVersements = document.getElementById('versementsChart').getContext('2d');
        new Chart(ctxVersements, {
            type: 'line',
            data: {
                labels: versementsLabels,
                datasets: [{
                    label: 'Total Montant per Month',
                    data: versementsTotals,
                    borderColor: 'rgba(153, 102, 255, 1)', // Purple color
                    backgroundColor: 'rgba(153, 102, 255, 0.2)', // Purple color with transparency
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: '#000000' // Legend text color
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#000000' // Y-axis text color
                        },
                        title: {
                            display: true,
                            text: 'Total Montant',
                            color: '#000000' // Y-axis title color
                        }
                    },
                    x: {
                        ticks: {
                            color: '#000000' // X-axis text color
                        },
                        title: {
                            display: true,
                            text: 'Month/Year',
                            color: '#000000' // X-axis title color
                        }
                    }
                }
            }
        });

        const ctxDifference = document.getElementById('differenceChart').getContext('2d');
        new Chart(ctxDifference, {
            type: 'bar',
            data: {
                labels: differenceLabels,
                datasets: [{
                    label: 'Difference Between Total and Versements',
                    data: differenceValues,
                    backgroundColor: 'rgba(255, 206, 86, 0.2)', // Yellow color with transparency
                    borderColor: 'rgba(255, 206, 86, 1)',      // Yellow color
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: '#000000' // Legend text color
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#000000' // Y-axis text color
                        },
                        title: {
                            display: true,
                            text: 'Difference',
                            color: '#000000' // Y-axis title color
                        }
                    },
                    x: {
                        ticks: {
                            color: '#000000' // X-axis text color
                        },
                        title: {
                            display: true,
                            text: 'Month/Year',
                            color: '#000000' // X-axis title color
                        }
                    }
                }
            }
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>