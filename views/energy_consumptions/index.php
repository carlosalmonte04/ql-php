<p>Here is a list of all posts:</p>

<?php foreach($energyConsumptions as $energyConsumption) { ?>
  <p>
    <?php echo $energyConsumption->kw; ?>
    <a href='?controller=energy_consumptions&action=show&id=<?php echo $energyConsumption->id; ?>'>See content</a>
  </p>
<?php } ?>