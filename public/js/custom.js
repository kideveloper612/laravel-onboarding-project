// Ajax Request Function
function Ajax_request(url, method, payload=''){
	
	return new Promise((resolve, reject)=>{
	
		if (method === 'POST')
			$.ajax({
				url: url,
				method: method,
				data: {payload:payload},
				success: function(response){
					resolve(response);
				},
				error: function(err){
					reject(err);
				}
			})
		else if(method === 'DELETE')
			$.ajax({
				url: url,
				method: method,
				data: {payload : payload},
				success: function(response){
					resolve(response);
				},
				error: function(err){
					reject(err);
				}
			})
		else
			if(payload !== '')
				$.ajax({
					url: url+'/'+payload,
					method: method,
					success: function(response){
						resolve(response);
					},
					error: function(err){
						reject(err);
					}
				})
			else{
				$.ajax({
					url: url,
					method: method,
					success: function(response){
						resolve(response);
					},
					error: function(err){
						reject(err);
					}
				})}
	})
}

function phone_ajax(url, method, payload='') {
	return new Promise((resolve, reject) => {
		if (method == 'GET') {
			$.ajax({
				url: url,
				method: method,
				data: {id : payload},
				success: function(response) {
					resolve(response[0]);
				},
				error: function(err) {
					reject(err);
				}
			})
		}
	});
}

// Form remove
async function onFormRemove(){
	var formlist = await Ajax_request('build/create', 'GET');
	$("#formList").empty();
	$('#formList').append("<option value='' selected>-- Please select --</option>");
	for(index in formlist){
		$( "#formList" ).append("<option value='" + formlist[index].id + "'>" + formlist[index].section + "</option>");
	}
	$('#formDeleteList').modal('show');
}

$('#formList').change(function(e){
    e.preventDefault() // Don't post the form, unless confirmed
    if (confirm('Do you want really to delete this form?')) {
        // Post the form
        $(e.target).closest('form').submit() // Post the surrounding form
    }
});

// Form edit
async function onFormEdit(){
	var formlist = await Ajax_request('build/create', 'GET');
	$("#formEditOption").empty();
	$('#formEditOption').append("<option value='' selected>-- Please select --</option>");
	for(index in formlist){
		$( "#formEditOption" ).append("<option value='" + formlist[index].id + "'>" + formlist[index].section + "</option>");
	}
	$('#formEditList').modal('show');
} 