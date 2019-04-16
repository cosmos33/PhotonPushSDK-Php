<?php
/**
 * Created by PhpStorm.
 * User: momo
 * Date: 2019/3/11
 * Time: 下午9:42
 */

namespace Photon\Push;

class Penetrate extends \Photon\Push\Core\PenetrateCore {

    public function __construct() {
        parent::__construct($this);
    }

    public function setTarget($target) {
        $this->lib->setParams("target", strval($target));
        return $this;
    }

    public function push($timeout = 1) {
        return $this->lib->httpPost("penetrate", $timeout);
    }

}


class PenetrateBatch extends \Photon\Push\Core\PenetrateCore {


    private static $singleton = null;

    protected function __construct() {
        parent::__construct($this);
    }

    public static function getSingleton() {
        if (self::$singleton == null) {
            self::$singleton = new \Photon\Push\PenetrateBatch();
        }

        return self::$singleton;
    }

    public function setTargets($targets) {
        $targetres = null;
        if (is_array($targets)) {
            $targetres = array();
            foreach ($targets as $target) {
                $targetres[] = array(
                    "target" => $target,
                );
            }
        }
        $this->lib->setParams("targets", json_encode($targetres));
        return $this;
    }

    public function push($timeout = 1) {
        return $this->lib->httpPost("penetrateBatch", $timeout);
    }

}