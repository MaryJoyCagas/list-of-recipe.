<?php
include('header.php');
?>

<div class="container-fluid d-flex justify-content-center align-items-center" style="height: 600px">
    <div class="tab-pane fade show" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0" style="width: 500px; height: 310px; font-size: .7rem;">
        <div class="shadow p-4 rounded-3">
            <?php
            if (isset($_GET['update'])) { ?>

                <?php
                $id = $_GET['id'];

                $getUser = $conn->prepare("SELECT * FROM recipes WHERE p_id = ?");
                $getUser->execute([$id]);

                foreach ($getUser as $data) { ?>

                    <form method="POST" action="backend.php">
                        <div class="mb-1 row">
                            <div class="col">
                                <input type="hidden" class="form-control" name="pID" value="<?= $data['p_id'] ?>">
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <div class="col-3 py-1">
                                <label for="price" class="form-label "><b>Recipe:</b></label>
                            </div>
                            <div class="mb-1 col">
                                <input type="text" class="form-control" id="price" style="font-size: .7rem;" name="recipe" value="<?= $data['p_recipe'] ?>">
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <div class="col-3 py-1">
                                <label for="quantity" class="form-label "><b>Price:</b></label>
                            </div>
                            <div class="mb-1 col">
                                <input type="text" class="form-control" id="quantity" style="font-size: .7rem;" name="price" value="<?= $data['p_price'] ?>">
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <div class="col-3 py-1">
                                <label for="quantity" class="form-label "><b>Quantity:</b></label>
                            </div>
                            <div class="mb-1 col">
                                <input type="text" class="form-control" id="quantity" style="font-size: .7rem;" name="quantity" value="<?= $data['p_quantity'] ?>">
                            </div>
                        </div>
                        <div class="my-3 form-check card-body text-center">
                            <button type="submit" class="btn btn-success" name="update" value="Update">Update</button>
                        </div>
                    </form>
                <?php   } ?>
            <?php } else { ?>

                <form method="POST" action="backend.php">
                    <div id="inputs">
                        <div class="position-relative mb-3">
                            <div class="mb-1 row">
                                <div class="col-3 py-1">
                                    <label for="dish" class="form-label"><b>Dish:</b></label>
                                </div>
                                <div class="col">
                                    <input type="hidden" class="form-control" name="userID" value="<?= $_SESSION['u_id'] ?>">
                                    <input type="text" style="font-size: .7rem;" class="form-control" id="dish" name="dish">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-3 form-check card-body text-center">
                        <button type="submit" class="btn btn-success" name="create">Add</button>
                    </div>
                </form>
            <?php } ?>

        </div>
    </div>
</div>