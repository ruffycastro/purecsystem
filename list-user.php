<?php include('header.php');?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary float-left">Data Inventory</h6>
                            <button type="button" class="btn btn-outline-success btn-sm float-right" data-toggle="modal" data-target="#addproduction">
  ADD
</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql2 = mysqli_query($conn,"SELECT * FROM users ") or die(mysqli_error($conn));
                                        while($row = mysqli_fetch_array($sql2)){
                                            ?>
                                            <tr>
                                                <td><?php echo $row['fname']." ".$row['lname'];?></td>
                                                <td><?php echo $row['username'];?></td>
                                                <td><?php echo user_role($row['role']);?></td>
                                                <td><a href="#"><i class="far fa-edit"></i></a></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Production Modal -->
	<div class="modal fade" id="addproduction" tabindex="-1" role="dialog" aria-labelledby="addcustomer" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add Production</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="process.php" method="POST">
	        	<div class="form-group row">
	        		<label class="col-sm-6 col-form-label">Date of Production</label>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="date" class="form-control" name="date_production" required>
                    </div>
	        	</div>
	        	<div class="form-group row">
	        		<label class="col-sm-6 col-form-label">Purec C 250ml</label>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control" name="purec250ml" placeholder="No of Box">
                    </div>
	        	</div>
	        	<div class="form-group row">
	        		<label class="col-sm-6 col-form-label">Purec C 500ml</label>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control" name="purec500ml" placeholder="No of Box">
                    </div>
	        	</div>
                <div class="form-group row">
                    <label class="col-sm-6 col-form-label">Purec D</label>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control" name="pured" placeholder="No of Box">
                    </div>
                </div>
	        
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-success" name="addproduction">SAVE</button>
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