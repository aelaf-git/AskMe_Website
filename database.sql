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
    image_path VARCHAR(255) DEFAULT 'assets/img/carousel-1.jpg',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert Sample Events
INSERT INTO events (title, short_description, long_description, event_date, image_path) VALUES
('Ethiopian New Year', 'Join us in celebrating the vibrant Ethiopian New Year with traditional music and dancing.', 'Enkutatash is the first day of the New Year in Ethiopia. It occurs on September 11 in the Gregorian Calendar. This festival is celebrated with traditional music, dancing, and the beautiful yellow Meskel daisies that cover the Ethiopian highlands.', '2026-09-11', 'assets/img/dallol.jpg'),
('Meskel Festival', 'Experience the magnificent bonfire lighting ceremony in Meskel Square.', 'Meskel has been celebrated for over 1,600 years. It commemorates the discovery of the True Cross by Queen Helena in the fourth century. The festival is known for the burning of a large bonfire, or Demera, in Meskel Square.', '2026-09-27', 'assets/img/ertale.jpg'),
('Great Ethiopian Run', 'Participate in Africa\'s biggest 10km road race through Addis Ababa.', 'The Great Ethiopian Run is an annual 10-kilometre road running event in Addis Ababa. It is Africa\'s biggest road race, with over 45,000 participants from all over the world.', '2026-11-17', 'assets/img/addisababa.jpg');

INSERT INTO admins (email, password_hash) 
VALUES ('admin@askmetour.org', '$2y$12$lSriFhiWZClfyOZh7BGOq.rtO1di9ZDGaYq/6Cc1tDEdOK1XcLoxe')
ON DUPLICATE KEY UPDATE email=email;
