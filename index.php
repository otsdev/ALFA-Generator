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
      
        <h1>ALFA Generator</h1>
        <form method="get" action="alfa.php">
            Model Class Name:<input type="text" name="model" />
            <br />
            Model Pakage Name:<input type="text" name="pakage" />
            <br />         
            Generate Fragment:<input type="checkbox" name="GenerateFragment" value="yes" />
            <br />
            <input type="submit" name="submit" value="Generate"/>
           
        </form>
        
    </body>
</html>