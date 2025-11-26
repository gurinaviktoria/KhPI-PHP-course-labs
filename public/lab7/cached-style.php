<?php
header("Content-Type: text/css");
header("Cache-Control: public, max-age=86400");
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 86400) . " GMT");

echo "
body { 
    background: #f4f4f4; 
    font-family: Arial;
}
h2 {
    color: #333;
}
";
?>
