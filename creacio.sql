CREATE DATABASE IF NOT EXISTS dbseries;
USE dbseries;

-- Creació de la taula SERIE
CREATE TABLE IF NOT EXISTS SERIE (
    nomSerie VARCHAR(100) PRIMARY KEY,
    anyCreacio INT,
    descripcio TEXT,
    imatge TEXT,
    valoracioMitjana DECIMAL(3, 2)
);

-- Creació de la taula TEMPORADA
CREATE TABLE IF NOT EXISTS TEMPORADA (
    nomSerie VARCHAR(100),
    numTemporada INT,
    descripcio TEXT,
    imatge VARCHAR(255),
    valoracioMitjana DECIMAL(3, 2),
    PRIMARY KEY (nomSerie, numTemporada),
    FOREIGN KEY (nomSerie) REFERENCES SERIE(nomSerie)
);

-- Creació de la taula USUARI
CREATE TABLE IF NOT EXISTS USUARI (
    nomUsuari VARCHAR(100) PRIMARY KEY,
    contrasenya VARCHAR(255),
    tipus ENUM('administrador', 'valorador'),
    numeroErrorsLogin INT
);

-- Creació de la taula VALORADOR
CREATE TABLE IF NOT EXISTS VALORADOR (
    nomUsuari VARCHAR(100),
    nom VARCHAR(100),
    cognoms VARCHAR(100),
    imatge VARCHAR(255),
    email VARCHAR(255),
    PRIMARY KEY (nomUsuari),
    FOREIGN KEY (nomUsuari) REFERENCES USUARI(nomUsuari)
);

-- Creació de la taula VALORA
CREATE TABLE IF NOT EXISTS VALORA (
    nomSerie VARCHAR(100),
    numTemporada INT,
    nomUsuari VARCHAR(100),
    valor INT CHECK (valor BETWEEN 1 AND 10),
    comentari TEXT,
    PRIMARY KEY (nomSerie, numTemporada, nomUsuari),
    FOREIGN KEY (nomSerie, numTemporada) REFERENCES TEMPORADA(nomSerie, numTemporada),
    FOREIGN KEY (nomUsuari) REFERENCES VALORADOR(nomUsuari)
);

