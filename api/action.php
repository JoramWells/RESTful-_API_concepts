
<?php

//action.php

$connect = new PDO("mysql:host=localhost;dbname=vuedb", "root", "JoramWells18");
$received_data = json_decode(file_get_contents("php://input"));
$data = array();
if($received_data->action == 'fetchall')
{
 $query = "
 SELECT * FROM contacts 
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 while($row = $statement->fetch(PDO::FETCH_ASSOC))
 {
  $data[] = $row;
 }
 echo json_encode($data);
}
if($received_data->action == 'insert')
{
 $data = array(
  ':name' => $received_data->name,
  ':email' => $received_data->email
 );

 $query = "
 INSERT INTO contacts 
 (name, email) 
 VALUES (:name, :email)
 ";

 $statement = $connect->prepare($query);

 $statement->execute($data);

 $output = array(
  'message' => 'Data Inserted'
 );

 echo json_encode($output);
}
if($received_data->action == 'fetchSingle')
{
 $query = "
 SELECT * FROM contacts 
 WHERE id = '".$received_data->id."'
 ";

 $statement = $connect->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();

 foreach($result as $row)
 {
  $data['id'] = $row['id'];
  $data['name'] = $row['name'];
  $data['email'] = $row['email'];
 }

 echo json_encode($data);
}
if($received_data->action == 'update')
{
 $data = array(
  ':name' => $received_data->name,
  ':email' => $received_data->email,
  ':id'   => $received_data->hiddenId
 );

 $query = "
 UPDATE contacts 
 SET name = :name, 
 email = :email 
 WHERE id = :id
 ";

 $statement = $connect->prepare($query);

 $statement->execute($data);

 $output = array(
  'message' => 'Data Updated'
 );

 echo json_encode($output);
}

if($received_data->action == 'delete')
{
 $query = "
 DELETE FROM contacts 
 WHERE id = '".$received_data->id."'
 ";

 $statement = $connect->prepare($query);

 $statement->execute();

 $output = array(
  'message' => 'Data Deleted'
 );

 echo json_encode($output);
}

?>
