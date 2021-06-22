<?php include('header.php');?>
<?php
$customerid = $_GET['id'];
$sql = mysqli_query($conn,"SELECT * FROM customer WHERE id='$customerid' ") or die(mysqli_error($conn));
$row = mysqli_fetch_array($sql);
if(isset($_POST['date_receipt'])){

    $drno = $_POST['drid'];
    $datereceipt = $_POST['date_receipt'];
    $userid = $_SESSION['userid'];
    $referenceno = $_POST['reference_no'];
    $datetransfer = $_POST['date_transfer'];
    $checkno = $_POST['check_no'];
    $checkdate = $_POST['check_date'];
    $bank = $_POST['bank'];
    $mode = $_POST['modepayment'];
    $amount = $_POST['amount'];
    $typereceipt = $_POST['typereceipt'];
    $acctno = $_POST['acct_no'];
    $receipt_no = $_POST['receipt_no'];
    $collector = $_POST['collector'];
    $deduction = $_POST['deduction'];
    $remarks = $_POST['remarks'];
    $date_deposited = $_POST['date_deposited'];
    $bank_deposited = $_POST['bank_deposited'];
    $deposited = $_POST['deposited'];

    //Get DR info

    $sql1 = mysqli_query($conn,"SELECT balance FROM dr WHERE id='$drno'");
    $row1 = mysqli_fetch_assoc($sql1);

    $balance = $row1['balance'] - $amount;

    $sql2 = mysqli_query($conn,"UPDATE dr SET balance='$balance',deduction='$deduction',remarks='$remarks',date_deposited='$date_deposited',status_deposited='$deposited',bank_deposited='$bank_deposited' WHERE id='$drno'"); 

    $sql = mysqli_query($conn,"INSERT INTO collection (status_deposited,date_deposited,bank_deposited,receipt_no,acct_no,dr_no,date_receipt,added_by,reference_no,date_transfer,check_no,check_date,bank,modepayment,amount,typereceipt,collector,remarks,deduction) VALUE('$deposited','$date_deposited','$bank_deposited','$receipt_no','$acctno','$drno','$datereceipt','$userid','$referenceno','$datetransfer','$checkno','$checkdate','$bank','$mode','$amount','$typereceipt','$collector','$remarks','$deduction')") or die(mysqli_error($conn));
}
?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?php echo $row['customer_name'];?></h1>
                    </div>

                    <div class="row">

                        <div class="col-lg-6">

                            <!-- Default Card Example -->
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Customer Information</h6>
                                    <a href="customer-edit.php?id=<?php echo $row['id'];?>"><i class="fas fa-pencil-alt"></i></a>
                                </div>
                                <div class="card-body">
                                	<strong>Address : </strong><?php echo $row['address'];?></br>
                                    <strong>Contact No. : </strong><?php echo $row['contact_no'];?> | <strong>Contact Person : </strong><?php echo $row['contact_person'];?></br>
                                    <strong>Email : </strong><?php echo $row['mail'];?> | <strong>TIN : </strong><?php echo $row['tin'];?>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6">
                        <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Pricing</h6>
                                    <a href="#" data-toggle="modal" data-target="#pricing"><i class="fas fa-pencil-alt"></i></a>
                                </div>
                                <div class="card-body">
                                    <strong>Pure C 500ml : </strong><?php echo $row['purec500pricing'];?></br>
                                    <strong>Pure C 250ml : </strong><?php echo $row['purec250pricing'];?></br>
                                    <strong>Pure D 1L : </strong><?php echo $row['puredpricing'];?>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Options</div>
                                            <a class="dropdown-item" href="dr-add.php?customer=<?php echo $row['id'];?>">Add DR</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <table class="table table-condensed table-bordered" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>DR No</th>
                                                <th>Released By</th>
                                                <th>Dispatcher</th>
                                                <th>Amount</th>
                                                <th>Balance</th>
                                                <th>Invoice</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $acct_no = $_GET['id'];
                                        $sqldr = mysqli_query($conn,"SELECT * FROM dr WHERE acct_no='$acct_no'");
                                        while($rowdr=mysqli_fetch_array($sqldr)){
                                        ?>
                                            <tr>
                                                <td><?php echo delivery_status($rowdr['delivered']);?></td>
                                                <td><?php echo $rowdr['dr_date'];?></td>
                                                <td><?php echo $rowdr['dr_no'];?></td>
                                                <td><?php echo $rowdr['released_by'];?></td>
                                                <td><?php echo $rowdr['dispatcher'];?></td>
                                                <td><?php echo number_format($rowdr['total_amt'],2);?></td>
                                                <td><?php echo number_format($rowdr['balance'],2);?></td>
                                                <td><?php echo $rowdr['invoice_no'];?></td>
                                                <td>
                                                    <a href="#" title="Invoice" data-toggle="modal" data-target="#invoice" data-id="<?php echo $rowdr['id'];?>" id="open-payment"><i class="far fa-calendar-plus"></i></a>
                                                    <?php
                                                    if($rowdr['balance']==0.00){
                                                        ?>
                                                        <i class="far fa-money-bill-alt"></i>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <a href="#" title="Payment" data-toggle="modal" data-target="#payment" data-id="<?php echo $rowdr['id'];?>" id="open-payment"><i class="far fa-money-bill-alt"></i></a>
                                                        <?php
                                                    }
                                                    ?>
                                                    <i class="fas fa-edit"></i>
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

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- Invoice Modal-->
    <div class="modal fade" id="invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Invoice</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="process.php" method="POST">
                    <input type="hidden" class="form-control" name="drid" id="drId">
                    <input type="hidden" class="form-control" name="acct_no" value="<?php echo $_GET['id'];?>">
                        <div class="form-group">
                            <label>Date of Invoice</label>
                            <input type="date" class="form-control" name="date_invoice">
                        </div>
                        <div class="form-group">
                            <label>Invoice No.</label>
                            <input type="text" class="form-control" name="invoice_no">
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">SAVE</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Pricing Modal-->
    <div class="modal fade" id="pricing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Pricing</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="process.php" method="POST">
                    <input type="hidden" class="form-control" name="acct_no" value="<?php echo $_GET['id'];?>">
                        <div class="form-group">
                            <label>Pure C 250ml</label>
                            <input type="text" class="form-control" name="purec250pricing">
                        </div>
                        <div class="form-group">
                            <label>Pure C 500ml</label>
                            <input type="text" class="form-control" name="purec500pricing">
                        </div>
                        <div class="form-group">
                            <label>Pure D</label>
                            <input type="text" class="form-control" name="puredpricing">
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" name="addpricing">SAVE</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Payment Modal-->
    <div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                    <input type="hidden" class="form-control" name="drid" id="drId">
                    <input type="hidden" class="form-control" name="acct_no" value="<?php echo $_GET['id'];?>">
                        <div class="form-group">
                            <label>Date of Receipt</label>
                            <input type="date" class="form-control" name="date_receipt">
                        </div>
                        <div class="form-group">
                            <label>Type of Receipt</label>
                            <select id="typereceipt" class="form-control" name="typereceipt">
                                <option value="PR">PR</option>
                                <option value="AR">AR</option>
                                <option value="CR">CR</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Receipt No.</label>
                            <input type="text" class="form-control" name="receipt_no">
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" name="amount">
                        </div>
                        <div class="form-group">
                            <label>Collector</label>
                            <input type="text" class="form-control" name="collector">
                        </div>
                        <div class="form-group">
                            <label>Mode of Payment</label>
                            <select class="form-control" name="modepayment" id="modepayment">
                                <option value="cash">CASH</option>
                                <option value="check">CHECK</option>
                                <option value="online">ONLINE</option>
                            </select>
                        </div>
                        <div id="check" style="display:none;">
                            <div class="form-group">
                                <label>Bank</label>
                                <input type="text" class="form-control" name="bank">
                            </div>
                            <div class="form-group">
                                <label>Check Date</label>
                                <input type="date" class="form-control" name="check_date">
                            </div>
                            <div class="form-group">
                                <label>Check No.</label>
                                <input type="text" class="form-control" name="check_no">
                            </div>
                        </div>
                        <div id="online" style="display:none;">
                            <div class="form-group">
                                <label>Date Transfer</label>
                                <input type="date" class="form-control" name="date_transfer">
                            </div>
                            <div class="form-group">
                                <label>Reference No.</label>
                                <input type="text" class="form-control" name="reference_no">
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label>Deduction</label>
                            <input type="number" class="form-control" name="deduction">
                        </div>
                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea class="form-control" name="remarks"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Deposited</label>
                            <select class="form-control" name="deposited">
                                <option value="1">Not yet Deposit</option>
                                <option value="2">Deposited</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Bank</label>
                            <select class="form-control" name="bank_deposited">
                                <option value="1">Union Bank</option>
                                <option value="2">China Bank</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Date Deposited</label>
                            <input type="date" class="form-control" name="date_deposited">
                        </div>
                        

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-success" value="SAVE">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Customer Modal-->
    <div class="modal fade" id="editcustomer" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Customer Info</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                    <input type="hidden" class="form-control" name="drid" id="drId">
                        <div class="form-group">
                            <label>Date of Receipt</label>
                            <input type="date" class="form-control" name="date_receipt">
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-success" value="SAVE">
                    </form>
                </div>
            </div>
        </div>
    </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include('footer.php');?>