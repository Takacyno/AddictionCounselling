create database local CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
use local;
create table aboutAdmin(
    ID char(10) primary key,
    email varchar(200) not null,
    pass varchar(200) not null
);
create table aboutDB(
    ID int primary key,    
    HospitalNum tinyint,
    AddicNum tinyint
);
create table UserData(
    ID char(10) primary key,
    Class tinyint not null,
    Pass varchar(200) not null,
    Email varchar(50) not null,
    UserStatus boolean not null
);

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
create table frontCoverBBS(
    Num tinyint primary key,
    BBSstatus tinyint,
    Hospital varchar(20),
    Addiction varchar(20),
    ID char(10),
    TextContents varchar(300)
);
create table TestScore(
    ID char(10),
    whatTest tinyint,
    Num tinyint,
    StartDate Date not null,
    Answer varchar(300),
    testPoint tinyint,
    primary key (ID,whatTest,Num)
);
create table AlcoData(
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

create table AlcoToDo(
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
create table AlcoProcess(
    ID char(10),
    StartDate Date not null,
    ProcessStatus tinyint not null,
    ToDoNumber tinyint not null,
    primary key(ID,ProcessStatus,ToDoNumber)
);

create table Process(
    ID char(10),
    StartDate Date not null,
    ProcessStatus tinyint not null,
    ToDoNumber tinyint not null,
    primary key(ID,ProcessStatus,ToDoNumber)
);

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
create table AlcoControlStimulus(
    ID char(10) ,
    StartDate Date,
    Num  tinyint not null,
    primary key(ID,StartDate)
);
create table AlcoPseudoAct(
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
create table AlcoImagination(
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
create table AlcoImaginationText(
    ID char(10),
    StartDate Date,
    ActionDate Date,
    Num tinyint,
    ActionText varchar(400),
    ActionTextOk boolean not null,
    primary key(ID,Num)
);
create table AlcoEssay(
    ID char(10),
    StartDate Date,
    EssayWrite tinyint not null,
    EssayRead tinyint not null,
    primary key(ID,StartDate)
);
create table AlcoBBS(
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
INSERT into aboutadmin values(1,"taka2001yuki@gmail.com","$2y$10$ZFLb/2sCM8Hc8sqyejZPk.S7Y/LxJhniHPuMiF6i75RPcFLyRrlWe");
INSERT into emailData values('A000000001','smtp.kagoya.net','home10.fieldvalley','8940hakuyo');
INSERT into aboutDB values("1","3","1");
INSERT into UserData values("A000000001","1","$2y$10$F2whc9.CG1dzoIuQNp1QXu8OZSY2tso9mVV2f0m/dXquYH2r/fsVK","tanihara@field-valley.co.jp","1");
INSERT into UserData values("0A00000001","0","$2y$10$7Tv7pu95Zj1hd8mmKyZM.ufZX4J/YcGZSM4afWJ5v6e0QDrSlxo36","monkey@gmail.com","1");
INSERT into UserData values("A000000002","1","$2y$10$dlbEeJ6WMIV4mugguCkex.7ejmvD/2SpItVDQx2QizThHyrSc6aXy","eidaarou@gmail.com","1");
INSERT into UserData values("0B00000001","0","$2y$10$a8czUQip2pWEqV8RKkm4UuVyukdA/VuxD4sDTR.TqrTqWr2NbXyhe","zoro@gmail.com","1");
INSERT into UserData values("0A00000002","0","$2y$10$U.D/8JE4t.xZRYnYG01dne/Xc9j87sZIFh9XIoB641lCOPD8x9P6.","a@aa","1");
INSERT into UserData values("C000000001","0","$2y$10$uo7DgtNAqOF5j5uJwmcmWOnEmu1TnuW5kGtQvc8VqqteBJGE8CC2K","anoata@gmail.com","1");
INSERT into UserData values("C000000002","0","$2y$10$2/ov/JN3.a.5DMUjZFt2NOcx5PIZB1gXzgm8/jkILStX2kOFCpq9y","anoata@gmail.com","1");
INSERT into UserData values("B000000001","0","$2y$10$/pDeK4EIhMaOunU2BfZOvusvvPajwG7MsoTb9N6DvoDngF2PZxOse","bkawabki@gmail.com","1");
INSERT into UserData values("B000000002","0","$2y$10$LO94Zi2RVp.ulLySp57/TOQ2zMPRVy30I7jwhhlzQoq3MeP.hDLBi","usopp@gmail.com","1");
INSERT into UserData values("0A00000003","0","$2y$10$s4gmomVxkGL1DRiRWuvaN.Jxn0X4VdYNAtkHMD7uN9FpJc0mKN4OC","nami@gmail.com","1");
INSERT into UserData values("0A00000004","0","$2y$10$AAzW4tnAyPrgQK7.unD3..MzsbirGh4f88jyIJAKm.8YK1eGhO4/q","chopper@gmail.com","1");
INSERT into UserData values("0A00000005","0","$2y$10$Y0mcTZyVfqERcRed1jILaehD3wgLSJf9L/g8nGCs1CMHotrvqAcaK","sanji@gmail.com","1");
INSERT into UserData values("0A00000006","0","$2y$10$tpaUGk0brPr9m9Y6I7DQXez/MdAV/OvmMDAYxMF3gi8p2n82c2jPe","robin@gmail.com","1");
INSERT into UserData values("0A00000007","0","$2y$10$L5iclcmlmMc5njTU07uGnOm8LSrHhdUCLKAQZB/r1sVNF8yWP77ua","frankey@gmail.com","1");
INSERT into UserData values("0B00000002","0","$2y$10$xxBLRTXBwiEv.7oq2245ceuD9RF5bQ.Fr5pXUnTSdn3JSzS5HXASa","brook@gmail.com","1");
INSERT into UserData values("0C00000001","0","$2y$10$BCrjNgCGJd2tzt4sZCsFKOfyMAHKguKqFFsezTv8VqphuCOUsXgJ6","doragon@gmail.com","1");
INSERT into UserData values("0A00000008","0","$2y$10$UiZalbpW6AhFsB/TqHhC1.klgbSpHQBaqQDFpaSRBBqY/sSjAFMBS","taka2001yuki@gmail.com","1");
INSERT into UserData values("0A00000009","0","$2y$10$4f6T9WrJMKyDK9i.wF3OEO4zzps5DDGejelwCTb1XwYEY8oVDRyVy","eternaldarkness-k117@docomo.ne.jp","0");
INSERT into UserData values("0A00000010","0","$2y$10$Hxgd/yq93qu5cddGsAQG5ODs9m69hwrFbIkxa5sC5OdCPBLFsjkiG","takashi070519@yahoo.co.jp","1");
INSERT into UserData values("0A00000011","0","$2y$10$MiFgG/5LzGs7Oe5HN6OoJO5xKh6OlRm22n0JW9J3zL79ZiZRDIhSi","ikuoishida@icloud.com","1");
INSERT into UserData values("0A00000012","0","$2y$10$mZ5khF9Zkml9l3OgjP0Cg.fDKIfQncG1SwgK5Dl.s0MCM9MiZi2zy","m.s1990403@icloud.com","1");

INSERT into CounsellorData values("A000000001","0","谷原宗之","0");
INSERT into CounsellorData values("A000000002","1","A田A郎","0");
INSERT into CounsellorData values("0C00000001","1","A野A太","2");
INSERT into CounsellorData values("0C00000002","2","A野A太","2");
INSERT into CounsellorData values("B000000001","1","B川B樹","1");
INSERT into CounsellorData values("B000000002","2","ウソップ","1");

INSERT into PatientData values("0B00000001","ロロノアゾロ","1","21","1","A000000002","親戚：くいな","サニー号","よく寝る","酒","戦闘員","","a","b","c","d","","","01","");
INSERT into PatientData values("0A00000001","モンキーＤルフィ","0","19","1","","父：ドラゴン 兄：エース、サボ","メリー号","起きたいときに起き、寝たいときに寝る","肉","船長","会社員","大怪我をした","なし","閉所恐怖症","サボり気味","お酒をやめる","000000","1","1000001");
INSERT into PatientData values("0A00000002","a","0","0","1","","","","","","","","","","","","","000000","1","0000000");
INSERT into PatientData values("0C00000001","ドラゴン","2","50","1","","","","","","","","","","","","","000000","1","0000011");
INSERT into PatientData values("0A00000003","ナミ","0","0","1","","","","","","","","","","","","","00000","1","0011000");
INSERT into PatientData values("0A00000004","チョッパー","0","0","0","","","","","","","","","","","","","0000","10","0000000");
INSERT into PatientData values("0A00000005","サンジ","0","0","0","","","","","","","","","","","","","0000","10","0000000");
INSERT into PatientData values("0A00000006","ロビン","0","0","1","","","","","","","","","","","","","000000","1","0000000");
INSERT into PatientData values("0A00000007","フランキー","0","0","0","","","","","","","","","","","","","0000","10","0000000");
INSERT into PatientData values("0B00000002","ブルック","1","0","0","","","","","","","","","","","","","0000","10","0000000");
INSERT into PatientData values("0A00000008","taka","0","23","1","A000000002","良好","江戸川区","問題なし","音楽鑑賞","学生","塾の講師","特になし","なし","なし","なし","留学して研究者になる！","000000","1","1000001");
INSERT into PatientData values("0A00000009","奥堂　光盛","0","45","1","A000000001","","石川県輪島市門前町本市12-1","","","無職","","","","","ウイスキー、720ミリを半分ぼどラッパのみ","","000000","1","0000000");
INSERT into PatientData values("0A00000010","深澤貴至","0","35","1","A000000001","","南アフリカ在住","時差　7時間日本より遅い","野球、トレイルランニング","会社員（営業）","","","","","audit1回目17点","飲酒に対する欲求を抑え、飲む量をコントロールできるようにする","000001","1","0000000");
INSERT into PatientData values("0A00000011","石田　育男","0","39","1","","","大阪市浪速区湊町1-4-36-904","","ゴルフ","会社経営","","","","","朝から飲酒をしてしまう、翌日体調が悪くなって仮病を使って会社を休んでしまう。毎日。焼酎の炭酸割りを飲み続けています。","","100000","1","0000000");
INSERT into PatientData values("0A00000012","三橋麻希","0","34","2","","","","","","自営業","","","","","","","100000","1","0000000");

INSERT into aboutHospital values("0","A院","0300000000","東京都のどっか");
INSERT into aboutHospital values("1","B院","0311111111","東京都のどっか");
INSERT into aboutHospital values("2","C院","03222222222","東京都のどっか");

INSERT into aboutCalView values("day","日");
INSERT into aboutCalView values("month","月");

INSERT into Process values("0A00000001","2024-03-07","1","2");
INSERT into Process values("0A00000001","2024-03-14","2","2");
INSERT into Process values("0A00000001","2024-03-15","1","3");
INSERT into Process values("0A00000002","2024-03-17","1","2");
INSERT into Process values("0A00000003","2024-03-20","1","2");
INSERT into Process values("0A00000004","2024-04-30","1","2");
INSERT into Process values("0A00000001","2024-04-06","2","3");
INSERT into Process values("0A00000001","2024-04-07","1","8");
INSERT into Process values("0C00000001","2024-04-06","1","2");
INSERT into Process values("0A00000008","2024-05-17","1","2");
INSERT into Process values("0A00000008","2024-05-18","2","2");
INSERT into Process values("0A00000008","2024-05-18","1","3");
INSERT into Process values("0A00000006","2024-05-20","1","2");
INSERT into Process values("0A00000008","2024-05-21","2","3");
INSERT into Process values("0A00000008","2024-05-21","1","8");
INSERT into Process values("0A00000010","2024-08-01","1","2");
INSERT into Process values("0A00000010","2024-08-14","2","2");
INSERT into Process values("0A00000010","2024-08-15","1","3");

INSERT into frontCoverBBS values("0","0","000","1","0","健康的な生活習慣を心がけましょう!");
INSERT into frontCoverBBS values("1","1","000","1","0","ナヴィゲーションの赤丸が消えたら、今日のやることは完了です");
INSERT into frontCoverBBS values("2","1","100","01","0","OhYeah!");
INSERT into frontCoverBBS values("3","0","0","0","0A00000001","");
INSERT into frontCoverBBS values("4","1","0","0","0B00000002","質問です。");
INSERT into frontCoverBBS values("5","1","0","0","0C00000001","こんにちは");
INSERT into frontCoverBBS values("6","0","0","0","0A00000008","");
"7","1","0","0","0A00000008","今週のやることは
・制御刺激を１日5回行います。
・想像を1日２回行います。
・擬似を１日5回行います。
・飲酒行動に関しての記録をつけます。
INSERT into frontCoverBBS values(・「良かったことの読み返し」を１日に１話から２話行います。");
INSERT into frontCoverBBS values("8","0","0","0","0A00000008","");
INSERT into frontCoverBBS values("9","1","0","0","0A00000010","ついつい忘れてしまうと思いますが、制御刺激は毎日行って記録して下さいね。");

INSERT into TestScore values("0A00000001","1","0","2024-03-18","1001001001001001001001001001000100100100","2");
INSERT into TestScore values("0A00000001","1","2","2024-03-18","0010010100100010011000100011000001100010","5");
INSERT into TestScore values("0A00000001","1","1","2024-03-18","0100100100100100100100100100100010010010","3");
INSERT into TestScore values("0A00000001","1","3","2024-03-18","0010100010100010010010010010010010001100","12");
INSERT into TestScore values("0A00000001","3","0","2024-03-18","010010001000100010000100001000010001001000100","2");
INSERT into TestScore values("0A00000001","1","4","2024-03-19","0000000000000000000000000000000100000000","0");
INSERT into TestScore values("0A00000001","1","5","2024-03-19","1001001001001001001001001001000100100100","2");
INSERT into TestScore values("0A00000001","1","6","2024-03-19","1001001001001001001001001001000100100100","2");
INSERT into TestScore values("0C00000001","0","0","2024-04-11","100100010011110111100010110001110001001110100","15");
INSERT into TestScore values("0A00000001","1","7","2024-04-11","001001010010001001010001001001001","11");
INSERT into TestScore values("0A00000001","0","0","2024-04-19","00010000100001000010000100001000010000100001000010","30");
INSERT into TestScore values("0A00000001","0","1","2024-04-19","00001000010000100001000010000100001000010000100001","40");
INSERT into TestScore values("0A00000008","1","0","2024-05-17","100001010011110111100010110001110001001111100","13");
INSERT into TestScore values("0A00000008","1","1","2024-05-19","100100010011110111100010110001110001001110100","15");
INSERT into TestScore values("0A00000008","2","0","2024-05-19","001001010010001010100001001001001","9");
INSERT into TestScore values("0A00000008","3","0","2024-05-26","0010100010100010010011001000010010001100","12");
INSERT into TestScore values("0A00000008","4","0","2024-05-26","0010100100100010010011000011000010010010010010100010","15");
INSERT into TestScore values("0A00000008","5","0","2024-05-26","001001000100100011000001000000100000010001001","10");
INSERT into TestScore values("0C00000001","0","1","2024-05-30","00001010000100001000100001000000100100001000010000","9");
INSERT into TestScore values("0A00000009","0","0","2024-06-11","00001000010000100100000010000100001000011000000001","34");
INSERT into TestScore values("0A00000010","0","0","2024-07-24","00010010000010001000010001000001000001000100000001","16");
INSERT into TestScore values("0A00000010","1","0","2024-08-08","100100010011100101010010110001110001100011100","10");
INSERT into TestScore values("0A00000010","2","0","2024-08-08","001001011010001001010010001001001","9");
INSERT into TestScore values("0A00000010","1","1","2024-08-15","100100010011110111100010110001110001001110100","15");
INSERT into TestScore values("0A00000010","2","1","2024-08-15","001001010010001001010001001001001","11");
INSERT into TestScore values("0A00000010","3","0","2024-08-22","0100100011000100100010011000010010001100","7");
INSERT into TestScore values("0A00000010","3","1","2024-08-29","0010100010100010010011000010010010001100","13");
INSERT into TestScore values("0A00000010","4","0","2024-09-07","0010100100100010010011000011000010010010001010010100","14");
INSERT into TestScore values("0A00000010","4","1","2024-09-12","0010100100100100010011000011000010010010001010100010","15");
INSERT into TestScore values("0A00000012","0","0","2024-09-13","00001000010000100001100001000000001000101000000001","27");
INSERT into TestScore values("0A00000010","5","0","2024-09-19","001001000100100010000100000101000000010001001","7");

INSERT into AlcoData values("0A00000001","3","2020-02-12","2024-02-12","ずっと変わらずすごい飲む","酔いつぶれて寝過ごした","一日二回","けんかになった","飲めなくなるまで飲む","適量になるまで","私は今お酒を飲めない、大丈夫！","現在は１日５回行なってください。","擬似を行います","","1","朝起きて歯磨きをした。","なし");
INSERT into AlcoData values("0A00000008","3","2024-00-00","0000-00-00","","","","","","断酒する！","私は今お酒は飲めない。大丈夫。","","","","1","描写文お試し描写文お試し描写文お試し描写文お試し描写文お試し描写文お試し描写文お試し描写文お試し描写文お試し描写文お試し","");
INSERT into AlcoData values("0A00000003","0","0000-00-00","0000-00-00","","","","","","","","","","","0","","");
INSERT into AlcoData values("0A00000007","0","0000-00-00","0000-00-00","","","","","","","","","","","0","","");
INSERT into AlcoData values("0C00000001","0","0000-00-00","0000-00-00","","","","","","","","","","","0","おはよう御座います。今日一日晴れます","");
"0A00000009","0","0000-00-00","2024-06-13","","自殺願望、不眠、嫁に迷惑かけてる、廃人です。","お酒が常時必要で体調は最悪。
INSERT into AlcoData values(ウイスキー、720ミリを半分ぼどラッパのみ","","","断酒、もしくは減酒","","","","","0","","");
"0A00000010","0","0000-00-00","0000-00-00","","","","","","","私は今　アルコールは　飲めない　大丈夫！","私は今（手のひらを胸に当てます）アルコールは（拳を握ります）飲めない（親指を拳の中にしまいます）大丈夫！（もう1度、親指を中にしまったまま拳を握りしめます）","アンケートを記入します。冷蔵庫からビールを取り出し飲んだふりを全力で行います。ビールを冷蔵庫にしまいます。アンケートの後半部分を記入します。10回に一回は中断を行います。中断した際は制御刺激（おまじない）を行います。後半のアンケートは下の3行だけ記入します。","想像の準備から本日行う想像の話を決めます。目を閉じて、朝起きてからを時間の流れに沿って頭の中で追体験していきます。目に見えるものをできるだけはっきりと認識して、会話の内容や見える景色など、なるべく詳細に思い出します。そして飲酒の場面は詳細に思い出してください。","1","2024年7月21日(日)7時ごろに自宅ベッドで目が覚めた。前日の会社スタッフとのゴルフのラウンドから疲れが残っていた。朝、ジムにはいかずにゆったり過ごしてから10時に自宅でパスタを調理して食べた。午後から野球の試合があるため、試合の集合に備えて、食べ過ぎることもなく午前中はリラックスに努めた。近くの方を一緒に車に乗せて試合会場に向かい練習を始めた。冬の寒さが厳しい日ではあったが、お昼ということもあり練習で動き出してすぐに半袖になった。グラウンドはいつもの様子で、ここの所調子が良く練習でもイメージの通りにパフォーマンスできた。チームメイトとも談笑しつつすぐに試合モードに入った。試合自体は自身も3安打で試合にも勝利した。リーグ戦、リーム内の打撃成績について3安打したこともあり引き続きトップを維持できていることに少し満足をしていた。試合中にスライディングをした味方の選手がけがをしてしまい、すぐに病院に運ばれたことが気がかりであったが、試合後の速報で骨折をされていると聞いて非常に心苦しかった。試合後、同日午後3時からのチームBBQについて案内があり、まずは自宅に戻った。自宅に戻ったあとはシャワーを浴びたり軽くストレッチをするなどして過ごした。試合からの疲れはその時点ではあまり感じていなかった。集合時間に間に合う様、近所の方とも待ち合わせの上しBBQ会場に向かった。向かう道中、物乞いなどに遭遇するも何も持っていないことを伝えてうまくかわし、10分度歩いて会場に到着した。当日、外を歩くのが初めての人もおり、個人では歩かないことや、夜間は複数人でも歩かないことを共有したりしながら歩いていた。この時点で自身が良く記憶を失くしてしまったり人にお酒を飲ませたりしてしまうことを共有していた。そのうちの1名は過去にその場におり、私が酔っ払うとこのようになることを知っていた。会場には3人で向かったが、そのほかにも同じアパートから時間差で歩いてこられる方がいることを伺った。BBQ会場についてまず、全く知らない方が庭にいたので部屋を間違えたかと思ったが、野球部以外にも参加されている方がおられたため会場自体はあっていた。全く知らない方だと最初思ったが、過去ソフトボールなどで会った方だった。髪型が違っていたので最初、気づかなかった。
ホストが忙しそうに準備を始めたのでその手伝いを申し出、ビールやソフトドリンクをクーラーボックスに入れたり、お皿やお箸を並べる手伝いを行った。おそらく、全員分のビールが十分でないだろうと思い、自宅からWindhoekのビール500ml6缶とメーカーズマークを1本リュックに入れて持ってきていた。そのビールはすぐに冷やし、メーカーズマークは思いのほか沢山ワインやジンがあったので最初は出さないことにした。その時、あまりにお酒を出しすぎていても飲めないだろうと感じていた。この手のBBQやホームパーティではホストが用意するお酒以外に、参加者皆さんがお酒、特に安いということもありワインを持ち込むことが多いが想定以上にお酒の数が膨れ上がってしまうことに以前から恐怖感があった。自分ではあるだけ飲もうとしてしてしまうため。
メンバーは続々と集まり、試合の振り返りやそこにいないチームメンバーの話をしながら公の乾杯ではないが、その場にいる人たちからビール、もしくは飲めない人はソフトドリンクで乾杯が始まった。最初は立ちながらビールを片手に談笑をしていたが、ビール1本を飲み終わったころにホストがBBQを焼き始めた。手料理を差し入れに持ってこられている方もおり、特にイモモチがありとても美味しかった。その時にチームメイトの一人が連れてきていた犬がイモモチが欲しかったのかずっと追いかけてきた。飼い主に聞いたがイモモチを上げることは不可で、代わりに買い主が犬用ビスケットを専用のおもちゃに入れてあげていた。肉が焼き上がり、ホストが順番にふるまっていた。そのBBQはとても美味しかった。参加人数が多く、すぐに満腹まで食べることはなかった。お菓子のポテトチップスなどをつまみながら談笑を重ねていた。
途中、どなたの子どもかは分からなかったが1歳に満たない子が一人でいたのでけが防止も含めて近くに座るとボールを持ってきて遊んでほしそうにしていたため、一緒に遊ぶことにした。この時点ではビールのみを飲んでおり、自身でまだ酔っている感覚もなかったため、ボールで右手か左手かどっちに入っているか？というゲームをしたり、その子が持ってきたボールを預かったりしていた。10数分以上、一緒に遊んでいたが転がっていったボールをその子が取りに行った際、先の犬と出合い頭にあってしまい、犬が吠えたわけではなかったが突然犬が出てきたのでびっくりしてしまったのか泣いてしまい、保護者の方も来られた。ちょうど犬の買い主も同じところに来たので、出合頭でばったりであったということを双方に説明をした。お昼からの野球の試合で骨折をされた方が無事に家について休養されているということを伺い、一旦安心したが、怪我は改めて怖いと感じた。
引き続き、みんなビールを片手にBBQを楽しんでいたがビールに飽きた方がワインを飲み始めていた。その流れでビールからワインにして引き続きBBQを頂いた。最近、野球部に来られた方でトレイルランニングをされている方とトライルランや出身地方の話などをしたり、また別の方で同じ日から来られた方とはこの野球部がいかに仲がいいかなど共有させていただいた。ちょうどホストの方が電話で、3月まで南アフリカにいらっしゃった方とテレビ電話を繋がれており、挨拶の機会を頂いた。その際、私はすでに酔いが回っていると感じていたがまだテレビ電話を楽しめるほどであった。地元が近く、改めて次回一時帰国をした際に一緒に飲みましょうとお話をした。以前、酔っぱらった際に敬語を使わないなど、粗相をしてしまった方であった。季節上、冬であったが、開始が15時からだったためか、半袖と短パンで参加されている方が夕方頃から寒い寒いと言っており、みんなで季節外れの格好をしてきた方が悪いということで攻められている場面が印象的だった。また、最近の野球の試合では試合後に有志のメンバーがポール完走(350Mほど)をしているが、その参加者が毎週、だんだんタイムが早くなっていっていること、2本までは翌日の筋肉痛がなくなってきていること、でも3本はしんどいということがみんなの総意であった。シーズン中は継続することを有志メンバーで話していた。
そののち、改まった場面となり、野球部一同、20名弱が輪になって集まり、本日のメイントピックであった2024年度の企業対抗ソフトボール大会の実行委員長と副委員長についてのメンバー決めの場面となった。昨年度、副実行委員を行っており、副実行委員から選出するという案もあり、元々自分になるだろうとの予測もあったため、指名をすぐに受けたが特に反対をすることなく実行委員長の役を受け入れた。昨年度と異なり、グラウンドも同日時点で確保できておりその点の負荷が少ないため、大きな支障にはならないと考えた。その時点ではワインを少し、飲んだりしていた。副実行委員の役決めでは昨年度実行委員をしたうちの1名が申し出、またそれ以外にも2名、積極的に申し入れがあったためにすぐに副実行委員長の役割も決まることとなった。メンバー上、昨年実行員を行ったものが自身を入れ2名、また新規で2名となるが、新しいメンバーも非常に心強く、また全員が実行員をサポートするという言質も取れ体制について全く不安を感じていなかった。キャプテンがお話されている最中、グラスがからの方々にワインを継いで回っていた。
メンバー決めが終わった後はまたざっくばらんに飲み会が再開した。その時点で3本、ワインは空いていた。時刻は18時前で、3時間ほど経過していたがまだすぐに買いが終わる様子ではなかった。もうすでにBBQは焼くものがなく、食べ物はお菓子くらいしか残っていなった。同日の試合や、今回のリーグ戦の累積結果などで対象者が飲むような場になり、自身も飲みながらワインを注いで回っていた。一瞬、我に返る場面があり、いつもより自身が関西弁を多く使用していることに気が付いた。一緒にお話していた方もそれに気づき、特に今回初めてゆっくり喋る方に生まれも育ちも大阪であることを共有した。
生憎、BBQ時の記憶はここまでしか残っておらず、気が付いた時には0時に自宅のベッドの上で気が付いた。
INSERT into AlcoData values(その時の様子について、自身がどこかで嘔吐した様子がある一方で、パジャマを着てベッドで寝ていたことを鑑み、どのように会が終了してどのように帰宅したのかを思い出そうとしたが思い出せなかった。脱水症状の予感もあったため急いで手元にあった水を飲みこんだ。また、髪の毛にまだワックスがついておりシャワーを浴びていないことが明らかであったのでシャワーを浴びた。シャワーを浴びている最中に今回の記憶がないのが何かほかの方にご迷惑をおかけしたのではないかと必死に考えてみたが思い出すことが出来なかった。過去の経験上、今回の記憶の無さと嘔吐の感じから迷惑をかけてしまったような嫌な予感はよぎっていた。同年、記憶がないことは何度もあったがこれほどひどい様子は今年初めて出会った。スマホを確認するも特にその情報はグループラインになく、ただ、ホストからリュックサックの忘れ物の連絡とその写真がありリュックサックを会場に忘れてきてしまっていることにその時点で気が付いた。直近記憶がない、会社現地人社長主催のパデル&BBQの会でもラケットとジャケットを失くしてしまっており、また忘れ物をしていることに自己嫌悪を覚えた。まだ、スマホが手元にあってよかったとその瞬間に感じた。シャワーを浴びた後、また水を飲んですぐに寝室に戻り、翌日仕事であることを再認識して眠りについた。","");
INSERT into AlcoData values("0A00000005","0","0000-00-00","0000-00-00","","","","","","","","","","","0","","");
INSERT into AlcoData values("0A00000004","0","0000-00-00","0000-00-00","","","","","","","","","","","0","","");
INSERT into AlcoData values("0A00000002","0","0000-00-00","0000-00-00","","","","","","","","","","","0","","");
INSERT into AlcoData values("0A00000011","0","0000-00-00","0000-00-00","","","毎日。焼酎の炭酸割りを飲み続けています。","朝から飲酒をしてしまう、翌日体調が悪くなって仮病を使って会社を休んでしまう。","","","","","","","0","","");
INSERT into AlcoData values("0A00000012","0","0000-00-00","0000-00-00","","","","","","","","","","","0","","");
INSERT into AlcoData values("0B00000002","0","0000-00-00","0000-00-00","","","","","","","","","","","0","","");

INSERT into AlcoCalendor values("0A00000001","2024-02-12 17:30:00","2024-02-12 19:00:00","サニー号","サンジとフランキー","なんとなく気分がよかった","1","3","1","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","1","1","1","");
INSERT into AlcoCalendor values("0A00000001","2024-02-12 12:10:00","2024-02-12 13:00:00","サニー号","ゾロとウソップ","なんとなく気分がよかった","1","5","1","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","1","2","1","");
INSERT into AlcoCalendor values("0A00000001","2024-02-12 21:00:00","2024-02-13 03:00:00","和の国","ヤマト","カイドウに勝った","1","0","0","0","0","0","0","0","0","1","0","0","0","0","0","0","0","0","0","0","0","");
INSERT into AlcoCalendor values("0A00000001","2024-02-23 19:00:00","2024-02-24 02:00:00","自宅","友人","特になし","1","2","1","1","1","1","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","気持ちよかった");
INSERT into AlcoCalendor values("0A00000001","2024-03-03 00:00:00","2024-03-03 08:00:00","どっか","だれか","なぜか","1","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","");
INSERT into AlcoCalendor values("0A00000001","2024-03-13 00:00:00","2024-03-13 01:00:00","どっか","誰か","なぜか","1","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","");
INSERT into AlcoCalendor values("0A00000001","2024-04-02 09:40:00","2024-04-02 23:00:00","居酒屋","友人","とくに","1","1","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","");
INSERT into AlcoCalendor values("0C00000001","2024-04-06 20:00:00","2024-04-06 23:00:00","自宅","1人","とくになし","0","0","0","1","1","1","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","");
INSERT into AlcoCalendor values("0A00000010","2024-08-09 19:00:00","2024-08-09 21:00:00","旅行先ロッジ","野球部・小出さん、竹本さん","旅行先のため","1","1","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","");
INSERT into AlcoCalendor values("0A00000010","2024-08-10 19:00:00","2024-08-10 21:00:00","旅行先","野球部・小出さん、竹本さん","旅行先","1","2","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","");
INSERT into AlcoCalendor values("0A00000010","2024-08-17 16:00:00","2024-08-17 19:30:00","イタリアンレストラン Salepepe","野球部・竹本さん、サッカー部・吉田さん","スポーツ部親交","1","0","0","0","0","0","0","0","0","0","0","0","1","3","0","0","0","0","0","0","0","記憶を失くさず飲むことが出来た。");
INSERT into AlcoCalendor values("0A00000010","2024-09-09 18:30:00","2024-09-09 22:00:00","名古屋駅近くの中華料理屋","名古屋支店営業課長・チームリーダーと","名古屋出張中に声をかけていただいたため","1","2","2","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","");

INSERT into AlcoToDo values("0A00000001","2024-02-15","3","3","2","1","2","2","1","0");
INSERT into AlcoToDo values("0A00000001","2024-02-16","4","3","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-22","3","3","3","1","3","3","1","1");
INSERT into AlcoToDo values("0A00000001","2024-02-17","0","2","5","0","20","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-21","3","3","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-20","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-19","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-18","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-13","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-12","0","2","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-11","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-10","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-08","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-07","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-06","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-14","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-09","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-01","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-23","3","2","3","1","5","1","1","1");
INSERT into AlcoToDo values("0A00000001","2024-02-24","0","0","0","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-25","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-26","0","0","0","0","2","3","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-27","0","1","0","0","2","2","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-28","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-02-29","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-01","0","0","3","0","18","4","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-02","3","3","2","1","1","2","1","1");
INSERT into AlcoToDo values("0A00000001","2024-03-03","2","2","2","1","2","2","1","1");
INSERT into AlcoToDo values("0A00000001","2024-03-04","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-05","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-06","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-07","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-08","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-09","1","2","20","1","2","2","1","1");
INSERT into AlcoToDo values("0A00000001","2024-03-10","2","1","5","0","0","0","1","0");
INSERT into AlcoToDo values("0A00000001","2024-03-11","2","1","5","0","2","2","0","1");
INSERT into AlcoToDo values("0A00000001","2024-03-14","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000002","2024-03-10","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-12","3","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-13","3","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-15","0","1","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-16","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-18","0","0","20","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-17","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-19","0","0","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-20","0","0","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-21","0","0","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-22","0","1","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-23","0","2","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-24","0","2","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-25","0","1","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-26","0","1","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-27","0","1","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-28","0","1","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-29","0","1","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-30","0","2","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-03-31","0","2","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-04-01","0","1","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-04-02","0","1","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-04-03","0","1","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-04-04","0","1","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-04-05","0","1","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-04-06","0","0","5","1","5","2","0","0");
INSERT into AlcoToDo values("0A00000001","2024-04-07","0","0","5","1","5","2","1","0");
INSERT into AlcoToDo values("0A00000001","2024-04-16","0","0","5","1","10","0","1","0");
INSERT into AlcoToDo values("0A00000001","2024-04-15","0","0","0","1","0","0","1","0");
INSERT into AlcoToDo values("0A00000001","2024-04-17","0","1","5","1","10","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-04-18","0","1","5","1","10","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-04-19","0","0","0","1","0","0","1","0");
INSERT into AlcoToDo values("0A00000001","2024-04-20","0","2","5","1","5","2","0","0");
INSERT into AlcoToDo values("0A00000001","2024-04-21","0","0","5","1","2","2","1","0");
INSERT into AlcoToDo values("0A00000001","2024-04-22","0","1","5","1","5","2","0","0");
INSERT into AlcoToDo values("0A00000001","2024-04-23","0","0","5","1","2","2","1","0");
INSERT into AlcoToDo values("0A00000001","2024-04-24","0","0","5","1","2","2","1","0");
INSERT into AlcoToDo values("0A00000001","2024-04-25","0","0","5","1","2","2","1","0");
INSERT into AlcoToDo values("0A00000001","2024-04-26","0","1","5","1","5","2","0","0");
INSERT into AlcoToDo values("0A00000001","2024-04-27","0","2","5","1","5","2","0","0");
INSERT into AlcoToDo values("0A00000001","2024-04-28","0","2","5","1","5","2","0","0");
INSERT into AlcoToDo values("0A00000001","2024-04-29","0","1","5","1","5","2","0","0");
INSERT into AlcoToDo values("0A00000001","2024-04-30","0","1","5","1","5","2","0","0");
INSERT into AlcoToDo values("0A00000001","2024-05-01","0","0","5","1","2","2","1","0");
INSERT into AlcoToDo values("0A00000002","2024-03-17","3","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-04-08","0","0","5","1","5","2","1","0");
INSERT into AlcoToDo values("0A00000001","2024-04-09","0","1","5","1","10","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-04-10","0","1","5","1","10","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-04-11","0","0","0","1","0","0","1","0");
INSERT into AlcoToDo values("0A00000001","2024-04-12","0","0","0","1","0","0","1","0");
INSERT into AlcoToDo values("0A00000001","2024-04-14","0","2","5","1","10","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-04-13","0","2","5","1","10","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-05-02","0","1","5","1","5","2","0","0");
INSERT into AlcoToDo values("0A00000001","2024-05-03","0","1","5","1","5","2","0","0");
INSERT into AlcoToDo values("0A00000003","2024-03-20","5","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000003","2024-03-21","3","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000003","2024-03-22","3","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000003","2024-03-23","3","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000004","2024-03-20","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000004","2024-03-21","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000004","2024-03-22","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000007","2024-03-21","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000007","2024-03-20","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0B00000002","2024-03-21","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000007","2024-03-22","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000006","2024-03-22","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000005","2024-03-22","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000007","2024-03-24","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000006","2024-03-24","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0B00000002","2024-03-24","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000004","2024-03-24","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000007","2024-03-25","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000006","2024-03-25","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000007","2024-03-29","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0B00000002","2024-03-29","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000006","2024-03-29","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0B00000002","2024-04-02","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000007","2024-04-02","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000005","2024-04-02","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000006","2024-04-02","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000006","2024-04-03","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000006","2024-04-04","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000006","2024-04-05","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000006","2024-04-06","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000007","2024-04-03","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000007","2024-04-04","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000007","2024-04-05","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000007","2024-04-06","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000007","2024-04-07","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000007","2024-04-08","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000007","2024-04-09","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000007","2024-04-10","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000007","2024-04-11","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0B00000002","2024-04-03","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000003","2024-04-03","0","0","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000002","2024-04-06","0","0","20","1","0","0","0","0");
INSERT into AlcoToDo values("0C00000001","2024-04-06","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0B00000002","2024-04-06","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0C00000001","2024-04-07","3","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0C00000001","2024-04-08","3","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0C00000001","2024-04-09","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0C00000001","2024-04-10","3","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0C00000001","2024-04-11","3","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000006","2024-04-11","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000005","2024-04-11","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000004","2024-04-11","3","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000003","2024-04-11","3","0","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000002","2024-04-11","3","0","5","1","2","2","0","0");
INSERT into AlcoToDo values("0B00000002","2024-04-11","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0C00000001","2024-04-15","3","0","0","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-05-14","0","0","5","1","2","2","1","0");
INSERT into AlcoToDo values("0A00000006","2024-05-14","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000008","2024-05-17","3","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000008","2024-05-18","0","2","20","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000008","2024-05-19","0","2","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000007","2024-05-19","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-05-20","0","0","5","1","2","2","1","0");
INSERT into AlcoToDo values("0A00000001","2024-05-21","0","0","0","1","0","0","1","0");
INSERT into AlcoToDo values("0C00000001","2024-05-21","0","0","0","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000008","2024-05-21","0","0","20","0","0","0","1","0");
INSERT into AlcoToDo values("0A00000006","2024-05-21","3","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000004","2024-05-21","3","0","5","1","10","0","0","0");
INSERT into AlcoToDo values("0A00000003","2024-05-21","0","0","5","1","5","2","0","0");
INSERT into AlcoToDo values("0B00000002","2024-05-21","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000002","2024-05-21","3","0","0","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000002","2024-05-20","3","0","0","1","0","0","0","0");
INSERT into AlcoToDo values("0B00000002","2024-05-20","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000008","2024-05-20","0","1","20","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000005","2024-05-20","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000003","2024-05-20","0","0","5","1","5","2","0","0");
INSERT into AlcoToDo values("0A00000007","2024-05-20","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000006","2024-05-20","3","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0C00000001","2024-05-20","0","0","0","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000008","2024-05-22","0","0","5","0","10","0","1","0");
INSERT into AlcoToDo values("0A00000001","2024-05-22","0","0","5","1","2","2","1","0");
INSERT into AlcoToDo values("0A00000008","2024-05-23","0","0","5","0","10","0","1","0");
INSERT into AlcoToDo values("0A00000008","2024-05-24","0","0","5","1","10","0","1","0");
INSERT into AlcoToDo values("0A00000001","2024-05-24","0","0","5","1","2","2","1","0");
INSERT into AlcoToDo values("0A00000008","2024-05-26","0","0","5","1","2","2","1","1");
INSERT into AlcoToDo values("0C00000001","2024-05-30","3","0","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000001","2024-05-30","0","0","5","1","2","2","1","0");
INSERT into AlcoToDo values("0A00000001","2024-05-31","0","0","5","1","2","2","1","0");
INSERT into AlcoToDo values("0A00000009","2024-06-10","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000008","2024-06-10","0","0","5","1","2","2","1","1");
INSERT into AlcoToDo values("0A00000009","2024-06-11","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000009","2024-06-19","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000009","2024-06-20","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-07-24","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000009","2024-07-24","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-07-25","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-01","3","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-03","3","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-04","3","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-05","3","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-07","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-08","3","0","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-14","3","0","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-13","3","0","20","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-12","3","0","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-11","3","0","20","1","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-10","3","0","20","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-09","3","0","20","0","0","0","0","0");
INSERT into AlcoToDo values("0C00000001","2024-08-09","0","0","5","1","2","2","0","1");
INSERT into AlcoToDo values("0A00000010","2024-08-15","0","1","20","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-19","0","1","20","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-21","0","1","20","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-22","0","1","5","0","10","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-23","0","0","5","0","10","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-24","0","0","5","0","10","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-25","0","0","5","0","10","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-26","0","0","5","0","10","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-27","0","0","5","0","10","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-28","0","0","5","0","10","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-29","0","1","5","0","10","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-30","0","1","5","0","10","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-31","0","1","5","0","10","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-09-01","0","1","5","0","10","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-09-02","0","1","5","0","10","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-09-03","0","1","5","0","10","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-09-04","0","1","5","0","10","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-09-05","0","1","5","0","5","2","0","0");
INSERT into AlcoToDo values("0A00000010","2024-09-06","0","1","5","0","5","2","0","0");
INSERT into AlcoToDo values("0A00000010","2024-09-07","0","1","5","0","5","2","0","0");
INSERT into AlcoToDo values("0A00000008","2024-08-22","0","0","5","1","2","2","1","1");
INSERT into AlcoToDo values("0A00000001","2024-08-23","0","0","5","0","2","2","1","0");
INSERT into AlcoToDo values("0A00000008","2024-08-23","0","0","5","1","2","2","1","1");
INSERT into AlcoToDo values("0A00000001","2024-08-24","0","0","5","0","2","2","1","0");
INSERT into AlcoToDo values("0A00000001","2024-08-25","0","0","5","0","2","2","1","0");
INSERT into AlcoToDo values("0C00000001","2024-08-23","5","0","5","1","2","2","0","1");
INSERT into AlcoToDo values("0A00000005","2024-08-23","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000004","2024-08-23","3","0","5","1","2","2","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-16","0","1","20","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-20","0","1","20","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-18","0","1","20","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-08-17","0","1","20","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000007","2024-08-23","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000002","2024-08-23","3","0","5","1","2","2","0","0");
INSERT into AlcoToDo values("0A00000010","2024-06-21","3","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000008","2024-09-07","0","0","5","0","2","2","1","1");
INSERT into AlcoToDo values("0A00000001","2024-09-07","0","0","5","0","2","2","1","0");
INSERT into AlcoToDo values("0A00000001","2024-09-08","0","0","5","0","2","2","1","0");
INSERT into AlcoToDo values("0A00000008","2024-09-08","0","0","5","0","2","2","1","1");
INSERT into AlcoToDo values("0A00000010","2024-09-08","0","1","5","0","5","2","0","0");
INSERT into AlcoToDo values("0A00000002","2024-09-08","3","0","5","1","2","2","0","0");
INSERT into AlcoToDo values("0A00000002","2024-09-07","3","0","5","1","2","2","0","0");
INSERT into AlcoToDo values("0A00000010","2024-09-09","0","1","5","0","5","2","0","0");
INSERT into AlcoToDo values("0A00000010","2024-09-11","0","1","5","0","5","2","0","0");
INSERT into AlcoToDo values("0A00000010","2024-09-10","0","1","5","0","5","2","0","0");
INSERT into AlcoToDo values("0A00000001","2024-09-11","0","0","5","0","2","2","1","0");
INSERT into AlcoToDo values("0A00000008","2024-09-11","0","0","5","0","2","2","1","1");
INSERT into AlcoToDo values("0A00000010","2024-09-12","0","1","5","0","5","2","0","0");
INSERT into AlcoToDo values("0A00000011","2024-09-12","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000012","2024-09-12","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000012","2024-09-13","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000011","2024-09-13","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-09-13","0","1","5","0","5","2","0","0");
INSERT into AlcoToDo values("0A00000011","2024-09-14","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000012","2024-09-14","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-09-14","0","1","5","0","5","2","0","0");
INSERT into AlcoToDo values("0A00000011","2024-09-15","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0B00000002","2024-09-15","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000011","2024-09-16","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000010","2024-09-17","0","1","5","0","5","2","0","0");
INSERT into AlcoToDo values("0A00000010","2024-09-16","0","1","5","0","5","2","0","0");
INSERT into AlcoToDo values("0A00000010","2024-09-15","0","1","5","0","5","2","0","0");
INSERT into AlcoToDo values("0A00000010","2024-09-18","0","1","5","0","5","2","0","0");
INSERT into AlcoToDo values("0A00000010","2024-09-19","0","1","5","0","2","2","0","1");
INSERT into AlcoToDo values("0A00000010","2024-09-20","0","1","5","0","2","2","0","1");
INSERT into AlcoToDo values("0A00000011","2024-09-03","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000012","2024-09-03","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000012","2024-09-19","0","0","0","0","0","0","0","0");
INSERT into AlcoToDo values("0A00000009","2024-09-19","0","0","0","0","0","0","0","0");

INSERT into AlcoProcess values("0A00000001","2024-03-12","1","1");
INSERT into AlcoProcess values("0A00000001","2024-03-07","1","2");
INSERT into AlcoProcess values("0A00000001","2024-04-08","1","4");
INSERT into AlcoProcess values("0A00000001","2024-03-19","1","5");
INSERT into AlcoProcess values("0A00000001","2024-04-22","1","6");
INSERT into AlcoProcess values("0A00000001","2024-05-06","1","7");
INSERT into AlcoProcess values("0A00000001","2024-05-20","2","1");
INSERT into AlcoProcess values("0A00000002","2024-07-08","2","1");
INSERT into AlcoProcess values("0A00000001","2024-03-14","2","2");
INSERT into AlcoProcess values("0A00000001","2024-03-15","1","3");
INSERT into AlcoProcess values("0A00000002","2024-03-17","1","2");
INSERT into AlcoProcess values("0A00000002","2024-03-17","1","1");
INSERT into AlcoProcess values("0A00000002","2024-05-27","1","4");
INSERT into AlcoProcess values("0A00000002","2024-03-24","1","5");
INSERT into AlcoProcess values("0A00000002","2024-06-10","1","6");
INSERT into AlcoProcess values("0A00000002","2024-06-24","1","7");
INSERT into AlcoProcess values("0A00000003","2024-05-23","2","1");
INSERT into AlcoProcess values("0A00000003","2024-03-20","1","1");
INSERT into AlcoProcess values("0A00000003","2024-03-20","1","2");
INSERT into AlcoProcess values("0A00000003","2024-04-11","1","4");
INSERT into AlcoProcess values("0A00000003","2024-03-27","1","5");
INSERT into AlcoProcess values("0A00000003","2024-04-25","1","6");
INSERT into AlcoProcess values("0A00000003","2024-05-09","1","7");
INSERT into AlcoProcess values("0A00000004","2024-06-25","2","1");
INSERT into AlcoProcess values("0A00000004","2024-04-30","1","1");
INSERT into AlcoProcess values("0A00000004","2024-04-30","1","2");
INSERT into AlcoProcess values("0A00000004","2024-05-07","1","4");
INSERT into AlcoProcess values("0A00000004","2024-05-07","1","5");
INSERT into AlcoProcess values("0A00000004","2024-05-21","1","6");
INSERT into AlcoProcess values("0A00000004","2024-06-04","1","7");
INSERT into AlcoProcess values("0C00000001","2024-07-08","2","1");
INSERT into AlcoProcess values("0C00000001","2024-04-06","1","1");
INSERT into AlcoProcess values("0C00000001","2024-05-27","1","4");
INSERT into AlcoProcess values("0C00000001","2024-04-13","1","5");
INSERT into AlcoProcess values("0C00000001","2024-06-10","1","6");
INSERT into AlcoProcess values("0C00000001","2024-06-24","1","7");
INSERT into AlcoProcess values("0C00000001","2024-07-08","1","9");
INSERT into AlcoProcess values("0A00000008","2024-05-19","2","1");
INSERT into AlcoProcess values("0A00000008","2024-05-17","1","1");
INSERT into AlcoProcess values("0A00000008","2024-04-07","1","4");
INSERT into AlcoProcess values("0A00000008","2024-05-24","1","5");
INSERT into AlcoProcess values("0A00000008","2024-04-21","1","6");
INSERT into AlcoProcess values("0A00000008","2024-05-05","1","7");
INSERT into AlcoProcess values("0A00000008","2024-05-19","1","9");
INSERT into AlcoProcess values("0A00000006","2024-07-08","2","1");
INSERT into AlcoProcess values("0A00000006","2024-05-20","1","1");
INSERT into AlcoProcess values("0A00000006","2024-05-27","1","4");
INSERT into AlcoProcess values("0A00000006","2024-05-27","1","5");
INSERT into AlcoProcess values("0A00000006","2024-06-10","1","6");
INSERT into AlcoProcess values("0A00000006","2024-06-24","1","7");
INSERT into AlcoProcess values("0A00000006","2024-07-08","1","9");
INSERT into AlcoProcess values("","2024-05-26","0","0");
INSERT into AlcoProcess values("0A00000010","2024-09-19","2","1");
INSERT into AlcoProcess values("0A00000010","2024-08-01","1","1");
INSERT into AlcoProcess values("0A00000010","2024-08-08","1","4");
INSERT into AlcoProcess values("0A00000010","2024-08-08","1","5");
INSERT into AlcoProcess values("0A00000010","2024-08-22","1","6");
INSERT into AlcoProcess values("0A00000010","2024-09-05","1","7");
INSERT into AlcoProcess values("0A00000010","2024-09-19","1","9");

INSERT into FunEvents values("0A00000001","50","2024-03-09","2024-03-11","1","aaaaaaaaaaabb","1","AAAAAAAAAAABB");
INSERT into FunEvents values("0A00000001","1","2024-03-01","2024-03-01","1","bbb","1","ddddd");
INSERT into FunEvents values("0A00000001","2","2024-03-01","2024-03-11","1","Yeah2","1","OhYeah2");
INSERT into FunEvents values("0A00000001","3","2024-03-09","2024-03-14","1","","1","dddddd");
INSERT into FunEvents values("0A00000001","5","2024-03-13","2024-03-11","1","aaaa","1","BBBBB");
INSERT into FunEvents values("0A00000001","4","2024-03-11","2024-03-11","1","OhYeah","1","OhmyGod");
INSERT into FunEvents values("0A00000001","6","2024-03-11","2024-03-14","1","aaaa","1","ggggg");
INSERT into FunEvents values("0A00000001","7","2024-03-13","2024-03-14","1","hhhhh","1","");
INSERT into FunEvents values("0A00000001","8","2024-03-13","2024-03-14","1","iiiiii","1","");
INSERT into FunEvents values("0A00000001","9","2024-03-13","2024-03-14","1","JJJJJ","1","");
INSERT into FunEvents values("0A00000001","10","2024-03-13","2024-03-14","1","","1","");
INSERT into FunEvents values("0A00000001","11","2024-03-13","2024-03-14","1","","1","");
INSERT into FunEvents values("0A00000001","12","2024-03-13","2024-03-14","1","","1","");
INSERT into FunEvents values("0A00000001","13","2024-03-13","2024-03-14","1","","1","");
INSERT into FunEvents values("0A00000001","14","2024-03-13","2024-03-14","1","","1","");
INSERT into FunEvents values("0A00000001","15","2024-03-13","2024-03-14","1","","1","");
INSERT into FunEvents values("0A00000001","16","2024-03-13","2024-03-14","1","","1","");
INSERT into FunEvents values("0A00000001","17","2024-03-13","2024-03-14","1","","1","");
INSERT into FunEvents values("0A00000001","18","2024-03-13","2024-03-14","1","","1","");
INSERT into FunEvents values("0A00000001","19","2024-03-13","2024-03-14","1","","1","");
INSERT into FunEvents values("0A00000001","20","2024-03-13","2024-03-14","1","","1","");
INSERT into FunEvents values("0A00000001","21","2024-03-13","2024-03-14","1","","1","");
INSERT into FunEvents values("0A00000001","22","2024-03-13","2024-03-14","1","","1","");
INSERT into FunEvents values("0A00000001","23","2024-03-13","2024-03-14","1","","1","");
INSERT into FunEvents values("0A00000001","24","2024-03-13","2024-03-14","1","","1","");
INSERT into FunEvents values("0A00000001","25","2024-03-13","2024-03-14","1","","1","");
INSERT into FunEvents values("0A00000001","26","2024-03-13","2024-03-14","1","","1","");
INSERT into FunEvents values("0A00000001","27","2024-03-13","2024-03-14","1","","1","");
INSERT into FunEvents values("0A00000001","28","2024-03-13","2024-03-14","1","","1","");
INSERT into FunEvents values("0A00000001","29","2024-03-14","2024-03-14","1","","1","");
INSERT into FunEvents values("0A00000001","49","2024-03-14","2024-04-06","1","","1","a");
INSERT into FunEvents values("0A00000001","48","2024-03-14","2024-04-06","1","","1","a");
INSERT into FunEvents values("0A00000001","47","2024-03-14","2024-04-06","1","","1","a");
INSERT into FunEvents values("0A00000001","46","2024-03-14","2024-04-06","1","","1","a");
INSERT into FunEvents values("0A00000001","45","2024-03-14","2024-04-06","1","","1","a");
INSERT into FunEvents values("0A00000001","44","2024-03-14","2024-04-06","1","","1","a");
INSERT into FunEvents values("0A00000001","43","2024-03-14","2024-04-06","1","","1","a");
INSERT into FunEvents values("0A00000001","42","2024-03-14","2024-04-06","1","","1","a");
INSERT into FunEvents values("0A00000001","41","2024-03-14","2024-04-06","1","","1","a");
INSERT into FunEvents values("0A00000001","40","2024-03-14","2024-04-06","1","","1","a");
INSERT into FunEvents values("0A00000001","39","2024-03-14","2024-03-15","1","","1","");
INSERT into FunEvents values("0A00000001","38","2024-03-14","2024-03-15","1","","1","");
INSERT into FunEvents values("0A00000001","37","2024-03-14","2024-03-15","1","","1","");
INSERT into FunEvents values("0A00000001","36","2024-03-14","2024-03-15","1","","1","");
INSERT into FunEvents values("0A00000001","35","2024-03-14","2024-03-15","1","","1","");
INSERT into FunEvents values("0A00000001","34","2024-03-14","2024-03-15","1","","1","");
INSERT into FunEvents values("0A00000001","33","2024-03-14","2024-03-15","1","","1","");
INSERT into FunEvents values("0A00000001","32","2024-03-14","2024-03-15","1","","1","");
INSERT into FunEvents values("0A00000001","31","2024-03-14","2024-03-15","1","","1","");
INSERT into FunEvents values("0A00000001","30","2024-03-14","2024-03-15","1","","1","");
INSERT into FunEvents values("0C00000001","4","2024-04-07","2024-08-23","1","ジャンパ-を買った","0","");
INSERT into FunEvents values("0C00000001","3","2024-04-07","2024-08-23","1","こんにちは","0","");
INSERT into FunEvents values("0C00000001","2","2024-04-07","2024-08-23","1","テスト","0","");
INSERT into FunEvents values("0C00000001","1","2024-04-07","2024-08-23","1","ジャケットを買った！","0","");
INSERT into FunEvents values("0A00000008","1","2024-05-18","2024-05-21","1","良かったことの簡単書き出し1","1","良かったことの詳細1");
INSERT into FunEvents values("0A00000008","2","2024-05-18","2024-05-21","1","良かったことの簡単書き出し2","1","良かったことの詳細2");
INSERT into FunEvents values("0A00000008","3","2024-05-18","2024-05-21","1","良かったことの簡単書き出し3","1","良かったことの詳細3");
INSERT into FunEvents values("0A00000008","4","2024-05-18","2024-05-21","1","良かったことの簡単書き出し4","1","良かったことの詳細4");
INSERT into FunEvents values("0A00000008","5","2024-05-18","2024-05-21","1","良かったことの簡単書き出し5","1","良かったことの詳細5");
INSERT into FunEvents values("0A00000008","6","2024-05-18","2024-05-21","1","良かったことの簡単書き出し6","1","良かったことの詳細6");
"0A00000008","7","2024-05-18","2024-05-21","1","良かったことの簡単書き出し7
INSERT into FunEvents values(","1","良かったことの詳細7");
INSERT into FunEvents values("0A00000008","8","2024-05-18","2024-05-21","1","良かったことの簡単書き出し8","1","良かったことの詳細8");
INSERT into FunEvents values("0A00000008","9","2024-05-18","2024-05-21","1","良かったことの簡単書き出し9","1","良かったことの詳細9");
INSERT into FunEvents values("0A00000008","10","2024-05-18","2024-05-21","1","良かったことの簡単書き出し10","1","良かったことの詳細10");
INSERT into FunEvents values("0A00000008","11","2024-05-18","2024-05-21","1","良かったことの簡単書き出し11","1","良かったことの詳細11");
INSERT into FunEvents values("0A00000008","12","2024-05-18","2024-05-21","1","良かったことの簡単書き出し12","1","良かったことの詳細12");
INSERT into FunEvents values("0A00000008","13","2024-05-18","2024-05-21","1","良かったことの簡単書き出し13","1","良かったことの詳細13");
INSERT into FunEvents values("0A00000008","14","2024-05-18","2024-05-21","1","良かったことの簡単書き出し14","1","良かったことの詳細14");
INSERT into FunEvents values("0A00000008","15","2024-05-18","2024-05-21","1","良かったことの簡単書き出し15","1","良かったことの詳細15");
INSERT into FunEvents values("0A00000008","16","2024-05-18","2024-05-21","1","良かったことの簡単書き出し16","1","良かったことの詳細16");
INSERT into FunEvents values("0A00000008","17","2024-05-18","2024-05-21","1","良かったことの簡単書き出し17","1","良かったことの詳細17");
INSERT into FunEvents values("0A00000008","18","2024-05-18","2024-05-19","1","良かったことの簡単書き出し18","1","良かったことの詳細18");
INSERT into FunEvents values("0A00000008","19","2024-05-18","2024-05-21","1","良かったことの簡単書き出し19","1","良かったことの詳細19");
INSERT into FunEvents values("0A00000008","20","2024-05-18","2024-05-21","1","良かったことの簡単書き出し20","1","良かったことの詳細20");
INSERT into FunEvents values("0A00000008","21","2024-05-18","2024-05-21","1","良かったことの簡単書き出し21","1","良かったことの詳細21");
INSERT into FunEvents values("0A00000008","22","2024-05-18","2024-05-21","1","良かったことの簡単書き出し22","1","良かったことの詳細22");
INSERT into FunEvents values("0A00000008","23","2024-05-18","2024-05-21","1","良かったことの簡単書き出し23","1","良かったことの詳細23");
INSERT into FunEvents values("0A00000008","24","2024-05-18","2024-05-21","1","良かったことの簡単書き出し24","1","良かったことの詳細24");
INSERT into FunEvents values("0A00000008","25","2024-05-18","2024-05-21","1","良かったことの簡単書き出し25","1","良かったことの詳細25");
INSERT into FunEvents values("0A00000008","26","2024-05-18","2024-05-21","1","良かったことの簡単書き出し26","1","良かったことの詳細26");
INSERT into FunEvents values("0A00000008","27","2024-05-18","2024-05-21","1","良かったことの簡単書き出し27","1","良かったことの詳細27");
INSERT into FunEvents values("0A00000008","28","2024-05-18","2024-05-21","1","良かったことの簡単書き出し28","1","良かったことの詳細28");
INSERT into FunEvents values("0A00000008","29","2024-05-18","2024-05-21","1","良かったことの簡単書き出し29","1","良かったことの詳細29");
INSERT into FunEvents values("0A00000008","30","2024-05-18","2024-05-21","1","良かったことの簡単書き出し30","1","良かったことの詳細30");
INSERT into FunEvents values("0A00000008","31","2024-05-18","2024-05-21","1","良かったことの簡単書き出し31","1","良かったことの詳細31");
INSERT into FunEvents values("0A00000008","32","2024-05-18","2024-05-21","1","良かったことの簡単書き出し32","1","良かったことの詳細32");
INSERT into FunEvents values("0A00000008","33","2024-05-18","2024-05-21","1","良かったことの簡単書き出し33","1","良かったことの詳細33");
INSERT into FunEvents values("0A00000008","34","2024-05-18","2024-05-21","1","良かったことの簡単書き出し34","1","良かったことの詳細34");
INSERT into FunEvents values("0A00000008","35","2024-05-18","2024-05-21","1","良かったことの簡単書き出し35","1","良かったことの詳細35");
INSERT into FunEvents values("0A00000008","36","2024-05-18","2024-05-21","1","良かったことの簡単書き出し36","1","良かったことの詳細36");
INSERT into FunEvents values("0A00000008","37","2024-05-18","2024-05-21","1","良かったことの簡単書き出し37","1","良かったことの詳細37");
INSERT into FunEvents values("0A00000008","38","2024-05-18","2024-05-21","1","良かったことの簡単書き出し38","1","良かったことの詳細38");
INSERT into FunEvents values("0A00000008","39","2024-05-18","2024-05-21","1","良かったことの簡単書き出し39","1","良かったことの詳細39");
INSERT into FunEvents values("0A00000008","40","2024-05-18","2024-05-21","1","良かったことの簡単書き出し40","1","良かったことの詳細40");
INSERT into FunEvents values("0A00000008","41","2024-05-18","2024-05-21","1","良かったことの簡単書き出し41","1","良かったことの詳細41");
INSERT into FunEvents values("0A00000008","42","2024-05-18","2024-05-21","1","良かったことの簡単書き出し42","1","良かったことの詳細42");
INSERT into FunEvents values("0A00000008","43","2024-05-18","2024-05-21","1","良かったことの簡単書き出し43","1","良かったことの詳細43");
INSERT into FunEvents values("0A00000008","44","2024-05-18","2024-05-21","1","良かったことの簡単書き出し44","1","良かったことの詳細44");
INSERT into FunEvents values("0A00000008","45","2024-05-18","2024-05-21","1","良かったことの簡単書き出し45","1","良かったことの詳細45");
INSERT into FunEvents values("0A00000008","46","2024-05-18","2024-05-21","1","良かったことの簡単書き出し46","1","良かったことの詳細46");
INSERT into FunEvents values("0A00000008","47","2024-05-18","2024-05-21","1","良かったことの簡単書き出し47","1","良かったことの詳細47");
INSERT into FunEvents values("0A00000008","48","2024-05-18","2024-05-21","1","良かったことの簡単書き出し48","1","良かったことの詳細48");
INSERT into FunEvents values("0A00000008","49","2024-05-18","2024-05-21","1","良かったことの簡単書き出し49","1","良かったことの詳細49");
INSERT into FunEvents values("0A00000008","50","2024-05-18","2024-05-21","1","良かったことの簡単書き出し50","1","良かったことの詳細50");
INSERT into FunEvents values("0C00000001","5","2024-05-30","2024-08-23","1","旅行に行った","0","");
INSERT into FunEvents values("0A00000010","1","2024-08-05","2024-08-22","1","7歳の頃、父の田舎(福島県)に家族で行った。","1","夏休みに家族(父・母・妹)と車で父の実家である福島県まで、大阪の自宅から車で向かうことになった。横須賀のパーキングエリアで休憩を取った。車酔いがひどく、母から車内でゲームボーイで遊ばないように言われた。サービスエリアでブルーハワイのかき氷を食べて、舌が真っ青になって面白かった。イチゴのかき氷を食べていた妹は赤くなっていた。父の田舎までは車では遠かったが、車内で眠っていたこともありすぐについた感覚だった。近くに猪苗代湖がありそこにすぐに父の兄弟とその家族とで遊びに行くことになった。初めての湖で魚を見つけて追いかけていた。また、夕方に祖母の家に戻ったが、そこでたくさんのトンボが飛んでいて叔父と一緒にトンボを捕まえていた。あまり大阪では見ない、低空を飛び続けるトンボ、糸のような線の細いトンボ、圧倒的に動きが早いトンボなど、種類も沢山いて興奮した。叔父がトンボを網でとるのがとてもうまかった。「どれどれ？」という良く言う叔父で、父と妹と、彼は「どれどれおじさん」という愛称をつけていた。自宅に大きな庭があり、トウモロコシやトマトなどが植えられていて、実りたてのトウモロコシを蒸してもらって食べたときに、とても甘く感じた。食卓ではきびなごの佃煮が出てきて、この時まではきびなごは虫取りで捕まえるバッタの様な昆虫という認識しかなく、その時は食べることができなった。一方で、祖母からは戦時中は昆虫でも何でも食べていたということを聞かされたが、昆虫を食べるというところまでは想像することができなった。夜は蚊取り線香を炊くまでは大阪と一緒だったが、蚊帳があり、初めて蚊帳をみて子どもながらに異文化を感じていた。夏であるのに夜もとても暑くはなく、網戸で外が見えていて、また大阪の空とは異なり、沢山の星が空を埋め尽くしていて星空観察が楽しかった。どの星が一番光っているかなど、妹と話して喧嘩をした。移動もあって疲れていたのかすぐに眠りについた。");
INSERT into FunEvents values("0A00000010","2","2024-08-05","2024-09-20","1","7歳の頃、ゲームボーイを買ってもらった。","0","");
INSERT into FunEvents values("0A00000010","3","2024-08-05","2024-08-22","1","9歳の頃、引っ越しをして新しい街に来た。","1","大阪市西淀川区の中島工業団地近くから、母の祖母の家の近くである大阪市北区に引っ越した。引っ越す前は小さな小学校と、坂の上の駄菓子屋、大きな木がある公園があり友達とよく遊んでいたが、新しい街はそれよりも少し都会にあり車の数などに驚かされた。引っ越し時、自分の部屋が与えられることになり、今まで使っていた勉強机はそのままであったが、今までは妹と2段ベッドだったが、新しくベッドが部屋に来ることになり自分の部屋があることに嬉しくなった。新しい部屋のコンセントの都合上、机やベッドの位置が決められていたが、北枕は風水上良くないということを聞き、北枕にならないように配置を考えた。その問題は偶然にも西を頭に寝ることになっていて安心した。学校のものなど机に整理していくとすぐに机の引き出しがいっぱいになった。新しい学校に行くという不安はあまりなく、淡々と準備をしていた。今までの家は2階建てだったが新しい家は3階建てで、一階は物置となっていて薄暗くて怖かった。一方で三階への階段を上ったところに屋根裏部屋があり、秘密基地のようなイメージがありワクワクして上った。屋根に一番近いところなので、引っ越した9月でもまだ蒸し暑く、すぐに汗だくになってしまった。父の釣り道具などが置かれていて釣りに行きたくなった。自分の部屋にカーテンが取り付けられたが、隣の家の外壁が窓を開けてすぐにあったが、外壁に触れると手がドロドロになってしまった。今まで祖母の家に置かれていたピアノが引っ越し時に自宅に来ることになり、すぐに練習ができる環境に嬉しくなった。引っ越してまだ両親が忙しくしているときにピアノを弾いて遊んでいた。夕方にまだ片付いていなかったので祖母の家で夕食を食べた。今まで車で30分くらいかかっていた祖母の家が歩いていくことができることに改めて驚いた。夕食後、新しい家に戻ったが、新しい家にすぐに慣れずなかなか眠ることができなった。");
INSERT into FunEvents values("0A00000010","4","2024-08-05","2024-09-20","1","9歳の頃、引っ越してすぐにドッヂボールをきっかけに友達が出来た。","0","");
INSERT into FunEvents values("0A00000010","5","2024-08-05","2024-08-22","1","10歳の頃、習っていた塾で先に学習を進めることで参加できる祭典に参加できた。","1","公文式を小学校1年生くらいから国語・英語・算数を始めていたが、算数だけは次々と新しい分野に進むことが出来当時4年生であったが、中学生の教材に進むことが出来ていた。このおかげで小学校のテストで算数はいつも高得点を取ることが出来ていた。ある日、公文の先生から渡された案内書を母に渡したところ、自分よりも先の学年の勉強をしている塾生のみが参加できる「進度上位者の集い」というイベントへの参加資格について、算数について与えられるということが分かった。それがどれくらいすごいのか、見当はつかなかったが、イベントに参加できるとのことで参加することにした。その時、自分が全く知らない人たちが沢山の学校から来ており、自分は学校の中では算数だけはいつも高得点を取れ得意分野だと思っていたが、学校外にはたくさんの、同じか、もしくはそれ以上に先の学習をしている子たちがいることに驚かされた。特に周りの子とお話しする機会はなかったが、6学年以上先に進んでいる子のスピーチが学習に対しての意気込みを感じる、印象的なものであった。また、自身は算数だけであったが、一人で国語・英語・算数全ての分野で3学年以上先の勉強をしている子たちもいて、また2教科で進んでいる子も沢山おり、小学校1,2年生でもすでに自分より先の学習をしている子たちもいて圧倒された。子どもながらに自分とは生まれ育った環境が違う、勝負しても勝負にならなと感じていた。表彰式のような形で一人一人、記念のオブジェを与えられたが一教科だけとはいえ誇りを感じることが出来た。毎年やっているイベントとのことでまたこの場所に来たいと感じた。3学年以上先の分野の勉強を継続することは厳しく感じていたが、いいモチベーションになった。「やっててよかった公文式」とみんなで発声する場面があり、テレビのコマーシャルでは良く見たが自身がその発声することになるとは思っていなかった。付き添ってくれた母に勉強頑張ると帰り道に伝えた。");
INSERT into FunEvents values("0A00000010","6","2024-08-05","2024-09-20","1","10歳の頃入っていた地域のソフトボールの大会で初めてヒットを打った。","0","");
INSERT into FunEvents values("0A00000010","7","2024-08-05","2024-08-22","1","11歳の頃入っていた地域のソフトボールチームでキャプテンを務めた。","1","引っ越して少したってから小学校のソフトボールチームに所属していたが、5年生の最後に、1つ上の先輩たちが卒業となったときに自身がキャプテンを務めることになった。同じ学年では自分を入れても4人しかおらず、また、3年生から長く続けていたのは2人しかいなかった。1つ上の世代のキャプテンがコーチの息子で、ソフトボール・野球が攻撃も守備もとても上手であったため、同じようなキャプテンにはなれないと考えていた。また、一つ上の世代にはたくさん先輩がいて、5年生の時はあまり試合にも出ることができなったので試合慣れもしていないので不安はあった。いざ新体制が始まると、コーチのサポートも得ながらではあったがチームの中心になることに違和感はなくなった。バッティングは試行錯誤を重ねていたがイチローをまねしてみると意外と打つことが出来、また特にソフトボール特有の早いためにもついていくことができるようになった。守備は元々苦手ではなかったが、センターを守り、レフトとライトは後輩が守備に就くケースが多かったが連携を取りながらうまく進めることが出来た。ピッチャーは3つ下の学年にとても上手な後輩がいたため試合を作ることが出来ていた。自分のチームという考えはなかったが、みんなで試合に出場して勝つことは嬉しかった。また特に4人しかいない同学年の子が活躍するのはとても嬉しかった。みんな特色が違い、守備がうまい、キャッチャーが出来る、バッティングのみ取り柄だが、圧倒的打力があるなど、一緒にソフトボールをしていて楽しかった。ベースランニングリレーなどを良く行っていたが、小学生ながらに本気で走ることが楽しかった。近隣に2つの小学校があったが、特に隣の小学校のチームとはよく合同練習や練習試合を行っており、同じ学年の子と仲良くなることが出来た。お互いの特色がばれていて極端なシフトを引くなどジュニアながら戦略なども使い楽しくソフトボールが出来た。");
INSERT into FunEvents values("0A00000010","8","2024-08-05","2024-09-20","1","11歳の頃家で買っていた猫が子どもを産み子猫がなついた。","0","");
INSERT into FunEvents values("0A00000010","9","2024-08-05","2024-08-22","1","13歳の頃、父と明石沖に船釣りに出掛けた。","1","中学1年生の春休みの1日だったが、野球部の練習を不参加にさせていただき、父と船釣りに出掛けた。深夜、自宅を出発し、真っ暗でまだ寒い中防寒具を着て車で出発した。明石、二見沖で船釣りをするというものだったが、道中2回ほどコンビニであったかい飲み物やパンを買って社内で食べていた。1時間半ほど車で走ったところで指定の港に着いた。まだ船が出発する時間までは時間があった。あたりはまだまだ暗かった。時間まで父と、車についているテレビでやっている番組を見ていた。深夜ではあったが、洋画劇場のようなものがあり、007シリーズの映画がやっていた。父はスポーツ新聞を見ておりその映画はあまり見ていなかったがどちらが悪者か、という話には付き合ってくれていた。いざ船に乗り込む時間になったら自分の専用の餌箱があり竿とリールはその船についているものを使用することとなった。狙いはロックフィッシュの類であったため、"底を取る"ということがとても重要であると聞かされた。それまでにも釣りは陸からではあるが何度かやったこともあったが、船の上から、底をとるということにイメージがつかなかったがやってみるとすぐに底に錘がつくという感覚をつかむことが出来た。エサは青虫やエビであったが、思うように釣ることが出来、日が上がってからは父とどれだけ多く釣ったか、大きな魚を釣ったか、珍しい魚を釣ったかで勝負することになった。すっかり夢中になり、昼前には時間切れとなった。自分はガシラが沢山連れた一方、父は大きなメバルなども釣っており、勝負は父の価値ということになった。今まで陸から釣っていたアジや太刀魚とは違う魚を釣るということが初めてでとても印象的であった。陸からは釣れないこともあったので、クーラーボックス一杯にして自宅に帰ることも嬉しかった。自宅についてその日の夜には母が捌いた魚が夕食に出てきた。魚の煮つけはそれまであまり好きではなかったが、自分で釣った魚ということもありその日から好きになった。");
INSERT into FunEvents values("0A00000010","10","2024-08-05","2024-09-20","1","14歳の頃、初めて彼女が出来た。","0","");
INSERT into FunEvents values("0A00000010","11","2024-08-05","2024-08-22","1","14歳の頃、神戸の震災復興のイベント、ルミナリエを見た。","1","冬休みの一日で彼女とデートに出かけることになり神戸のルミナリエに行くことになった。それぞれ両親に帰りが少し遅くなることを伝え、21時には帰ることとして神戸に向けて出発した。大阪から尼崎まではよく友達の家に遊びに行っていたが、尼崎以上に自分で出かけるのは初めてで少し長い時間電車に乗っていると感じていた。元町に降り立ったが町自体、ルミナリエのイルミネーションとは別にクリスマス近くということもありすでに色とりどりで会った。コンビニであったかい飲み物を仕入れて歩いていると、出店がいっぱいありフランクフルトがとても美味しそうだった。ルミナリエ会場を目指して歩いていると南京町の近くを通り、偶然、昔家族で行ったことがあるレタスで包んで味付けされた豚ミンチをくるんで食べる中華料理がおいしい店を見つけ彼女にいかにおいしいかを説明していた。中華まんなども売られており、天神祭りや大きなお祭りのような印象を感じた。ルミナリエのイルミネーションは大きな通りに沿って長い距離にわたって飾られており、今まで見たことのある大阪のスカイビルにあるようなドイツのクリスマスマーケットのイルミネーションよりもはるかに大きく、きれいで、インパクトがあった。近くの人は写真などを取っていたが、携帯のカメラではきれいに取ることが出来なかった。ただ、カメラに収めるよりも目の前にあるイルミネーションが本当にきれいで、いつまでも見ていることが出来そうなほどだった。ルミナリエは阪神淡路大震災の復興のイベントであり、震災当時の家は一部被災もしていたが復興に関して率直にすごいと感じた。ずっと歩きながら三宮方面に向かっていて、沢山の人が通りを歩いていて中々思うように歩くことはできなかったが、イルミネーションを見飽きずに上を見ながら歩いていた。協会のステンドグラスをイメージさせるようなイルミネーションもあった。寒くなってきたので夜遅くなる前にまた電車に乗って大阪に戻った。");
INSERT into FunEvents values("0A00000010","12","2024-08-05","2024-09-20","1","14歳の頃、母の知り合いのジムトレーナーの下でトレーニングを始めた。","0","");
INSERT into FunEvents values("0A00000010","13","2024-08-05","2024-09-20","1","14歳の頃、野球部の最終試合で満足のいく結果を残した。","0","");
INSERT into FunEvents values("0A00000010","14","2024-08-05","2024-09-20","1","14歳の頃、生徒会長を務めた。","0","");
INSERT into FunEvents values("0A00000010","15","2024-08-05","2024-09-20","1","15歳の頃、初めて髪の毛を染めた。","0","");
INSERT into FunEvents values("0A00000010","16","2024-08-05","2024-08-22","1","15歳の頃、高校でバドミントンを始めた。","1","高校入学後、部活動について考えたときに、野球部は一年中練習もあり、バイトの両立も難しいのと坊主に抵抗があったので別のスポーツをしたかった。バイトについては漠然と考えていたがお小遣い以上に、自分で稼ぎたいという考えもあった。中学までやっていた野球とは違うスポーツをしたいと考え、テニスなども選択肢にあったが、週2回しか練習の無いバドミントン部が非常に魅力的に見えた。中学の時にもバドミントン部があり、楽しそうに見えていたためバドミントンを始めることにした。中学生の時に地域の体育館の第二・第四土曜日は一般開放DAYがあったため、バドミントン部の友人と遊んだりはしていたが競技としては初めてで、野球よりもはやい速度でシャトルが飛んでくることにもチャレンジ精神が湧いた。競技としてやるには、今までの野球部とは全く別のスポーツということもあり、使う筋肉や肩の回し方など沢山学ぶことがあった。また、女子に人気のスポーツということもあり、女子はコート2面あることに対して、男子は1面しかないこともパワーバランスを考えさせられた。男女問わず、同級生にもたくさんバドミントン部に入部している子がいて、また先輩は非常に優しく教えていただけたため、週2の練習だが、自主練などを行うなどバドミントンという競技に対して非常にポジティブに取り組むことが出来た。大会で、他の学校の選手との対戦も学びがあり色々なスタイルを取り入れる一方で、道具も必ずしも高いブランドのものがいいということでは無く、自分のスタイルに合うラケットを使用することが良かった。自分の場合、ディフェンス中心からリズムを作るスタイルを取り入れ徹底した。試合でもある程度上位に残ることが出来、嬉しかった。エリートリーグの選手の試合を見たときにはまた別次元の試合となっており、ディフェンスだけではなく、オフェンスも積極的に取り入れていかないと勝つことが出来ないことも勉強できた。");
INSERT into FunEvents values("0A00000010","17","2024-08-05","2024-09-20","1","16歳の頃、結婚式場で初めてアルバイトを始めて学校外の友達がたくさんできた。","0","");
INSERT into FunEvents values("0A00000010","18","2024-08-05","2024-08-22","1","16歳の頃、英会話のクラスで2週間オーストラリアの語学学校に行った。","1","高校2年生の夏休みに英語学習のプログラムの一環としてオーストラリア・ケアンズでの語学学校のプログラムに参加させていただいた。同じような世代の学習者がいっぱいいる一方で20代の方も数名おり、色々な世代の方と勉強させていただくいい機会になった。特に大学入試に向けて夏休み前に考えており、得意な数学・苦手意識のない英語で、特に英語力を伸ばそうと考えていた。ぼんやりではあるが夏休み前に進路を考えたときに、政治や経済に中々興味が持てず、将来的に裾野が広がりそうな外国語学部を考えていた。14日間のホームステイと平日はJames Cook Universityでの座学、週末は動物園やビーチでのアクティビティなどが組まれていた。ホームステイ先の家族は配管工のお父さんがいつもビールを飲んでいたが仕事が早いからか19時には眠りについていた。少し年下の息子がおりよく日本でのゲームなどの話をしていた。なかなか自分の言いたいことが伝えられずに四苦八苦したが、ドラゴンボールはどこでも有名なようで共通の話題があり嬉しかった。また、別のプログラムで日本から来ている同い年位の日本人がおり、一緒にフットボールのキャッチボールをして遊んだことが印象に残った。その日本人もジムに熱心に参加しており、その子がベンチプレスを100kg以上、自分が95kgを上げることにホストファミリーの息子が驚いていた。座学は非常に優しい内容が多かったが、オーストラリアスラングなども勉強する機会がありいい勉強になった。勉強をしに来たことに変わりは無いが、週末にショッピングセンターにホストファミリーと行った際に、ピアスショップがあり、今まで自分がピアスを開けるとは思っていなかったが、当日の飛び込みでもピアスを開けてくれるということで2か所、うち一か所は軟骨にピアスをあけることにトライした。ホストファミリーの息子もあけており、一緒に記念に写真を撮った。ボートのアクティビティでは参加者みんなで記念撮影を取ったが、みんないい笑顔で取れていた。");
INSERT into FunEvents values("0A00000010","19","2024-08-05","2024-09-20","1","17歳の頃、模擬試験で英語、数学IA、社会で学年5番以内に入った。","0","");
INSERT into FunEvents values("0A00000010","20","2024-08-05","2024-09-20","1","大学受験の際に滑り止めを受けずに、志望していた公立大学に受かることが出来た。","0","");
INSERT into FunEvents values("0A00000010","21","2024-08-05","2024-09-20","1","18歳の頃、再度野球を始めて、同じクラスに沢山のチームメイトが出来た。","0","");
INSERT into FunEvents values("0A00000010","22","2024-08-05","2024-09-20","1","18歳の頃、一人暮らしを始めた。","0","");
INSERT into FunEvents values("0A00000010","23","2024-08-05","2024-08-22","1","18歳の頃、友人とバイクで出かけて偶然綺麗な海岸(大蔵海岸)を見つけた。","1","大学1回生の夏前頃に、テスト勉強に追われていた時、クラスメイトと徹夜で勉強をしていたが夜明け前にお腹が減ったということでバイクでファミリーレストランに場所を変えて勉強をしようということになった。すでに夜明け前で若干の眠気も感じながら、その時間からまたみんなで出かけることに楽しみを覚えていた。仲間の一人がバイクで20分ほどのところにいいファミリーレストランがあるということでそこまでみんなで原付バイクに乗って出かけた。4時前だが、夜明け前の風は気持ちよかった。ガストでは勉強する仲間と疲れておしゃべりをする仲間が分かれたが、テストへの焦りもあったため、ぎりぎり勉強をしていた。ドリンクバーと目玉焼きハンバーグで、英気を養いながら1時間少し勉強をしていたが、そこで集中力が切れてしまった。特に地図をみていたわけではなかったが、少し明るくなってきていたのと、海岸が近そうであったため、近所を散策したくなった。全員が散策に来たわけではなかったが、自分と数名が散歩することになり、海岸に向かって歩き始めた。堤防があり、登れるところには海岸への道が整備されており、海辺までは走って向かった。神戸や大阪の海に対しての思い込みで、きれいな海はないと思い込んでいたが、その海岸は水がとても透き通って見えた。朝日が昇ってきたところで、朝焼けもきれいで、あまりに海がきれいでそのまま足が水につかるところまで思わず入ってしまった。海にまで入ってきていない仲間もいたが、海の中から海藻を投げつけていた。そこにいた皆がきれいと思う海のため、残りのメンバーも呼んで来ようということになり再度、レストランに戻りまた海岸に戻ってきた。そこからは勉強のことなどすっかり抜けてしまって海岸で遊んでいた。調べていけば分かるような場所ではあるが、地図も下調べもなくそこにたどり着いたことに嬉しくなった。仲間の一人が写真加工アプリで海や朝焼けの写真を加工して、みんなにシェアしたが、海がきれいなのは承知だが、あまりにも写真がきれいすぎて詐欺写真だと批判されていた。一通り遊び終わった後にテストのことを思い越した際には辛く感じた。");
INSERT into FunEvents values("0A00000010","24","2024-08-05","2024-09-20","1","21歳の頃、オーストラリアに留学をした。","0","");
INSERT into FunEvents values("0A00000010","25","2024-08-05","2024-09-20","1","21歳の頃、TOEICで900点を超えた。","0","");
INSERT into FunEvents values("0A00000010","26","2024-08-14","2024-09-20","1","12歳の頃、家族と父の友人家族と釣りに行き、一人で大きな魚を釣り上げた。","0","");
INSERT into FunEvents values("0A00000010","27","2024-08-14","2024-09-20","1","19歳の時、ドイツ語技能検定3級を取得した。","0","");
INSERT into FunEvents values("0A00000010","28","2024-08-14","2024-08-22","1","24歳の時、通関士試験に入社1年目で合格した。","1","23歳、入社1年目の10月に通関士試験を受験した。入社後は営業部署に配属されていたので特に通関士試験の合格は必須ではなかったが、大学4年生時に時間があり、就職後に役に立つと思っていたため、勉強を進めていた。大学4年生の時は勉強時始めたてということと、そもそも通関ということの定義が良く分かっていなく、その年の試験は合格することは出来なかったがトライをしていた。入社1年目では勉強することがいっぱいで中々勉強に時間を使うことが思うようにいかなかったがなるべく実務面に触れようと努力をしていた。関税法・関税定率法と通関業法の科目は暗記科目の一種だったので詰め込んで何とかなると考えていたが、実務面は関税の計算については試験当日まで参考書や模擬試験などの数をこなしたつもりではいたが、不安は残っていた。試験当日、やはり実務の関税の計算部分で悩んでしまい、最後の最後まで考えに考えたが、仮説でしか回答できない箇所が出てきてしまい、その問題は5問が連動する計算問題であったため、仮にその5問をすべて落としてしまうと非常に大きな失点で合格することは難しいだろうと予測をした。試験終了後、プレッシャーから解放されて少しリラックスし、入社1年目であることも考え、仮に落ちてもショックではないと言い聞かせていた。会社の動機にも何名か一緒の会場で試験を受けており、先の5問の部分について聞いてみると自身と違う回答であったのでより、自信をなくしてしまっていた。一方で合格発表日にはいの一番に合格発表者リストを確認したところ、自分の受験番号がリストに載っており非常に嬉しかった。また、同日会社では例年、通関士の合格者が部署とともに発表されるが、自信の名前が載っていなく、広報部に確認をしたところ、営業部署の1年目がとることを想定していなく、確認をしていなかったとのことで追加で乗せていただき、色々な方からお祝いの言葉を頂いたことが嬉しかった。");
INSERT into FunEvents values("0A00000010","29","2024-08-14","2024-09-20","1","24歳の時、会社の企業対抗ソフトボール大会で活躍でき、優勝した。","0","");
INSERT into FunEvents values("0A00000010","30","2024-08-14","2024-09-20","1","25歳の時、会社の企業対抗バレーボール大会でキャプテンを務め、優勝した。","0","");
INSERT into FunEvents values("0A00000010","31","2024-08-14","2024-09-20","1","26歳の頃、結婚した。","0","");
INSERT into FunEvents values("0A00000010","32","2024-08-14","2024-09-20","1","26歳の頃、初めて東京暮らしを始めた。","0","");
INSERT into FunEvents values("0A00000010","33","2024-08-14","2024-09-20","1","26歳の頃、始めて海外出張でインドネシアに行った。","0","");
INSERT into FunEvents values("0A00000010","34","2024-08-14","2024-09-20","1","27歳の頃、長期アメリカ出張で沢山新しい人に会った。","0","");
INSERT into FunEvents values("0A00000010","35","2024-08-14","2024-09-20","1","27歳の頃、長男が誕生した。","0","");
INSERT into FunEvents values("0A00000010","36","2024-08-14","2024-09-20","1","28歳の頃、みんなで紡いだアメリカのプロジェクトが成功した。","0","");
INSERT into FunEvents values("0A00000010","37","2024-08-14","2024-09-20","1","28歳の頃、シンガポール長期出張から駐在となった。","0","");
INSERT into FunEvents values("0A00000010","38","2024-08-14","2024-09-20","1","28歳の頃、シンガポールでテニス・ソフトボールのコミュニティで沢山知り合いが出来た。","0","");
INSERT into FunEvents values("0A00000010","39","2024-08-14","2024-09-20","1","29歳の頃、タイに赴任になった。","0","");
INSERT into FunEvents values("0A00000010","40","2024-08-14","2024-09-20","1","29歳の頃、長女が誕生した。","0","");
INSERT into FunEvents values("0A00000010","41","2024-08-14","2024-09-20","1","30歳の頃、ゴルフコンペで有償をした。","0","");
INSERT into FunEvents values("0A00000010","42","2024-08-14","2024-09-20","1","30歳の頃、試してみたダイエット方法で大きな効果を得た。","0","");
INSERT into FunEvents values("0A00000010","43","2024-08-14","2024-09-20","1","31歳の頃、コロナで時間が出来、タイ語を勉強し始め、ビジネスで活かせるようになった。","0","");
INSERT into FunEvents values("0A00000010","44","2024-08-14","2024-09-20","1","32歳の頃、グローバルセールスという海外営業メインの部署兼任となり、territoryが増えた。","0","");
"0A00000010","45","2024-08-14","2024-09-18","1","33歳の頃、TOEICで最高得点が取れた。","1","当日、駐在しているタイの住居であるコンドミニアムで目覚めた。勉強期間は4時30分に起きて勉強をする生活をベースにしていたため、まだ明るくなる前だった。コーヒーを入れて、Youtubeの番組などを見てリラックスをしていた。2月の乾季であったため少し肌寒かった。試験は午後からだったので、午前中はイメージトレーニングや最後の文法のおさらいや、リスニングの聞き流しなどをして時間を過ごしていた。時間が近づくにつれてだんだんと気が引き締まっていき、お腹を壊したりしない様、うどんを少量だけ、あったかいうどんにして食べた。
前回の試験時に、公共交通機関とバイクタクシーで向かった結果、大雨にあたりずぶ濡れで試験を受ける羽目になってしまい、寒さで試験に集中できなかったため、今回は会場には社用車で向かうことを決めていた。渋滞に巻き込まれることを加味して少し早く家を出発した。2回目の受験地であったため勝手は分かっており、少し受付に並んだが比較的すぐに試験会場に入ることは出来た。試験までは手持ちの本を読んだりして比較的リラックスして過ごすことが出来た。試験時間が近づいて、集中をし直した。試験はリスニングからであったが、リスニングの40分間、しっかりと集中することが出来、ほとんどの音声を聞き取ることが出来た。リーディングはいつも時間がぎりぎりだが、語法・文法・単語などのPart5セクションを最短で駆け抜け、Part6/7に入ることが出来た。part7では少し集中力が途切れる場面もあったが、何とか時間内にすべての回答を終わらせることが出来た。試験終了の知らせがあった際はほっとし、鉛筆を置くことが出来た。この日までに積み重ねてきた勉強の成果を発揮できたと感じた。試験終了後は案内に沿って会場を後にした。高得点が取れた感覚もあり嬉しくて、帰りにラーメンを食べに行った。後日、テスト結果が帰ってきた際にはやはり過去最高得点を40点も上回る結果となり、満足のいく結果であった。",
INSERT into FunEvents values("0A00000010","46","2024-08-14","2024-09-20","1","34歳の頃、希望が叶い南アフリカに赴任となった。","0","");
INSERT into FunEvents values("0A00000010","47","2024-08-14","2024-09-20","1","34歳の頃、新規獲得での社内表彰を得た。","0","");
INSERT into FunEvents values("0A00000010","48","2024-08-14","2024-09-20","1","34歳の頃、ザンビアやコンゴ民主共和国への出張をし、現地の勉強が出来た。","0","");
INSERT into FunEvents values("0A00000010","49","2024-08-14","2024-09-18","1","34歳の頃、企業連合対抗ソフトボール大会で優勝した。","1","朝、長期出張中であるヨハネスブルグの拠点であるサントンスカイのホテルで目が覚めた。インスタントコーヒーを飲み、シャワーを浴びる準備した。シャワーを浴びて、歯を磨いて、乾燥防止用のクリームを塗った。持っていたチームのバットを何度か部屋で振り、大会準決勝、決勝への準備を進めた。前日、1回戦、2回戦と勝ち上がっており少し疲れも残していたが筋肉痛などはなく、運動は出来ると考えていた。
社用車にて出発をした。大会会場は前日の会場とは異なり、同じボールパーク内の別グラウンドであったが問題なくたどり着いた。
すぐに準決勝の時間が近づいてきたためチームで準備運動やキャッチボール、ノックなどを行い、試合に入った。準決勝では、1番バッターを任され、初回はホームランを狙ったが、ギリギリのところでライトに取られてしまった。初回、3人で攻撃が終わりその裏に点を取られて嫌な雰囲気にはなった。2回からは攻撃がつながり一気に逆転することが出来、そのまま決勝へコマを進めた。
決勝では優勝候補との対戦となった。序盤から打ち合いの展開となった。両軍ともホームランを打ち合う展開となり、既定の7回までは10-10で拮抗をしていた。ルール上、決勝戦については決着がつくまでということで延長戦に入り、延長戦では先と異なり、0が行進する守備側の展開となった。9回に試合が動き、自軍からヒットが続き一挙5点を取ることに成功、その裏も0点で抑えることが出来、無事に優勝となった。初めての参加であり、試合の雰囲気などを全くわかっていなかったが、事前に社内の担当から言われていた、野球が出来ると目立つ、ということが良く分かった。試合後、表彰式や自チームでの集合写真などを取りにぎわっていた。日本人会の野球部が会場を仕切っており、野球部への勧誘を受けた。
一度帰ってシャワーを浴びて、祝勝会に向かった。祝勝会では中華レストランで美味しい料理とお酒をいただくことができた。");
INSERT into FunEvents values("0A00000010","50","2024-08-14","2024-09-20","1","35歳の頃、西アフリカもテリトリーとなり、活動場所が増えた。","0","");

INSERT into AlcoControlStimulus values("0A00000001","2024-02-22","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-02-23","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-02-27","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-03-01","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-03-02","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-03-03","2");
INSERT into AlcoControlStimulus values("0A00000001","2024-03-04","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-03-08","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-03-09","15");
INSERT into AlcoControlStimulus values("0A00000001","2024-03-05","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-03-06","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-03-07","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-03-10","0");
INSERT into AlcoControlStimulus values("0A00000002","2024-03-10","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-03-22","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-04-20","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-03-19","7");
INSERT into AlcoControlStimulus values("0A00000001","2024-03-24","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-03-25","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-03-29","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-03-30","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-04-02","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-04-01","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-04-03","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-04-09","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-03-28","0");
INSERT into AlcoControlStimulus values("0A00000007","2024-04-03","0");
INSERT into AlcoControlStimulus values("0A00000006","2024-04-03","0");
INSERT into AlcoControlStimulus values("0A00000003","2024-04-03","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-03-11","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-04-04","0");
INSERT into AlcoControlStimulus values("0C00000001","2024-04-06","0");
INSERT into AlcoControlStimulus values("0C00000001","2024-04-07","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-04-11","0");
INSERT into AlcoControlStimulus values("0A00000003","2024-04-11","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-04-16","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-05-14","0");
INSERT into AlcoControlStimulus values("0A00000008","2024-05-18","0");
INSERT into AlcoControlStimulus values("0A00000008","2024-05-19","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-05-20","0");
INSERT into AlcoControlStimulus values("0A00000008","2024-05-20","0");
INSERT into AlcoControlStimulus values("0A00000008","2024-05-22","20");
INSERT into AlcoControlStimulus values("0A00000008","2024-05-23","0");
INSERT into AlcoControlStimulus values("0A00000008","2024-05-26","2");
INSERT into AlcoControlStimulus values("0C00000001","2024-05-30","15");
INSERT into AlcoControlStimulus values("0A00000001","2024-05-30","5");
INSERT into AlcoControlStimulus values("0A00000001","2024-05-31","3");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-01","0");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-05","0");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-08","9");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-07","0");
INSERT into AlcoControlStimulus values("","2024-08-09","0");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-09","11");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-10","13");
INSERT into AlcoControlStimulus values("0C00000001","2024-08-09","3");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-11","10");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-12","12");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-13","20");
INSERT into AlcoControlStimulus values("","2024-08-14","0");
INSERT into AlcoControlStimulus values("","2024-08-12","0");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-14","10");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-15","20");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-19","20");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-21","20");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-16","0");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-22","15");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-20","0");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-18","0");
INSERT into AlcoControlStimulus values("0A00000010","2024-07-18","0");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-06","0");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-17","0");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-28","0");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-23","15");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-24","15");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-25","10");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-26","0");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-27","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-08-23","5");
INSERT into AlcoControlStimulus values("0A00000001","2024-08-25","0");
INSERT into AlcoControlStimulus values("0A00000001","2024-08-24","0");
INSERT into AlcoControlStimulus values("0A00000004","2024-08-23","0");
INSERT into AlcoControlStimulus values("0A00000004","2024-08-22","0");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-29","0");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-30","0");
INSERT into AlcoControlStimulus values("0A00000010","2024-08-31","0");
INSERT into AlcoControlStimulus values("0A00000010","2024-09-01","6");
INSERT into AlcoControlStimulus values("0A00000010","2024-09-02","5");
INSERT into AlcoControlStimulus values("","2024-08-06","0");
INSERT into AlcoControlStimulus values("0A00000007","2024-08-23","0");
INSERT into AlcoControlStimulus values("","2024-09-01","0");
INSERT into AlcoControlStimulus values("0A00000010","2024-09-05","0");
INSERT into AlcoControlStimulus values("0A00000010","2024-09-03","5");
INSERT into AlcoControlStimulus values("0A00000010","2024-09-04","5");
INSERT into AlcoControlStimulus values("0A00000010","2024-09-06","0");
INSERT into AlcoControlStimulus values("0A00000010","2024-09-07","5");
INSERT into AlcoControlStimulus values("0A00000010","2024-09-09","5");
INSERT into AlcoControlStimulus values("0A00000010","2024-09-11","5");
INSERT into AlcoControlStimulus values("0A00000010","2024-09-08","5");
INSERT into AlcoControlStimulus values("0A00000010","2024-09-10","5");
INSERT into AlcoControlStimulus values("0A00000010","2024-09-12","5");
INSERT into AlcoControlStimulus values("0A00000010","2024-09-13","5");
INSERT into AlcoControlStimulus values("0A00000010","2024-09-14","5");
INSERT into AlcoControlStimulus values("0A00000010","2024-09-17","5");
INSERT into AlcoControlStimulus values("0A00000010","2024-09-16","5");
INSERT into AlcoControlStimulus values("0A00000010","2024-09-15","5");
INSERT into AlcoControlStimulus values("0A00000010","2024-09-18","5");
INSERT into AlcoControlStimulus values("0A00000010","2024-09-19","5");
INSERT into AlcoControlStimulus values("0A00000010","2024-09-20","5");

