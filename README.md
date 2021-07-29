# Double entry accounting system
A simple accounting library with general ledger and account plan for Switzerland (can be customized on individual needs) written in PHP

## Installation
Use the package manager [composer](https://getcomposer.org) to install the library
```bash
composer require pascalbott/accounting
```

## Quick Start
Import vendor/autoload.php and define database settings somewhere in your project.
For more information about the database [here](https://github.com/pascalbott/pdo-database)

```php
<?php
require_once 'vendor/autoload.php';

use Accounting\Core\Ledger;

define('DB_HOST', 'db_host');
define('DB_NAME', 'db_name');
define('DB_USERNAME', 'db_username');
define('DB_PASSWORD', 'db_password');
```

Setup the account table with following minimum columns:
```sql
CREATE TABLE IF NOT EXISTS ledger (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
    accountId INT(4) NOT NULL,
    account VARCHAR(100) NOT NULL,
    section INT(3) NOT NULL,
    type VARCHAR(40) NOT NULL
)
```

Setup the ledger table with following minimum columns:
```sql
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
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP
)
```

(Optional) Import [Swiss Account Plan](https://veb.ch/fileadmin/documents/publikationen/Kontenrahmen_KMU/20131119_Schulkontenrahmen_web.pdf) using our template

## Add new record
Simple create an associative arrays:
```php
$record = [
    'companyId' => 100,
    'reference' => 'RE2101000000',
    'should' => 1020,
    'have' => 3200,
    'description' => 'New invoice RE2101000000',
    'amount' => 21.20,
    'valuta' => '2021-07-28'
];

try {
    $ledgerId = Ledger::addRecord($record);
} catch (Exception $e) {
    echo 'Something went wrong';
}
```

## Get a record
Using ledgerId to get a record
```php
try {
    $record = Ledger::getRecord($ledgerId);
} catch (Exception $e) {
    echo 'Something went wrong';
}
```

## Add new account
You can add as many accounts as you want
```php
$newRecord = [
    'accountNumber' => '1020',
    'accountName' => 'Bank',
    'section' => 100,
    'type' => 'assetAccount'
];

try {
    $accountId = Ledger::addRecord($record);
} catch (Exception $e) {
    echo 'Something went wrong';
}
```

## Get account information
You can get information about the account either with the accountNumber or accountName
```php
try {
    $account = Ledger::getAccount(1020);
} catch (Exception $e) {
    echo 'Something went wrong';
}

try {
    $account = Ledger::getAccountByName('Bank');
} catch (Exception $e) {
    echo 'Something went wrong';
}
```

## Delete account
You can also delete an account as follow:
```php
try {
    Ledger::delAccount(1020);
} catch (Exception $e) {
    echo 'Something went wrong';
}
```