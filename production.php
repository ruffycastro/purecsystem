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
                                            <th>Date</th>
                                            <th>250ml</th>
                                            <th>500ml</th>
                                            <th>Pure D</th>
                                            <th>Added by</th>
                                            <th>Date Added</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql2 = mysqli_query($conn,"SELECT * FROM production ") or die(mysqli_error($conn));
                                        while($row = mysqli_fetch_array($sql2)){
                                            ?>
                                            <tr>
                                                <td><?php echo $row['date_production'];?></td>
                                                <td><?php echo $row['purec250ml'];?></td>
                                                <td><?php echo $row['purec500ml'];?></td>
                                                <td><?php echo $row['pured'];?></td>
                                                <td><?php echo user_name($row['added_by']);?></td>
                                                <td><?php echo $row['date_added'];?></td>
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
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include('footer.php');?>