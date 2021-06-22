<?php include('header.php');?>
<?php
$id = $_GET['customer'];
if(isset($_POST['adddr'])){
    $dr_date = $_POST['dr_date'];
    $dr_no = $_POST['dr_no'];
    $delivery_man = $_POST['delivery_man'];
    $delivery_address = $_POST['delivery_address'];
    $purec250ml = $_POST['purec250ml'];
    $price250ml = $_POST['price250ml'];
    $purec500ml = $_POST['purec500ml'];
    $price500ml = $_POST['price500ml'];
    $pured = $_POST['pured'];
    $puredprice = $_POST['puredprice'];
    $released_by = $_POST['released_by'];
    $dispatcher = $_POST['dispatcher'];
    $total_amt = $_POST['total_amt'];
    $acct_no = $_POST['acct_no'];
    $userid = $_SESSION['userid'];
    $delivered = $_POST['delivered'];

    $total250 = $price250ml * $purec250ml;
    $total500 = $price500ml * $purec500ml;
    $totalpured = $puredprice * $pured;
    
    $totalamount = $total250 + $total500 + $totalpured; 

    $sql = mysqli_query($conn,"INSERT INTO dr (delivered,dr_date,dr_no,delivery_man,delivery_address,purec250ml,price250ml,purec500ml,price500ml,pured,puredprice,released_by,dispatcher,acct_no,total_amt,added_by,balance) VALUE('$delivered','$dr_date','$dr_no','$delivery_man','$delivery_address','$purec250ml','$price250ml','$purec500ml','$price500ml','$pured','$puredprice','$released_by','$dispatcher','$acct_no','$totalamount','$userid','$totalamount')") or die(mysqli_error($conn));

    if($sql){
        echo"<script>window.location = 'customer.php?id=$id&success'</script>";
    }else{
    	echo"<script>window.location = 'customer.php?id=$id&failed'</script>";
    }


}
if(isset($_GET['id'])){
	$sql = mysqli_query($conn,"SELECT * FROM expenses WHERE id='$id'") or die(mysqli_error($conn));
	$row = mysqli_fetch_assoc($sql);
}
//Get Customer Info
$sql = mysqli_query($conn,"SELECT purec250pricing,purec500pricing,puredpricing FROM customer WHERE id='$id'") or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($sql);

?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 border-left-primary shadow h-100 py-2">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Delivery Receipt</h6>
                        </div>
                        <div class="card-body">
                                <form action="" method="POST">
                                <input type="hidden" name="acct_no" value="<?php echo $_GET['customer'];?>">
                                    <div class="form-group">
                                        <label>DR Date</label>
                                        <input type="date" class="form-control" id="exampleInputEmail1" name="dr_date" required>
                                    </div>
                                    <div class="form-group">
                                        <label>DR No.</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="dr_no" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Delivery Man</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="delivery_man" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Delivery Address</label>
                                        <textarea class="form-control" name="delivery_address" required></textarea>
                                    </div>
                                    <div class="form-group row">
                                    	<div class="col-sm-6 mb-3 mb-sm-0">
                                    		<label>PureC 250ml</label>
                                        	<input type="text" class="form-control" id="exampleInputEmail1" name="purec250ml" placeholder="Number only(BOX)">
                                    	</div>
                                    	<div class="col-sm-6 mb-3 mb-sm-0">
                                    		<label>Price</label>
                                        	<input type="text" class="form-control" id="exampleInputEmail1" name="price250ml" placeholder="Price per box" value="<?php echo $row['purec250pricing'];?>">
                                    	</div>
                                    </div>
                                    <div class="form-group row">
                                    	<div class="col-sm-6 mb-3 mb-sm-0">
                                    		<label>PureC 500ml</label>
                                        	<input type="text" class="form-control" id="exampleInputEmail1" name="purec500ml" placeholder="Number only(BOX)" >
                                    	</div>
                                    	<div class="col-sm-6 mb-3 mb-sm-0">
                                    		<label>Price</label>
                                        	<input type="text" class="form-control" id="exampleInputEmail1" name="price500ml" placeholder="Price per box" value="<?php echo $row['purec500pricing'];?>">
                                    	</div>
                                    </div>
                                    <div class="form-group row">
                                    	<div class="col-sm-6 mb-3 mb-sm-0">
                                    		<label>PureD 1L</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="pured" placeholder="Number only(BOX)" >
                                    	</div>
                                    	<div class="col-sm-6 mb-3 mb-sm-0">
                                    		<label>Price</label>
                                        	<input type="text" class="form-control" id="exampleInputEmail1" name="puredprice" placeholder="Price per box" value="<?php echo $row['puredpricing'];?>">
                                    	</div>
                                    </div>
                                    <div class="form-group">
                                        <label>Released By</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="released_by" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Dispatcher</label>
                                        <input type="text" class="form-control" name="dispatcher" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Delivery Status</label>
                                        <select class="form-control" name="delivered">
                                            <option value="0">Pending</option>
                                            <option value="1">Delivered</option>
                                            <option value="2">Cancel</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <a href="customer.php?id=<?php echo $_GET['customer'];?>" class="btn btn-secondary" >Close</a>
                                        <input type="submit" class="btn btn-success" name="adddr" value="Save">
                                    </div>
                    	        </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <!-- Additional Script -->
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>


</body>

</html>