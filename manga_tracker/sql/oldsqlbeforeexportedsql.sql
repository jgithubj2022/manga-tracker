
CREATE DATABASE IF NOT EXISTS manga_tracker;
USE manga_tracker;

CREATE TABLE mangas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL, <-- new user id for usersss -->
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status VARCHAR(50),
    cover_image VARCHAR(255),
    rating TINYINT NULL,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    INDEX (user_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
);
