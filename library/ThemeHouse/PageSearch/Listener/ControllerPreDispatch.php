<?php

class ThemeHouse_PageSearch_Listener_ControllerPreDispatch extends ThemeHouse_Listener_ControllerPreDispatch
{
    public function run()
    {
        if (self::$_controller instanceof XenForo_ControllerPublic_Search) {
            self::$_showCopyright = true;
        }

        parent::run();
    } /* END ThemeHouse_PageSearch_Listener_ControllerPreDispatch::run */

    public static function controllerPreDispatch(XenForo_Controller $controller, $action)
    {
        $controllerPreDispatch = new ThemeHouse_PageSearch_Listener_ControllerPreDispatch($controller, $action);
        $controllerPreDispatch->run();
    } /* END ThemeHouse_PageSearch_Listener_ControllerPreDispatch::controllerPreDispatch */
}