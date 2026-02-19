<?php
require "config.php";

if (!isset($_POST['topic'])) die("No topic provided.");
$topic = trim($_POST['topic']);
if (empty($topic)) die("Topic cannot be empty.");

// Check Live Mode from POST (optional)
if (isset($_POST['liveMode'])) {
    $DEMO_MODE = $_POST['liveMode'] ? false : true;
}

// Demo Mode or Live API
if ($DEMO_MODE) {
    $summary = "This is a generated summary about $topic. Explains core concepts simply.";
    $questions = "1. What is $topic?\n2. Explain importance of $topic.\n3. List two examples.\n4. How does $topic work?\n5. Why is $topic important?";
    $key_points = "- $topic is important.\n- $topic has practical applications.\n- Understanding $topic improves foundational knowledge.";
} else {
    $prompt = "Generate structured study notes for the topic: $topic.
Return:
1. Summary
2. 5 exam-style questions
3. 3 key points.";
    $data = ["model"=>"gpt-4o-mini","messages"=>[["role"=>"user","content"=>$prompt]]];
    $ch = curl_init("https://api.openai.com/v1/chat/completions");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer ".$OPENAI_API_KEY
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($response, true);
    $content = $result['choices'][0]['message']['content'];
    $summary = $content;
    $questions = "";
    $key_points = "";
}

// Save to DB
$stmt = $conn->prepare("INSERT INTO study_notes (topic, summary, questions, key_points) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $topic, $summary, $questions, $key_points);
$stmt->execute();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Generated Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card p-4 shadow">
        <h2>📘 Generated Notes for: <?php echo htmlspecialchars($topic); ?></h2>

        <h4>Summary</h4>
        <p><?php echo nl2br(htmlspecialchars($summary)); ?></p>

        <h4>Questions</h4>
        <p><?php echo nl2br(htmlspecialchars($questions)); ?></p>

        <h4>Key Points</h4>
        <p><?php echo nl2br(htmlspecialchars($key_points)); ?></p>

        <a href="index.php" class="btn btn-primary mt-3">🔙 Back</a>
        <a href="history.php" class="btn btn-success mt-3">📚 View Saved Notes</a>
    </div>
</div>
</body>
</html>
