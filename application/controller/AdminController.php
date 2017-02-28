<?php

namespace application\controller;

use application\models\Bar;
use application\models\Comment;
use application\models\search\BarSearchModel;
use application\models\search\CommentSearchModel;
use application\models\search\UserSearchModel;
use application\models\User;
use vendor\components\Controller;
use vendor\widgets\Pagination;

class AdminController extends Controller
{
    public $layout = 'admin';

    public function actionBar()
    {
        $searchBar = new BarSearchModel();
        $pagination = new Pagination(new Bar(), 20,5);

        $this->render('bar', [
            'pagination' => $pagination,
            'searchBar' => $searchBar,
        ]);
    }

    public function actionUser()
    {
        $searchUser = new UserSearchModel();
        $pagination = new Pagination(new User(), 20,5);

        $this->render('user', [
            'pagination' => $pagination,
            'searchUser' => $searchUser,
        ]);
    }

    public function actionComment()
    {
        $searchComment = new CommentSearchModel();
        $pagination = new Pagination(new Comment(), 20,5);

        $this->render('comment', [
            'pagination' => $pagination,
            'searchComment' => $searchComment,
        ]);
    }

}