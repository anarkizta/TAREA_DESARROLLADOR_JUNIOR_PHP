drop database juniophp;
create database juniorphp;
use juniorphp;

CREATE TABLE originales_indicadores(
	Id int not null AUTO_INCREMENT,
    codigo varchar(400) not null,
    medida varchar(400) not null,
    fecha date not null,
    valor int not null,
    CONSTRAINT pk_originales_indicadores PRIMARY KEY(Id)
);
CREATE TABLE modificados_indicadores(
	Id int not null AUTO_INCREMENT,
    codigo varchar(400) not null,
    medida varchar(400) not null,
    fecha date not null,
    valor int not null,
    Original_Id int not null,
    CONSTRAINT pk_modificados_indicadores PRIMARY KEY(Id),
    CONSTRAINT fk_modificados_indicadores_Original_Id foreign key (Original_Id) references originales_indicadores(Id)
);


