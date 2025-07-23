-- إنشاء قاعدة بيانات smart_booking
CREATE DATABASE IF NOT EXISTS smart_booking CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE smart_booking;

-- إنشاء جدول المواعيد
CREATE TABLE IF NOT EXISTS appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    datetime DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
