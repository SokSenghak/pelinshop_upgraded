<?php
/**
 * File:        common.class.php
 *
 * Shared library - Updated for PHP 8.x
 * @copyright 2015 E-KHMER Technology Co., Ltd.
 * @author Sengtha Chay <sengtha@gmail.com>
 * @version 0.2
 */

class common
{
    // PHP 8: Old-style constructors removed – use __construct
    public function __construct() {}

    public function clean_string(string $str): string
    {
        $str = strip_tags($str);
        $str = stripslashes($str);
        return $str;
    }

    public function sendMail(string $to, string $subject, string $body, string $from_email, string $from_name): bool
    {
        $headers  = "MIME-Version: 1.0\n";
        $headers .= "From: {$from_name}<{$from_email}>\n";
        $headers .= "Reply-To: {$from_name}<{$from_email}>\n";
        $headers .= "Content-Type: text/plain;charset=UTF-8\n";
        $sendmail_params = "-f$from_email";
        return mail($to, $subject, $body, $headers, $sendmail_params);
    }

    public function upload_file(array $file, string|int $id, string $path, string $formname, array $allows): string|int
    {
        $uploadfile = $path . $id . "__" . basename($file[$formname]['name']);
        $path_info  = pathinfo($uploadfile);
        if (!in_array($path_info['extension'], $allows["EXT"])) return 1;
        if ($file[$formname]['size'] > $allows["SIZE"][0])      return 2;
        if (move_uploaded_file($file[$formname]['tmp_name'], $uploadfile)) {
            chmod($uploadfile, 0755);
            return $id . "__" . basename($file[$formname]['name']);
        }
        return 0;
    }

    public function upload_image(array $file, string|int $id, string $path, string $formname, array $allows): string|int
    {
        $uploadfile = $path . $id . "__" . basename($file[$formname]['name']);
        if (move_uploaded_file($file[$formname]['tmp_name'], $uploadfile)) {
            chmod($uploadfile, 0755);
            return $id . "__" . basename($file[$formname]['name']);
        }
        return 0;
    }

    public function image_validator(array $file, string|int $id, string $path, string $formname, array $allows): ?int
    {
        $uploadfile = $path . $id . "__" . basename($file[$formname]['name']);
        $path_info  = pathinfo($uploadfile);
        if (!in_array($path_info['extension'], $allows["EXT"]))   return 1;
        if ($file[$formname]['size'] > $allows["SIZE"][0])        return 2;
        if ($file[$formname]['error'] > 0)                        return 3;
        if (file_exists($path . $file[$formname]['name']))        return 4;
        return null;
    }

    public function uploadFile(array $file, string|int $id, string $path, string $control_name): string|int
    {
        $upload_file = $path . $id . "__" . basename($file[$control_name]['name']);
        if (move_uploaded_file($file[$control_name]['tmp_name'], $upload_file)) {
            chmod($upload_file, 0755);
            return $id . "__" . basename($file[$control_name]['name']);
        }
        return 0;
    }

    public function num(float|int $num): string
    {
        return number_format($num, 2, '.', ',');
    }

    public function resolve_url(string $base, string $url, bool $use_query = false, bool $use_fragment = false): string
    {
        if (!$use_fragment) {
            $base = $this->unparse_url(parse_url($base), $use_query, $use_fragment);
            $url  = $this->unparse_url(parse_url($url),  $use_query, $use_fragment);
        }
        $__parts = parse_url($base);
        if ($__parts["scheme"] . "://" . $__parts["host"] == $base) {
            $base = $base . "/";
        }
        if (!strlen($base)) return $url;
        if (!strlen($url))  return $base;
        if (strstr($url, "http")) return $url;
        if (preg_match('!^[a-z]+:!i', $url)) return $url;
        $base = parse_url($base);
        if ($use_fragment) {
            if ($url[0] == "#") {
                $base['fragment'] = substr($url, 1);
                return $this->unparse_url($base, $use_query, $use_fragment);
            }
        }
        unset($base['fragment']);
        unset($base['query']);
        if (substr($url, 0, 2) == "//") {
            return $this->unparse_url(['scheme' => $base['scheme'], 'path' => substr($url, 2)], $use_query, $use_fragment);
        } elseif ($url[0] == "/") {
            $base['path'] = $url;
        } else {
            $path     = explode('/', $base['path']);
            $url_path = explode('/', $url);
            array_pop($path);
            $end = array_pop($url_path);
            foreach ($url_path as $segment) {
                if ($segment == '.') {
                } elseif ($segment == '..' && $path && $path[count($path) - 1] != '..') {
                    array_pop($path);
                } else {
                    $path[] = $segment;
                }
            }
            if ($end == '.') {
                $path[] = '';
            } elseif ($end == '..' && $path && $path[count($path) - 1] != '..') {
                $path[count($path) - 1] = '';
            } else {
                $path[] = $end;
            }
            $base['path'] = implode('/', $path);
        }
        return $this->unparse_url($base, $use_query, $use_fragment);
    }

