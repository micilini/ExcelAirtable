<?php

//API simples de envio de dados para a API do Airtable (Via CURL)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		 
$dados = $_POST;
unset($dados['nometabelabase']);
unset($dados['codigotabelabase']);
unset($dados['auth']);

$datas = array();

$datas['fields'] = $dados;

$authString = 'Authorization: Bearer '.$_POST['auth'];

echo $authString;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://api.airtable.com/v0/".rawurlencode($_POST['codigotabelabase'])."/".rawurlencode($_POST['nometabelabase']));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    $authString,
    'Content-Type: application/json'
));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datas));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close ($ch);

echo $server_output;
		 
}else{
	echo 'API do AirTable feita em PHP...';
}

?>

<!-- <!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>API with Javascript</title>
<script src="./airtable.js-master/build/airtable.browser.js"></script>
</head>

<body>
<script>


var Airtable = require('airtable');
Airtable.configure({
    endpointUrl: 'https://api.airtable.com',
    apiKey: 'KEY HERE'
});
var base = Airtable.base('BASE CODE HERE');

base('TABLE NAME HERE').create({"nome": "Will"}, function(err, record) {
  if (err) {
    console.error(err);
    return;
  }
  console.log(record.getId());
});
</script>
</body>

</html> -->
