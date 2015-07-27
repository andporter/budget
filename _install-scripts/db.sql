-- CREATE DATABASE IF NOT EXISTS expungement;

DROP DATABASE IF EXISTS budget;
CREATE DATABASE budget;

USE budget;

DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users (
    userId int UNSIGNED NOT NULL AUTO_INCREMENT,
    userType ENUM('Admin', 'Regular') NOT NULL DEFAULT 'Regular',
    userName varchar(64) NOT NULL,
    userPasswordHash varchar(255) NOT NULL,
    userEmail varchar(64) NOT NULL,
    firstName varchar(64),
    lastName varchar(64),
    phone varchar(64),
    phoneCanText boolean,
    isMarried boolean,
    spouseFirstName varchar(64),
    spouseLastName varchar(64),
    spouseEmail varchar(64),
    dependent0_4 int,
    dependent5_18 int,
    dependentAdditional int,
    PRIMARY KEY (userId),
    UNIQUE KEY userName (userName),
    UNIQUE KEY userEmail (userEmail)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO users (userName, userType, userPasswordHash, userEmail) VALUES ('admin','Admin','$2y$10$Tf8KbXWg/y5.bOxrk9njXOC6HkYJ6pj3WRfNZ5XA5PEH3NK3mmOOK','admin@example.com');


DROP TABLE IF EXISTS categoryParent;
CREATE TABLE IF NOT EXISTS categoryParent (
  categoryParentId int UNSIGNED NOT NULL AUTO_INCREMENT,
  categoryParentType ENUM('Income','Expense') NOT NULL,
  categoryParentOrder int UNSIGNED NOT NULL,
  categoryParentName varchar(1000) NOT NULL,
  PRIMARY KEY (categoryParentId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO categoryParent (categoryParentId, categoryParentType, categoryParentOrder, categoryParentName) VALUES 
(1, 'Income', 1, 'Monthly Earned Income'),
(2, 'Income', 2, 'Monthly Retirement and Investment Income'),
(3, 'Income', 3, 'Monthly Other Income'),
(4, 'Expense', 1, 'Monthly Payroll Deductions'),
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
  categoryId int UNSIGNED NOT NULL AUTO_INCREMENT,
  categoryParentId int UNSIGNED NOT NULL,
  categoryOrder int UNSIGNED NOT NULL,
  categoryName varchar(1000) NOT NULL,
  categoryHoverToolTip varchar(1000),
  calculatorType ENUM('MonthlyWage','MonthlySE','NonMonthly'),
  PRIMARY KEY (categoryId),
  FOREIGN KEY (categoryParentId) references categoryParent(categoryParentId) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO category (categoryParentId, categoryOrder, categoryName, categoryHoverToolTip, calculatorType) VALUES
(1, 1, 'Wages from Employment', 'Enter monthly gross income from your primary job here, you can use the calculator to the right to help you estimate the amount.','MonthlyWage'),
(1, 2, 'Additional Wages from Employment (Part-time)', 'Enter monthly gross income from a secondary job you have here, you can use the calculator to the right to help you estimate the amount','MonthlySE'),
(1, 3, 'Income from Self-employment', 'Enter your estimate of monthly income from your own business here, use calculator if your income is not consistent month to month.','MonthlySE'),
(2, 1, 'Social Security or Railroad Retirement', 'Enter the amount you actually receive (Net amount) each month here, use estimates or averages if necessary.','NonMonthly'),
(2, 2, 'Pension Income', 'Enter the amount you actually receive (Net amount) each month here, use estimates or averages if necessary.','NonMonthly'),
(2, 3, 'Other Retirement (IRA, Annuity, etc.)', 'Enter the amount you actually receive (Net amount) each month here (Would be good to have a calculator that takes annual amount and derives monthly amount).','NonMonthly'),
(2, 4, 'Interest and Dividend Income', 'Enter the amount you actually receive (Net amount) each month here (Would be good to have a calculator that takes annual amount and derives monthly amount).','NonMonthly'),
(3, 1, 'Alimony Received', 'Enter the amount you actually receive each month here, use estimates or averages if necessary.','NonMonthly'),
(3, 2, 'Child Support Received', 'Enter the amount you actually receive each month here, use estimates or averages if necessary','NonMonthly'),
(3, 3, 'Social Security Disability (SSDI)', 'Enter the amount you actually receive (Net amount) each month here, use estimates or averages if necessary.','NonMonthly'),
(3, 4, 'Supplemental Security Income (SSI)', 'Enter the amount you actually receive (Net amount) each month here, use estimates or averages if necessary.','NonMonthly'),
(3, 5, 'Federal and State tax refund', 'Enter the total of your typical refund from both federal and state into calculator to estimate the monthly income that your refund should create. Enter 0 if you dont get a refund.','NonMonthly'),
(3, 6, 'Public Housing (Subsidized portion)', 'Enter the amount you actually receive (Net amount) each month here, use estimates or averages if necessary.','NonMonthly'),
(3, 7, 'Food Stamps', 'Enter the amount you actually receive (Net amount) each month here, use estimates or averages if necessary.','NonMonthly'),
(3, 8, 'Financial (FEP or General Assistance)', 'Enter the amount you actually receive (Net amount) each month here, use estimates or averages if necessary.','NonMonthly'),
(3, 9, 'State Childcare Assistance', 'Enter the amount you actually receive (Net amount) each month here, use estimates or averages if necessary.','NonMonthly'),
(3, 10, 'Internships with Stipend (Work study, Easter Seals, etc.)', 'Enter the amount you actually receive (Net amount) each month here, use estimates or averages if necessary.','NonMonthly'),
(3, 11, 'Other cash assistance (Training funds)', 'Enter the amount you actually receive (Net amount) each month here, use estimates or averages if necessary.','NonMonthly'),
(4, 1, 'Federal withholding', 'Enter the amount that your employer withheld from your pay for the month to pay your federal taxes here. Take all of your paystubs for the month and add the amounts together.','NonMonthly'),
(4, 2, 'State withholding', 'Enter the amount that your employer withheld from your pay for the month to pay your state taxes here. Take all of your paystubs for the month and add the amounts together.','NonMonthly'),
(4, 3, 'Social Security and Medicare (FICA) taxes', 'Enter the amount that your employer withheld from your pay for the month to pay your social security and Medicare taxes here. Sometimes these are combined and are labeled FICA.  Take all of your paystubs for the month and add the amounts together.','NonMonthly'),
(4, 4, 'Health insurance', 'Enter the amount you pay for health insurance each month. Take all of your paystubs for the month and add the amounts together.','NonMonthly'),
(4, 5, 'Dental insurance', 'Enter the amount you pay for dental insurance each month. Take all of your paystubs for the month and add the amounts together.','NonMonthly'),
(4, 6, 'Vision insurance', 'Enter the amount you pay for vision insurance each month. Take all of your paystubs for the month and add the amounts together.','NonMonthly'),
(4, 7, 'Retirement (401K, 403B, etc.)', 'Enter the amount you contribute to your retirement each month. Take all of your paystubs for the month and add the amounts together.','NonMonthly'),
(4, 8, 'Medical Savings (FSA or HSA)', 'Enter the amount you have deducted from your check to be put into your medical savings plan (FSA or HAS) each month. Take all of your paystubs for the month and add the amounts together.','NonMonthly'),
(4, 9, 'Garnishments (Child support, collections, taxes)', 'Enter the amount that is deducted from your paycheck each month, Take all of your paystubs for the month and add the amounts for any of these deductions all together.','NonMonthly'),
(5, 1, 'Rent payment', 'Enter the amount you pay for rent each month.','NonMonthly'),
(5, 2, '1st mortgage payment', 'Enter your monthly payment for your first mortgage, include property taxes and insurance if they are included in your monthly mortgage payment.','NonMonthly'),
(5, 3, '2nd mortgage payment', 'Enter your monthly payment for a second mortgage or home equity line of credit (HELOC) here. ','NonMonthly'),
(5, 4, 'Property taxes', 'Enter the amount you pay for property taxes each month here. If you pay your property taxes with your mortgage payment enter zero here. Use the calculator if you pay this once a year.','NonMonthly'),
(5, 5, 'Homeowner and Renter''s Insurance', 'Enter the amount you pay monthly for homeowner or renters insurance here. If you pay your homeowners insurance with your mortgage payment enter zero here. Use the calculator if you pay this once a year.','NonMonthly'),
(5, 6, 'Repairs, improvements, and maintenance', 'Enter the amount you usually pay for repairs a month, or use the calculator to estimate the amount you typically spend in a year. Also include any homeowner association fees here.','NonMonthly'),
(5, 7, 'Power (Electricity)', 'If you are using equal pay for your bill, enter the amount you pay each month here. If not, enter an estimate of what you typically pay each month.','NonMonthly'),
(5, 8, 'Heat', 'If you are using equal pay for your bill, enter the amount you pay each month here. If not, enter an estimate of what you typically pay each month.','NonMonthly'),
(5, 9, 'Garbage (Sewer)', 'Enter how much you typically pay each month for this expense.','NonMonthly'),
(5, 10, 'Water', 'Enter how much you typically pay each month for this expense.','NonMonthly'),
(5, 11, 'Garbage', 'Enter how much you typically pay each month for this expense.','NonMonthly'),
(5, 12, 'Phone (Home)', 'Enter how much you typically pay each month for this expense.','NonMonthly'),
(5, 13, 'Phone (Mobile)', 'Enter how much you typically pay each month for this expense.','NonMonthly'),
(5, 14, 'Internet', 'Enter how much you typically pay each month for this expense.','NonMonthly'),
(5, 15, 'Other housing costs', 'Enter the estimate of monthly costs for other shelter costs not included above here.','NonMonthly'),
(6, 1, 'Bus pass', 'Enter how much you typically pay each month for this expense','NonMonthly'),
(6, 2, 'Auto loan', 'Enter your monthly payment for the car you drive','NonMonthly'),
(6, 3, 'Auto insurance', 'Enter the amount you pay each month for auto insurance. If you have more than one car and you dont know how much is for each vehicle just put the total in the first field','NonMonthly'),
(6, 4, 'Auto fuel (Gas)', 'Enter how much you typically pay each month for this expense','NonMonthly'),
(6, 5, 'Registration (Property taxes)', 'Estimate how much you typically pay for registering your car each year and then use the calculator to enter an annual estimate for this expense.','NonMonthly'),
(6, 6, 'Routine maintenance', 'Estimate how much you anticipate you will pay for oil changes, tires, brakes, car washes, and other minor repairs for the year and use the use the calculator to enter either a monthly or annual estimate.','NonMonthly'),
(6, 7, 'Major repairs', 'Estimate how much you anticipate you will pay for major auto repairs that are unplanned and typically more expenses than normal maintenance.  The older the vehicle is the more you should plan to pay each year.  Use the calculator tool to enter either a monthly or annual estimate.','NonMonthly'),
(6, 8, 'Other transportation costs', 'Enter the estimate of monthly costs for other transportation costs not included above here.','NonMonthly'),
(7, 1, 'Health insurance from payroll deductions', 'If you entered payroll deductions earlier, the monthly amount should appear here. If you pay for insurance on your own, use the next field to enter your monthly premium.','NonMonthly'),
(7, 2, 'Health insurance, I pay on my own', 'Enter the amount you pay each month for health insurance.  Do not include amounts taken out of your paycheck.','NonMonthly'),
(7, 3, 'Dental insurance from payroll deductions', 'If you entered payroll deductions earlier, the monthly amount should appear here. If you pay for insurance on your own, use the next field to enter your monthly premium.','NonMonthly'),
(7, 4, 'Dental insurance, I pay on my own', 'Enter the amount you pay each month for dental insurance.  Do not include amounts taken out of your paycheck.','NonMonthly'),
(7, 5, 'Vision insurance from payroll deductions', 'If you entered payroll deductions earlier, the monthly amount should appear here. If you pay for insurance on your own, use the next field to enter your monthly premium.','NonMonthly'),
(7, 6, 'Vision insurance, I pay on my own', 'Enter the amount you pay each month for vision insurance.  Do not include amounts taken out of your paycheck.','NonMonthly'),
(7, 7, 'Life Insurance', 'Enter your estimate of how much you pay each month for life insurance per month here.','NonMonthly'),
(7, 8, 'Prescriptions', 'Enter your estimate of how much you spend on prescriptions per month here.  Use the calculator tool to enter either a monthly or annual estimate.','NonMonthly'),
(7, 9, 'Co-Pays (Doctor, dentists, hospitals, specialists, etc.)', 'Enter your estimate of how much you spend on co-pays at doctors, the dentist, and other medical visits per month here. Use the calculator tool to enter either a monthly or annual estimate.','NonMonthly'),
(7, 10, 'Other medical expenses', 'Enter the estimate of monthly costs for other medical costs not included above here.','NonMonthly'),
(8, 1, 'Food – Groceries', 'Enter your estimate of how much you typically spend on food at the grocery store per month here. Eating out will be included in the "Personal Lifestyle" section.','NonMonthly'),
(8, 2, 'Household goods (Cleaning supplies, toilet paper, etc.)', 'Enter your estimate of how much you typically spend on household goods, nonfood items, at the grocery or department stores per month here. Items purchased for recreation or entertainment should be entered in the "Personal Lifestyle" section.','NonMonthly'),
(8, 3, 'Clothing and uniforms', 'Enter your estimate of how much you typically spend on clothing household goods per month here. Use the calculator tool to enter either a monthly or annual estimate.','NonMonthly'),
(8, 4, 'Personal Items (Soaps, lotions, deodorant, haircuts, etc.)', 'Enter your estimate of how much you typically spend on personal items per month here.','NonMonthly'),
(8, 5, 'Other general shopping expenses', 'Enter the estimate of monthly costs for other shopping costs not included above here.','NonMonthly'),
(9, 1, 'Emergency', 'An emergency fund is used to plan for unexpected expenses that come in the future. Enter how much you transfer to your emergency fund each month.  Use the calculator tool to enter either a monthly or annual estimate.','NonMonthly'),
(9, 2, 'Revolving', 'A revolving savings account is a separate account that we transfer funds into that then is used to pay for expenses that dont happen every month (like birthdays, holidays, vacation, car registration, etc.) Enter how much you transfer to your revolving fund each month. Use the calculator tool to enter either a monthly or annual estimate.','NonMonthly'),
(9, 3, 'Medical savings (FSA or HSA) ', 'This amount should come from the payroll deductions.','NonMonthly'),
(9, 4, 'Education', 'Enter how much you transfer to your savings for education each month here.  Use the calculator tool to enter either a monthly or annual estimate.','NonMonthly'),
(9, 5, 'Retirement (401K, 403B, IRA, etc.)', 'If you entered a payroll deduction for retirement savings previously it should appear here. If you contribute outside of your employer, enter the amount you save per month in "Other Savings and Investing" below. Use the calculator tool to enter either a monthly or annual estimate.','NonMonthly'),
(9, 6, 'Investments (Stocks, bonds, mutual funds, etc.)', 'Enter how much you have invested each month here. Use the calculator tool to enter either a monthly or annual estimate.','NonMonthly'),
(9, 7, 'Other savings and investing', 'Enter the estimate of monthly costs for other savings and investment contributions not included above here.','NonMonthly'),
(10, 1, 'Credit Card, store accounts, or other revolving debt', 'Enter the total amount currently paid monthly to all credit cards, store accounts, and other types of revolving debt (accounts that provide you with a line of available credit) per month here.','NonMonthly'),
(10, 2, 'Other installment loans (not mortgage or auto)', 'Enter the total amount paid monthly for all installment loans (Loans with a fixed monthly payment, interest rate, and length of time) per month here. Auto loans should be entered in "Transportation" and home mortgages should be entered in "Shelter Costs"','NonMonthly'),
(10, 3, 'Line-of-credit / Home equity', 'Enter the total amount paid for a line-of-credit on a checking account and or any payments made on a home equity loan here.','NonMonthly'),
(10, 4, 'Student loans', 'Enter the total amount paid monthly for all student loans here.','NonMonthly'),
(10, 5, 'Payday or title loans', 'Enter the total amount paid monthly for all payday and title loans (including pawn shops) here.','NonMonthly'),
(10, 6, 'Collections and Judgements', 'Enter the total amount paid monthly for all collections and judgements here.','NonMonthly'),
(10, 7, 'Legal obligations (Alimony, child support, back taxes, etc.)', 'Enter the total amount paid monthly for legal obligations (including past due alimony or child support, back taxes, restitution, etc.) here.','NonMonthly'),
(10, 8, 'Other debt', 'Enter the estimate of monthly costs for other debt amounts not included above here.','NonMonthly'),
(11, 1, 'Cash donations to nonprofits', 'Enter the estimate of total amount donated monthly to nonprofits (Boys & Girls Club, Boy Scouts of America, homeless shelters, food pantries, etc.) here.','NonMonthly'),
(11, 2, 'Cash donations to churches (Tithing)', 'Enter the estimate of total amount donated monthly to religious organizations here.  Use the calculator tool to enter either a monthly or annual estimate. ','NonMonthly'),
(11, 3, 'Other cash donations', 'Enter the estimate of monthly costs for other charitable donations not included above here.','NonMonthly'),
(12, 1, 'Eating out, date nights, etc.', 'Enter how much you typically spend monthly for nights out of the house here.','NonMonthly'),
(12, 2, 'Recreation & hobbies (Sports, clubs, etc.)', 'Enter how much you typically spend monthly for recreational opportunities (including sports, clubs, crafts, etc.) here. Use the calculator tool to enter either a monthly or annual estimate. ','NonMonthly'),
(12, 3, 'Holidays, gifts, special occasions', 'Enter how much you typically spend monthly for special occasions (gift giving) here. Use the calculator tool to enter either a monthly or annual estimate. ','NonMonthly'),
(12, 4, 'Personal habits (Coffee, pop, snacks, tobacco, alcohol, etc.)', 'Enter how much you typically spend monthly for your daily habits here.','NonMonthly'),
(12, 5, 'Cable, satellite, other subscriptions', 'Enter how much you pay for additional T.V. services like cable or satellite services per month here.  ','NonMonthly'),
(12, 6, 'Vacation and family traditions', 'Enter how much you typically spend monthly for vacations and other family traditions here. Use the calculator tool to enter either a monthly or annual estimate. ','NonMonthly'),
(12, 7, 'Physical fitness (Memberships, fees, registration)', 'Enter how much you spend monthly for physical fitness costs here. Use the calculator tool to enter either a monthly or annual estimate. ','NonMonthly'),
(12, 8, 'Pet expenses (Food, vets, etc.)', 'Enter how much you typically spend monthly on family pets here. Use the calculator tool to enter either a monthly or annual estimate. ','NonMonthly'),
(12, 9, 'Childcare (Pre-school or daycare)', 'Enter how much you typically spend monthly on childcare (include pre-school, daycare, or day camps) here. Use the calculator tool to enter either a monthly or annual estimate. ','NonMonthly'),
(12, 10, 'Educational expenses', 'Enter how much you typically spend monthly on education (include tuition, books, online courses, etc.) here. Use the calculator tool to enter either a monthly or annual estimate. ','NonMonthly'),
(12, 11, 'Child support and alimony', 'Enter the total amount paid monthly for child support and alimony (do not include past due payments made to ORS) here.','NonMonthly'),
(12, 12, 'Federal and State taxes withheld from wages', 'This amount should come from the payroll deductions.','NonMonthly'),
(12, 13, 'Other personal lifestyle expenses', 'Enter the estimate of monthly costs for other lifestyle and other costs not included above here.','NonMonthly');


DROP TABLE IF EXISTS budget;
CREATE TABLE budget (
    budgetId int UNSIGNED NOT NULL AUTO_INCREMENT,
    userId int UNSIGNED NOT NULL,
    budgetName varchar(64),
    isBaseline boolean DEFAULT FALSE,
    dateCreated DATETIME NOT NULL,
    dateUpdated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (budgetId),
    FOREIGN KEY (userId) references users(userId) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS budgetDetail;
CREATE TABLE budgetDetail (
    budgetDetailId int UNSIGNED  NOT NULL AUTO_INCREMENT,
    budgetId int UNSIGNED NOT NULL,
    categoryId int UNSIGNED NOT NULL,
    budgetSelfAmount int,
    budgetSpouseAmount int,
    actualAmount int,
    dateUpdated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (budgetDetailId),
    FOREIGN KEY (budgetId) references budget(budgetId) on delete cascade,
    FOREIGN KEY (categoryId) references category(categoryId) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


