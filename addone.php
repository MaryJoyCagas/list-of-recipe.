<?php
include('header.php');
?>

<div class="container-fluid d-flex justify-content-center align-items-center" style="height: 600px">
    <div class="tab-pane fade show" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0" style="width: 500px; height: 310px; font-size: .7rem;">
        <div class="shadow p-4 rounded-3">
            <?php if (isset($_GET['get'])) { ?>

                <?php
                $id = $_GET['id'];

                $getID = $conn->prepare("SELECT p_id FROM list WHERE p_id = ?");
                $getID->execute([$id]);

                foreach ($getID as $data) { ?>

                    <form method="POST" action="backend.php">
                        <div id="inputs">
                            <div class="position-relative mb-3">
                                <div class="mb-1 row">
                                    <div class="col-4 py-1">
                                        <input type="hidden" class="form-control" name="userID" value="<?= $_SESSION['u_id'] ?>">
                                        <input type="hidden" class="form-control" name="pID" value="<?= $data['p_id'] ?>">
                                        <label for="recipe" class="form-label "><b>Recipe:</b></label>
                                    </div>
                                    <div class="col" id="input">
                                        <input type="text" style="font-size: .7rem;" class="form-control" id="recipe" name="recipe">
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-4 py-1">
                                        <label for="recipe" class="form-label "><b>Price:</b></label>
                                    </div>
                                    <div class="col" id="input">
                                        <input type="text" style="font-size: .7rem;" class="form-control" id="price" name="price">
                                    </div>
                                </div>
                                <div class="mb-1 row" id="input">
                                    <div class="col-4 py-1">
                                        <label for="quantity" class="form-label "><b>Quantity:</b></label>
                                    </div>
                                    <div class="col" id="input">
                                        <input type="text" style="font-size: .7rem;" class="form-control" id="quantity" name="quantity">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-3 form-check card-body text-center">
                            <button type="submit" class="btn btn-success" name="addone">Add</button>
                        </div>
                    </form>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>