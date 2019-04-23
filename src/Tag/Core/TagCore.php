<?php
/**
 * Created by PhpStorm.
 * User: keda
 * Date: 2019/3/11
 * Time: 下午9:42
 */

namespace Photon\Tag\Core;


class TagCore {

    /**
     * @var \Photon\Tag\Tag
     */
    public $subInstance = null;

    /**
     * @var \Photon\Lib\Lib
     */
    public $lib = null;


    protected function __construct($subInstance) {
        $this->subInstance = $subInstance;
        $this->subInstance->lib = new \Photon\Lib\Lib();

    }

    public function setAppid($appid) {
        $this->subInstance->lib->setParams("appId", strval($appid));
        return $this->subInstance;
    }

    public function setAppKey($appKey) {
        $this->subInstance->lib->setParams("appKey", strval($appKey), true);
        return $this->subInstance;
    }

    public function setTag($tag) {
        $this->subInstance->lib->setParams("tag", strval($tag));
        return $this->subInstance;
    }

}