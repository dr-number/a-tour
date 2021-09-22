<form action="/registration/save" method="post">
    <div class="mb-3">
        <label for="InputForName" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="InputForName" value="<?= set_value('name') ?>">
    </div>
    <div class="mb-3">
        <label for="InputForEmail" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="InputForEmail" value="<?= set_value('email') ?>">
    </div>
    <div class="mb-3">
        <label for="InputForPassword" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="InputForPassword">
    </div>
    <div class="mb-3">
        <label for="InputForConfPassword" class="form-label">Confirm Password</label>
        <input type="password" name="confpassword" class="form-control" id="InputForConfPassword">
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>
