DELETE from AlcoImagination;
SELECT * from AlcoImagination;
DELETE from AlcoPseudoAct;
SELECT * from AlcoPseudoAct;
SELECT * from AlcoFunEvents;
update AlcoData set EssayOk=0 where ID='0A00000001';
update AlcoFunEvents set StartDate="2024-02-21";
INSERT into aboutHospital values(0,'C院',0,'');
INSERT into UserData values('A000000002',1,'adaarou','adaarou@gmail.com');
INSERT into UserData values('0A00000001',0,'monkey','monkey@gmail.com');
INSERT into CounsellorData values('A000000002',1,'A田A郎',0);
INSERT into PatientData values('0A00000001','モンキーＤルフィ',0,19,1,'A000000001A000000002','父：ドラゴン 兄：エース、サボ','メリー号','起きたいときに起き、寝たいときに寝る','肉','船長','','a','b','c','d','11');
INSERT into AlcoData values('0A00000001',3,'2020-02-12','2024-02-12','ずっと変わらずすごい飲む','酔いつぶれて寝過ごした','一日二回','けんかになった','飲めなくなるまで飲む','適量になるまで',0,'朝起きて歯磨きをした。','');
DELETE from PatientData where ID='0A00000001';
DELETE from AlcoData where ID='0A00000001';
SELECT * from PatientData;
SELECT * from AlcoData;
SELECT Cnum from aboutC where region=;
SELECT * from UserData;
update AlcoData set y2024m02d10='000000000000000000000000000000' where ID='0A00000006';
RENAME TABLE aboutAlco TO AlcoData;
update AlcoCalendor set StartDateTime='2024-02-12 12:20:00' where StartDateTime='2024-02-12 12:02:00';
DELETE from AlcoToDo where ID='0A00000001' and StartDate='2024-02-16';
DELETE from AlcoToDo where ID='0A00000001';
DELETE from AlcoToDo where FunEventsAbstract=0 and FunEvents=0;
SELECT * from AlcoToDo;
SELECT * from AlcoCalendor;
DELETE from AlcoCalendor where StartDateTime="2024-02-20 00:00:00";
update AlcoToDo set FunEventsAbstract=4 where StartDate='2024-02-15';
ALTER TABLE aboutHospital ADD COLUMN ID tinyint FIRST;
ALTER TABLE AddicData ADD COLUMN Addic tinyint not null after Allname;
ALTER TABLE aboutHospital CHANGE phoneNumber PhoneNumber tinyint;
ALTER TABLE GambData ADD COLUMN y2024m2d3 char(30);
ALTER TABLE PatientData ADD COLUMN ControlStimulusText varchar(100) after Addictions;
DELETE from aboutHospital where HospitalName='C院'; 
SHOW COLUMNS from users;
INSERT into AlcoToDo values('0A00000001','2020-02-16',4,4,2,1,2,2,1,1);
update AlcoToDo set StartDate= '2024-02-15';
INSERT into PatientData values('0B00000001','ロロノアゾロ',1,21,0,'A000000002','親戚：くいな','サニー号','よく寝る','酒','戦闘員','','','','','','01');

DELETE from AlcoCalendor where StartDateTime="2024-02-13 09:00:00";
update AlcoCalendor SET StartDateTime="";
INSERT into aboutCalView values("day","日");
INSERT into AlcoCalendor values('0A00000001','2024-02-12 17:30:00','2024-02-12 19:00:00','サニー号','サンジとフランキー','なんとなく気分がよかった',
1,3,1,
0,0,0,
0,0,0,
0,0,0,
0,0,0,
0,0,0,
1,1,1,
''
);
ALTER TABLE UserData CHANGE Pass Pass varchar(200) not null;
ALTER TABLE UserData ADD COLUMN UserStatus boolean not null after Email;
update UserData SET UserStatus=1;
ALTER TABLE aboutAdmin CHANGE pass pass varchar(200) not null;
update aboutAdmin SET pass="$2y$10$CdFMSnzPztr/Dw5rkCMdOesGu20tQDOT8UsPTsTDDB.n4ECWfBDfq";
SELECT * from aboutAdmin;
create table UserData(
    ID char(10) primary key,
    Class tinyint not null,
    Pass varchar(50) not null,
    Email varchar(50) not null,
    UserStatus boolean not null
);
SELECT * from emailData;
INSERT into emailData values('A000000001','smtp.kagoya.net','home10.fieldvalley','8940hakuyo');
DELETE from emailData;
update emailData set Host='smtp.kagoya.net';
create table emailData(
    ID char(10) primary key,
    Host varchar(50) not null,
    Account varchar(50) not null,
    Pass varchar(50) not null
);
create table CounsellorData(
    ID char(10) primary key,
    Rank tinyint not null,
    Allname varchar(50) not null,
    Hospital tinyint not null
);
SELECT * from UserData;
UPDATE PatientData set Hospital=0 where Allname="a";
create table PatientData(
    ID char(10) primary key,
    Allname varchar(50) not null,
    Hospital tinyint not null,
    Age tinyint not null,
    Sex tinyint not null,
    Counsellors varchar(100),
    PersonalRelations varchar(300),
    Residence varchar(100) not null,
    RhythmOfLife varchar(300),
    Interests varchar(100),
    Profession varchar(100) not null,
    WorkExp varchar(300),
    HarshChildhoodExp varchar(300),
    CriminalRecord varchar(300),
    OtherTraumas varchar(300),
    Supplement varchar(300),
    Goal varchar(100),
    TestShow varchar(100),
    Addictions varchar(10),
    Holiday char(7)
);

