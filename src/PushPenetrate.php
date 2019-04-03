<?php
/**
 * Created by PhpStorm.
 * User: momo
 * Date: 2019/3/11
 * Time: 下午9:42
 */

namespace Photon;

class PushPenetrate {

    private $lib = null;

    public function __construct() {
        $this->lib = new Lib($this);
    }

    public function setSign($sign) {
        $this->lib->setParams("sign", strval($sign));
        return $this;
    }

    public function setAppid($appid) {
        $this->lib->setParams("appId", strval($appid));
        return $this;
    }

    public function setAppKey($appid) {
        $this->lib->setParams("appId", strval($appid));
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

    public function setVendorPushSwitch($switch) {
        $this->lib->setParams("vendorPushSwitch", strval($switch));
        return $this;
    }

    public function setSource($source) {
        $this->lib->setParams("source", strval($source));
        return $this;
    }

    public function setOffLine($offLine) {
        $this->lib->setParams("offLine", intval($offLine));
        return $this;
    }

    public function setOffLineTtl($offLineTtl) {
        $this->lib->setParams("offLineTtl", intval($offLineTtl));
        return $this;
    }

    public function push($timeout = 1) {
        return $this->lib->httpPost("penetrate", $timeout);
    }


}

