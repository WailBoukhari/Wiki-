<?php
$title = "Tag List";
ob_start();
?>
<div id="wrapper">
    <!-- Sidebar -->
    <?php include "app/views/include/admin_sidebar.php" ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <?php include "app/views/include/navabr_sub.php" ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                </p>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>

                                        <th scope="col">Name</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tags as $tag) : ?>
                                        <tr>

                                            <td>
                                                <?php echo $tag->getName(); ?>
                                            </td>
                                            <td>
                                                <?php echo $tag->getCreatedAt(); ?>
                                            </td>
                                            <td>
                                                <a href="index.php?action=tag_edit&id=<?php echo $tag->getId(); ?>" class="btn btn-warning">Edit</a>
                                                <a href="index.php?action=tag_delete&id=<?php echo $tag->getId(); ?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
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
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2020</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<?php
$content = ob_get_clean();
include_once 'app/views/include/layout_sub.php';
?>