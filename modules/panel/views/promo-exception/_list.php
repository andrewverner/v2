<?php
use \yii\web\View;
use \app\models\Promo;
use \yii\data\ActiveDataProvider;
use \app\modules\panel\widgets\BoxWidget;
use \yii\grid\GridView;
use \app\models\PromoException;
use app\modules\panel\widgets\BoxButton;

/**
 * @var View $this
 * @var Promo $model
 * @var ActiveDataProvider $dataProvider
 */
?>
<?php $box = BoxWidget::begin(['title' => Yii::t('app', 'Promo exceptions: {title}', ['title' => $model->title])]); ?>

<?php $box->addButton(BoxButton::widget([
    'title' => 'Add exception',
    'icon' => 'fas fa-plus',
    'options' => [
        'class' => 'btn btn-primary btn-sm',
        'data-toggle' => 'modal',
        'data-target' => '#exceptions-list-modal',
    ],
])) ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => Yii::t('app', 'Type'),
            'value' => function ($exception) {
                /**
                 * @var PromoException $exception
                 */
                return Yii::t(
                    'app',
                    $exception->entity_type == PromoException::ENTITY_TYPE_ITEM
                        ? 'Item' : 'Category'
                );
            }
        ],
        'entity_id',
        [
            'label' => Yii::t('app', 'Title'),
            'value' => function ($exception) {
                /**
                 * @var PromoException $exception
                 */
                return $exception->entity->title ?? $exception->entity->name;
            }
        ],
    ],
]); ?>

<?php BoxWidget::end(); ?>

<input type="hidden" id="promo-id" value="<?= $model->id ?>" />
