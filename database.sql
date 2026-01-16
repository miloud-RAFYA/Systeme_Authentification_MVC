
-- ================================
-- Base de données SecureCore
-- ================================
CREATE DATABASE IF NOT EXISTS securecore_auth
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE securecore_auth;

-- ================================
-- Table roles
-- ================================
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ================================
-- Table users
-- ================================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_user_role
        FOREIGN KEY (role_id)
        REFERENCES roles(id)
        ON DELETE RESTRICT
);

-- ================================
-- Table candidates
-- ================================
CREATE TABLE candidates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    profile_completed BOOLEAN DEFAULT FALSE,

    CONSTRAINT fk_candidate_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
);

-- ================================
-- Table companies
-- ================================
CREATE TABLE companies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    company_name VARCHAR(150) NOT NULL,
    website VARCHAR(150) NULL,

    CONSTRAINT fk_company_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
);
INSERT INTO roles (name) VALUES
('admin'),
('company'),
('candidate');
INSERT INTO users (name, email, password, role_id)
VALUES (
    'Admin SecureCore',
    'admin@securecore.com',
    '$2y$10$abcdefghijklmnopqrstuv1234567890abcdefghijklmnopqrstuv',
    (SELECT id FROM roles WHERE name = 'admin')
);
INSERT INTO users (name, email, password, role_id)
VALUES (
    'TechCorp',
    'contact@techcorp.com',
    '$2y$10$abcdefghijklmnopqrstuv1234567890abcdefghijklmnopqrstuv',
    (SELECT id FROM roles WHERE name = 'company')
);
INSERT INTO companies (user_id, company_name, website)
VALUES (
    (SELECT id FROM users WHERE email = 'contact@techcorp.com'),
    'TechCorp SARL',
    'https://www.techcorp.com'
);
INSERT INTO users (name, email, password, role_id)
VALUES (
    'Said Aabilla',
    'said.candidate@gmail.com',
    '$2y$10$abcdefghijklmnopqrstuv1234567890abcdefghijklmnopqrstuv',
    (SELECT id FROM roles WHERE name = 'candidate')
);
INSERT INTO candidates (user_id, profile_completed)
VALUES (
    (SELECT id FROM users WHERE email = 'said.candidate@gmail.com'),
    TRUE
);

