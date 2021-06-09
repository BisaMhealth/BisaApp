$( document ).ready(function() {

	async function getCoronaDataAll(){
		let url = '/corona/allcountries/';
		
		 fetch(url).then((resp) => resp.json()).then(function(data) {
    		  if(data.success == true){
    		  	$('#corona-stats').html(` `);

    		  	 let responseData = data.message; //fetchbodyContent

    		  	    responseData.map((item, index) => {
              			
              			
     					$('#corona-stats').append(`
     							<tr>
	                        <td class="tx-medium">
	                        <a href="#" class="avatar">
	                        <img style="width:30px; height:30px;" src="${item.countryInfo.flag}" class="rounded-circle" alt=""></a>
	                         ${item.country}
	                         </td>
	                        <td class="text-right">${item.todayCases}</td>
	                        <td class="text-right">${item.cases}</td>
	                        <td class="text-right">${item.recovered}</td>
	                        
                      		</tr>
     						`);
     					$('.filter-by-country').append(`
     							<option value="${item.country}">${item.country}</option>
                      		</tr>
     						`);

          			});
    		  }
    		
    		

    		});
		
	}


	$('.filter-by-country').on('change',function(){
		let ele = $(this).val();
		if(ele == 'all'){
			getCoronaDataAll();
		}else{
			getCoronaDataByCountry(ele);
		}
		
	})

		async function getCoronaDataByCountry(country){

		let url = `/corona/allcountries/${country}`;
		//let response = await fetch(`${url}`);
		 fetch(url).then((resp) => resp.json()).then(function(data) {
    		// Create and append the li's to the ul
    		  $('#corona-stats').html(` `);
    		  if(data.success == true){
    		  	 let responseData = data.message; //fetchbodyContent
    		  	 
    		  	 $('#corona-stats').append(`
     							<tr>
	                        <td class="tx-medium">
	                        <a href="#" class="avatar">
	                        <img style="width:30px; height:30px;" src="${responseData.countryInfo.flag}" class="rounded-circle" alt=""></a>
	                         ${responseData.country}</td>
	                        <td class="text-right">${responseData.todayCases}</td>
	                        <td class="text-right">${responseData.cases}</td>
	                        <td class="text-right">${responseData.recovered}</td>
	                        
                      		</tr>
     						`);
    		  	 console.log(responseData.country);
    		  }
    		
    		

    		});
		
	}

	//getCoronaDataByCountry(ghana)

	getCoronaDataAll();

});