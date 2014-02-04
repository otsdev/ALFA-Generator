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
        $tpl = new raintpl(); //include Rain TPL
        RainTPL::$debug = true;
        $tpl->assign("age", "30"); // assign variable
        $res = $tpl->draw("test", true); // draw the template
        echo $res;
        
    }

    private function generateActivityFiles() {
        
    }

}
