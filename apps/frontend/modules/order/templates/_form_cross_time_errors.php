<div class="CrossTimeErrors">
  Следующие позиции уже заняты в это время:
  <ol>
    <?php foreach ($crossTimeItems as $item): ?>
      <li><?php echo sfOutputEscaper::unescape($item) ?></li>
    <?php endforeach ?>
  </ol>
</div>