<?php

    require 'inc/header.php';
    require 'inc/navbar.php';
    $query = "SELECT * FROM categories";
    $data = $db->select($query);
 ?>
    <h1 class="mt-4">Categories</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Categories</li>
    </ol>
<?php include 'helper/message.php'; ?>

  <div class="card mb-4">
    <div class="card-header row">
        <a href="addcategory.php" class="btn btn-primary">Add Category</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 5%">Id</th>
                        <th style="width: 40%">Title</th>
                        <th style="width: 18%">Created At</th>
                        <th style="width: 7%">Status</th>
                        <th style="width: 20%">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Created_at</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>

                    <?php
                    $i = 1;
                    if($data){
                    while ($category = $data->fetch_assoc()) {

                    ?>

                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $category['title']; ?></td>
                        <td><?php $date = strtotime($category['created_at']); echo date('F jS, Y',$date); ?></td>
                        <?php $status = $category['status'] ?>
                        <td><?php if($status == 1){echo "Active";}else{echo "Unactive";} ?></td>
                        <td><a class="btn btn-warning" href="editcategory.php?id=<?php echo $category['id']; ?>">edit</a>  <a class="btn btn-danger del-button" href="#,deletecategory.php?id=<?php echo $category['id']; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php $i++; } } ?>
                    <script>
                        $(".del-button").click(function() {
                            var link = $(this).attr('href').split(',');
                            swal({
                                title: "Are you sure?",
                                text: "Once deleted, you will not be able to recover this!",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                                })
                                .then((willDelete) => {
                                if (willDelete) {
                                    swal("Success! category has been deleted!", {
                                    icon: "success",
                                    }).then(function(){

                                        window.location.href = "<?php echo $base_url; ?>/admin/".concat(link[1]);



                                    });
                                } else {
                                    swal("Operation cancled!");
                                }
                                });
                        });
                    </script>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require 'inc/footer.php'; ?>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="inc/js/datatables-demo.js"></script>
