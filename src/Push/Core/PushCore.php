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
     * @var \Photon\Push\Core\NotificationSuper | \Photon\Push\Core\PenetrateSuper
     */
    public $useSuper = null;

    /**
     * @var \Photon\Push\Notification | \Photon\Push\NotificationBatch | \Photon\Push\Penetrate | \Photon\Push\PenetrateBatch
     */
    public $subInstance = null;

    /**
     * @var \Photon\Lib\Lib
     */
    public $lib = null;


    protected function __construct($superInstance, $subInstance) {
        $this->useSuper = $superInstance;
        $this->subInstance = $subInstance;
        $this->subInstance->lib = new \Photon\Lib\Lib();

    }

    public function setAppid($appid) {
        $this->subInstance->lib->setParams("appId", strval($appid));
        return $this->subInstance;
    }

    public function setAppKey($appid) {
        $this->subInstance->lib->setParams("appKey", strval($appid), true);
        return $this->subInstance;
    }

    public function setPackageName($packageName) {
        $this->subInstance->lib->setParams("packageName", strval($packageName));
        return $this->subInstance;
    }

    /**
     * @param string $type                 别名:1 token:2
     */
    public function setPushType($type) {
        $this->subInstance->lib->setParams("pushType", strval($type));
        return $this->subInstance;
    }

    public function setSource($source) {
        $this->subInstance->lib->setParams("source", strval($source));
        return $this->subInstance;
    }

}