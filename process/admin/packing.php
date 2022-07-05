<?php 
include '../conn.php';

$method = $_POST['method'];

if ($method == 'fetch_po_details') {
	$po_no = $_POST['po_no'];
	$c = 0;

	// $query = "SELECT * FROM pss_po_details WHERE po_num = '$po_no' AND Status = 'Pending'";
	$query = "SELECT * FROM pss_po_details,pss_stocks WHERE pss_po_details.parts_name = pss_stocks.parts_name AND pss_po_details.po_num = '$po_no' AND pss_po_details.Status = 'Pending' GROUP BY pss_stocks.parts_name";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $x){
			$c++;
			echo '<tr>';
					echo '<td>'.$c.'</td>';
					echo '<td>'.$x['po_num'].'</td>';
					echo '<td>'.$x['parts_name'].'</td>';
					echo '<td>'.$x['customer_code'].'</td>';
					echo '<td>'.$x['quantity'].'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan = "5" style="color:red;">No Result!</td>';
		echo '</tr>';
	}
}

if ($method == 'fetch_stock_details') {
	$po_no = $_POST['po_no'];
	$c = 0;

	
			$query = "SELECT * FROM pss_po_details,pss_stocks WHERE pss_po_details.parts_name = pss_stocks.parts_name AND pss_po_details.po_num = '$po_no' AND pss_po_details.Status = 'Pending' GROUP BY pss_stocks.parts_name";

			$stmt2 = $conn->prepare($query);
			$stmt2->execute();
			if ($stmt2->rowCount() > 0) {
				foreach($stmt2->fetchALL() as $j){
					$c++;
			echo '<tr>';
					echo '<td>'.$c.'</td>';
					echo '<td>'.$j['parts_name'].'</td>';
					echo '<td>'.$j['description'].'</td>';
					echo '<td>'.$j['remaining_stck'].'</td>';
			echo '</tr>';
				}
			}else{
		echo '<tr>';
			echo '<td colspan = "4" style="color:red;">No Result!</td>';
		echo '</tr>';
	}	
}


if ($method == 'commit_po') {
	$po_no = $_POST['po_no'];

	// $select = "SELECT parts_name,quantity FROM pss_po_details WHERE po_num = '$po_no'";
	$select = "SELECT pss_po_details.parts_name, pss_po_details.quantity, pss_stocks.remaining_stck FROM pss_po_details LEFT JOIN pss_stocks ON pss_stocks.parts_name = pss_po_details.parts_name WHERE pss_po_details.po_num = '$po_no' GROUP BY pss_po_details.parts_name";
	$stmt = $conn->prepare($select);
	if ($stmt->execute()) {
		foreach($stmt->fetchALL() as $x){
		echo	$parts_name = $x['parts_name'];
			$quantity = $x['quantity'];
			$remaining_stck = $x['remaining_stck'];

				if ($remaining_stck >= $quantity) {
					$update = "UPDATE pss_stocks SET remaining_stck = $remaining_stck - $quantity WHERE parts_name = '$parts_name'";
		$stmt2 = $conn->prepare($update);
		if ($stmt2->execute()) {
			
			$query = "INSERT INTO pss_packinglist (`parts_name`,`description`) SELECT pss_po_details.parts_name,pss_stocks.description FROM pss_po_details LEFT JOIN pss_stocks ON pss_stocks.parts_name = pss_po_details.parts_name WHERE pss_po_details.po_num = '$po_no' GROUP BY pss_stocks.parts_name";
 		$stmt3 = $conn->prepare($query);
 		if ($stmt3->execute()) {
 			$update_status = "UPDATE pss_po_details SET Status = 'Transact' WHERE po_num = '$po_no'";
 			$stmt4 = $conn->prepare($update_status);
 			if ($stmt4->execute()) {
 				echo 'success';
 			}else{
 				echo 'error';
 			}
 		}else{
 			echo 'error';
 		}

		}else{
			echo 'error';
		}
	}else{
		echo 'Lack of Stocks';
	}
		}
	
	

	}

}


if ($method == 'fetch_packing_details') {
	$po_num = $_POST['po_num'];
	// $parts_name = $_POST['parts_name'];
	$c = 0;

	$query = "SELECT pss_packinglist.id, pss_packinglist.pallet, pss_packinglist.parts_name, pss_packinglist.description, pss_packinglist.qty, pss_po_details.po_num, pss_stocks.qty_per_box, pss_po_details.shipping_mode, pss_packinglist.no_of_boxes, pss_stocks.net,pss_stocks.box_weight,pss_packinglist.measurement, pss_packinglist.Status FROM pss_packinglist LEFT JOIN pss_po_details ON pss_po_details.parts_name = pss_packinglist.parts_name LEFT JOIN pss_stocks ON pss_stocks.parts_name = pss_packinglist.parts_name WHERE pss_po_details.Status = 'Transact' GROUP BY pss_po_details.parts_name";
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
			$c++;
			echo '<tr>';
			echo '<td>'.$c.'</td>';
				// echo '<td>'.$k['po_num'].'</td>';
					echo '<td>'.$k['pallet'].'</td>';
					echo '<td  style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#assign_pallet" onclick="get_details(&quot;'.$k['id'].'~!~'.$k['po_num'].'&quot;)">'.$k['parts_name'].'</td>';
					echo '<td>'.$k['description'].'</td>';
					echo '<td class="total_box">'.$k['no_of_boxes'].'</td>';
					echo '<td>'.$k['qty_per_box'].'</td>';
					echo '<td class="total_qty">'.$quantity2.'</td>';
					echo '<td class="total_net">'.round($nets,2).'</td>';
					echo '<td class="total_box_weight">'.round($box_weights,2).'</td>';
					echo '<td class="total_gross">'.round($gross_compute,2).'</td>';
					echo '<td class="total_measurements">'.round($measurements,2).'</td>';
					// echo '<td>'.$k['shipping_mode'].'</td>';
					// round(5.045, 2); 
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan = "5">No Result!</td>';
		echo '</tr>';
	}
}
	
