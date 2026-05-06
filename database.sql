-- Import this file into your existing database (askmetgy_main) via phpMyAdmin or hosting control panel
-- Do NOT run the CREATE DATABASE or USE statements on shared hosting

-- Table for Admin Users
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- IMPORTANT: After importing this file, create your admin account:
-- Option 1: Use phpMyAdmin to insert a row into 'admins' table
-- Option 2: Run this SQL (replace with your own password hash):
-- INSERT INTO admins (email, password_hash) VALUES ('your_email@example.com', '$2y$12$YOUR_HASH_HERE');
--
-- To generate a hash, run: php -r "echo password_hash('YourPassword', PASSWORD_DEFAULT);"

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

-- Table for Custom Trip Requests (Outside Events)
CREATE TABLE IF NOT EXISTS custom_trip_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    nationality VARCHAR(100) NOT NULL,
    residence_country VARCHAR(100) NOT NULL,
    travelers_count INT NOT NULL DEFAULT 1,
    destination_country VARCHAR(150) NOT NULL,
    destination_cities VARCHAR(255) NOT NULL,
    departure_date DATE NOT NULL,
    return_date DATE NOT NULL,
    date_flexibility VARCHAR(100) NOT NULL,
    budget_range VARCHAR(100) NOT NULL,
    trip_purpose VARCHAR(100) NOT NULL,
    accommodation_preference VARCHAR(100) NOT NULL,
    transport_preference VARCHAR(100) NOT NULL,
    has_valid_passport TINYINT(1) DEFAULT 0,
    needs_visa_assistance TINYINT(1) DEFAULT 0,
    previous_international_travel TINYINT(1) DEFAULT 0,
    previous_countries TEXT,
    emergency_contact_name VARCHAR(255) NOT NULL,
    emergency_contact_phone VARCHAR(50) NOT NULL,
    special_requirements TEXT,
    additional_notes TEXT,
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
    -- Personal
    full_name VARCHAR(255) NOT NULL,
    gender VARCHAR(20) NOT NULL,
    dob DATE NOT NULL,
    nationality VARCHAR(100) NOT NULL,
    -- Passport
    passport_number VARCHAR(50) NOT NULL,
    passport_issue_date DATE DEFAULT NULL,
    passport_expiry DATE NOT NULL,
    passport_issuing_country VARCHAR(100) DEFAULT NULL,
    passport_scan VARCHAR(255) DEFAULT NULL,
    profile_photo VARCHAR(255) DEFAULT NULL,
    -- Contact
    phone VARCHAR(50) NOT NULL,
    whatsapp VARCHAR(50) DEFAULT NULL,
    email VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    city VARCHAR(100) DEFAULT NULL,
    country VARCHAR(100) DEFAULT NULL,
    -- Emergency
    emergency_name VARCHAR(255) DEFAULT NULL,
    emergency_phone VARCHAR(50) DEFAULT NULL,
    emergency_relation VARCHAR(100) DEFAULT NULL,
    -- Professional
    occupation VARCHAR(255) DEFAULT NULL,
    company VARCHAR(255) DEFAULT NULL,
    industry VARCHAR(255) DEFAULT NULL,
    experience_years INT DEFAULT 0,
    -- Travel
    purpose TEXT NOT NULL,

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

-- Table for Site Traffic Tracking
CREATE TABLE IF NOT EXISTS site_traffic (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ip_address VARCHAR(45) NOT NULL,
    session_id VARCHAR(64) NOT NULL,
    user_agent TEXT,
    device_type VARCHAR(20) DEFAULT 'Desktop',
    page_url VARCHAR(500) NOT NULL,
    referrer VARCHAR(500),
    country VARCHAR(100) DEFAULT 'Unknown',
    city VARCHAR(100) DEFAULT 'Unknown',
    viewed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_session (session_id),
    INDEX idx_viewed (viewed_at)
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
--     MODIFY insurance_provider VARCHAR(255) DEFAULT NULL,
--     MODIFY insurance_policy_number VARCHAR(120) DEFAULT NULL,
--     MODIFY occupation VARCHAR(255) DEFAULT NULL,
--     CHANGE room_type_preference room_preference VARCHAR(100) DEFAULT NULL,
--     ADD COLUMN special_notes TEXT AFTER room_preference;