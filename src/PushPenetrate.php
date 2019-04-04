<?php
/**
 * Created by PhpStorm.
 * User: momo
 * Date: 2019/3/11
 * Time: 下午9:42
 */

namespace Photon;

class PushPenetrate {

    public $lib = null;

    public $useSuper = null;

    public function __construct() {
        $this->useSuper = new PushPenetrateSuper($this);
        $this->lib = new Lib($this);
    }

    public function setAppid($appid) {
        $this->lib->setParams("appId", strval($appid));
        return $this;
    }

    public function setAppKey($appkey) {
        $this->lib->setParams("appKey", strval($appkey), true);
        return $this;
    }

    public function setTarget($target) {
        $this->lib->setParams("target", strval($target));
        return $this;
    }

    public function setPushType($type) {
        $this->lib->setParams("pushType", strval($type));
        return $this;
    }

    public function setPackageName($packageNName) {
        $this->lib->setParams("packageName", strval($packageNName));
        return $this;
    }

    public function setMessage($message) {
        $this->lib->setParams("message", strval($message));
        return $this;
    }

    public function setSource($source) {
        $this->lib->setParams("source", strval($source));
        return $this;
    }


    public function push($timeout = 1) {
        return $this->lib->httpPost("penetrate", $timeout);
    }


}


class PushPenetrateSuper {

    /**
     * @var PushNotification
     */
    private $iPushPenetrate = null;

    public function __construct($inst) {
        $this->iPushPenetrate = $inst;
    }

    /**
     * @param int $on                   是否通过厂商发送push，是:1 否0
     */
    public function setVendorPushSwitch($switch) {
        $this->iPushPenetrate->lib->setParams("vendorPushSwitch", intval($switch));
        return $this;
    }


    /**
     * @param int $switch               是否进入厂商离线队列
     */
    public function setOffLine($switch) {
        $this->iPushPenetrate->lib->setParams("offLine", intval($switch));
        return $this;
    }

    /**
     * @param int $ttl                  离线队列存在时间，单位s
     */
    public function setOffLineTtl($ttl) {
        $this->iPushPenetrate->lib->setParams("offLineTtl", intval($ttl));
        return $this;
    }

    public function push($timeout = 1) {
        return $this->iPushPenetrate->push($timeout);
    }
}
