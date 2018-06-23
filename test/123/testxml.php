<?
function json_prepare_xml($domNode) {
  foreach($domNode->childNodes as $node) {
    if($node->hasChildNodes()) {
      json_prepare_xml($node);
    } else {
      if($domNode->hasAttributes() && strlen($domNode->nodeValue)){
         $domNode->setAttribute("nodeValue", $node->textContent);
         $node->nodeValue = "";
      }
    }
  }
}

$get = file_get_contents("http://109.234.156.251/prison/universal.php?key=dc35f1a48d03e12e20aa19d1467094a5&user=73820108&method=getInfo");
$xml = simplexml_load_string($get);

$dom = new DOMDocument();
$dom->loadXML($get);
json_prepare_xml($dom);
$sxml = simplexml_load_string( $dom->saveXML() );
$json = json_encode( $sxml );


print_r($json);