<?php

class ThemeHouse_PageSearch_Listener_TemplateHook extends ThemeHouse_Listener_TemplateHook
{
    protected function _getHooks()
    {
        return array(
            'search_form_tabs',
        );
    } /* END ThemeHouse_PageSearch_Listener_TemplateHook::_getHooks() */

    public static function templateHook($hookName, &$contents, array $hookParams, XenForo_Template_Abstract $template)
    {
        $templateHook = new ThemeHouse_PageSearch_Listener_TemplateHook($hookName, $contents, $hookParams, $template);
        $contents = $templateHook->run();
    } /* END ThemeHouse_PageSearch_Listener_TemplateHook::templateHook */

    protected function _searchFormTabs()
    {
        $this->_appendTemplate('th_search_form_tabs_pagesearch');
    } /* END ThemeHouse_PageSearch_Listener_TemplateHook::_searchFormTabs */
}