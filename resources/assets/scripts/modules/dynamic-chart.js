// import tailwindConfig from directory_uri.theme_url + '/tailwind.config';
const Chart = require('chart.js/auto').default;

$(document).ready(function () {
    const chartContainer = document.querySelector('#publicationsChart');
    if (chartContainer) {
        console.log('======== GET THE DATA SETS FROM THE CHART CONTAINER ========');
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
                label: "Publications per Year",
                backgroundColor: '#00b0d5',
                borderColor: '#f1f1f1',
                data: pubCountsArr,
            }]
        }

        // setup chart config
        const chartConfig = {
            type: 'bar',
            data: chartData,
            options: {},
        };

        const myChart = new Chart(chartContainer, chartConfig);
    }

})
