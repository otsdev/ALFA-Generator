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
    public function ALFAGeneartor($modelName,$pakageName) {
        $this->modelName = $modelName;
        $this->pakageName=$pakageName;
    }

    public function generateALFA() {
        $this->generateAdapter();
        
    }

    private function generateActivity() {
        
        $tpl = new raintpl(); //include Rain TPL
        RainTPL::$debug = true;
        $tpl->assign("model_name", $this->modelName); // assign variable
        $res = $tpl->draw("Adapter", true); // draw the template
        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename="  . $this->modelName . "adapter.java");

        print $res;
        exit;
    }
    
    private function generateAdapter() {
        
        $tpl = new raintpl(); //include Rain TPL
        RainTPL::$debug = true;
        $tpl->assign("model_name", ucfirst($this->modelName)); // assign variable
        $tpl->assign("model_name_lower", strtolower($this->modelName)); // assign variable
        $tpl->assign("package_name", $this->pakageName); // assign variable
        $res = $tpl->draw("Adapter", true); // draw the template
        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename="  . $this->modelName . ".java");

        print $res;
        exit;
    }

}