ALTER TABLE PatientData ADD COLUMN TestShow varchar(100) after Goal;
ALTER TABLE PatientData ADD COLUMN Goal varchar(100) after Supplement;
create table aboutAddic(
    AddicName varchar(50),
    AddicNameJP varchar(50)
);
create table aboutHospital(
    ID tinyint primary key,
    HospitalName varchar(50) not null,
    phoneNumber varchar(30),
    HospitalAddress varchar(50)
);
create table aboutCalView(
    CalViewName varchar(10) not null,
    CalViewNameJP varchar(10) not null
);
DELETE from frontCoverBBS where Num=0;
INSERT into frontCoverBBS values(0,1,"110","11",0,"健康的な生活習慣を心がけましょう");
INSERT into frontCoverBBS values(1,1,"110","11",0,"ナヴィゲーションの赤丸が消えたら、今日のやることは完了です");
update frontCoverBBS set TextContents="ナビゲーションの赤丸が消えたら、今日のやることは完了です" where Num=1;
SELECT * from frontCoverBBS;
ALTER TABLE frontCoverBBS DROP COLUMN StartDate;
create table frontCoverBBS(
    Num tinyint primary key,
    BBSstatus tinyint,
    Hospital varchar(20),
    Addiction varchar(20),
    ID char(10),
    TextContents varchar(300)
);
SELECT * from TestScore;
DELETE  from TestScore where Num>=1;
update TestScore set testPoint=2 where Num=0;
create table TestScore(
    ID char(10),
    whatTest tinyint,
    Num tinyint,
    StartDate Date not null,
    Answer varchar(300),
    testPoint tinyint,
    primary key (ID,whatTest,Num)
);
ALTER TABLE TestScore ADD COLUMN testPoint tinyint after Answer;
ALTER TABLE AlcoData ADD COLUMN ControlStimulusInstruction varchar(1000) after ControlStimulusText;
ALTER TABLE AlcoData ADD COLUMN PseudoActInstruction varchar(1000) after ControlStimulusText;
ALTER TABLE AlcoData ADD COLUMN ImaginationInstruction varchar(1000) after PseudoActInstruction;
create table "AddicName"Data(
    ID char(10),
    Severity tinyint not null,
    StartDate Date  not null,
    ProgramStartDate Date  not null,
    Progress  varchar(300),
    Difficulties varchar(300),
    Frequency varchar(100),
    Trouble varchar(300),
    Methods varchar(300),
    AddicGoal varchar(100),
    ControlStimulusText varchar(100),
    ControlStimulusInstruction varchar(1000),
    PseudoActInstruction varchar(1000),
    ImaginationInstruction varchar(1000),
    EssayOk bit not null,
    Essay varchar(4500),
    AddicSupplement varchar(300)
);
ALTER TABLE AlcoData CHANGE Supplement AddicSupplement varchar(300);
ALTER TABLE AlcoData CHANGE Goal AddicGoal varchar(100);
create table AlcoCalendor(
    ID char(10) ,
    StartDateTime DateTime ,
    EndDateTime DateTime ,
    Place varchar(50) not null,
    People varchar(50),
    Impetus varchar(100), 
    Beer bit not null,
    BeerNum tinyint, 
    BeerUnit tinyint,
    Highball bit not null,
    HighballNum tinyint,
    HighballUnit tinyint,
    Strong bit not null,
    StrongNum tinyint,
    StrongUnit tinyint,
    JPRiceWine bit not null,
    JPRiceWineNum tinyint,
    JPRiceWineUnit tinyint,
    Wine bit not null,
    WineNum tinyint,
    WineUnit tinyint,
    Shochu bit not null,
    ShochuNum tinyint,
    ShochuUnit tinyint,
    Whisky bit not null,
    WhiskyNum tinyint,
    WhiskyUnit tinyint,
    Other varchar(100),
    primary key (ID,StartDateTime,EndDateTime)
);

