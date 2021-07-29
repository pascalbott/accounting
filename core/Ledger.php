<?php
namespace Accounting\Core;

use Accounting\Interfaces\LedgerInterface;
use Database\Core\Database as DB;
use Database\Exceptions\InvalidColumnException;
use Database\Exceptions\InvalidTableException;

class Ledger extends Account implements LedgerInterface
{
    public static string $LEDGER_TABLE_NAME = 'ledger';

    /**
     * @param array $record
     * @return int
     * @throws InvalidColumnException
     * @throws InvalidTableException
     */
    public static function addRecord(array $record): int
    {
        return DB::insert(self::$LEDGER_TABLE_NAME, $record);
    }

    /**
     * @param int $ledgerId
     * @return array|null
     */
    public static function getRecord(int $ledgerId): ?array
    {
        return DB::fetch('SELECT * FROM ' . self::$LEDGER_TABLE_NAME . ' WHERE ledgerId = ?', array($ledgerId));
    }
}