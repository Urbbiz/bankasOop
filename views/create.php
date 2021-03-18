<?php require DIR.'views/top.php' ?>

<?php require DIR.'views/menu.php' ?>

<div>
    <h1 style="color: red;"> <?= $_SESSION['message'] ?? '' ?> </h1>
    <?php unset($_SESSION['message']); ?>
</div>
<form class="newacc" action="<?=URL?>store" method="post">
    <h2>Sukurti naują sąskaita</h2>
    <div class="input">
        <label for="name">Vardas:</label>
        <input type="text" name="name" minlength ="4" placeholder="Vardas" id="name" value="">
        <!-- <span>Vardas error</span> -->
    </div>
    <div class="input">
        <label for="surname">Pavardė:</label>
        <input type="text" name="surname" minlength ="4") placeholder="Pavardė" id="surname" value="">
        <!-- <span>Pavardė error</span> -->
    </div>
    <div class="input">
        <label for="acc">Sąskaitos Numeris:</label>
        <input type="text" readonly name="acc" placeholder="Sąskaitos Numeris" id="acc" value="<?php echo Json::accountNumber()?>">  
        <!-- <span>Sąskaitos Numeris error</span> -->
    </div>
    <div class="input">
        <label for="personalId">a/k kodas:</label>
        <input type="text" name="personalId" placeholder="a/k kodas" id="personalId" value="">
        <!-- <span>a/k kodas error</span> -->
    </div>
    <div class="submit">
        <input class="btn" type="submit" name="newacc" value="Patvirtinti">
    </div>
</form>

<?php require DIR.'views/bottom.php' ?>