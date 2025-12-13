
CREATE DATABASE IF NOT EXISTS manga_tracker;
USE manga_tracker;

CREATE TABLE mangas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status VARCHAR(50),
    cover_image VARCHAR(255),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);