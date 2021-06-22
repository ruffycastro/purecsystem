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
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Invoice Report</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Company</th>
                                            <th>Address</th>
                                            <th>TIN</th>
                                            <th>Agent</th>
                                            <th>Invoice</th>
                                            <th>250ml</th>
                                            <th>500ml</th>
                                            <th>Pure D</th>
                                            <th>Gross</th>
                                            <th>Net</th>
                                            <th>Output</th>
                                            <th>CR No.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($_GET['d1'])){
                                            $d1 = $_GET['d1'];
                                            $d2 = $_GET['d2'];
                                            $sql2 = mysqli_query($conn,"SELECT * FROM dr WHERE invoice_date >= '$d1' AND invoice_date <='$d2' ") or die(mysqli_error($conn));
                                        }else{
                                            $sql2 = mysqli_query($conn,"SELECT * FROM dr WHERE invoice_no<>0 ") or die(mysqli_error($conn));
                                        }
                                        while($row = mysqli_fetch_array($sql2)){
                                            ?>
                                            <tr>
                                                <td><?php echo $row['invoice_date'];?></td>
                                                <td><?php echo customer_name($row['acct_no']);?></td>
                                                <td><?php echo $row['delivery_address'];?></td>
                                                <td><?php echo customer_tin($row['acct_no']);?></td>
                                                <td><?php echo $row['acct_no'];?></td>
                                                <td><?php echo $row['invoice_no'];?></td>
                                                <td><?php echo $row['purec250ml'];?></td>
                                                <td><?php echo $row['purec500ml'];?></td>
                                                <td><?php echo $row['pured'];?></td>
                                                <td><?php echo $row['total_amt'];?></td>
                                                <?php
                                                $net = $row['total_amt'] / 1.12;
                                                $output = $net * .12;
                                                ?>
                                                <td><?php echo number_format($net,2);?></td>
                                                <td><?php echo number_format($output,2);?></td>
                                                <td></td>
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