<?php
/**
 * Created by PhpStorm.
 * User: x64
 * Date: 7/1/14
 * Time: 12:01 AM
 */

namespace Plugin\Diary\Import;
use Plugin\Diary\Import\ImportPress;

class ImportDriver {
    public $XMLInstance;
    /**
     * The XML WordPress file to be used for importing
     * @param $file XML File
     * @throws \Exception
     */
    public function __construct($file){
        if(!file_exists($file)){
            throw new \Exception(sprintf("%s doesn't exist",$file));
        }
        $this->XMLInstance=simplexml_load_file($file);

    }

    public function import(){

        foreach ( $this->XMLInstance->channel->item as $items ) {


            $WP = $items->children ( "http://wordpress.org/export/1.2/" );

            if((string) $WP->post_type === "post") {
                $Post=new ImportPress($items);
                $Post->importCategory();
                $Post->importPost();
                $Post->importComments();
            }
        }


    }


} 