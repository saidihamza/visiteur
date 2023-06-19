<?php
 include('includes/dbconnection.php');

 $query = "SELECT * FROM user ORDER BY user_id  asc";
 $result = mysqli_query($con, $query);
  if(mysqli_num_rows($result) > 0)
  {
  @$export .= '
  <table> 
  <tr style="background-color: coral;  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  border: 1px solid #ddd;
 
  color: white;"> 
  
  <th>Nom et prénom</th> 
  <th>Email</th>  
  <th>Télephone </th>
  <th>niveau</th> 
  <th>Region</th> 
  <th>Pays</th> 
  <th>Date</th> 
  <th>source</th> 
 
 
  </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
  $export .= '
  <tr>
  <td style="border: 1px solid #ddd;
  padding: 8px;">'.$row['user_full_name'].'</td> 
  <td style="border: 1px solid #ddd;
  padding: 8px;">'.$row['user_email'].'</td> 
  <td style="border: 1px solid #ddd;
  padding: 8px;">'.$row['user_whatsup'].'</td> 
  <td style="border: 1px solid #ddd;
  padding: 8px;">'.$row['user_niveau'].'</td> 
  <td style="border: 1px solid #ddd;
  padding: 8px;">'.$row['user_region'].'</td> 
  <td style="border: 1px solid #ddd;
  padding: 8px;">'.$row['user_country'].'</td> 
     
  <td style="border: 1px solid #ddd;
  padding: 8px;">'.$row['Date_Creation'].'</td> 
  <td style="border: 1px solid #ddd;
  padding: 8px;">'.$row['user_url'].'</td> 
  
  </tr>
  ';
  }
  $export .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=info.xls');
  echo $export;
 
 }