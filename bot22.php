<?php
// Get POST body content
$content = 'eyJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2FjY2Vzcy5saW5lLm1lIiwic3ViIjoiVTI2MGMzYzY0M2Q5MjBiOGUwN2UwZjNkOGI4ODdlMzBhIiwiYXVkIjoiMTU5MjU4MDAxMiIsImV4cCI6MTUzMDk4ODcxOSwiaWF0IjoxNTMwOTg1MTE5LCJub25jZSI6IkZsWFZtY2hJS2c0bWVhQUVWaERsTENydERBd252bzdxcTAtYzVZWTZpMkUiLCJuYW1lIjoiaVNlciIsInBpY3R1cmUiOiJodHRwczovL3Byb2ZpbGUubGluZS1zY2RuLm5ldC8waGlCTkZORG05Tm0xelB4c2gzanBKT2s5Nk9BQUVFVEFsQ3dweEExTV9ZRnBhWEhjNVNGdDlEUVUzYWc4S0RYTTdSbGh4WDFRX2FnMWYifQ.Oj0oA1fdqOez5-pAvSX2LGFH2tEiWp458RfRlGkg46c';
// Parse JSON
$key = explode(".",$content);
$events = json_decode($key[0], true);
var_dump($events);
echo 'OK';
