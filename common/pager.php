<div class="pager">
  <?php if ($back): ?>
    <a href="book_index.php?page=<?php echo $back; ?>" class="page" id="back">前へ</a>
  <?php endif; ?>

  <?php for ($i=1; $i<=$pageAll; $i++): ?>
    <a href="book_index.php?page=<?php echo $i; ?>" class="page" id="page<?php echo $i; ?>" <?php if ($i == $selectPage): ?>style="background: #CCC;"<?php endif; ?>>
      <?php echo $i; ?>
    </a>
  <?php endfor; ?>

  <?php if ($next <= $pageAll): ?>
    <a href="book_index.php?page=<?php echo $next; ?>" class="page" id="next">次へ</a>
  <?php endif; ?>
</div>
