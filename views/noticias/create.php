<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

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

        <?= $form->field($model, 'votos')->textInput() ?>

        <?= $form->field($model, 'extracto')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'categoria_id')->widget(Select2::classname(), [
                'data' => $listaCategorias,
                'options' => ['placeholder' => 'Selecciona una categoria...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
        ?>

        <?= $form->field($model, 'usuario_id')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
