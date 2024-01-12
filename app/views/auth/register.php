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

            <?php if (isset($errorMessage)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>

            <form method="post" action="index.php?action=register_store" id="registrationForm" novalidate>
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                    <div id="usernameError" class="text-danger"></div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <div id="emailError" class="text-danger"></div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <div id="passwordError" class="text-danger"></div>
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
            </form>

            <p class="mt-3">Already have an account? <a href="index.php?action=login">Login here</a>.</p>
        </div>
    </div>
</div>

<!-- Add jQuery and Custom Validation Script -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#registrationForm').submit(function(event) {
            // Clear previous error messages
            $('#usernameError, #emailError, #passwordError').text('');

            // Validate username
            var username = $('#username').val();
            if (!/^[a-zA-Z0-9]+$/.test(username)) {
                $('#usernameError').text('Only letters and numbers are allowed');
                event.preventDefault();
            }

            // Validate email
            var email = $('#email').val();
            if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
                $('#emailError').text('Enter a valid email address');
                event.preventDefault();
            }

            // Validate password
            var password = $('#password').val();
            if (!/^.{8,}$/.test(password)) {
                $('#passwordError').text('Password must be at least 8 characters long');
                event.preventDefault();
            }
        });
    });
</script>

<?php $content = ob_get_clean(); ?>
<?php include_once 'app/views/include/layout.php'; ?>