-- SET DATEFORMAT ymd
-- SET IDENTITY_INSERT categories ON
INSERT INTO categories (id, name) VALUES
(1, 'A1'),
(2, 'A2'),
(3, 'A3'),
(4, 'B1'),
(5, 'B2'),
(6, 'C1'),
(7, 'C2'),
(8, 'D1'),
(9, 'D2');
-- SET IDENTITY_INSERT categories OFF

-- SET IDENTITY_INSERT classes ON
INSERT INTO classes (id, name, description) VALUES
(1, '1ère Classe', '1ère Classe'),
(2, '2ème Classe', '2ème Classe'),
(3, 'Classe Principale', 'Classe Principale'),
(4, 'Classe Exceptionnelle', 'Classe Exceptionnelle');
-- SET IDENTITY_INSERT classes OFF

-- SET IDENTITY_INSERT echelons ON
INSERT INTO echelons (id, name, description, classe_id) VALUES
(1, 'E1', '', 1),
(2, 'E2', '', 1),
(3, 'E3', '', 1),
(4, 'E1', '', 2),
(5, 'E2', '', 2),
(6, 'E3', '', 2),
(7, 'E4', '', 2),
(8, 'E1', '', 4),
(9, 'E2', '', 4),
(10, 'E3', '', 4),
(11, 'E4', '', 4),
(12, 'E1', '', 3),
(13, 'E2', '', 3),
(14, 'E3', '', 3);
-- SET IDENTITY_INSERT echelons OFF

INSERT INTO diplomes (name) VALUES
('Diplome'),
('AGREGATION' ),
('AIDE-COMPTABLE' ),
('ANALYSTE' ),
('ANALYSTE-PROGRAMMEUR' ),
('AUTRES (Certificat)'),
('BAC'),
('BAP BREVET D''APTITUDE P.'),
('BE BREVET ELEMENTAIRE'),
('BEP'),
('BEPC' ),
('BFP BREVET FORMAT° PROFES'),
('BREVET D''APTITUDE PROFES'),
('BREVET ENA ELEMENTAIRE' ),
('BSCII BREVET SUP CAPACITE'),
('BTEF' ),
('BTS'),
('CAEMPT' ),
('CAM CERT.APTITUDE MONIT'),
('CAP PEDAGOGIQUE INSTIT '),
('CAP/CEG'),
('CAP/EPS'),
('CAP/ET' ),
('CAP-COMPTABLE'),
('CAPES'),
('CEAP CERTIF.APT PEDAG.' ),
('CEP/FA FRANCO-ARABE'),
('CEPE' ),
('CFEN CERTIF DE FIN E.N' ),
('CFEPD CERTIFICAT P. ELEM.'),
('CTS CERTIT TECH SECRETARI'),
('DAFD DIP APT. DOCUMENTALI'),
('DAFPA'),
('DAP/CEG'),
('DAPAL'),
('DCPEPD' ),
('DCPES'),
('DEA'),
('DEMAG ADMI GENE ENA MOYEN'),
('DESS' ),
('DEUG 2' ),
('DFE/ENA'),
('DFEN DIPLOME DE FIN E.N'),
('DFEPT DIPLOM FIN ET PRO T'),
('DIEPD'),
('DINAS DIPLOME INAS' ),
('DIPLOM P/IFM/DAKAR' ),
('DIPLOM SUP ENA' ),
('DIPLOME D''APTITUDE PROF' ),
('DOCTORAT' ),
('DSGE' ),
('DUEL 2' ),
('DUES 2' ),
('DUT'),
('LICENCE'),
('MAITRISE' ),
('P.H.A'),
('PHD'),
('PROGRAMMEUR');

-- SET IDENTITY_INSERT ecole_formations ON
INSERT INTO ecole_formations (id, name) VALUES
(1, 'ENAM'),
(2, 'ENS'),
(3, 'IAI'),
(4, 'UAM'),
(5,'EN ZINDER'),
(6,'EN DOSSO'),
(7,'EN TILLABERY'),
(8,'EN TAHOUA '),
(9,'EMS'),
(10,'UMAD');
-- SET IDENTITY_INSERT ecole_formations OFF

INSERT INTO equivalence_diplomes (name) VALUES
('BEPC'),
('BEPC + 1'),
('BEPC + 2'),
('BAC'),
('BAC + 1'),
('BAC + 2'),
('BAC + 3'),
('BAC + 4'),
('BAC + 5'),
('BAC + 6'),
('BAC + 7'),
('BAC + 8');

-- SET IDENTITY_INSERT maladies ON
INSERT INTO maladies (id, name) VALUES
(1, 'Diabète'),
(2, 'Hypertension Artérielle');
-- SET IDENTITY_INSERT maladies OFF

-- SET IDENTITY_INSERT matrimoniales ON
INSERT INTO matrimoniales (id, name) VALUES
(1, 'Célibataire'),
(2, 'Marié(e)'),
(3, 'Divorcé(e)'),
(4, 'Veuf/Veuve');
-- SET IDENTITY_INSERT matrimoniales OFF

-- SET IDENTITY_INSERT niveau_etudes ON
INSERT INTO niveau_etudes (id, name) VALUES
(1, 'Primaire'),
(2, 'Moyen'),
(3, 'Secondaire'),
(4, 'Supérieur');
-- SET IDENTITY_INSERT niveau_etudes OFF

INSERT INTO users (name, password, role, created_at, updated_at) VALUES
('admin', '$2y$10$GPIX1QXCQq6cw2Zh6XKd/OOYTg9bzRlLEOWKsdJVdb0dQWnVuFUEW', 'Administrateur', NULL, NULL);


