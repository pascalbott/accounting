<?php
namespace Accounting\Interfaces;

interface AccountInterface
{
    public static function addAccount(array $account): int;
    public static function delAccount(int $accountNumber);
    public static function getAccount(int $accountNumber): ?array;
    public static function getAccountByName(string $accountName): ?array;
    public static function getAccountsBySection(int $from, int $to): ?array;
    public static function getAccountsByType(string $type): ?array;
}