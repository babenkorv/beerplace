<div class="view_content">
    <div class="columns">
        <div class="col-4 text-center">From</div>
        <div class="col-8"><?= $commetInfo['email_user'] ?></div>
    </div>
    <div class="columns">
        <div class="col-4 text-center">Bar name</div>
        <div class="col-8"><?= $barName ?></div>
    </div>
    <div class="columns">
        <div class="col-4 text-center">Text</div>
        <div class="col-8"><?= $commetInfo['comment'] ?></div>
    </div>
    <div class="columns">
        <div class="col-4 text-center">Comment status</div>
        <div class="col-8"><?= ($commetInfo['is_active'] == 1) ? 'active' : 'not acrtive' ?></div>
    </div>
    
    <div class="title">Change comment status</div>
    <form method="post" action="/comment/changeStatus" class="view_form">
        <input type="hidden" name="id" value="<?=$commetInfo['id'] ?>">
        <select name="is_active" id="">
            <option value="1">active</option>
            <option value="0">not active</option>
        </select>
        <input type="submit" value="Chenge status">
    </form>
    
</div>