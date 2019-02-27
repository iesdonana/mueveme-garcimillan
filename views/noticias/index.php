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
    console.log(categoriaId);
    $.ajax({
        method: 'GET',
        url: '$url',
        data: {categoria_id: categoriaId},
        success: function(data){
            if (data) {
                console.log(data);
                $("#listaNoticias").html(data);
                alert("bien");
            }else {
                alert('no functiona');
            }
        }
    });
});
EOF;
$this->registerJs($js);

?>

<style media="screen">
    .tag {
      background: #eee;
      border-radius: 10px 10px 10px 10px;
      color: #999;
      display: inline-block;
      line-height: 26px;
      padding: 0 20px 0 23px;
      position: relative;
      margin: 0 10px 10px 0;
    }
    .tag:hover {
      background-color: crimson;
      color: white;
    }
</style>
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

    <div id="listaNoticias">
        <?= Yii::$app->controller->renderPartial('_listaNoticias', ['dataProvider' => $dataProvider, 'query' => ['Hola']]) ?>
    </div>

</div>
