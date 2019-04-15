<?php
/**
 * Created by PhpStorm.
 * User: keda
 * Date: 2019/3/11
 * Time: 下午9:42
 */

namespace Photon\Push;

/**
 * Class Notification
 */
class Notification extends \Photon\Push\Core\NotificationCore {

    public function __construct() {
        parent::__construct($this);
    }

    public function setTarget($target) {
        $this->lib->setParams("target", strval($target));
        return $this;
    }

    public function push($timeout = 1) {
        return $this->lib->httpPost("notification", $timeout);
    }

}



/**
 * Class NotificationBatch
 */
class NotificationBatch extends \Photon\Push\Core\NotificationCore {

    public function __construct() {
        parent::__construct($this);
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
        $this->lib->setParams("targets", $targetres);
        return $this;
    }

    public function push($timeout = 1) {
        return $this->lib->httpPost("notificationBatch", $timeout);
    }

}