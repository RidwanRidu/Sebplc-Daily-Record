CREATE DATABASE IF NOT EXISTS outlet_system;
USE outlet_system;

CREATE TABLE IF NOT EXISTS outlet_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    entry_date DATE NOT NULL,
    outlet_name VARCHAR(100) DEFAULT 'KODOMTOLA BAZAR OUTLET',
    total_account INT NOT NULL,
    sb INT NOT NULL,
    student INT NOT NULL,
    cd INT NOT NULL,
    dps INT NOT NULL,
    fdr INT NOT NULL,
    remittance INT NOT NULL,
    cheque_book INT NOT NULL,
    card INT NOT NULL,
    rtgs INT NOT NULL,
    eft INT NOT NULL,
    total_deposit DECIMAL(12,2) NOT NULL,
    total_withdraw DECIMAL(12,2) NOT NULL,
    hand_cash DECIMAL(12,2) NOT NULL,
    mother_balance DECIMAL(12,2) NOT NULL,
    dps_close INT NOT NULL,
    fdr_close INT NOT NULL,
    total_close_account INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create a user for the application
CREATE USER 'outlet_user'@'localhost' IDENTIFIED BY 'securepassword123';
GRANT ALL PRIVILEGES ON outlet_system.* TO 'outlet_user'@'localhost';
FLUSH PRIVILEGES;