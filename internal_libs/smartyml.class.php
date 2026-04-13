<?php

/**
 * smarty_prefilter_i18n()
 * This function takes the language file, and rips it into the template
 *
 * @param $tpl_source
 * @param $smarty
 * @return string
 **/
function smarty_prefilter_i18n(string $tpl_source, object &$smarty): string
{
    if (!is_object($GLOBALS['_NG_LANGUAGE_'])) {
        die("Error loading Multilanguage Support");
    }
    $GLOBALS['_NG_LANGUAGE_']->loadCurrentTranslationTable();
    return preg_replace_callback('/##(.+?)##/', '_compile_lang', $tpl_source);
}

/**
 * _compile_lang
 * Called by smarty_prefilter_i18n function it processes every language
 * identifier, and inserts the language string in its place.
 */
function _compile_lang(array $key): string
{
    return $GLOBALS['_NG_LANGUAGE_']->getTranslation($key[1]);
}

class ngLanguage
{
    public array $_translationTable;
    public array $_supportedLanguages = [];
    public string $_defaultLocale;
    public string $_currentLocale;
    public string $_currentLanguage;
    public array $_languageTable;
    public array $_loadedTranslationTables;

    // PHP 8: Old-style constructor replaced with __construct
    public function __construct(string $locale = "")
    {
        $this->_languageTable = [
            "en" => "english",
            "km" => "khmer",
        ];
        $this->_translationTable       = [];
        $this->_loadedTranslationTables = [];
        foreach ($this->_languageTable as $lang) {
            $this->_translationTable[$lang] = [];
        }
        $this->_defaultLocale = 'en';
        if (empty($locale)) {
            $locale = $this->getHTTPAcceptLanguage();
        }
        $this->setCurrentLocale($locale);
    }

    public function getAvailableLocales(): array
    {
        return array_keys($this->_languageTable);
    }

    public function getAvailableLanguages(): array
    {
        return array_unique(array_values($this->_languageTable));
    }

    public function getCurrentLanguage(): string
    {
        return $this->_currentLanguage;
    }

    public function setCurrentLanguage(string $language): void
    {
        $this->_currentLanguage = $language;
    }

    public function getCurrentLocale(): string
    {
        return $this->_currentLocale;
    }

    public function setCurrentLocale(string $locale): void
    {
        $language = $this->_languageTable[$locale] ?? null;
        if (empty($language)) {
            die("LANGUAGE Error: Unsupported locale '$locale'");
        }
        $this->_currentLocale = $locale;
        $this->setCurrentLanguage($language);
    }

    public function getDefaultLocale(): string
    {
        return $this->_defaultLocale;
    }

    public function getHTTPAcceptLanguage(): string
    {
        $acceptLang = $_SERVER["HTTP_ACCEPT_LANGUAGE"] ?? '';
        $langs      = explode(';', $acceptLang);
        $locales    = $this->getAvailableLocales();
        foreach ($langs as $value_and_quality) {
            $values = explode(',', $value_and_quality);
            foreach ($values as $value) {
                $value = trim($value);
                if (in_array($value, $locales)) {
                    return $value;
                }
            }
        }
        return $this->getDefaultLocale();
    }

    public function _loadTranslationTable(string $locale, string $path = ''): bool
    {
        if (empty($locale)) {
            $locale = $this->getDefaultLocale();
        }
        $language = $this->_languageTable[$locale] ?? null;
        if (empty($language)) {
            die("LANGUAGE Error: Unsupported locale '$locale'");
        }
        if (!is_array($this->_translationTable[$language])) {
            die("LANGUAGE Error: Language '$language' not available");
        }
        if (empty($path)) {
            $path = dirname(__FILE__) . '/../designs/languages/' . $this->_languageTable[$locale] . '/global.lng';
        }
        if (isset($this->_loadedTranslationTables[$language])) {
            if (in_array($path, $this->_loadedTranslationTables[$language])) {
                return true;
            }
        }
        if (file_exists($path)) {
            $entries = file($path);
            $this->_translationTable[$language][$path] = [];
            $this->_loadedTranslationTables[$language][] = $path;
            $key = '';
            foreach ($entries as $row) {
                if (substr(ltrim($row), 0, 2) == '//') continue;
                $keyValuePair = explode('=', $row);
                if (count($keyValuePair) == 1) {
                    if (!empty($key)) {
                        $this->_translationTable[$language][$path][$key] .= ' ' . rtrim($keyValuePair[0]);
                    }
                    continue;
                }
                $key   = trim($keyValuePair[0]);
                $value = $keyValuePair[1];
                if (!empty($key)) {
                    $this->_translationTable[$language][$path][$key] = rtrim($value);
                }
            }
            return true;
        }
        return false;
    }

    public function _unloadTranslationTable(string $locale, string $path): bool
    {
        $language = $this->_languageTable[$locale] ?? null;
        if (empty($language)) {
            die("LANGUAGE Error: Unsupported locale '$locale'");
        }
        unset($this->_translationTable[$language][$path]);
        foreach ($this->_loadedTranslationTables[$language] as $key => $value) {
            if ($value == $path) {
                unset($this->_loadedTranslationTables[$language][$key]);
                break;
            }
        }
        return true;
    }

    public function loadCurrentTranslationTable(): void
    {
        $this->_loadTranslationTable($this->getCurrentLocale());
    }

    public function loadTranslationTable(string $locale, string $path): void
    {
        if (empty($locale)) {
            $locale = $this->getDefaultLocale();
        }
        $language = $this->_languageTable[$locale];
        $path     = dirname(__FILE__) . "/../designs/languages/$language/$path.lng";
        $this->_loadTranslationTable($locale, $path);
    }

    public function unloadTranslationTable(string $locale, string $path): void
    {
        $this->_unloadTranslationTable($locale, $path);
    }

    public function getTranslation(string $key): string
    {
        $trans = $this->_translationTable[$this->_currentLanguage] ?? null;
        if (is_array($trans) && isset($this->_loadedTranslationTables[$this->_currentLanguage])) {
            foreach ($this->_loadedTranslationTables[$this->_currentLanguage] as $table) {
                if (isset($trans[$table][$key])) {
                    return $trans[$table][$key];
                }
            }
        }
        return $key;
    }
}
