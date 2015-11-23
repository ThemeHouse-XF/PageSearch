<?php

class ThemeHouse_PageSearch_Extend_XenForo_Model_Page extends XFCP_ThemeHouse_PageSearch_Extend_XenForo_Model_Page
{
    /**
     * Fetches multiple page records, as specified by the node IDs
     *
     * @param array $nodeIds
     * @param array $fetchOptions
     *
     * @return array|false
     */
    public function getPagesByIds(array $nodeIds, array $fetchOptions = array())
    {
        $joinOptions = $this->preparePageJoinOptions($fetchOptions);

        return $this->fetchAllKeyed('
            SELECT
                node.*,
                page.*
                ' . $joinOptions['selectFields'] . '
            FROM xf_page AS page
            INNER JOIN xf_node AS node ON
                (node.node_id = page.node_id)
            ' . $joinOptions['joinTables'] . '
            WHERE node.node_id IN (' . $this->_getDb()->quote($nodeIds) . ')
        ', 'node_id');
    } /* END ThemeHouse_PageSearch_Extend_XenForo_Model_Page::getPagesByIds */

    /**
     * Gets page IDs in the specified range. The IDs returned will be those immediately
     * after the "start" value (not including the start), up to the specified limit.
     *
     * @param integer $start IDs greater than this will be returned
     * @param integer $limit Number of posts to return
     *
     * @return array List of IDs
     */
    public function getPageIdsInRange($start, $limit)
    {
        $db = $this->_getDb();

        return $db->fetchCol($db->limit('
            SELECT node_id
            FROM xf_page
            WHERE node_id > ?
            ORDER BY node_id
        ', $limit), $start);
    } /* END ThemeHouse_PageSearch_Extend_XenForo_Model_Page::getPageIdsInRange */
}