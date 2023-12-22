<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Request $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Аккаунт', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           
            [
                'attribute'=>'id',
                'label'=> 'id',
            ],
            [
                'attribute' => 'title',
                'label'=> 'Название',
            ],
            [
                'attribute' => 'description',
                'label'=> 'Описание',
            ],
            [
                'attribute'=>'image',
                'filter' => false,
                'format' => 'HTML',
                'value' => fn($model) => Html::img('/image/' . $model->image, ['class' => 'w-25'])
            ],
            [
                'attribute'=>'status_id',
                'label'=>'Статус',
                'filter' => $status,
                'value' => fn($model) => $status[$model->status_id],
            ],
            [
                'attribute'=>'category_id',
                'label'=>'Категория',
                'filter' => $category,
                'value' => fn($model) => $category[$model->category_id],
            ],
            [
                'attribute'=>'date',
                'label'=>'Дата создания',
                'filter' => false,
                'value' => fn($model) => date('d.m.Y H:i:s', strtotime($model->date)) 
            ],
            
        ],
    ]) ?>

</div>
