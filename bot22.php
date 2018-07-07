<?php
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
echo json_decode($content, true);
echo 'OK';
