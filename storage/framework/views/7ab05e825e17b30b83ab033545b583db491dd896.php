<?php $__env->startSection('content'); ?>

        <div class="container-fluid">
            <div class="card-header">
                <div class="row text-center" >
                </div>
            </div>
            <!-- Temps -->
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
        // Données provenant du contrôleur Laravel
        const abonnementData = <?php echo json_encode($abonnementData, 15, 512) ?>;
        const monthlyData = <?php echo json_encode($monthlyData, 15, 512) ?>;
        const statusData = <?php echo json_encode($statusData, 15, 512) ?>;
        const versementsData = <?php echo json_encode($versementsData, 15, 512) ?>;
        const differenceData = <?php echo json_encode($differenceData, 15, 512) ?>;

        // Préparer les données pour le graphique des abonnements
        const abonnementLabels = abonnementData.map(item => item.abonnement);
        const abonnementValues = abonnementData.map(item => item.total);

        // Préparer les données pour le graphique mensuel
        const months = monthlyData.map(item => `${item.month}/${item.year}`);
        const monthlyCounts = monthlyData.map(item => item.total);

        // Préparer les données pour le graphique des statuts
        const statusLabels = statusData.map(item => `${item.month}/${item.year}`);
        const activeCounts = statusData.map(item => item.active);
        const expiredCounts = statusData.map(item => item.expired);

        // Préparer les données pour le graphique des versements
        const versementsLabels = versementsData.map(item => `${item.month}/${item.year}`);
        const versementsTotals = versementsData.map(item => item.total_amount);

        const differenceLabels = differenceData.map(item => item.month);
        const differenceValues = differenceData.map(item => item.difference);

        // Créer le graphique des abonnements
        const ctxAbonnement = document.getElementById('abonnementChart').getContext('2d');
        new Chart(ctxAbonnement, {
            type: 'bar',
            data: {
                labels: abonnementLabels,
                datasets: [{
                    label: 'Nombre d\'inscriptions par Abonnement',
                    data: abonnementValues,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Couleur rouge avec transparence
                    borderColor: 'rgba(255, 99, 132, 1)',      // Couleur rouge
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: '#000000' // Couleur du texte de la légende
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#000000' // Couleur du texte de l'axe Y
                        },
                        title: {
                            display: true,
                            text: 'Nombre',
                            color: '#000000' // Couleur du titre de l'axe Y
                        }
                    },
                    x: {
                        ticks: {
                            color: '#000000' // Couleur du texte de l'axe X
                        },
                        title: {
                            display: true,
                            text: 'Abonnement',
                            color: '#000000' // Couleur du titre de l'axe X
                        }
                    }
                }
            }
        });

        // Créer le graphique mensuel
        const ctxMonthly = document.getElementById('monthlyChart').getContext('2d');
        new Chart(ctxMonthly, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Nombre d\'inscriptions par Mois',
                    data: monthlyCounts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Couleur différente
                    borderColor: 'rgba(75, 192, 192, 1)',      // Couleur différente
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: '#000000' // Couleur du texte de la légende
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#000000' // Couleur du texte de l'axe Y
                        },
                        title: {
                            display: true,
                            text: 'Nombre d\'inscriptions',
                            color: '#000000' // Couleur du titre de l'axe Y
                        }
                    },
                    x: {
                        ticks: {
                            color: '#000000' // Couleur du texte de l'axe X
                        },
                        title: {
                            display: true,
                            text: 'Mois/Année',
                            color: '#000000' // Couleur du titre de l'axe X
                        }
                    }
                }
            }
        });

        // Créer le graphique des statuts (actif vs expiré)
        const ctxStatus = document.getElementById('statusChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'bar',
            data: {
                labels: statusLabels,
                datasets: [
                    {
                        label: 'Inscriptions Actives',
                        data: activeCounts,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Couleur bleue avec transparence
                        borderColor: 'rgba(54, 162, 235, 1)',      // Couleur bleue
                        borderWidth: 1
                    },
                    {
                        label: 'Inscriptions Expirées',
                        data: expiredCounts,
                        backgroundColor: 'rgba(255, 159, 64, 0.2)', // Couleur orange avec transparence
                        borderColor: 'rgba(255, 159, 64, 1)',      // Couleur orange
                        borderWidth: 1
                    }
                ]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: '#000000' // Couleur du texte de la légende
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#000000' // Couleur du texte de l'axe Y
                        },
                        title: {
                            display: true,
                            text: 'Nombre d\'inscriptions',
                            color: '#000000' // Couleur du titre de l'axe Y
                        }
                    },
                    x: {
                        ticks: {
                            color: '#000000' // Couleur du texte de l'axe X
                        },
                        title: {
                            display: true,
                            text: 'Mois/Année',
                            color: '#000000' // Couleur du titre de l'axe X
                        }
                    }
                }
            }
        });

        // Créer le graphique des versements
        const ctxVersements = document.getElementById('versementsChart').getContext('2d');
        new Chart(ctxVersements, {
            type: 'line',
            data: {
                labels: versementsLabels,
                datasets: [{
                    label: 'Montant Total par Mois',
                    data: versementsTotals,
                    borderColor: 'rgba(153, 102, 255, 1)', // Couleur violette
                    backgroundColor: 'rgba(153, 102, 255, 0.2)', // Couleur violette avec transparence
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: '#000000' // Couleur du texte de la légende
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#000000' // Couleur du texte de l'axe Y
                        },
                        title: {
                            display: true,
                            text: 'Montant Total',
                            color: '#000000' // Couleur du titre de l'axe Y
                        }
                    },
                    x: {
                        ticks: {
                            color: '#000000' // Couleur du texte de l'axe X
                        },
                        title: {
                            display: true,
                            text: 'Mois/Année',
                            color: '#000000' // Couleur du titre de l'axe X
                        }
                    }
                }
            }
        });

        // Créer le graphique des différences
        const ctxDifference = document.getElementById('differenceChart').getContext('2d');
        new Chart(ctxDifference, {
            type: 'bar',
            data: {
                labels: differenceLabels,
                datasets: [{
                    label: 'Différence entre Total et Versements',
                    data: differenceValues,
                    backgroundColor: 'rgba(255, 206, 86, 0.2)', // Couleur jaune avec transparence
                    borderColor: 'rgba(255, 206, 86, 1)',      // Couleur jaune
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: '#000000' // Couleur du texte de la légende
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#000000' // Couleur du texte de l'axe Y
                        },
                        title: {
                            display: true,
                            text: 'Différence',
                            color: '#000000' // Couleur du titre de l'axe Y
                        }
                    },
                    x: {
                        ticks: {
                            color: '#000000' // Couleur du texte de l'axe X
                        },
                        title: {
                            display: true,
                            text: 'Mois/Année',
                            color: '#000000' // Couleur du titre de l'axe X
                        }
                    }
                }
            }
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>