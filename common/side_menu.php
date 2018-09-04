<div id="side_wrap">
    <div id="side">
        <ul class="side_menu"><a href="book_index.php?favo=1"><span class="attention">お気に入り</span></a></ul>
        <?php foreach ($sideMenu as $key => $value) : ?>
            <ul class="side_menu">
                <li><span class="attention"><?php echo $value['category']; ?></span>
                  	<ul>
	                    <?php foreach ($value['genre'] as $genre) : ?>
	                        <li><a href="book_index.php?category=<?php echo $value['category']; ?>&genre=<?php echo $genre; ?>"><?php echo $genre; ?></a></li>
	                    <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        <?php endforeach; ?>
    </div>
</div>
