<?php
namespace application\controller;

use application\models\Bar;
use application\models\Comment;
use vendor\components\Controller;

class CommentController extends Controller
{
    public $layout = 'admin';

    public function actionView()
    {
        $commetModel = new Comment();
        if($commetModel->load()) {
            $bar = new Bar();
            $commet = $commetModel->where('id', '=',$commetModel->attribute['id']['value'])->findOne();
            $barName = $bar->select(['name'])->where('id', '=', $commet['id_bar'])->findOne()['NAME'];
            $this->render('view', ['commetInfo' => $commet, 'barName' => $barName]);
        }
    }
    public function actionChangeStatus()
    {
        $comment = new Comment();
        if($comment->load()) {
            $comment->update(['is_active' => $comment->is_active])->where('id', '=', $comment->id)->execute();
        }

        $this->redirectToUrl('/comment/view?id=' . $comment->id);
    }
}