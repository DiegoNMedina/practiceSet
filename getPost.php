<?php

function getAllPost() {
  return json_decode(file_get_contents('https://newsapi.org/v2/everything?'.'q=Apple&'.'from=2021-08-06&'.'sortBy=popularity&'.'apiKey=66859c79c125489494adf6c60a22b6bb'),true);
}

$result = getAllPost();

?>