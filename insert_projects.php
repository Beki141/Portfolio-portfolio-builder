<?php
include 'include/Database.php';
include 'include/Portfolio.php';

$db = new Database();
$portfolio = new Portfolio($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $person_id = 1; // Use a fixed person ID for now
    $project_title = $_POST['project_title'];
    $project_description = $_POST['project_description'];
    $project_image = '';

    // Handle file upload
    if (isset($_FILES['project_image']) && $_FILES['project_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $project_image = $uploadDir . basename($_FILES['project_image']['name']);
        if (move_uploaded_file($_FILES['project_image']['tmp_name'], $project_image)) {
            // File uploaded successfully
        } else {
            echo "Failed to move uploaded file.";
            exit;
        }
    }

    // Add project to the database
    if ($portfolio->addProject($person_id, $project_title, $project_description, $project_image)) {
        echo "Project added successfully.";
    } else {
        echo "Error adding project.";
    }
}
?>