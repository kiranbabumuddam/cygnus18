<?php

// Basic example of PHP script to handle with jQuery-Tabledit plug-in.
// Note that is just an example. Should take precautions such as filtering the input data.

header('Content-Type: application/json');

$input = filter_input_array(INPUT_POST);

if ($input['action'] === 'edit') {
    mysql_query("UPDATE webteammsg SET reply='" . $input['reply'] . "'  WHERE nid='" . $input['nid'] . "'");
}
/* else if ($input['action'] === 'delete') {
    mysql_query("UPDATE notifications SET visibility=0 WHERE nid='" . $input['nid'] . "'");
} else if ($input['action'] === 'restore') {
    mysql_query("UPDATE notifications SET visibility=1 WHERE nid='" . $input['nid'] . "'");
}*/
echo json_encode($input);
