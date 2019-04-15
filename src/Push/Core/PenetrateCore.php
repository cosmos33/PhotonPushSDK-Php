<?php
/**
 * Created by PhpStorm.
 * User: momo
 * Date: 2019/3/11
 * Time: 下午9:42
 */

namespace Photon\Push\Core;

class PenetrateCore extends PushCore {

    public function __construct($subInstance) {
        parent::__construct(new PenetrateSuper($subInstance), $subInstance);
    }

    public function setMessage($message) {
        $this->lib->setParams("message", strval($message));
        return $this;
    }

    public function push($timeout = 1) {
        return $this->lib->httpPost("penetrate", $timeout);
    }


}


class PenetrateSuper {

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
