<?php
require "config.php";

// Delete record
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM study_notes WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt->close();
    header("Location: history.php");
    exit;
}

// Fetch all notes
$result = $conn->query("SELECT * FROM study_notes ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Saved Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>📚 Saved Study Notes</h2>
    <a href="index.php" class="btn btn-primary mb-3">🔙 Back</a>

    <?php while($row = $result->fetch_assoc()): ?>
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h4 class="card-title"><?php echo htmlspecialchars($row['topic']); ?></h4>
                <h6>Summary:</h6>
                <p><?php echo nl2br(htmlspecialchars($row['summary'])); ?></p>
                <h6>Questions:</h6>
                <p><?php echo nl2br(htmlspecialchars($row['questions'])); ?></p>
                <h6>Key Points:</h6>
                <p><?php echo nl2br(htmlspecialchars($row['key_points'])); ?></p>

                <!-- Buttons -->
                <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">🗑 Delete</a>
                <a href="export_pdf.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary btn-sm">📄 Download PDF</a>
            </div>
        </div>
    <?php endwhile; ?>
</div>
</body>
</html>
