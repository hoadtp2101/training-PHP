<?php 

class ExerciseString
{
    public $check1;
    public $check2;

    public function readFile($file)
    {
        $file1 = fopen($file, "r");        
        return $str1 = fread($file1,filesize($file));       
        fclose($file1);
    }

    public function checkValidString($str)
    {
        $kt1 = strpos($str, "book");
        $kt2 = strpos($str, "restaurant");
        if (($kt1 !== false && $kt2 !== false) || ($kt1 === false && $kt2 === false)) {
            return false;
        }
        return true;
    }

    public function writeFile($check1, $check2, $n)
    {
        $file1 = fopen("result_file.txt", "w+");

        if ($check1 == true) {
            $content1 = "check1 là chuỗi Hợp lệ";
        }else $content1 = "check1 là chuỗi Không hợp lệ";
        
        if ($check2 == true) {
            $content2 = "\ncheck2 là chuỗi Hợp lệ. Chuỗi có " . $n . " câu";
        }else $content2 = "\ncheck2 là chuỗi Không hợp lệ. Chuỗi có " . $n . " câu";

        $content = $content1 . $content2;
        fwrite($file1, $content);
        fclose($file1);
    }
}

$object1 = new ExerciseString;
$r1 = $object1->readFile("file1.txt");
$object1->$check1 =  $object1->checkValidString($r1);

$r2 = $object1->readFile("file2.txt");
$object1->$check2 =  $object1->checkValidString($r2);
$n = substr_count($r2, ".");

$object1->writeFile($check1, $check2, $n);
?>