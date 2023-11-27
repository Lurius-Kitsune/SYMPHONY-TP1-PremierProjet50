create user 'databasecreator'@'localhost' identified by 'mdp';
grant create, drop on *.* to 'databasecreator'@'localhost';

create user 'userpremier50'@'%' identified by 'mdp';
grant all privileges on dbpremiersymfo50.* to 'userpremier50'@'%';

Insert into dbpremiersymfo50.employe (nom, salaire, idLieu) values
("Martin", 10000.00, 1),
("Dupont", 23000.00, 1),
("Russot", 45600.00, 2),
("Delevoy", 12000.00, 1),
("Dumans", 34000.00, 2);

insert into dbpremiersymfo50.lieu(id, nom, ville) values
(1, "Ets Blanchard", "Toulon"),
(2, "Dipassa SARL", "Paris");

update dbpremiersymfo50.employe set idLieu=1 where id=1;
update dbpremiersymfo50.employe set idLieu=1 where id=2;
update dbpremiersymfo50.employe set idLieu=2 where id=3;
update dbpremiersymfo50.employe set idLieu=1 where id=4;
update dbpremiersymfo50.employe set idLieu=2 where id=5;

select * from employe;