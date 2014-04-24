DELETE FROM mysql.db WHERE `User` = 'selenium_test';
DELETE FROM mysql.user WHERE `User` = 'selenium_test';

flush privileges;

CREATE USER 'selenium_test'@'localhost' IDENTIFIED BY '2K00L4SKOOL';

GRANT 
    SELECT, INSERT, UPDATE, DELETE, SHOW VIEW, REFERENCES, INDEX, LOCK TABLES, CREATE TEMPORARY TABLES, EXECUTE
ON *.* TO 'selenium_test'@'localhost' IDENTIFIED BY '2K00L4SKOOL';

flush privileges;
