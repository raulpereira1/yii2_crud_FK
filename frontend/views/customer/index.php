<?php

use frontend\models\Customer;
use yii\helpers\ArrayHelper;

$atletas = Customer::find()->all();
echo '<pre>';
print_r($atletas);
?>




<h1>Ola mundo</h1>
