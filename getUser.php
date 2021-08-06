<?php

function getRandomUser() {
    $name = json_decode(file_get_contents('https://randomuser.me/api/'),true);
    return $name;
}
?>