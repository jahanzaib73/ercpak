function plotGroph(containerId, all, today) {
    var data = [{
        label: "All",
        data: all,
        color: "#ff5450"
    }, {
        label: "Today",
        data: today,
        color: "#00bcd2"
    }];

    var plotObj = $.plot($("#" + containerId), data, {
        series: {
            pie: {
                show: true
            }
        },
        grid: {
            hoverable: true
        },
        tooltip: true,
        tooltipOpts: {
            content: function (label, x, y) {
                return label + ' : ' + y;
            },
            shifts: {
                x: 20,
                y: 0
            },
            defaultTheme: false
        }
    });

}


function plotSingleGroph(containerId, graphData) {

    var graphColor = "#ff5450";
    var graphLalbel = 'All';
    if (containerId == 'active_state_pai_chart') {
        graphColor = "#fdc107";
        var graphLalbel = 'Active';

    } else if (containerId == 'inactive_state_pai_chart') {
        graphColor = "#00bcd2";
        var graphLalbel = 'Inactive';

    }

    var data = [{
        label: graphLalbel,
        data: graphData,
        color: graphColor
    }];

    var plotObj = $.plot($("#" + containerId), data, {
        series: {
            pie: {
                show: true
            }
        },
        grid: {
            hoverable: true
        },
        tooltip: true,
        tooltipOpts: {
            content: function (label, x, y) {
                return label + ' : ' + y;
            },
            shifts: {
                x: 20,
                y: 0
            },
            defaultTheme: false
        }
    });

}
