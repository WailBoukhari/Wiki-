<?php
$title = "Register";
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

            <form method="post" action="index.php?action=register_store">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
            </form>

            <p class="mt-3">Already have an account? <a href="index.php?action=login">Login here</a>.</p>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include_once 'app/views/include/layout.php'; ?>