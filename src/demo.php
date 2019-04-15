<?php

$iPush = new \Photon\Push();

//////一般通知栏消息发送
echo $iPush->notification

    ->setAppid("c078bff4c2754152b1adc8325a09aa6c")
    ->setAppKey("c078bff4c2754152b1adc8325a09aa6c")
    ->setPackageName("com.immomo.momo")
    ->setTargets('[{"target":"93241506"},{"target":"1234567890"}]')
    ->setTitle("测试剧集推送标题")
    ->setContent("测试剧集推送内容")
    ->setPushType("ALIAS")
    ->setSource("1")
//    ->setActions("CUSTOMIZE", "com.immomo.bden.welcome.ui.WelcomeActivity", '{"a":"b"}')
    ->setActions("OPEN_APP")
    ->useSuper
    ->setShowOnlyBackstage(1)
    ->setVendorPushSwitch(1)
    ->setPopNotify(0)
    ->setOffLine(1)
    ->setForceToSelfVendors("OPPO")
    ->push();
//
//$res = $iPush->penetrate
//    ->setAppid("26e61d33cefc4e2cab629715b6aa260f")
//    ->setAppKey("26e61d33cefc4e2cab629715b6aa260f")
//    ->setMessage("{\"_data\":\"{\\\"taskId\\\":\\\"204\\\"}\"}")
////    ->setTarget("1234567")
//    ->setTarget("111111")
//    ->setPushType("ALIAS")
//    ->setPackageName("com.immomo.push.demo")
//    ->setSource("1")
//    ->useSuper
//    ->setOffLineTtl(1)
//    ->setOffLine(1)
//    ->setVendorPushSwitch(1)
//    ->push();

//var_dump($res);



////设置高级特性通知栏消息发送
//echo $iPush->notification
//    ->setAppid("26e61d33cefc4e2cab629715b6aa260f")
//    ->setAppKey("26e61d33cefc4e2cab629715b6aa260f")
//    ->setTitle("hi title")
//    ->setContent("hi content")
//    ->setPackageName("com.immomo.push.demo")
//    ->setPushType("TOKEN")
//    ->setTarget("93241506")
//    ->setSource("default")
//    ->setActions()
//    ->useSuper
//    ->setSoundSwitch(1)
//    ->push();

