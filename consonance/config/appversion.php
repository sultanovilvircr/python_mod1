<?php
namespace consonance\config

class AppVersionConfig extends stdClass {
    public $STR_TEMPLATE = 'AppVersionConfig(
            primary={primary},
            secondary={secondary},
            tertiary={tertiary}
        )';
    /**
     * :param version:
     * :type version: str
     */
    public function __construct($version) {
        $dissected = $version->split('.');
        assert((count($dissected) > 2), 'version must be in format x.y.z');
        list($this->_primary, $this->_secondary, $this->_tertiary) = array_map(function ($v) {return intval($v);}, $dissected);
    }
    public function __str__() {
        return $this->format($this->STR_TEMPLATE, ["primary" => $this->primary,"secondary" => $this->secondary,"tertiary" => $this->tertiary]);
    }
    public function primary() {
        return $this->_primary;
    }
    public function secondary() {
        return $this->_secondary;
    }
    public function tertiary() {
        return $this->_tertiary;
    }

    public function format($msg, $vars)
    {
        $vars = (array)$vars;

        $msg = preg_replace_callback('#\{\}#', function($r){
            static $i = 0;
            return '{'.($i++).'}';
        }, $msg);

        return str_replace(
            array_map(function($k) {
                return '{'.$k.'}';
            }, array_keys($vars)),

            array_values($vars),

            $msg
        );
    }
}