INSERT into AlcoPseudoAct values("0A00000001","2024-02-27","1","1000010000100001","1000001000","100000100","0","1000","aaa","0100001000010000","0100000100","010000010","1","0100","bbb","0","1","aaa","1","aaa","0","aaa","3");
INSERT into AlcoPseudoAct values("0A00000001","2024-03-01","1","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-03-01","2","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-03-01","3","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-03-01","4","1000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-03-01","5","0100000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-03-01","6","0010000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-03-01","7","0001000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-03-01","8","0000100000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-03-01","9","0000010000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-03-03","1","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-03-03","2","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-03-02","1","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-03-09","1","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-03-09","2","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-03-09","3","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-03-09","4","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-03-09","5","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-03-09","6","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000008","2024-05-22","1","1000110000000000","0000000000","000000000","0","0010","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000008","2024-05-22","2","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0010","","0","5","","2","","1","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-08-22","1","0000000000000001","0001000000","000000001","3","1000","","0000000000000001","0010000000","000000001","2","1000","","0","0","","0","","1","谷原様","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-08-22","2","0000000000000001","0001000000","000000001","3","1000","","0000000000000000","0000000000","000000000","3","0000","","3","6","","2","欲求はないが、落ち着いた感じがした。","1","谷原様","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-08-23","1","0000000000000001","0000000001","000000001","3","0001","","0000000000000000","0000000000","000000000","0","0000","","3","6","","2","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-08-23","1","0000000000000010","0000000001","000000001","3","0001","","0000000000000010","0000010000","000000001","3","0000","","0","0","","0","","0","","1");
INSERT into AlcoPseudoAct values("0A00000010","2024-08-23","2","0000000000000010","0000000001","000000001","3","0001","","0000000000000010","0000000001","000000001","3","0001","","0","0","","0","","0","","1");
INSERT into AlcoPseudoAct values("0A00000010","2024-08-23","3","0000000000000010","0000000000","000000001","3","0001","","0000000000000010","0000000001","000000001","3","0001","","0","0","","0","","0","","1");
INSERT into AlcoPseudoAct values("0A00000010","2024-08-23","4","0000000000000010","0000000001","000000001","3","0001","","0000000000000010","0000010000","000000001","3","0001","","0","0","","0","","0","","1");
INSERT into AlcoPseudoAct values("0A00000010","2024-08-23","5","0000000000000010","0000000001","000000001","3","0001","","0000000000000010","0000010000","000000001","3","0001","","0","0","","1","","0","","1");
INSERT into AlcoPseudoAct values("0A00000010","2024-08-24","1","0000000000000010","0000000010","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-08-24","2","0000000000000010","0000000010","000000001","3","0001","","0000000000000000","0000000000","000000000","3","0001","","0","0","","0","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-08-24","3","0000000000000010","0000000010","000000001","3","0001","","0000000000000000","0000000000","000000000","3","0000","","3","6","","1","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-08-24","4","0000000000000010","0000000010","000000001","3","0001","","0000000000000010","0000000010","000000001","3","0001","","0","0","","0","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-08-24","5","0000000000000010","0000000010","000000001","3","0001","","0000000000000010","0000000010","000000001","3","0001","","0","0","","0","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-08-24","6","0000000000000010","0000000010","000000001","3","0001","","0000000000000010","0000000010","000000001","3","0001","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-08-24","7","0000000000000000","0000000010","000000001","3","0001","","0000000000000010","0000000010","000000001","3","0001","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-08-24","8","0000000000000010","0000000010","000000001","3","0001","","0000000000000010","0000000010","000000001","3","0001","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-08-24","9","0000000000000010","0000000010","000000001","3","0001","","0000000000000010","0000000010","000000001","3","0001","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-08-24","10","0000000000000010","0000000010","000000001","3","0001","","0000000000000010","0000000010","000000001","3","0001","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000001","2024-08-25","1","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0010","あｄｓｆ","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-08-25","2","0000000000000000","0000000000","000000000","0","0100","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-08-25","3","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","1","5","","2","","1","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-08-24","1","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-08-24","2","0000000000000000","0000000000","000000000","0","0010","","0000000000000000","0000000000","000000000","0","0010","","1","5","","2","","1","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-08-24","3","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","1","5","そのた","2","へんか","1","しょくいん","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-08-24","4","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000001","2024-08-24","5","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","2","5","","2","","1","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-08-25","1","0000000000000010","0000000001","000000001","3","0001","","0000000000000010","0000000010","000000001","3","0001","","0","0","","0","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-08-25","2","0000000000000010","0000000010","000000001","3","0001","","0000000000000010","0000000010","000000001","3","0001","","0","0","","0","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-08-25","3","0000000000000010","0000000010","000000001","3","0001","","0000000000000000","0000000000","000000000","0","0000","","3","6","","0","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-01","1","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-01","2","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-01","3","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-01","4","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-01","5","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-04","1","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-04","2","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-04","3","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-04","4","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-04","5","0000000000000001","0000000001","000000001","3","0001","","0000000000000000","0000000000","000000000","0","0000","","3","6","","1","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-05","1","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-05","2","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-05","3","0000000000000000","0000000000","000000001","0","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-05","4","0000000000000000","0000000000","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-05","5","0000000000000000","0000000000","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-07","1","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-07","2","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-07","3","0000000000000000","0000000000","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-07","4","0000000000000000","0000000000","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-07","5","0000000000000001","0000000001","000000001","3","0001","","0000000000000000","0000000000","000000000","0","0000","","3","6","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-07","6","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-07","7","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-07","8","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-07","9","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-07","10","0000000000000001","0000000001","000000001","3","0000","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-09","1","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-09","2","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-09","3","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-09","4","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-09","5","0000000000000001","0000000001","000000001","3","0001","","0000000000000000","0000000000","000000000","3","0000","","3","6","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-10","1","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-10","2","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-10","3","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-10","4","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-10","5","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-10","6","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0000","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-10","7","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-10","8","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-10","9","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0000","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-10","10","0000000000000001","0000000001","000000001","3","0001","","0000000000000000","0000000000","000000000","3","0000","","3","6","","1","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-11","1","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0000","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-11","2","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-11","3","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-11","4","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-12","1","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-12","2","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-12","3","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-12","4","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-12","5","0000000000000001","0000000001","000000001","3","0001","","0000000000000000","0000000000","000000000","0","0000","","3","6","","1","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-13","1","0000000000000001","0000000001","000000001","3","0001","","0000000000000000","0000000000","000000000","0","0000","","3","6","","1","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-13","2","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-13","3","0000000000000001","0000000001","000000001","3","0000","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-13","4","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-13","5","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-14","1","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-14","2","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-14","3","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-14","4","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-14","5","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-14","6","0000000000000001","0000000001","000000001","3","0001","","0000000000000000","0000000000","000000000","0","0000","","3","6","","1","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-16","1","0000000000000001","0000000001","000000001","2","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-16","2","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-16","3","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-16","4","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-16","5","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-16","6","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-16","7","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-16","8","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-16","9","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-16","10","0000000000000001","0000000001","000000001","3","0001","","0000000000000000","0000000000","000000000","0","0000","","3","6","","1","","0","","3");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-17","1","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-17","2","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-17","3","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-17","4","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-17","5","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-18","1","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-18","2","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-18","3","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-18","4","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-18","5","0000000000000001","0000000001","000000001","3","0001","","0000000000000000","0000000000","000000000","0","0000","","3","6","","1","","0","","0");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-19","1","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-19","2","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-19","3","0000000000000001","0000000001","000000001","0","0001","","0000000000000001","0000000001","000000001","3","0000","","0","0","","0","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-19","4","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-19","5","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-20","1","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-20","2","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","2");
INSERT into AlcoPseudoAct values("0A00000010","2024-09-20","3","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","2");

