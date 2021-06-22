<?php include('header.php');?>
<?php
$id = $_GET['id'];
if(isset($_POST['updateexpenses'])){
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
    $pcfreference = $_POST['pcfreference'];
    $goods_services = $_POST['goods_services'];

    if($vatstatus==1){
        $netofvat = $amount / 1.12;
        $vat = $netofvat * .12;
    }

    $sql = mysqli_query($conn,"UPDATE expenses SET pcf_reference='$pcfreference',goods_services='$goods_service',date_receipt='$date_receipt',amount='$amount',net_vat='$netofvat',vat='$vat',address='$address',vat_status='$vatstatus',particular='$particular',category='$category',establishment='$establishment',name='$name',added_by='$userid',tin='$tin',invoice='$invoice' WHERE id='$id' ") or die(mysqli_error($conn));

    if($sql){
    	echo "<script>location.replace('expenses.php?success')</script>";
    }else{
    	echo "<script>location.replace('expenses.php?failed')</script>";
    }


}
if(isset($_GET['id'])){
	$sql = mysqli_query($conn,"SELECT * FROM expenses WHERE id='$id'") or die(mysqli_error($conn));
	$row = mysqli_fetch_assoc($sql);
}
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">List of Expenses</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="" method="POST">
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" class="form-control" id="exampleInputEmail1" name="date_receipt" placeholder="OR / Invoice" value="<?php echo $row['date_receipt'];?>">
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Employee name" value="<?php echo $row['name'];?>">
                </div>
                <div class="form-group">
                    <label>PCF Reference</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="pcfreference" placeholder="PCF Reference" value="<?php echo $row['pcf_reference'];?>">
                </div>
	        	<div class="form-group">
	        		<label>OR/Invoice No.</label>
	        		<input type="text" class="form-control" id="exampleInputEmail1" name="invoice" placeholder="OR / Invoice" value="<?php echo $row['invoice'];?>">
	        	</div>
	        	<div class="form-group">
	        		<label>Establishment</label>
	        		<input type="text" class="form-control" id="exampleInputEmail1" name="establishment" placeholder="Establishment" value="<?php echo $row['establishment'];?>">
	        	</div>
	        	<div class="form-group">
	        		<label>Address</label>
	        		<textarea class="form-control" name="address" placeholder="Complete Address"><?php echo $row['address'];?></textarea>
	        	</div>
	        	<div class="form-group">
	        		<label>TIN</label>
	        		<input type="text" class="form-control" name="tin" placeholder="TIN" value="<?php echo $row['tin'];?>">
	        	</div>
	        	<div class="form-group">
	        		<label>Particular</label>
	        		<input type="text" class="form-control" id="exampleInputEmail1" name="particular" placeholder="Particular" value="<?php echo $row['particular'];?>">
	        	</div>
	        	<div class="form-group">
	        		<label>Category</label>
	        		<select class="form-control" name="category">
	        			<option value="<?php echo $row['category'];?>" selected><?php echo category_name($row['category']);?></option>
                    <?php
                    $sqlcategory = mysqli_query($conn,"SELECT * FROM category") or die(mysqli_error($conn));
                    while($rowcategory = mysqli_fetch_array($sqlcategory)){
                        ?>
                        <option value="<?php echo $rowcategory['id'];?>"><?php echo $rowcategory['category_name'];?></option>
                        <?php
                    }
                    ?>
	        		</select>
	        	</div>

	        	<div class="form-group">
	        		<label>Amount</label>
	        		<input type="text" class="form-control" id="exampleInputEmail1" name="amount" placeholder="Amount" value="<?php echo $row['amount'];?>">
	        	</div>
	        	<div class="form-group">
	        		<label>VAT/Non-VAT</label>
	        		<select class="form-control" name="vat">
                        <option value="<?php echo $row['vat_status'];?>" selected><?php echo vat_status($row['vat_status']);?></option>
	        			<option value="1">VAT</option>
	        			<option value="2">Non-VAT</option>
	        		</select>
	        	</div>
                <div class="form-group">
                    <label>Type of Expenses</label>
                    <select class="form-control" name="goods_services">
                        <option value="<?php echo $row['goods_services'];?>" selected><?php echo $row['goods_services'];?></option>
                        <option value="Goods">Goods</option>
                        <option value="Services">Services</option>
                    </select>
                </div>
	        
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <input type="submit" class="btn btn-success" name="updateexpenses" value="Save">
	        </form>
                            </div>
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