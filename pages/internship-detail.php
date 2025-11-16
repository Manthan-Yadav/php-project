<?php
$internship_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($internship_id > 0) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM internships WHERE id = ?");
        $stmt->execute([$internship_id]);
        $internship = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$internship) {
            echo '<div class="page-header"><div class="container"><h1>Internship Not Found</h1></div></div>';
            echo '<div class="container"><p>The internship you are looking for does not exist.</p><a href="?page=internships" class="btn">Back to Internships</a></div>';
        } else {
            ?>
            <div class="page-header">
                <div class="container">
                    <h1><?php echo htmlspecialchars($internship['title']); ?></h1>
                    <p><?php echo htmlspecialchars($internship['company_name']); ?></p>
                </div>
            </div>

            <div class="container">
                <div class="internship-detail">
                    <div class="detail-section">
                        <h2>About This Internship</h2>
                        <p><?php echo nl2br(htmlspecialchars($internship['description'])); ?></p>
                    </div>

                    <div class="detail-grid">
                        <div class="detail-box">
                            <h3>📍 Location</h3>
                            <p><?php echo htmlspecialchars($internship['location']); ?></p>
                        </div>
                        <div class="detail-box">
                            <h3>💵 Salary</h3>
                            <p><?php echo htmlspecialchars($internship['salary'] ?? 'N/A'); ?></p>
                        </div>
                        <div class="detail-box">
                            <h3>⏱️ Duration</h3>
                            <p><?php echo htmlspecialchars($internship['duration'] ?? 'N/A'); ?></p>
                        </div>
                        <div class="detail-box">
                            <h3>📚 Category</h3>
                            <p><?php echo htmlspecialchars($internship['category']); ?></p>
                        </div>
                    </div>

                    <div class="detail-section">
                        <h2>Requirements</h2>
                        <p><?php echo nl2br(htmlspecialchars($internship['requirements'] ?? 'Not specified')); ?></p>
                    </div>

                    <div class="action-buttons">
                        <?php if ($is_logged_in): ?>
                            <a href="php/apply.php?internship_id=<?php echo $internship['id']; ?>" class="btn btn-primary">Apply Now</a>
                        <?php else: ?>
                            <a href="php/login.php" class="btn btn-primary">Login to Apply</a>
                        <?php endif; ?>
                        <a href="?page=internships" class="btn btn-secondary">Back to Internships</a>
                    </div>
                </div>
            </div>
            <?php
        }
    } catch (Exception $e) {
        echo '<div class="error-message">Error loading internship details</div>';
    }
} else {
    echo '<div class="page-header"><div class="container"><h1>Invalid Internship</h1></div></div>';
    echo '<div class="container"><a href="?page=internships" class="btn">Back to Internships</a></div>';
}
?>
