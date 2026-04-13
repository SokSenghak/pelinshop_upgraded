<?php

/**
 * File:        database.class.php
 *
 * Database connection library - Updated for PHP 8.x
 *
 * @copyright 2009 E-KHMER.
 * @author Sengtha Chay <sengtha@e-khmer.com>
 * @version 0.2
 */
class database
{
    public bool $debug = false;
    public ?PDO $_Link = null;
    public ?PDO $_Connect = null;
    public ?string $lastError = null;

    public function __construct(string $hostname, string $user, string $password, string $dbname)
    {
        try {
            $this->_Connect = new PDO(
                "mysql:host=$hostname;dbname=$dbname;charset=utf8",
                $user,
                $password,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                ]
            );
            $this->_Link = $this->_Connect;
        } catch (PDOException $e) {
            $this->lastError = $e->getMessage();
            if ($this->debug) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    public function close(): void
    {
        $this->_Connect = null;
        $this->_Link    = null;
    }
}