-- Inserir dades de les sèries
INSERT INTO serie (`nomSerie`, `anyCreacio`, `descripcio`, `imatge`, `valoracioMitjana`) 
VALUES ('Friends', '1999', 'La història comença amb cinc amics (Chandler, Monica, Joey, Phoebe i Ross) conversant en una cafeteria i posteriorment el sisè (Rachel). 
Aquesta trobada dins de la cafeteria marca el començament d''una comèdia basada en l''amistat, els triomfs i caigudes, l''amor, el passat i el futur d''un grup d''
amics a la ciutat de Nova York. Rachel ve d''abandonar a l''altar a qui seria el seu marit i ha escapat de sa vida de nena rica per a entrar en un món on s''ha de 
fer càrrec de les seves pròpies necessitats, tot cercant el suport de la seva única amiga a la ciutat, Monica. Decideix restar al seu apartament i començar una vida normal. 
Ross, que sempre havia estat enamorat d''ella, troba una nova oportunitat de conquerir-la després del seu matrimoni fallit amb Carol. La seva tentativa no és en va, però, 
entre començaments i ruptures en Ross i la Rachel hauran d''esperar deu anys per a estar junts definitivament, passant per ses vides dues ruptures, una reconciliació, un casament, 
un divorci i una filla anomenada Emma.', 'Practica1/../img/friends.jpg', '8.80'), 
('Plats Bruts', '1999', 'El Lopes i el David (Joel Joan) són dos nois que comparteixen pis a l''Eixample de Barcelona. Anys enrere, el Lopes havia estat monitor del David, 
però aquest és l''únic vincle que tenen en comú, ja que no s''assemblen en res. Quan coincideixen en la visita del pis de lloguer, decideixen compartir-lo perquè es necessiten 
mútuament per tirar endavant', 'Practica1/../img/plats_bruts.jpg', '9.5');

-- Inserir dades de les temporades
INSERT INTO temporada (nomSerie, numTemporada, descripcio, imatge, valoracioMitjana) VALUES
('Friends', 1, 'La història comença amb cinc amics (Chandler, Monica, Joey, Phoebe i Ross) conversant en una cafeteria i posteriorment el sisè (Rachel). Aquesta trobada dins de la cafeteria marca el començament d´una comèdia basada en l´amistat, els triomfs i caigudes, l´amor, el passat i el futur d´un grup d´amics a la ciutat de Nova York. Rachel ve d´abandonar a l´altar a qui seria el seu marit i ha escapat de sa vida de nena rica per a entrar en un món on s´ha de fer càrrec de les seves pròpies necessitats, tot cercant el suport de la seva única amiga a la ciutat, Monica. Decideix restar al seu apartament i començar una vida normal. Ross, que sempre havia estat enamorat d´ella, troba una nova oportunitat de conquerir-la després del seu matrimoni fallit amb Carol. La seva tentativa no és en va, però, entre començaments i ruptures en Ross i la Rachel hauran d´esperar deu anys per a estar junts definitivament, passant per ses vides dues ruptures, una reconciliació, un casament, un divorci i una filla anomenada Emma.', '../img/friends1.png', 8.80),
('Friends', 2, 'La història comença amb cinc amics (Chandler, Monica, Joey, Phoebe i Ross) conversant en una cafeteria i posteriorment el sisè (Rachel). Aquesta trobada dins de la cafeteria marca el començament d´una comèdia basada en l´amistat, els triomfs i caigudes, l´amor, el passat i el futur d´un grup d´amics a la ciutat de Nova York. Rachel ve d´abandonar a l´altar a qui seria el seu marit i ha escapat de sa vida de nena rica per a entrar en un món on s´ha de fer càrrec de les seves pròpies necessitats, tot cercant el suport de la seva única amiga a la ciutat, Monica. Decideix restar al seu apartament i començar una vida normal. Ross, que sempre havia estat enamorat d´ella, troba una nova oportunitat de conquerir-la després del seu matrimoni fallit amb Carol. La seva tentativa no és en va, però, entre començaments i ruptures en Ross i la Rachel hauran d´esperar deu anys per a estar junts definitivament, passant per ses vides dues ruptures, una reconciliació, un casament, un divorci i una filla anomenada Emma.', '../img/friends2.png', 8.80),
('Plats Bruts', 1, 'El capítol comença ensenyant uns retalls de diari on s´explica que fa uns deu anys, un monitor, en Josep Lopes, va perdre durant una setmana un grup de nens al Matagalls, entre els quals hi havia el David Güell.', '../img/plats_bruts.jpg', 9.70),
('Plats Bruts', 2, 'S´han acabat les vacances i la Carbonell, el Pol, en Ramon i la Rosa tornen del Marroc i es troben a l´Emma palplantada al menjador sense saber quin dels dos escollir per sortir junts, si el Lopes o el David. La Carbonell li suggereix que els "tasti" abans de triar i finalment decideix sortir amb tots dos sense que ells ho sàpiguen. L´Emma és molt feliç però ben aviat comencen a aparèixer els problemes, ha de fer totes les coses dues vegades: dinar, sopar, anar de copes, fer l´amor...', '../img/plats1.png', 9.70),
('Plats Bruts', 3, 'La Carbonell i l´Oriol se n´han anat a viure a Porrera a fer vida de casats. Des que la Carbonell va marxar, el David s´ha quedat sense assistenta i està experimentant el fet d´haver-se d´espavilar a fer les coses tot sol. El David es rendeix i intenta buscar una nova assistenta. Quan el Lopes s´assabenta el David pagava 300.000 ptes a la Carbonell, s´ofereix voluntàriament a ser la nova dona de fer feines. El Lopes fa tota la feina de forma impecable però després d´uns quants dies, el David troba a faltar el Lopes com a amic. Per altra banda, el Pol està molt tou i susceptible per qualsevol cosa que li diuen. La resta d´amics intenten tractar-lo amb molt afecte però sense voler encara el fereixen més perquè és massa sensible. Finalment cau en una depressió molt greu i intenta suïcidar-se.', '../img/plats2.png', 9.70);

-- Inserir dades de les Usuaris
INSERT INTO usuari (`nomUsuari`, `contrasenya`, `tipus`, `numeroErrorsLogin`) 
VALUES ('admin', '1234', 'administrador', '3'), 
('valorador1', '1234', 'valorador', '3'), 
('valorador2', '1234', 'valorador', '3');

-- Inserir dades de les Valoradors
INSERT INTO valorador (`nomUsuari`, `nom`, `cognoms`, `imatge`, `email`) 
VALUES ('valorador1', 'Jordi', 'Sanchez Costa', '../usr_img/usr1.jpg', 'jcosta@udl.cat'), ('valorador2', 'Ignasi', 'Fornells', '../usr_img/usr2.jpeg', 'ifornells@udl.cat');

-- Inserir dades de les Valoracio
INSERT INTO valora (`nomSerie`, `numTemporada`, `nomUsuari`, `valor`, `comentari`) 
VALUES
('Friends', '1', 'valorador1', '9', 'Comentari del valorador 1'),
('Friends', '1', 'valorador2', '8', 'Comentari del valorador 2'),
('Friends', '2', 'valorador1', '7', 'Comentari del valorador 1'),
('Friends', '2', 'valorador2', '10', 'Comentari del valorador 2'),
('Plats Bruts', '1', 'valorador1', '2', 'Comentari del valorado1'),
('Plats Bruts', '1', 'valorador2', '3', 'Comentari del valorado2'),
('Plats Bruts', '2', 'valorador1', '1', 'Comentari del valorado1'),
('Plats Bruts', '2', 'valorador2', '6', 'Comentari del valorado2'),
('Plats Bruts', '3', 'valorador1', '5', 'Comentari del valorado1'),
('Plats Bruts', '3', 'valorador2', '0', 'Comentari del valorado2');

