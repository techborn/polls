<?php

$this->require_acl ('admin', 'polls');

$page->layout = 'admin';
$page->title = __ ('Polls');

require_once ('apps/polls/lib/Functions.php');

$limit = 15;
$num = is_numeric($_GET['page']) ? $_GET['page'] : 0; // from the URL, e.g. /myapp/handler/#
$offset = $num * $limit;

$items = polls\Poll::query()
	->order('edited','desc')
	->fetch($limit, $offset);
$items = $items ? $items : array();

$data = array (
	'limit' => $limit,
	'total' => polls\Poll::query()->count(),
	'items' => $items,
	'count' => count ($items),
	'url' => '/polls/admin?page=%d'
);

echo View::render ('polls/admin', $data);

?>
