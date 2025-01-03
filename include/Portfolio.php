<?php
class Portfolio
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addTestimonial($person_id, $client_name, $feedback)
    {
        $stmt = $this->db->conn->prepare("INSERT INTO testimonial (person_id, client_name, feedback) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $person_id, $client_name, $feedback);
        return $stmt->execute();
    }

    public function addContact($person_id, $email, $phone, $message)
    {
        $stmt = $this->db->conn->prepare("INSERT INTO contact (person_id, email, phone, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $person_id, $email, $phone, $message);
        return $stmt->execute();
    }

    public function getPerson($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM person WHERE id = ? LIMIT 1");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getSkills($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM skills WHERE person_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getProjects($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM projects WHERE person_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function addPerson($name, $description, $picture)
    {
        $stmt = $this->db->prepare("INSERT INTO person (name, picture, description) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $picture, $description);
        return $stmt->execute();
    }

    public function addSkill($personId, $skillName, $skillLevel)
    {
        $stmt = $this->db->prepare("INSERT INTO skills (person_id, skill_name, skill_level) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $personId, $skillName, $skillLevel);
        return $stmt->execute();
    }

    public function addProject($personId, $projectTitle, $projectDescription, $projectImage)
    {
        $stmt = $this->db->prepare("INSERT INTO projects (person_id, project_title, project_description, project_image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $personId, $projectTitle, $projectDescription, $projectImage);
        return $stmt->execute();
    }

    public function updatePerson($userId, $name, $description, $picture)
    {
        $stmt = $this->db->prepare("UPDATE person SET name = ?, description = ?, picture = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $description, $picture, $userId);
        return $stmt->execute();
    }

    public function deletePerson($userId)
    {
        $stmt = $this->db->prepare("DELETE FROM person WHERE id = ?");
        $stmt->bind_param("i", $userId);
        return $stmt->execute();
    }

    public function getAllUsers()
    {
        return $this->db->query("SELECT * FROM person");
    }
    public function getContacts($person_id)
    {

        $query = "SELECT * FROM contact WHERE person_id = ?";

        $stmt = $this->db->prepare($query);

        $stmt->bind_param("i", $person_id);

        $stmt->execute();

        return $stmt->get_result();

    }
    public function getTestimonials($person_id)
    {

        $query = "SELECT * FROM testimonial WHERE person_id = ?";

        $stmt = $this->db->prepare($query);

        $stmt->bind_param("i", $person_id);

        $stmt->execute();

        return $stmt->get_result();

    }
}
