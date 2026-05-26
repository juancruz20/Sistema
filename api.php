<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

$dataDir = __DIR__ . '/data';
if (!is_dir($dataDir)) mkdir($dataDir, 0777, true);
$file = $dataDir . '/sistema_data.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $input = file_get_contents('php://input');
  if ($input === false) { http_response_code(400); echo json_encode(['error' => 'No input']); exit; }
  file_put_contents($file, $input);
  echo json_encode(['ok' => true]);
} else {
  if (file_exists($file)) {
    echo file_get_contents($file);
  } else {
    echo json_encode(null);
  }
}
