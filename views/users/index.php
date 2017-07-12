<?php
use yii\helpers\Html;

$this->title = 'Users';
?>
<div class="users-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <hr>
    <p>
        <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= $this->render('_list', [
        'dataProvider' => $dataProvider,
    ]) ?>
</div>
