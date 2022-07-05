<script type="text/javascript">
    $(document).ready(function(){
    load_packing();
    });

    
	const load_packing =()=>{
	// var parts_name = document.getElementById('parts_name').value;
    var po_num = document.getElementById('po_num').value;

   $('#spinner').css('display','block');
   $.ajax({
      url: '../../process/admin/packing.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_packing_details',
                    // parts_name:parts_name,
                    po_num:po_num
                },success:function(response){
                   document.getElementById('view_packing_details').innerHTML = response;
                      $('#spinner').fadeOut(function(){                       
                   });

                    var total_box = [];
                    $('.total_box').each(function(){
                        total_box.push($(this).html());
                    });
                    $('#total_box_data').html(eval(total_box.join('+')));

                    var total_qty = [];
                    $('.total_qty').each(function() {
                        total_qty.push($(this).html());
                    });
                    $('#total_quantity_data').html(eval(total_qty.join('+')));

                    var total_net = [];
                    $('.total_net').each(function() {
                        total_net.push($(this).html());
                    });
                    $('#total_net_data').html(eval(total_net.join('+')));

                    var total_box_weight = [];
                    $('.total_box_weight').each(function() {
                        total_box_weight.push($(this).html());
                    });
                    $('#total_box_weight_data').html(eval(total_box_weight.join('+')));

                    var total_gross = [];
                    $('.total_gross').each(function() {
                        total_gross.push($(this).html());
                    });
                    $('#total_gross_data').html(eval(total_gross.join('+')));

                    var total_measurements = [];
                    $('.total_measurements').each(function() {
                        total_measurements.push($(this).html());
                    });
                    $('#total_measurements_data').html(eval(total_measurements.join('+')));

                   }
   });
}

const get_details =(param)=>{
    var data = param.split('~!~');
    var id = data[0];
    var po_num = data[1];
    var parts_name = data[2];

    $('#id_assign').val(id);
    $('#po_num_assign').val(po_num);
    // $('#parts_name_assign').val(parts_name);
}

const assign =()=>{
   var id = document.getElementById('id_assign').value;
   var po_num = document.getElementById('po_num_assign').value;
   // var parts_name = document.getElementById('parts_name_assign').value;
   var pallet = document.getElementById('pallet_assign').value;
   
   var no_of_boxes = document.getElementById('no_of_box_assign').value;
   var measurement = document.getElementById('measurement_assign').value;

    console.log(id_assign);
   console.log(po_num_assign);

    $.ajax({
      url: '../../process/admin/packing.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'assign_pallet',
                    id:id,
                    po_num:po_num,
                    // parts_name:parts_name,
                    pallet:pallet,
                    no_of_boxes:no_of_boxes,
                    measurement:measurement
                },success:function(response){
                     if (response == 'success') {
                        swal('Success','Successfully','success');
                        load_packing();
                     }else{
                        swal('Error','Error','error');
                     }
                }
   });
}


  // const update_modal =()=>{
  //  // var arr = [];
  //  //  $('input.singleCheck:checkbox:checked').each(function () {
  //  //      arr.push($(this).val());
  //  //  });
  //  //  var numberOfChecked = arr.length;
  //  //  if(numberOfChecked > 0){
  //       var  pallet_update = document.getElementById('pallet_update').value;
  //       var boxes_update = document.getElementById('boxes_update').value;

  //   $.ajax({
  //       url: '../../process/admin/packing.php',
  //       type: 'POST',
  //       cache: false,
  //       data:{
  //           method: 'update_mee',
  //           id:arr,
  //           pallet_update: pallet_update,
  //          boxes_update:boxes_update
                        
  //       },success:function(response) {
  //           if (response == 'error') {
  //                swal('FAILED', 'FAILED', 'error');
  //            }else{
  //                load_packing();
                 
  //               swal('Success', 'Successfully Updated', 'success');
  //            }
  //       }
  //   });
  //  }

const print_kanapls =()=>{           
            var tangina = window.open();
            $('canvas').hide();
            $('button').hide();
            $('table').attr('border','1');
            $('table').css('border-collapse','collapse');
            tangina.document.write('<style>font-family:arial;</style>');
            tangina.document.write($('#print').html());
            tangina.print();
            tangina.close();
            location.reload();
        
          }

    const packing_print=()=>{
        var po_no = document.getElementById('po_no');

        $.ajax({
            url:'../../process/admin/packing.php',
            type: 'POST',
            cache: false,
            data:{
                method: 'packing_commit',
                po_no:po_no
            },success:function(response) {
                if (response == 'success') {
                    swal('Success', 'Successfully Added to History','sucess');
                }else{
                    swal('Error','Error','error');
                }
            }
        });

    }

// const total_amount =()=>{
//     var id = document.getElementById('id_total_assign').value;
//    var box_no = document.getElementById('no_of_box_total_assign').value;
//    var measurement = document.getElementById('measurement_total_assign').value;
//    var quantity = document.getElementById('quantity_total_assign').value;
//    var net = document.getElementById('net_total_assign').value;
//    var box_weight = document.getElementById('box_weight_total_assign').value;
//    var gross = document.getElementById('gross_total_assign').value;
   
//    $.ajax({
//     url: url: '../../process/admin/packing.php',
//                 type: 'POST',
//                 cache: false,
//                 data:{
//                     method: 'packing_total',
//                     id:id,
//                     box_no:box_no,
//                     measurement:measurement,
//                     quantity:quantity,
//                     net:net,
//                     box_weight:box_weight
//                },success:function(response){
//                    document.getElementById('packing_total_all').innerHTML = response;
//                       $('#spinner').fadeOut(function(){                       
//                    });
//                 }
//    });




// const total =()=>{
//     $(document).ready(function() {
//         var dataTable = $('#total').DataTable({
//             "processing" : true;
//             "serverSide" : true;
//             ""

//         })
//     })
// }

const print_packing =()=>{
    window.open('print_packing.php');
}
</script>