INSERT INTO cadres (abreviation, name) VALUES
('AD','ADMINIST.GENER.'),
('AG','AGRICULTURE'),
('CD','CADRE DIPLOMAT.CONS'),
('CN','CONTRIB.DIVERS.'),
('DO','DOM.ENREG.TIMB.'),
('DN','DOUANES'),
('EF','EAUX ET FORETS'),
('EL','ELEV.IND.ANIM.'),
('EN','ENSEIGN.PR.DEG.'),
('EN','ENSEIGN.SE.DEG.'),
('G.','GENIE RURAL'),
('GP','GARDE PRESIDENT'),
('GR','GARDE REPUBLIC.'),
('IN','INFORMATION'),
('JS','JEUNESSE SPORTS'),
('JU','JUSTICE'),
('MT','METEOROLOGIE'),
('NA','NAVIGAT.AERIEN.'),
('OR','ORTN'),
('PT','POSTE TELECOM.'),
('PR','PROMOT.HUMAINE'),
('SA','SANTE ACT.SOCI.'),
('SE','SECRETARIAT'),
('ST','STAT.ETUD.ECON.'),
('SU','SURETE NATION.'),
('TO','TOPOG.CADASTRE'),
('TS','TRAV.M.O.SEC.S.'),
('TP','TRAV.PUBL.MINES'),
('TR','TRESOR'),
('CC','CONV.COLL.INTER'),
('R.','REGLEMENT INTER'),
('CH','CHEF TRADITIONNEL'),
('CT','CONTRACTUEL');


INSERT INTO corps (abreviation, name, category_id) VALUES
('ING.PRL.','INGEN.PRINCIP.',1),
('ING.SAN.','INGEN.SANIT.',1),
('ING.TRAV','INGEN.DES TRAV.',2),
('ING.TECH','INGEN.DES TECHN',1),
('AUTRE CO','AUTRE CORPS',6),
('INSPECT.','INSPECTEUR',1),
('INSP.ADJ','INSPECTEUR ADJ.',2),
('INSP.CTR','INSPECT.CENTR.',1),
('INSP.PPL','INSPECT.PRINC.',1),
('INSP.POL','INSPECTEUR DE POLICE',2),
('INSTIT. ','INSTITUTEUR',4),
('INST.ADJ','INSTIT.ADJOINT',6),
('INSTR.PO','INSTR.EDUC.POPU.',3),
('INTERP. ','INTERPRETE',5),
('LIC.SOIN','LICENCIE SOINS',2),
('LIC.ACTS','LICENC.ACT.SOC.',2),
('MAIT.EPS','MAITRE E.P.S.',5),
('MEDECIN ','MEDECIN',1),
('MED.AST.','MEDECIN ASSIST.',2),
('MONITEUR','MONITEUR',8),
('MONIT.A.','MONITEUR ADJ.',9),
('OFF.POL.','OFFIC.POLICE',2),
('DACTYLO.','DACTYLOGRAPHE',8),
('TS EAUXF','TECH SUP EAUX FORETS',2);


