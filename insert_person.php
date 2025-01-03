<?php
include 'include/Database.php';
include 'include/Portfolio.php';

$db = new Database();
$portfolio = new Portfolio($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $picture = '';

    // Handle file upload
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $picture = $uploadDir . basename($_FILES['picture']['name']);
        if (move_uploaded_file($_FILES['picture']['tmp_name'], $picture)) {
            echo "File uploaded successfully.";
        } else {
            echo "Failed to move uploaded file.";
        }
    }

    // Insert person
    if ($portfolio->addPerson($name, $description, $picture)) {
        $person_id = $db->conn->insert_id;

        // Insert skills
        foreach ($_POST['skill_name'] as $index => $skill_name) {
            $skill_level = $_POST['skill_level'][$index];
            $portfolio->addSkill($person_id, $skill_name, $skill_level);
        }

        // Insert projects
        foreach ($_POST['project_title'] as $index => $project_title) {
            $project_description = $_POST['project_description'][$index];
            $project_image = '';
            if (isset($_FILES['project_image']['name'][$index]) && $_FILES['project_image']['error'][$index] === UPLOAD_ERR_OK) {
                $project_image = $uploadDir . basename($_FILES['project_image']['name'][$index]);
                move_uploaded_file($_FILES['project_image']['tmp_name'][$index], $project_image);
            }
            $portfolio->addProject($person_id, $project_title, $project_description, $project_image);
        }

        // Insert contact
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];
        $portfolio->addContact($person_id, $email, $phone, $message);

        // Insert testimonials
        foreach ($_POST['client_name'] as $index => $client_name) {
            $feedback = $_POST['feedback'][$index];
            $portfolio->addTestimonial($person_id, $client_name, $feedback);
        }

        echo "All info added successfully.";
    } else {
        echo "Error adding personal info.";
    }
}
