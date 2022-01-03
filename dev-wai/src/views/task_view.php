<!DOCTYPE html>
<html lang="pl">

<?php include "includes/head.inc.php"; ?>

<body>
  <?php include "includes/header.inc.php"; ?>
  <section>
    <h1>Formularz logowania</h1>
    <h2>Ilość nieudanych prób: <span id="failures">0</span></h2>
    <form>
      <label for="login">Login:</label>
      <input type="text" id="login" name="login" value="">
      <label for="password">Hasło:</label>
      <input type="password" id="password" name="password" value="">
      <div id="show_password">
        <label for="checkbox1" id="show_password_label">Pokaż hasło:</label>
        <input type="checkbox" id="checkbox1" />
      </div>
      <input id="submitBtn" type="submit" value="Zaloguj">
    </form>
    <input id="helpBtn" type="submit" value="Potrzebuję pomocy">
    <div id="help_dialog" title="Witaj">
      <p>
        Twoim zadaniem jest zhakowanie formularza logowania. Każda metoda podejścia do tego zadania jest dozwolona w tym
        bruteforce. Poniżej możesz wybrać poziom trudności zadania.
      </p>
    </div>
    <div id="success_dialog" title="Gratulacje"></div>
  </section>
  <?php include "includes/footer.inc.php"; ?>
</body>

</html>