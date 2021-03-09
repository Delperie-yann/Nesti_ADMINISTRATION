window.addEventListener("DOMContentLoaded", (event) => {
    console.log("DOM entièrement chargé et analysé");

    /****************************************************************************************************************************************
     * Orders chart.
     ***************************************************************************************************************************************/
    const el = document.getElementById('chartOrders');
    console.log(el);
    const data = {

        categories: [
            '0',
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9'
        ],

        series: [
            {
                name: 'Coûts',
                data: [444, 457, 477, 479, 446, 476, 457, 472, 467, 455, 458, 458, 451],
            },
            {
                name: 'Ventes',
                data: [466, 507, 472, 475, 485, 470, 500, 496, 487, 491, 490, 476, 489],
            },
        ],
    };

    const options = {
        chart: { title: '', width: 900, height: 400 },
        xAxis: { pointOnColumn: false, title: { text: '' } },
        yAxis: { title: '' },
    };

    const chart = toastui.Chart.lineChart({ el, data, options });

    /****************************************************************************************************************************************
   * Consultations chart.
   *****************************************************************************************************************************************/
    const el1 = document.getElementById('chartConsultations');
    const data1 = {
        categories: ['Browser'],
        series: [
            {
                name: '0h/6h',
                data: 46.02,
            },
            {
                name: '6h/8h',
                data: 20.47,
            },
            {
                name: '8h/10h',
                data: 20.47,
            },
            {
                name: '10h/12h',
                data: 17.71,
            },
            {
                name: '12h/14h',
                data: 5.45,
            },
            {
                name: '14h/16h',
                data: 3.1,
            },
            {
                name: '16h/18h',
                data: 7.25,
            },
            {
                name: '18h/20h',
                data: 3.1,
            },
            {
                name: '20h/22h',
                data: 7.25,
            },
            {
                name: '22h/0h',
                data: 7.25,
            },
        ],
    };
    const theme = {
        series: {
            dataLabels: {
                fontFamily: 'monaco',
                useSeriesColor: true,
                lineWidth: 2,
                textStrokeColor: '#ffffff',
                shadowColor: '#ffffff',
                shadowBlur: 4,
                callout: {
                    lineWidth: 3,
                    lineColor: '#f44336',
                    useSeriesColor: false,
                },
                pieSeriesName: {
                    useSeriesColor: false,
                    color: '#f44336',
                    fontFamily: 'fantasy',
                    fontSize: 13,
                    textBubble: {
                        visible: true,
                        paddingX: 1,
                        paddingY: 1,
                        backgroundColor: 'rgba(158, 158, 158, 0.3)',
                        shadowOffsetX: 0,
                        shadowOffsetY: 0,
                        shadowBlur: 0,
                        shadowColor: 'rgba(0, 0, 0, 0)',
                    },
                },
            },
        },
    };

    const options1 = {
        chart: { title: '', width: 600, height: 500 },
        series: {
            dataLabels: {
                visible: true,
                pieSeriesName: { visible: true, anchor: 'outer' },
            },
        },
        theme,
    };

    const chart1 = toastui.Chart.pieChart({ el: el1, data: data1, options: options1 });


    /****************************************************************************************************************************************
      * Articles chart.
      **************************************************************************************************************************************/
    const el2 = document.getElementById('chartArticles');
    const data2 = {
        categories: ['1', '2', '3', '4', '5', '6', '7'],
        series: [
            {
                name: 'Ventes',
                data: [10, 20, 30, 20, 60, 100, 150],
            },
            {
                name: 'Coûts par articles',
                data: [50, 10, 20, 10, 40, 150, 100],
            },
        ],
    };
    const options2 = {
        chart: { title: 'Nombre d articles en vente', width: 900, height: 400 },
        series: {
            shift: true,
        },
    };

    const chart2 = toastui.Chart.columnChart({ el: el2, data: data2, options: options2 });

    let idx = 8;
    const intervalId = setInterval(() => {
        const randomData = [0, 1].map(() => Math.round(Math.random() * 200));
        chart.addData(randomData, idx.toString());
        if (idx === 20) {
            clearInterval(intervalId);
        }
        idx += 1;
    }, 2500);
});

