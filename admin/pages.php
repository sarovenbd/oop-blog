<?php

    require 'inc/header.php';
    require 'inc/navbar.php';
    $query = "SELECT * FROM pages";
    $data = $db->select($query);
 ?>
    <h1 class="mt-4">Pages</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pages</li>
    </ol>
<?php include 'helper/message.php'; ?>

  <div class="card mb-4">
    <div class="card-header row">
        <a href="addpage.php" class="btn btn-primary">Add Page</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 5%">Id</th>
                        <th style="width: 17%">Title</th>
                        <th style="width: 25%">Content</th>
                        <th style="width: 10%">Slug</th>
                        <th style="width: 17%">Created At</th>
                        <th style="width: 5%">Status</th>
                        <th style="width: 15%">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Created_at</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>

                    <?php
                    $i = 1;
                    if($data){
                    while ($page = $data->fetch_assoc()) {

                    ?>

                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $page['title']; ?></td>
                        <td><?php echo substr($page['content'], 0, 120).'....'; ?></td>
                        <td><?php echo $page['slug']; ?></td>
                        <td><?php $date = strtotime($page['created_at']); echo date('F jS, Y',$date); ?></td>
                        <?php $status = $page['status'] ?>
                        <td><?php if($status == 1){echo "Active";}else{echo "Unactive";} ?></td>
                        <td><a class="btn btn-warning" href="editpage.php?id=<?php echo $page['id']; ?>">edit</a>  <a class="btn btn-danger del-button" href="#,deletepage.php?id=<?php echo $page['id']; ?>">Delete</a>
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
                                    swal("Success! page has been deleted!", {
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
