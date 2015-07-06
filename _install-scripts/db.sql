-- CREATE DATABASE IF NOT EXISTS expungement;

DROP DATABASE IF EXISTS budget;
CREATE DATABASE budget;

USE budget;

DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users (
    userId int(11) NOT NULL AUTO_INCREMENT,
    userType ENUM('Admin', 'Regular') NOT NULL DEFAULT 'Regular',
    userName varchar(64) NOT NULL,
    userPasswordHash varchar(255) NOT NULL,
    userEmail varchar(64) NOT NULL,
    firstName varchar(64) NOT NULL,
    lastName varchar(64) NOT NULL,
    phone varchar(64),
    phoneCanText boolean,
    isMarried boolean,
    spouseFirstName varchar(64),
    spouseLastName varchar(64),
    spouseEmail varchar(64),
    dependent0_4 int(2),
    dependent5_18 int(2),
    PRIMARY KEY (userId),
    UNIQUE KEY userName (userName),
    UNIQUE KEY userEmail (userEmail)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO users (userName, userType, userPasswordHash, userEmail, firstName, lastName) VALUES ('admin','Admin','$2y$10$Tf8KbXWg/y5.bOxrk9njXOC6HkYJ6pj3WRfNZ5XA5PEH3NK3mmOOK','admin@example.com','First','Last');


DROP TABLE IF EXISTS categoryParent;
CREATE TABLE IF NOT EXISTS categoryParent (
  categoryParentId int(5) NOT NULL AUTO_INCREMENT,
  categoryParentType enum('Income','Expense') NOT NULL,
  categoryParentOrder int(5) NOT NULL,
  categoryParentName varchar(1000) NOT NULL,
  PRIMARY KEY (categoryParentId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO categoryParent (categoryParentId, categoryParentType, categoryParentOrder, categoryParentName) VALUES 
(1, 'Income', 1, 'Earned Income'),
(2, 'Income', 2, 'Retirement and Investment Income'),
(3, 'Income', 3, 'Income – Public Benefits (Subsidies)'),
(4, 'Expense', 1, 'Payroll Deductions Input Screen'),
(5, 'Expense', 2, 'Housing (Shelter) Costs'),
(6, 'Expense', 3, 'Transportation Costs'),
(7, 'Expense', 4, 'Healthcare Expenses'),
(8, 'Expense', 5, 'Food, Household, Personal, Clothing and General Shopping'),
(9, 'Expense', 6, 'Personal Savings & Investing'),
(10, 'Expense', 7, 'Other Debt Obligations'),
(11, 'Expense', 8, 'Charitable Giving'),
(12, 'Expense', 9, 'Personal Lifestyle & Other Expenses');


DROP TABLE IF EXISTS category;
CREATE TABLE IF NOT EXISTS category (
  categoryId int(5) NOT NULL AUTO_INCREMENT,
  categoryParentId int(5) NOT NULL,
  categoryOrder int(5) NOT NULL,
  categoryName varchar(1000) NOT NULL,
  categoryHoverToolTip varchar(1000) NOT NULL,
  calculatorType enum('MonthlyWage','MonthlySE','NonMonthly') NULL,
  PRIMARY KEY (categoryId),
  FOREIGN KEY (categoryParentId) references categoryParent(categoryParentId) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO category (categoryId, categoryParentId, categoryOrder, categoryName, categoryHoverToolTip, calculatorType) VALUES
(1, 1, 1, 'Wages from Employment', 'Tooltip','MonthlyWage'),
(2, 1, 2, 'Income from Self-employment', 'Tooltip','MonthlySE'),
(3, 2, 1, 'Social Security or Railroad Retirement', 'Tooltip',NULL),
(4, 2, 2, 'Pension Income', 'Tooltip',NULL),
(5, 2, 3, 'Other Retirement (IRA, Annuity, etc.)', 'Tooltip',NULL),
(6, 2, 4, 'Interest and Dividend Income', 'Tooltip',NULL),
(7, 3, 1, 'Alimony & Child Support', 'Tooltip',NULL),
(8, 3, 2, 'Social Security Disability (SSDI)', 'Tooltip',NULL),
(9, 3, 3, 'Supplemental Security Income (SSI)', 'Tooltip',NULL),
(10, 3, 4, 'Federal and State tax refund', 'Tooltip',NULL),
(11, 3, 5, 'Public Housing (Subsidized portion)', 'Tooltip',NULL),
(12, 3, 6, 'Food Stamps', 'Tooltip',NULL),
(13, 3, 7, 'Financial (FEP or General Assistance)', 'Tooltip',NULL),
(14, 3, 8, 'State Childcare Assistance', 'Tooltip',NULL),
(15, 3, 9, 'Internships with Stipend (Work study, Easter Seals, etc.)', 'Tooltip',NULL),
(16, 3, 10, 'Other cash assistance (Training funds)', 'Tooltip',NULL),
(17, 4, 1, 'Federal withholding', 'Tooltip',NULL),
(18, 4, 2, 'State withholding', 'Tooltip',NULL),
(19, 4, 3, 'Social Security and Medicare (FICA) taxes', 'Tooltip',NULL),
(20, 4, 4, 'Health insurance', 'Tooltip',NULL),
(21, 4, 5, 'Dental insurance', 'Tooltip',NULL),
(22, 4, 6, 'Vision insurance', 'Tooltip',NULL),
(23, 4, 7, 'Retirement (401K, 403B, etc.)', 'Tooltip',NULL),
(24, 4, 8, 'Medical Savings (FSA or HSA)', 'Tooltip',NULL),
(25, 4, 9, 'Garnishments (Child support, collections, taxes)', 'Tooltip',NULL),
(26, 5, 1, 'Rent payment', 'Tooltip',NULL),
(27, 5, 2, '1st mortgage payment', 'Tooltip',NULL),
(28, 5, 3, '2nd mortgage payment', 'Tooltip',NULL),
(29, 5, 4, 'Property taxes', 'Tooltip',NULL),
(30, 5, 5, 'Repairs, improvements, and maintenance', 'Tooltip',NULL),
(31, 5, 6, 'Power (Electricity)', 'Tooltip',NULL),
(32, 5, 7, 'Heat', 'Tooltip',NULL),
(33, 5, 8, 'Garbage (Sewer)', 'Tooltip',NULL),
(34, 5, 9, 'Water', 'Tooltip',NULL),
(35, 5, 10, 'Garbage', 'Tooltip',NULL),
(36, 5, 11, 'Phone (Home)', 'Tooltip',NULL),
(37, 5, 12, 'Phone (Mobile)', 'Tooltip',NULL),
(38, 5, 13, 'Internet', 'Tooltip',NULL),
(39, 5, 14, 'Other housing costs', 'Tooltip',NULL),
(40, 6, 1, 'Buss pass', 'Tooltip',NULL),
(41, 6, 2, 'Auto loan', 'Tooltip',NULL),
(42, 6, 3, 'Auto insurance', 'Tooltip',NULL),
(43, 6, 4, 'Auto fuel (Gas)', 'Tooltip',NULL),
(44, 6, 5, 'Registration (Property taxes)', 'Tooltip',NULL),
(45, 6, 6, 'Routine maintenance', 'Tooltip',NULL),
(46, 6, 7, 'Major repairs', 'Tooltip',NULL),
(47, 6, 8, 'Other transportation costs', 'Tooltip',NULL),
(48, 7, 1, 'Health insurance from payroll deductions', 'Tooltip',NULL),
(49, 7, 2, 'Health insurance, I pay on my own', 'Tooltip',NULL),
(50, 7, 3, 'Dental insurance from payroll deductions', 'Tooltip',NULL),
(51, 7, 4, 'Dental insurance, I pay on my own', 'Tooltip',NULL),
(52, 7, 5, 'Vision insurance', 'Tooltip',NULL),
(53, 7, 6, 'Prescriptions', 'Tooltip',NULL),
(54, 7, 7, 'Co-Pays (Doctor, dentists, hospitals, specialists, etc.)', 'Tooltip',NULL),
(55, 7, 8, 'Other medical expenses', 'Tooltip',NULL),
(56, 8, 1, 'Food – Groceries', 'Tooltip',NULL),
(57, 8, 2, 'Household goods (Cleaning supplies, toilet paper, etc.)', 'Tooltip',NULL),
(58, 8, 3, 'Clothing and uniforms', 'Tooltip',NULL),
(59, 8, 4, 'Personal Items (Soaps, lotions, deodorant, haircuts, etc.)', 'Tooltip',NULL),
(60, 8, 5, 'Other general shopping expenses', 'Tooltip',NULL),
(61, 9, 1, 'Emergency', 'Tooltip',NULL),
(63, 9, 2, 'Revolving', 'Tooltip',NULL),
(64, 9, 3, 'Medical savings (FSA or HSA) ', 'Tooltip',NULL),
(65, 9, 4, 'Education', 'Tooltip',NULL),
(66, 9, 5, 'Retirement (401K, 403B, IRA, etc.)', 'Tooltip',NULL),
(67, 9, 6, 'Investments (Stocks, bonds, mutual funds, etc.)', 'Tooltip',NULL),
(68, 9, 7, 'Other savings and investing', 'Tooltip',NULL),
(69, 10, 1, 'Credit Card, store accounts, or other revolving debt', 'Tooltip',NULL),
(70, 10, 2, 'Other installment loans (not mortgage or auto)', 'Tooltip',NULL),
(71, 10, 3, 'Line-of-credit / Home equity', 'Tooltip',NULL),
(72, 10, 4, 'Student loans', 'Tooltip',NULL),
(73, 10, 5, 'Payday or title loans, collections, and judgements', 'Tooltip',NULL),
(74, 10, 6, 'Legal obligations (Alimony, child support, back taxes, etc.)', 'Tooltip',NULL),
(75, 10, 7, 'Other debt', 'Tooltip',NULL),
(76, 11, 1, 'Cash donations to nonprofits', 'Tooltip',NULL),
(77, 11, 2, 'Cash donations to churches (Tithing)', 'Tooltip',NULL),
(78, 11, 3, 'Other cash donations', 'Tooltip',NULL),
(79, 12, 1, 'Eating out, date nights, etc.', 'Tooltip',NULL),
(80, 12, 2, 'Recreation & hobbies (Sports, clubs, etc.)', 'Tooltip',NULL),
(81, 12, 3, 'Holidays, gifts, special occasions', 'Tooltip',NULL),
(82, 12, 4, 'Personal habits (Coffee, pop, snacks, tobacco, alcohol, etc.)', 'Tooltip',NULL),
(83, 12, 5, 'Cable, satellite, other subscriptions', 'Tooltip',NULL),
(84, 12, 6, 'Vacation and family traditions', 'Tooltip',NULL),
(85, 12, 7, 'Physical fitness (Memberships, fees, registration)', 'Tooltip',NULL),
(86, 12, 8, 'Pet expenses (Food, vets, etc.)', 'Tooltip',NULL),
(87, 12, 9, 'Childcare (Pre-school or daycare)', 'Tooltip',NULL),
(88, 12, 10, 'Educational expenses', 'Tooltip',NULL),
(89, 12, 11, 'Child support and alimony', 'Tooltip',NULL),
(90, 12, 12, 'Federal and State taxes withheld from wages', 'Tooltip',NULL),
(91, 12, 13, 'Other personal lifestyle expenses', 'Tooltip',NULL);


DROP TABLE IF EXISTS budget;
CREATE TABLE budget (
    budgetId int(11),
    userId int(11),
    budgetName varchar(64),
    isBaseline boolean,
    isComplete boolean,
    dateCreated DATETIME,
    dateUpdated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (budgetId),
    FOREIGN KEY (userId) references users(userId) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS budgetDetail;
CREATE TABLE budgetDetail (
    budgetDetailId int(11),
    budgetId int(11),
    categoryId int(5),
    amount int(10),
    spouseAmount int(10),
    PRIMARY KEY (budgetDetailId),
    FOREIGN KEY (budgetId) references budget(budgetId) on delete cascade,
    FOREIGN KEY (categoryId) references category(categoryId) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
