<?php

class HTML {

    public static function selected($var1, $var2) {
        return ($var1 == $var2) ? 'selected="selected"' : '';
    }
    public static function active($var1, $var2){
        return ($var1 == $var2) ? 'active' : '';
    }

    public static function pageNavHelper($pageCount, $page, $path) {
        ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php for($i = 1; $i <= $pageCount; $i++): ?>
                <li class="page-item <?= HTML::active($i, $page)?>"><a class="page-link" href="<?= $path; ?>&page=<?= $i; ?>"><?= $i; ?></a></li>
                <?php endfor; ?>
            </ul>
        </nav>
        <?php
    }

}
