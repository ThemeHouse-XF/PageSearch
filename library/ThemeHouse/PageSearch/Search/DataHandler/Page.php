<?php

/**
 * Handles searching of pages.
 */
class ThemeHouse_PageSearch_Search_DataHandler_Page extends XenForo_Search_DataHandler_Abstract
{
    /**
     * @var XenForo_Model_Page
     */
    protected $_pageModel = null;

    /**
     * @var XenForo_Model_Template
     */
    protected $_templateModel = null;

    /**
     * Inserts into (or replaces a record) in the index.
     *
     * @see XenForo_Search_DataHandler_Abstract::_insertIntoIndex()
     */
    protected function _insertIntoIndex(XenForo_Search_Indexer $indexer, array $data, array $parentData = null)
    {
        $metadata = array();

        $pageModel = $this->_getPageModel();

        $data['message'] = $this->_getTemplateModel()->getTemplateInStyleByTitle($pageModel->getTemplateTitle($data));

        $indexer->insertIntoIndex(
            'page', $data['node_id'],
            $data['title'], strip_tags($data['message']['template']),
            $data['publish_date'], 0
        );
    } /* END ThemeHouse_PageSearch_Search_DataHandler_Page::_insertIntoIndex */

    /**
     * Updates a record in the index.
     *
     * @see XenForo_Search_DataHandler_Abstract::_updateIndex()
     */
    protected function _updateIndex(XenForo_Search_Indexer $indexer, array $data, array $fieldUpdates)
    {
        $indexer->updateIndex('page', $data['node_id'], $fieldUpdates);
    } /* END ThemeHouse_PageSearch_Search_DataHandler_Page::_updateIndex */

    /**
     * Deletes one or more records from the index.
     *
     * @see XenForo_Search_DataHandler_Abstract::_deleteFromIndex()
     */
    protected function _deleteFromIndex(XenForo_Search_Indexer $indexer, array $dataList)
    {
        $pageIds = array();
        foreach ($dataList AS $data) {
            $pageIds[] = $data['node_id'];
        }

        $indexer->deleteFromIndex('page', $pageIds);
    } /* END ThemeHouse_PageSearch_Search_DataHandler_Page::_deleteFromIndex */

    /**
     * Rebuilds the index for a batch.
     *
     * @see XenForo_Search_DataHandler_Abstract::rebuildIndex()
     */
    public function rebuildIndex(XenForo_Search_Indexer $indexer, $lastId, $batchSize)
    {
        $pageModel = $this->_getPageModel();

        if (!class_exists('XFCP_ThemeHouse_PageSearch_Extend_XenForo_Model_Page', false)) {
            return false;
        }

        $pageIds = $pageModel->getPageIdsInRange($lastId, $batchSize);
        if (!$pageIds) {
            return false;
        }

        $this->quickIndex($indexer, $pageIds);

        return max($pageIds);
    } /* END ThemeHouse_PageSearch_Search_DataHandler_Page::rebuildIndex */

    /**
     * Rebuilds the index for the specified content.

     * @see XenForo_Search_DataHandler_Abstract::quickIndex()
     */
    public function quickIndex(XenForo_Search_Indexer $indexer, array $contentIds)
    {
        $pageModel = $this->_getPageModel();

        $pages = $pageModel->getPagesByIds($contentIds);

        foreach ($pages AS $page) {
            if (!$page['display_in_list']) {
                continue;
            }

            $this->insertIntoIndex($indexer, $page);
        }

        return true;
    } /* END ThemeHouse_PageSearch_Search_DataHandler_Page::quickIndex */

    /**
     * Gets the type-specific data for a collection of results of this content type.
     *
     * @see XenForo_Search_DataHandler_Abstract::getDataForResults()
     */
    public function getDataForResults(array $ids, array $viewingUser, array $resultsGrouped)
    {
        $pageModel = $this->_getPageModel();

        if (!class_exists('XFCP_ThemeHouse_PageSearch_Extend_XenForo_Model_Page', false)) {
            return array();
        }

        $pages = $pageModel->getPagesByIds($ids, array(
            'permissionCombinationId' => $viewingUser['permission_combination_id']
        ));

        return $pages;
    } /* END ThemeHouse_PageSearch_Search_DataHandler_Page::getDataForResults */

