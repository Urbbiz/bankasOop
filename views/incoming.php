<?php require DIR.'views/top.php' ?>

<?php require DIR.'views/menu.php' ?>

<table id="customers">
  <tr>
    <th>Sąskaitos Nr.</th>
    <th>Vardas</th>
    <th>Pavardė</th>
    <th>Balansas</th>
    <th>Įrašyti sumą</th>
    <!-- <th>Pridėti</th> -->
  </tr>
  <tr>
        <td><?=$user->acc; ?></td>
        <td><?=$user->name ?></td>
        <td><?=$user->surname ?></td>
       <td><?=$user->balance ?></td>
    <td>
      <form action="<?= URL ?>update/<?= $user->id ?>" method="post">
        <input type="number" value="<?= $user->balance ?>" name="balance">
        <button type="submit">Pridėti</button>
      </form>
    </td>
    </tr>
</table>

<h1>Pridėti lėšas</h1>

<?php require DIR.'views/bottom.php' ?>
