CREATE TABLE User_Role (
    user_id INT NOT NULL,
    role_id INT NOT NULL,
    PRIMARY KEY(user_id, role_id)
);

ALTER TABLE User_Role ADD FOREIGN KEY (user_id) REFERENCES User(id);
ALTER TABLE User_Role ADD FOREIGN KEY (role_id) REFERENCES Role(id);