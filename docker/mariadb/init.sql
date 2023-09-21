CREATE DATABASE IF NOT EXISTS def_tournooi_dev;
CREATE DATABASE IF NOT EXISTS def_tournooi_dev_test;

GRANT ALL PRIVILEGES ON def_tournooi_dev.* TO 'df'@'%';
GRANT ALL PRIVILEGES ON def_tournooi_dev_test.* TO 'df'@'%';

FLUSH PRIVILEGES;