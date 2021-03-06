<?php
namespace consonance\config

class SamsungS9PUserAgentConfig extends UserAgentConfig {
    public $DEFAULT_LOCALE_LANG = 'en';
    public $DEFAULT_LOCALE_COUNTRY = 'US';
    public $DEFAULT_MCC = '000';
    public $DEFAULT_MNC = '000';
    public $OS_VERSION = '8.0.0';
    public $OS_BUILD_NUMBER = 'star2ltexx-user 8.0.0 R16NW G965FXXU1ARCC release-keys';
    public $MANUFACTURER = 'samsung';
    public $DEVICE = 'star2lte';
    public function __construct($app_version,$phone_id,$mcc=null,$mnc=null,$locale_lang=null,$locale_country=null) {
        parent::__construct(parent::$PLATFORM_ANDROID,
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

