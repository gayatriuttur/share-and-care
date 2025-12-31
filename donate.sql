CREATE TABLE donations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    donorName VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    pickupDate DATE NOT NULL,
    pickupTime TIME NOT NULL,
    donationType VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);