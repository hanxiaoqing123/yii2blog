<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TbUserBackend */

$this->title = 'Update Tb User Backend: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tb User Backends', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tb-user-backend-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
