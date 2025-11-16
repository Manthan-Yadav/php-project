<?php
$host = 'localhost';
$user = 'root';
$pass = '';

try {
    // Create database connection
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    
    // Create database
    $pdo->exec("DROP DATABASE IF EXISTS internship_portal");
    $pdo->exec("CREATE DATABASE internship_portal");
    $pdo->exec("USE internship_portal");
    
    // Create internships table
    $pdo->exec("CREATE TABLE internships (
        id INT PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(255) NOT NULL,
        company_name VARCHAR(255) NOT NULL,
        description LONGTEXT NOT NULL,
        requirements LONGTEXT,
        location VARCHAR(255) NOT NULL,
        salary VARCHAR(100),
        duration VARCHAR(100),
        category VARCHAR(100) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Create users table
    $pdo->exec("CREATE TABLE users (
        id INT PRIMARY KEY AUTO_INCREMENT,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        name VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Create applications table
    $pdo->exec("CREATE TABLE applications (
        id INT PRIMARY KEY AUTO_INCREMENT,
        user_id INT NOT NULL,
        internship_id INT NOT NULL,
        status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending',
        applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (internship_id) REFERENCES internships(id)
    )");
    
    // Insert sample internships
    $internships = [
        ['PHP Developer Intern', 'Tech Solutions India', 'We are looking for a motivated PHP developer intern to join our team. You will work on real-world projects and learn from experienced developers.', 'Basic PHP knowledge, HTML/CSS basics', 'Bangalore', '₹25,000/month', '3 months', 'IT'],
        ['Frontend Developer Intern', 'Web Agency Pro India', 'Join our frontend team to build responsive web applications using React and Vue.js. Great opportunity to learn modern web technologies.', 'JavaScript, HTML/CSS, React basics', 'Mumbai', '₹22,000/month', '3 months', 'IT'],
        ['Data Analyst Intern', 'Analytics Corp India', 'Help analyze business data and create insights. Work with Excel, SQL, and Python to drive business decisions.', 'Excel, basic SQL knowledge', 'Hyderabad', '₹26,000/month', '4 months', 'Finance'],
        ['Marketing Assistant Intern', 'Digital Marketing Agency India', 'Support our marketing team in social media campaigns, content creation, and market research.', 'Social media knowledge, basic writing skills', 'Delhi', '₹18,000/month', '3 months', 'Marketing'],
        ['HR Intern', 'Global Companies Ltd India', 'Assist HR team with recruitment, employee onboarding, and HR administration tasks.', 'Communication skills, basic HR knowledge', 'Pune', '₹16,000/month', '3 months', 'HR'],
        ['Backend Developer Intern', 'Cloud Systems Inc India', 'Work on backend APIs and database design. Learn about scalable system architecture and best practices.', 'Node.js or Python, REST APIs', 'Bangalore', '₹27,000/month', '4 months', 'IT'],
        ['Mobile App Developer Intern', 'Mobile First Studios India', 'Develop iOS and Android apps using React Native. Collaborate with designers and backend developers.', 'JavaScript, React basics', 'Gurgaon', '₹24,000/month', '3 months', 'IT'],
        ['Business Analyst Intern', 'Enterprise Solutions India', 'Analyze business requirements and create documentation for software solutions.', 'Technical writing, basic business knowledge', 'Chennai', '₹21,000/month', '3 months', 'IT'],
    ];
    
    $stmt = $pdo->prepare("INSERT INTO internships (title, company_name, description, requirements, location, salary, duration, category) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    foreach ($internships as $internship) {
        $stmt->execute($internship);
    }
    
    echo "✓ Database setup completed successfully!<br>";
    echo "✓ Tables created: internships, users, applications<br>";
    echo "✓ Sample data inserted: 8 internship positions<br>";
    echo "<br><a href='../index.php'>Go to Home Page</a>";
    
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
