CREATE DATABASE IF NOT EXISTS sekolah;
USE sekolah;

-- Tabel Data Siswa (id diganti dengan nis)
DROP TABLE IF EXISTS siswa;
CREATE TABLE IF NOT EXISTS siswa (
    nis INT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    kelas VARCHAR(50) NOT NULL
);

-- Tabel Data User / Akun Login
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);