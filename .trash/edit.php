<?php

if(!objecttype($_GET['id']))
	die('no object');

if(!in_array($_GET['action'], $object_action))
	$_GET['action']='view';

$id = $_GET['id'];
$type = objecttype($id);
if(!$_GET['action']=='create')
	$type = subtype($type);

if(!$type)
	die('unknown type');

$obj = getobject($id);
if(!$obj)
	die('no such object');

if(!rights($type,$_GET['action'],$obj['rights']))
	die('no rights');

require_once("lib/$type.php");

if($_GET['action']=='create'){
	if(count($_POST)){
		$obj = takepost();
		if(!$obj)
			die('bad post');
		$id=newobjectid($id);
		putobject($id, $obj);
		goto("/btshow/index.php?id=$id");
	}else{
		require_once('header.php');
		postform();
		require_once('footer.php');
	}
}elseif($_GET['action']=='edit'){
	if(count($_POST)){
		$obj = takepost($obj);
		if(!$obj)
			die('bad post');
		putobject($id, $obj);
		goto("/btshow/index.php?id=$id");
	}else{
		require_once('header.php');
		postform($obj);
		require_once('footer.php');
	}
}elseif($_GET['action']=='delete'){
	$obj['rights']['delete']['user'] = $userid;
	putobject($id, $obj);
	$parent = getparent($id);
	goto("/btshow/index.php?id=$parent");
}elseif($_GET['action']=='undelete'){
	unset($obj['rights']['delete']);
	putobject($id, $obj);
	goto("/btshow/index.php?id=$id");
}elseif($_GET['action']=='view'){
	require_once('header.php');
	view($obj);
	require_once('footer.php');
}

action_log($_GET['action'],$id);
