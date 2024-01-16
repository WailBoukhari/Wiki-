<?php
$title = "Wiki List";
ob_start();
?>
<div id="wrapper">
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
                                        <th scope="col">Thumbnail</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Content</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Tags</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Is Archived</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($wikis as $wiki) : ?>
                                        <tr>
                                            <td>
                                                <img style="width: 10rem;" src="<?= $wiki->getImg(); ?>" alt="">
                                            </td>
                                            <td>
                                                <?= $wiki->getTitle(); ?>
                                            </td>
                                            <td>
                                                <?php
                                                $content = $wiki->getContent();
                                                echo substr($content, 0, 50);
                                                if (strlen($content) > 100) {
                                                    echo '...';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?= $wiki->getCategoryName(); ?>
                                            </td>
                                            <td>
                                                <?php
                                                $tags = $wiki->getTags();
                                                foreach ($tags as $tag) {
                                                    echo $tag->getName() . ', ';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?= $wiki->getUserId(); ?>
                                            </td>
                                            <td>
                                                <?= $wiki->getCreatedAt(); ?>
                                            </td>
                                            <td>
                                                <?= $wiki->isArchived(); ?>
                                            </td>
                                            <td>
                                                <?php if ($wiki->isArchived()) : ?>
                                                    <a href="index.php?action=wiki_enable&id=<?= $wiki->getId(); ?>" class="btn btn-success btn-sm">Enable</a>
                                                <?php else : ?>
                                                    <a href="index.php?action=wiki_disable&id=<?= $wiki->getId(); ?>" class="btn btn-danger btn-sm">Disable</a>
                                                <?php endif; ?>
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