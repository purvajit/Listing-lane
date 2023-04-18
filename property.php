fetch me the property by id

<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo ($_SERVER["QUERY_STRING"]);
}
?>