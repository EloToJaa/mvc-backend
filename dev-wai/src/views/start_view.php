<!DOCTYPE html>
<html lang="pl">

<?php include "includes/head.inc.php"; ?>

<body>
  <?php include "includes/header.inc.php"; ?>
  <section>
    <h2>Witaj </h2>
    <p>
      Twoim zadaniem jest zhakowanie formularza logowania. Każda metoda podejścia do tego zadania jest dozwolona w tym
      bruteforce. Poniżej możesz wybrać poziom trudności zadania.
    </p>
    <form>
      <fieldset>
        <label for="difficulty">Wybierz poziom trudności</label>
        <select name="difficulty" id="difficulty">
          <option selected="selected">Łatwy</option>
          <option>Średni</option>
          <option>Trudny</option>
          <option>Bardzo Trudny</option>
        </select>
      </fieldset>
      <input type="submit" value="Rozpocznij">
    </form>
  </section>
  <?php include "includes/footer.inc.php"; ?>
</body>

</html>