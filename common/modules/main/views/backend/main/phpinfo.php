<?php
/**
 * Created by PhpStorm.
 * User: vetrov
 * Date: 29.08.2018
 * Time: 10:18
 */

$this->title                   = 'phpinfo()';
$this->params['pageTitle']     = $this->title;
$this->params['breadcrumbs'][] = $this->title;

$this->params['place'] = 'phpinfo';

?>

<h1>phpinfo()</h1>
<p>Просто вывод этого метода для быстрого доступа к базовой системной информации.</p>

<iframe src="/backend/main/main/phpinfo-empty"  width="1000" height="700" align="left">
</iframe>


