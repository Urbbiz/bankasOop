<?php require DIR.'views/top.php' ?>

<?php require DIR.'views/menu.php' ?>


<div>
    <h1 style="color: red;"> <?= $_SESSION['message'] ?? '' ?> </h1>
    <?php unset($_SESSION['message']); ?>
</div>
<table id="customers">
    <tr>
        <th>Sąskaitos Nr.</th>
        <th>Vardas</th>
        <th>Pavardė</th>
        <th>a/k kodas</th>
        <th>Balansas</th>
        <th>Papildyti</th>
        <th>Nuskaičiuoti</th>
        <th>ištrinti</th>
    </tr>

    <!--   //reikejo ikisti funkcija readData();i kintamaji,nes kitaip nesortino -->
    usort($saskaiteles, function ($a, $b) {
     return $a['surname'] <=> $b['surname'];
     }); ?>

        <?php foreach($saskaiteles as $user) :  //$users = readData()?>
        <tr>
            <td><?=$user->acc; ?></td>
            <td><?=$user->name ?></td>
            <td><?=$user->surname ?></td>
            <td><?=$user->personalId ?></td>
            <td><?=$user->balance ?></td>
            <td><a class="add" href="<?=URL?>incoming/<?=$user->id?>">Pridėti</a></td>
            <td><a class="add" href="<?=URL?>cashOut/<?=$user->id?>">Atimti</a></td>
            <td>
                <form action="<?=URL?>delete/<?=$user->id?>" method="post">
                    <button type="submit" class="btn delete">Ištrinti</button>
                </form>
            </td>

        </tr>
        <?php endforeach?>

</table>

<?php require DIR.'views/bottom.php' ?>