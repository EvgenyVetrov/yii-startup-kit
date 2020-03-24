<?php
/**
 * Вьюха для наполнения селектора областей
 * запрашивается по ajax
 */

?>
    <option class="bs-title-option" value="">Выберете населенный пункт</option>

<?php if (!count($cities)): ?>
    <option value="0" disabled>Населенные пункты не добавлены</option>
<?php else:
echo '<option value="0" disabled>Населенные пункты:</option>';

foreach ($cities as $city){
    echo '<option value="' . $city->id . '" data-subtext="(' . $city->area . ')" >' . $city->form . ' ' . $city->name . '</option>'. PHP_EOL;
}

endif;