CREATE DATABASE lostfound;
USE lostfound;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    type ENUM('kehilangan','temuan'),
    nama_barang VARCHAR(100),
    deskripsi TEXT,
    lokasi VARCHAR(100),
    waktu VARCHAR(50),
    kontak VARCHAR(50),
    foto VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);