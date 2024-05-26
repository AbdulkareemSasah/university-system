# create databases
CREATE DATABASE IF NOT EXISTS `univercity_system`;

# create local_developer user and grant rights
CREATE USER 'admin'@'db' IDENTIFIED BY '1234';
GRANT ALL PRIVILEGES ON *.* TO 'admin'@'%';

