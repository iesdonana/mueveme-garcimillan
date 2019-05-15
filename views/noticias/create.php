<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

$url = Url::to(['noticias/categorias']);
$js = <<<EOF
    $("#noticias-categoria_id").on('change.yii', function(e){
        var categoria_id = $(e.target).val();
        var termino = document.getElementById('noticias-categoria_id');
        if (categoria_id != '') {
            $.ajax({
                url: '$url',
                data: {categoria_id: categoria_id},
                success: function (data) {
                    alert("hola");
                }
            });
        }
    });
EOF;
$this->registerJs($js);

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */

$this->title = 'Create Noticias';
$this->params['breadcrumbs'][] = ['label' => 'Noticias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noticias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="noticias-form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'extracto')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'categoria_id')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'url')->textInput() ?>

        <?= $form->field($model, 'usuario_id')->textInput([
            'readonly' => true,
            'value' => Yii::$app->user->identity->id,
        ]);
        ?>

        <?= $form->field($model, 'imagen')->fileInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
