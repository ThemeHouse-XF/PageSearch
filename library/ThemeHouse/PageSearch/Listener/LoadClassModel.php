<?php

class ThemeHouse_PageSearch_Listener_LoadClassModel extends ThemeHouse_Listener_LoadClass
{
    /**
     * Gets the classes that are extended for this add-on. See parent for explanation.
     *
     * @return array
     */
    protected function _getExtends()
    {
        return array(
            'XenForo_Model_Page' => 'ThemeHouse_PageSearch_Extend_XenForo_Model_Page', /* END 'XenForo_Model_Page' */
        );
    } /* END ThemeHouse_PageSearch_Listener_LoadClassModel::_getExtends */

    public static function loadClassModel($class, array &$extend)
    {
        $loadClassModel = new ThemeHouse_PageSearch_Listener_LoadClassModel($class, $extend);
        $extend = $loadClassModel->run();
    } /* END ThemeHouse_PageSearch_Listener_LoadClassModel::loadClassModel */
}