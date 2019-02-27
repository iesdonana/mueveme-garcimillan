<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NoticiasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Noticias';
$this->params['breadcrumbs'][] = $this->title;

$url = Url::to(['noticias/filtrar']);
$usuario_id = Yii::$app->user->identity->id;
$js = <<<EOF
$('#botonCategorias').click(function(e){
    e.preventDefault();
    let categoriaId = $('#categorias > option:selected').attr('value');
    $.ajax({
        method: 'GET',
        url: '$url',
        data: {categoria_id: categoriaId},
        success: function(result){
            if (result) {
                alert("ajax");
            }else {
                alert('no functiona');
            }
        }
    });
});
EOF;
$this->registerJs($js);

?>
<div class="noticias-index">

    <p>
        <?= Html::a('Create Noticias', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <select id="categorias">
        <option value="" disabled selected>Selecciona una categoria...</option>
        <?php
            foreach ($listaCategorias as $categoria => $valor) {
                echo '<option value="' . $categoria . '">' . $valor . '</option>';
            }
        ?>
    </select>

    <button id="botonCategorias">Buscar</button>

    <?= Yii::$app->controller->renderPartial('_listaNoticias', ['dataProvider' => $dataProvider]) ?>

</div>
