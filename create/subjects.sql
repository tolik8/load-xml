
CREATE TABLE `SUBJECTS` (
  `ID` bigint(20) NOT NULL,
  `NAME` varchar(500),
  `SHORT_NAME` varchar(300),
  `OPF` varchar(100),
  `EDRPOU` varchar(10),
  `ADDRESS` varchar(255),
  `STAN` varchar(80),
  `FOUNDING_DOCUMENT_NUM` varchar(100),
  `SUPERIOR_MANAGEMENT` varchar(255),
  `AUTHORIZED_CAPITAL` varchar(15),
  `STATUTE` varchar(100),
  `REGISTRATION` varchar(30),
  `MANAGING_PAPER` varchar(255),
  `TERMINATED_INFO` varchar(255),
  `TERMINATION_CANCEL_INFO` varchar(255),
  `CONTACTS` varchar(255),
  `VP_DATES` varchar(2000),
  `CURRENT_AUTHORITY` varchar(255),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251
