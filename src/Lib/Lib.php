<?php

namespace Photon\Lib;


//通知栏消息
define("NotificationUrl", base64_decode("aHR0cHM6Ly9wYWFzLXB1c2gtYXBpLmltbW9tby5jb20vcHVzaC9nYXRld2F5L25vdGlmaWNhdGlvbg=="));

//通知栏批量
define("NotificationBatchUrl", base64_decode("aHR0cHM6Ly9wYWFzLXB1c2gtYXBpLmltbW9tby5jb20vcHVzaC9vcGVuL25vdGlmaWNhdGlvbi9iYXRjaA=="));

//透传消息
define("PenetrateUrl", base64_decode("aHR0cHM6Ly9wYWFzLXB1c2gtYXBpLmltbW9tby5jb20vcHVzaC9nYXRld2F5L3BlbmV0cmF0ZQ=="));

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
        )

    );

    public function __construct() {

        $this->volatile["notificationBatch"] = $this->volatile['notification'];
        $this->volatile["notificationBatch"]['targets'] = array("string", true);
        unset($this->volatile["notificationBatch"]['target']);

        $this->volatile["penetrateBatch"] = $this->volatile['penetrate'];
        $this->volatile["penetrateBatch"]['targets'] = array("string", true);
        unset($this->volatile["penetrateBatch"]['target']);

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
            }

            $postArray = $this->_params;
            $this->_params = array();
            $this->_temps = array();
            $con = curl_init($url);

            curl_setopt($con, CURLOPT_HEADER, false);
            curl_setopt($con, CURLOPT_POSTFIELDS, http_build_query($postArray));
            curl_setopt($con, CURLOPT_POST,true);
            curl_setopt($con, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($con, CURLOPT_TIMEOUT,(int)$timeout);
            return curl_exec($con);
        } catch (\Exception $e) {
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