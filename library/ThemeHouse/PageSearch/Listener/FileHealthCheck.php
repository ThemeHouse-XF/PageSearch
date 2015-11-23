<?php

class ThemeHouse_PageSearch_Listener_FileHealthCheck
{

    public static function fileHealthCheck(XenForo_ControllerAdmin_Abstract $controller, array &$hashes)
    {
        $hashes = array_merge($hashes,
            array(
                'library/ThemeHouse/PageSearch/Extend/XenForo/DataWriter/Page.php' => '19a8551d84dba796d72347bb73f7b393',
                'library/ThemeHouse/PageSearch/Extend/XenForo/Model/Page.php' => '1a796bdcea6c93b57528128192147811',
                'library/ThemeHouse/PageSearch/Install/Controller.php' => 'aa46cf8c0fb6293ac02affca255d9235',
                'library/ThemeHouse/PageSearch/Listener/ControllerPreDispatch.php' => '4bc124dd5392a74d5f6d7d0f6e0289f2',
                'library/ThemeHouse/PageSearch/Listener/LoadClassDataWriter.php' => '5138f288a7da9fa79e5cd91530cf6696',
                'library/ThemeHouse/PageSearch/Listener/LoadClassModel.php' => 'e627add8a697c0e1e7dbd9693f8410a0',
                'library/ThemeHouse/PageSearch/Listener/TemplateHook.php' => 'ea0ea6bc1e1ee8f9db1e1f08b3f9b49a',
                'library/ThemeHouse/PageSearch/Search/DataHandler/Page.php' => 'b820f95181ee7610602a7589afcfead2',
                'library/ThemeHouse/Install.php' => '18f1441e00e3742460174ab197bec0b7',
                'library/ThemeHouse/Install/20151109.php' => '2e3f16d685652ea2fa82ba11b69204f4',
                'library/ThemeHouse/Deferred.php' => 'ebab3e432fe2f42520de0e36f7f45d88',
                'library/ThemeHouse/Deferred/20150106.php' => 'a311d9aa6f9a0412eeba878417ba7ede',
                'library/ThemeHouse/Listener/ControllerPreDispatch.php' => 'fdebb2d5347398d3974a6f27eb11a3cd',
                'library/ThemeHouse/Listener/ControllerPreDispatch/20150911.php' => 'f2aadc0bd188ad127e363f417b4d23a9',
                'library/ThemeHouse/Listener/InitDependencies.php' => '8f59aaa8ffe56231c4aa47cf2c65f2b0',
                'library/ThemeHouse/Listener/InitDependencies/20150212.php' => 'f04c9dc8fa289895c06c1bcba5d27293',
                'library/ThemeHouse/Listener/LoadClass.php' => '5cad77e1862641ddc2dd693b1aa68a50',
                'library/ThemeHouse/Listener/LoadClass/20150518.php' => 'f4d0d30ba5e5dc51cda07141c39939e3',
                'library/ThemeHouse/Listener/Template.php' => '0aa5e8aabb255d39cf01d671f9df0091',
                'library/ThemeHouse/Listener/Template/20150106.php' => '8d42b3b2d856af9e33b69a2ce1034442',
                'library/ThemeHouse/Listener/TemplateHook.php' => 'a767a03baad0ca958d19577200262d50',
                'library/ThemeHouse/Listener/TemplateHook/20150106.php' => '71c539920a651eef3106e19504048756',
            ));
    }
}