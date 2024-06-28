
            
        <?php
   $passw01 = "user6";
   $hashp02 = '$2y$10$lz8w7FCaRsfyEj6117BVDO9gi4uIbM3ebcWrsKWCMkf7hNxaRfFsu';

   $test02 = password_verify($passw01, $hashp02);
   
   if($test02 == true) {
      echo "VALID password for the informed HASH!<br>"; 
      var_dump($test02);
   } else {
      echo "INVALID password for the informed HASH!<br>";     
      var_dump($test02);    
   }
?>