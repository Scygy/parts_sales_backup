<?php 
include '../../process/conn.php';

$query = "SELECT customer_code FROM pss_po_details WHERE date_created = '$server_date_only' ";
$stmt = $conn->prepare($query);
if ($stmt->execute()) {
	foreach($stmt->fetchALL() as $x){
	 $destination = $x['customer_code'];
	}


}

$query = "SELECT shipping_mode FROM pss_po_details WHERE date_created = '$server_date_only'";
$stmt = $conn->prepare($query);
if ($stmt->execute()) {
	foreach ($stmt->fetchALL() as $a) {
		$shipping_mode = $a['shipping_mode'];
	}
}




echo '
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style>
table, th, td {
  border:1px solid black;
}
</style>
</head>
<body>
<h1 style="text-align: center;">PACKING ATTACHMENT</h1>
<br>
<p>
	<label>Date:</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label>'.$server_date_only.'</label> <br><br>
	
	<label>Destination:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label>'.$destination.'</label><br><br>
	<label>SHIPMENT TYPE:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label>'.$shipping_mode.'</label>

</p>
<table style="width:100%">
	<thead>
		<tr>
			<th>Pallet No.</th>
			<th>Model No.</th>
			<th>Description</th>
			<th>No. of Boxes</th>
			<th>Qty per Box</th>
			<th>Qty</th>
			<th>Net W/T</th>
			<th>Box W/T</th>
			<th>Gross W/T</th>
			<th>Measurement</th>
		</tr>
	</thead>
';

$query = "SELECT pss_packinglist.id, pss_packinglist.pallet, pss_packinglist.parts_name, pss_packinglist.description, pss_packinglist.qty,  pss_po_details.po_num, pss_stocks.qty_per_box, pss_po_details.shipping_mode, pss_packinglist.no_of_boxes, pss_stocks.net,pss_stocks.box_weight,pss_packinglist.measurement FROM pss_packinglist LEFT JOIN pss_po_details ON pss_po_details.parts_name = pss_packinglist.parts_name LEFT JOIN pss_stocks ON pss_stocks.parts_name = pss_packinglist.parts_name WHERE pss_po_details.Status = 'Transact' GROUP BY pss_po_details.parts_name";
	$stmt = $conn-> prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) { 
		foreach ($stmt->fetchALL() as $k) {
			$net = $k['net'];
			$box_weight = $k['box_weight'];
			$measurement = $k['measurement'];
			$no_box = $k['no_of_boxes'];
			$qty_box = $k['qty_per_box'];
			$quantity2 = $no_box * $qty_box;
			$nets = $quantity2 * $net;
			$box_weights = $quantity2 * $box_weight;
			$gross = $net + $box_weight;
			$gross_compute =  $quantity2 * $gross;
			$measurements = ((1.1 * 1.13) * $measurement);
			echo '<tr>';
					echo '<td>'.$k['pallet'].'</td>';
					echo '<td  style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#assign_pallet" onclick="get_details(&quot;'.$k['id'].'~!~'.$k['po_num'].'&quot;)">'.$k['parts_name'].'</td>';
					echo '<td>'.$k['description'].'</td>';
					echo '<td class="total_box">'.$k['no_of_boxes'].'</td>';
					echo '<td>'.$k['qty_per_box'].'</td>';
					echo '<td class="total_quantity">'.$quantity2.'</td>';
					echo '<td class="total_net">'.round($nets,3).'</td>';
					echo '<td class="total_box_weight">'.round($box_weights,2).'</td>';
					echo '<td class="total_gross">'.round($gross_compute,5).'</td>';
					echo '<td class="total_measurement">'.round($measurements,2).'</td>';
					
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan = "5">No Result!</td>';
		echo '</tr>';
	}


$query2 = "SELECT * FROM print_packing_attachement";

// $query = "SELECT sum(pss_packinglist.no_of_boxes) as total_box FROM pss_packinglist";

	$stmt = $conn->prepare($query2);
if ($stmt->execute()) {
	foreach($stmt->fetchALL() as $x){
	 $total = $x['total_box'];
	 $total_qty = $x['quantity'];
	 $total_net = $x['total_net'];
	 $box_weights = $x['box_weights'];
	 $total_gross = $x['total_gross'];
	 $total_measurement = $x['total_measurement'];
			
	}

	// $query3 = "SELECT pss_stocks.qty_per_box * pss_packinglist.no_of_boxes as total_quantity FROM pss_packinglist LEFT JOIN pss_stocks ON pss_stocks.parts_name = pss_packinglist.parts_name";

	// $stmt3 = $conn->prepare($query3);
	// if ($stmt3->execute()) {
	// 	foreach ($stmt3->fetchALL() as $a) {
			
	// 		$total_qty = $a['total_quantity'];
	// 	}


	// }


echo '
<tfoot style="text-align:center" id="total_all">
              <tr>
                    <th>Total</th>
                    <thth>
                    <th></th>
                    <th></th>
                    <th>'.$total.'</th>
                    <th></th>
                    <th>'.$total_qty.'</th>
                    <th>'.round($total_net, 2).'</th>
                    <th>'.round($box_weights, 2).'</th>
                    <th>'.round($total_gross, 2).'</th>
                    <th>'.$total_measurement.'</th>
              </tr>
            </tfoot>
                </table>';


		}





?>


