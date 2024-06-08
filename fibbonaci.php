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

// Function to generate Fibonacci sequence within a range
function generateFibonacci($start, $end) {
    $fibonacci = [];
    $a = 0;
    $b = 1;

    while ($a <= $end) {
        if ($a >= $start) {
            $fibonacci[] = $a;
        }
        $next = $a + $b;
        $a = $b;
        $b = $next;
    }

    return $fibonacci;
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $start = isset($data['start']) ? intval($data['start']) : 0;
    $end = isset($data['end']) ? intval($data['end']) : 0;

    $fibonacci = generateFibonacci($start, $end);

    echo json_encode(['result' => $fibonacci]);
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
