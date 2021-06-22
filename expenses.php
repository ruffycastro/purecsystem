<?php include('header.php');?>
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
                            <h6 class="m-0 font-weight-bold text-primary">Daily Expenses</h6>
                            <button type="button" class="btn btn-outline-success btn-sm float-right" data-toggle="modal" data-target="#addexpenses">
  ADD
</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>PCF Reference</th>
                                            <th>Address</th>
                                            <th>TIN</th>
                                            <th>Particular</th>
                                            <th>Establishment</th>
                                            <th>OR /Invoice</th>
                                            <th>Category</th>
                                            <th>Type of Expences</th>
                                            <th>Amount</th>
                                            <th>Input Tax</th>
                                            <th>Net of VAT</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($_GET['d1'])){
                                            $d1 = $_GET['d1'];
                                            $d2 = $_GET['d2'];
                                            $sql2 = mysqli_query($conn,"SELECT * FROM expenses WHERE date_receipt >= '$d1' AND date_receipt <='$d2' ") or die(mysqli_error($conn));
                                        }else{
                                            $sql2 = mysqli_query($conn,"SELECT * FROM expenses WHERE MONTH(date_added) = MONTH(CURDATE())") or die(mysqli_error($conn));
                                        }
                                        while($row = mysqli_fetch_array($sql2)){
                                            ?>
                                            <tr>
                                                <td><?php echo $row['date_receipt'];?></td>
                                                <td><?php echo $row['name'];?></td>
                                                <td><?php echo $row['pcf_reference'];?></td>
                                                <td><?php echo $row['address'];?></td>
                                                <td><?php echo $row['tin'];?></td>
                                                <td><?php echo $row['particular'];?></td>
                                                <td><?php echo $row['establishment'];?></td>
                                                <td><?php echo $row['invoice'];?></td>
                                                <td><?php echo category_name($row['category']);?></td>
                                                <td><?php echo $row['goods_services'];?></td>
                                                <td><?php echo number_format($row['amount'],2);?></td>
                                                <td><?php echo number_format($row['vat'],2);?></td>
                                                <td><?php echo number_format($row['net_vat'],2);?></td>
                                                <td>
                                                    <?php
                                                    if($row['added_by']==$_SESSION['userid'] || $_SESSION['role']==3){
                                                        ?>
                                                        <a href="expenses-edit.php?id=<?php echo $row['id'];?>"><i class="far fa-edit"></i></a>
                                                        <?php
                                                    }else{
                                                        echo "<i class=\"far fa-edit\"></i>";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfooter>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>Amount</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfooter>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- Add Expenses Modal -->
    <div class="modal fade" id="addexpenses" tabindex="-1" role="dialog" aria-labelledby="addexpenses" aria-hidden="true">
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
                    <label>Date</label>
                    <input type="date" class="form-control" id="exampleInputEmail1" name="date_receipt" placeholder="OR / Invoice">
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Employee name">
                </div>
                <div class="form-group">
                    <label>PCF Reference</label>
                    <input type="text" class="form-control" id="pcfreference" name="pcfreference" placeholder="PCF Reference">
                </div>
                <div class="form-group">
                    <label>TIN</label>
                    <input type="text" class="form-control" name="tin" placeholder="TIN">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Address">
                </div>
                <div class="form-group">
                    <label>OR/Invoice No.</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="invoice" placeholder="OR / Invoice">
                </div>
                <div class="form-group">
                    <label>Establishment</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="establishment" placeholder="Establishment">
                </div>
                <div class="form-group">
                    <label>Particular</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="particular" placeholder="Particular">
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
                    <label>Amount</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="amount" placeholder="Amount">
                </div>
                <div class="form-group">
                    <label>VAT/Non-VAT</label>
                    <select class="form-control" name="vat">
                        <option value="1">VAT</option>
                        <option value="2">Non-VAT</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Type of Expences</label>
                    <select class="form-control" name="typeofexpences">
                    	<option value=""></option>
                    	<option value="Goods">Goods</option>
                    	<option value="Services">Services</option>
                    </select>
                </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-success" name="addexpenses" value="Save">
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End Add Expenses Modal -->
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include('footer.php');?>