<?php
\vendor\components\AssetManager::setAsset(
    $this->viewUniqueName, [
        'js' => [
            'assets/vue.min.js',
            'assets/leaflet/leaflet.js',
            'js/bar.js',
            'js/map.js',
            'js/login.js',
        ],
    ]
);

?>


<?php echo (!\vendor\components\Auth::isGuest()) ? '<div class="add_bar"><div class="icon">+</div>></div>' : '<div class="add_bar hide"><div class="icon">+</div></div>'; ?>


<div class="map-container">
    <div id="map"></div>
</div>

<!--Create new bar form-->
<div id="new_bar_form" class="hiddenBlock">
    <form class="form-horizontal" action="/main/addBar" method="post">

        <input type="hidden" name="bar_cord" id="bar_cord">

        <div class="form-group">
            <div class="col-3">
                <label class="form-label white" for="bar_name">Bar name</label>
            </div>
            <div class="col-9">
                <input class="form-input" name="bar_name" type="text">
            </div>
        </div>

        <div class="form-group">
            <div class="col-3">
                <label class="form-label white" for="bar_description">Description</label>
            </div>
            <div class="col-9">
                <textarea name="bar_description" id="" cols="30" rows="10"></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-3">
                <label class="form-label white" for="bar_beer">Type of beers</label>
            </div>
            <div class="col-9" id="select_beer">
                <input class="form-input" v-model="newBeer" placeholder="Add new beer" v-on:keyup.enter="addNewBeer">
                <select multiple required name="bar_beer[]" size="6" id="bar_beer">
                    <option v-for="beer in beers" v-bind:value="beer.ID">{{beer.NAME}}</option>
                </select>
            </div>
        </div>

        <input class="btn" type="button" value="Submit" onclick="this.parentNode.submit();">
    </form>
</div>

<!--Bar information + comment-->
<div id="bar_info" class="hiddenBlock">
    <h1 class="title text-center"> {{barInfo.barName}} </h1>

    <div class="bar_info_element white"> {{barInfo.barDescription}}</div>

    <div class="bar_info_element">
        <div class="text-center white">Beers:</div>
        <div class="text-left white" v-for="(beer, index) in barInfo.beer">{{index + 1}}. {{ beer }}</div>
    </div>

    <div class="bar_info_element comment_element">
        <div class="title">Send comment</div>
        <form class="form-horizontal" action="/main/addComment" method="post">
            <input type="hidden" name="bar_id" id="bar_info_id">
            <textarea name="comment" id="comment" cols="30" rows="6" <?=(\vendor\components\Auth::isGuest()) ? 'disabled' : ''?>> <?=(\vendor\components\Auth::isGuest()) ? 'If you want to post a comment you need to login' : ''?></textarea>
            <input class="btn form-button" <?=(\vendor\components\Auth::isGuest()) ? 'disabled' : ''?> type="button" value="Send" onclick="this.parentNode.submit();">
        </form>
    </div>

    <div class="bar_info_element white" v-for="com in comments">
        <div class="text-center">{{com.EMAIL_USER}}</div>
        <p>{{com.COMMENT}}</p>
    </div>

</div>
</div>

<!--Redactor bar form-->
<div id="bar_redactor_form" class="hiddenBlock">
    <div class="title">Update bar information</div>

    <form class="form-horizontal" action="/main/addBar" method="post">
        <input type="hidden" id="redactor_bar_id" name="bar_id">

        <div class="bar_info_element_redactor white">

            <div class="form-group">
                <div class="col-3">Name :</div>
                <div class="col-9">{{barInfo.barName}}</div>
            </div>
            <div class="form-group">
                <div class="col-3">
                    <label class="white" for="bar_name">New name</label>
                </div>
                <div class="col-9">
                    <input class="form-input" name="bar_name" type="text">
                </div>
            </div>
        </div>

        <div class="bar_info_element_redactor white">
            <div class="form-group">
                <div class="col-3">Description :</div>
                <div class="col-9">{{barInfo.barDescription}}</div>
            </div>
            <div class="form-group">
                <div class="col-3">
                    <label class="white" for="bar_name">New description</label>
                </div>
                <div class="col-9">
                    <textarea name="bar_description" id="" rows="6"></textarea>
                </div>
            </div>
        </div>

        <div class="bar_info_element_redactor white">
            <div class="form-group">
                <div class="col-3">Beers:</div>
                <div class="col-9">
                    <div class="inline-block white" v-for="(beer, index) in barInfo.beer">{{ beer }};&nbsp;&nbsp; </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-3">
                    <label class="white" for="bar_beer">Select new beers</label>
                </div>
                <div class="col-9" id="select_beer">
                    <input class="form-input" v-model="newBeer" placeholder="Add new beer"
                           v-on:keyup.enter="addNewBeer">
                    <select multiple required name="bar_beer[]" size="6" id="bar_beer">
                        <option v-for="beer in beers" v-bind:value="beer.ID">{{beer.NAME}}</option>
                    </select>
                </div>
            </div>
        </div>

        <input class="btn" type="button" value="Submit" onclick="this.parentNode.submit();">
    </form>
</div>