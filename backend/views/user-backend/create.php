<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TbUserBackend */

$this->title = 'Create Tb User Backend';
$this->params['breadcrumbs'][] = ['label' => 'Tb User Backends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-user-backend-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
