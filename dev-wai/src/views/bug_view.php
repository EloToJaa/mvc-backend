<!DOCTYPE html>
<html lang="pl">

<?php include "includes/head.inc.php"; ?>

<body>
  <?php include "includes/header.inc.php"; ?>
  <section>
  <h1>Poinformuj mnie o Twoim błędzie</h1>
    <form>
      <label for="email">Email:</label>
      <input type="text" id="email" name="email" value="">
      <label for="description">Opisz swój problem:</label><br>
      <textarea id="description" name="description" rows="4"></textarea>
      <fieldset>
        <label for="os">Wybierz system operacyjny</label>
        <select name="os" id="os">
          <option selected="selected">Windows</option>
          <option>MacOS</option>
          <option>Linux</option>
          <option>Android</option>
          <option>iOS</option>
        </select>
        <label for="browser">Wybierz swoją przeglądarkę</label>
        <select name="browser" id="browser">
          <option selected="selected">Chrome</option>
          <option>Firefox</option>
          <option>Safari</option>
          <option>Brave</option>
          <option>Vivaldi</option>
          <option>Opera</option>
          <option>Microsoft Edge</option>
          <option>Internet Explorer</option>
        </select>
        <label for="date">Data wystąpienia błędu</label>
        <input id="date" type="text">
        <label for="severity">Wpływ błędu na działanie strony (1-10)</label>
        <input id="severity" name="value" readonly>
      </fieldset>
      <fieldset id="labels"></fieldset>
      <input type="reset" value="Wyczyść">
      <input type="submit" value="Wyślij">
    </form>
    <div id="preview">
      <h2>Podgląd wysłanej treści</h2>
      <hr>
      <table class="tg">
        <thead>
          <tr>
            <th>Email</th>
            <th>System operacyjny</th>
            <th>Przeglądarka</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td id="email_text"></td>
            <td id="os_text"></td>
            <td id="browser_text"></td>
          </tr>
        </tbody>
      </table>
      <table class="tg">
        <thead>
          <tr>
            <th>Data</th>
            <th>Kategorie</th>
            <th>Wpływ na stronę</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td id="date_text"></td>
            <td id="label_text"></td>
            <td id="severity_text"></td>
          </tr>
        </tbody>
      </table>
      <table class="tg">
        <thead>
          <tr>
            <th>Opis problemu</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td id="description_text"></td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
  <?php include "includes/footer.inc.php"; ?>
</body>

</html>