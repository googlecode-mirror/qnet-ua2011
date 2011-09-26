<?php
    require_once dirname(__FILE__) . '\..\..\util.php';
    check_session();

echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="qnet.css"/>
<link rel="stylesheet" type="text/css" href="autocomplete.css"/>
<title>Qnet - New Query</title>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="qnet.js"></script>
<script type="text/javascript" src="autocomplete.js"></script>
<script type="text/javascript">
    $(function(){
        $("#searchQuery").autocomplete("bridge.php?target=search/querySuggestionController",{autoFill: true});
    });
    $(function(){
        $("#searchUser").autocomplete("bridge.php?target=search/userSuggestionController",{autoFill: true});
    });
</script>
</head>
';?>
