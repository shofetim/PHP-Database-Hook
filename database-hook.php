<?php

//------------------------------------------------
//         Add your settings here
$config = array(
                'name' => '',
                'user' => '',
                'host' => 'localhost',
                'password' => '',
                );

//------------------------------------------------

//Connect
mysql_connect($config['host'], $config['user'], $config['password']);
mysql_select_db($config['name']);

//Get Queries
$data = mysql_query(@$_GET['q']);

?>

<form action="" method="GET">
  <input tabindex="1" name="q" type="text" size="150" value="<?php echo $_GET['q']; ?>"/>
  <input type="submit" value="query" />
</form>

<script type="text/javascript">
 document.forms[0].elements[0].focus();
</script>

<?php
echo '<table border="1">';

$headerRow = true;
$counter = 0;
//Table body
while (($row = @mysql_fetch_assoc($data)) && $counter < 100) {
  $counter++;
  if ($counter == 99) {
    echo  '<script type="text/javascript">';
    echo 'alert("Results truncated, too many rows")';
    echo '</script>';
  }
  echo '<tr>';
  foreach ($row as $header => $field) {
    if ($headerRow) {
    echo '<th>' . $header . '</th>';
    } else {
    echo '<td>' . $field . '</td>';
    }
  }
  $headerRow = false;
  echo '<tr>';
 }

echo '</table>';

?>