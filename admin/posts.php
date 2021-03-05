<?php

    require 'inc/header.php';
    require 'inc/navbar.php';
    $query = "SELECT posts.id, posts.title, posts.content, posts.image, posts.created_at,posts.status, posts.tags, posts.slug, users.name, categories.title AS cat_title
    FROM posts
    INNER JOIN users ON posts.user_id=users.id
    JOIN categories ON posts.cat_id=categories.id

    ";
    $data = $db->select($query);


 ?>
    <h1 class="mt-4">Posts</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Posts</li>
    </ol>
<?php include 'helper/message.php'; ?>

  <div class="card mb-4">
    <div class="card-header row">
        <a href="addpost.php" class="btn btn-primary">Add Post</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th >Id</th>
                        <th >Title</th>
                        <th>Posted By</th>
                        <th>Category</th>
                        <th >Tags</th>
                        <th >Slud</th>
                        <th >Thumbnail</th>
                        <th >Posted On</th>
                        <th >Status</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Posted By</th>
                        <th>Category</th>
                        <th>Tags</th>
                        <th>Slud</th>
                        <th>Thumbnail</th>
                        <th>Posted On</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>

                    <?php
                    $i = 1;
                    if($data){
                    while ($post = $data->fetch_assoc()) {

                    ?>

                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $post['title']; ?></td>
                        <td><?php echo $post['name']; ?></td>
                        <td><?php echo $post['cat_title']; ?></td>
                        <td><?php echo $post['tags']; ?></td>
                        <td><?php echo $post['slug']; ?></td>
                        <td><img style="height: auto; width: 100px;" src="inc/uploads/images/<?php echo $post['image']; ?>" alt=""></td>
                        <td><?php $date = strtotime($post['created_at']); echo date('F jS, Y',$date); ?></td>
                        <?php $status = $post['status'] ?>
                        <td><?php if($status == 1){echo "Active";}else{echo "Unactive";} ?></td>
                        <td><a class="btn btn-warning" href="editpost.php?id=<?php echo $post['id']; ?>">edit</a>  <a class="btn btn-danger del-button" href="#,deletepost.php?id=<?php echo $post['id']; ?>">Delete</a>
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
                                    swal("Success! post has been deleted!", {
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
