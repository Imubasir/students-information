$(document).ready(function(){
    init_morris_charts();
})

function customReport() {
    $("#customModal").modal("show");
}

function init_morris_charts() {

    if (typeof (Morris) === 'undefined') { return; }
    console.log('init_morris_charts');

    if ($('#graph_area').length) {

        Morris.Area({
            element: 'graph_area',
            data: [
                { period: '2014 Q1', iphone: 2666, ipad: null, itouch: 2647 },
                { period: '2014 Q2', iphone: 2778, ipad: 2294, itouch: 2441 },
                { period: '2014 Q3', iphone: 4912, ipad: 1969, itouch: 2501 },
                { period: '2014 Q4', iphone: 3767, ipad: 3597, itouch: 5689 },
                { period: '2015 Q1', iphone: 6810, ipad: 1914, itouch: 2293 },
                { period: '2015 Q2', iphone: 5670, ipad: 4293, itouch: 1881 },
                { period: '2015 Q3', iphone: 4820, ipad: 3795, itouch: 1588 }
            ],
            xkey: 'period',
            ykeys: ['iphone', 'ipad'],
            lineColors: ['#26B99A', '#34495E'],
            labels: ['Undergraduate', 'Postgraduate'],
            pointSize: 2,
            hideHover: 'auto',
            resize: true
        });

    }


};