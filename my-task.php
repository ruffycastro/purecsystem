<?php include('header.php');?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    <input type="date" name="d1" class="form-control" value="<?php echo $_GET['d1'];?>">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    <input type="date" name="d2" class="form-control" value="<?php echo $_GET['d2'];?>">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    <select class="form-control" name="task">
                                        <option value="expenses">Expenses</option>
                                        <option value="newaccount">New Account</option>
                                        <option value="inputproduction">Input Production</option>
                                    </select>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
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
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>TIN</th>
                                            <th>Particular</th>
                                            <th>Establishment</th>
                                            <th>OR /Invoice</th>
                                            <th>Category</th>
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
                                            $i = 0;
                                            ?>
                                            <tr>
                                                <td><?php echo $row['date_receipt'];?></td>
                                                <td><?php echo $row['name'];?></td>
                                                <td><?php echo $row['address'];?></td>
                                                <td><?php echo $row['tin'];?></td>
                                                <td><?php echo $row['particular'];?></td>
                                                <td><?php echo $row['establishment'];?></td>
                                                <td><?php echo $row['invoice'];?></td>
                                                <td><?php echo category_name($row['category']);?></td>
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
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include('footer.php');?>