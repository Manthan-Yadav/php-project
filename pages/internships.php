<div class="page-header">
    <div class="container">
        <h1>Browse Internships</h1>
        <p>Find your next opportunity</p>
    </div>
</div>

<div class="container">
    <div class="search-filters">
        <form method="GET" action="">
            <input type="hidden" name="page" value="internships">
            <div class="filter-row">
                <input type="text" name="search" placeholder="Search by title or company..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <select name="category">
                    <option value="">All Categories</option>
                    <option value="IT" <?php echo isset($_GET['category']) && $_GET['category'] === 'IT' ? 'selected' : ''; ?>>IT & Software</option>
                    <option value="Marketing" <?php echo isset($_GET['category']) && $_GET['category'] === 'Marketing' ? 'selected' : ''; ?>>Marketing</option>
                    <option value="Finance" <?php echo isset($_GET['category']) && $_GET['category'] === 'Finance' ? 'selected' : ''; ?>>Finance</option>
                    <option value="HR" <?php echo isset($_GET['category']) && $_GET['category'] === 'HR' ? 'selected' : ''; ?>>Human Resources</option>
                </select>
                <input type="text" name="location" placeholder="Location..." value="<?php echo isset($_GET['location']) ? htmlspecialchars($_GET['location']) : ''; ?>">
                <button type="submit" class="search-btn">Search</button>
            </div>
        </form>
    </div>

    <div class="internship-list">
        <?php
        try {
            $query = "SELECT * FROM internships WHERE 1=1";
            $params = [];
            
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $query .= " AND (title LIKE ? OR company_name LIKE ? OR description LIKE ?)";
                $search_term = '%' . $_GET['search'] . '%';
                $params = array_merge($params, [$search_term, $search_term, $search_term]);
            }
            
            if (isset($_GET['category']) && !empty($_GET['category'])) {
                $query .= " AND category = ?";
                $params[] = $_GET['category'];
            }
            
            if (isset($_GET['location']) && !empty($_GET['location'])) {
                $query .= " AND location LIKE ?";
                $params[] = '%' . $_GET['location'] . '%';
            }
            
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
            $internships = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (empty($internships)) {
                echo '<div class="no-results"><p>No internships found.</p></div>';
            } else {
                foreach ($internships as $internship) {
                    echo '<div class="internship-item">';
                    echo '<h3>' . htmlspecialchars($internship['title']) . '</h3>';
                    echo '<div class="company-info">' . htmlspecialchars($internship['company_name']) . '</div>';
                    echo '<div class="details">';
                    echo '<div class="detail-item">📍 ' . htmlspecialchars($internship['location']) . '</div>';
                    echo '<div class="detail-item">💵 ' . (isset($internship['salary']) ? htmlspecialchars($internship['salary']) : 'N/A') . '</div>';
                    echo '<div class="detail-item">⏱️ ' . (isset($internship['duration']) ? htmlspecialchars($internship['duration']) : 'N/A') . '</div>';
                    echo '</div>';
                    echo '<p>' . substr(htmlspecialchars($internship['description']), 0, 200) . '...</p>';
                    echo '<a href="?page=internship-detail&id=' . $internship['id'] . '" class="btn">View Details & Apply</a>';
                    echo '</div>';
                }
            }
        } catch (Exception $e) {
            echo '<div class="error-message">Error loading internships</div>';
        }
        ?>
    </div>
</div>