INSERT INTO fonctions (name) VALUES
('REDACTEUR CHEF'),
('REDACTEUR ADJ.'),
('REDACT. ARABE'),
('REPORTER'),
('REPORTER ADJ.'),
('REPORTER PHOTO'),
('RESP.TRAV.COMM.'),
('RONEOTYPISTE'),
('RELIEUR'),
('CF DPX'),
('SECR.GEN PREF.'),
('S.G.ADJ.PREF.'),
('SECR.GEN.MIN.'),
('PREM.SECR. AMBASSADE'),
('DEUX.SECR. AMBASSADE'),
('SAGE-FEMME BREV'),
('SAGE-FEMME D.E.'),
('SCENARISTE'),
('SECRETAIRE'),
('SECR. DIRECTION'),
('SECR.REDACTION'),
('SECR. STENODACT'),
('SOUS-PREFET'),
('STATISTICIEN'),
('STENODACTYLO'),
('SURVEILLANT'),
('SURVEILLANT GENERAL'),
('TECHNICIEN'),
('TECHN.ASSAINIS-'),
('TECHN.ACT.SOC.'),
('TELEPHONISTE'),
('TOLIER-SOUDEUR'),
('VETERINAIRE'),
('DIRECT.ECOLE (1-3CL)'),
('DIRECT.ECOLE (4-6CL)'),
('DIRECT.ECOLE (+-6CL)'),
('CF DPX'),
('CF DPX'),
('CF DPX'),
('CF DPX'),
('CF DPX'),
('CF DPX'),
('REDACTEUR'),
('INTENDANT-ECONOME'),
('INSTITUTEUR'),
('INSTIT. ADJOINT'),
('INSTR.EDUC.POPU'),
('INTERPRETE'),
('JARDINIER'),
('JOURNALISTE'),
('LICENCIE SOINS'),
('LICENC.ACT.SOC.'),
('LINGERE'),
('LYCEE T. CHEF TRAV.'),
('MACON'),
('MAGASINIER'),
('MAGISTRAT'),
('MAITRE E.P.S.'),
('MAITRE HOTEL'),
('MANOEUVRE'),
('MANUTENTION.'),
('MAQUETTISTE'),
('MATRONE'),
('MEDECIN'),
('MEDECIN ASSIST.'),
('MECANICIEN'),
('MENUISIER'),
('METT. EN SCENE'),
('MONITEUR'),
('MONITEUR ADJ.'),
('MONTEUR FILM'),
('MEMB.GOUVERN.'),
('CF DPX'),
('OFFIC. POLICE'),
('OPERATEUR'),
('OUVRIER'),
('PEINTRE'),
('PEPINIERISTE'),
('PERCEPTEUR'),
('PERFO/VERIF.'),
('PHARMACIEN'),
('PHOTOGRAPHE'),
('PILEUSE'),
('PILOTE'),
('PIROGUIER'),
('PISTEUR'),
('PLANTON'),
('PLOMBIER'),
('PREFET'),
('PREMIER SECRET.'),
('PRENEUR DE SON'),
('PREPOSE'),
('PROFESSEUR'),
('PROFESSEUR CEG'),
('PROGRAMMEUR'),
('PEDAGOGUE'),
('PROVISEUR LYCEE'),
('REALISATEUR'),
('INSPECTEUR 2ND DEGRE'),
('DIRECT.DE PRODU'),
('DIRECT.CENTRAL'),
('DIRECTEUR ECOLE PRIM'),
('DIRECTEUR CEG - CN.'),
('DIRECTEUR ECOLE NORM'),
('DIRECTEUR LYCEE TECH'),
('DIRECTEUR DES ETUDES'),
('DOCUMENTALISTE'),
('DOMESTIQUE'),
('DOCTEUR'),
('DOCT.SC.SOC.APP'),
('ELECTRICIEN'),
('ELEVE-GARDE'),
('ENTRAINEUR'),
('ENQUET.DE PECHE'),
('FILLE DE SALLE'),
('FORGERON'),
('FRIGORISTE'),
('GARCON DE BUR.'),
('GARCON DE SALLE'),
('GARDE'),
('GARDE FORESTIER'),
('GARDE FRONTIERE'),
('GARDIEN'),
('GARDIEN DE PAIX'),
('GENDARME'),
('GEOMETRE'),
('GEOMETRE ADJ.'),
('GOUMIER'),
('GRAISSEUR'),
('GRAND CHANCEL.'),
('GRAND REPORTER'),
('GREFFIER ADJ.'),
('GREF.ATT.PARQ.'),
('GEOLOGUE'),
('SOUS-SECR AFF.ETR.'),
('SECRT.ADJ AFF.ETR.'),
('HUISSIER'),
('INFIRMIER'),
('INFIRMIER D.E.'),
('INGENIEUR'),
('INGEN.GEOMETRE'),
('INGEN.GEOM.ADJ'),
('INGEN.PRINCIP.'),
('INGEN.SANIT.'),
('INGEN. DES TRAV'),
('INGEN DES TECH'),
('INSPECTEUR'),
('INSPECT. ADJ.'),
('INSPECT. CENTR.'),
('INSPECT. CHEF'),
('INSPECT. POLICE'),
('INSPECT. PRINC.'),
('INSPECT.D''ETAT'),
('INSPECTEUR 1ER DEGRE'),
('DIRECT.DE PHOTO'),
('BRIGADIER CHEF'),
('BRIGADIER POLIC'),
('BOULANGER'),
('CAPORAL'),
('CAPORAL CHEF'),
('CAMERAMAN'),
('CHAINEUR'),
('CHANCELIER'),
('CHARGE DE COURS'),
('CHARGE DE DIFFU'),
('CHAUFFEUR'),
('CHEF DE BUREAU'),
('CHEF DE CABINET'),
('CHEF D''EQUIPE'),
('CHEF DE DIVIS.'),
('CHEF DE RUBRIQ.'),
('CHEF RELAT.EXT.'),
('CHEF DE SECTION'),
('CHEF DE CANTON'),
('CHEF DE VILLAGE'),
('CHEFDEPOSTE'),
('CHEF DE PROVINCE'),
('BUANDIER'),
('CINEASTE'),
('CINEMATHECAIRE'),
('COMMIS'),
('COMMISSAIRE'),
('CONDUCTEUR'),
('CONSEILLER AMBASSADE'),
('CONTROLEUR'),
('CONTROLEUR ADJ.'),
('CONTR.DIVISION.'),
('COMPTABLE'),
('CUISINIER'),
('CONSUL'),
('CHANCELIER'),
('COUTURIERE'),
('CONSEIL. FORESTIER'),
('CONSEILLER AGRICOLE'),
('CONSEILLER'),
('CHEF PROTOCOLE'),
('CENSEUR LYCEE'),
('DACTYLO'),
('DENTISTE'),
('DESSINATEUR'),
('DEVELOPPEUR'),
('DEVELOPPEUR ADJ'),
('DIRECTEUR'),
('DIRECT.ADJOINT'),
('DIRECT.ADMINIST'),
('DIRECT.ARTISTIQ'),
('DIRECT.DE CABIN'),
('DIRECT.DE CINEM'),
('DIRECT.DE LABOR'),
('DIRECT. M.J.C.'),
('BRIGADIER'),
('ADJOINT ADMINIS'),
('ADJOINT TECHNIQ'),
('ADJOINT PREFET'),
('ADJ. SOUS-PREF.'),
('ADJUDANT'),
('ADJUDANT-CHEF'),
('AGENT ADMINISTR'),
('AGENT ASSIETTE'),
('AGENT DE BUREAU'),
('AGENT DE DIFFUS'),
('AGENT ENCADREM.'),
('AGENT EXECUTION'),
('AGENT CONSTAT.'),
('AGENT HYGIENE'),
('AGENT INFORMAT.'),
('AGENT MAITRISE'),
('AGENT METEO'),
('AGENT ORTN'),
('AGENT P.T.T.'),
('AGENT DE POLICE'),
('AGENT DE RECOUV.'),
('AGENT TECHNIQUE'),
('AIDE DESSINAT.'),
('AIDE DEVELOPP.'),
('AIDE DOCUMENT.'),
('AIDE ECLAIRAG.'),
('AIDE FILMOTHEC.'),
('AIDE GEOMETRE'),
('AIDE OPERATEUR'),
('AIDE PHOTOTEC.'),
('AIDE PROJECTION'),
('AIDE REDACTEUR'),
('CF DPX'),
('AIDE REPORTER'),
('AIDE TIREUR'),
('AIDE ASSIST.SOC.'),
('CF DPX'),
('AMBASSADEUR'),
('ANALYSTE'),
('ARCHIVISTE'),
('ASSESSEUR'),
('ASSISTANT'),
('ASSIST. ADJOINT'),
('ASSIST. PROVIS.'),
('ASSIST. REDACT.'),
('ASSIST. REGISS.'),
('ASSIST. REPORT.'),
('ASSIST. SCRIPT'),
('ASSIST. SECRET.'),
('CF DPX'),
('ATTACHE AMBASS.'),
('ATTACHE PRESSE'),
('BERGER'),
('BIBLIOTHECAIRE'),
('BOURRELIER'),
('BOY');


INSERT INTO positions (name) VALUES
('EN ACTIVITE'),
('CONGE ANN.S.SOLDE'),
('CONGE PAYE ANNUEL'),
('DEMISSIONS'),
('STAGE PROFESSIONNEL'),
('STAGIAIRE'),
('DISPONIBILITE'),
('DETACHEMENT'),
('HORS CADRE'),
('SOUS LES DRAPEAUX'),
('RETRAITE'),
('SUSPENDU'),
('DECEDE'),
('CONGE DE MALADIE'),
('CONGE DE MATERNITE'),
('CONGE SANS SOLDE'),
('LICENCIE'),
('DEPART P.A.I.P.C.E.'),
('CONGE LONGUE DUREE'),
('CONGE MALADIE SERVICE'),
('CONGE MALADI.ACT.DEV'),
('EN ATTENTE NOMINAT'),
('REVOQUE'),
('STATUT SPECIAL'),
('SUSPENDU DEMI-SALAIRE'),
('ABANDON DE POSTE'),
('TRANSFERT AUX. COLL.'),
('ERREUR DE SAISIE');


