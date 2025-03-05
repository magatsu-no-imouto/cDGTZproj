<html>
    <body>
    <div>
  <?php
  include("connecto.php");
  $insertToken="";
  $docType=["wi","dmc","par","ps","fic","cp","dcior","md","diaor"];
  $date=date('m/d/Y');
  foreach ($docType as $rows){
    echo $rows,"<br>";
    $dir=sprintf('%s/files/'.$rows,__DIR__);
    if ($handle = opendir($dir)) {
      while (false !== ($entry = readdir($handle))) {
        $insertToken="INVENTORY";
        if (str_contains($entry,".pdf")) {
            echo "<br>looking for:",$entry,"<br>";
            $dbVar=explode("-",$entry);
            print "<pre>";
                echo print_r($dbVar);
            print "</pre>";
            $iKey="";
            $partNo="";
            $custShort="";
            $customer="";
            if(count($dbVar)>=4){
                $iKey=substr($dbVar[2],4);
                $partNo=str_replace($iKey,"",$dbVar[2]);
                echo "item key:",$iKey,"<br>part Number:",$partNo,"<br>";
                #here, we assign the variables for stuff into the db.
                $custShort=$dbVar[1];
                $sql="SELECT * FROM `customer` WHERE customerShort='".$custShort."'";
                $result=mysqli_query($conn,$sql);
                if($item=mysqli_fetch_assoc($result)){
                $customer=$item['customerName'];
                echo "located:",$customer,"<br>";
                echo "located:",$custShort,"<br>";
                }else{
                echo "INSERTING";
                $sql="INSERT INTO `customer` (`customerName`,`customerShort`,`dateAdded`) VALUES ('".$custShort."','".$custShort."','".$date."')";
                $result=mysqli_query($conn,$sql);
                if($result){
                    echo "new CUSTOMER inserted";
                }
                }
                $sql="SELECT * FROM `parts` WHERE partNo='".$partNo."'";
                $result=mysqli_query($conn,$sql);
                if($item=mysqli_fetch_assoc($result)){
                    echo "located: ",$item['partNo'],"<br>";
                }else{
                    echo "INSERTING";
                    $sql="INSERT INTO `parts`(`partNo`, `dateAdded`) VALUES('".$partNo."','".$date."')";
                    $result=mysqli_query($conn,$sql);
                    if($result){
                        echo "  new PART inserted";
                    }
                }
            }
          $ext=substr($entry,strpos($entry,".pdf"));
          $candidate=str_replace($ext,"",$entry);
          echo $candidate,"<br>";
          $sql="SELECT * FROM files WHERE fileName='".$candidate."'";
          $result=mysqli_query($conn,$sql);
          if($c=mysqli_fetch_assoc($result)){
            $insertToken="FILE EXISTS <br>";
          }
          echo $insertToken,"<br>";
          if($insertToken=="INVENTORY"){
            $sql="INSERT INTO `files` (`division`, `customer`, `partNo`, `itemKey`, `lineNo`, `lineLeader`, `fileName`, `filetype`,`dateAdded`) VALUES ('','".$customer."','".$partNo."','".$iKey."','','','".$candidate."','".$rows."','".$date."')";
            echo $sql,"<br>";
            $result=mysqli_query($conn,$sql);
            if($result){
                echo "PLEASE<br>";
            }else{
                echo "ERROR: " . mysqli_error($conn);
            }
          }
        }
      }
    closedir($handle);
   }
  }
  
   
  ?>
</div>
    </body>


</html>