
CREATE TABLE `BRANCHES` (
  `BRANCH_ID` bigint(20) NOT NULL,
  `ID` bigint(20),
  `CODE` varchar(8),
  `NAME` varchar(400),
  `ADDRESS` varchar(255),
  `SIGNER` varchar(300),
  `CREATE_DATE` varchar(10),
  `CONTACTS` varchar(255),
  PRIMARY KEY (`BRANCH_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251
