<?php
include 'header.php';
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    ob_end_flush();
}
?>

<nav aria-label="...">
  <ul class="pagination">
    <li class="page-item disabled">
      <span class="page-link">Previous</span>
    </li>
    <li class="page-item"><a class="page-link" href="#">#</a></li>
    <li class="page-item active" aria-current="page">
      <span class="page-link">Dish</span>
    </li>
    <li class="page-item"><a class="page-link" href="#">Recipe</a></li>
    <li class="page-item"><a class="page-link" href="#">Action</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
                        <tr>
                            <?php
                            $userID = $_SESSION['u_id'];
                            $cnt = 1;
                            $select = $conn->prepare("SELECT * FROM list WHERE userID = ?");
                            $select->execute([$userID]);
                            foreach ($select as $selects) { ?>

                                <th class="px-md-4" scope="row"><?= $cnt++ ?></th>
                                <td class="px-md-4" align="start"><?= $selects['p_Dish'] ?></td>
                                <td class="px-md-4">
                                    <div class="dropdown">
                                        <a class="text-decoration-none dropdown-toggle text-black" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                                        <ul class="dropdown-menu text-center">
                                            <table class="table" style="font-size: .7rem;">
                                                <thead align="center">
                                                    <tr>
                                                        <th scope="col" class="px-md-2">Item</th>
                                                        <th scope="col" class="px-md-2">Price</th>
                                                        <th scope="col" class="px-md-2">Quantity</th>
                                                        <th scope="col" class="px-md-2">Total</th>
                                                        <th scope="col" class="px-md-2">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody align="center">

                                                    
                                                        <?php
                                                        $listID = $selects['p_id'];
                                                        $getID = $conn->prepare("SELECT * FROM recipes WHERE list_id = ?");
                                                        $getID->execute([$listID]);
                                                        foreach ($getID as $data) { ?>
                                                        <tr>
                                                            <td class="px-md-2"><?= $data['p_recipe'] ?></td>
                                                            <td class="px-md-2">₱ <?= $data['p_price'] ?></td>
                                                            <td class="px-md-2"><?= $data['p_quantity'] ?></td>
                                                            <td class="px-md-2">₱ <?= $data['p_price'] * $data['p_quantity'] ?> </td>
                                                            <td class="px-md-2">
                                                                <a class="dropdown-item px-1 " href="new.php?update&id=<?= $data['p_id'] ?>" class="text-decoration-none">✏</a>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                </tbody>
                                            </table>
                                        </ul>
                                    </div>
                                </td>

                                <td class="px-md-1">
                                        <a class="text-decoration-none px-1" href="addone.php?get&id=<?= $selects['p_id'] ?>" class="text-decoration-none">➕</a>
                                        |
                                        <a class="text-decoration-none px-1 " href="backend.php?delete&id=<?= $selects['p_id'] ?>" class="text-decoration-none">❌</a>
                                </td>

                        </tr>

                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>