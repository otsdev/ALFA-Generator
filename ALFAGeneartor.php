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
    var $isgeneratefile;

    const BASE_OUT_DIR = "out/";
    const GENERATE_FRAGMENT = "generatefragment";
    const LAYOUT_PATH = "res/layout/";
    const JAVA_CODE_PATH = "src/";
    const LAYOUT_EXTENTION = ".xml";
    const ACTIVIY_EXTENTION = "Activity.java";
    const ACTIVIY_FOLDER = "/activities/";
    const ACTIVIY_LAYOUT_FOLDER = "activity_";
    const FRAGMENT_EXTENTION = "Fragment.java";
    const FRAGMENT_FOLDER = "/fragments/";
    const FRAGMENT_LAYOUT_FOLDER = "fragment_";
    const ADAPTER_EXTENTION = "Adapter.java";
    const ADAPTER_FOLDER = "/adapters/";
    const ADAPTER_LAYOUT_FOLDER = "list_item_";

    public function ALFAGeneartor($modelName, $pakageName, $isgeneratefile) {
        $this->modelName = $modelName;
        $this->pakageName = $pakageName;
        $this->isgeneratefile = $isgeneratefile;
    }

    public function generateALFA() {
        $files[] = $this->generateActivityJavaCode($this->isgeneratefile == ALFAGeneartor::GENERATE_FRAGMENT);
        $files[] = $this->generateActivityLayout($this->isgeneratefile == ALFAGeneartor::GENERATE_FRAGMENT);

        $files[] = $this->generateFragmentJavaCode();
        $files[] = $this->generateFragmentLayout();
        $files[] = $this->generateAdapterJavaCode();
        $files[] = $this->generateAdapterLayout();

        $zip_file = ALFAGeneartor::BASE_OUT_DIR . "alfa.zip";
        $this->create_zip($files, $zip_file, true);

        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename=alfa.zip");
        $res = file_get_contents($zip_file);
        print $res;
        exit;
    }

    private function generateActivityJavaCode($isHasFragment) {
        $tpl = new raintpl(); //include Rain TPL
        RainTPL::$debug = true;
        $tpl->assign("model_name", ucfirst($this->modelName)); // assign variable
        $tpl->assign("model_name_lower", strtolower($this->modelName)); // assign variable
        $tpl->assign("package_name", $this->pakageName); // assign variable
        if ($isHasFragment) {
            $res = $tpl->draw("AlfaActivityWithFragment", true);
        } else {
            $res = $tpl->draw("AlfaActivity", true);
        }


        $file_name = ALFAGeneartor::JAVA_CODE_PATH . $this->path_replace() . ALFAGeneartor::ACTIVIY_FOLDER . ucfirst(strtolower($this->modelName)) . ALFAGeneartor::ACTIVIY_EXTENTION;

        $this->save_file($file_name, $res);

        return $file_name;
    }

    private function generateActivityLayout($isHasFragment) {
        $tpl = new raintpl(); //include Rain TPL
        RainTPL::$debug = true;
        $tpl->assign("model_name", ucfirst($this->modelName)); // assign variable
        $tpl->assign("model_name_lower", strtolower($this->modelName)); // assign variable
        $tpl->assign("package_name", $this->pakageName); // assign variable            
        if ($isHasFragment) {
            $res = $tpl->draw("activity_with_fragment", true);
        } else {
            $res = $tpl->draw("activity_alfa", true);
        }
        $file_name = ALFAGeneartor::LAYOUT_PATH . ALFAGeneartor::ACTIVIY_LAYOUT_FOLDER . strtolower($this->modelName) . ALFAGeneartor::LAYOUT_EXTENTION;

        $this->save_file($file_name, $res);

        return $file_name;
    }

    private function generateFragmentJavaCode() {
        $tpl = new raintpl(); //include Rain TPL
        RainTPL::$debug = true;
        $tpl->assign("model_name", ucfirst($this->modelName)); // assign variable
        $tpl->assign("model_name_lower", strtolower($this->modelName)); // assign variable
        $tpl->assign("package_name", $this->pakageName); // assign variable
        $res = $tpl->draw("AlfaFragment", true);
        $file_name = ALFAGeneartor::JAVA_CODE_PATH . $this->path_replace() . ALFAGeneartor::FRAGMENT_FOLDER . ucfirst(strtolower($this->modelName)) . ALFAGeneartor::FRAGMENT_EXTENTION;
        $this->save_file($file_name, $res);

        return $file_name;
    }

    private function generateFragmentLayout() {
        $tpl = new raintpl(); //include Rain TPL
        RainTPL::$debug = true;
        $tpl->assign("model_name_lower", strtolower($this->modelName)); // assign variable            
        $res = $tpl->draw("fragment_alfa", true);
        $file_name = ALFAGeneartor::LAYOUT_PATH . ALFAGeneartor::FRAGMENT_LAYOUT_FOLDER . strtolower($this->modelName) . ALFAGeneartor::LAYOUT_EXTENTION;
        $this->save_file($file_name, $res);

        return $file_name;
    }

    private function generateAdapterJavaCode() {
        $tpl = new raintpl(); //include Rain TPL
        RainTPL::$debug = true;
        $tpl->assign("model_name", ucfirst($this->modelName)); // assign variable
        $tpl->assign("model_name_lower", strtolower($this->modelName)); // assign variable
        $tpl->assign("package_name", $this->pakageName); // assign variable
        $res = $tpl->draw("AlfaAdapter", true); // draw the template
        $file_name = ALFAGeneartor::JAVA_CODE_PATH . $this->path_replace() . ALFAGeneartor::ADAPTER_FOLDER . ucfirst(strtolower($this->modelName)) . ALFAGeneartor::ADAPTER_EXTENTION;
        $this->save_file($file_name, $res);

        return $file_name;
    }

    private function generateAdapterLayout() {
        $tpl = new raintpl(); //include Rain TPL
        RainTPL::$debug = true;
        $res = $tpl->draw("list_item_alfa", true); // draw the template
        $file_name = ALFAGeneartor::LAYOUT_PATH . ALFAGeneartor::ADAPTER_LAYOUT_FOLDER . strtolower($this->modelName) . ALFAGeneartor::LAYOUT_EXTENTION;
        $this->save_file($file_name, $res);

        return $file_name;
    }

    function save_file($file_name, $content) {
        if (!is_dir(dirname($file_name))) {
            // dir doesn't exist, make it
            mkdir(dirname($file_name), 0777, true);
        }

        file_put_contents($file_name, $content);
    }

    /* creates a compressed zip file */

    function create_zip($files = array(), $destination = '', $overwrite = false) {
        if (!is_dir(dirname($destination))) {
            // dir doesn't exist, make it
            mkdir(dirname($destination), 0777, true);
        }

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

    private function path_replace() {

        $newstr = str_replace(".", "/", $this->pakageName);
        return $newstr;
    }

}
