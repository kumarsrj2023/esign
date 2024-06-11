<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $signature = $_POST['signature'];

    // Remove "data:image/png;base64," from the beginning of the string
    $signature = str_replace('data:image/png;base64,', '', $signature);
    $signature = str_replace(' ', '+', $signature);
    $data = base64_decode($signature);

    // Save the file
    $filePath = 'signatures/' . uniqid() . '.png';
    if (file_put_contents($filePath, $data)) {
        echo json_encode(['status' => 'success', 'message' => 'Signature saved successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to save signature.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>
