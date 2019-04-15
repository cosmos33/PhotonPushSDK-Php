<?php
/**
 * Created by PhpStorm.
 * User: keda
 * Date: 2019/3/11
 * Time: 下午9:42
 */

namespace Photon\Push\Core;


class PushCore {

    /**
     * @var PushNotificationSuper
     */
    public $useSuper = null;

    public $lib = null;

    public function __construct($instance) {
        $this->useSuper = $instance;
        $this->lib = new Lib($this);
    }

    public function setAppid($appid) {
        $this->lib->setParams("appId", strval($appid));
        return $this;
    }

    public function setAppKey($appid) {
        $this->lib->setParams("appKey", strval($appid), true);
        return $this;
    }

    public function setPackageName($packageName) {
        $this->lib->setParams("packageName", strval($packageName));
        return $this;
    }

    /**
     * @param string $type                 别名:1 token:2
     */
    public function setPushType($type) {
        $this->lib->setParams("pushType", strval($type));
        return $this;
    }

    public function setSource($source) {
        $this->lib->setParams("source", strval($source));
        return $this;
    }

    public function push($timeout = 1) {
        return $this->lib->httpPost("notification", $timeout);
    }

}