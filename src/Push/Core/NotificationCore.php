<?php
/**
 * Created by PhpStorm.
 * User: keda
 * Date: 2019/3/11
 * Time: 下午9:42
 */

namespace Photon\Push\Core;


class NotificationCore extends PushCore {

    const ACTION_TYPE_OPEN_APP = "OPEN_APP";
    const ACTION_TYPE_OPEN_URL = "OPEN_URL";
    const ACTION_TYPE_CUSTOMIZE = "CUSTOMIZE";

    protected function __construct($subInstance) {
        parent::__construct(new NotificationSuper($subInstance), $subInstance);
    }

    public function setContent($content) {
        $this->subInstance->lib->setParams("content", strval($content));
        return $this->subInstance;
    }


    public function setTitle($content) {
        $this->subInstance->lib->setParams("title", strval($content));
        return $this->subInstance;
    }

    /**
     * @access public
     * @param string $actionType        OPEN_APP/OPEN_URL/CUSTOMIZE
     * @param string $action            actionType:OPEN_URL/CUSTOMIZE时有效
     * @param string $actionParams      actionType:CUSTOMIZE时有效
     */
    public function setActions($actionType = "OPEN_APP", $action = "", $actionParams = "") {
        $this->subInstance->lib->setParams("actionType", strval($actionType))
            ->setParams("action", strval($action))
            ->setParams("actionParams", strval($actionParams));
        return $this->subInstance;
    }

}


class NotificationSuper {

    /**
     * @var PushNotification
     */
    private $iPushNotification = null;

    public function __construct($inst) {
        $this->iPushNotification = $inst;
    }

    /**
     * @param int $badge
     */
    public function setBadge($badge) {
        $this->iPushNotification->lib->setParams("badge", intval($badge));
        return $this;
    }

    /**
     * @param int $on                   是否通过厂商发送push，是:1 否0
     */
    public function setVendorPushSwitch($switch) {
        $this->iPushNotification->lib->setParams("vendorPushSwitch", intval($switch));
        return $this;
    }

    public function setSound($sound) {
        $this->iPushNotification->lib->setParams("sound", strval($sound));
        return $this;
    }

    public function setSoundSwitch($switch) {
        $this->iPushNotification->lib->setParams("soundSwitch", intval($switch));
        return $this;
    }

    public function setVibration($switch) {
        $this->iPushNotification->lib->setParams("vibration", intval($switch));
        return $this;
    }

    public function setBreathingLight($switch) {
        $this->iPushNotification->lib->setParams("breathingLight", int($switch));
        return $this;
    }

    public function setPicture($picture) {
        $this->iPushNotification->lib->setParams("picture", strval($picture));
        return $this;
    }

    public function setNotifyId($notifyId) {
        $this->iPushNotification->lib->setParams("notifyId", intval($notifyId));
        return $this;
    }

    /**
     * @param int $switch               仅后台运行时才展示消息，自通道+小米支持
     */
    public function setShowOnlyBackstage($switch) {
        $this->iPushNotification->lib->setParams("showOnlyBackstage", intval($switch));
        return $this;
    }

    /**
     * @param int $switch               是否进入厂商离线队列
     */
    public function setOffLine($switch) {
        $this->iPushNotification->lib->setParams("offLine", intval($switch));
        return $this;
    }

    /**
     * @param int $ttl                  离线队列存在时间，单位s
     */
    public function setOffLineTtl($ttl) {
        $this->iPushNotification->lib->setParams("offLineTtl", intval($ttl));
        return $this;
    }

    /**
     * @param string $iphoneSound       iphone的声音
     */
    public function setIphoneSound($iphoneSound) {
        $this->iPushNotification->lib->setParams("iphoneSound", intval($iphoneSound));
        return $this;
    }

    /**
     * @param string $dmData            统计相关数据,map<String,String>的json序列化后字符串
     */
    public function setDmData($dmData) {
        $this->iPushNotification->lib->setParams("dmData", strval($dmData));
        return $this;
    }

    /**
     * @param int $showTime             定时展示时间,单位s,默认0,不传为立即展示
     */
    public function setShowTime($showTime) {
        $this->iPushNotification->lib->setParams("showTime", intval($showTime));
        return $this;
    }

    /**
     * @param int $showExpire           默认0，如果在showTime-showExpire这段时间，没有展示出来则消息过期
     */
    public function setShowExpire($showExpire) {
        $this->iPushNotification->lib->setParams("showExpire", intval($showExpire));
        return $this;
    }

    /**
     * @param int $switch               是否浮动通知
     */
    public function setPopNotify($switch) {
        $this->iPushNotification->lib->setParams("popNotify", intval($switch));
        return $this;
    }

    /**
     * @param string $vendors             某个厂商优先走自通道，枚举值(大写):OPPO,VIVO,XIAOMI,HUAWEI,可以传多个,英文逗号,号分割
     */
    public function setForceToSelfVendors($vendors) {
        $this->iPushNotification->lib->setParams("forceToSelfVendors", $vendors);
        return $this;
    }

    /**
     * @param int $switch               是否自动清除
     */
    public function setAutoCancel($switch) {
        $this->iPushNotification->lib->setParams("autoCancel", intval($switch));
        return $this;
    }

    /**
     * @param string $channelId             target >= 26，必传通道id
     */
    public function setChannelId($channelId) {
        $this->iPushNotification->lib->setParams("channelId", $channelId);
        return $this;
    }

    /**
     * @param int 0或不设置：默认样式（标题加粗）1:标题不加粗 2:不展示标题，只展示内容
     */
    public function setIosTextStyle($style) {
        $this->iPushNotification->lib->setParams("iosTextStyle", $style);
        return $this;
    }

    /**
     * @param $num 华为角标数字,实际展示数字为原气泡数字 + 该值
     * @param $hwBadgeClass 全路径入口类
     * @return $this
     */
    public function setHwBadgeAddNum($num, $hwBadgeClass) {
        $this->iPushNotification->lib->setParams("hwBadgeAddNum", $num);
        $this->iPushNotification->lib->setParams("hwBadgeClass", $hwBadgeClass);
        return $this;
    }


    public function push($timeout = 1) {
        return $this->iPushNotification->push($timeout);
    }
}