<form method="POST" action="<?= $form->encode($_SERVER['PHP_SELF']) ?>">
  <table>
    <?php if($errors) { ?>
      <tr>
        <td>You need to correct the following errors:</td>
        <td><ul>
          <?php foreach($errors as $error) { ?>
            <li>><?= $form->encode($error) ?></li>
          <?php } ?>
        </ul></td>
    <?php } ?>

    <tr>
      <td>料理名：</td>
      <td><?= $form->input('text', ['name' => 'dish_name']) ?></td>
    </tr>

    <tr>
      <td>最低価格：</td>
      <td><?= $form->input('text', ['name' => 'min_price']) ?></td>
    </tr>

    <tr>
      <td>最高価格：</td>
      <td><?= $form->input('text', ['name' => 'max_price']) ?></td>
    </tr>

    <tr>
      <td>辛い料理：</td>
      <td><?= $form->select($GLOBALS['spicy_choices'], ['name' => 'is_spicy']) ?>
      </td>
    </tr>

    <tr>
      <td colspan="2" align="center">
        <?= $form->input('submit', ['name' => 'search', 'value' => 'Search']) ?>
      </td>
    </tr>
  </table>
</form>
