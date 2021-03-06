<?php
namespace consonance\config

class ClientConfig extends stdClass {
    public $STR_TEMPLATE = 'ClientConfig(
    username={username},
    passive={passive},
    useragent={useragent},
    pushname={pushname},
    short_connect={short_connect}
)';
    /**
     * :param username:
     * :type username: int
     * :param passive:
     * :type passive: bool
     * :param useragent:
     * :type useragent: UserAgentConfig
     * :param pushname:
     * :type pushname: str
     * :param short_connect:
     * :type short_connect: bool
     */
    public function __construct($username,$passive,$useragent,$pushname,$short_connect=true) {
        $this->_username = $username;
        $this->_passive = $passive;
        $this->_useragent = $useragent;
        $this->_pushname = $pushname;
        $this->_short_connect = $short_connect;
    }
    public function __str__() {
        return $this->format($this->STR_TEMPLATE, ["username" => $this->username,"passive" => $this->passive,"useragent" => $this->useragent,"pushname" => $this->pushname,"short_connect" => $this->short_connect]);
    }
    public function username() {
        return $this->_username;
    }
    public function passive() {
        return $this->_passive;
    }
    public function useragent() {
        return $this->_useragent;
    }
    public function pushname() {
        return $this->_pushname;
    }
    public function short_connect() {
        return $this->_short_connect;
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

