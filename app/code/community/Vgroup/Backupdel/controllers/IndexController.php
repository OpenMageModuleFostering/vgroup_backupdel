<?php

/**

 * 	News frontend controller 
 * 	
 * 	@author Magento 

 */
class Vgroup_Backupdel_IndexController extends Mage_Core_Controller_Front_Action {

    /**
     * Index action */
    public function indexAction() {
        exit('remove exit');
        $filelist = array();
        if ($handle = opendir(Mage::getBaseDir('var') . DS . "backups" . DS)) {
            while ($entry = readdir($handle)) {
                $filelist[] = array('file' => $entry, 'date' => strtotime(date("d-m-Y", filectime(Mage::getBaseDir('var') . DS . "backups" . DS . $entry))));
            }
            closedir($handle);
        }
        //backupdel/view/backupdel
        $day = Mage::getStoreConfig('backupdel/view/backupdel');
        $time = strtotime(date('d-m-Y', strtotime('-' . $day . ' day')));
        //echo $time;
        unset($filelist[0]);
        unset($filelist[1]);
        unset($filelist[2]);
        foreach ($filelist as $fl) {
            if ($fl['date'] < $time) {
                unlink(Mage::getBaseDir('var') . DS . "backups" . DS . $fl['file']);
            }
        }
        exit;
    }

}
