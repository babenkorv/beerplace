<?php

namespace application\controller;

use application\models\Bar;
use application\models\BarHasBeer;
use application\models\Beer;
use application\models\Comment;
use application\models\User;
use vendor\components\Auth;
use vendor\components\Controller;

class MainController extends Controller
{
    public function actionIndex()
    {

        $this->render('index', [

        ]);
    }

//    public function actionSignIn()
//    {
//        $user = new User();
//
//        $user->setCustomRule([
//            [['email', 'password', 'repeatPassword'], 'required'],
//            ['email', 'email'],
//            ['password', 'equal', 'param' => ['field' => 'repeatPassword']],
//        ]);
//
//        if ($user->load() && $user->validate()) {
//            if (Auth::signIn($user->email, $user->password, $user->repeatPassword)) {
//                $this->redirectToUrl('/main/logIn');
//            } else {
//                $message = 'signIn error';
//            }
//            $this->render('form/SignInForm', ['user' => $user, 'message' => $message]);
//        } else {
//            if (!empty($user->getError())) {
//                var_dump($user->getError());
//            }
//            $this->render('form/SignInForm', ['user' => $user, 'message' => '']);
//        }
//    }

    public function checkLogin()
    {
        $user = new User();


    }

    public function actionLogIn()
    {
        $user = new User();
        if ($user->load() && $user->validate()) {
           Auth::logIn($user->email, $user->password);
        }

        $this->redirectToUrl('/');
    }

    public function actionLogOut()
    {
        Auth::logOut();
        $this->redirectToUrl('/');
    }

    public function actionCallFriend()
    {
        $friend = new User();
        $friend->setCustomRule([
            [['email'], 'required'],
            ['email', 'email'],
        ]);

        if ($friend->load() && $friend->validate()) {
            $pass = Auth::generateRandomString();
            $friend->password = $pass;
            $friend->is_active = false;
            mail($friend->email, 'You called in the BeerPlace community', '<b>Your login : </b>' . $friend->email . PHP_EOL . '<b>Your password : </b>' . $friend->password . 'After activate your account you receive a message on E-mail');
            Auth::signIn($friend->email, $friend->password, $friend->password);
        }
        $this->render('index');
    }

    public function actionAddBar()
    {
        $bar = new Bar();

        if ($bar->load()) {
            if (!isset($bar->notDefineAttribute['bar_id'])) {
                $bar->is_active = false;
                $bar->name = $bar->notDefineAttribute['bar_name'];
                $bar->description = $bar->notDefineAttribute['bar_description'];
                $bar->coord = $bar->notDefineAttribute['bar_cord'];
                $bar->save();
                foreach ($bar->bar_beer as $beer) {
                    if (is_numeric($beer)) {
                        $barHesBeer = new BarHasBeer();
                        $barHesBeer->id_bar = $bar->lastInsertId();
                        $barHesBeer->id_beer = $beer;
                        $barHesBeer->save();
                    } else {
                        $beerModel = new Beer();
                        $beerModel->name = $beer;
                        $beerModel->save();

                        $barHesBeer = new BarHasBeer();
                        $barHesBeer->id_bar = $bar->lastInsertId();
                        $barHesBeer->id_beer = $beerModel->lastInsertId();
                        $barHesBeer->save();
                    }
                }
            } else {
                $updateBar = new Bar();
                $updateBar->update([
                    'new_name' => $bar->notDefineAttribute['bar_name'],
                    'new_description' => $bar->notDefineAttribute['bar_description'],
                    'new_beers' => serialize($bar->bar_beer),
                ])->where('id', '=', $bar->notDefineAttribute['bar_id'])->execute();
            }
        }
        $this->redirectToUrl('/');
    }

    public function actionGetBeers()
    {
        $beer = new Beer();
        echo json_encode($beer->select(['id', 'name'])->find());
    }

    public function actionGetBar()
    {
        $bar = new Bar();
        echo json_encode($bar->select(['id', 'name', 'coord', 'description'])->where('is_active', '=', '1')->find());
    }

    public function actionGetBarInfo()
    {
        $barInfo = [];
        $barHasBeer = new BarHasBeer();

        $barAndBeer = $barHasBeer->select(['bar.name as barName', 'bar.description as description', 'beer.name as beerName'])->join('bar', 'id_bar', 'id')->join('beer', 'id_beer', 'id')->where('bar.id', '=', $_GET['bar_id'])->find();

        $barInfo['barName'] = $barAndBeer[0]['BARNAME'];
        $barInfo['barDescription'] = $barAndBeer[0]['DESCRIPTION'];
        $barInfo['beer'] = [];

        foreach ($barAndBeer as $beer) {
            $barInfo['beer'][] = $beer['BEERNAME'];
        }

        echo json_encode($barInfo);
    }

    public function actionGetComments()
    {
        $comments = new Comment();

        echo json_encode($comments->select(['comment', 'email_user'])->where('id_bar', '=', $_GET['bar_id'])->andWhere('is_active', '=', '1')->find());

    }

    public function actionAddComment()
    {
        $comment = new Comment();
        if ($comment->load()) {
            $comment->is_active = true;
            $comment->email_user = Auth::getUserEmail();
            $comment->id_bar = $comment->notDefineAttribute['bar_id'];
            $comment->save();
        }
        $this->redirectToUrl('/');
    }
}