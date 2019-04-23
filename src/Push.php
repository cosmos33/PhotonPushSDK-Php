<?php
/**
 * Created by PhpStorm.
 * User: keda
 * Date: 2019/3/11
 * Time: 下午9:42
 */

namespace Photon;

/**
 * Class Push
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


    public  $tag = null;

    private static $factory = null;


    private function __construct() {
        $this->notification = \Photon\Push\Notification::getSingleton();
        $this->notificationBatch = \Photon\Push\NotificationBatch::getSingleton();
        $this->penetrate = \Photon\Push\Penetrate::getSingleton();
        $this->penetrateBatch = \Photon\Push\PenetrateBatch::getSingleton();

        $this->tag = \Photon\Tag\Tag::getSingleton();
    }


    public static function getFactory() {
        if (self::$factory == null) {
            self::$factory =  new \Photon\Push();
        }
        return  self::$factory;
    }

}