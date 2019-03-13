<div style="margin-top: 20px; margin-left: 20px">
  <?php
  if (!isset($filter_category)) echo '<h4 class="text-info">Filtered by</h4>';
  else echo '<button type="button" class="btn btn-primary" style="margin-bottom: 10px;">
    <a href="/" style="text-decoration : none; color: black">Disable Filter</a></button>';
  ?>
</div>
<div style="width: 75%; float: left; margin-left: 35px; margin-bottom: 30px; padding-top: 20px; padding-left: 20px" class="border border-primary rounded">
<table class="table table-borderless">
  <tbody>
    <?php
    $i = 0;
    foreach ($category_names as $category_name) {
      if ($i / $maxItemsPerLine == 0) echo '<tr>';
      echo '<th scope="col" style="width: 20%"><button type="button" class="btn btn-light">
        <a href="?category=' . $category_name . '"style="text-decoration : none; color: black">'
        . $category_name . '</a></button></th>';
      $i++;
      if (($i - $maxItemsPerLine) / $maxItemsPerLine == 0) echo '</tr>';        
    }?>
  </tbody>
</table>
</div>