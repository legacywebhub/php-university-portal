<div class="row">
    <div class="col-lg-8 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">👋 Join a Room</h4>
                <div class="mt-5">
                    <?php if (isset($_SESSION['message'])): ?>
                    <h6 class="my-3 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                    <?php endif ?>
                    <form method="post" onsubmit="return checkform()">
                        <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                        <div class="form-group">
                            <input type="text" name="room" class="form-control" maxlength="20" onkeypress="return onlyAlphabeticalKey(event)" required>
                            <small class="ml-2 text-danger">Room name must not contain spaces</small>
                        </div>
                        <button class="btn btn-secondary btn-lg btn-block">
							<h4 class="m-0 text-white">Join Room</h4>						
						</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>