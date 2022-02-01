<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
	$idcus = $_POST['idcus'];
	
	$data = array(); $order_column = array("", "tb_analisis_service.id_service", "", "");
	$tabel = "select tb_analisis_service.*, tb_log_service.*, tb_customer.* from tb_analisis_service, tb_log_service, tb_customer";
	
	if($_POST["length"] != -1){
		$limit = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}
	
	if(isset($_POST["search"]["value"])){
		$value = $_POST['search']['value'];
		if($value != ""){
			$where = "where tb_analisis_service.id_service=tb_log_service.id_service and tb_log_service.id_customer=tb_customer.id_customer and tb_customer.id_customer='".$idcus."' and (tb_analisis_service.id_service like '%".$value."%')";
		} else {
			$where = "where tb_analisis_service.id_service=tb_log_service.id_service and tb_log_service.id_customer=tb_customer.id_customer and tb_customer.id_customer='".$idcus."'";
		}
	}
	
	if(isset($_POST["order"])){
		$column = $_POST["order"]["0"]["column"]; $urut = $_POST["order"]["0"]["dir"];
		if($order_column[$column] != ""){
			$order_by = "order by ".$order_column[$column]." ".$urut;
		} else {
			$order_by = "order by tb_analisis_service.id_service desc";
		}
	}
	
	$sql = mysqli_query($conn,$tabel." ".$where." ".$order_by." ".$limit);
	while($row = mysqli_fetch_array($sql)){
		if($row['status_analisis'] == 0){ $sts = "<span class='label label-warning'>Tunggu</span>"; } else
		if($row['status_analisis'] == 1){ $sts = "<span class='label label-success'>Dikerjakan</span>"; } else
		if($row['status_analisis'] > 2){ $sts = "<span class='label label-primary'>Selesai</span>"; }
		$sub_array = array();
		$sub_array[] = ""; //0
		$sub_array[] = $row['id_service']; //1
		$sub_array[] = $row['keluhan']; //2
		$sub_array[] = $sts; //3
		$data[] = $sub_array;
	}
	
	$q = mysqli_query($conn,$tabel." ".$where); $rowfilter = mysqli_num_rows($q);

	function count_all_data($conn, $tabel, $where){
		 $query = mysqli_query($conn,$tabel." ".$where); $rowCount = mysqli_num_rows($query); return $rowCount;
	}

	$output = array(
		"draw" => intval($_POST["draw"]),
		"recordsTotal" => count_all_data($conn, $tabel, $where),
		"recordsFiltered" => $rowfilter,
		"data" => $data
	);

	echo json_encode($output);
?>