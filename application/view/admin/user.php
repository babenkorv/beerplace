<div class="table">
    <?= new \vendor\widgets\GridView([
        'model' => $pagination->model(),
        'searchModel' => $searchUser,
        'column' => [
            [
                'label' => 'user email',
                'attribute' => 'email',
            ],
            [
                'label' => 'user status',
                'attribute' => 'is_active',
            ],
        ],
        'showRowLink' => 'view',
    ]); ?>
</div>
