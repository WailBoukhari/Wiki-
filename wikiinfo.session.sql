-- Drop the database if it exists
DROP DATABASE IF EXISTS wiki;
-- Create a new database
CREATE DATABASE IF NOT EXISTS wiki;
-- Use database
USE wiki;
-- Drop tables if they exist
DROP TABLE IF EXISTS wiki_tags;
DROP TABLE IF EXISTS wikis;
DROP TABLE IF EXISTS tags;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS users;
-- Create Users table
CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('Admin', 'Author') DEFAULT 'Author',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Create Categories table
CREATE TABLE IF NOT EXISTS categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Create Tags table
CREATE TABLE IF NOT EXISTS tags (
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Create Wikis table
CREATE TABLE IF NOT EXISTS wikis (
    wiki_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    user_id INT,
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_archived BOOLEAN DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
);
-- Create Wiki-Tags relationship table
CREATE TABLE IF NOT EXISTS wiki_tags (
    wiki_id INT,
    tag_id INT,
    PRIMARY KEY (wiki_id, tag_id),
    FOREIGN KEY (wiki_id) REFERENCES wikis(wiki_id),
    FOREIGN KEY (tag_id) REFERENCES tags(tag_id)
);
-- Insert sample data into users table (hashed passwords)
INSERT INTO users (username, email, password_hash, role)
VALUES (
        'admin',
        'admin@test.com',
        '$2y$10$UWuOclA49KEQy.SBE8rldO71A1W39R8hmVJqFdgDKIp2C1EVrxy/G',
        'Admin'
    ),
    (
        'author',
        'author@test.com',
        '$2y$10$fTnr5sXGxpUbsvpkwelBNOdsCiuauVBOwh9yAdpGHfB7L21vUHota',
        'Author'
    );
-- Insert sample data into categories table
INSERT INTO categories (name)
VALUES ('Technology'),
    ('Nature'),
    ('Art');
-- Insert sample data into tags table
INSERT INTO tags (name)
VALUES ('Programming'),
    ('Science'),
    ('Painting'),
    ('Web');
-- Insert sample data into wikis table
INSERT INTO wikis (title, content, user_id, category_id)
VALUES (
        'Introduction to Programming',
        'A beginner-friendly guide to programming concepts.',
        2,
        1
    ),
    (
        'The Wonders of Nature',
        'Explore the beauty and mysteries of nature.',
        2,
        2
    ),
    (
        'Masterpieces in Art',
        'Discover timeless masterpieces from various artists.',
        2,
        3
    );
-- Insert sample data into wiki_tags table
INSERT INTO wiki_tags (wiki_id, tag_id)
VALUES (1, 1),
    (1, 4),
    (2, 2),
    (2, 4),
    (3, 3),
    (3, 4);