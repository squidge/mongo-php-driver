--TEST--
Test for PHP-1155: Revert to default_socket_timeout if socketTimeoutMS is zero (custom connectTimeoutMS)
--SKIPIF--
<?php require_once "tests/utils/standalone.inc" ?>
<?php if (!version_compare(phpversion(), "5.3", '>=')) echo "skip >= PHP 5.3 needed\n"; ?>
<?php if (!MONGO_STREAMS) { echo "skip This test requires streams support"; } ?>
--FILE--
<?php
require_once "tests/utils/server.inc";

printLogs(MongoLog::CON, MongoLog::FINE, "/timeout/");

$host = MongoShellServer::getStandaloneInfo();
$mc = new MongoClient($host, array('connectTimeoutMS' => 5000, 'socketTimeoutMS' => 0));
echo "Connected\n";

// Not necessary to re-test queries (already covered by bug01155-1.phpt)

?>
===DONE===
<?php exit(0); ?>
--EXPECTF--
Connecting to tcp://%s:%d (%s:%d;-;.;%d) with connection timeout: 5.000000
Setting the stream timeout to 5.000000
Stream timeout will be reverted to default_socket_timeout (60)
Now setting stream timeout back to 60.000000
Setting the stream timeout to 5.000000
Stream timeout will be reverted to default_socket_timeout (60)
Now setting stream timeout back to 60.000000
Setting the stream timeout to 5.000000
Stream timeout will be reverted to default_socket_timeout (60)
Now setting stream timeout back to 60.000000
Setting the stream timeout to 5.000000
Stream timeout will be reverted to default_socket_timeout (60)
Now setting stream timeout back to 60.000000
Setting the stream timeout to 5.000000
Stream timeout will be reverted to default_socket_timeout (60)
Now setting stream timeout back to 60.000000
Setting the stream timeout to 5.000000
Stream timeout will be reverted to default_socket_timeout (60)
Now setting stream timeout back to 60.000000
Connected
===DONE===
