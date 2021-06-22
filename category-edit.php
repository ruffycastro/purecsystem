<?php include('header.php');?>
<?php
$id = $_GET['id'];
if(isset($_GET['id'])){
    $sql = mysqli_query($conn,"SELECT category_name,id FROM category WHERE id='$id'") or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($sql);
}
?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 border-left-primary shadow h-100 py-2">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary float-left">Data Information</h6>
                        </div>
                        <div class="card-body">
                            <form action="process.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                              <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Category Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="category_name" placeholder="Category Name" value="<?php echo $row['category_name'];?>" required>    
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="submit" name="updatecategory" value="SAVE" class="btn btn-success">
                                        <a href="customer.php?id=<?php echo $row['id'];?>" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            
    </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include('footer.php');?>