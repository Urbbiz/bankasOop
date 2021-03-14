<?php require DIR.'views/top.php' ?>

<?php require DIR.'views/menu.php' ?>

<table id="customers">
  <tr>
    <th>Sąskaitos Nr.</th>
    <th>Vardas</th>
    <th>Pavardė</th>
    <th>Balansas</th>
    <th>Įrašyti sumą</th>
    <!-- <th>Atimti</th> -->
  </tr>
  <tr>
        <td><?=$user->acc; ?></td>
        <td><?=$user->name ?></td>
        <td><?=$user->surname ?></td>
       <td><?=$user->balance ?></td>
    <td>
      <form action="<?= URL ?>updateNegative/<?= $user->id ?>" method="post">
        <input type="number" value="<?= $user->balance ?>" name="balance">
        <button type="submit">Atimti</button>
      </form>
    </td>
    </tr>
</table>

<h1>Atimti lėšas</h1>

<?php require DIR.'views/bottom.php' ?>
