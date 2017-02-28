<div class="view_content">
    <div class="columns">
        <div class="col-4 text-center">Bar name</div>
        <div class="col-8"><?= $barInfo['BARNAME'] ?></div>
    </div>
    <div class="columns">
        <div class="col-4 text-center">Description</div>
        <div class="col-8"><?= $barInfo['DESCRIPTION'] ?></div>
    </div>
    <div class="columns">
        <div class="col-4 text-center">Beers</div>
        <div class="col-8"><?php foreach ($barInfo['BEERNAME'] as $beer) {
                echo $beer . '<br>';
            } ?>
        </div>
    </div>

    <div class="columns">
        <div class="col-4 text-center">Bar status</div>
        <div class="col-8"><?= ($barInfo['IS_ACTIVE'] == 1) ? 'active' : 'not acrtive' ?></div>
    </div>

    <div class="title">Change bar status</div>
    <form method="post" name="changeStatus" action="/bar/changeStatus" class="view_form">
        <input type="hidden" name="id" value="<?= $barInfo['ID'] ?>">
        <select name="is_active" id="">
            <option value="1">active</option>
            <option value="0">not active</option>
        </select>
        <input type="submit" value="Chenge status">
    </form>

    <?php if (!empty($barInfo['NEW_NAME']) || !empty($barInfo['NEW_DESCRIPTION']) || !empty($barInfo['NEW_BEERS'])): ?>
        <div class="title">Updated bar information</div>
        <?php if (!empty($barInfo['NEW_NAME'])): ?>
            <div class="columns">
                <div class="col-4 text-center">New bar name</div>
                <div class="col-8"><?= $barInfo['NEW_NAME'] ?></div>
            </div>
        <?php endif; ?>
        <?php if (!empty($barInfo['NEW_DESCRIPTION'])): ?>
            <div class="columns">
                <div class="col-4 text-center">New description</div>
                <div class="col-8"><?= $barInfo['NEW_DESCRIPTION'] ?></div>
            </div>
        <?php endif; ?>
        <?php if (!empty($barInfo['NEW_BEERS'])): ?>
            <div class="columns">
                <div class="col-4 text-center">New beers</div>
                <div class="col-8"><?php foreach ($barInfo['NEW_BEERS'] as $beer) {
                        echo $beer . '<br>';
                    } ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="title">Update bar information</div>
        <form method="post" name="updateBarInformation" action="/bar/updateBarInformation" class="view_form">
            <input type="hidden" name="id" value="<?= $barInfo['ID'] ?>">
            <select name="update" id="">
                <option value="1">yes</option>
                <option value="0">no</option>
            </select>
            <input type="submit" value="Chenge status" id="updateBarInformation">
        </form>
    <?php endif; ?>

</div>
