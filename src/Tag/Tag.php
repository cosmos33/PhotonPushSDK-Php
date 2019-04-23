<?php
/**
 * Created by PhpStorm.
 * User: Photon
 * Date: 2019/3/11
 * Time: 下午9:42
 */

namespace Photon\Tag;

/**
 * Class Tag
 */
class Tag extends \Photon\Tag\Core\TagCore {

    private static $singleton = null;

    protected function __construct() {
        parent::__construct($this);
    }

    public static function getSingleton() {
        if (self::$singleton == null) {
            self::$singleton = new \Photon\Tag\Tag();
        }

        return self::$singleton;
    }

    public function setTarget($target) {
        $this->lib->setParams("target", strval($target));
        return $this;
    }

    public function regAliasTag($timeout = 1) {
        return $this->lib->httpPost("regAliasTag", $timeout);
    }

    public function regTokenTag($timeout = 1) {
        return $this->lib->httpPost("regTokenTag", $timeout);
    }

    public function unregAliasTag($timeout = 1) {
        return $this->lib->httpPost("unregAliasTag", $timeout);
    }

    public function unregTokenTag($timeout = 1) {
        return $this->lib->httpPost("unregTokenTag", $timeout);
    }

    public function delTag($timeout = 1) {
        return $this->lib->httpPost("delTag", $timeout);
    }

}