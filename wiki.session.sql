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
    image VARCHAR (255),
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
    ('Art'),
    ('Science Fiction'),
    ('History'),
    ('Travel'),
    ('Music'),
    ('AI'),
    ('Space'),
    ('Ancient'),
    ('Adventure'),
    ('Mountains'),
    ('Beaches'),
    ('Classical'),
    ('Rock'),
    ('Medicine'),
    ('Food'),
    ('Sports'),
    ('Fashion'),
    ('Literature');
-- Insert sample data into tags table
INSERT INTO tags (name)
VALUES ('Programming'),
    ('Science'),
    ('Painting'),
    ('Web'),
    ('Medicine'),
    ('Food'),
    ('Sports'),
    ('Fashion'),
    ('Literature'),
    ('Travel'),
    ('Adventure'),
    ('Space'),
    ('Nature'),
    ('Technology'),
    ('History'),
    ('Art'),
    ('Science Fiction'),
    ('Mountains'),
    ('Beaches'),
    ('Classical');
-- Insert sample data into wikis table
INSERT INTO wikis (title, content, user_id, category_id, image)
VALUES (
        'Introduction to Programming',
        'A beginner-friendly guide to programming concepts.',
        2,
        1,
        'wiki_img.jpg'
    ),
    (
        'The Wonders of Nature',
        'Explore the beauty and mysteries of nature.',
        2,
        2,
        'wiki_img.jpg'
    ),
    (
        'Masterpieces in Art',
        'Discover timeless masterpieces from various artists.',
        2,
        3,
        'wiki_img.jpg'
    ),
    (
        'Artificial Intelligence: A Future Perspective',
        'Artificial Intelligence (AI) is a field of computer science that aims to create machines capable of intelligent behavior. From machine learning to natural language processing, explore the fascinating world of AI.',
        2,
        1,
        'wiki_img.jpg'
    ),
    (
        'Journey Through the Cosmos',
        'Embark on a mesmerizing journey through the vast cosmos. Learn about galaxies, stars, and the mysteries of space exploration.',
        2,
        2,
        'wiki_img.jpg'
    ),
    (
        'Exploring Ancient Civilizations',
        'Uncover the secrets of ancient civilizations that shaped the course of history. Discover architectural marvels, cultural achievements, and historical milestones.',
        2,
        3,
        'wiki_img.jpg'
    ),
    (
        'Musical Evolution: A Symphony Through Time',
        'Trace the evolution of music through the ages. From classical compositions to the birth of rock and roll, explore the rich tapestry of musical history.',
        2,
        4,
        'wiki_img.jpg'
    ),
    (
        'The Rise of Machines: A Deep Dive into Robotics',
        'Dive deep into the world of robotics and automation. Explore the advancements in robotic technology, from industrial applications to cutting-edge developments in humanoid robots.',
        2,
        1,
        'wiki_img.jpg'
    ),
    (
        'Mysteries of Ancient Egypt',
        'Embark on a journey to Ancient Egypt and unravel its mysteries. Discover the secrets of the pyramids, the Sphinx, and the fascinating civilization that thrived along the Nile.',
        2,
        3,
        'wiki_img.jpg'
    ),
    (
        'Beyond the Horizon: Exploring Uncharted Territories',
        'Venture into uncharted territories and explore the beauty of untouched landscapes. From dense rainforests to vast deserts, discover the diverse ecosystems that exist beyond the horizon.',
        2,
        2,
        'wiki_img.jpg'
    ),
    (
        'The Sound of Science: A Symphony of Discoveries',
        'Explore the intersection of science and music. Delve into the scientific principles behind musical compositions and the role of music in scientific discovery.',
        2,
        4,
        'wiki_img.jpg'
    ),
    (
        'Programming Paradigms: A Comprehensive Guide',
        'Dive into the world of programming paradigms. Explore different approaches to solving problems and understand the principles behind functional, imperative, and object-oriented programming.',
        2,
        1,
        'wiki_img.jpg'
    ),
    (
        'Biodiversity Hotspots: Ecological Marvels',
        'Discover biodiversity hotspots around the world. Explore ecosystems teeming with life and learn about the importance of preserving these ecological marvels.',
        2,
        2,
        'wiki_img.jpg'
    ),
    (
        'The Art of Surrealism: Dreams on Canvas',
        'Immerse yourself in the dreamlike world of Surrealism. Explore artworks that challenge reality and take you on a journey through the subconscious mind.',
        2,
        3,
        'wiki_img.jpg'
    ),
    (
        'The Quantum Frontier: Understanding Quantum Physics',
        'Embark on a journey into the quantum frontier. Explore the fundamental principles of quantum physics and its implications for our understanding of the universe.',
        2,
        1,
        'wiki_img.jpg'
    ),
    (
        'Culinary Adventures: A Global Gastronomic Tour',
        'Embark on a culinary journey around the world. Explore diverse cuisines, traditional dishes, and the cultural significance of food in different societies.',
        2,
        4,
        'wiki_img.jpg'
    ),
    (
        'Epic Sports Moments: A Journey Through Time',
        'Relive epic sports moments that have defined the history of various sports. From iconic victories to historic rivalries, explore the stories behind the most memorable moments in sports.',
        2,
        3,
        'wiki_img.jpg'
    ),
    (
        'Fashion Through the Decades: A Stylish Evolution',
        'Take a trip through the fashion evolution of the decades. Explore iconic styles, fashion movements, and the cultural influences that have shaped the world of fashion.',
        2,
        4,
        'wiki_img.jpg'
    ),
    (
        'Literary Classics: Timeless Tales and Authors',
        'Delve into literary classics that have stood the test of time. Explore timeless tales, renowned authors, and the enduring impact of classic literature on culture and society.',
        2,
        3,
        'wiki_img.jpg'
    ),
    (
        'Wonders of the Deep: Exploring Ocean Mysteries',
        'Dive into the mysteries of the deep sea. Explore marine life, underwater ecosystems, and the wonders hidden beneath the ocean surface.',
        2,
        2,
        'wiki_img.jpg'
    );
-- Insert sample data into wiki_tags table
INSERT INTO wiki_tags (wiki_id, tag_id)
VALUES (1, 1),
    (1, 4),
    (2, 2),
    (2, 4),
    (3, 3),
    (3, 4),
    (4, 1),
    (4, 7),
    (5, 1),
    (5, 4),
    (6, 3),
    (6, 6),
    (7, 2),
    (7, 5),
    (8, 4),
    (8, 7),
    (9, 1),
    (9, 4),
    (10, 2),
    (10, 4),
    (11, 3),
    (11, 4),
    (12, 1),
    (12, 7),
    (13, 1),
    (13, 4),
    (14, 2),
    (14, 4),
    (15, 3),
    (15, 6),
    (16, 1),
    (16, 8),
    (17, 1),
    (17, 4),
    (18, 2),
    (18, 5),
    (19, 4),
    (19, 7),
    (20, 3),
    (20, 6);