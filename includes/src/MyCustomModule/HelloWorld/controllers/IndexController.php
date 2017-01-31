<?php 
/*
 * Controller class has to be inherited from Mage_Core_Controller_action
 */
class MyCustomModule_HelloWorld_IndexController extends Mage_Core_Controller_Front_Action
{
 
    /*
     * this method privides default action.
     */
    public function indexAction()
    {
        /*
         * Initialization of Mage_Core_Model_Layout model
         */
        $this->loadLayout();
 
        /*
         * Building page according to layout confuration
         */
        $this->renderLayout();
    }
}
?>