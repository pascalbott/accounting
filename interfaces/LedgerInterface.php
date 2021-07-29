<?php
namespace Accounting\Interfaces;

interface LedgerInterface
{
    public static function addRecord(array $record): int;
    public static function getRecord(int $ledgerId): ?array;
}