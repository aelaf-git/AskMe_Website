-- Create the database
CREATE DATABASE IF NOT EXISTS askme_tour;
USE askme_tour;

-- Table for Admin Users
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for Registrations/Bookings
CREATE TABLE IF NOT EXISTS registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    destination VARCHAR(255) NOT NULL,
    departure_date DATE NOT NULL,
    return_date DATE NOT NULL,
    purpose VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for Contact Messages
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for Newsletter Subscribers
CREATE TABLE IF NOT EXISTS newsletter (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for Upcoming Events
CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    short_description VARCHAR(500) NOT NULL,
    long_description TEXT NOT NULL,
    event_date DATE NOT NULL,
    registration_deadline DATE DEFAULT NULL,
    image_path VARCHAR(255) DEFAULT 'assets/img/carousel-1.jpg',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for Event Registrations (Applications)
CREATE TABLE IF NOT EXISTS event_registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    gender VARCHAR(20) NOT NULL,
    dob DATE NOT NULL,
    nationality VARCHAR(100) NOT NULL,
    passport_number VARCHAR(50) NOT NULL,
    passport_expiry DATE NOT NULL,
    phone VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    occupation VARCHAR(255) NOT NULL,
    company VARCHAR(255),
    industry VARCHAR(255),
    experience_years INT DEFAULT 0,
    purpose TEXT NOT NULL,
    areas_of_interest TEXT,
    has_passport TINYINT(1) DEFAULT 1,
    traveled_before TINYINT(1) DEFAULT 0,
    previous_international_destinations TEXT,
    has_trip_visa TINYINT(1) DEFAULT 0,
    requires_visa TINYINT(1) DEFAULT 0,
    needs_invitation TINYINT(1) DEFAULT 0,
    special_notes TEXT,
    passport_issue_date DATE DEFAULT NULL,
    passport_issue_place VARCHAR(255) DEFAULT NULL,
    passport_scan_path VARCHAR(255) DEFAULT NULL,
    profile_photo_path VARCHAR(255) DEFAULT NULL,
    emergency_contact_name VARCHAR(255) DEFAULT NULL,
    emergency_contact_phone VARCHAR(50) DEFAULT NULL,
    emergency_contact_relationship VARCHAR(100) DEFAULT NULL,
    country_of_residence VARCHAR(100) DEFAULT NULL,
    city_of_residence VARCHAR(100) DEFAULT NULL,
    accommodation_preference VARCHAR(100) DEFAULT NULL,
    room_type_preference VARCHAR(100) DEFAULT NULL,
    dietary_requirements TEXT,
    medical_conditions TEXT,
    insurance_provider VARCHAR(255) NOT NULL,
    insurance_policy_number VARCHAR(120) NOT NULL,
    insurance_doc_path VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE
);

-- Table for Tour Packages
CREATE TABLE IF NOT EXISTS packages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    duration VARCHAR(50) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image_path VARCHAR(255) DEFAULT 'assets/img/package-1.jpg',
    description TEXT,
    is_featured BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for Destinations
CREATE TABLE IF NOT EXISTS destinations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL, -- e.g., 'Ethiopia', 'Global'
    image_path VARCHAR(255) DEFAULT 'assets/img/ethiopia.jpg',
    discount_tag VARCHAR(50), -- e.g., '20% OFF'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for Team Members (Visionaries)
CREATE TABLE IF NOT EXISTS team (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    designation VARCHAR(255) NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    facebook_url VARCHAR(255),
    instagram_url VARCHAR(255),
    linkedin_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for Testimonials
CREATE TABLE IF NOT EXISTS testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(255) NOT NULL,
    profession VARCHAR(255),
    client_image VARCHAR(255) DEFAULT 'assets/img/user.jpg',
    feedback TEXT NOT NULL,
    rating INT DEFAULT 5,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for Services
CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    icon_class VARCHAR(100) NOT NULL, -- FontAwesome class
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Migration for existing databases (run manually once):
-- ALTER TABLE event_registrations
--     DROP COLUMN arrival_date,
--     DROP COLUMN departure_date,
--     DROP COLUMN arrival_city,
--     DROP COLUMN arrival_flight,
--     DROP COLUMN visa_support_doc_path,
--     DROP COLUMN vaccination_doc_path,
--     DROP COLUMN additional_doc_path,
--     ADD COLUMN previous_international_destinations TEXT NULL AFTER traveled_before,
--     ADD COLUMN has_trip_visa TINYINT(1) DEFAULT 0 AFTER previous_international_destinations,
--     MODIFY insurance_provider VARCHAR(255) NOT NULL,
--     MODIFY insurance_policy_number VARCHAR(120) NOT NULL;