if ($method == 'assign_pallet') {
	$id = $_POST['id'];
	$po_num = $_POST['po_num'];
	$pallet = $_POST['pallet'];
		$no_of_boxes = $_POST['no_of_boxes'];
	$measurement = $_POST['measurement'];
	// $gross = $_POST['gross'];

	// $query = "UPDATE pss_packinglist SET pallet = '$pallet', no_of_boxes = '$box_no', measurement = '$measurement',  WHERE id = '$id'";

	$query = "UPDATE pss_packinglist SET pallet = '$pallet' ,no_of_boxes = '$no_of_boxes' , measurement = '$measurement'  WHERE id = '$id' AND Status = 'Pending'";
	$stmt = $conn->prepare($query);
	if ($stmt->execute()) {

		echo 'success';
	}else{
		echo 'error';
	}
}

// if ($method == 'commit_print') {
// 	$po_num = $_POST['po_num'];

// 	$select = "SELECT pss_po_details.po_num LEFT JOIN pss_packinglist ON pss_packinglist.parts_name WHERE pss_packinglist.po_num = '$po_num'";
// 	$stmt = $conn->prepare($select);
// 	if ($stmt->execute()) {
// 		$query = "UPDATE pss_packinglist SET Status = 'Transact' WHERE po_num = '$po_num'";
// 	$stmt2 = $conn->prepare($query);
// 	if ($stmt2->execute()) {
// 		echo 'success';
// 	}else{
// 		echo 'error';
// 	}
// 	}
// }


//update your packing shit

// if ($method == 'update_mee') {
//     $id = [];
//     $id = $_POST['id'];
//     $pallet_update = $_POST['pallet_update'];
//     $boxes_update = $_POST['boxes_update'];
//     $count = count($id);
//     foreach($id as $x){
//         $query = "UPDATE pss_packinglist SET pallet_update = '$pallet', boxes_update = '$no_of_boxes' WHERE id = '$x'";
//         $stmt = $conn->prepare($query);
//         if ($stmt->execute()) {
//             $count = $count -1;
//         }else{
//             echo 'error';
//         }
//     }
//     if ($count == 0){
//         echo 'success';
//     }else{
//         echo 'fail';
//     }
//  }

// if ($method == 'packing_print') {

// 	$query = "INSERT INTO pss_packing_history (`pallet`,`parts_name`,`description`,`qty`,`po_num`,`qty_per_box`,`shipping_mode`,`no_of_boxes`,`net`,`box_weight`,`measurement`) SELECT pss_packinglist.pallet, pss_packinglist.parts_name, pss_packinglist.description, pss_packinglist.qty,  pss_po_details.po_num, pss_stocks.qty_per_box, pss_po_details.shipping_mode, pss_packinglist.no_of_boxes, pss_stocks.net,pss_stocks.box_weight,pss_packinglist.measurement  FROM pss_packinglist LEFT JOIN pss_po_details ON pss_po_details.parts_name = pss_packinglist.parts_name LEFT JOIN pss_stocks ON pss_stocks.parts_name = pss_packinglist.parts_name WHERE pss_po_details.Status = 'Transact' GROUP BY pss_po_details.parts_name";

// 		"INSERT INTO pss_packing_history (`pallet`,`parts_name`,`description`,`qty`,`po_num`,`qty_per_box`,`shipping_mode`,`no_of_boxes`,`net`,`box_weight`,`measurement`) SELECT pss_packinglist.pallet, pss_packinglist.parts_name, pss_packinglist.description"
// 	$stmt = $conn->prepare($query);
// 	if ($stmt->execute()) {
// 			echo 'success';
// 		}else{
// 			echo 'error';
// 		}
// 	}


if ($method == 'packing_commit') {
	$po_no = $_POST['po_no'];

	$query = "INSERT INTO pss_packing_history (`pallet`,`parts_name`,`description`,`qty`,`po_num`,`qty_per_box`,`shipping_mode`,`no_of_boxes`,`net`,`box_weight`,`gross`,`measurement`) SELECT print_packing.id, print_packing.pallet, print_packing.parts_name, print_packing.description, print_packing.qty, print_packing.po_num, print_packing.qty_per_box, print_packing.shipping_mode, print_packing.no_of_boxes, print_packing.net, print_packing.box_weight, print_packing.measurement FROM print_packing";
	$stmt = $conn->prepare($query);
	if ($stmt->execute()) {

	$query2 = "UPDATE pss_packinglist SET Status = 'Transact'";
	$stmt2 = $conn->prepare($query2);
	if ($stm2->execute()) {
		echo 'sucess';
	}
		echo 'error';
	}else{
		echo 'error';
	}
	}


$conn = NULL;
?>