    public function unparse_url(array|false $parsed, bool $use_query = false, bool $use_fragment = false): string|false
    {
        if (!is_array($parsed)) return false;
        $uri  = !empty($parsed['scheme']) ? $parsed['scheme'] . ':' . (strtolower($parsed['scheme']) == 'mailto' ? '' : '//') : '';
        $uri .= !empty($parsed['user'])   ? $parsed['user'] . (!empty($parsed['pass']) ? ':' . $parsed['pass'] : '') . '@' : '';
        $uri .= !empty($parsed['host'])   ? $parsed['host'] : '';
        $uri .= !empty($parsed['port'])   ? ':' . $parsed['port'] : '';
        $uri .= !empty($parsed['path'])   ? $parsed['path'] : '';
        if ($use_query)    $uri .= !empty($parsed['query'])    ? '?' . $parsed['query']    : '';
        if ($use_fragment) $uri .= !empty($parsed['fragment']) ? '#' . $parsed['fragment'] : '';
        return $uri;
    }

    public function get_remote_contents(string $url): string|false
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/120.0.0.0 Safari/537.36");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        $str = curl_exec($curl);
        curl_close($curl);
        return $str;
    }

    public function postData(string $url, array|string $data): string|false
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/120.0.0.0 Safari/537.36");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function is_valid_email(string $email): bool
    {
        return (bool) preg_match('/^[a-zA-Z0-9_\.\-]+@[A-Za-z0-9_\.\-]+\.[A-Za-z0-9_\.\-]+$/', $email);
    }

    public function is_valid_phone(string $phone): bool
    {
        return (bool) preg_match('/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{3,4}$/', $phone);
    }

    public function is_only_number(string $value): bool
    {
        return (bool) preg_match('/^[0-9]*$/', $value);
    }

    public function checkPassword(string $pwd): bool
    {
        if (strlen($pwd) < 8)                     return false;
        if (!preg_match("#[0-9]+#", $pwd))        return false;
        if (!preg_match("#[a-zA-Z]+#", $pwd))     return false;
        return true;
    }

    /**
     * Global Save function
     */
    public function save(string $table, array &$columns): string|false
    {
        global $connected;
        try {
            $sql = 'INSERT INTO ' . $table . '(' . implode(',', array_keys($columns)) . ')
                    VALUES(:' . implode(',:', array_keys($columns)) . ')';
            $stm = $connected->prepare($sql);
            if ($stm === false) throw new Exception('Error sql statement');
            foreach ($columns as $key => $value) {
                $stm->bindValue(':' . $key, $value, PDO::PARAM_STR);
            }
            $stm->execute();
            return $connected->lastInsertId();
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Global Update function
     */
    public function update(string $table, array &$columns, ?array $condition = null): bool
    {
        global $connected;
        try {
            $arr = [];
            foreach ($columns as $key => $value) {
                $arr[] = $key . ' = :' . $key;
            }
            $sql = 'UPDATE `' . $table . '` SET ' . implode(',', $arr);
            if ($condition !== null) {
                $where = [];
                foreach ($condition as $key => $value) {
                    $where[] = $key . ' = :cond_' . $key;
                }
                if (!empty($where)) {
                    $sql .= ' WHERE ' . implode(' AND ', $where);
                }
            }
            $stm = $connected->prepare($sql);
            foreach ($columns as $key => $value) {
                $stm->bindValue(':' . $key, $value, PDO::PARAM_STR);
            }
            if ($condition !== null) {
                foreach ($condition as $key => $value) {
                    $stm->bindValue(':cond_' . $key, $value, PDO::PARAM_STR);
                }
            }
            return $stm->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Global Delete function
     */
    public function delete(string $table_name = '', ?array $condition = null): bool
    {
        global $connected;
        try {
            if ($table_name === '') throw new Exception('Table name is required');
            $where = '';
            if ($condition !== null) {
                $arr_c = [];
                foreach ($condition as $key => $value) {
                    $arr_c[] = $key . '=:' . $key;
                }
                $where = ' WHERE ' . implode(' AND ', $arr_c);
            }
            $delete = $connected->prepare('DELETE FROM `' . $table_name . '` ' . $where);
            if ($delete === false) throw new Exception('Error Sql');
            if ($condition !== null) {
                foreach ($condition as $key => $value) {
                    if ($delete->bindValue(':' . $key, $value, PDO::PARAM_STR) === false)
                        throw new Exception('Error bind value');
                }
            }
            return $delete->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Global find function
     */
    public function find(string $table, ?array $condition = null, string $type = 'one'): mixed
    {
        global $connected;
        try {
            $arr   = [];
            $where = '';
            if ($condition !== null && !empty(array_filter(array_keys($condition), fn($k) => $k !== ''))) {
                // filter out empty-string keys (legacy calls pass [''] as condition)
                $filtered = array_filter($condition, fn($k) => $k !== '', ARRAY_FILTER_USE_KEY);
                if (!empty($filtered)) {
                    foreach ($filtered as $key => $value) {
                        $arr[] = $key . ' = :' . $key;
                    }
                    $where     = ' WHERE ' . implode(' AND ', $arr);
                    $condition = $filtered;
                } else {
                    $condition = null;
                }
            } else {
                $condition = null;
            }
            $sql = 'SELECT * FROM `' . $table . '`' . $where;
            $stm = $connected->prepare($sql);
            if ($condition !== null) {
                foreach ($condition as $key => $value) {
                    $stm->bindValue(':' . $key, $value, PDO::PARAM_STR);
                }
            }
            $stm->execute();
            return ($type === 'one') ? $stm->fetch(PDO::FETCH_ASSOC) : $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }
}
