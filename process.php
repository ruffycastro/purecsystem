<?php
include('init.php');
$today = date('Y-m-d');
session_start();
if(isset($_GET['delete_expenses'])){
    $id = $_GET['delete_expenses'];

    $sql = mysqli_query($conn,"DELETE FROM expenses WHERE id='$id'") or die(mysqli_error($conn));
    if($sql){
    	echo "<script>location.replace('expenses.php?success')</script>";
    }else{
    	echo "<script>location.replace('expenses.php?failed')</script>";
    }
}
//Update Customer Info
if(isset($_POST['updatecustomer'])){
	$id = $_POST['id'];
    $customer = $_POST['customer'];
    $address = $_POST['address'];
    $contactno = $_POST['contactno'];
    $contactperson = $_POST['contactperson'];
    $tin = $_POST['tin'];
    $email = $_POST['email'];
    $accountby = $_POST['accountby'];
    $remarks = $_POST['remarks'];
    $added_by = $_SESSION['userid'];

    $sql = mysqli_query($conn,"UPDATE customer SET customer_name='$customer',address='$address',contact_no='$contactno',contact_person='$contactperson',tin='$tin',email='$email',account_by='$accountby',remarks='$remarks' WHERE id='$id'") or die(mysqli_error($conn));

    if($sql){
    	echo "<script>window.location = 'customer.php?id=$id&success'</script>";
    }else{
    	echo "<script>window.location = 'customer.php?id=$id&failed'</script>";
    }
}
//Add Invoice to DR
if(isset($_POST['invoice_no'])){
	$invoiceno = $_POST['invoice_no'];
	$userid = $_SESSION['userid'];
	$dateinvoice = $_POST['date_invoice'];
	$drid = $_POST['drid'];
	$id = $_POST['acct_no'];

	$sql = mysqli_query($conn,"UPDATE dr SET invoice_no='$invoiceno',invoice_date='$dateinvoice',invoice_date_added='$today',invoice_added_by='$userid' WHERE id='$drid'") or die(mysqli_error($conn));

    if($sql){
    	echo "<script>window.location = 'customer.php?id=$id&success'</script>";
    }else{
    	echo "<script>window.location = 'customer.php?id=$id&failed'</script>";
    }

}
//Add PRICING to Customer
if(isset($_POST['addpricing'])){
	$purec250pricing = $_POST['purec250pricing'];
	$purec500pricing = $_POST['purec500pricing'];
	$puredpricing = $_POST['puredpricing'];
	$id = $_POST['acct_no'];

	$sql = mysqli_query($conn,"UPDATE customer SET purec250pricing='$purec250pricing',purec500pricing='$purec500pricing',puredpricing='$puredpricing' WHERE id='$id'") or die(mysqli_error($conn));

    if($sql){
    	echo "<script>window.location = 'customer.php?id=$id&success'</script>";
    }else{
    	echo "<script>window.location = 'customer.php?id=$id&failed'</script>";
    }

}
// Add Production
if(isset($_POST['addproduction'])){
    $pured = $_POST['pured'];
    $purec500ml = $_POST['purec500ml'];
    $purec250ml = $_POST['purec250ml'];
    $dateproduction = $_POST['date_production'];
    $added_by = $_SESSION['userid'];

    $sql = mysqli_query($conn,"INSERT INTO production (date_production,purec250ml,purec500ml,pured,added_by) VALUE('$dateproduction','$purec500ml','$purec500ml','$pured','$added_by')") or die(mysqli_error($conn));

    if($sql){
    	echo "<script>window.location = 'production.php?success'</script>";
    }else{
    	echo "<script>window.location = 'production.php?failed'</script>";
    }
}
//Add Voucher Check
if(isset($_POST['addexpensescheck'])){
    $date_voucher = $_POST['date_voucher'];
    $voucher_no = $_POST['voucher_no'];
    $voucher_amount = $_POST['voucher_amount'];
    $check_date = $_POST['check_date'];
    $check_amount = $_POST['check_amount'];
    $check_no = $_POST['check_no'];
    $check_bank = $_POST['check_bank'];
    $payee = $_POST['payee'];
    $category = $_POST['category'];
    $netvat = $_POST['netvat'];
    $inputtax = $_POST['inputtax'];
    $userid = $_SESSION['userid'];
    $tin = $_SESSION['tin'];
    $address = $_SESSION['address'];

    /*
    $netvat = $check_amount / $net_vat;
    $inputtax = $netvat * $input_tax;
    */


    $sql = mysqli_query($conn,"INSERT INTO check_expenses (`tin`,`address`,`payee`,`category`,`net_vat`,`input_tax`,`check_voucher_date`,`check_voucher_no`,`check_voucher_amount`,`check_no`,`check_date`,`check_amount`,`check_bank`,`added_by`) VALUE('$tin','$address','$payee','$category','$netvat','$inputtax','$date_voucher','$voucher_no','$voucher_amount','$check_no','$check_date','$check_amount','$check_bank','$userid')") or die(mysqli_error($conn));

    if($sql){
    	echo "<script>window.location = 'expenses-check.php?success'</script>";
    }else{
    	echo "<script>window.location = 'expenses-check.php?failed'</script>";
    }
}
//Add Expenses
if(isset($_POST['addexpenses'])){
    $amount = $_POST['amount'];
    $date_receipt = $_POST['date_receipt'];
    $tin = $_POST['tin'];
    $category = $_POST['category'];
    $particular = $_POST['particular'];
    $vatstatus = $_POST['vat'];
    $establishment = $_POST['establishment'];
    $address = $_POST['address'];
    $name = $_POST['name'];
    $tin = $_POST['tin'];
    $invoice = $_POST['invoice'];
    $userid = $_SESSION['userid'];
    $typeofexpences = $_POST['typeofexpences'];
    $pcfreference = $_POST['pcfreference'];

    if($vatstatus==1){
        $netofvat = $amount / 1.12;
        $vat = $netofvat * .12;
    }

    $sql = mysqli_query($conn,"INSERT INTO expenses (goods_services,pcf_reference,date_receipt,amount,net_vat,vat,address,vat_status,particular,category,establishment,name,added_by,tin,invoice) VALUE('$typeofexpences','$pcfreference','$date_receipt','$amount','$netofvat','$vat','$address','$vatstatus','$particular','$category','$establishment','$name','$userid','$tin','$invoice')") or die(mysqli_error($conn));

    if($sql){
    	echo "<script>window.location = 'expenses.php?success'</script>";
    }else{
    	echo "<script>window.location = 'expenses.php?failed'</script>";
    }


}
//Update Category
if(isset($_POST['updatecategory'])){
    $id = $_POST['id'];
    $category_name = $_POST['category_name'];

    $sql = mysqli_query($conn,"UPDATE category SET category_name='$category_name' WHERE id='$id'") or die(mysqli_error($conn));

    if($sql){
        echo "<script>window.location = 'category.php?success'</script>";
    }else{
        echo "<script>window.location = 'category.php?failed'</script>";
    }

}
//DELETE Customer
if(isset($_GET['customer-delete'])){
	$customerid = $_GET['id'];

	$sql = mysqli_query($conn,"UPDATE customer SET delete_status='deleted' WHERE id='$customerid'") or die(mysqli_error($conn));

    if($sql){
    	echo "<script>window.location = 'list-customer.php?success'</script>";
    }else{
    	echo "<script>window.location = 'list-customer.php?failed'</script>";
    }

}
?>