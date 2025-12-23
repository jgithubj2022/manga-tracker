CREATE TABLE comments (
  id INT AUTO_INCREMENT PRIMARY KEY,

  manga_id INT NOT NULL,
  author_user_id INT NULL, --NULL  guest comment allowed
  author_name VARCHAR(60) NULL, --optional display name for guests
  body TEXT NOT NULL,

  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

  INDEX (manga_id),
  INDEX (author_user_id),

  CONSTRAINT fk_comments_manga
    FOREIGN KEY (manga_id) REFERENCES mangas(id)
    ON DELETE CASCADE,

  CONSTRAINT fk_comments_user
    FOREIGN KEY (author_user_id) REFERENCES users(id)
    ON DELETE SET NULL
);
