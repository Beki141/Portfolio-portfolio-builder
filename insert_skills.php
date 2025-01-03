<?php
include 'include/Database.php';
include 'include/Portfolio.php';

$db = new Database();
$portfolio = new Portfolio($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $person_id = 1; // Fixed user ID
    $skill_name = $_POST['skill_name'];
    $skill_level = $_POST['skill_level'];

    // Add skill to the database
    $stmt = $db->prepare("INSERT INTO skills (person_id, skill_name, skill_level) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $person_id, $skill_name, $skill_level);

    if ($stmt->execute()) {
        echo "Skill added successfully.";
    } else {
        echo "Error adding skill: " . $stmt->error;
    }

    $stmt->close();
}
?>