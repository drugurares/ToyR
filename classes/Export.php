<?php class Export
{
private function db_array()
{
    $db=new Dbase();

$products=$db->fetchall("SELECT products.id, products.name, products.description, products.price, products.date, categories.name as category, products.image, products.gender,products.age,products.material,products.stock
FROM products
INNER JOIN categories
ON products.category=categories.id;");
return $products;
}
public function e_json()
{


$products=$this->db_array();
file_put_contents('Rapoarte/Json/raportJSON'.date("Hi_d_M_Y",time()).'.json', json_encode($products, JSON_PRETTY_PRINT));


}
private function array_to_xml($arr, &$out) {
    foreach($arr as $key => $value) {
        if(is_array($value)) {
            if(!is_numeric($key)){
                $subnode = $out->addChild("$key");
                $this->array_to_xml($value, $subnode);
            }
            else{
                $subnode = $out->addChild("product$key");
                $this->array_to_xml($value, $subnode);
            }
        }
        else {
            $out->addChild("$key",htmlspecialchars("$value"));
        }
    }
}


public function e_xml()
{
    $products=$this->db_array();
$xml_products = new SimpleXMLElement("<?xml version=\"1.0\"?><products></products>");



$this->array_to_xml($products,$xml_products);
$xml_products->asXML('Rapoarte/XML/raportXML'.date("Hi_d_M_Y",time()).'.xml');


	
}

private function array_to_Csv($fileName, $assocDataArray)
{
       
    if(isset($assocDataArray['0'])){
        $fp = fopen($fileName, 'w');
        fputcsv($fp, array_keys($assocDataArray['0']));
        foreach($assocDataArray AS $values){
            fputcsv($fp, $values);
        }
        fclose($fp);
    }
    
}
public function e_csv()
{
    $products=$this->db_array();
$this->array_to_Csv('Rapoarte/CSV/raportCSV'.date("Hi_d_M_Y",time()).'.csv',$products);
}

private function array_to_table($array){
    $html = '<table>';
    $html .= '<tr>';
    foreach($array[0] as $key=>$value){
            $html .= '<th>' . $key . '</th>';
        }
    $html .= '</tr>';
    foreach( $array as $key=>$value){
        $html .= '<tr>';
        foreach($value as $key2=>$value2){
            $html .= '<td>' . $value2 . '</td>';
        }
        $html .= '</tr>';
    }
    $html .= '</table>';
    return $html;

}

public function e_html()
{
     $products=$this->db_array();
   file_put_contents('Rapoarte/HTML/raportHTML'.date("Hi_d_M_Y",time()).'.html',   $this->array_to_table($products));
}



public function e_pdf()
{



}



public function rss_xml()
{
$files = glob("admin/Rapoarte/XML/*.xml");
$files = array_combine($files, array_map("filemtime", $files));
arsort($files);

$latest_file = key($files);
$xml1=simplexml_load_file ($latest_file);


$out="<table cellpadding=\"1\" cellspacing=\"1\" border=\"1\" class=\"tbl_insert\" style=\"border:1px solid;\"> ";
$out.="<tr style=\"border:1px solid;\"><td>ID</td><td>Nume</td><td>Descriere</td><td>Price</td><td>Gen</td><td>Material</td><td>Varsta</td><td>Stock</tr>";
foreach($xml1 as $product) { 
    $out.="<tr><td>";
    $out.=$product->id . ")</td><td>"; 
    $out.=$product->name . "</td><td>"; 
    $out.=$product->description . "</td><td>"; 
    $out.=$product->price . "</td><td>";
    $out.=$product->gender . "</td><td>";
    $out.=$product->material . "</td><td>";
    $out.=$product->age . "</td><td>"; 
    $out.=$product->stock . "</td></tr>"; 
}
$out.="</table>";

return $out;
}


}?>