<?php
$title = "Login";
ob_start();
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="display-4 text-center mb-4">
                <?php echo $title; ?>
            </h1>

            <?php if (isset($errorMessage)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>

            <form method="post" action="index.php?action=login_execute">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>

            <p class="mt-3">Don't have an account? <a href="index.php?action=register">Register here</a>.</p>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include_once 'app/views/include/layout.php'; ?>