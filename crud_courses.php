<?php
include("config/db.php");
include("cmd/exec.php");

$db = new Database();
$str_conn = $db->getConnection();
$str_exe = new ExecSQL($str_conn);
$action= $_GET['cmd'];
switch($action){
    case 'select':
    $stmt = $str_exe->readAll("courses");
    $data_arr['rs'] = array();
        foreach($stmt as $row ){
            $item = array(
                'name'=>$row['name'],
                'speaker_name'=>$row['speaker_name'],
                'img_path'=> $row['img_path'],
                'detail'=> $row['detail'],
                'course_outline'=> $row['course_outline'],
                'date_open'=> $row['date_open'],
                'date_end'=> $row['date_end'],
                'place'=> $row['place'],
                'seat_num'=> $row['seat_num'],
                'cost'=> $row['cost'],
                'comment'=> $row['comment'],
                'count_view_page'=> $row['count_view_page'],
                'status'=> $row['status']
            );
            array_push($data_arr['rs'],$item);
        }
        echo json_encode($data_arr);    
    break;
  
    case 'insert':
    $strName = $_GET['name'];
    $strSPKName = $_GET['speaker_name'];
    $strImg = $_GET['img_path'];
    $strDetail = $_GET['detail'];
    $strCoursesOut = $_GET['course_outline'];
    $strDOpen = $_GET['date_open'];
    $strDEnd = $_GET['date_end'];
    $strPlace = $_GET['place'];
    $strSeat = $_GET['seat_num'];
    $strCost = $_GET['cost'];
    $strComment = $_GET['comment'];
    $strCountView = $_GET['count_view_page'];
    $strStatus = $_GET['status'];
    $strSQL = $str_exe->insert("courses"," name ,speaker_name ,img_path ,detail ,course_outline ,date_open ,
                                date_end ,place ,seat_num ,cost ,comment ,count_view_page ,status  ",
                                " '".$strName."','".$strSPKName."','". $strImg."','".$strDetail."','".$strCoursesOut."','".$strDOpen."',
                                '".$strDEnd."','".$strPlace."','".$strSeat."','".$strCost."','".$strComment."','".$strCountView."','".$strStatus."', ");   
    if($strSQL){
        echo json_encode(array('msg'=>'บันทึกข้อมูลเรีบยร้อยแล้ว'));
    }else{
        echo json_encode(array('msg'=>'ไม่สามารถบันทึกข้อมูลได้'));
    }
    break;

    case 'delete':
    $str_id = $_GET['id'];
    $strSQL = $str_exe->delete("courses","WHERE id =".$str_id);
    if($strSQL){
        echo json_encode(array('msg'=>'ลบข้อมูลเรีบยร้อยแล้ว'));
    }else{
        echo json_encode(array('msg'=>'ไม่สามารถลบข้อมูลได้'));
    }
    break;

    case 'update':
    $srtId = $_GET['code'];
    $strName = $_GET['name'];
    $strSPKName = $_GET['speaker_name'];
    $strImg = $_GET['img_path'];
    $strDetail = $_GET['detail'];
    $strCoursesOut = $_GET['course_outline'];
    $strDOpen = $_GET['date_open'];
    $strDEnd = $_GET['date_end'];
    $strPlace = $_GET['place'];
    $strSeat = $_GET['seat_num'];
    $strCost = $_GET['cost'];
    $strComment = $_GET['comment'];
    $strCountView = $_GET['count_view_page'];
    $strStatus = $_GET['status'];
    $strSQL = $str_exe->update("courses ","SET name = '$strName',speaker_name = '$strSPKName',img_path = '$strImg',
                                detail = '$strDetail',course_outline = '$strCoursesOut',date_open = '$strDOpen',date_end = '$strDEnd',
                                place = '$strPlace',seat_num = '$strSeat',cost = '$strCost',comment = '$strComment',
                                count_view_page = '$strCountView',status = '$strStatus' WHERE id = $srtId");
    if($strSQL){
        echo json_encode(array('msg'=>'แก้ไขข้อมูลเรีบยร้อยแล้ว'));
    }else{
        echo json_encode(array('msg'=>'ไม่สามารถแก้ไขข้อมูลได้'));
    }
    break;
}


?>