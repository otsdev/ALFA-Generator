<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once './ALFAGeneartor.php';
        
        if(isset($_GET['submit'])) {
            $model_name = $_GET['model'];
            if(!empty($model_name)) { 
                $generator = new ALFAGeneartor($modelName);
                $generator->generateALFA();
                
            }
        }
        
        ?>
        <h1>ALFA Generator</h1>
        <form method="get" action="index.php">
            Model Class Name:<input type="text" name="model" />
            <input type="submit" name="submit" value="Generate"/>
        </form>
        
    </body>
</html>