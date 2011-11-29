<?php
$select = new sfWidgetFormSelect(array('choices' => $buses)); 
$result = $select->render('buses_from_route'); 

echo json_encode(array('buses' => $result));