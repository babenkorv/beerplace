<?php
namespace application\controller;

use application\models\User;
use vendor\components\Controller;

class UserController extends Controller
{
    public $layout = 'admin';

    public function actionView()
    {
        $userModel = new User();
        if ($userModel->load()) {
            $user = $userModel->where('id', '=', $userModel->id)->findOne();
            $this->render('view', ['userInfo' => $user,]);
        }
    }

    public function actionChangeStatus()
    {
        $user = new User();
        if ($user->load()) {
            $user->update(['is_active' => $user->is_active])->where('id', '=', $user->id)->execute();
        }

        $this->redirectToUrl('/user/view?id=' . $user->id);
    }
}