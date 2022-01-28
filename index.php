<?php

require_once('config\config.php');
require_once('functions\DbCreate.php');

require('classes\FormValidator.php');

$errors = [];

if ($_POST['submit']) {
  // Walidacja
  $validation = new FormValidator($_POST);
  $errors = $validation->validateForm();
}

if($_SESSION['exist'] == 1){
 require('functions\DbGetResults.php');
}

?>

<html lang="pl">


<head>
  <title>Formularz kontaktowy</title>
  <link rel="stylesheet" type="text/css" href="css\styles.css">

  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>

  <div class="form">
    <h2>Formularz kontaktowy</h2>
    
    <?php 
    
    if($_SESSION['sent'] == 1) {
      include ('functions\InfoNotice.php');
      $_SESSION['sent'] = 0;
    }
     ?>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

      <label>Imię: </label>
      <input type="text" name="imie" placeholder="Twoje imię..."  value="<?php echo htmlspecialchars($_POST['imie']) ?? '' ?>">
      <div class="error">
        <?php echo $errors['imie'] ?? '' ?>
      </div>

      <label>Nazwisko: </label>
      <input type="text" name="nazwisko" placeholder="Twoje nazwisko..."  value="<?php echo htmlspecialchars($_POST['nazwisko']) ?? '' ?>">
      <div class="error">
        <?php echo $errors['nazwisko'] ?? '' ?>
      </div>

      <label>Telefon: </label>
      <input type="tel" name="telefon" placeholder="Twój numer telefonu..."
        value="<?php echo htmlspecialchars($_POST['telefon']) ?? '' ?>">
      
      <div class="error">
        <?php echo $errors['telefon'] ?? '' ?>
      </div>

      <label>E-mail: </label>
      <input type="text" name="email"  placeholder="Twój adres mailowy..." value="<?php echo htmlspecialchars($_POST['email']) ?? '' ?>">
      <div class="error">
        <?php echo $errors['email'] ?? '' ?>
      </div>

      <label>Treść wiadomości: </label>

      <textarea name="tresc"  placeholder="Treść wiadomości.." style="height:100px"><?php echo htmlspecialchars($_POST['tresc']) ?? '' ?></textarea>
     
      <div class="error">
        <?php echo $errors['tresc'] ?? '' ?>
      </div>


      <input type="submit" value="Wyślij" name="submit">

      <?php echo $download_button; ?>



    </form>
  </div>

<?php
/// jeżeli bez błędów dodajemy do bazy danych
  if (empty($errors) && $_POST['submit']) {
    include('functions\DbAddNewRecord.php');
  }
?>
</body>

</html>