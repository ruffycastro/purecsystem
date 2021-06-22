<?php include('header.php');?>
<?php
$id = $_GET['id'];
if(isset($_GET['id'])){
    $sql = mysqli_query($conn,"SELECT * FROM customer WHERE id='$id'") or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($sql);
}
?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 border-left-primary shadow h-100 py-2">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary float-left">Data Information</h6>
                        </div>
                        <div class="card-body">
                            <form action="process.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                              <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Customer</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="customer" placeholder="Customer Name" value="<?php echo $row['customer_name'];?>">    
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="address" placeholder="Complete Address"><?php echo $row['address'];?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Contact No.</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="contactno" placeholder="Contact Number" value="<?php echo $row['contact_no'];?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Contact Person</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="contactperson" placeholder="Contact Person" value="<?php echo $row['contact_person'];?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">TIN</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="tin" placeholder="TIN" value="<?php echo $row['tin'];?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $row['email'];?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Account by</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="accountby" placeholder="Account by" value="<?php echo $row['account_by'];?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Remarks</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="remarks"><?php echo $row['remarks'];?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <a href="customer.php?id=<?php echo $row['id'];?>" class="btn btn-secondary">Cancel</a>
                                        <input type="submit" name="updatecustomer" value="SAVE" class="btn btn-success">
                                    </div>
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
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Customer Modal -->
	<div class="modal fade" id="addcustomer" tabindex="-1" role="dialog" aria-labelledby="addcustomer" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">New Customer</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="" method="POST">
	        	<div class="form-group">
	        		<label>Customer</label>
	        		<input type="text" class="form-control" name="customer" placeholder="Customer Name">
	        	</div>
	        	<div class="form-group">
	        		<label>Address</label>
	        		<textarea class="form-control" name="address" placeholder="Complete Address"></textarea>
	        	</div>
	        	<div class="form-group">
	        		<label>Contact No.</label>
	        		<input type="number" class="form-control" name="contactno" placeholder="Contact Number">
	        	</div>
                <div class="form-group">
                    <label>Contact Person</label>
                    <input type="text" class="form-control" name="contactperson" placeholder="Contact Person">
                </div>
                <div class="form-group">
                    <label>TIN</label>
                    <input type="number" class="form-control" name="tin" placeholder="TIN">
                </div>
	        	<div class="form-group">
	        		<label>Email</label>
	        		<input type="email" class="form-control" name="email" placeholder="Email">
	        	</div>
                <div class="form-group">
                    <label>Account by</label>
                    <input type="text" class="form-control" name="accountby" placeholder="Account by">
                </div>
                <div class="form-group">
                    <label>Remarks</label>
                    <textarea class="form-control" name="remarks"></textarea>
                </div>
	        
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-success" name="addcustomer">SAVE</button>
	        </form>
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