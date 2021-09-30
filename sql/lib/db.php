<?php
    // Ham trar ve ket noi vowi csdl
    function getDbConnect(){
        $host = "db";
        $dbname = "hoadtp";
        $dbusername="hoadtp";
        $dbpass = "hoadtp";
        return new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$dbusername, $dbpass);
    };
    function executeQuery($sqlQuery, $fetchAll = true){
        $connect = getDbConnect();
        // nạp câu truy vấn vào kết nối
        $stmt = $connect->prepare($sqlQuery);
        
        // thực thi câu truy vấn với csdl
        $stmt->execute();
        
        // thu thập kết quả trả về
        if($fetchAll == true){
            return $stmt->fetchAll();
        }else return $stmt->fetch();
    };

?>