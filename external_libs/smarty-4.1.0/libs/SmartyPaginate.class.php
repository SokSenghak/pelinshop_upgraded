<?php

/**
 * Project:     SmartyPaginate: Pagination for the Smarty Template Engine
 * File:        SmartyPaginate.class.php
 *
 * Updated for PHP 8.x compatibility — old-style constructor replaced with __construct,
 * static method calls retained (class is used statically throughout the app).
 *
 * @link http://www.phpinsider.com/php/code/SmartyPaginate/
 * @copyright 2001-2005 New Digital Group, Inc.
 * @author Monte Ohrt <monte at newdigitalgroup dot com>
 * @package SmartyPaginate
 * @version 1.7
 */

class SmartyPaginate
{
    /**
     * Class Constructor – PHP 8 compatible
     */
    public function __construct() {}

    public static function connect(string $id = 'default', ?array $formvar = null): void
    {
        if (!isset($_SESSION['SmartyPaginate'][$id])) {
            self::reset($id);
        }
        $_formvar = $formvar ?? $_GET;
        $_total   = self::getTotal($id);
        $urlVar   = self::getUrlVar($id);
        if (
            isset($_formvar[$urlVar]) &&
            $_formvar[$urlVar] > 0 &&
            (!isset($_total) || $_formvar[$urlVar] <= $_total)
        ) {
            $_SESSION['SmartyPaginate'][$id]['current_item'] = $_formvar[$_SESSION['SmartyPaginate'][$id]['urlvar']];
        }
    }

    public static function isConnected(string $id = 'default'): bool
    {
        return isset($_SESSION['SmartyPaginate'][$id]);
    }

    public static function reset(string $id = 'default'): void
    {
        $_SESSION['SmartyPaginate'][$id] = [
            'item_limit'   => 10,
            'item_total'   => null,
            'current_item' => 1,
            'urlvar'       => 'next',
            'url'          => $_SERVER['PHP_SELF'],
            'prev_text'    => 'prev',
            'next_text'    => 'next',
            'first_text'   => 'first',
            'last_text'    => 'last',
        ];
    }

    public static function disconnect(?string $id = null): void
    {
        if (isset($id)) {
            unset($_SESSION['SmartyPaginate'][$id]);
        } else {
            unset($_SESSION['SmartyPaginate']);
        }
    }

    public static function setLimit(int $limit, string $id = 'default'): bool
    {
        if (!preg_match('!^\d+$!', (string)$limit)) {
            trigger_error('SmartyPaginate setLimit: limit must be an integer.');
            return false;
        }
        if ($limit < 1) {
            trigger_error('SmartyPaginate setLimit: limit must be greater than zero.');
            return false;
        }
        $_SESSION['SmartyPaginate'][$id]['item_limit'] = $limit;
        return true;
    }

    public static function getLimit(string $id = 'default'): int
    {
        return $_SESSION['SmartyPaginate'][$id]['item_limit'] ?? 10;
    }

    public static function setTotal(int $total, string $id = 'default'): bool
    {
        if (!preg_match('!^\d+$!', (string)$total)) {
            trigger_error('SmartyPaginate setTotal: total must be an integer.');
            return false;
        }
        if ($total < 0) {
            trigger_error('SmartyPaginate setTotal: total must be positive.');
            return false;
        }
        $_SESSION['SmartyPaginate'][$id]['item_total'] = $total;
        return true;
    }

    public static function getTotal(string $id = 'default'): ?int
    {
        return $_SESSION['SmartyPaginate'][$id]['item_total'] ?? null;
    }

    public static function setUrl(string $url, string $id = 'default'): void
    {
        $_SESSION['SmartyPaginate'][$id]['url'] = $url;
    }

    public static function getUrl(string $id = 'default'): string
    {
        return $_SESSION['SmartyPaginate'][$id]['url'] ?? $_SERVER['PHP_SELF'];
    }

    public static function setUrlVar(string $urlvar, string $id = 'default'): void
    {
        $_SESSION['SmartyPaginate'][$id]['urlvar'] = $urlvar;
    }

    public static function getUrlVar(string $id = 'default'): string
    {
        return $_SESSION['SmartyPaginate'][$id]['urlvar'] ?? 'next';
    }

    public static function setCurrentItem(int $item, string $id = 'default'): void
    {
        $_SESSION['SmartyPaginate'][$id]['current_item'] = $item;
    }

    public static function getCurrentItem(string $id = 'default'): int
    {
        return $_SESSION['SmartyPaginate'][$id]['current_item'] ?? 1;
    }

    public static function getCurrentIndex(string $id = 'default'): int
    {
        return self::getCurrentItem($id) - 1;
    }

