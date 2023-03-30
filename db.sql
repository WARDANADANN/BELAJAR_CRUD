create table  student
(
    NIM varchar(255),
    name varchar(255),
    address varchar(255),
    gender varchar(255),
    primary key(NIM)
)
create table  mapel
(
    mapel_id varchar(255),
    pelajaran varchar(255),
    KKM varchar(100),
    primary key(mapel_id)
)
create table  raport
(
    NIM varchar(255),
    semester int(6),
    mapel_id varchar(255),
    score varchar(100),
    primary key(NIM,mapel_id,semester),
    foreign key(NIM) references student(NIM),
    foreign key(mapel_id) references mapel(mapel_id)
)
insert into student (NIM,name,address,gender) values
("001202200018","wardana","sbh","laki=laki")
insert into mapel (mapel_id,pelajaran,KKM) values
("oo1","BIOLOGI",68)
insert into raport (NIM,semester,mapel_id,score) values
("001202200018",1,"001","98")