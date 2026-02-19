<?php
require "config.php";
require 'vendor/autoload.php';  // <-- updated line

use Dompdf\Dompdf;


if(!isset($_GET['id'])) die("No note selected.");
$id = (int)$_GET['id'];

$result = $conn->query("SELECT * FROM study_notes WHERE id=$id");
$note = $result->fetch_assoc();

if(!$note) die("Note not found.");

$dompdf = new Dompdf();
$html = "
<h2>{$note['topic']}</h2>
<h4>Summary</h4><p>{$note['summary']}</p>
<h4>Questions</h4><p>{$note['questions']}</p>
<h4>Key Points</h4><p>{$note['key_points']}</p>
";

$dompdf->loadHtml($html);
$dompdf->setPaper('A4','portrait');
$dompdf->render();
$dompdf->stream("{$note['topic']}.pdf");