INSERT into AlcoImagination values("0A00000001","2024-03-02","1","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0","Oh","Yeah","Happy","","","","","","","","","","","","","","","","","");
INSERT into AlcoImagination values("","2024-03-02","1","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0","","","","","","","","","","","","","","","","","","","","");
INSERT into AlcoImagination values("0A00000001","2024-03-09","1","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0","","","","","","","","","","","","","","","","","","","","");
INSERT into AlcoImagination values("0A00000001","2024-04-20","1","0100001000010000","0100000100","010000010","1","0000","","0010000100001000","0010000010","001000001","0","0100","","2","0","","0","","0","","1","","","","","","","","","","","","","","","","","","","","");
INSERT into AlcoImagination values("0A00000001","2024-04-20","2","0100001000010000","0100000100","010000010","1","0000","","0010000100001000","0010000010","001000001","0","0100","","2","0","","0","","0","","1","","","","","","","","","","","","","","","","","","","","");
INSERT into AlcoImagination values("0A00000001","2024-04-06","1","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0010","","2","0","","2","","1","","1","aa","aa","aa","","","","","","","","","","","","","","","","","");
INSERT into AlcoImagination values("0A00000001","2024-04-06","2","0000000000000000","0000000000","000000000","0","0000","","0000000000000000","0000000000","000000000","0","0000","","0","0","","0","","0","","0","１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０","","","","","","","","","","","","","","","","","","","");
INSERT into AlcoImagination values("0A00000008","2024-05-26","1","1000010000100001","1000000000","000000000","2","0010","","0100001000010000","0000000000","000000000","0","0000","","0","0","","2","変化の詳細","1","A田A郎","0","a","b","c","d","","","","","","","","","","","","","","","","");
INSERT into AlcoImagination values("0A00000008","2024-05-26","2","1000010000100001","0000000000","000000000","0","0000","","0000000000010000","0000000000","000000000","0","0000","","0","0","","0","","0","","1","a","a","a","","","","","","","","","","","","","","","","","");
"0A00000010","2024-09-07","1","0000000000000010","0000000001","000000001","3","0001","","0000000000000001","0000010000","000000001","2","0001","","0","0","","0","","1","谷原さん","0","Ubre配車","パデルラケット(FILA製)","ウインドフック(瓶ビール)","防寒着(SALOMONのウインドブレーカー)","Springboks(ラグビー南アフリカ代表チーム)","ダブルブランデーコーク","イエガーマイスター(ショット)","南アソーセージ","ビルトン(干し肉 スーパーPick and Pay製)","ショッピングモール(パデル会場横)","社長ISUZU車","ブランケット
ブランケット","大きなソファー","コッペパン","BBQ用炭","社長一家こども達(長男・長女・次男)","ラグビー・トライ","バッファロー","リージェンシーのブランデー","後輩",
INSERT into AlcoImagination values("0A00000010","2024-09-07","2","0000000000000001","0000000001","000000001","3","0001","","0000000000000000","0000000000","000000000","0","0000","","3","0","","2","ほっとした","1","谷原さん","0","","","","","","","","","","","","","","","","","","","","");
INSERT into AlcoImagination values("0A00000010","2024-09-12","1","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0","コンタクトレンズ","布団カバー","バスタオル","ペーパードリップコーヒー","防風ジャケット","allstarのバックパック","ヘアバンド","スパッツ","パデル","ウインドフックのビール","ショッピングセンター","ビルトン","ソファー","ラグビー観戦","ウーバー","セキュリティガード","携帯のストラップ","ブランデー","コーラ","Shosholoza");
"0A00000010","2024-09-13","1","0000000000000001","0000000001","000000001","3","0000","","0000000001000000","0010000000","000000001","2","0100","","0","0","","0","","0","","1","VKongの硬式用バット","グローブ","空のワインボトル","メーカーズマーク","コンバースのリュックサック","紙皿","キャンプ用いす","マークスパーク球場","コーラ","クリスピードーナッツ","クーラーボックス","BBQ台","ハンモック","プール","隣のアパート","2重の門","1歳の子ども","ウインドフックビール
ウインドフックビール","マトリョーシカのようなボール","イモモチ",
INSERT into AlcoImagination values("0A00000010","2024-09-13","2","0000000000000001","0000000001","000000001","2","0001","","0000000001000000","0000000001","000000001","3","0001","","0","0","","0","","0","","2","ウーバー","スーツ","テント","お寿司","唐揚げ","ラッキードロー","大使館","ワイン","大型クーラーボックス","バーカウンター","サーバー","BBQ台","太陽光","大使館手前のガソリンスタンド","響-ウイスキー","Kindle","任天堂スイッチ","移動式アイスクリーム屋","取引先様社用車","ソファー");
INSERT into AlcoImagination values("0A00000010","2024-09-14","1","0000000000000001","0000000001","000000001","3","0001","","0000000001000000","0000000001","000000001","3","0001","","0","0","","0","","0","","0","ソフトボール用バット","ヨハネスブルグ空港駐車場","シティロッジホテル","宿泊者用ホテル","タクシー","T-シャツ","Bryanstonショッピングセンター","Turn'n'Tenderステークハウス","700Gステーキ(Cavemann)","南アフリカ産赤ワイン(Chocolate Block)","イエガーマイスター","ビルトン","テキーラ","ドンペドロ アマルーラ","スプリングボックのカルパッチョ","ニックネーム","レストランのトイレ","バーカウンターにあるワイン(天井に吊られている)","ウインドフックビール","プライベート携帯");
INSERT into AlcoImagination values("0A00000010","2024-09-14","2","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","1","","0","","4","ゴールドジム","Amazonesアパート","レストランの対面にある中華レストラン","チンタオビール","エビ春雨","きゅうりのたたき","円卓","引退者(帰任)への色紙","ボールペン","春巻き","海南チキン","Strong Fireチャーハン","赤白ワイン","カラオケマイク","集合写真","日本からの出張参加者","リボニアビレッジショッピングセンター","ブラックレーベルビール","中国語メニュー","後輩社用車");
INSERT into AlcoImagination values("0A00000010","2024-09-16","1","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","0","コーヒー","圧力なべ","野球用木製トレーニングバット","Salomonウインドブレーカー","Decathronのカーフタイツ","ランニング用靴下","パデル用ラケット","パデル用ボール3球","ウインドフックビール","飲み物冷やす用のバケツ","氷","パデル支払いのためのカードマシン","後輩のマヒンドラの車","ビルトン","ソーセージ","小さいイエガーマイスターボトル","食パン","プール","階段","トイレ");
INSERT into AlcoImagination values("0A00000010","2024-09-16","2","0000000000000001","0000000001","000000001","3","0001","","0000000001000000","0000000001","000000001","3","0001","","0","0","","0","","0","","1","コーヒーメーカー","牛乳","野球審判用インジケーター","野球用ソックス","木製トレーニングバット","スコアラー用テーブル","キャッチャー道具","マークスパーク駐車券","ホームランライン","ポール間のライン(縄)","ハンモック","イモモチ","ウインドフック","メーカーズマークのボトル","キャンプ用いす","リュックサック","ソファーのクッション","子ども用柵","段ボール製ゴミ箱","BBQ用ナイフ");
INSERT into AlcoImagination values("0A00000010","2024-09-17","1","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","2","コーヒー","Oxyの洗顔料","ワセリンのクリーム","サントンシティの商品券","黒スーツ","タクシー","受付台","大使館入口の門","テント","ビール","ウエイター","寿司職人","ギプス","マイク","ラッキードロー","ガラス製ワイングラス","アイスクリーム","中庭ベンチ","シャンデリア","バーベキュー台");
INSERT into AlcoImagination values("0A00000010","2024-09-17","2","0000000000000001","0000000001","000000001","3","0001","","0000000001000000","0000000001","000000001","3","0001","","0","0","","0","","0","","3","コーヒー","社用車","空港パーキングチケット","国際線到着口","役員から社長へのお土産","キャピタルオンザパークホテル","マッシュルームオンザパーク","タクシー","ブライアンストンショッピングセンター","Woolworthスーパー","Turn'n'Tenderステーキハウス","ウインドフックビール","Chocolateブロックワイン","シャルドネ、白ワイン","イエガーマイスター","ビルトン","700Gステーキ","ドンペドロアマルーラ","ワイングラス","ソファー");
INSERT into AlcoImagination values("0A00000010","2024-09-18","1","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","4","Northern Farmの卵","T-ボーンステーキ","ワインショップ","ウインドフックビール","アボカド","牛乳","コーラ","きゅうりたたき","エビ春雨","色紙","ボールペン","麻婆豆腐","カラオケ","チンタオビール","円卓","ピーナッツ","レストラン前階段","ブラックレーベルのビール","中国語のカラオケリスト","スクリーン");
INSERT into AlcoImagination values("0A00000010","2024-09-18","2","0000000000000001","0000000001","000000001","3","0001","","0000000011000000","0000000100","000000001","2","0001","","0","0","","0","","0","","0","シンガポール空港のスターバックス","スーツケース","Kallanのショッピングモール","石鹸","イーストコーストロード","ベドックジェッティ(釣り場)","イーストコーストBBQ台","Eunos駅前のフィットネスVirgin Active","南アフリカワイン","芋焼酎","イエガー","バスタオル","シャワールーム","チキンライス","ショウガソース","タイガービール","空心菜の炒め物","シャンパンポークの店","小さなテーブル2つといす6個","クラークキーのバー");
INSERT into AlcoImagination values("0A00000010","2024-09-20","1","0000000000000001","0000000001","000000001","3","0001","","0000000000000001","0000000001","000000001","3","0001","","0","0","","0","","0","","5","空港のスターバックス","空港のカヤトーストのお店","チャンギ空港のショッピングモール","イーストコーストパーク","ベドックジェッティ","バーベキューエリア","レンタル自転車","背の高いツタ","イーストコーストパークへ通じる地下道","Fair Priceのスーパー","街中のホーカーセンター(フードコート)","北建麺","チキンライス","コーヒーショップ","ビジネスビル内の種苗屋","タイガービール","焼酎","円卓","飲み物置台","小さなグラス");

