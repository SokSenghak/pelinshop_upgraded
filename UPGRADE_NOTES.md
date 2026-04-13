# PelinShop — PHP 8.x Upgrade Notes

## PHP Version Compatibility
- **Tested against:** PHP 8.3.6 (all 746 PHP files pass `php -l` syntax check)
- **Minimum required:** PHP 8.0
- **Recommended:** PHP 8.1 or 8.2/8.3
- **Smarty:** 4.1.0 (bundled, PHP 8 compatible)

---

## Files Changed

### `setup.php`
- Added missing `$index_file` and `$index_file_name` variables that were used in `order.php` and `admin.php` but never defined
- Added `setCaching(CACHING_OFF)` and `setCompileCheck(true)` to `SHOP_SMARTY` for correct PHP 8 + Smarty 4 behavior

### `admin_setting.php`
- All `$_GET` accesses now use `!empty()` guards (PHP 8 strict typing)
- Pagination URL regex improved
- Removed reference assignment `=&` for `$connected` (not needed with PDO)

### `order.php`
- All `$_POST`/`$_GET` accesses use null coalescing (`?? ''`) to prevent PHP 8 undefined warnings
- `and` keyword → `&&`
- Fixed `$common->find('customer', [''], 'all')` → `null` (legacy empty-condition calls)
- Session vars guarded with null coalescing

### `new_order.php`
- Same fixes as `order.php`

### `internal_libs/database.class.php`
- **Removed** dead `mysql_close()` call (mysql extension removed in PHP 7+)
- Typed properties: `public bool`, `public ?PDO`
- Charset now set via DSN `charset=utf8` + `MYSQL_ATTR_INIT_COMMAND` (more reliable)
- `PDO::ATTR_DEFAULT_FETCH_MODE` set to `PDO::FETCH_ASSOC` globally

### `internal_libs/common.class.php`
- **PHP4-style constructor** `function common(){}` → `public function __construct()`
- Full PHP 8 union type hints and return types added
- **Critical bug fixed:** `update()` method had PDO parameter key collision between SET columns and WHERE condition. Fixed by prefixing condition params as `:cond_{key}`
- `find()` safely handles legacy calls passing `['']` as condition (filters empty string keys)

### `internal_libs/smartyml.class.php`
- **PHP4-style constructor** `function ngLanguage($locale)` → `public function __construct()`
- `chop()` → `rtrim()` (canonical function name)
- Typed properties and return types
- Safe `$_SERVER["HTTP_ACCEPT_LANGUAGE"]` access with null coalescing

### `external_libs/smarty-4.1.0/libs/SmartyPaginate.class.php`
- **PHP4-style constructor** `function SmartyPaginate()` → `public function __construct()`
- All methods given explicit `static` + `public` visibility modifiers
- Full PHP 8 type hints on all method signatures

### `external_libs/thumbnail.php`
- `var $` properties → typed `public` properties
- PHP4-style methods → typed `public` methods
- Removed dead `PHP_VERSION >= '5.1.2'` check (always true on PHP 8)
- `list()` → array destructuring
- `GetImageSize()` → `getimagesize()` with `false` return check
- Added `imagedestroy()` calls to prevent GD memory leaks
- `tempnam("tmp/")` → `tempnam(sys_get_temp_dir())`
- `str_starts_with()` for URL detection (PHP 8 native)

### `product_duplicate.php` & `remove_product_duplicate.php`
- `__DIR__` instead of hardcoded path strings
- Proper typed functions and PDO fetch modes

### `phpinfo.php`
- **Disabled** `phpinfo()` for security — this file exposed full server configuration

---

## Deployment Checklist

1. **Update database credentials** in `setup.php`:
   - `DB_HOSTNAME`, `DB_USER`, `DB_PASSWORD`, `DB_DATABASE_NAME`

2. **Update `PRODUCT_IMAGE_PATH`** in `setup.php` to match your server's absolute path

3. **Ensure write permissions** on:
   - `designs/templates_c/` (Smarty compiles templates here)
   - `designs/cache/` (Smarty cache)
   - `images/product/` (product image uploads)

4. **PHP 8 extensions required:**
   - `pdo_mysql`
   - `gd` (for thumbnail generation)
   - `curl`
   - `mbstring`
   - `session`

5. **Delete or restrict access to:**
   - `phpinfo.php` (already disabled but consider removing)
   - `sql.txt` (blocked via .htaccess)
   - `deployment-config.json` (blocked via .htaccess)
   - `quickstart.html`

6. Set `$debug = false;` in `setup.php` on production (already set)

---

## Known Limitations

- Smarty 4.1.0 is bundled. Consider upgrading to Smarty 4.5.x or 5.x for the latest PHP 8.3 optimizations. Bundled version passes all syntax checks.
- Password storage uses MD5 hashing — consider upgrading to `password_hash()` / `password_verify()` for new projects.
