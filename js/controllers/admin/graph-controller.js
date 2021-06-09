var colors = [
    '#4dc9f6',
    '#f67019',
    '#f53794',
    '#984447',
    '#826251',
    '#166a8f',
    '#00a950',
    '#778472',
    '#88498f'
];

function generateChartColors() {
    var chartColorsArray = [];
    var min = 0, max = colors.length -1;

    for (let index = 0; index <= (max*3); index++) {
        var randomNumber = Math.floor(Math.random() * (max - min + 1)) + min;
        if (!chartColorsArray.includes(colors[randomNumber])) {
            chartColorsArray.push(colors[randomNumber])
        }
    }

    return chartColorsArray;
}

function drawPieChart(ctx, labels, data, title) {
    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: data,
                backgroundColor: generateChartColors(),
                label: title
            }],
            labels: labels
        },
        options: {
            responsive: true
        }
    };

   new Chart(ctx, config);
}

function drawBarChart(ctx, labels, data, title) {
    new Chart(ctx, {
	    type: 'bar',
	    data: {
	        labels: labels,
	        datasets: [{
	        	label: title,
	            data: data, 
	            backgroundColor: generateChartColors(),
	            borderColor: [
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0',
	                '#c0c0c0'
	            ],
	            borderWidth: 2
	        }]
	    },
	    options: {
	    	responsive: true,
			title: {
				display: true,
				text: ''
			},
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero:true
	                }
	            }]
	        }
	    }
	});
}
