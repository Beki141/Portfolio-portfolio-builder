<?php
include 'include/Database.php';
include 'include/Portfolio.php';

$db = new Database();
$portfolio = new Portfolio($db);

// Fetch Person Info
$person = $portfolio->getPerson(1); // Assuming person ID is 1

// Fetch Skills
$skills_result = $portfolio->getSkills(1);

// Fetch Projects
$projects_result = $portfolio->getProjects(1);

// Fetch Contacts
$contacts_result = $portfolio->getContacts(1);

// Fetch Testimonials
$testimonials_result = $portfolio->getTestimonials(1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .navbar {
            background-color: #00796b;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #005f56;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h1,
        h2 {
            text-align: center;
        }

        .section {
            margin-bottom: 40px;
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .section img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .section table {
            width: 100%;
            border-collapse: collapse;
        }

        .section th,
        .section td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .section th {
            background-color: #00796b;
            color: white;
        }

        .project img {
            display: block;
            margin: 0 auto;
            max-width: 50%;
            height: auto;
        }

        .footer {
            background-color: #00796b;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="#personal-info">About Me</a>

        <a href="#skills">Skills</a>
        <a href="#projects">Projects</a>
        <a href="#contact">Contact</a>

        <a href="#testimonials">Testimonials</a>
        <a href="#">Blog</a>

    </div>

    <div class="container">
        <h1><?php echo $person['name'] ?? 'Hi'; ?></h1>

        <div class="section" id="personal-info">
            <h2>Personal Info</h2>
            <p><strong>Name:</strong> <?php echo $person['name']; ?></p>
            <p><strong>Description:</strong> <?php echo $person['description']; ?></p>
            <?php if ($person['picture']): ?>
                <img src="<?php echo $person['picture']; ?>" alt="Picture">
            <?php endif; ?>
        </div>

        <div class="section" id="skills">
            <h2>Skills</h2>
            <table>
                <tr>
                    <th>Skill Name</th>
                    <th>Skill Level</th>
                </tr>
                <?php while ($skill = $skills_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $skill['skill_name']; ?></td>
                        <td><?php echo $skill['skill_level']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <div class="section" id="projects">
            <h2>Projects</h2>
            <?php while ($project = $projects_result->fetch_assoc()): ?>
                <div class="project">
                    <h3><?php echo $project['project_title']; ?></h3>
                    <p><?php echo $project['project_description']; ?></p>
                    <?php if ($project['project_image']): ?>
                        <img src="<?php echo $project['project_image']; ?>" alt="Project Image">
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="section" id="contact">
            <h2>Contact</h2>
            <?php while ($contact = $contacts_result->fetch_assoc()): ?>
                <p><strong>Email:</strong> <?php echo $contact['email']; ?></p>
                <p><strong>Phone:</strong> <?php echo $contact['phone']; ?></p>
                <p><strong>Message:</strong> <?php echo $contact['message']; ?></p>
            <?php endwhile; ?>
        </div>

        <div class="section" id="testimonials">
            <h2>Testimonials</h2>
            <?php while ($testimonial = $testimonials_result->fetch_assoc()): ?>
                <div class="testimonial">
                    <p><strong>Client Name:</strong> <?php echo $testimonial['client_name']; ?></p>
                    <p><?php echo $testimonial['feedback']; ?></p>
                </div>
            <?php endwhile; ?>

        </div>
        <div class="section" id="testimonials">
            <h2>Blog</h2>
            <?php while ($testimonial = $testimonials_result->fetch_assoc()): ?>
                <div class="testimonial">
                    <p><strong>Client Name:</strong> <?php echo $testimonial['client_name']; ?></p>
                    <p><?php echo $testimonial['feedback']; ?></p>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="footer">
            &copy; <?php echo date("Y"); ?> Portfolio Builder. All rights reserved.
        </div>
</body>

</html>