INSERT INTO indices(category_id,classe_id,echelon_id,name,value,salary)VALUES
(9,2,4,'D2C2E1',121,'42148'),
(9,2,5,'D2C2E2',132,'45980'),
(9,2,6,'D2C2E3',143,'49812'),
(9,2,7,'D2C2E4',154,'53643'),
(8,2,4,'D1C2E1',132,'45980'),
(8,2,5,'D1C2E2',143,'49812'),
(8,2,6,'D1C2E3',154,'53643'),
(8,2,7,'D1C2E4',165,'57475'),
(7,2,4,'C2C2E1',165,'57475'),
(7,2,5,'C2C2E2',176,'61307'),
(7,2,6,'C2C2E3',187,'65138'),
(7,2,7,'C2C2E4',198,'68970'),
(6,2,4,'C1C2E1',193,'67228'),
(6,2,5,'C1C2E2',204,'71060'),
(6,2,6,'C1C2E3',215,'74892'),
(6,2,7,'C1C2E4',226,'78723'),
(5,2,4,'B2C2E1',238,'82903'),
(5,2,5,'B2C2E2',235,'81858'),
(5,2,6,'B2C2E3',250,'87083'),
(5,2,7,'B2C2E4',265,'92308'),
(4,2,4,'B1C2E1',270,'94050'),
(4,2,5,'B1C2E2',286,'99623'),
(4,2,6,'B1C2E3',302,'105197'),
(4,2,7,'B1C2E4',319,'111118'),
(3,2,4,'A3C2E1',289,'100668'),
(3,2,5,'A3C2E2',315,'109725'),
(3,2,6,'A3C2E3',341,'118782'),
(3,2,7,'A3C2E4',368,'128187'),
(2,2,4,'A2C2E1',315,'109725'),
(2,2,5,'A2C2E2',341,'118782'),
(2,2,6,'A2C2E3',368,'128187'),
(2,2,7,'A2C2E4',394,'137243'),
(1,2,4,'A1C2E1',394,'137243'),
(1,2,5,'A1C2E2',436,'151873'),
(1,2,6,'A1C2E3',478,'166503'),
(1,2,7,'A1C2E4',520,'181133'),
(9,1,1,'D2C1E1',176,'61307'),
(9,1,2,'D2C1E2',187,'65138'),
(9,1,3,'D2C1E3',198,'68970'),
(8,1,1,'D1C1E1',193,'67228'),
(8,1,2,'D1C1E2',204,'71060'),
(8,1,3,'D1C1E3',215,'74892'),
(7,1,1,'C2C1E1',226,'78723'),
(7,1,2,'C2C1E2',237,'82555'),
(7,1,3,'C2C1E3',248,'86387'),
(6,1,1,'C1C1E1',259,'90218'),
(6,1,2,'C1C1E2',270,'94050'),
(6,1,3,'C1C1E3',281,'97882'),
(5,1,1,'B2C1E1',295,'102758'),
(5,1,2,'B2C1E2',310,'107983'),
(5,1,3,'B2C1E3',325,'113208'),
(4,1,1,'B1C1E1',362,'126097'),
(4,1,2,'B1C1E2',378,'131670'),
(4,1,3,'B1C1E3',394,'137243'),
(3,1,1,'A3C1E1',410,'142817'),
(3,1,2,'A3C1E2',436,'151873'),
(3,1,3,'A3C1E3',462,'160930'),
(2,1,1,'A2C1E1',473,'164762'),
(2,1,2,'A2C1E2',499,'173818'),
(2,1,3,'A2C1E3',525,'182875'),
(1,1,1,'A1C1E1',599,'208652'),
(1,1,2,'A1C1E2',641,'223282'),
(1,1,3,'A1C1E3',683,'237912'),
(9,3,12,'D2CPE1',220,'76633'),
(9,3,13,'D2CPE2',231,'80465'),
(9,3,14,'D2CPE3',242,'84297'),
(8,3,12,'D1CPE1',242,'84297'),
(8,3,13,'D1CPE2',253,'88128'),
(8,3,14,'D1CPE3',264,'91960'),
(7,3,12,'C2CPE1',275,'95792'),
(7,3,13,'C2CPE2',286,'99623'),
(7,3,14,'C2CPE3',297,'103455'),
(6,3,12,'C1CPE1',314,'109377'),
(6,3,13,'C1CPE2',325,'113208'),
(6,3,14,'C1CPE3',336,'117040'),
(5,3,12,'B2CPE1',355,'123658'),
(5,3,13,'B2CPE2',370,'128883'),
(5,3,14,'B2CPE3',385,'134108'),
(4,3,12,'B1CPE1',437,'152222'),
(4,3,13,'B1CPE2',454,'158143'),
(4,3,14,'B1CPE3',470,'163717'),
(3,3,12,'A3CPE1',504,'175560'),
(3,3,13,'A3CPE2',530,'184617'),
(3,3,14,'A3CPE3',557,'194022'),
(2,3,12,'A2CPE1',604,'210393'),
(2,3,13,'A2CPE2',630,'219450'),
(2,3,14,'A2CPE3',656,'228507'),
(1,3,12,'A1CPE1',761,'265082'),
(1,3,13,'A1CPE2',803,'279712'),
(1,3,14,'A1CPE3',845,'294342'),
(9,4,8,'D2CEE1',264,'91960'),
(9,4,9,'D2CEE2',275,'95792'),
(9,4,10,'D2CEE3',286,'99623'),
(9,4,11,'D2CEE4',297,'103455'),
(8,4,8,'D1CEE1',292,'101713'),
(8,4,9,'D1CEE2',303,'105545'),
(8,4,10,'D1CEE3',314,'109377'),
(8,4,11,'D1CEE4',325,'113208'),
(7,4,8,'C2CEE1',325,'113208'),
(7,4,9,'C2CEE2',336,'117040'),
(7,4,10,'C2CEE3',347,'120872'),
(7,4,11,'C2CEE4',358,'124703'),
(6,4,8,'C1CEE1',369,'128535'),
(6,4,9,'C1CEE2',380,'132367'),
(6,4,10,'C1CEE3',391,'136198'),
(6,4,11,'C1CEE4',402,'140030'),
(5,4,8,'B2CEE1',415,'144558'),
(5,4,9,'B2CEE2',430,'149783'),
(5,4,10,'B2CEE3',445,'155008'),
(5,4,11,'B2CEE4',460,'160233'),
(4,4,8,'B1CEE1',513,'178695'),
(4,4,9,'B1CEE2',529,'184268'),
(4,4,10,'B1CEE3',545,'189842'),
(4,4,11,'B1CEE4',562,'195763'),
(3,4,8,'A3CEE1',599,'208652'),
(3,4,9,'A3CEE2',625,'217708'),
(3,4,10,'A3CEE3',651,'226765'),
(3,4,11,'A3CEE4',677,'235822'),
(2,4,8,'A2CEE1',735,'256025'),
(2,4,9,'A2CEE2',761,'265082'),
(2,4,10,'A2CEE3',788,'274487'),
(2,4,11,'A2CEE4',814,'283543'),
(1,4,8,'A1CEE1',924,'321860'),
(1,4,9,'A1CEE2',966,'336490'),
(1,4,10,'A1CEE3',1008,'351120'),
(1,4,11,'A1CEE4',1050,'365750');

