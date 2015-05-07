<?php
/**
 * Images manage controller to configure widgets in the Cms WYSIWYG editor.
 *
 * @category    Aijko
 * @package     Aijko_WidgetImageChooser
 * @author      Gerrit Pechmann <gp@aijko.de>
 * @copyright   Copyright (c) 2012 aijko GmbH (http://www.aijko.de)
 */
if (!class_exists('Mage_Adminhtml_Cms_Wysiwyg_ImagesController', false)) {
    require_once Mage::getConfig()->getModuleDir('controllers', 'Mage_Adminhtml') . '/Cms/Wysiwyg/ImagesController.php';
}

class Aijko_WidgetImageChooser_Adminhtml_Cms_Wysiwyg_Images_ChooserController extends Mage_Adminhtml_Cms_Wysiwyg_ImagesController
{
    /**
     * Fire when select image.
     *
     * @return void
     */
    public function onInsertAction()
    {
        $helper = Mage::helper('cms/wysiwyg_images');
        $storeId = $this->getRequest()->getParam('store');

        $filename = $this->getRequest()->getParam('filename');
        $filename = $helper->idDecode($filename);

        Mage::helper('catalog')->setStoreId($storeId);
        $helper->setStoreId($storeId);

        $fileUrl = $helper->getCurrentUrl() . $filename;
        $mediaPath = str_replace(Mage::getBaseUrl('media'), '', $fileUrl);

        $this->getResponse()->setBody($mediaPath);
    }
}
