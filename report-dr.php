<?php include('header.php');?>
                <!-- End of Topbar -->

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
                            <h6 class="m-0 font-weight-bold text-primary float-left">Delivery Receipt</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>DR Date</th>
                                            <th>DR No</th>
                                            <th>Customer</th>
                                            <th>Address</th>
                                            <th>Pure C 250ml</th>
                                            <th>Pure C 500ml</th>
                                            <th>PureD</th>
                                            <th>Status</th>
                                            <th>Total Amt</th>
                                            <th>Collection</th>
                                            <th>Account Receivable</th>
                                            <th>Released By</th>
                                            <th>Deliver By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($_GET['d1'])){
                                            $d1 = $_GET['d1'];
                                            $d2 = $_GET['d2'];
                                            $sql2 = mysqli_query($conn,"SELECT * FROM dr WHERE dr_date >= '$d1' AND dr_date <= '$d2' ") or die(mysqli_error($conn));
                                        }else{
                                            $sql2 = mysqli_query($conn,"SELECT * FROM dr WHERE MONTH(dr_date) = MONTH(CURDATE()) AND YEAR(dr_date) = YEAR(CURDATE()) ") or die(mysqli_error($conn));
                                        }
                                        while($row = mysqli_fetch_array($sql2)){
                                            ?>
                                            <tr>
                                                <td><?php echo date('Y/m/d',strtotime($row['dr_date']));?></td>
                                                <td><?php echo $row['dr_no'];?></td>
                                                <td><?php echo customer_name($row['acct_no']);?></td>
                                                <td><?php echo $row['delivery_address'];?></td>
                                                <td><?php echo $row['purec250ml'];?></td>
                                                <td><?php echo $row['purec500ml'];?></td>
                                                <td><?php echo $row['pured'];?></td>
                                                <td><?php echo delivery_status($row['delivered']);?></td>
                                                <td><?php echo $row['total_amt'];?></td>
                                                <td>
                                                    <?php
                                                        if($row['balance']==0.00){
                                                            echo $row['total_amt'];
                                                        }else{
                                                            echo "0.00";
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if($row['balance']!=0.00){
                                                            echo $row['balance'];
                                                        }else{
                                                            echo "0.00";
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo $row['released_by'];?></td>
                                                <td><?php echo $row['delivery_man'];?></td>
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