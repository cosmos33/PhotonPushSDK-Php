<?php
/**
 * Created by PhpStorm.
 * User: keda
 * Date: 2019/3/11
 * Time: 下午9:42
 */

namespace Photon\Push\Core;


class PushCore {


    public $useSuper = null;

    /**
     * @var \Photon\Push\Notification | \Photon\Push\Penetrate
     */
    public $subInstance = null;

    /**
     * @var \Photon\Lib\Lib
     */
    public $lib = null;


    public function __construct($superInstance, $subInstance) {
        $this->useSuper = $superInstance;
        $this->subInstance = $subInstance;
        $this->subInstance->lib = new \Photon\Lib\Lib();

    }

    public function setAppid($appid) {
        $this->subInstance->lib->setParams("appId", strval($appid));
        return $this;
    }

    public function setAppKey($appid) {
        $this->subInstance->lib->setParams("appKey", strval($appid), true);
        return $this;
    }

    public function setPackageName($packageName) {
        $this->subInstance->lib->setParams("packageName", strval($packageName));
        return $this;
    }

    /**
     * @param string $type                 别名:1 token:2
     */
    public function setPushType($type) {
        $this->subInstance->lib->setParams("pushType", strval($type));
        return $this;
    }

    public function setSource($source) {
        $this->subInstance->lib->setParams("source", strval($source));
        return $this;
    }

}