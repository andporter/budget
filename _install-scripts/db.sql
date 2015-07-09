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
(1, 'Income', 1, 'Monthly Earned Income'),
(2, 'Income', 2, 'Monthly Retirement and Investment Income'),
(3, 'Income', 3, 'Monthly Public Benefits (Subsidies)'),
(4, 'Expense', 1, 'Monthly Payroll Deductions Input Screen'),
(5, 'Expense', 2, 'Monthly Housing (Shelter) Costs'),
(6, 'Expense', 3, 'Monthly Transportation Costs'),
(7, 'Expense', 4, 'Monthly Healthcare Expenses'),
(8, 'Expense', 5, 'Monthly Food, Household, Personal, Clothing and General Shopping'),
(9, 'Expense', 6, 'Monthly Personal Savings & Investing'),
(10, 'Expense', 7, 'Monthly Other Debt Obligations'),
(11, 'Expense', 8, 'Monthly Charitable Giving'),
(12, 'Expense', 9, 'Monthly Personal Lifestyle & Other Expenses');


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
(92, 1, 3, 'Other Wages From Employment', 'Tooltip','MonthlySE'),
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
(17, 4, 1, 'Federal withholding', 'Tooltip','NonMonthly'),
(18, 4, 2, 'State withholding', 'Tooltip','NonMonthly'),
(19, 4, 3, 'Social Security and Medicare (FICA) taxes', 'Tooltip','NonMonthly'),
(20, 4, 4, 'Health insurance', 'Tooltip','NonMonthly'),
(21, 4, 5, 'Dental insurance', 'Tooltip','NonMonthly'),
(22, 4, 6, 'Vision insurance', 'Tooltip','NonMonthly'),
(23, 4, 7, 'Retirement (401K, 403B, etc.)', 'Tooltip','NonMonthly'),
(24, 4, 8, 'Medical Savings (FSA or HSA)', 'Tooltip','NonMonthly'),
(25, 4, 9, 'Garnishments (Child support, collections, taxes)', 'Tooltip','NonMonthly'),
(26, 5, 1, 'Rent payment', 'Tooltip','NonMonthly'),
(27, 5, 2, '1st mortgage payment', 'Tooltip','NonMonthly'),
(28, 5, 3, '2nd mortgage payment', 'Tooltip','NonMonthly'),
(29, 5, 4, 'Property taxes', 'Tooltip','NonMonthly'),
(30, 5, 5, 'Repairs, improvements, and maintenance', 'Tooltip','NonMonthly'),
(31, 5, 6, 'Power (Electricity)', 'Tooltip','NonMonthly'),
(32, 5, 7, 'Heat', 'Tooltip','NonMonthly'),
(33, 5, 8, 'Garbage (Sewer)', 'Tooltip','NonMonthly'),
(34, 5, 9, 'Water', 'Tooltip','NonMonthly'),
(35, 5, 10, 'Garbage', 'Tooltip','NonMonthly'),
(36, 5, 11, 'Phone (Home)', 'Tooltip','NonMonthly'),
(37, 5, 12, 'Phone (Mobile)', 'Tooltip','NonMonthly'),
(38, 5, 13, 'Internet', 'Tooltip','NonMonthly'),
(39, 5, 14, 'Other housing costs', 'Tooltip','NonMonthly'),
(40, 6, 1, 'Buss pass', 'Tooltip','NonMonthly'),
(41, 6, 2, 'Auto loan', 'Tooltip','NonMonthly'),
(42, 6, 3, 'Auto insurance', 'Tooltip','NonMonthly'),
(43, 6, 4, 'Auto fuel (Gas)', 'Tooltip','NonMonthly'),
(44, 6, 5, 'Registration (Property taxes)', 'Tooltip','NonMonthly'),
(45, 6, 6, 'Routine maintenance', 'Tooltip','NonMonthly'),
(46, 6, 7, 'Major repairs', 'Tooltip','NonMonthly'),
(47, 6, 8, 'Other transportation costs', 'Tooltip','NonMonthly'),
(48, 7, 1, 'Health insurance from payroll deductions', 'Tooltip','NonMonthly'),
(49, 7, 2, 'Health insurance, I pay on my own', 'Tooltip','NonMonthly'),
(50, 7, 3, 'Dental insurance from payroll deductions', 'Tooltip','NonMonthly'),
(51, 7, 4, 'Dental insurance, I pay on my own', 'Tooltip','NonMonthly'),
(52, 7, 5, 'Vision insurance', 'Tooltip','NonMonthly'),
(53, 7, 6, 'Prescriptions', 'Tooltip','NonMonthly'),
(54, 7, 7, 'Co-Pays (Doctor, dentists, hospitals, specialists, etc.)', 'Tooltip','NonMonthly'),
(55, 7, 8, 'Other medical expenses', 'Tooltip','NonMonthly'),
(56, 8, 1, 'Food – Groceries', 'Tooltip','NonMonthly'),
(57, 8, 2, 'Household goods (Cleaning supplies, toilet paper, etc.)', 'Tooltip','NonMonthly'),
(58, 8, 3, 'Clothing and uniforms', 'Tooltip','NonMonthly'),
(59, 8, 4, 'Personal Items (Soaps, lotions, deodorant, haircuts, etc.)', 'Tooltip','NonMonthly'),
(60, 8, 5, 'Other general shopping expenses', 'Tooltip','NonMonthly'),
(61, 9, 1, 'Emergency', 'Tooltip','NonMonthly'),
(63, 9, 2, 'Revolving', 'Tooltip','NonMonthly'),
(64, 9, 3, 'Medical savings (FSA or HSA) ', 'Tooltip','NonMonthly'),
(65, 9, 4, 'Education', 'Tooltip','NonMonthly'),
(66, 9, 5, 'Retirement (401K, 403B, IRA, etc.)', 'Tooltip','NonMonthly'),
(67, 9, 6, 'Investments (Stocks, bonds, mutual funds, etc.)', 'Tooltip','NonMonthly'),
(68, 9, 7, 'Other savings and investing', 'Tooltip','NonMonthly'),
(69, 10, 1, 'Credit Card, store accounts, or other revolving debt', 'Tooltip','NonMonthly'),
(70, 10, 2, 'Other installment loans (not mortgage or auto)', 'Tooltip','NonMonthly'),
(71, 10, 3, 'Line-of-credit / Home equity', 'Tooltip','NonMonthly'),
(72, 10, 4, 'Student loans', 'Tooltip','NonMonthly'),
(73, 10, 5, 'Payday or title loans, collections, and judgements', 'Tooltip','NonMonthly'),
(74, 10, 6, 'Legal obligations (Alimony, child support, back taxes, etc.)', 'Tooltip','NonMonthly'),
(75, 10, 7, 'Other debt', 'Tooltip','NonMonthly'),
(76, 11, 1, 'Cash donations to nonprofits', 'Tooltip','NonMonthly'),
(77, 11, 2, 'Cash donations to churches (Tithing)', 'Tooltip','NonMonthly'),
(78, 11, 3, 'Other cash donations', 'Tooltip','NonMonthly'),
(79, 12, 1, 'Eating out, date nights, etc.', 'Tooltip','NonMonthly'),
(80, 12, 2, 'Recreation & hobbies (Sports, clubs, etc.)', 'Tooltip','NonMonthly'),
(81, 12, 3, 'Holidays, gifts, special occasions', 'Tooltip','NonMonthly'),
(82, 12, 4, 'Personal habits (Coffee, pop, snacks, tobacco, alcohol, etc.)', 'Tooltip','NonMonthly'),
(83, 12, 5, 'Cable, satellite, other subscriptions', 'Tooltip','NonMonthly'),
(84, 12, 6, 'Vacation and family traditions', 'Tooltip','NonMonthly'),
(85, 12, 7, 'Physical fitness (Memberships, fees, registration)', 'Tooltip','NonMonthly'),
(86, 12, 8, 'Pet expenses (Food, vets, etc.)', 'Tooltip','NonMonthly'),
(87, 12, 9, 'Childcare (Pre-school or daycare)', 'Tooltip','NonMonthly'),
(88, 12, 10, 'Educational expenses', 'Tooltip','NonMonthly'),
(89, 12, 11, 'Child support and alimony', 'Tooltip','NonMonthly'),
(90, 12, 12, 'Federal and State taxes withheld from wages', 'Tooltip','NonMonthly'),
(91, 12, 13, 'Other personal lifestyle expenses', 'Tooltip','NonMonthly');


DROP TABLE IF EXISTS budget;
CREATE TABLE budget (
    budgetId int(11) NOT NULL AUTO_INCREMENT,
    userId int(11) NOT NULL,
    budgetName varchar(64),
    isBaseline boolean,
    isComplete boolean,
    dateCreated DATETIME NOT NULL,
    dateUpdated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (budgetId),
    FOREIGN KEY (userId) references users(userId) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS budgetDetail;
CREATE TABLE budgetDetail (
    budgetDetailId int(11)  NOT NULL AUTO_INCREMENT,
    budgetId int(11) NOT NULL,
    categoryId int(5) NOT NULL,
    amount int(10),
    spouseAmount int(10),
    PRIMARY KEY (budgetDetailId),
    FOREIGN KEY (budgetId) references budget(budgetId) on delete cascade,
    FOREIGN KEY (categoryId) references category(categoryId) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