-- SET IDENTITY_INSERT regions ON
INSERT INTO regions (id, name) VALUES
(1,'Agadez'),
(2,'Diffa'),
(3,'Dosso'),
(4,'Maradi'),
(5,'Tahoua'),
(6,'Tillaberi'),
(7,'Zinder'),
(8,'Niamey');
-- SET IDENTITY_INSERT regions OFF

-- SET IDENTITY_INSERT departements ON
INSERT INTO departements (id,name,region_id)VALUES
(101,'Aderbissinat',1),
(102,'Arlit',1),
(103,'Bilma',1),
(104,'Iferouane',1),
(105,'Ingall',1),
(106,'Tchirozerine',1),
(201,'Bosso',2),
(202,'Diffa',2),
(203,'Goudoumaria',2),
(204,'Maine-Soroa',2),
(205,'N''Gourti',2),
(206,'N''Guigmi',2),
(301,'Boboye',3),
(302,'Dioundiou',3),
(303,'Dogondoutchi',3),
(304,'Dosso',3),
(305,'Falmey',3),
(306,'Gaya',3),
(307,'Loga',3),
(308,'Tibiri (Doutchi)',3),
(401,'Aguie',4),
(402,'Bermo',4),
(403,'Dakoro',4),
(404,'Gazaoua',4),
(405,'Guidan-Roumdji',4),
(406,'Madarounfa',4),
(407,'Mayahi',4),
(408,'Tessaoua',4),
(490,'Ville De Maradi',4),
(501,'Abalak',5),
(502,'Bagaroua',5),
(503,'BirniN''Konni',5),
(504,'Bouza',5),
(505,'Illela',5),
(506,'Keita',5),
(507,'Madaoua',5),
(508,'Malbaza',5),
(509,'Tahoua',5),
(510,'Tassara',5),
(511,'Tchintabaraden',5),
(512,'Tillia',5),
(590,'Ville De Tahoua',5),
(601,'Abala',6),
(602,'Ayerou',6),
(603,'Balleyara',6),
(604,'Banibangou',6),
(605,'Bankilare',6),
(606,'Filingue',6),
(607,'Gotheye',6),
(608,'Kollo',6),
(609,'Ouallam',6),
(610,'Say',6),
(611,'Tera',6),
(612,'Tillaberi',6),
(613,'Torodi',6),
(701,'Belbedji',7),
(702,'Damagaram Takaya',7),
(703,'Dungass',7),
(704,'Goure',7),
(705,'Kantche',7),
(706,'Magaria',7),
(707,'Mirriah',7),
(708,'Takeita',7),
(709,'Tanout',7),
(710,'Tesker',7),
(711,'BIRNI''NKAZOE',7),
(790,'Ville De Zinder',7),
(890,'Ville De Niamey',8);
-- SET IDENTITY_INSERT departements OFF

