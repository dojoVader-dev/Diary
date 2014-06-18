<?php
/**
 * @package   ImpressPages
 */




namespace Plugin\Diary;


class Submenu {
    public static function getModuleNames()
    {
        return array("Create Notes"=>"Diary.create",
        			"List Notes"=>'Diary.index',
        			"Manage Comments"=> 'Diary.comment',
        			"Manage Categories"=>'Diary.manageCategory',
        			"Import from WordPress"=>'Diary.importWordPress');
    }

    public static function getSubmenuUrls()
    {
        $moduleNames = self::getModuleNames();
        $urls = array();
        foreach ($moduleNames as $itemName=>$moduleName) {
            $urls[] = ipActionUrl(array('aa' => $moduleName));
        }

        return $urls;
    }



    public static function getSubmenuItems()
    {
        $modules = self::getModuleNames();



        if (0) { // It is for translation engine to find following strings
            __('Content', 'Ip-admin');
            __('Pages', 'Ip-admin');
            __('Design', 'Ip-admin');
            __('Plugins', 'Ip-admin');
            __('Config', 'Ip-admin');
            __('Languages', 'Ip-admin');
            __('System', 'Ip-admin');
        }

        foreach ($modules as $itemName=>$module) {
            $menuItem = new \Ip\Menu\Item();
            $menuItem->setTitle($itemName); //
            $menuItem->setUrl(ipActionUrl(array('aa' => $module)));
            if (ipRequest()->getQuery('aa') == $module) {
                $menuItem->markAsCurrent(TRUE);
            }
            if (ipAdminPermission($module)) {
                $submenuItems[] = $menuItem;
            }
        }
        return $submenuItems;
    }

}