create table "AddicName"ToDo(
    ID char(10),
    StartDate Date,
    FunEventsAbstract tinyint not null,
    FunEvents tinyint not null,
    ControlStimulus tinyint not null,
    Essay bit not null,
    PseudoAct  tinyint not null,
    Imagination tinyint not null,
    FunEventsRead tinyint not null,
    EssayRead tinyint not null,
    primary key(ID,StartDate)
);
ALTER TABLE AlcoProcess ADD COLUMN ProcessStatus tinyint not null after StartDate;
Insert into AlcoProcess values("0A00000001","2024-03-03",0,4);
Insert into AlcoProcess values("0A00000001","2024-03-03",0,4);
update AlcoProcess set StartDate="2024-03-13" where ProcessStatus=1 and ToDoNumber=6;

SELECT * from AlcoProcess where ID="0A00000001";
SELECT * from AlcoToDo;
SELECT * from AlcoEssay;
update AlcoData set EssayOk=0;
DELETE from AlcoEssay where StartDate="2024-03-19";
DELETE from AlcoProcess where ProcessStatus=1 and ToDoNumber=9;
DELETE from AlcoProcess where ProcessStatus=2 and ToDoNumber=2;
Insert into Process values("0A00000001","2024-03-07",1,2);
create table "AddicName"Process(
    ID char(10),
    StartDate Date not null,
    ProcessStatus tinyint not null,
    ToDoNumber tinyint not null,
    primary key(ID,ProcessStatus,ToDoNumber)
);
INSERT into AlcoProcess values("0A00000001","2024-04-06",0,0);
DELETE from AlcoFunEvents where Num=49;
DELETE from AlcoFunEvents where StartDate="2024-03-14";
DELETE from AlcoProcess where ProcessStatus=2 and ToDoNumber=2;
SELECT * from FunEvents where EndDate="2024-04-06";
SELECT count(*) from AlcoFunEvents where StartDate>="2024-03-13";
update AlcoFunEvents set EndDate="2024-03-14" where Num=29;
update AlcoFunEvents set ConcreteOk=0 where Num=0;
update AlcoFunEvents set ConcreteOk=1 where Num>=24 and Num<=28;
update AlcoFunEvents SET StartDate="2024-03-13" where StartDate="2024-03-14";

