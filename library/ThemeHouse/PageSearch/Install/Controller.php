<?php

class ThemeHouse_PageSearch_Install_Controller extends ThemeHouse_Install
{
    protected $_resourceManagerUrl = 'http://xenforo.com/community/resources/page-search.1729/';

    protected function _getContentTypes()
    {
        return array(
            'page' => array(
                'addon_id' => 'ThemeHouse_PageSearch', /* END 'addon_id' */
                'fields'   => array(
                    'search_handler_class' => 'ThemeHouse_PageSearch_Search_DataHandler_Page', /* END 'search_handler_class' */
                ), /* END 'fields' */
            ), /* END 'page' */
        );
    } /* END ThemeHouse_PageSearch_Install_Controller::_getContentTypes */
}