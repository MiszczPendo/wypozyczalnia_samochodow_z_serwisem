<?php
$m=$_REQUEST['m'];
if($m){
  echo '<div class="but2">';
  echo "<label>Kwota dodatkowej opłaty:</label>";
  echo "<input type='number' name='dodatkowe_oplaty' id='id_dodatkowe_oplaty' min='0' required><br>";
  echo '</div>';
  echo '<div class="but3">';
  echo "<label>Powód dodatkowej opłaty:</label>";
  echo "<input type='text' name='dodatkowe_oplaty_opis' id='id_dodatkowe_oplaty_opis' required><br>";
  echo '</div>';
}
else{
    exit();
}

?>