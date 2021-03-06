--TEST--
modifying child object indirectly sets dirty flag
--SKIPIF--
<?php if (!extension_loaded("doctrine")) print "skip"; ?>
--FILE--
<?php 
class Foo {
	public $foo = 'foo';
	public $obj;
}

function ec($m) { echo "$m\n"; }
function dc($o) { ec(doctrine\is_dirty($o) ? 'true' : 'false'); }
$foo = new Foo;
$foo->obj = new Foo;
doctrine\instrument_object($foo);
dc($foo);
$obj = $foo->obj;
$obj->foo = 'bar';
dc($foo);
--EXPECT--
false
true