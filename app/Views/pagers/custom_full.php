<?php

use CodeIgniter\Pager\PagerRenderer;

/** @var PagerRenderer $pager */

$pager->setSurroundCount(2);
?>

<nav aria-label="Account pagination">
    <ul class="pagination justify-content-center">

        <li class="page-item <?= $pager->getCurrentPageNumber() <= 1 ? 'disabled' : '' ?>">
            <a class="page-link"
               href="<?= $pager->getFirst() ?? '#' ?>"
               aria-label="First">
                <i class="bi bi-chevron-double-left"></i>
            </a>
        </li>

        <li class="page-item <?= $pager->getPreviousPage() ? '' : 'disabled' ?>">
            <a class="page-link"
               href="<?= $pager->getPreviousPage() ?? '#' ?>"
               aria-label="Previous">
                <i class="bi bi-chevron-left"></i>
            </a>
        </li>

        <?php foreach ($pager->links() as $link): ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach; ?>

        <li class="page-item <?= $pager->getNextPage() ? '' : 'disabled' ?>">
            <a class="page-link"
               href="<?= $pager->getNextPage() ?? '#' ?>"
               aria-label="Next">
                <i class="bi bi-chevron-right"></i>
            </a>
        </li>

        <li class="page-item <?= $pager->getCurrentPageNumber() >= $pager->getPageCount() ? 'disabled' : '' ?>">
            <a class="page-link"
               href="<?= $pager->getLast() ?? '#' ?>"
               aria-label="Last">
                <i class="bi bi-chevron-double-right"></i>
            </a>
        </li>

    </ul>
</nav>