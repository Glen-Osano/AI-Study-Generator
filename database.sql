CREATE DATABASE ai_study;
USE ai_study;

CREATE TABLE study_notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    topic VARCHAR(255),
    summary TEXT,
    questions TEXT,
    key_points TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

