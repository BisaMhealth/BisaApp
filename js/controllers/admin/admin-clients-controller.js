getAllClients();

function getAllClients() {
	jQuery.ajax({
        url: ADMIN_CONSTANTS.GET_CLIENTS_URL,
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer ")
        },
        success: function(response) {
            if (response.success) {
            	var template = '';
            	var counter = 1;

            	if (response.data.length > 0) {
            		template += `
            		    <h5 class='text-center'><b>List of Clients</b></h5><br>
            			<table class="table data-table table-hover table-sm">
						  	<thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Name</th>
							      <th scope="col">Email</th>
							      <th scope="col">Phone</th>
							    </tr>
						  	</thead>
						  	<tbody>
            		`;

            		response.data.forEach(function(item) {
            			var itemObj = JSON.stringify(item);

            			template += `
            				<tr>
						      <th scope="row">${counter}</th>
						      <td>${item.name}</td>
						      <td>${item.email}</td>
						      <td>${item.phone}</td>
						    </tr>
            			`;

            			counter ++;
            		});

            		template += `
            			</tbody>
            			</table>
            		`;

            	} else {
            		template += `
            			<div class='jumbotron'>
            				<h5 class='text-center'>No clients available</h5>
            			</div>
            		`;

            	}

                jQuery('.clients-res').html(template);
                jQuery(".data-table").DataTable();
            } else {

            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    });
}
