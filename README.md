# pelinshop_upgraded

## Run project locally

From the project root, start the PHP built-in server:

```bash
php -S localhost:8000
```

Then open:

```text
http://localhost:8000/order.php
```

## Run so other devices can access your machine

If you want to bind the server to your real machine IP / all interfaces, run:

```bash
php -S 0.0.0.0:8000
```

Then open from your browser:

```text
http://localhost:8000/order.php
```

Or from another device on the same network:

```text
http://YOUR_COMPUTER_IP:8000/order.php
```

## Important

Using `php -S` only starts the PHP web server. Your pages like `order.php` still need a working database connection from `setup.php`.
