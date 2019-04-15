<?php
/**
 * Created by PhpStorm.
 * User: keda
 * Date: 2019/3/11
 * Time: 下午9:42
 */

namespace Photon;

/**
 * Class iPush
 */
class Push {

    /**
     * @var PushNotification null
     */
    public $notification = null;

    /**
     * @var PushPenetrate null
     */
    public $penetrate = null;


    public function __construct() {
        $this->notification = new \Photon\Push\Notification();
        $this->notificationBatch = new \Photon\Push\NotificationBatch();
        $this->penetrate = new \Photon\Push\Penetrate();
        $this->penetrateBatch = new \Photon\Push\PenetrateBatch();
    }

}