<h1>Data Simulation</h1>
<p>Select the period over which you want simulation data to be generated<p>
<p>The simulation identifies the trips registered in the systems, and the days they are enabled to enter the simulation data.</p>
<form action="<?php echo url_for('nj_data_simulation_new'); ?>" method="POST">
  <?php echo $form['periodo']; ?><br />
  <label for="trip">Trip id:</label>
  <?php echo $form['trip']; ?><br />
  <input type="submit" value="Ok">
</form>