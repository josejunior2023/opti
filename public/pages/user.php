<?php include '../app/views/partials/header.php'; ?>
<div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
    <a href="/logout" class="btn btn-danger">Logout</a>
</div>
