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

// Function to check if a number is prime
function isPrime($num) {
    if ($num <= 1) return false;
    if ($num <= 3) return true;
    if ($num % 2 == 0 || $num % 3 == 0) return false;
    for ($i = 5; $i * $i <= $num; $i += 6) {
        if ($num % $i == 0 || $num % ($i + 2) == 0) return false;
    }
    return true;
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $start = isset($data['start']) ? intval($data['start']) : 0;
    $end = isset($data['end']) ? intval($data['end']) : 0;

    $primes = [];
    for ($i = $start; $i <= $end; $i++) {
        if (isPrime($i)) {
            $primes[] = $i;
        }
    }

    echo json_encode(['result' => $primes]);
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
