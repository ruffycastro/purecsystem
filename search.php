<?php include('header.php');?>
<?php
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

    if($vatstatus==1){
        $netofvat = $amount / 1.12;
        $vat = $netofvat * .12;
    }

    $sql = mysqli_query($conn,"INSERT INTO expenses (date_receipt,amount,net_vat,vat,address,vat_status,particular,category,establishment,name,added_by,tin,invoice) VALUE('$date_receipt','$amount','$netofvat','$vat','$address','$vatstatus','$particular','$category','$establishment','$name','$userid','$tin','$invoice')") or die(mysqli_error($conn));


}
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">List of Expenses</h6>
                            <button type="button" class="btn btn-outline-success btn-sm float-right" data-toggle="modal" data-target="#addexpenses">
  ADD
</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Address</th>
                                            <th>Contact No.</th>
                                            <th>Email</th>
                                            <th>Remarks</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = $_GET['q'];
                                        $sql2 = mysqli_query($conn,"SELECT * FROM customer WHERE customer_name LIKE '$query%'") or die(mysqli_error($conn));
                                        while($row = mysqli_fetch_array($sql2)){
                                            ?>
                                            <tr>
                                                <td><a href="customer.php?id=<?php echo $row['id'];?>"><?php echo $row['customer_name'];?></a></td>
                                                <td><?php echo $row['address'];?></td>
                                                <td><?php echo $row['contact_no'];?></td>
                                                <td><?php echo $row['email'];?></td>
                                                <td><?php echo $row['remarks'];?></td>
                                                <td><a href="dr-add.php?customer=<?php echo $row['id'];?>" title="ADD DR"><i class="fas fa-folder-plus"></i></a></td>
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