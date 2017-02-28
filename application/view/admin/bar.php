<div class="table">
<?= new \vendor\widgets\GridView([
    'model' => $pagination->model(),
    'searchModel' => $searchBar,
    'showRowLink' => 'view',
    'column' => [
        [
            'label' => 'bar name',
            'attribute' => 'name',
        ],
        [
            'label' => 'bar description',
            'attribute' => 'description',
            'filter' => '',
        ],
        [
            'label' => 'bar status',
            'attribute' => 'is_active',
        ],
        [
            'label' => 'new bar name',
            'attribute' => 'new_name',
            'filter' => '',
        ],
        [
            'label' => ' new bar description',
            'attribute' => 'new_description',
            'filter' => '',
        ],
    ],


]); ?>
</div>
