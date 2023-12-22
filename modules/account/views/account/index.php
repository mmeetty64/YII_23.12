<?php

use app\models\Category;
use app\models\Request;
use app\models\Status;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\account\models\AccountSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Аккаунт';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать заявку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'class' => LinkPager::class
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'title',
                'label'=>'Название',
                'filter' => false
            ],
            [
                'attribute'=>'description',
                'label'=>'Описание',
                'filter' => false
            ],
            [
                'attribute'=>'image',
                'filter' => false,
                'format' => 'HTML',
                'value' => fn($model) => Html::img('/image/' . $model->image, ['class' => 'w-25'])
            ],
            [
                'attribute'=>'category_id',
                'label'=>'Категория',
                'filter' => $category,
                'value' => fn($model) => $category[$model->category_id],
            ],
            [
                'attribute'=>'status_id',
                'label'=>'Статус',
                'filter' => $status,
                'value' => fn($model) => $status[$model->status_id],
            ],
            [
                'attribute'=>'date',
                'label'=>'Дата создания',
                'filter' => false,
                'value' => fn($model) => date('d.m.Y H:i:s', strtotime($model->date)) 
            ],
            [
                'label'=>'Действие',
                'filter' => false,
                'format' => 'HTML',
                'value' => fn($model) => 
                Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) 
                 .
                 ($model->status_id == Status::getStatusId('Новая') ? Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы точно хотите удалить этот элемент?',
                        'method' => 'post',
                    ],
                ]) : ''), 
                 
            ],
            //'category_id',
            //'user_id',
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
