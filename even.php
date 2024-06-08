<?php
header('Content-Type: application/json');

// Database connection details
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "doctor"; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
    exit();
}

// Function to generate even numbers within a range
function generateEvenNumbers($start, $end) {
    $evens = [];
    for ($i = $start; $i <= $end; $i++) {
        if ($i % 2 == 0) {
            $evens[] = $i;
        }
    }
    return $evens;
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $start = isset($data['start']) ? intval($data['start']) : 0;
    $end = isset($data['end']) ? intval($data['end']) : 0;

    $evens = generateEvenNumbers($start, $end);

    echo json_encode(['result' => $evens]);
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
