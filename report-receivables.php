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
                            <h6 class="m-0 font-weight-bold text-primary">Account Receivables</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>DR Date</th>
                                            <th>Establishment</th>
                                            <th>Amount</th>
                                            <th>DR #</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($_GET['d1'])){
                                            $d1 = $_GET['d1'];
                                            $d2 = $_GET['d2'];
                                            $sql = mysqli_query($conn,"SELECT * FROM dr WHERE dr_date>='$d1' AND dr_date<='$d2' AND balance<>0.00") or die(mysqli_error($conn));
                                        }else{
                                            $sql = mysqli_query($conn,"SELECT * FROM collection WHERE MONTH(date_receipt)=MONTH(CURDATE()) AND YEAR(date_receipt)=YEAR(CURDATE())") or die(mysqli_error($conn));
                                        }

                                        while($row = mysqli_fetch_array($sql)){
                                            ?>
                                            <tr>
                                                <td><?php echo date('Y/m/d',strtotime($row['dr_date']));?></td>
                                                <td><?php echo customer_name($row['acct_no']);?></td>
                                                <td><?php echo number_format($row['total_amt'],2);?></td>
                                                <td><?php echo $row['dr_no'];?></td>
                                                <td><?php echo number_format($row['balance'],2);?></td>
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