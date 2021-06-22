<?php
//Get Category Name
function category_name($id){
	global $conn;
	$id = $id;
	$sql = mysqli_query($conn,"SELECT category_name FROM category WHERE id='$id'");
	$row = mysqli_fetch_assoc($sql);
	$category = $row['category_name'];
	return $category;
}
//Get VAT STATUS Name
function vat_status($id){
	$id = $id;
	if($id==1){
		$vatstatus = "VAT";
	}else{
		$vatstatus = "Non-VAT";
	}
	return $vatstatus;
}
//Get User Name
function user_name($id){
	global $conn;
	$id = $id;
	$sql = mysqli_query($conn,"SELECT fname FROM users WHERE id='$id'");
	$row = mysqli_fetch_assoc($sql);
	$fname = $row['fname'];
	return $fname;
}
//Get Customer Name
function customer_name($id){
	global $conn;
	$id = $id;
	$sql = mysqli_query($conn,"SELECT customer_name FROM customer WHERE id='$id'");
	$row = mysqli_fetch_assoc($sql);
	$customername = $row['customer_name'];
	return $customername;
}
//Get Customer TIN
function customer_tin($id){
	global $conn;
	$id = $id;
	$sql = mysqli_query($conn,"SELECT tin FROM customer WHERE id='$id'");
	$row = mysqli_fetch_assoc($sql);
	$tin = $row['tin'];
	return $tin;
}
//Get DR Number
function drnumber($id){
	global $conn;
	$id = $id;
	$sql = mysqli_query($conn,"SELECT dr_no FROM dr WHERE id='$id'");
	$row = mysqli_fetch_assoc($sql);
	$drnumber = $row['dr_no'];
	return $drnumber;
}
//Get User Role
function user_role($id){
	$id = $id;
	if($id==1){
		$role = "User";
	}elseif($id==2){
		$role = "Admin";
	}elseif($id==3){
		$role = "Full Admin";
	}
	return $role;
}
//Get Delivery Status
function delivery_status($id){
	$id = $id;
	if($id==0){
		$status = "<i class='btn btn-sm btn-warning'>Pending</i>";
	}elseif($id==1){
		$status = "<i class='btn btn-sm btn-success'>Delivered</i>";
	}elseif($id==2){
		$status = "<i class='btn btn-sm btn-danger'>Cancel</i>";
	}
	return $status;
}
?>