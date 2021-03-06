--TEST--
Test for PHP-798: socketTimeoutMS (non-streams)
--SKIPIF--
<?php require_once "tests/utils/bridge.inc";?>
<?php if (MONGO_STREAMS) { echo "skip This test requires non-stream connections"; } ?>
--FILE--
<?php
require_once "tests/utils/server.inc";

$dsn = MongoShellServer::getBridgeInfo();
$m = new MongoClient($dsn);
$c = $m->selectDB(dbname())->selectCollection("php-798");

try {
	$retval =  $c->insert( array( 'test' => 1 ), array( 'fsync' => true, 'w' => true, 'socketTimeoutMS' => 100 ) );
	var_dump($retval["ok"]);
} catch ( Exception $e ) {
	echo $e->getCode(), "\n";
	echo $e->getMessage(), "\n";
}
?>
--EXPECTF--
80
%s:%d: Timed out waiting for header data
