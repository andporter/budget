-- CREATE DATABASE IF NOT EXISTS expungement;

DROP DATABASE IF EXISTS budget;
CREATE DATABASE budget;

USE budget;

DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users (
    userId int(11) NOT NULL AUTO_INCREMENT,
    userType ENUM('Admin', 'Regular') NOT NULL,
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
  PRIMARY KEY (categoryId),
  FOREIGN KEY (categoryParentId) references categoryParent(categoryParentId) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO category (categoryId, categoryParentId, categoryOrder, categoryName, categoryHoverToolTip) VALUES
(1, 1, 1, 'Wages from Employment', 'Tooltip'),
(2, 1, 2, 'Income from Self-employment', 'Tooltip'),

(3, 2, 1, 'Social Security or Railroad Retirement', 'Tooltip'),
(4, 2, 2, 'Pension Income', 'Tooltip'),
(5, 2, 3, 'Other Retirement (IRA, Annuity, etc.)', 'Tooltip'),
(6, 2, 4, 'Interest and Dividend Income', 'Tooltip'),

(7, 3, 1, 'Alimony & Child Support', 'Tooltip'),
(8, 3, 2, 'Social Security Disability (SSDI)', 'Tooltip'),
(9, 3, 3, 'Supplemental Security Income (SSI)', 'Tooltip'),
(10, 3, 4, 'Federal and State tax refund', 'Tooltip'),
(11, 3, 5, 'Public Housing (Subsidized portion)', 'Tooltip'),
(12, 3, 6, 'Food Stamps', 'Tooltip'),
(13, 3, 7, 'Financial (FEP or General Assistance)', 'Tooltip'),
(14, 3, 8, 'State Childcare Assistance', 'Tooltip'),
(15, 3, 9, 'Internships with Stipend (Work study, Easter Seals, etc.)', 'Tooltip'),
(16, 3, 10, 'Other cash assistance (Training funds)', 'Tooltip'),

(17, 4, 1, 'Federal withholding', 'Tooltip'),
(18, 4, 2, 'State withholding', 'Tooltip'),
(19, 4, 3, 'Social Security and Medicare (FICA) taxes', 'Tooltip'),
(20, 4, 4, 'Health insurance', 'Tooltip'),
(21, 4, 5, 'Dental insurance', 'Tooltip'),
(22, 4, 6, 'Vision insurance', 'Tooltip'),
(23, 4, 7, 'Retirement (401K, 403B, etc.)', 'Tooltip'),
(24, 4, 8, 'Medical Savings (FSA or HSA)', 'Tooltip'),
(25, 4, 9, 'Garnishments (Child support, collections, taxes)', 'Tooltip'),

(26, 5, 1, 'Rent payment', 'Tooltip'),
(27, 5, 2, '1st mortgage payment', 'Tooltip'),
(28, 5, 3, '2nd mortgage payment', 'Tooltip'),
(29, 5, 4, 'Property taxes', 'Tooltip'),
(30, 5, 5, 'Repairs, improvements, and maintenance', 'Tooltip'),
(31, 5, 6, 'Power (Electricity)', 'Tooltip'),
(32, 5, 7, 'Heat', 'Tooltip'),
(33, 5, 8, 'Garbage (Sewer)', 'Tooltip'),
(34, 5, 9, 'Water', 'Tooltip'),
(35, 5, 10, 'Garbage', 'Tooltip'),
(36, 5, 11, 'Phone (Home)', 'Tooltip'),
(37, 5, 12, 'Phone (Mobile)', 'Tooltip'),
(38, 5, 13, 'Internet', 'Tooltip'),
(39, 5, 14, 'Other housing costs', 'Tooltip'),

(40, 6, 1, 'Buss pass', 'Tooltip'),
(41, 6, 2, 'Auto loan', 'Tooltip'),
(42, 6, 3, 'Auto insurance', 'Tooltip'),
(43, 6, 4, 'Auto fuel (Gas)', 'Tooltip'),
(44, 6, 5, 'Registration (Property taxes)', 'Tooltip'),
(45, 6, 6, 'Routine maintenance', 'Tooltip'),
(46, 6, 7, 'Major repairs', 'Tooltip'),
(47, 6, 8, 'Other transportation costs', 'Tooltip'),

(48, 7, 1, 'Health insurance from payroll deductions', 'Tooltip'),
(49, 7, 2, 'Health insurance, I pay on my own', 'Tooltip'),
(50, 7, 3, 'Dental insurance from payroll deductions', 'Tooltip'),
(51, 7, 4, 'Dental insurance, I pay on my own', 'Tooltip'),
(52, 7, 5, 'Vision insurance', 'Tooltip'),
(53, 7, 6, 'Prescriptions', 'Tooltip'),
(54, 7, 7, 'Co-Pays (Doctor, dentists, hospitals, specialists, etc.)', 'Tooltip'),
(55, 7, 8, 'Other medical expenses', 'Tooltip'),

(56, 8, 1, 'Food – Groceries', 'Tooltip'),
(57, 8, 2, 'Household goods (Cleaning supplies, toilet paper, etc.)', 'Tooltip'),
(58, 8, 3, 'Clothing and uniforms', 'Tooltip'),
(59, 8, 4, 'Personal Items (Soaps, lotions, deodorant, haircuts, etc.)', 'Tooltip'),
(60, 8, 5, 'Other general shopping expenses', 'Tooltip'),

(61, 9, 1, 'Emergency', 'Tooltip'),
(63, 9, 2, 'Revolving', 'Tooltip'),
(64, 9, 3, 'Medical savings (FSA or HSA) ', 'Tooltip'),
(65, 9, 4, 'Education', 'Tooltip'),
(66, 9, 5, 'Retirement (401K, 403B, IRA, etc.)', 'Tooltip'),
(67, 9, 6, 'Investments (Stocks, bonds, mutual funds, etc.)', 'Tooltip'),
(68, 9, 7, 'Other savings and investing', 'Tooltip'),

(69, 10, 1, 'Credit Card, store accounts, or other revolving debt', 'Tooltip'),
(70, 10, 2, 'Other installment loans (not mortgage or auto)', 'Tooltip'),
(71, 10, 3, 'Line-of-credit / Home equity', 'Tooltip'),
(72, 10, 4, 'Student loans', 'Tooltip'),
(73, 10, 5, 'Payday or title loans, collections, and judgements', 'Tooltip'),
(74, 10, 6, 'Legal obligations (Alimony, child support, back taxes, etc.)', 'Tooltip'),
(75, 10, 7, 'Other debt', 'Tooltip'),

(76, 11, 1, 'Cash donations to nonprofits', 'Tooltip'),
(77, 11, 2, 'Cash donations to churches (Tithing)', 'Tooltip'),
(78, 11, 3, 'Other cash donations', 'Tooltip'),

(79, 12, 1, 'Eating out, date nights, etc.', 'Tooltip'),
(80, 12, 2, 'Recreation & hobbies (Sports, clubs, etc.)', 'Tooltip'),
(81, 12, 3, 'Holidays, gifts, special occasions', 'Tooltip'),
(82, 12, 4, 'Personal habits (Coffee, pop, snacks, tobacco, alcohol, etc.)', 'Tooltip'),
(83, 12, 5, 'Cable, satellite, other subscriptions', 'Tooltip'),
(84, 12, 6, 'Vacation and family traditions', 'Tooltip'),
(85, 12, 7, 'Physical fitness (Memberships, fees, registration)', 'Tooltip'),
(86, 12, 8, 'Pet expenses (Food, vets, etc.)', 'Tooltip'),
(87, 12, 9, 'Childcare (Pre-school or daycare)', 'Tooltip'),
(88, 12, 10, 'Educational expenses', 'Tooltip'),
(89, 12, 11, 'Child support and alimony', 'Tooltip'),
(90, 12, 12, 'Federal and State taxes withheld from wages', 'Tooltip'),
(91, 12, 13, 'Other personal lifestyle expenses', 'Tooltip');


DROP TABLE IF EXISTS budget;
CREATE TABLE budget (
    budgetId int(11),
    userId int(11),
    budgetName varchar(64),
    isBaseline boolean,
    isCOmplete boolean,
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
    isCOmplete boolean,
    PRIMARY KEY (budgetDetailId),
    FOREIGN KEY (budgetId) references budget(budgetId) on delete cascade,
    FOREIGN KEY (categoryId) references category(categoryId) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;