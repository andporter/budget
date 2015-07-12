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

INSERT INTO category (categoryParentId, categoryOrder, categoryName, categoryHoverToolTip, calculatorType) VALUES
(1, 1, 'Wages from Employment', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce quis massa mollis, dignissim dolor vitae, aliquet lorem. Phasellus euismod cursus leo, a consectetur purus facilisis ut. Sed lacinia tempor lorem, vitae dignissim elit consectetur ac. Vestibulum congue hendrerit ante a feugiat. Suspendisse potenti. Morbi vulputate diam lacus, at pellentesque est rhoncus porta. Vestibulum neque sem, luctus eu velit a, laoreet mattis nulla. Vivamus dui ligula, malesuada id commodo in, ornare nec diam. Donec vel sem pretium, lobortis sem ut, aliquam dolor. Nulla fermentum pharetra tempus. Vestibulum rhoncus porta urna, vitae tristique velit mattis quis. Duis vehicula massa ac odio tincidunt consequat. Maecenas rhoncus dignissim maximus. Donec ex nisl, volutpat at rutrum vulputate, facilisis ut arcu.','MonthlyWage'),
(1, 2, 'Income from Self-employment', 'Tooltip','MonthlySE'),
(1, 3, 'Other Wages From Employment', 'Tooltip','MonthlySE'),
(2, 1, 'Social Security or Railroad Retirement', 'Tooltip',NULL),
(2, 2, 'Pension Income', 'Tooltip',NULL),
(2, 3, 'Other Retirement (IRA, Annuity, etc.)', 'Tooltip',NULL),
(2, 4, 'Interest and Dividend Income', 'Tooltip',NULL),
(3, 1, 'Alimony', 'Tooltip',NULL),
(3, 2, 'Child Support', 'Tooltip',NULL),
(3, 3, 'Social Security Disability (SSDI)', 'Tooltip',NULL),
(3, 4, 'Supplemental Security Income (SSI)', 'Tooltip',NULL),
(3, 5, 'Federal and State tax refund', 'Tooltip',NULL),
(3, 6, 'Public Housing (Subsidized portion)', 'Tooltip',NULL),
(3, 7, 'Food Stamps', 'Tooltip',NULL),
(3, 8, 'Financial (FEP or General Assistance)', 'Tooltip',NULL),
(3, 9, 'State Childcare Assistance', 'Tooltip',NULL),
(3, 10, 'Internships with Stipend (Work study, Easter Seals, etc.)', 'Tooltip',NULL),
(3, 11, 'Other cash assistance (Training funds)', 'Tooltip',NULL),
(4, 1, 'Federal withholding', 'Tooltip','NonMonthly'),
(4, 2, 'State withholding', 'Tooltip','NonMonthly'),
(4, 3, 'Social Security and Medicare (FICA) taxes', 'Tooltip','NonMonthly'),
(4, 4, 'Health insurance', 'Tooltip','NonMonthly'),
(4, 5, 'Dental insurance', 'Tooltip','NonMonthly'),
(4, 6, 'Vision insurance', 'Tooltip','NonMonthly'),
(4, 7, 'Retirement (401K, 403B, etc.)', 'Tooltip','NonMonthly'),
(4, 8, 'Medical Savings (FSA or HSA)', 'Tooltip','NonMonthly'),
(4, 9, 'Garnishments (Child support, collections, taxes)', 'Tooltip','NonMonthly'),
(5, 1, 'Rent payment', 'Tooltip','NonMonthly'),
(5, 2, '1st mortgage payment', 'Tooltip','NonMonthly'),
(5, 3, '2nd mortgage payment', 'Tooltip','NonMonthly'),
(5, 4, 'Homeowner''s Insurance', 'Tooltip','NonMonthly'),
(5, 5, 'Property taxes', 'Tooltip','NonMonthly'),
(5, 6, 'Repairs, improvements, and maintenance', 'Tooltip','NonMonthly'),
(5, 7, 'Power (Electricity)', 'Tooltip','NonMonthly'),
(5, 8, 'Heat', 'Tooltip','NonMonthly'),
(5, 9, 'Garbage (Sewer)', 'Tooltip','NonMonthly'),
(5, 10, 'Water', 'Tooltip','NonMonthly'),
(5, 11, 'Garbage', 'Tooltip','NonMonthly'),
(5, 12, 'Phone (Home)', 'Tooltip','NonMonthly'),
(5, 13, 'Phone (Mobile)', 'Tooltip','NonMonthly'),
(5, 14, 'Internet', 'Tooltip','NonMonthly'),
(5, 15, 'Other housing costs', 'Tooltip','NonMonthly'),
(6, 1, 'Buss pass', 'Tooltip','NonMonthly'),
(6, 2, 'Auto loan', 'Tooltip','NonMonthly'),
(6, 3, 'Auto insurance', 'Tooltip','NonMonthly'),
(6, 4, 'Auto fuel (Gas)', 'Tooltip','NonMonthly'),
(6, 5, 'Registration (Property taxes)', 'Tooltip','NonMonthly'),
(6, 6, 'Routine maintenance', 'Tooltip','NonMonthly'),
(6, 7, 'Major repairs', 'Tooltip','NonMonthly'),
(6, 8, 'Other transportation costs', 'Tooltip','NonMonthly'),
(7, 1, 'Health insurance from payroll deductions', 'Tooltip','NonMonthly'),
(7, 2, 'Health insurance, I pay on my own', 'Tooltip','NonMonthly'),
(7, 3, 'Dental insurance from payroll deductions', 'Tooltip','NonMonthly'),
(7, 4, 'Dental insurance, I pay on my own', 'Tooltip','NonMonthly'),
(7, 5, 'Vision insurance from payroll deductions', 'Tooltip','NonMonthly'),
(7, 6, 'Vision insurance, I pay on my own', 'Tooltip','NonMonthly'),
(7, 7, 'Prescriptions', 'Tooltip','NonMonthly'),
(7, 8, 'Co-Pays (Doctor, dentists, hospitals, specialists, etc.)', 'Tooltip','NonMonthly'),
(7, 9, 'Other medical expenses', 'Tooltip','NonMonthly'),
(8, 1, 'Food – Groceries', 'Tooltip','NonMonthly'),
(8, 2, 'Household goods (Cleaning supplies, toilet paper, etc.)', 'Tooltip','NonMonthly'),
(8, 3, 'Clothing and uniforms', 'Tooltip','NonMonthly'),
(8, 4, 'Personal Items (Soaps, lotions, deodorant, haircuts, etc.)', 'Tooltip','NonMonthly'),
(8, 5, 'Other general shopping expenses', 'Tooltip','NonMonthly'),
(9, 1, 'Emergency', 'Tooltip','NonMonthly'),
(9, 2, 'Revolving', 'Tooltip','NonMonthly'),
(9, 3, 'Medical savings (FSA or HSA) ', 'Tooltip','NonMonthly'),
(9, 4, 'Education', 'Tooltip','NonMonthly'),
(9, 5, 'Retirement (401K, 403B, IRA, etc.)', 'Tooltip','NonMonthly'),
(9, 6, 'Investments (Stocks, bonds, mutual funds, etc.)', 'Tooltip','NonMonthly'),
(9, 7, 'Other savings and investing', 'Tooltip','NonMonthly'),
(10, 1, 'Credit Card, store accounts, or other revolving debt', 'Tooltip','NonMonthly'),
(10, 2, 'Other installment loans (not mortgage or auto)', 'Tooltip','NonMonthly'),
(10, 3, 'Line-of-credit / Home equity', 'Tooltip','NonMonthly'),
(10, 4, 'Student loans', 'Tooltip','NonMonthly'),
(10, 5, 'Payday or title loans, collections, and judgements', 'Tooltip','NonMonthly'),
(10, 6, 'Legal obligations (Alimony, child support, back taxes, etc.)', 'Tooltip','NonMonthly'),
(10, 7, 'Other debt', 'Tooltip','NonMonthly'),
(11, 1, 'Cash donations to nonprofits', 'Tooltip','NonMonthly'),
(11, 2, 'Cash donations to churches (Tithing)', 'Tooltip','NonMonthly'),
(11, 3, 'Other cash donations', 'Tooltip','NonMonthly'),
(12, 1, 'Eating out, date nights, etc.', 'Tooltip','NonMonthly'),
(12, 2, 'Recreation & hobbies (Sports, clubs, etc.)', 'Tooltip','NonMonthly'),
(12, 3, 'Holidays, gifts, special occasions', 'Tooltip','NonMonthly'),
(12, 4, 'Personal habits (Coffee, pop, snacks, tobacco, alcohol, etc.)', 'Tooltip','NonMonthly'),
(12, 5, 'Cable, satellite, other subscriptions', 'Tooltip','NonMonthly'),
(12, 6, 'Vacation and family traditions', 'Tooltip','NonMonthly'),
(12, 7, 'Physical fitness (Memberships, fees, registration)', 'Tooltip','NonMonthly'),
(12, 8, 'Pet expenses (Food, vets, etc.)', 'Tooltip','NonMonthly'),
(12, 9, 'Childcare (Pre-school or daycare)', 'Tooltip','NonMonthly'),
(12, 10, 'Educational expenses', 'Tooltip','NonMonthly'),
(12, 11, 'Child support and alimony', 'Tooltip','NonMonthly'),
(12, 12, 'Federal and State taxes withheld from wages', 'Tooltip','NonMonthly'),
(12, 13, 'Other personal lifestyle expenses', 'Tooltip','NonMonthly');


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
