


DROP TABLE IF EXISTS feedbacks;
DROP TABLE IF EXISTS ticket_reports;
DROP TABLE IF EXISTS tickets;
DROP TABLE IF EXISTS priorities;
DROP TABLE IF EXISTS statuses;
DROP TABLE IF EXISTS logins;
DROP TABLE IF EXISTS admins;
DROP TABLE IF EXISTS users;


CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(15)
);

INSERT INTO users (id, name, phone)
VALUES
    (1, 'user', '1234567890');


CREATE TABLE admins (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    date_birth DATE NOT NULL,
    phone VARCHAR(15) NOT NULL
);


INSERT INTO admins (id, name, date_birth, phone)
VALUES
    (1, 'admin', '1980-01-01', '0987654321');

CREATE TABLE logins (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    admin_id INT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (admin_id) REFERENCES admins(id)
);

INSERT INTO logins (id, user_id, admin_id, email, password)
VALUES
    (1, 1, NULL, 'user@example.com', 'user123'),
    (2, NULL, 1, 'admin@example.com', 'admin123');

CREATE TABLE statuses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name ENUM('open', 'in_progress', 'resolved') NOT NULL
);

CREATE TABLE priorities (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name ENUM('low', 'medium', 'high', 'critical') NOT NULL
);

CREATE TABLE tickets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    admin_id INT,
    status_id INT NOT NULL,
    priority_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    created_date DATE NOT NULL,
    closing_date DATE,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (admin_id) REFERENCES admins(id),
    FOREIGN KEY (status_id) REFERENCES statuses(id),
    FOREIGN KEY (priority_id) REFERENCES priorities(id)
);

CREATE TABLE ticket_reports (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ticket_id INT NOT NULL,
    report_date DATE NOT NULL,
    FOREIGN KEY (ticket_id) REFERENCES tickets(id)
);

CREATE TABLE feedbacks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ticket_id INT NOT NULL,
    admin_id INT NOT NULL,
    user_id INT NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    comment VARCHAR(1000),
    FOREIGN KEY (ticket_id) REFERENCES tickets(id),
    FOREIGN KEY (admin_id) REFERENCES admins(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
