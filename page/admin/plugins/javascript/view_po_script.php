<script type="text/javascript">
	
const load_po =()=>{
	var po_num = document.getElementById('po_num').value;
	var customer_code = document.getElementById('customer_code').value;
	$('#spinner').css('display','block');
	$.ajax({
		url: '../../process/admin/po_process.php',
		type: 'POST',
		cache: false,
		data:{
			method: 'fetch_po',
			po_num:po_num,
			customer_code:customer_code
		},success:function(response){
			document.getElementById('view_po_data').innerHTML = response;
			$('#spinner').fadeOut(function(){
				// body...
			});
		}
	});
}

</script>