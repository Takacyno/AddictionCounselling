ALTER TABLE AlcoImagination add column   AutonomicNervesTextBefore varchar(50) after AutonomicNervesBefore;
ALTER TABLE AlcoImagination add column  FeelingTextBefore varchar(50) after FeelingBefore ;
ALTER TABLE AlcoImagination add column  DirectionTextBefore varchar(50) after DirectionBefore ;
ALTER TABLE AlcoImagination add column  AutonomicNervesTextAfter varchar(50) after AutonomicNervesAfter ;
ALTER TABLE AlcoImagination add column  FeelingTextAfter varchar(50) after FeelingAfter ;
ALTER TABLE AlcoImagination add column  DirectionTextAfter varchar(50) after DirectionAfter ;

ALTER TABLE AlcoPseudoAct add column   AutonomicNervesTextBefore varchar(50) after AutonomicNervesBefore;
ALTER TABLE AlcoPseudoAct add column  FeelingTextBefore varchar(50) after FeelingBefore ;
ALTER TABLE AlcoPseudoAct add column  DirectionTextBefore varchar(50) after DirectionBefore ;
ALTER TABLE AlcoPseudoAct add column  AutonomicNervesTextAfter varchar(50) after AutonomicNervesAfter ;
ALTER TABLE AlcoPseudoAct add column  FeelingTextAfter varchar(50) after FeelingAfter ;
ALTER TABLE AlcoPseudoAct add column  DirectionTextAfter varchar(50) after DirectionAfter ;
