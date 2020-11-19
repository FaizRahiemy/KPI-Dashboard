<?php
require 'layout.php';
?>

<body>
    
    <div id="container">
        
        <?php
            if(@$_POST['submit']){
                $db = new PDO('sqlite:db.db');
                $db->exec("INSERT INTO Purchasedmaterial values (null, 2019, 1, 10000, 10000)");
                
                echo 'submitted';
            }
        ?>
        
        <form action="" method="post" name="insert">
            <input type="submit" name="submit" id="inputSubmit" value="Insert Data" />
        </form>
        
    </div>
    
</body>