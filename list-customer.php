<?php include('header.php');?>
<?php
if(isset($_POST['addcustomer'])){
    $customer = $_POST['customer'];
    $address = $_POST['address'];
    $contactno = $_POST['contactno'];
    $contactperson = $_POST['contactperson'];
    $tin = $_POST['tin'];
    $email = $_POST['email'];
    $accountby = $_POST['accountby'];
    $remarks = $_POST['remarks'];
    $added_by = $_SESSION['userid'];

    $sql = mysqli_query($conn,"INSERT INTO customer (tin,contact_person,account_by,remarks,customer_name,address,email,contact_no,added_by) VALUE('$tin','$contactperson','$accountby','$remarks','$customer','$address','$email','$contactno','$added_by')") or die(mysqli_error($conn));


}
?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">List of Customer</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary float-left">Data Information</h6>
                            <button type="button" class="btn btn-outline-success btn-sm float-right" data-toggle="modal" data-target="#addcustomer">
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
                                            <th>TIN</th>
                                            <th>Contact No.</th>
                                            <th>Contact Person</th>
                                            <th>Email</th>
                                            <th>Remarks</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql2 = mysqli_query($conn,"SELECT * FROM customer WHERE delete_status='' ") or die(mysqli_error($conn));
                                        while($row = mysqli_fetch_array($sql2)){
                                            ?>
                                            <tr>
                                                <td><a href="customer.php?id=<?php echo $row['id'];?>"><?php echo $row['customer_name'];?></a></td>
                                                <td><?php echo $row['address'];?></td>
                                                <td><?php echo $row['tin'];?></td>
                                                <td><?php echo $row['contact_no'];?></td>
                                                <td><?php echo $row['contact_person'];?></td>
                                                <td><?php echo $row['email'];?></td>
                                                <td><?php echo $row['remarks'];?></td>
                                                <td>
                                                    <a href="customer-edit.php?id=<?php echo $row['id'];?>"><i class="far fa-edit"></i></a>
                                                    <?php
                                                    if($_SESSION['role']==3){
                                                        ?>
                                                        <a href="process.php?customer-delete=&id=<?php echo $row['id'];?>"><i class="far fa-trash-alt"></i></a>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
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
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include('footer.php');?>