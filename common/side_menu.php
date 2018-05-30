<div class="side-menu fl-l">
  <?php foreach ($sideMenu as $key => $value) : ?>
    <label for="Panel<?php echo $key; ?>" style="background: <?php echo $color; ?>;"><?php echo $value['category']; ?></label>
    <input type="checkbox" id="Panel<?php echo $key; ?>" class="on-off" />
    <ul>
      <?php foreach ($value['genre'] as $genre) : ?>
        <li><a href="book_index.php?category=<?php echo $value['category']; ?>&genre=<?php echo $genre; ?>"><?php echo $genre; ?></a></li>
      <?php endforeach; ?>
    </ul>
  <?php endforeach; ?>
</div>
