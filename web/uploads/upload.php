
<?php

error_reporting(0);
ini_set('memory_limit','1000M');
header('Content-Type: text/html; charset=utf-8');
$target_dir = "uploads/";
$target_dir=dirname(__FILE__) . "/uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
if($imageFileType!='zip')
{
    echo 'not a zip file';
}
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    /*$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }*/
}
// Check if file already exists
if (file_exists($target_file)) {
   // echo "Sorry, file already exists.";
    $uploadOk = 1;
}
// Check file size
if ($_FILES["file"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
/*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}*/
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES['file']['tmp_name'],$target_dir. $_FILES["file"]['name'])) {
     //  echo "The file ".$target_dir. basename( $_FILES["file"]["name"]). " has been uploaded.";
        $zip = new ZipArchive();
        $x = $zip->open($target_dir.basename( $_FILES["file"]["name"]));
      if ($x === true) {
          $zip->extractTo(str_replace(".zip","",$target_dir.basename( $_FILES["file"]["name"])));
          $mainDir=$target_dir.'folder';
          $zip->extractTo($mainDir);
          $zip->close();
          $path=str_replace(".zip","",$mainDir.'/'.basename( $_FILES["file"]["name"]));

            unlink($target_dir.basename( $_FILES["file"]["name"]));
            $files2 = scandir($path, 1);
         //   echo json_encode($files2);
        }

       echo  $path;


    } else {
       // echo "The file ". $target_dir.basename( $_FILES["file"]["name"]). " cannot be uploaded.";
    }
}
?>

<?php
$nowDate=new DateTime();
$nowDateFormat=$nowDate->format('Ymd');
$uploadTime=$nowDate->format('Y-m-d H:i:s');
$docYear=$nowDate->format('Y');
$uploadBy='test';
$servername = "localhost";
$username = "root";
$password = "Manifold1@@";

$db = new mysqli($servername, $username, $password, 'intagedb');
$conn = $db->stmt_init();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    try{
   // echo sizeof($files2);
    for($i=0;$i<sizeof($files2);$i++)
    {


            $title=$files2[$i];
            $fileType = pathinfo($title,PATHINFO_EXTENSION);

           // throw new Exception($title);
            //if($fileType=='pdf')
           // {



                  //  echo $docYearEmp;
        $fileName=str_replace(".pdf","",$title);
        $empCode=$fileName;
        $docYearEmp=$nowDateFormat.$empCode;
        $uploadLocation=$path.'/'.$title;


                 $stmt=$db->prepare(
                    "insert into intagedb.T_Upload
                      (T_Upload.docYearEmp,
                      T_Upload.docYear,
                      T_Upload.empCode,
                      T_Upload.fileName,
                      T_Upload.uploadLocation,
                      T_Upload.uploadLoadBy,
                      T_Upload.uploadTime)
                      values(?,?,?,?,?,?,?)"
                );

                $stmt->bind_param('sisssss',$docYearEmp,$docYear,$empCode,$fileName,$uploadLocation,$uploadBy,$uploadTime);
                $stmt->execute();
                //throw new Exception($docYearEmp.'/'.$docYear.'/'.$empCode.'/'.$fileName.'/'.$uploadLocation.'/'.$uploadBy.'/'.$uploadTime);
               set_error_handler("exception_error_handler");





         //  }else{
             //  throw new Exception('/pdf');

          //  }






    }
     }catch (Exception $e)
        {
            echo $e->getMessage();

        }
    $db->close();

}

?>
<?php
function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}
?>


