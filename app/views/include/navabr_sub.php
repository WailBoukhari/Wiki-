<!-- Navbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
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
                <i class="fa-brands fa-wikipedia-w"></i>
            </a>
        </div>
        <!-- Collapsible wrapper -->

        <!-- Right elements -->
        <div class="d-flex align-items-center ms-auto">
            <!-- Avatar -->
            <div class="dropdown">
                <?php
                if (isset($_SESSION['user'])) {
                    $role = $_SESSION['user']->getRole();
                ?>
                <a data-mdb-dropdown-init class="dropdown-toggle d-flex align-items-center hidden-arrow text-black"
                    href="#" id="navbarDropdownMenuAvatar" role="button" aria-expanded="false">
                    <i class="fa-solid fa-user mr-2"></i>
                    <?php echo $role; ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuAvatar">
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
                </ul>
            </div>
            <?php } else { ?>
            <!-- Login link on the right -->
            <div><a class="dropdown-item" href='index.php?action=login'>Login</a></div>
            <?php } ?>
        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>