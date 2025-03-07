<html>
    <body>
    <div>
  <?php
  include("connecto.php");
  $insertToken="";
  $docType=["wi","dmc","par","ps","fic","cp","dcior","md","diaor"];
  $date=date('m/d/Y');
  
  $insertToken="INVENTORY";
  foreach ($docType as $rows){
    $dir=sprintf('%s/files/'.$rows,__DIR__);
    echo $dir;
    if (is_dir($dir) && $handle = opendir($dir)) {
      while (($entry = readdir($handle)) !== false) {
        if($entry !="." && $entry !=".." && str_contains($entry,".pdf") && str_contains($entry,"f-")){
          $division="";
  $customer="";
  $cNew="*";
  $custShort="";
  $partNo="";
  $pNew="";
  $itemKey="";
  $lineNo="";
  $lineLeader="";
  $fileName="";
  $fileType="";
        echo "<br>FILE FOUND:",$entry,"<br>";
        $explode=explode(" ",$entry);
        $explode2=explode("-",$explode[0]);
        print "<pre>";
        echo print_r($explode);
        $itemKey=$explode[0];
        echo print_r($explode2);
        print "</pre>";
        $custShort=$explode2[1];
        $partNo=$explode[1];
        $sql="SELECT * FROM `division`";
        $result=mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result)){
          $cNew="";
          $cust=json_decode($row['customers'],true);
          if(!empty($cust)){
            foreach($cust as $key=>$value){
              if($custShort==$key){
                $cNew="";
                $customer=$value;
                $division=$row['divisionName'];
                break;
              }
              if($customer==""){
                $cNew="*";
              }
            }
            
          }
        }
        
        $sql="SELECT * FROM `parts`";
        $result=mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result)){
          $pNew="";
          $qPartNo=trim($partNo);
          $fPartNo=trim($row['partNo']);
          if(str_contains($qPartNo,$fPartNo)){
            $partNo=$qPartNo;
            break;
          }else{
            $pNew="*";
          }    
        }
        $changes="";
        if($cNew=="*" && $customer==""){
          $customer=$custShort;
          $sql="INSERT INTO `customer`(`customerName`,`customerShort`,`dateAdded`) VALUES('".$customer."','".$custShort."','".$date."')";
          $result=mysqli_query($conn,$sql);
          if($result){
            $changes.="CUSTOMER TABLE UPDATED<br>";
          }
          $sql="SELECT * FROM `division` WHERE divisionName='UNASSIGNED'";
          $result=mysqli_query($conn,$sql);
          if($result){
            $row=mysqli_fetch_assoc($result);
            $custF=json_decode($row['customers'],true);
            $custF[$custShort]=$custShort;
            $json=json_encode($custF);
            $sql = "UPDATE `division` SET `customers` = '".$json."', `dateAdded`='".$date."' WHERE `divisionName` = 'UNASSIGNED'";
            $result = mysqli_query($conn, $sql);
            if($result){
              $changes.="DIVISION TABLE UPDATED<br>";
            }
          } 
        }
        if($pNew=="*"){
          $sql="INSERT INTO `parts`(`partNo`,`dateAdded`) VALUES('".$partNo."','".$date."')";
          $result=mysqli_query($conn,$sql);
          if($result){
            $changes.="PART TABLE UPDATED<br>";
          }
        }
        if($division==""){
          $division="UNASSIGNED";
        }
        echo "--------------------<br>";
        echo "PARAMETERS:<br>";
        echo "--------------------<br>";
        echo "CUSTOMER:",$cNew," ",$customer,"<br>DIVISION: ",$division,"<br>PART:",$pNew,"",$partNo,"<br>ITEM KEY: ",$itemKey,"<br>FILE NAME: ",$entry,"<br>FILETYPE: ",$rows,"<br>";
        echo "--------------------<br>";
        if($changes!=""){
          echo $changes,"<br>";
        }
        $sql="SELECT * FROM `files` WHERE fileName='".$entry."'";
        $results=mysqli_query($conn,$sql);
        if(mysqli_num_rows($results)==0){
          $sql="INSERT INTO `files`(`division`, `customer`, `partNo`, `itemKey`, `lineNo`, `lineLeader`, `fileName`, `fileType`, `dateAdded`) VALUES ('".$division."','".$customer."','".$partNo."','".$itemKey."','".$lineNo."','".$lineLeader."','".$entry."','".$rows."','".$date."')";
          $go=mysqli_query($conn,$sql);
          if($go){
            echo "FILE UPLOADED<br>";
          }
        }
      }
   }
  }
  closedir($handle);
  echo "<br>rechecking files:<br>";
  $sql="SELECT * FROM `files` WHERE `fileType`='".$rows."'";
   $result=mysqli_query($conn,$sql);
   if($err=mysqli_error($conn)){
    echo $err,"<br>";
   }
   $filecount=0;
   while($q=mysqli_fetch_assoc($result)){
    $filecount++;
    echo $q['fileName'];
    $path=$dir."/".trim($q['fileName']);
    if(file_exists($path)){
      echo "<br>YES.<br>";
    }else{
      echo "<br>REMOVING. ".$q['fileName']."<br>";
      $sql="DELETE FROM `files` WHERE `fileName`='".$q['fileName']."'";
      $res=mysqli_query($conn,$sql);
      if($err=mysqli_error($conn)){
        echo "ERROR ",$er,"<br>";
      }
    }
   }
   if($filecount==0){
    echo "EMPTY<br>";
   }
   

}

  
   
   
  ?>
</div>
</body>


</html>