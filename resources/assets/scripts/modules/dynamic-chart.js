// import tailwindConfig from directory_uri.theme_url + '/tailwind.config';
const Chart = require('chart.js/auto').default;
const ChartDataLabels = require('chartjs-plugin-datalabels').default;



$(document).ready(function () {
    Chart.register(ChartDataLabels);
    const chartContainer = document.querySelector('#publicationsChart');
    if (chartContainer) {
        console.log('======== GET THE DATA SETS FROM THE CHART CONTAINER ========');
        console.log('===== TOTAL PUBLICATIONS COUNT =====');
        let totalPublicationsCount = chartContainer.dataset.totalPubCount;
        console.log(totalPublicationsCount);

        console.log('===== YEARS =====');
        let Years = chartContainer.dataset.years;
        console.log(Years);

        console.log('===== PUBLICATION COUNTS =====');
        let publicationsCounts = chartContainer.dataset.publicationsCount;
        console.log(publicationsCounts);

        console.log('======== TURN THE STRINGS INTO ARRAYS ========');
        console.log('===== YEARS ARRAY =====');
        // turn the years into an array
        let yearsArr = Years.split(", ");
        console.log(yearsArr);

        console.log('===== PUBLICATIONS COUNTS ARRAY =====');
        let pubCountsArr = publicationsCounts.split(", ");
        console.log(pubCountsArr);

        // setup chart data
        const chartData = {
            labels: yearsArr,
            datasets: [{
                label: "Total publications: " + totalPublicationsCount,
                backgroundColor: 'rgb(247, 200, 12) ',
                borderColor: '#f1f1f1',
                data: pubCountsArr,
                datalabels: {
                    align: 'center',
                    anchor: 'center',
                }
            }]
        }

        // setup chart config
        const chartConfig = {
            type: 'bar',
            data: chartData,
            options: {
                plugins: {
                    datalabels: {
                        color: "#ffffff",
                        font: {
                            size: 16
                        }
                    },
                    legend: {
                        labels: {
                            font: {
                                size: 24
                            },
                            boxWidth: 0,
                        },
                        onClick: (e) => e.stopPropagation()
                    }
                },
                scales: {
                    x: {
                        title: {
                            font: {
                                size: 16
                            }
                        },
                        ticks: {
                            font: {
                                size: 16
                            }
                        }
                    },
                    y: {
                        title: {
                            font: {
                                size: 16
                            }
                        },
                        ticks: {
                            beginAtZero: true,
                            font: {
                                size: 16
                            }
                        }
                    }
                }
            },
        };

        const myChart = new Chart(chartContainer, chartConfig);
    }

})
