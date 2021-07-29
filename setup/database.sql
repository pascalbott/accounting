CREATE TABLE IF NOT EXISTS account (
    accountId INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    accountNumber INT(4) NOT NULL UNIQUE,
    accountName VARCHAR(255) NOT NULL,
    section INT(3) NOT NULL,
    type ENUM('assetAccount', 'liabilityAccount', 'expenseAccount', 'incomeAccount') NOT NULL
);

CREATE TABLE IF NOT EXISTS ledger (
    ledgerId INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
    companyId INT(3) NOT NULL,
    reference VARCHAR(100) NOT NULL,
    should INT(4) NOT NULL,
    have INT(4) NOT NULL,
    description VARCHAR(100) NOT NULL,
    amount FLOAT,
    valuta DATETIME,
    updatedOn TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (should) REFERENCES account(accountNumber),
    FOREIGN KEY (have) REFERENCES account(accountNumber)
);