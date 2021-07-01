<html>
<head>
<title>DDoS Analysis Report</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php
$time_start = microtime(true); //time calcualation
$currentDirectory = getcwd();
$uploadDirectory = "/uploads/";
$errors = []; // Store errors here
$fileExtensionsAllowed = ['csv']; // These will be the only file extensions allowed
$fileName = $_FILES['the_file']['name'];
$fileSize = $_FILES['the_file']['size'];
$fileTmpName = $_FILES['the_file']['tmp_name'];
$fileType = $_FILES['the_file']['type'];
$filext = explode(',', $fileName);
$filext1 = end($filext);
$fileExtension = strtolower($filext1);

$uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);

if (isset($_POST['submit']))
{

    if (!in_array($fileExtension, $fileExtensionsAllowed))
    {
        //$errors[] = "This file extension is not allowed. Please upload a csv file";
        
    }

    if ($fileSize > 15000000)
    {
        $errors[] = "File exceeds maximum size (15MB)";
    }

    if (empty($errors))
    {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload)
        {
            echo "<br><br>The file " . basename($fileName) . " has been uploaded";

            echo "<br><br>FILE DETAILS-<br><br>";
            echo '<pre>';
            print_r("Path           : " . $uploadPath . "<br>");
            echo '</pre>';
            echo '<pre>';
            print_r("File extension : " . $fileExtension . "<br>");
            echo '</pre>';
            echo '<pre>';
            print_r("File type      : " . $fileType . "<br>");
            echo '</pre>';
            echo '<pre>';
            print_r("File temp name : " . $fileTmpName . "<br>");
            echo '</pre>';
            echo '<pre>';
            print_r("File size      : " . round($fileSize * 9.537 * pow(10, -7) , 3) . " MB <br>");
            echo '</pre>';
            echo '<pre>';
            print_r("File name      : " . $fileName . "<br><br>");
            echo '</pre>';

        }
        else
        {
            echo "An error occurred. Please contact the administrator.";
        }
    }
    else
    {
        foreach ($errors as $error)
        {
            //echo $error . "These are the errors" . "\n";
            
        }
    }

}
echo nl2br("\n______________________________________________________________________________________________________\n");
echo '<pre>';
print_r("                                              Scan Results");
echo '</pre>';
echo nl2br("______________________________________________________________________________________________________\n");

function display($d)
{
    echo '<pre>';
    print_r($d);
    echo '</pre>';
}

$count = 100;
$arr = array();
$data_sheet = fopen("E:/xampp/htdocs/ddos/uploads/$fileName", "r");
for ($i = 0;$i < $count && !feof($data_sheet);$i++)
{
    $dd = fgetcsv($data_sheet, 1024);
    $dd['ddos'] = $dd[2] . ',' . $dd[3] . ',' . $dd[4] . ',' . $dd[6] . ',' . $dd[10] . ',' . $dd[11] . ',' . $dd[13];
    array_push($arr, $dd['ddos']);
}
array_shift($arr);

$length = count($arr);
$first = $arr[0];
$count = 1;
for ($i = 1;$i < $length;$i++)
{
    if ($first == $arr[$i])
    {
        $count++;
    }
    else
    {
        ddos($first, $count, $arr);
        $first = $arr[$i];
        $count = 1;
    }
    if ($i == $length - 1)
    {
        ddos($first, $count, $arr);
    }
}

function ddos($ip, $count, $arr)
{
    if ($count >= 3)
    {
        $src_ip = explode(",", $ip);
        echo nl2br("\nSuspicious IP :" . $src_ip[0]);
        $curl = curl_init('http://api.whoapi.com/?apikey=693d83374eeb48e82738f19bf71c4476&r=blacklist&ip=' . $src_ip[0]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        $json = json_decode($output, true);
        $confirm = $json['blacklisted'];
        if ($confirm == 1)
        {
            echo nl2br("\nIP <b>PRESENT</b> in blacklist.\n\n");
        }
        else if ($confirm == 0)
        {
            echo nl2br("\nIP <b>NOT PRESENT</b> in blacklist.\n\n");
        }

    }
}

$time_end = microtime(true);
$execution_time = ($time_end - $time_start);
echo '<br><br><b>Total Execution Time:</b> ' . round($execution_time, 3) . ' Seconds';

?>

</body>
</html>
