# PhotonPushSDK-Php
光子推送服务端phpsdk

```
<?php

include "vendor/autoload.php";

//通知栏消息

//透传消息


$iPush = new \Photon\Push();

//一般通知栏消息发送
echo $iPush->notification
    ->setAppid("xxx")
    ->setAppKey("xxxx")
    ->setPackageName("com.photon.xxx")
    ->setTarget("10000")
    ->setTitle("title_".rand(0, 100))
    ->setContent("content_".rand(0, 100000))
    ->setPushType("ALIAS")
    ->setSource("0")
    ->setActions("OPEN_URL", "http://www.immomo.com")
    
    //添加高级特性
    ->useSuper
    ->setOffLineTtl(259200)
    ->setOffLine(1)
    ->setNotifyId("226")
    ->setShowOnlyBackstage(0)
    ->setSoundSwitch(1)
    ->setVendorPushSwitch(1)
    ->setPopNotify(0)
    ->setAutoCancel(0)
    ->setPicture("http://img.momocdn.com/event/88/2B/882B56DA-24B5-413A-207F-60690D1067E920190312_250x250.jpg")
    ->setDmData("{\"_data\":\"{\\\"taskId\\\":\\\"204\\\"}\"}")
    ->push();

```




