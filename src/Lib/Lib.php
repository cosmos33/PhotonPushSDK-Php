<?php

namespace Photon\Lib;


//通知栏消息
define("NotificationUrl", base64_decode("aHR0cHM6Ly9wYWFzLXB1c2gtYXBpLmltbW9tby5jb20vcHVzaC9nYXRld2F5L25vdGlmaWNhdGlvbg=="));

//通知栏批量
define("NotificationBatchUrl", base64_decode("aHR0cHM6Ly9wYWFzLXB1c2gtYXBpLmltbW9tby5jb20vcHVzaC9vcGVuL25vdGlmaWNhdGlvbi9iYXRjaA=="));

//透传消息
define("PenetrateUrl", base64_decode("aHR0cHM6Ly9wYWFzLXB1c2gtYXBpLmltbW9tby5jb20vcHVzaC9nYXRld2F5L3BlbmV0cmF0ZQ=="));

define("PenetrateBatchUrl", base64_decode("aHR0cHM6Ly9wYWFzLXB1c2gtYXBpLmltbW9tby5jb20vcHVzaC9vcGVuL3BlbmV0cmF0ZS9iYXRjaA=="));



//alias绑定标签
define("RegAliasTagUrl", base64_decode("aHR0cHM6Ly9wYWFzLXB1c2gtYXBpLmltbW9tby5jb20vcHVzaC9vcGVuL3RhZy9yZWdBbGlhc1RhZw=="));

//token绑定标签
define("RegTokenTagUrl", base64_decode("aHR0cHM6Ly9wYWFzLXB1c2gtYXBpLmltbW9tby5jb20vcHVzaC9vcGVuL3RhZy9yZWdUb2tlblRhZw=="));

//alias解绑标签
define("UnRegAliasTagUrl", base64_decode("aHR0cHM6Ly9wYWFzLXB1c2gtYXBpLmltbW9tby5jb20vcHVzaC9vcGVuL3RhZy91bnJlZ0FsaWFzVGFn"));

//token解绑标签
define("UnRegTokenTagUrl", base64_decode("aHR0cHM6Ly9wYWFzLXB1c2gtYXBpLmltbW9tby5jb20vcHVzaC9vcGVuL3RhZy91bnJlZ1Rva2VuVGFn"));

//删除标签
define("DelTagUrl", base64_decode("aHR0cHM6Ly9wYWFzLXB1c2gtYXBpLmltbW9tby5jb20vcHVzaC9vcGVuL3RhZy9kZWxUYWc="));


class Lib {

    private $_params = array();

    private $_temps = array();

    private $volatile = array(

        "notification" => array(
            "appId" => array("string", true),
            "packageName" => array("string", true),
            "title" => array("string", true),
            "content" => array("string", true),
            "target" => array("string", true),
            "pushType" => array("string", true, array("ALIAS", "TOKEN")),
            "source" => array("string", true),
            "actionType" => array("string", true, array("OPEN_APP", "OPEN_URL", "CUSTOMIZE")),
            "action" => array("string", false),
            "actionParams" => array("string", false),
            "badge" => array("int", false, null, 0),
            "vendorPushSwitch" => array("int", false, array(0, 1), 0),
            "sound" => array("string", false, null, ""),
            "soundSwitch" => array("int", false, array(0, 1), 0),
            "vibration" => array("int", false, array(0, 1), 0),
            "breathingLight" => array("int", false, array(0, 1), 0),
            "picture" => array("string", false),
            "notifyId" => array("int", false),
            "showOnlyBackstage" => array("int", false, array(0, 1), 0),
            "offLine" => array("int", false, array(0, 1), 0),
            "offLineTtl" => array("int", false),
            "iphoneSound" => array("string", false),
            "dmData" => array("json", false),
            "showTime" => array("int", false),
            "showExpire" => array("int", false),
            "popNotify" => array("int", false, array(0, 1), 1),
            "autoCancel" => array("int", false, array(0, 1), 1),
            "forceToSelfVendors" => array("string", false),
        ),

        "penetrate" => array(
            "appId" => array("string", true),
            "target" => array("string", true),
            "pushType" => array("string", true, array("ALIAS", "TOKEN")),
            "packageName" => array("string", true),
            "message" => array("string", true),
            "source" => array("string", true),
            "vendorPushSwitch" => array("int", false, array(0, 1), 0),
            "offLine" => array("int", false, array(0, 1), 0),
            "offLineTtl" => array("int", false),
        ),

        "regAliasTag" => array(
            "appId" => array("string", true),
            "appKey" => array("string", true),
            "tag" => array("string", true),
            "target" => array("string", true),

        ),

    );

