<div class="Pagination">
  <div class="PageCount">
    [?php echo __('found', null, 'grid') ?] [?php echo  $pager->getNbResults().' '.plural_form($pager->getNbResults(), array(__('nb_results_plural_1', array(), 'grid'), __('nb_results_plural_2', array(), 'grid'), __('nb_results_plural_3', array(), 'grid'))); ?]
    [?php if ($pager->haveToPaginate()): ?]
      [?php echo __('page_nb_pages', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'grid') ?]
    [?php endif; ?]
  </div>
  [?php if ($pager->haveToPaginate()): ?]
    <a class="PageFirst[?php echo $pager->isFirstPage() ? 'Dis' : '' ?]" href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=1"> </a>
    <a class="PagePrev[?php echo $pager->isFirstPage() ? 'Dis' : '' ?]" href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getPreviousPage() ?]"> </a>
    <div class="Pages">
    [?php foreach ($pager->getLinks() as $page): ?]
      [?php if ($page == $pager->getPage()): ?]
        <span>[?php echo $page ?]</span>
      [?php else: ?]
        <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $page ?]">[?php echo $page ?]</a>
      [?php endif; ?]
    [?php endforeach; ?]
    </div>
    <a class="PageNext[?php echo $pager->isLastPage() ? 'Dis' : '' ?]" href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getNextPage() ?]"> </a>
    <a class="PageLast[?php echo $pager->isLastPage() ? 'Dis' : '' ?]" href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getLastPage() ?]"> </a>
  [?php endif ?]
  <div class="clear"> </div>
</div>
