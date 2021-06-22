<?php include('header.php');?>
<?php
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form>
                                <div class="form-group row">
                                    <div class="col-sm-5 mb-3 mb-sm-0">
                                    <input type="date" name="d1" class="form-control" value="<?php echo $_GET['d1'];?>">
                                    </div>
                                    <div class="col-sm-5 mb-3 mb-sm-0">
                                    <input type="date" name="d2" class="form-control" value="<?php echo $_GET['d2'];?>">
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        <input type="submit" class="btn btn-primary" value="FILTER">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Check Disbursment</h6>
                            <button type="button" class="btn btn-outline-success btn-sm float-right" data-toggle="modal" data-target="#addexpensescheck">
  ADD
</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date Voucher</th>
                                            <th>Voucher No</th>
                                            <th>Payee</th>
                                            <th>Voucher Amount</th>
                                            <th>Category</th>
                                            <th>Check Date</th>
                                            <th>Check No.</th>
                                            <th>Check Amount</th>
                                            <th>Input Tax</th>
                                            <th>Net VAT</th>
                                            <th>Bank</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($_GET['d1'])){
                                            $d1 = $_GET['d1'];
                                            $d2 = $_GET['d2'];
                                            $sql2 = mysqli_query($conn,"SELECT * FROM check_expenses WHERE check_voucher_date >= '$d1' AND check_voucher_date<='$d2' ") or die(mysqli_error($conn));
                                        }else{
                                            $sql2 = mysqli_query($conn,"SELECT * FROM check_expenses WHERE MONTH(check_voucher_date) = MONTH(CURDATE())") or die(mysqli_error($conn));
                                        }
                                        while($row = mysqli_fetch_array($sql2)){
                                            ?>
                                            <tr>
                                                <td><?php echo date('Y/m/d',strtotime($row['check_voucher_date']));?></td>
                                                <td><?php echo $row['check_voucher_no'];?></td>
                                                <td><?php echo $row['payee'];?></td>
                                                <td><?php echo number_format($row['check_voucher_amount'],2);?></td>
                                                <td><?php echo category_name($row['category']);?></td>
                                                <td><?php echo date('Y/m/d',strtotime($row['check_date']));?></td>
                                                <td><?php echo $row['check_no'];?></td>
                                                <td><?php echo number_format($row['check_amount'],2);?></td>
                                                <td><?php echo $row['check_bank'];?></td>
                                                <td><?php echo $row['input_tax'];?></td>
                                                <td><?php echo $row['net_vat'];?></td>
                                                <td>
                                                    <?php
                                                        if($row['added_by']==$_SESSION['userid']){
                                                            ?>
                                                            <a href="#"><i class="fas fa-trash-alt"></i></a> <a href="#"><i class="fas fa-pencil-alt"></i></a>
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
            <!-- Add Expenses Check Modal -->
    <div class="modal fade" id="addexpensescheck" tabindex="-1" role="dialog" aria-labelledby="addexpenses" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Expenses</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="process.php" method="POST">
                <div class="form-group">
                    <label>Date of Check Voucher</label>
                    <input type="date" class="form-control" name="date_voucher" required>
                </div>
                <div class="form-group">
                    <label>Check Voucher No.</label>
                    <input type="text" class="form-control" name="voucher_no" required>
                </div>
                <div class="form-group">
                    <label>Payee</label>
                    <input type="text" class="form-control" name="payee" required>
                </div>
                <div class="form-group">
                    <label>Check Voucher Amount</label>
                    <input type="text" class="form-control" name="voucher_amount" required>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category">
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
                    <label>Check Date</label>
                    <input type="date" class="form-control" name="check_date" required>
                </div>
                <div class="form-group">
                    <label>Check Number</label>
                    <input type="text" class="form-control" name="check_no" required>
                </div>
                <div class="form-group">
                    <label>Bank</label>
                    <select name="check_bank" class="form-control">
                        <option value="union">Union Bank</option>
                        <option value="china">China Bank</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Check Amount</label>
                    <input type="text" class="form-control" name="check_amount" required>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Optiopnal</label>
                        <input type="text" class="form-control" name="netvat" placeholder="Net VAT">
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Optional</label>
                        <input type="text" class="form-control" name="inputtax" placeholder="Input Tax">
                    </div>
                </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-success" name="addexpensescheck" value="Save">
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End Add Expenses Modal -->
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include('footer.php');?>