<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include "inc/rain.tpl.class.php"; //include Rain TPL
raintpl::$tpl_dir = "tpl/"; // template directory
raintpl::$cache_dir = "tmp/"; // cache directory

/**
 * Description of ALFAGeneartor
 *
 * @author mahdi
 */
class ALFAGeneartor {

    var $modelName;
    var $pakageName;

    const BASE_OUT_DIR = "out/";

    public function ALFAGeneartor($modelName, $pakageName) {
        $this->modelName = $modelName;
        $this->pakageName = $pakageName;
    }

    public function generateALFA() {
        $this->generateAdapter();
//        $content = $this->generateActivity();
//        $file_name = ALFAGeneartor::BASE_OUT_DIR . $this->modelName . "Adapter.java";
//        $this->save_file($file_name, $content);
    }

    private function generateActivity() {

        $tpl = new raintpl(); //include Rain TPL
        RainTPL::$debug = true;
        $tpl->assign("model_name", $this->modelName); // assign variable
        $res = $tpl->draw("Adapter", true); // draw the template

        return $res;
    }

    private function generateAdapter() {
        $tpl = new raintpl(); //include Rain TPL
        RainTPL::$debug = true;
        $tpl->assign("model_name", strtolower($this->modelName)); // assign variable
        $tpl->assign("model_name", ucfirst($this->modelName)); // assign variable
        $tpl->assign("model_name_lower", strtolower($this->modelName)); // assign variable
        $tpl->assign("package_name", $this->pakageName); // assign variable
        $res = $tpl->draw("Adapter", true); // draw the template
        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename=" . $this->modelName . ".java");

        print $res;
        exit;
    }

    function save_file($file_name, $content) {
        $current = file_get_contents($file_name);
        $current .= $content;
        file_put_contents($file_name, $current);
    }

    /* creates a compressed zip file */

    function create_zip($files = array(), $destination = '', $overwrite = false) {
        //if the zip file already exists and overwrite is false, return false
        if (file_exists($destination) && !$overwrite) {
            return false;
        }
        //vars
        $valid_files = array();
        //if files were passed in...
        if (is_array($files)) {
            //cycle through each file
            foreach ($files as $file) {
                //make sure the file exists
                if (file_exists($file)) {
                    $valid_files[] = $file;
                }
            }
        }
        //if we have good files...
        if (count($valid_files)) {
            //create the archive
            $zip = new ZipArchive();
            if ($zip->open($destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
                return false;
            }
            //add the files
            foreach ($valid_files as $file) {
                $zip->addFile($file, $file);
            }
            //debug
            //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
            //close the zip -- done!
            $zip->close();

            //check to make sure the file exists
            return file_exists($destination);
        } else {
            return false;
        }
    }

}