    /**
     * Determines if this result is viewable.
     *
     * @see XenForo_Search_DataHandler_Abstract::canViewResult()
     */
    public function canViewResult(array $result, array $viewingUser)
    {
        $pageModel = $this->_getPageModel();

        $result['permissions'] = ($result['node_permission_cache'] ? unserialize($result['node_permission_cache']) : array());

        return $pageModel->canViewPage($result, $null, $result['permissions'], $viewingUser);
    } /* END ThemeHouse_PageSearch_Search_DataHandler_Page::canViewResult */

    /**
     * Prepares a result for display.
     *
     * @see XenForo_Search_DataHandler_Abstract::prepareResult()
     */
    public function prepareResult(array $result, array $viewingUser)
    {
        $pageModel = $this->_getPageModel();

        $message = $this->_getTemplateModel()->getTemplateInStyleByTitle($pageModel->getTemplateTitle($result));

        $result['message'] = strip_tags($message['template']);

        return $result;
    } /* END ThemeHouse_PageSearch_Search_DataHandler_Page::prepareResult */

    /**
     * Gets the date of the result (from the result's content).
     *
     * @see XenForo_Search_DataHandler_Abstract::getResultDate()
     */
    public function getResultDate(array $result)
    {
        return $result['publish_date'];
    } /* END ThemeHouse_PageSearch_Search_DataHandler_Page::getResultDate */

    /**
     * Renders a result to HTML.
     *
     * @see XenForo_Search_DataHandler_Abstract::renderResult()
     */
    public function renderResult(XenForo_View $view, array $result, array $search)
    {
        return $view->createTemplateObject('search_result_page', array(
            'page' => $result,
            'search' => $search
        ));
    } /* END ThemeHouse_PageSearch_Search_DataHandler_Page::renderResult */

    /**
     * Returns an array of content types handled by this class
     *
     * @see XenForo_Search_DataHandler_Abstract::getSearchContentTypes()
     */
    public function getSearchContentTypes()
    {
        return array('page');
    } /* END ThemeHouse_PageSearch_Search_DataHandler_Page::getSearchContentTypes */

    /**
     * Get type-specific constrints from input.
     *
     * @param XenForo_Input $input
     *
     * @return array
     */
    public function getTypeConstraintsFromInput(XenForo_Input $input)
    {
        $constraints = array();

        return $constraints;
    } /* END ThemeHouse_PageSearch_Search_DataHandler_Page::getTypeConstraintsFromInput */

    /**
     * Process a type-specific constraint.
     *
     * @see XenForo_Search_DataHandler_Abstract::processConstraint()
     */
    public function processConstraint(XenForo_Search_SourceHandler_Abstract $sourceHandler, $constraint, $constraintInfo, array $constraints)
    {
        return false;
    } /* END ThemeHouse_PageSearch_Search_DataHandler_Page::processConstraint */

    /**
     * Gets the search form controller response for this type.
     *
     * @see XenForo_Search_DataHandler_Abstract::getSearchFormControllerResponse()
     */
    public function getSearchFormControllerResponse(XenForo_ControllerPublic_Abstract $controller, XenForo_Input $input, array $viewParams)
    {
        return $controller->responseView('ThemeHouse_PageSearch_ViewPublic_Search_Form_Page', 'search_form_page', $viewParams);
    } /* END ThemeHouse_PageSearch_Search_DataHandler_Page::getSearchFormControllerResponse */

    /**
     * @return XenForo_Model_Page
     */
    protected function _getPageModel()
    {
        if (!$this->_pageModel) {
            $this->_pageModel = XenForo_Model::create('XenForo_Model_Page');
        }

        return $this->_pageModel;
    } /* END ThemeHouse_PageSearch_Search_DataHandler_Page::_getPageModel */

    /**
     * @return XenForo_Model_Template
     */
    protected function _getTemplateModel()
    {
        if (!$this->_templateModel) {
            $this->_templateModel = XenForo_Model::create('XenForo_Model_Template');
        }

        return $this->_templateModel;
    } /* END ThemeHouse_PageSearch_Search_DataHandler_Page::_getTemplateModel */
}