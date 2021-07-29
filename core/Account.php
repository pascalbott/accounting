<?php
namespace Accounting\Core;

use Accounting\Interfaces\AccountInterface;
use Database\Core\Database as DB;
use Database\Exceptions\InvalidColumnException;
use Database\Exceptions\InvalidTableException;

class Account implements AccountInterface
{
    public static string $ACCOUNT_TABLE_NAME = 'account';

    /**
     * @param array $account
     * @return int
     * @throws InvalidColumnException
     * @throws InvalidTableException
     */
    public static function addAccount(array $account): int
    {
        return DB::insert(self::$ACCOUNT_TABLE_NAME, $account);
    }

    /**
     * @param int $accountNumber
     */
    public static function delAccount(int $accountNumber)
    {
        DB::delete('DELETE FROM ' . self::$ACCOUNT_TABLE_NAME . ' WHERE accountName = ?', array($accountNumber));
    }

    /**
     * @param int $accountNumber
     * @return array|null
     */
    public static function getAccount(int $accountNumber): ?array
    {
        return DB::fetch('SELECT * FROM ' . self::$ACCOUNT_TABLE_NAME . ' WHERE accountNumber = ?', array($accountNumber));
    }

    /**
     * @param string $accountName
     * @return array|null
     */
    public static function getAccountByName(string $accountName): ?array
    {
        return DB::fetch('SELECT * FROM ' . self::$ACCOUNT_TABLE_NAME . ' WHERE accountName = ?', array($accountName));
    }

    /**
     * @param int $from
     * @param int $to
     * @return array|null
     */
    public static function getAccountsBySection(int $from, int $to): ?array
    {
        return DB::fetchAll('SELECT * FROM ' . self::$ACCOUNT_TABLE_NAME . ' WHERE section >= ? AND section <= ?', array($from, $to));
    }

    /**
     * @param string $type
     * @return array|null
     */
    public static function getAccountsByType(string $type): ?array
    {
        return DB::fetchAll('SELECT * FROM ' . self::$ACCOUNT_TABLE_NAME . ' WHERE type = ?', array($type));
    }
}