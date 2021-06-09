$( document ).ready(function() {

	async function getquescatstats(){
    let period = $('.stats-period').val();

		let url = `/question-cat-stats-by-year/${period}`;

		 fetch(url).then((resp) => resp.json()).then(function(data) {

          if(data.success == true){

              let ctx = document.getElementById('myChart');
              let dataLabels = data.requestLabels;

              let myChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels: data.requestLabels,
                      datasets: [{
                          label: period,
                          data: data.requestData,
                          backgroundColor: [
                              'rgba(255, 99, 132, 0.2)',
                              'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 206, 86, 0.2)',
                              'rgba(75, 192, 192, 0.2)',
                              'rgba(153, 102, 255, 0.2)',
                              'rgba(255, 159, 64, 0.2)'
                          ],
                          // borderColor: [
                          //     'rgba(255, 99, 132, 1)',
                          //     'rgba(54, 162, 235, 1)',
                          //     'rgba(255, 206, 86, 1)',
                          //     'rgba(75, 192, 192, 1)',
                          //     'rgba(153, 102, 255, 1)',
                          //     'rgba(255, 159, 64, 1)'
                          // ],
                          borderWidth: 1
                      }]
                  },
                  options: {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero: true
                              }
                          }]
                      }
                  }
              });
    		  
    		  }



    		});

	}
  getquescatstats();

});
