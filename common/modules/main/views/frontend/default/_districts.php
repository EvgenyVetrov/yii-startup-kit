<?php
/**
 * Вьюха для наполнения селектора областей
 * запрашивается по ajax
 */

?>
    <option class="bs-title-option" value="">Выберете область</option>
    <option value="0" disabled>Области:</option>

<?php

foreach ($districts as $key => $value){
    echo '<option value="' . $key . '" >' . $value . '</option>'. PHP_EOL;
}
