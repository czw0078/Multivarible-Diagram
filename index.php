<?php session_start();?>
<html>
    <head>
        <title>PHP Test</title>
    </head>
    <body>
    <p>This webpage is visualizing how the varience of DV is explained by two IVs in multivariable linear regression. Equaltion of linear regression: Y = b1*X1 + b2*X2 + b0. The DV is Y and the two IVs are X1 and X2. Thoes concepts can be showed in venn diagrams as fig showed in bottom:</p>
    <p> Traditional circle venn diagram may not show areas in proportion, thus, squares are used. The values below should have following relationships</p>
    <p>0.0 &le; Squared Partial Correlation(Y,X1) &le; 1.0</p>
    <p>0.0 &le; Non-unique Explained Variance(Y,X1,X2) &le; Squared Partial Correlation(Y,X1)</p>
    <p>Squared Partial Correlation(Y,X1) &le; Squared Partial Correlation(Y,X2) &le; 1 - Squared Partial Correlation(Y,X1) + Non-unique Explained Variance(Y,X1,X2)</p>
    <p>Note: Due to the geometry constrain, the generel Squared correlation(X1,X2) is not prepresented accuratly.</p>
    <form method="post" action="<?=$_SERVER['PHP_SELF'];?>"> 
    <table>
        <tr>
            <th>Squared Partial Correlation(<span style="color:rgb(255,153,153)">Y</span>, 
                        <span style="color:rgb(153,255,153)">X1</span>)</th>
            <th>Non-uniquely Explained Variance(<span style="color:rgb(255,153,153)">Y</span>,
                        <span style="color:rgb(153,255,153)">X1</span>,
                        <span style="color:rgb(153,153,255)">X2</span>)</th>           
            <th>Squared Partial Correlation(<span style="color:rgb(255,153,153)">Y</span>, 
                        <span style="color:rgb(153,153,255)">X2</span>)</th>
        </tr>
        <!-- select version start here -->
        <tr>
            <td><select id="SelectSquare1" onchange="setSelectSqure2()" name="yx1">
	        <option selected value=-1>Choose</option>
                <option>1.00</option>
                <option>0.95</option>
                <option>0.90</option>
                <option>0.85</option>
                <option>0.80</option>
                <option>0.75</option>
                <option>0.70</option>
                <option>0.65</option>
                <option>0.60</option>
                <option>0.55</option>
                <option>0.50</option>
                <option>0.45</option>
                <option>0.40</option>
                <option>0.35</option>
                <option>0.30</option>
                <option>0.25</option>
                <option>0.20</option>
                <option>0.15</option>
                <option>0.10</option>
                <option>0.05</option>
                <option>0.00</option>
                </select></td>

            <td><select id="SelectSquare2" onchange="setSelectSqure3()" name="x1x2">
                <option selected value=-1>Set left value first</option>
                <!-- <option selected value=-1> Set first value</option> -->
                </select></td>

            <td><select id="SelectSquare3" name="yx2">
                <option selected value=-1>Set left value first</option> 
                <!-- <option selected value=-1>Set sencond value</option> -->
                </select></td>
        <!-- select version end here-->
        
        

    </table>
        <input type="submit">
    </form>

    <!--here start the js script -->
    <script type="text/javascript" src="select.js"></script>
    <!--here end the js script -->

    <?php
    $_SESSION['index-post']=$_POST;
    $is = empty($_POST);
    if ($is){
        $_SESSION['index-post']['yx1']=0.5;
        $_SESSION['index-post']['x1x2']=0.1;
        $_SESSION['index-post']['yx2']=0.35;
    }
    // echo $_SESSION['debug'];
    ?>
    <img src="drawsquares.php">
    <p><img src="concepts.jpg"></p>
    <p>source: https://www.slideshare.net/jtneill/multiple-linear-regression-ii</p>
    </body>
</html>

