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
        <style>
            table td { border: none 1px}
        </style>
    </head>
    <body style="text-align: center" >

        <h1 style="text-align: center">ALFA Generator</h1>


        <fieldset style="width: 500px;margin: 0 auto;">
            <form method="get" action="alfa.php">

                <table style="width: 100%;">
                    <tr><td>Model Class Name:</td><td style="text-align: left"><input type="text" name="model"  placeholder="Model" /></td></tr>
                    <tr><td>Pakage Name:</td><td> <input type="text" name="pakage"  placeholder="com.example.appname"/></td></tr>
                    <tr><td>Generate Fragment:</td><td>  <input type="checkbox" name="generatefragment" value="generatefragment" /></td></tr>
                    <tr><td>Generate Activity:</td><td> <input type="checkbox" name="generateactivity" value="generateactivity" /></td></tr>
                    <tr><td colspan="2"> <input style="float: right" type="submit" name="submit" value="Generate"/></td></tr>

                </table>


            </form>
        </fieldset>
        <a href="http://www.otsdc.com">OTS</a>
    </body>
</html>