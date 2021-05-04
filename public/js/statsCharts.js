window.addEventListener("DOMContentLoaded", (event) => {
    console.log("DOM entièrement chargé et analysé");
    
    /****************************************************************************************************************************************
     * Orders chart.
     ***************************************************************************************************************************************/
    const el = document.getElementById('chartOrders');
    // console.log(el);
    console.log("JsVars for Statisctic :", vars.connexionByHour);
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
                data: vars.cost,
            },
            {
                name: 'Ventes',
                data: vars.vente,
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
    console.log(vars.connexionByHour);
    const data1 = {
        categories: ['Browser'],
        series: vars.connexionByHour
            
        
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
                data: vars.articleVente,
            },
            {
                name: 'Coûts par articles',
                data: vars.costByArticle,
            },
        ],
    };
    const options2 = {
        chart: { title: '', width: 900, height: 400 },
        series: {
            shift: true,
        },
    };

    const chart2 = toastui.Chart.columnChart({ el: el2, data: data2, options: options2 });

    
});

