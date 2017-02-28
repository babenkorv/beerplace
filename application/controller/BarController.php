<?php
namespace application\controller;

use application\models\Bar;
use application\models\BarHasBeer;
use application\models\Beer;
use application\models\Comment;
use vendor\components\Controller;

class BarController extends Controller
{
    public $layout = 'admin';

    public function actionView()
    {
        $barHasBear = new BarHasBeer();
        if ($barHasBear->load()) {
            $barAndBeer = $barHasBear
                ->select([
                    'bar.id as id',
                    'bar.name as barName',
                    'bar.description as description',
                    'beer.name as beerName',
                    'bar.new_name',
                    'bar.new_description',
                    'bar.new_beers',
                    'bar.is_active'
                ])
                ->join('bar', 'id_bar', 'id')
                ->join('beer', 'id_beer', 'id')
                ->where('bar.id', '=', $barHasBear->id)->find();

            $beer = [];
            foreach ($barAndBeer as $item) {
                $beer[] = $item['BEERNAME'];
            }
            $barAndBeer[0]['BEERNAME'] = $beer;
            $barAndBeer[0]['NEW_BEERS'] = unserialize($barAndBeer[0]['NEW_BEERS']);

            $this->render('view', ['barInfo' => $barAndBeer[0]]);

        }

    }

    public function actionChangeStatus()
    {

        $bar = new Bar();
        if ($bar->load()) {
            $bar->update(['is_active' => $bar->is_active])->where('id', '=', $bar->id)->execute();
        }

        $this->redirectToUrl('/bar/view?id=' . $bar->id);
    }

    public function actionUpdateBarInformation()
    {

        $bar = new Bar();
        if ($bar->load()) {
            if ($bar->notDefineAttribute['update'] == 1) {
                $this->updateBar($bar->id, true);
            } else {
                $this->updateBar($bar->id, false);
            }
        }

        $this->redirectToUrl('/bar/view?id=' . $bar->id);
    }

    public function updateBar($barID, $updateFlag)
    {
        $bar = new Bar();
        $barData = $bar->where('id', '=', $barID)->findOne();
        if ($updateFlag == 1) {
            $updArray = [];
            if (!empty($barData['new_name'])) {
                $updArray['name'] = $barData['new_name'];
                $updArray['new_name'] = '';
            }
            if (!empty($barData['new_description'])) {
                $updArray['description'] = $barData['new_description'];
                $updArray['new_description'] = '';
            }

            if (!empty($updArray)) {
                $bar = new Bar();
                $bar->update($updArray)->where('id', '=', $barID)->execute();
            }
            
            if (!empty(unserialize($barData['new_beers']))) {
                $beerListId = [];
                foreach (unserialize($barData['new_beers']) as $beer) {
                    $beersModel = new Beer();
                    $beerOne = $beersModel->where('name', '=', '"' . $beer . '"')->find();
                    if (empty($beerOne)) {
                        $newBeer = new Beer();
                        $newBeer->name = $beer;
                        $newBeer->save();
                        $beerListId[] = $newBeer->lastInsertId();
                    } else {
                        $beerListId[] = $beerOne[0]['id'];
                    }
                }
                $bar = new Bar();
                $bar->update(['new_beers' => ''])->where('id', '=', $barID)->execute();
                $barHasBeerModel = new BarHasBeer();
                $barHasBeerModel->delete()->where('id_bar', '=', $barID)->execute();

                foreach ($beerListId as $beer) {
                    $barHasBeerModel = new BarHasBeer();
                    $barHasBeerModel->id_bar = $barID;
                    $barHasBeerModel->id_beer = $beer;
                    $barHasBeerModel->save();
                }
            }
        } else {
            $bar = new Bar();
            $bar->update(['new_beers' => '', 'new_name' => '', 'new_description' => ''])->where('id', '=', $barID)->execute();
        }
    }
}