<div class="view_content">
    <div class="columns">
        <div class="col-4 text-center">Email</div>
        <div class="col-8"><?= $userInfo['email'] ?></div>
    </div>
  
    <div class="columns">
        <div class="col-4 text-center">Status</div>
        <div class="col-8"><?= ($userInfo['is_active']) ? 'active' : 'not active' ?></div>
    </div>
 
    <div class="title">Change user status</div>
    <form method="post" action="/user/changeStatus" class="view_form">
        <input type="hidden" name="id" value="<?=$userInfo['id'] ?>">
        <select name="is_active" id="">
            <option value="1">active</option>
            <option value="0">not active</option>
        </select>
        <input type="submit" value="Change status">
    </form>

</div>