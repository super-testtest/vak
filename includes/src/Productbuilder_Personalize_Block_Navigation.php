<?php 
class Productbuilder_Personalize_Block_Navigation extends Mage_Catalog_Block_Navigation
{
    /**
     * Render categories menu in HTML
     *
     * @param int Level number for list item class to start from
     * @param string Extra class of outermost list items
     * @param string If specified wraps children list in div with this class
     * @return string
     */
    public function renderCategoriesMenuHtml($level = 0, $outermostItemClass = '', $childrenWrapClass = '')
    {
        $activeCategories = array();
        foreach ($this->getStoreCategories() as $child) {
            if ($child->getIsActive()) {
                $activeCategories[] = $child;
            }
        }
        $activeCategoriesCount = count($activeCategories);
        $hasActiveCategoriesCount = ($activeCategoriesCount > 0);

        if (!$hasActiveCategoriesCount) {
            return '';
        }

        $html = '';
        $j = 0;
        $excludeArray = array('85','86','88','89','90','91','93','94','95','96','97','98','99','100');
        foreach ($activeCategories as $category) {
        	
        	if(!in_array($category->getId(), $excludeArray)){
        	    $html .= $this->_renderCategoryMenuItemHtml(
	                $category,
	                $level,
	                ($j == $activeCategoriesCount - 1),
	                ($j == 0),
	                true,
	                $outermostItemClass,
	                $childrenWrapClass,
	                true
	            );
            }
            $j++;
        }

        return $html;
    }
}
