<?php

/**
 * Promos item model
 *
 * @author Magento
 */
class Vgroup_Backupdel_Model_Observer {

    public function method() {

        mail('akhilesh.chourey@vgroup.net', 'Cron of Backup delete run in cuda brand', 'method runs');

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
    }

}
