<?php

class ThemeHouse_PageSearch_Listener_LoadClassDataWriter extends ThemeHouse_Listener_LoadClass
{
    /**
     * Gets the classes that are extended for this add-on. See parent for explanation.
     *
     * @return array
     */
    protected function _getExtends()
    {
        return array(
            'XenForo_DataWriter_Page' => 'ThemeHouse_PageSearch_Extend_XenForo_DataWriter_Page', /* END 'XenForo_DataWriter_Page' */
        );
    } /* END ThemeHouse_PageSearch_Listener_LoadClassDataWriter::_getExtends */

    public static function loadClassDataWriter($class, array &$extend)
    {
        $loadClassDataWriter = new ThemeHouse_PageSearch_Listener_LoadClassDataWriter($class, $extend);
        $extend = $loadClassDataWriter->run();
    } /* END ThemeHouse_PageSearch_Listener_LoadClassDataWriter::loadClassDataWriter */
}