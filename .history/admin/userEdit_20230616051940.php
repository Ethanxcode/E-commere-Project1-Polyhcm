<?php include 'inc/part1.php'; ?>
<?php include 'inc/part2.php'; ?>

<?php
// $pd = new product();
$cs = new customer();

if (!isset($_GET['customerid']) || $_GET['customerid'] == null) {
    echo "<script>window.location ='users.php'</script>";
} else {
    $id = $_GET['customerid'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // $updateProduct = $pd->update_product($_POST, $_FILES, $id);
    $updateCustomer = $cs->update_profile($_POST, $_FILES, $id);
}

?>
<div class="container-fluid">
    <?php
    if (isset($updateCustomer)) {
        echo $updateCustomer;
    }
    ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sửa thông tin</h6>
        </div>

    </div>

    <div class="card-body">
        <div class="alert alert-light" role="alert">
            <a href="./productlist.php" class="alert-link">Quay lại danh sách</a>
        </div>
        ';
        <div class="table-responsive">
            <?php
            $getUserById = $cs->shows_customer($id);
            if ($getUserById) {
                foreach ($getUserById as $result) {
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <tr>
                                <td>
                                    <label>Họ và tên</label>
                                </td>
                                <td>
                                    <input type="text" name="fullName" value="<?php echo $result['fullName']; ?>"
                                        class="medium form-control" />
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <label>username</label>
                                </td>
                                <td>
                                    <input type="text" name="username" class="medium form-control"
                                        value="<?php echo $result['email']; ?>" ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>email</label>
                                </td>
                                <td>
                                    <input name="email" type="email" value="<?php echo $result['email']; ?>"
                                        class="medium form-control" />
                                </td>
                            </tr>
                            <!-- <tr>
                                        <td>
                                            <label>Upload Image</label>
                                        </td>
                                        <td>
                                            <img src="./uploads/<?php echo $result['image']; ?>" width="80" alt="">
                                            <input name="image" type="file" />
                                        </td>
                                    </tr> -->

                            <tr>
                                <td></td>
                                <td>
                                    <button class="btn btn-primary" type="submit" name="submit">Save</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>
</div>



<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>

<!-- Load TinyMCE -->
<?php include 'inc/part4.php'; ?>