update AlcoFunEvents SET ConcreteOk=1 where Num<=23;
update AlcoFunEvents SET ConcreteOk=1,EndDate="2024-03-01" where Num=1;
DELETE from FunEvents where ID="0C00000001" and Num>0;
SELECT * from FunEvents where ID="0C00000001";
create table FunEvents(
    ID char(10) ,
    Num tinyint ,
    StartDate Date not null,
    EndDate Date not null,
    AbstractOk bit not null,
    Abstract varchar(200),
    ConcreteOk bit not null,
    Concrete varchar(1000),
    primary key(ID,Num)
);
create table "AddicName"ControlStimulus(
    ID char(10) ,
    StartDate Date,
    Num  tinyint not null,
    primary key(ID,StartDate)
);
SELECT * from AlcoPseudoAct;
DELETE from AlcoPseudoAct where StartDate="2024-03-09" and Num=7;
create table "AddicName"PseudoAct(
    ID char(10),
    StartDate Date,
    Num tinyint,
    AutonomicNervesBefore varchar(30),
    FeelingBefore varchar(30),
    DirectionBefore varchar(30),
    DrivingForceBefore tinyint,
    OtherBefore varchar(30),
    OtherTextBefore varchar(50),
    AutonomicNervesAfter varchar(30),
    FeelingAfter varchar(30),
    DirectionAfter varchar(30),
    DrivingForceAfter tinyint,
    OtherAfter varchar(30),
    OtherTextAfter varchar(50),
    Completion tinyint,
    Interruption tinyint,
    InterruptionText varchar(50),
    Post tinyint,
    PostText varchar(50),
    People tinyint,
    PeopleText varchar(50),
    TimeZone tinyint,
    primary key(ID,StartDate,Num)
);
DELETE from AlcoPseudoAct where Num=2;
DROP TABLE AlcoImagination;
SELECT * from AlcoPseudoAct;
SELECT * from AlcoImagination where StartDate="2024-04-06";
ALTER TABLE AlcoImagination ADD COLUMN aboutWhat tinyint after PeopleText;
ALTER TABLE AlcoImagination CHANGE COLUMN AfterCompletion Post tinyint;
ALTER TABLE AlcoImagination CHANGE COLUMN AfterCompletionText PostText varchar(50);
create table "AddicName"Imagination(
    ID char(10),
    StartDate Date,
    Num tinyint,
    AutonomicNervesBefore varchar(30),
    FeelingBefore varchar(30),
    DirectionBefore varchar(30),
    DrivingForceBefore tinyint,
    OtherBefore varchar(30),
    OtherTextBefore varchar(50),
    AutonomicNervesAfter varchar(30),
    FeelingAfter varchar(30),
    DirectionAfter varchar(30),
    DrivingForceAfter tinyint,
    OtherAfter varchar(30),
    OtherTextAfter varchar(50),
    Completion tinyint,
    Interruption tinyint,
    InterruptionText varchar(50),
    Post tinyint,
    PostText varchar(50),
    People tinyint,
    PeopleText varchar(50),
    aboutWhat tinyint not null,
    word1 varchar(30),
    word2 varchar(30),
    word3 varchar(30),
    word4 varchar(30),
    word5 varchar(30),
    word6 varchar(30),
    word7 varchar(30),
    word8 varchar(30),
    word9 varchar(30),
    word10 varchar(30),
    word11 varchar(30),
    word12 varchar(30),
    word13 varchar(30),
    word14 varchar(30),
    word15 varchar(30),
    word16 varchar(30),
    word17 varchar(30),
    word18 varchar(30),
    word19 varchar(30),
    word20 varchar(30),
    primary key(ID,StartDate,Num)
); 
Insert into AlcoImaginationText values("0A00000001","2024-03-03","2020-03-03",0,"自分のアパートで目覚めた。食パンを1枚食べ、ミルクティーを飲み、煙草を吸った。仏壇と神棚に水を挙げて、身支度をして、夫と出かけた。ニトリに行き、カーテンとタオルかけを買おうとしたが、たどり着く前に、目に入った居酒屋に入ってしまった。");
Insert into AlcoImaginationText values("0A00000001","2024-03-04","2018-07-04",1,"ooで××だったので△△してしまった");
SELECT * from AlcoImaginationText;
ALTER TABLE AlcoImaginationText ADD COLUMN ActionTextOk boolean not null after ActionText;
create table "AddicName"ImaginationText(
    ID char(10),
    StartDate Date,
    ActionDate Date,
    Num tinyint,
    ActionText varchar(400),
    ActionTextOk boolean not null,
    primary key(ID,Num)
);
update AlcoImaginationText set ActionTextOk=1;
create table "AddicName"Essay(
    ID char(10),
    StartDate Date,
    EssayWrite tinyint not null,
    EssayRead tinyint not null,
    primary key(ID,StartDate)
);
DELETE from AlcoPseudoAct where Num=2;
DROP TABLE AlcoImagination;
SELECT * from AlcoPseudoAct;
SELECT * from AlcoEssay;
SELECT * from AlcoFunEventsRead;

Insert into AlcoBBS values("0A00000001","2024-03-02",0,"0A00000001","よろしくお願いします。");
Insert into AlcoBBS values("0A00000001","2024-03-02",1,"A000000002","こちらこそよろしくお願いします。AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA");
SELECT * from AlcoBBS;
create table "AddicName"BBS(
    ID char(10) ,
    StartDate Date ,
    Num int ,
    PostID char(10) not null,
    TextContents varchar(300),
    primary key(ID,Num)
);
create table FunEventsRead(
    ID char(10) ,
    StartDate Date not null,
    Num tinyint,
    word1 varchar(30),
    word2 varchar(30),
    word3 varchar(30),
    word4 varchar(30),
    word5 varchar(30),
    word6 varchar(30),
    word7 varchar(30),
    word8 varchar(30),
    word9 varchar(30),
    word10 varchar(30),
    word11 varchar(30),
    word12 varchar(30),
    word13 varchar(30),
    word14 varchar(30),
    word15 varchar(30),
    word16 varchar(30),
    word17 varchar(30),
    word18 varchar(30),
    word19 varchar(30),
    word20 varchar(30),
    primary key(ID,StartDate)
);