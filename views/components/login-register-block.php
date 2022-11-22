<div class="d-flex flex-row-reverse">
    <div class="p-2">
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#registerModal">
            Register
        </button>
    </div>
    <div class="p-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
            Login
        </button>
    </div>
</div>
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Register Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/" method="post">
                <div class="modal-body">
                    <input type="hidden" name="<?= REGISTER_KEY_NAME ?>" value="1">
                    <div class="mb-3 row">
                        <label for="<?= LOGIN_KEY_NAME ?>" class="col-sm-2 col-form-label">Login</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="<?= LOGIN_KEY_NAME ?>"
                                   name="<?= LOGIN_KEY_NAME ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="<?= PASSWORD_KEY_NAME ?>" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="<?= PASSWORD_KEY_NAME ?>"
                                   name="<?= PASSWORD_KEY_NAME ?>">
                        </div>
                    </div>
                    <div class="d-flex flex-row-reverse">
                        <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger ms-2">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/" method="post">
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="<?= LOGIN_KEY_NAME ?>" class="col-sm-2 col-form-label">Login</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="<?= LOGIN_KEY_NAME ?>"
                                   name="<?= LOGIN_KEY_NAME ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="<?= PASSWORD_KEY_NAME ?>" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="<?= PASSWORD_KEY_NAME ?>"
                                   name="<?= PASSWORD_KEY_NAME ?>">
                        </div>
                    </div>
                    <div class="d-flex flex-row-reverse">
                        <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ms-2">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>