<?php

echo "hi";

function inject_css(string $component) {
    echo `<link rel="stylesheet" href=<?php echo "../styles/$component.php" ?>`;
}

?>