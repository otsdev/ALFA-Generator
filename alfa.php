<?php

include_once './ALFAGeneartor.php';

if (isset($_GET['submit'])) {
    $model_name = $_GET['model'];
    if (!empty($model_name)) {
        $generator = new ALFAGeneartor($model_name);
        $generator->generateALFA();
    }
}
?>
