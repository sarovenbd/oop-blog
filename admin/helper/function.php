<?php


function validate($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function gotoUrl($url) {
echo "<script type='text/javascript'>
window.location.href = '$url';
</script>";
}


 ?>
