<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
    <!-- Container wrapper -->
    <div class="container">
        <!-- Toggle button -->
        <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0" href="index.php?action=home">
                WikiInfo
            </a>
            <?php
            if (isset($_SESSION['user'])) {
                $role = $_SESSION['user']->getRole();
                ?>

                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=allwikis">Wikis</a>
                    </li>
                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <div class="d-flex align-items-center ">

                <!-- Avatar -->
                <div class="dropdown">
                    <a data-mdb-dropdown-init class="dropdown-toggle d-flex align-items-center hidden-arrow text-black"
                        href="#" id="navbarDropdownMenuAvatar" role="button" aria-expanded="false">
                        <?php echo $role; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                        <li>
                            <!-- Add bg-dark class here -->
                            <?php
                            switch ($role) {
                                case 'Admin':
                                    echo "<li class='nav-item'><a class='dropdown-item' href='index.php?action=admin'>Admin Dashboard</a></li>";
                                    break;
                                case 'Author':
                                    echo "<li class='nav-item'><a class='dropdown-item' href='index.php?action=author'>Author Dashboard</a></li>";
                                    break;
                            }
                            ?>
                        </li>
                        <li>
                            <a class="dropdown-item" href='index.php?action=logout'>Logout</a>
                        </li>

                    <?php } else { ?>
                        <div><a class="dropdown-item " href='index.php?action=login'>Login</a></div>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->