-- SET IDENTITY_INSERT communes ON
INSERT INTO communes (id,name,departement_id) VALUES
(10101,'Aderbissinat',101),
(10201,'Arlit',102),
(10202,'Dannet',102),
(10203,'Gougaram',102),
(10301,'Bilma',103),
(10302,'Dirkou',103),
(10303,'Djado',103),
(10304,'Fachi',103),
(10401,'Iferouane',104),
(10402,'Timia',104),
(10501,'Ingall',105),
(10601,'Agadez',106),
(10602,'Dabaga',106),
(10603,'Tabelot',106),
(10604,'Tchirozerine',106),
(20101,'Bosso',201),
(20102,'Toumour',201),
(20201,'Chetimari',202),
(20202,'Diffa',202),
(20203,'Gueskerou',202),
(20301,'Goudoumaria',203),
(20401,'Foulatari',204),
(20402,'MaineSoroa',204),
(20403,'N''Guelbely',204),
(20501,'N''Gourti',205),
(20601,'Kablewa',206),
(20602,'N''Guigmi',206),
(30100,'Boboye',301),
(30101,'BirniN''Gaoure',301),
(30102,'Fabidji',301),
(30103,'Fakara',301),
(30104,'Harikanassou',301),
(30105,'Kankandi',301),
(30106,'Kiota',301),
(30107,'Koygolo',301),
(30108,'N''Gonga',301),
(30201,'Dioundiou',302),
(30202,'Karakara',302),
(30203,'Zabori',302),
(30301,'Dan-Kassari',303),
(30302,'Dogondoutchi',303),
(30303,'Dogonkiria',303),
(30304,'Kieche',303),
(30305,'Matankari',303),
(30306,'Soucoucoutane',303),
(30401,'Dosso',304),
(30402,'Farey',304),
(30403,'Garankedey',304),
(30404,'Golle',304),
(30405,'Goroubankassam',304),
(30406,'Karguibangou',304),
(30407,'Mokko',304),
(30408,'Sambera',304),
(30409,'Tessa',304),
(30410,'TombokoireyI',304),
(30411,'TombokoireyII',304),
(30501,'Falmey',305),
(30502,'Guilladje',305),
(30601,'Bana',306),
(30602,'Bengou',306),
(30603,'Gaya',306),
(30604,'Tanda',306),
(30605,'Tounouga',306),
(30606,'Yelou',306),
(30701,'Falwel',307),
(30702,'Loga',307),
(30703,'Sokorbe',307),
(30801,'Doumega',308),
(30802,'Guecheme',308),
(30803,'Kore Mairoua',308),
(30804,'Tibiri (Doutchi)',308),
(40101,'Aguie',401),
(40102,'Tchadoua',401),
(40201,'Bermo',402),
(40202,'Gadabedji',402),
(40301,'Adjekoria',403),
(40302,'Azagor',403),
(40303,'Bader Goula',403),
(40304,'Birni Lalle',403),
(40305,'Dakoro',403),
(40306,'Dan-Goulbi',403),
(40307,'Korahane',403),
(40308,'Kornaka',403),
(40309,'Maiyara',403),
(40310,'Roumbou I',403),
(40311,'Sabon Machi',403),
(40312,'Tagriss',403),
(40401,'Gangara (Aguie)',404),
(40402,'Gazaoua',404),
(40501,'Chadakori',405),
(40502,'Guidan Roumdji',405),
(40503,'Guidan Sori',405),
(40504,'Sae Saboua',405),
(40505,'Tibiri (Maradi)',405),
(40601,'Dan-Issa',406),
(40602,'Djiratawa',406),
(40603,'Gabi',406),
(40604,'Madarounfa',406),
(40605,'Safo',406),
(40606,'Sarkin Yamma',406),
(40701,'Attantane',407),
(40702,'El Allassane Maireyrey',407),
(40703,'Guidan Amoumoune',407),
(40704,'Issawane',407),
(40705,'Kanan-Bakache',407),
(40706,'Mayahi',407),
(40707,'Sarkin Haoussa',407),
(40708,'Tchake',407),
(40801,'Baoudetta',408),
(40802,'Hawandawaki',408),
(40803,'Koona',408),
(40804,'Korgom',408),
(40805,'Maijirgui',408),
(40806,'Ourafane',408),
(40807,'Tessaoua',408),
(49001,'Maradi Arrondissement1',490),
(49002,'Maradi Arrondissement2',490),
(49003,'Maradi Arrondissement3',490),
(50101,'Abalak',501),
(50102,'Akoubounou',501),
(50103,'Azeye',501),
(50104,'Tabalak',501),
(50105,'Tamaya',501),
(50201,'Bagaroua',502),
(50301,'Allela',503),
(50302,'Bazaga',503),
(50303,'BirniN''Konni',503),
(50304,'Tsernaoua',503),
(50401,'Allakaye',504),
(50402,'Babankatami',504),
(50403,'Bouza',504),
(50404,'Deoule',504),
(50405,'Karofane',504),
(50406,'Tabotaki',504),
(50407,'Tama',504),
(50501,'Badaguichiri',505),
(50502,'Illela',505),
(50503,'Tajae',505),
(50601,'Garhanga',506),
(50602,'Ibohamane',506),
(50603,'Keita',506),
(50604,'Tamaske',506),
(50701,'Azarori',507),
(50702,'Bangui',507),
(50703,'Galma Koudawatche',507),
(50704,'Madaoua',507),
(50705,'Ourno',507),
(50706,'Sabon Guida',507),
(50801,'Doguerawa',508),
(50802,'Malbaza',508),
(50901,'Affala',509),
(50902,'Bambeye',509),
(50903,'Barmou',509),
(50904,'Kalfou',509),
(50905,'Takanamat',509),
(50906,'Tebaram',509),
(51001,'Tassara',510),
(51101,'Kao',511),
(51102,'Tchintabaraden',511),
(51201,'Tillia',512),
(59001,'Tahoua Arrondissement1',590),
(59002,'Tahoua Arrondissement2',590),
(60101,'Abala',601),
(60102,'Sanam',601),
(60201,'Ayerou',602),
(60202,'Inates',602),
(60301,'Tagazar',603),
(60302,'Balleyara',603),
(60401,'Banibangou',604),
(60501,'Bankilare',605),
(60601,'Filingue',606),
(60602,'Imanan',606),
(60603,'Kourfeye Centre',606),
(60604,'Tondikandia',606),
(60605,'Damana',606),
(60701,'Dargol',607),
(60702,'Gotheye',607),
(60801,'Bitinkodji',608),
(60802,'Diantchandou',608),
(60803,'Hamdallaye',608),
(60804,'Karma',608),
(60805,'Kirtachi',608),
(60806,'Kollo',608),
(60807,'Koure',608),
(60808,'Libore',608),
(60809,'Namaro',608),
(60810,'N''Dounga',608),
(60811,'Youri',608),
(60901,'Dingazi',609),
(60902,'Ouallam',609),
(60903,'Simiri',609),
(60904,'Tondikiwindi',609),
(61001,'Ouro Gueladjo',610),
(61002,'Say',610),
(61003,'Tamou',610),
(61101,'Diagourou',611),
(61102,'Gorouol',611),
(61103,'Kokorou',611),
(61104,'Mehana',611),
(61105,'Tera',611),
(61201,'Anzourou',612),
(61202,'Bibiyergou',612),
(61203,'Dessa',612),
(61204,'Kourteye',612),
(61205,'Sakoira',612),
(61206,'Sinder',612),
(61207,'Tillaberi',612),
(61301,'Makalondi',613),
(61302,'Torodi',613),
(70101,'Tarka',701),
(70201,'Albarkaram',702),
(70202,'Damagaram Takaya',702),
(70203,'Guidimouni',702),
(70204,'Mazamni',702),
(70205,'Moa',702),
(70206,'Wame',702),
(70301,'Dogo-Dogo',703),
(70302,'Dungass',703),
(70303,'Gouchi',703),
(70304,'Malawa',703),
(70401,'Alakoss',704),
(70402,'Boune',704),
(70403,'Gamou',704),
(70404,'Goure',704),
(70405,'Guidiguir',704),
(70406,'Kelle',704),
(70501,'DanBarto',705),
(70502,'Daouche',705),
(70503,'Doungou',705),
(70504,'Ichirnawa',705),
(70505,'Kantche',705),
(70506,'Kourni',705),
(70507,'Matamey',705),
(70508,'Tsaouni',705),
(70509,'Yaouri',705),
(70601,'Bande',706),
(70602,'Dantchiao',706),
(70603,'Kwaya',706),
(70604,'Magaria',706),
(70605,'Sassoumbroum',706),
(70606,'Wacha',706),
(70607,'Yekoua',706),
(70701,'Dogo',707),
(70702,'Droum',707),
(70703,'Gaffati',707),
(70704,'Gouna',707),
(70705,'Hamdara',707),
(70706,'Kolleram',707),
(70707,'Mirriah',707),
(70708,'Zermou',707),
(70801,'Dakoussa',708),
(70802,'Garagoumsa',708),
(70803,'Tirmini',708),
(70804,'TAKEITA',708),
(70901,'Falenko',709),
(70902,'Gangara (Tanout)',709),
(70903,'Ollelewa',709),
(70904,'Tanout',709),
(70905,'Tenhya',709),
(71001,'Tesker',710),
(71101,'BIRNI''NKAZOE',711),
(79001,'Zinder Arrondissement 1',790),
(79002,'Zinder Arrondissement 2',790),
(79003,'Zinder Arrondissement 3',790),
(79004,'Zinder Arrondissement 4',790),
(79005,'Zinder Arrondissement 5',790),
(89001,'Niamey Arrondissement 1',890),
(89002,'Niamey Arrondissement 2',890),
(89003,'Niamey Arrondissement 3',890),
(89004,'Niamey Arrondissement 4',890),
(89005,'Niamey Arrondissement 5',890);
-- SET IDENTITY_INSERT communes OFF

