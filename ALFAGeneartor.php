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

    public function ALFAGeneartor($modelName) {
        $this->modelName = $modelName;
    }

    public function generateALFA() {
        $this->generateActivityFiles();
    }

    private function generateActivityFiles() {
        
        $tpl = new raintpl(); //include Rain TPL
        RainTPL::$debug = true;
        $tpl->assign("model_name", $this->modelName); // assign variable
        $res = $tpl->draw("Adapter", true); // draw the template
        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename="  . $this->modelName . ".java");

        print $res;
        exit;
    }

}
