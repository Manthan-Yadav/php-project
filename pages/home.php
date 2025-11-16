<section class="hero">
    <div class="container">
        <h1>Launch Your Career with Us</h1>
        <p>Connect with top companies and kickstart your internship journey</p>
        <a href="?page=internships" class="btn">Browse Internships</a>
    </div>
</section>

<section class="internships-section">
    <div class="container">
        <h2 class="section-title">Featured Internships</h2>
        <div class="internship-grid" id="internship-list">
            <?php
            try {
                $stmt = $pdo->prepare("SELECT * FROM internships LIMIT 6");
                $stmt->execute();
                $internships = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if (empty($internships)) {
                    echo '<p style="grid-column: 1/-1; text-align: center;">No internships available at the moment.</p>';
                } else {
                    foreach ($internships as $internship) {
                        echo '<div class="internship-card">';
                        echo '<h3>' . htmlspecialchars($internship['title']) . '</h3>';
                        echo '<p><strong>' . htmlspecialchars($internship['company_name']) . '</strong></p>';
                        echo '<p>' . htmlspecialchars($internship['location']) . '</p>';
                        echo '<p>' . substr(htmlspecialchars($internship['description']), 0, 100) . '...</p>';
                        echo '<a href="?page=internship-detail&id=' . $internship['id'] . '" class="btn">View Details</a>';
                        echo '</div>';
                    }
                }
            } catch (Exception $e) {
                echo '<p style="grid-column: 1/-1; text-align: center; color: #999;">Error loading internships</p>';
            }
            ?>
        </div>
    </div>
</section>
