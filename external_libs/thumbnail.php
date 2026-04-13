<?php

###############################################################
# Thumbnail Image Class for Thumbnail Generator
# Updated for PHP 8.x compatibility
###############################################################

class Zubrag_image
{
    public bool $save_to_file = true;
    public int $image_type    = -1;
    public int $quality       = 100;
    public int $max_x         = 100;
    public int $max_y         = 100;
    public int $cut_x         = 0;
    public int $cut_y         = 0;

    public function SaveImage(\GdImage $im, string $filename): bool|null
    {
        $res = null;

        // imagegif may not be available in some GD builds
        if ($this->image_type == 1 && !function_exists('imagegif')) {
            $this->image_type = 3;
        }

        switch ($this->image_type) {
            case 1:
                if ($this->save_to_file) {
                    $res = imagegif($im, $filename);
                } else {
                    header("Content-type: image/gif");
                    $res = imagegif($im);
                }
                break;
            case 2:
                if ($this->save_to_file) {
                    $res = imagejpeg($im, $filename, $this->quality);
                } else {
                    header("Content-type: image/jpeg");
                    $res = imagejpeg($im, null, $this->quality);
                }
                break;
            case 3:
                // PHP 8: PNG quality: 0 (best) to 9 (worst/smaller)
                $quality = 9 - min(round($this->quality / 10), 9);
                if ($this->save_to_file) {
                    $res = imagepng($im, $filename, (int)$quality);
                } else {
                    header("Content-type: image/png");
                    $res = imagepng($im, null, (int)$quality);
                }
                break;
        }

        return $res;
    }

    public function ImageCreateFromType(int $type, string $filename): \GdImage|false
    {
        $im = false;
        switch ($type) {
            case 1: $im = imagecreatefromgif($filename);  break;
            case 2: $im = imagecreatefromjpeg($filename); break;
            case 3: $im = imagecreatefrompng($filename);  break;
        }
        return $im;
    }

    public function GenerateThumbFile(string $from_name, string $to_name): void
    {
        $temp    = false;
        $tmpfname = '';

        if (str_starts_with($from_name, 'http://') || str_starts_with($from_name, 'https://')) {
            $tmpfname = tempnam(sys_get_temp_dir(), "TmP-");
            $temp     = @fopen($tmpfname, "w");
            if ($temp) {
                $content = @file_get_contents($from_name);
                if ($content === false) die("Cannot download image");
                @fwrite($temp, $content);
                @fclose($temp);
                $from_name = $tmpfname;
            } else {
                die("Cannot create temp file");
            }
        }

        if (!file_exists($from_name)) die("Source image does not exist!");

        // PHP 8: getimagesize returns array|false
        $size_info = @getimagesize($from_name);
        if ($size_info === false) die("Cannot read image size");

        [$orig_x, $orig_y, $orig_img_type] = $size_info;

        if ($this->cut_x > 0) $orig_x = min($this->cut_x, $orig_x);
        if ($this->cut_y > 0) $orig_y = min($this->cut_y, $orig_y);

        $this->image_type = ($this->image_type != -1 ? $this->image_type : $orig_img_type);

        if ($orig_img_type < 1 || $orig_img_type > 3) die("Image type not supported");

        if ($orig_x > $this->max_x || $orig_y > $this->max_y) {
            $per_x = $orig_x / $this->max_x;
            $per_y = $orig_y / $this->max_y;
            if ($per_y > $per_x) {
                $this->max_x = (int)($orig_x / $per_y);
            } else {
                $this->max_y = (int)($orig_y / $per_x);
            }
        } else {
            if ($this->save_to_file) {
                @copy($from_name, $to_name);
            } else {
                switch ($this->image_type) {
                    case 1: header("Content-type: image/gif");  readfile($from_name); break;
                    case 2: header("Content-type: image/jpeg"); readfile($from_name); break;
                    case 3: header("Content-type: image/png");  readfile($from_name); break;
                }
            }
            return;
        }

        if ($this->image_type == 1) {
            $ni = imagecreate($this->max_x, $this->max_y);
        } else {
            $ni = imagecreatetruecolor($this->max_x, $this->max_y);
        }

        if ($ni === false) die("Cannot create image canvas");

        $white = imagecolorallocate($ni, 255, 255, 255);
        imagefilledrectangle($ni, 0, 0, $this->max_x, $this->max_y, $white);

        $im = $this->ImageCreateFromType($orig_img_type, $from_name);
        if ($im === false) die("Cannot load source image");

        imagepalettecopy($ni, $im);
        imagecopyresampled($ni, $im, 0, 0, 0, 0, $this->max_x, $this->max_y, $orig_x, $orig_y);

        $this->SaveImage($ni, $to_name);

        imagedestroy($ni);
        imagedestroy($im);

        if ($temp && $tmpfname) {
            unlink($tmpfname);
        }
    }
}
