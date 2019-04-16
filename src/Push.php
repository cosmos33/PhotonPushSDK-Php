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
    public  $notification = null;

    public  $notificationBatch = null;


    /**
     * @var PushPenetrate null
     */
    public  $penetrate = null;

    public  $penetrateBatch = null;


    private static $factory = null;


    private function __construct() {
        $this->notification = \Photon\Push\Notification::getSingleton();
        $this->notificationBatch = new \Photon\Push\NotificationBatch();
        $this->penetrate = new \Photon\Push\Penetrate();
        $this->penetrateBatch = \Photon\Push\PenetrateBatch::getSingleton();
    }


    public static function getFactory() {
        if (self::$factory == null) {
            self::$factory =  new \Photon\Push();
        }
        return  self::$factory;
    }

}