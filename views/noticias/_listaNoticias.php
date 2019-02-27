<?php

use yii\widgets\ListView;

?>

<?php foreach ($query as $key => $value) {
    echo $key . " - " . $value;
} ?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'item'],
    'itemView' => '_vistaNoticia',
]);
?>
