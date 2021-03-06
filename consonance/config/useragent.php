<?php
namespace consonance\config

class UserAgentConfig extends stdClass {
    public $PLATFORM_ANDROID = 0;
    public $PLATFORM_IOS = 1;
    public $PLATFORM_WINDOWS_PHONE = 2;
    public $PLATFORM_PYTHON_CLIENT = 7;
    public $STR_TEMPLATE = 'UserAgentConfig(
        platform={platform},
        app_version={app_version},
        mcc={mcc},
        mnc={mnc},
        os_version={os_version},
        manufacturer={manufacturer},
        device={device},
        os_build_number={os_build_number},
        phone_id={phone_id},
        locale_lang={locale_lang},
        locale_country={locale_country}
    )';
    /**
     * :param platform:
     * :type platform: int
     * :param app_version:
     * :type app_version: AppVersionConfig | str
     * :param mcc:
     * :type mcc: str
     * :param mnc:
     * :type mnc: str
     * :param os_version:
     * :type os_version: str
     * :param manufacturer:
     * :type manufacturer: str
     * :param device:
     * :type device: str
     * :param os_build_number:
     * :type os_build_number:
     * :param phone_id:
     * :type phone_id:
     * :param locale_lang:
     * :type locale_lang: str
     * :param locale_country:
     * :type locale_country: str
     */
    public function __construct($platform,$app_version,$mcc,$mnc,$os_version,$manufacturer,$device,$os_build_number,$phone_id,$locale_lang,$locale_country) {
        if ((type($app_version) == $str)) {
            $app_version = new AppVersionConfig($app_version);
        }
        $this->_platform = $platform;
        $this->_app_version = $app_version;
        $this->_mcc = $mcc;
        $this->_mnc = $mnc;
        $this->_os_version = $os_version;
        $this->_manufacturer = $manufacturer;
        $this->_device = $device;
        $this->_os_build_number = $os_build_number;
        $this->_phone_id = $phone_id;
        $this->_locale_lang = $locale_lang;
        $this->_locale_country = $locale_country;
    }
    public function __str__() {
        return $this->format($this->STR_TEMPLATE, ["platform" => $this->platform,"app_version" => $this->app_version,"mcc" => $this->mcc,"mnc" => $this->mnc,"os_version" => $this->os_version,"manufacturer" => $this->manufacturer,"device" => $this->device,"os_build_number" => $this->os_build_number,"phone_id" => $this->phone_id,"locale_lang" => $this->locale_lang,"locale_country" => $this->locale_country]);
    }
    public function platform() {
        return $this->_platform;
    }
    public function app_version() {
        return $this->_app_version;
    }
    public function mcc() {
        return $this->_mcc;
    }
    public function mnc() {
        return $this->_mnc;
    }
    public function os_version() {
        return $this->_os_version;
    }
    public function manufacturer() {
        return $this->_manufacturer;
    }
    public function device() {
        return $this->_device;
    }
    public function os_build_number() {
        return $this->_os_build_number;
    }
    public function phone_id() {
        return $this->_phone_id;
    }
    public function locale_lang() {
        return $this->_locale_lang;
    }
    public function locale_country() {
        return $this->_locale_country;
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

