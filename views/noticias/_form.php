<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;

$url = Url::to(['noticias/categorias']);
$js = <<<EOF
    $("#noticias-categoria_id").on('change.yii', function(e){
        var categoria_id = $(e.target).val();
            $.ajax({
                url: '$url',
                data: {categoria_id: categoria_id},
                success: function (data) {
                    $("#rejilla").html(data);
                }
            });
    });
EOF;
$this->registerJs($js);

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="noticias-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'extracto')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'categoria_id')->widget(Select2::classname(), [
        'language' => 'es',
        'options' => ['placeholder' => 'Selecciona una categoría...'],
        'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 3,
        'language' => [
            'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
        ],
        'ajax' => [
            'url' => $url,
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { return {q:params.term}; }')
        ],
        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('function(city) { return city.text; }'),
        'templateSelection' => new JsExpression('function (city) { return city.text; }'),

    ]]);?>

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