INSERT into AlcoImaginationText values("0A00000001","2024-05-26","2024-01-01","0","ooで、△△さんと、ビール２杯飲んだ。","1");
INSERT into AlcoImaginationText values("0A00000008","2024-05-26","2024-01-02","1","サニー号で船員全員とビールいっぱい飲んだ。","1");
INSERT into AlcoImaginationText values("0A00000001","2024-08-23","1980-03-01","3","朝起きて歯磨きをした","1");
INSERT into AlcoImaginationText values("0A00000010","2024-09-07","2024-06-22","0","朝、自宅で目覚めた。社内+顧客とのパデル大会に参加のためパデルを出来る格好と、その後に社内南アフリカ人代表宅でのBBQパーティのために差し入れのお酒をもって家を出発した。パデルでは社内の後輩と出場したが勝つことはできなかった。暑い日で、南アフリカ人主体で、大会と言いながら飲みながらの大会となった。パデル後、BBQのために移動をして再度飲酒を再開した。ラグビーの試合を見ながら参加者とお酒、主にビールを飲んでいたが、南アフリカチームがトライを決める度にショットをみんなで飲んでいた。","1");
INSERT into AlcoImaginationText values("0A00000001","2024-03-04","2018-07-04","1","ooで××だったので△△してしまった","1");
INSERT into AlcoImaginationText values("0A00000001","2024-04-20","2010-01-02","2","aaaaaaaaaaaaaaaaaaaaaaaaa","0");
INSERT into AlcoImaginationText values("0A00000008","2024-05-26","2024-01-01","0","ooで、△△さんと、ビール２杯飲んだ。","1");
INSERT into AlcoImaginationText values("0A00000010","2024-09-12","2024-07-21","1","自分の部屋で目覚めた。コーヒーを立てていつもの朝を過ごした。野球の試合のために準備をして家を出た。
試合は無事に勝つことが出来た。個人的に2本ヒットを打った。
試合終わりに同日のバーベキューの案内があった。チームメートの1名が自宅を開放して野球部を招待することになっていた。
BBQ会場では新しく入った方とも挨拶をした。沢山のお酒を飲んだ。","1");
INSERT into AlcoImaginationText values("0A00000010","2024-09-17","2024-01-27","2","自分の部屋で目覚めた。いつもの通りに顔を洗い、コーヒーを立て、平日に残した仕事の処理を行っていた。
日本人会の新年会イベントが大使館であるので、スーツを着て準備をして、同僚と一緒にタクシーに乗り込み大使館へ向かった。
大使館では野球仲間や、仕事の取引先の方、そのご家族など沢山の方と会いお話しした。ラッキードローは残念ながら当たらなかった。
会の後半には野球部やラグビー部などが集まっており、みんなでワインを飲んでいた。
その時にワインを飲みすぎてしまった。","1");
INSERT into AlcoImaginationText values("0A00000010","2024-09-17","2024-02-11","3","朝起きて、身支度をして、昼前までは仕事をしていた。昼から、日本から到着する1週間の出張者を迎えに行くために自宅から社用車に乗って空港に向かった。
空港ですぐに出張者と合流し、一度出張者の宿泊するホテルに荷物を落とすために空港から街中に再度戻った。道中、現在の日本本社の様子などを伺っていた。
ホテルについてから、現地法人の南アフリカ人社長と夕食が予定されていたため、一度車を置いて再度タクシーで迎えに来て、レストランまで一緒に向かった。
700gのステーキを食べた。ワインから、ショットまで社長に煽られるごとに飲んでいて、飲みすぎてしまった。","1");
INSERT into AlcoImaginationText values("0A00000010","2024-09-17","2023-09-16","4","朝はいつも通り、自宅で過ごし少し仕事をしていた。昼間に食用品と差し入れのワインを買うためにショッピングセンターに行った。
夕方から、野球部のリーグ戦打ち上げがあったため、自宅から歩いて中華レストランに向かった。
リーグ戦の戦績、個人の成績などがここに発表され、対象の人はお酒を飲んだりしていた。
そのレストランにカラオケもついており、日本語の曲は2-3極しかなかったが、1曲、みんなで歌った。
飲みすぎてしまい、さらにその後、有志メンバーで2軒目に行きさらにカラオケをした。","1");
INSERT into AlcoImaginationText values("0A00000010","2024-09-18","2024-05-06","5","シンガポール出張1日目、フライトで朝シンガポール空港に降り立った。そのままシンガポールの担当と合流し、顧客訪問に向かった。
顧客訪問終了後にはホテルにチェックインをして、その後タクシーでシンガポールの邦人担当者10名ほどとの会食に向かった。
中華レストラン、円卓で食事をしていた。持ち込みが可能な店で、南アフリカから持ってきたワインと、シンガポール側で用意していた焼酎を飲んだ。飲みすぎた。","1");

INSERT into AlcoEssay values("0A00000001","2024-03-02","1","1");
INSERT into AlcoEssay values("0A00000001","2024-03-03","0","0");
INSERT into AlcoEssay values("0A00000001","2024-03-08","0","0");
INSERT into AlcoEssay values("0A00000001","2024-03-01","0","0");
INSERT into AlcoEssay values("0A00000001","2024-03-09","0","1");
INSERT into AlcoEssay values("0A00000008","2024-05-26","1","1");
INSERT into AlcoEssay values("0C00000001","2024-05-30","1","0");
INSERT into AlcoEssay values("0A00000001","2024-03-12","0","0");
INSERT into AlcoEssay values("0A00000001","2024-03-11","1","0");
INSERT into AlcoEssay values("0A00000001","2024-03-13","0","0");
INSERT into AlcoEssay values("0A00000010","2024-08-12","1","0");
INSERT into AlcoEssay values("","2024-08-15","1","0");
INSERT into AlcoEssay values("0A00000010","2024-08-15","1","0");
INSERT into AlcoEssay values("0A00000001","2024-08-23","1","0");

INSERT into AlcoBBS values("0A00000001","2024-03-02","0","0A00000001","よろしくお願いします。");
INSERT into AlcoBBS values("0A00000001","2024-03-02","1","A000000002","こちらこそよろしくお願いします。AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA");
INSERT into AlcoBBS values("0A00000001","2024-03-02","2","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-02","3","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-02","4","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-02","5","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-02","6","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-02","7","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-02","8","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-02","9","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-02","10","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-02","11","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-02","12","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-02","13","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-02","14","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-02","15","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-02","16","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-02","17","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-02","18","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-02","19","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-02","20","A000000001","こんにちは");
INSERT into AlcoBBS values("0A00000001","2024-03-08","22","A000000002","これを見てください。https://www.i.u-tokyo.ac.jp/edu/entra/enRol42024.shtml");
INSERT into AlcoBBS values("0A00000001","2024-03-25","23","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-25","24","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-25","25","A000000002","a");
INSERT into AlcoBBS values("0A00000001","2024-03-25","26","A000000002","b");
INSERT into AlcoBBS values("0C00000001","2024-04-11","2","0C00000001","質問があります。");
INSERT into AlcoBBS values("0C00000001","2024-04-07","1","A000000001","a");
INSERT into AlcoBBS values("0C00000001","2024-04-11","3","A000000001","何ですか？");

INSERT into FunEventsRead values("0A00000001","2024-03-02","1","Yeah","Oh","my","god","","","","","","","","","","","","","","","","");
INSERT into FunEventsRead values("0A00000001","2024-03-03","2","","","","","","","","","","","","","","","","","","","","");
INSERT into FunEventsRead values("0A00000001","2024-03-09","1","車","新宿駅","ストロングゼロ","緑","甘い","のど越しがいい","","","","","","","","","","","","","","");
INSERT into FunEventsRead values("0A00000008","2024-05-22","1","単語1","単語2","単語3","単語4","単語","単語","単語","単語","単語","単語","単語","単語","単語","単語","単語","単語","単語","単語","単語","単語");
INSERT into FunEventsRead values("0A00000008","2024-05-23","1","単語","単語","単語","単語","単語","単語","1","1","1","1","1","1","1","1","1","1","1","1","1","1");
