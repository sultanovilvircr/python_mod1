<?php
namespace consonance\config

class VBoxUserAgentConfig extends UserAgentConfig {
    public $DEFAULT_LOCALE_LANG = 'en';
    public $DEFAULT_LOCALE_COUNTRY = 'US';
    public $DEFAULT_MCC = '000';
    public $DEFAULT_MNC = '000';
    public $OS_VERSION = '5.0';
    public $OS_BUILD_NUMBER = 'vbox86p-userdebug 5.0 LRX21M 233 test-keys';
    public $MANUFACTURER = 'unknown';
    public $DEVICE = 'vbox86p';
    public function __construct($app_version,$phone_id,$mcc=null,$mnc=null,$locale_lang=null,$locale_country=null) {
        py2php_kwargs_method_call('parent', null, '__construct', [], ["platform" => UserAgentConfig::$PLATFORM_ANDROID,"app_version" => $app_version,"mcc" => $mcc || $this->DEFAULT_MCC,"mnc" => $mnc || $this->DEFAULT_MNC,"os_version" => $this->OS_VERSION,"manufacturer" => $this->MANUFACTURER,"device" => $this->DEVICE,"os_build_number" => $this->OS_BUILD_NUMBER,"phone_id" => $phone_id,"locale_lang" => $locale_lang || $this->DEFAULT_LOCALE_LANG,"locale_country" => $locale_country || $this->DEFAULT_LOCALE_COUNTRY]);
        parent::__construct(
            parent::$PLATFORM_ANDROID,
            $app_version,
            $mcc || $this->DEFAULT_MCC, $mnc || $this->DEFAULT_MNC,
            $this->OS_VERSION,
            $this->MANUFACTURER,
            $this->DEVICE,
            $this->OS_BUILD_NUMBER,
            $phone_id,
            $locale_lang || $this->DEFAULT_LOCALE_LANG,
            $locale_country || $this->DEFAULT_LOCALE_COUNTRY
        )
    }
}