-- SET IDENTITY_INSERT inspections ON
INSERT INTO inspections (id, name, commune_id) VALUES
(1,'INSPECTION 1',89001),
(2,'INSPECTION 2',89001),
(3,'INSPECTION 3',89001),
(4,'INSPECTION 4',89001),
(5,'INSPECTION 5',89001);
-- SET IDENTITY_INSERT inspections OFF

INSERT INTO secteur_pedagogiques (name, inspection_id) VALUES
('SECTEUR 1',1),
('SECTEUR 2',1),
('SECTEUR 1',2),
('SECTEUR 2',2),
('SECTEUR 1',3),
('SECTEUR 2',3),
('SECTEUR 1',4),
('SECTEUR 2',4),
('SECTEUR 1',5),
('SECTEUR 2',5);

-- SET IDENTITY_INSERT type_etablissements ON
INSERT INTO type_etablissements (id,name) VALUES
(1,'Prés scolaire'),
(2,'Primaire'),
(3,'Collège'),
(4,'Lycées'),
(5,'CES');
-- SET IDENTITY_INSERT type_etablissements OFF

-- SET IDENTITY_INSERT etablissements ON
INSERT INTO etablissements (id,name,secteur_pedagogique_id,type_etablissement_id) VALUES
(100004,'J/E TCHARMEY',1,2),
(101003,'MEDERSA AGADEZ',2,1),
(101011,'EXP. BILINGUE AGADEZ',3,3),
(101013,'MEDERSA ELHADJI HAMI II',4,5),
(109700,'DREN AGADEZ',5,3),
(109701,'IECBII/M AGADEZ',6,3),
(109702,'IEB AGADEZ COMMUNE',7,5);
-- SET IDENTITY_INSERT etablissements OFF

-- SET IDENTITY_INSERT agents ON
INSERT INTO agents (id, matricule, nom, prenom, date_naiss, lieu_naiss, ref_acte_naiss, date_etablissement_acte_naiss, lieu_etablissement_acte_naiss, sexe, nationnalite, cadre_id, corp_id, type, fonction_id, date_prise_service, created_at, updated_at, deleted_at) VALUES
(1, '100859', 'MAMANE', 'Balkissa', '1983-12-21', 'Dosso', 'XXXX', '1983-12-28', 'Dosso', 'F', 'Nigérienne', 9, 12, 'Contractuel', 23, '2005-10-01', '2019-06-01 23:12:44', '2019-06-01 23:14:26', NULL),
(2, '0106651A', 'ABDOU', 'HAROUNA', '1980-12-31', 'GOGE/MALBAZA', 'XXX', '1981-01-05', 'GOGE/MALBAZA', 'M', 'Nigérienne', 9, 11, 'Titulaire', 45, NULL, '2019-06-01 23:23:32', '2019-06-01 23:23:32', NULL),
(3, '100942', 'MAHAMADOU', 'ISSA', '1987-02-21', 'Niamey', 'XXXX', '1987-02-28', 'Niamey', 'M', 'Nigérienne', 13, 17, 'Contractuel', 42, '2008-11-01', '2019-06-02 23:12:44', '2019-06-02 23:14:26', NULL),
(4, '0106661B', 'ALI', 'INOUSSA', '1981-11-10', 'Tillabéry', 'XXX', '1981-11-25', 'Tillabéry', 'M', 'Nigérienne', 1, 8, 'Titulaire', 35, NULL, '2019-05-30 23:23:32', '2019-05-31 23:23:32', NULL),
(5, '0104631C', 'ISSAKA', 'Ousmane', '1979-04-15', 'Tahoua', 'XXX', '1979-11-15', 'Tahoua', 'M', 'Nigérienne', 4, 3, 'Titulaire', 15, NULL, '2019-05-31 23:23:32', '2019-05-31 23:23:32', NULL),
(6, '0102231A', 'ISSIFOU', 'Abdou', '1985-10-01', 'Zinder', 'XXX', '1985-11-13', 'Zinder', 'M', 'Nigérienne', 7, 18, 'Titulaire', 4, NULL, '2019-06-01 23:23:32', '2019-06-03 23:23:32', NULL),
(7, '0102568D', 'YAHOUZA', 'Mohamed', '1991-08-14', 'Niamey', 'XXX', '1991-11-05', 'Niamey', 'M', 'Nigérienne', 11, 6, 'Titulaire', 23, NULL, '2019-04-20 23:23:32', '2019-05-31 23:23:32', NULL);
-- SET IDENTITY_INSERT agents OFF

