<div class="table">
<?= new \vendor\widgets\GridView([
    'model' => $pagination->model(),
    'searchModel' => $searchComment,
    'column' => [
        [
            'label' => 'email user',
            'attribute' => 'email_user',
        ],
        [
            'label' => 'bar id',
            'attribute' => 'id_bar',
        ],
        [
            'label' => 'comment text',
            'attribute' => 'comment',
            'filter' => '',
        ],
        [
            'label' => 'comment status',
            'attribute' => 'is_active',
        ],
    ],
    'showRowLink' => 'view',
]); ?>
</div>
