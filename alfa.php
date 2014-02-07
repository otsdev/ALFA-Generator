<?php

include_once './ALFAGeneartor.php';

if (isset($_GET['submit'])) {
    $model_name = $_GET['model'];
    $pakage_Name=$_GET['pakage'];
    if (!empty($model_name)&& !empty($pakage_Name)) {
        $generator = new ALFAGeneartor($model_name,$pakage_Name);
        $generator->generateALFA();
    }
}
?>
