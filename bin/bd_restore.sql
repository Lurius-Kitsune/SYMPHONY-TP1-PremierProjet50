create user 'databasecreator'@'localhost' identified by 'mdp';
grant create, drop on *.* to 'databasecreator'@'localhost';

create user 'userpremier50'@'%' identified by 'mdp';
grant all privileges on dbpremiersymfo50.* to 'userpremier50'@'%';