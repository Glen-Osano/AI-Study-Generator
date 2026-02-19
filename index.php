<?php
require "config.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>AI Study Notes Generator</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h2 class="mb-4">📘 AI Study Notes Generator</h2>

        <!-- Live Mode Toggle -->
        <form method="POST" action="">
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="liveMode" name="liveMode" <?php echo !$DEMO_MODE ? 'checked' : ''; ?> onchange="this.form.submit()">
                <label class="form-check-label" for="liveMode">Live Mode (Use Real AI API)</label>
            </div>
        </form>

        <!-- Topic Form -->
        <form action="generate.php" method="POST">
            <div class="mb-3">
                <label for="topic" class="form-label">Enter Topic:</label>
                <input type="text" class="form-control" id="topic" name="topic" required>
            </div>
            <button type="submit" class="btn btn-primary">Generate Notes</button>
        </form>

        <hr>
        <a href="history.php" class="btn btn-success mt-2">📚 View Saved Notes</a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Handle Live Mode toggle dynamically
if (isset($_POST['liveMode'])) {
    $DEMO_MODE = $_POST['liveMode'] ? false : true;
}
?>