-- SET IDENTITY_INSERT grades ON
INSERT INTO grades (id, agent_id, category_id, classe_id, echelon_id, type, ref_avancement, date_decision_avancement, observation_avancement, ref_reclassement, date_reclassement, ref_titularisation, date_titularisation, ref_engagement, date_engagement, indice_id, created_at, updated_at, deleted_at) VALUES
(1, 1, 6, NULL, NULL, 'Contrat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-01 23:12:44', '2019-06-01 23:14:26', NULL),
(2, 3, 3, NULL, NULL, 'Contrat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-01 23:12:44', '2019-06-01 23:14:26', NULL),
(3, 2, 4, 1, 2, 'Titularisation', NULL, NULL, NULL, NULL, NULL, 'xxx', '2013-03-15', 'XXX', '2013-03-15', 53, '2019-06-01 23:23:32', '2019-06-01 23:23:32', NULL),
(4, 4, 1, 1, 3, 'Titularisation', NULL, NULL, NULL, NULL, NULL, 'xxx', '2012-02-05', 'XXX', '2012-02-05', 63, '2019-06-01 23:23:32', '2019-06-01 23:23:32', NULL),
(5, 5, 2, 2, 6, 'Titularisation', NULL, NULL, NULL, NULL, NULL, 'xxx', '2018-12-25', 'XXX', '2018-12-25', 31, '2019-06-01 23:23:32', '2019-06-01 23:23:32', NULL),
(6, 6, 1, 3, 13, 'Titularisation', NULL, NULL, NULL, NULL, NULL, 'xxx', '2010-12-31', 'XXX', '2010-12-31', 89, '2019-06-01 23:23:32', '2019-06-01 23:23:32', NULL),
(7, 7, 2, 4, 10, 'Titularisation', NULL, NULL, NULL, NULL, NULL, 'xxx', '2017-11-21', 'XXX', '2017-11-21', 121, '2019-06-01 23:23:32', '2019-06-01 23:23:32', NULL);
-- SET IDENTITY_INSERT grades OFF

INSERT INTO agent_matrimoniale (agent_id, matrimoniale_id, date, created_at, updated_at, deleted_at) VALUES
(1, 2, '2017-06-15', '2019-06-01 23:12:44', '2019-06-01 23:12:44', NULL),
(2, 1, '2012-11-10', '2019-06-01 23:23:32', '2019-06-01 23:23:32', NULL),
(4, 2, '2013-03-14', '2019-06-01 23:23:32', '2019-06-01 23:23:32', NULL),
(3, 3, '2010-08-12', '2019-06-01 23:23:32', '2019-06-01 23:23:32', NULL),
(7, 1, '2017-11-10', '2019-06-01 23:23:32', '2019-06-01 23:23:32', NULL),
(6, 4, '2009-03-14', '2019-06-01 23:23:32', '2019-06-01 23:23:32', NULL),
(7, 3, '2018-08-12', '2019-06-01 23:23:32', '2019-06-01 23:23:32', NULL);

-- SET IDENTITY_INSERT affectations ON
INSERT INTO affectations (id, ref, date, date_prise_effet, observation, agent_id, etablissement_id, created_at, updated_at, deleted_at) VALUES
(1, 'MEN/DRH2547', '2019-05-15', '2019-06-03', NULL, 1, 109700, '2019-06-01 23:12:44', '2019-06-01 23:12:44', NULL),
(2, 'MEN/DRH25/2017', '2014-06-20', '2014-06-30', NULL, 2, 101011, '2019-06-01 23:23:32', '2019-06-01 23:23:32', NULL),
(3, 'MEN/DRH123/2018', '2018-12-15', '2019-01-02', NULL, 7, 109701, '2019-06-01 23:12:44', '2019-06-01 23:12:44', NULL),
(4, 'MEN/DRH2579', '2017-04-20', '2017-05-01', NULL, 3, 109702, '2019-06-01 23:23:32', '2019-06-01 23:23:32', NULL);
-- SET IDENTITY_INSERT affectations OFF

-- SET IDENTITY_INSERT formations ON
INSERT INTO formations (id, date_debut, date_fin, agent_id, ecole_formation_id, diplome_id, niveau_etude_id, equivalence_diplome_id, created_at, updated_at, deleted_at) VALUES
(1, '2017-09-04', '2019-04-10', 1, 1, 14, 3, 6, '2019-06-01 23:12:44', '2019-06-01 23:12:44', NULL),
(2, '2008-06-17', '2011-06-30', 2, 1, 15, 4, 7, '2019-06-01 23:23:32', '2019-06-01 23:23:32', NULL);
-- SET IDENTITY_INSERT formations OFF

INSERT INTO agent_maladie (agent_id, maladie_id, observation, date_observation, created_at, updated_at, deleted_at) VALUES
(2, 2, NULL, '2010-06-16', '2019-06-01 23:23:33', '2019-06-01 23:23:33', NULL),
(4, 1, NULL, '2014-02-16', '2019-06-01 23:23:33', '2019-06-01 23:23:33', NULL),
(6, 1, NULL, '2017-01-16', '2019-06-01 23:23:33', '2019-06-01 23:23:33', NULL);

-- SET IDENTITY_INSERT enfants ON
INSERT INTO enfants (id, prenom, date_naiss, lieu_naiss, sexe, agent_id, created_at, updated_at, deleted_at) VALUES
(1, 'Issaka', '2017-07-20', 'Niamey', 'M', 1, '2019-06-01 23:12:44', '2019-06-01 23:12:44', NULL),
(2, 'Abdou', '2018-02-25', 'Niamey', 'M', 3, '2019-06-01 23:12:44', '2019-06-01 23:12:44', NULL),
(3, 'Alissa', '2014-11-02', 'Niamey', 'F', 5, '2019-06-01 23:12:44', '2019-06-01 23:12:44', NULL);
-- SET IDENTITY_INSERT enfants OFF

-- SET IDENTITY_INSERT conjoints ON
INSERT INTO conjoints (id, matricule, nom, prenom, date_naiss, lieu_naiss, sexe, nationnalite, tel, employeur, profession, ref_acte_mariage, agent_id, created_at, updated_at, deleted_at) VALUES
(1, '0206648C', 'ABDOU', 'Alassan', '1987-12-31', 'Niamey', 'M', 'Nigérienne', '90 90 90 90', 'MESS', 'Enseigant', 'XXX', 1, '2019-06-01 23:12:44', '2019-06-01 23:12:44', NULL),
(2, '0306547A', 'ALI', 'IBOU', '1982-11-30', 'Niamey', 'F', 'Nigérienne', '91 90 90 90', 'MEN', 'Enseigante', 'XXX', 5, '2019-06-01 23:12:44', '2019-06-01 23:12:44', NULL),
(3, '0106894D', 'OUSMANE', 'IBRAHIM', '1980-02-27', 'Niamey', 'F', 'Nigérienne', '93 90 90 90', 'DRESS', 'MEDECIN', 'XXX', 4, '2019-06-01 23:12:44', '2019-06-01 23:12:44', NULL);
-- SET IDENTITY_INSERT conjoints OFF
