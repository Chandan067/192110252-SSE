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

// Function to generate random numbers within a range
function generateRandomNumbers($start, $end, $count = 10) {
    $randomNumbers = [];
    for ($i = 0; $i < $count; $i++) {
        $randomNumbers[] = rand($start, $end);
    }
    return $randomNumbers;
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data === null) {
        echo json_encode(['error' => 'Invalid JSON input']);
        exit();
    }

    $start = isset($data['start']) ? intval($data['start']) : 0;
    $end = isset($data['end']) ? intval($data['end']) : 0;

    if ($start >= $end) {
        echo json_encode(['error' => 'Invalid range']);
        exit();
    }

    $randomNumbers = generateRandomNumbers($start, $end);

    echo json_encode(['result' => $randomNumbers]);
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