    public static function getLastItem(string $id = 'default'): int
    {
        $_total = self::getTotal($id);
        $_limit = self::getLimit($id);
        $_last  = self::getCurrentItem($id) + $_limit - 1;
        return ($_last <= $_total) ? $_last : (int)$_total;
    }

    public static function assign(object &$smarty, string $var = 'paginate', string $id = 'default'): bool
    {
        if (is_object($smarty) && (strtolower(get_class($smarty)) == 'smarty' || is_subclass_of($smarty, 'smarty'))) {
            $_paginate = [];
            $_paginate['total']        = self::getTotal($id);
            $_paginate['first']        = self::getCurrentItem($id);
            $_paginate['last']         = self::getLastItem($id);
            $_paginate['page_current'] = (int)ceil(self::getLastItem($id) / self::getLimit($id));
            $_paginate['page_total']   = (int)ceil((int)self::getTotal($id) / self::getLimit($id));
            $_paginate['size']         = $_paginate['last'] - $_paginate['first'];
            $_paginate['url']          = self::getUrl($id);
            $_paginate['urlvar']       = self::getUrlVar($id);
            $_paginate['current_item'] = self::getCurrentItem($id);
            $_paginate['prev_text']    = self::getPrevText($id);
            $_paginate['next_text']    = self::getNextText($id);
            $_paginate['limit']        = self::getLimit($id);

            $_item = 1;
            $_page = 1;
            while ($_item <= (int)$_paginate['total']) {
                $_paginate['page'][$_page]['number']     = $_page;
                $_paginate['page'][$_page]['item_start'] = $_item;
                $_paginate['page'][$_page]['item_end']   = ($_item + $_paginate['limit'] - 1 <= $_paginate['total'])
                    ? $_item + $_paginate['limit'] - 1
                    : $_paginate['total'];
                $_paginate['page'][$_page]['is_current'] = ($_item == $_paginate['current_item']);
                $_item += $_paginate['limit'];
                $_page++;
            }
            $smarty->assign($var, $_paginate);
            return true;
        }
        trigger_error("SmartyPaginate: [assign] I need a valid Smarty object.");
        return false;
    }

    public static function setPrevText(string $text, string $id = 'default'): void
    {
        $_SESSION['SmartyPaginate'][$id]['prev_text'] = $text;
    }

    public static function getPrevText(string $id = 'default'): string
    {
        return $_SESSION['SmartyPaginate'][$id]['prev_text'] ?? 'prev';
    }

    public static function setNextText(string $text, string $id = 'default'): void
    {
        $_SESSION['SmartyPaginate'][$id]['next_text'] = $text;
    }

    public static function getNextText(string $id = 'default'): string
    {
        return $_SESSION['SmartyPaginate'][$id]['next_text'] ?? 'next';
    }

    public static function setFirstText(string $text, string $id = 'default'): void
    {
        $_SESSION['SmartyPaginate'][$id]['first_text'] = $text;
    }

    public static function getFirstText(string $id = 'default'): string
    {
        return $_SESSION['SmartyPaginate'][$id]['first_text'] ?? 'first';
    }

    public static function setLastText(string $text, string $id = 'default'): void
    {
        $_SESSION['SmartyPaginate'][$id]['last_text'] = $text;
    }

    public static function getLastText(string $id = 'default'): string
    {
        return $_SESSION['SmartyPaginate'][$id]['last_text'] ?? 'last';
    }

    public static function setPageLimit(int $limit, string $id = 'default'): bool
    {
        if (!preg_match('!^\d+$!', (string)$limit)) {
            trigger_error('SmartyPaginate setPageLimit: limit must be an integer.');
            return false;
        }
        if ($limit < 1) {
            trigger_error('SmartyPaginate setPageLimit: limit must be greater than zero.');
            return false;
        }
        $_SESSION['SmartyPaginate'][$id]['page_limit'] = $limit;
        return true;
    }

    public static function getPageLimit(string $id = 'default'): ?int
    {
        return $_SESSION['SmartyPaginate'][$id]['page_limit'] ?? null;
    }

    public static function _getPrevPageItem(string $id = 'default'): int|false
    {
        $_prev_item = $_SESSION['SmartyPaginate'][$id]['current_item'] - $_SESSION['SmartyPaginate'][$id]['item_limit'];
        return ($_prev_item > 0) ? $_prev_item : false;
    }

    public static function _getNextPageItem(string $id = 'default'): int|false
    {
        $_next_item = $_SESSION['SmartyPaginate'][$id]['current_item'] + $_SESSION['SmartyPaginate'][$id]['item_limit'];
        return ($_next_item <= $_SESSION['SmartyPaginate'][$id]['item_total']) ? $_next_item : false;
    }
}