    public function __construct() {

        $this->volatile["notificationBatch"] = $this->volatile['notification'];
        $this->volatile["notificationBatch"]['targets'] = array("string", true);
        unset($this->volatile["notificationBatch"]['target']);

        $this->volatile["penetrateBatch"] = $this->volatile['penetrate'];
        $this->volatile["penetrateBatch"]['targets'] = array("string", true);
        unset($this->volatile["penetrateBatch"]['target']);


        $this->volatile["regTokenTag"] = $this->volatile['regAliasTag'];
        $this->volatile["unRegAliasTag"] = $this->volatile['regAliasTag'];
        $this->volatile["unRegTokenTag"] = $this->volatile['regAliasTag'];
        $this->volatile["delTag"] = $this->volatile['regAliasTag'];
        unset($this->volatile["delTag"]['target']);

    }

    public function paramsClear() {
        $this->_params = array();
        $this->_temps = array();
    }

    public function httpPost($type,$timeout = 5) {

        try {

            $this->checkVolatile($type);

            $this->encrpty();

            switch ($type){
                case "notification":
                    $url = NotificationUrl;
                    break;
                case "penetrate";
                    $url = PenetrateUrl;
                    break;
                case "notificationBatch":
                    $url = NotificationBatchUrl;
                    break;
                case "penetrateBatch":
                    $url = PenetrateBatchUrl;
                    break;
                case "regAliasTag":
                    $url = RegAliasTagUrl;
                    break;
                case "regTokenTag":
                    $url = RegTokenTagUrl;
                    break;
                case "unregAliasTag":
                    $url = UnRegAliasTagUrl;
                    break;
                case "unregTokenTag":
                    $url = UnRegTokenTagUrl;
                    break;
                case "delTag":
                    $url = DelTagUrl;
                    break;
            }

            $postArray = $this->_params;

            $this->paramsClear();

            return Http::Post($url, $postArray, $timeout);

        } catch (\Exception $e) {

            $this->paramsClear();

            return json_encode(array(
                "em" => $e->getMessage(),
                "ec" => $e->getCode(),
            ));

        }

    }

    private function checkVolatile($type) {

        $volatiles = $this->volatile[$type];

        foreach ($volatiles as $k => $v) {

            if (isset($this->_params[$k])) {
                if (($v[0] == "int" && !is_int($this->_params[$k])) || ($v[0] == "string" && !is_string($this->_params[$k])) || ($v[0] == "json" && !json_decode($this->_params[$k]))) {
                    throw new \Exception("<" . $k . "> parameters type mismatch, need type:".$v[0], 1001);
                }
            }

            if ($v[1] && !isset($this->_params[$k])) {
                throw new \Exception("<" . $k . "> parameter missing", 1002);
            }

            if (!isset($this->_params[$k]) && isset($v[3])) {
                $this->_params[$k] = $v[3];
            }

            if (isset($this->_params[$k]) && !empty($v[2]) && !in_array($this->_params[$k], $v[2])) {
                throw new \Exception("<" . $k . "> illegal parameter value, need value:".implode(",", $v[2]), 1003);
            }

        }
    }

    private function encrpty() {
        $timestamp = time();
        $this->_params['sign'] = md5($this->_params['appId'] . $this->_temps['appKey'] . $timestamp);
        $this->_params['timestamp'] = $timestamp;
    }


    public function setParams($key, $val, $temp = false) {

        if ($temp) {
            $this->_temps[$key] = $val;
        } else {
            $this->_params[$key] = $val;
        }
        return $this;
    }

}