<?php

// You need to add server side validation and better error handling here
ini_set('display_error', '1');
error_reporting(E_ALL);
$data = '';
$rec = '';
$types = '';
$table = 'upload_record';
if (isset($_GET['files'])) {
    if ($_GET['files'] == 'image') {
        $types = 'image';
    } else if ($_GET['files'] == 'video') {
        $types = 'video';
    } else {
        $types = 'image';
    }
    $error = false;
    $files = array();
    include 'config.php';

    $uploaddir = 'uploads/';
    foreach ($_FILES as $file) {
        $filename = time() . $file['name'];
        if (move_uploaded_file($file['tmp_name'], $uploaddir . basename($filename))) {
            $files[] = $uploaddir . $file['name'];
            $insert = array(
                'hashtag' => $_REQUEST['tag'],
                $types => $filename,
                'datetime' => time(),
                'status' => 1
            );
            $result = insertData($table, $insert);
        } else {
            $error = true;
        }
    }
    $query = "SELECT * FROM " . $table . " WHERE hashtag LIKE '%".$_REQUEST['tag']."%' AND status = 1 ORDER BY datetime DESC";
    $result = executeQuery($query);
    $data = '<div id="items" class="row-fluid">';
    foreach ($result as $record) {
        if ($record['image'] != '') {
            $rec = baseURL . 'uploads/' . $record['image'];
            $rec = '<a class="image" title="Title" href="javascript:void(0);">
                                    <img alt="" src="' . $rec . '">
                                </a>';
        }
        if ($record['video'] != '') {
            $rec = baseURL . 'uploads/' . $record['video'];
            $rec = '<video class="player_name" controls width="100%">
                    <source type="video/mp4" src="'.$rec.'">
                    <source type="video/ogg" src="'.$rec.'">
                        <source src="'.$rec.'" type="video/webm;" />
                    <track kind="subtitles" srclang="en" src="'.$rec.'t"> 
                    <track kind="subtitles" srclang="ru" src="'.$rec.'"> 
                   </video>';
        }
        if ($record['text'] != '') {
            $rec = $record['text'];
            $rec = '<div class="item-content"><div class="">' . $rec . '</div></div>';
        }
        $data .= '<div class=" item masonry-brick">
                            <div class="picture">
                             ' . $rec . '   
                             </div>
                        </div>';
    }
    $data .= '</div>';
} else if (isset($_GET['text'])) {
    include 'config.php';
    $insert = array(
        'hashtag' => $_REQUEST['tag'],
        'text' => $_REQUEST['textdata'],
        'datetime' => time(),
        'status' => 1
    );
    $result = insertData($table, $insert);
    $query = "SELECT * FROM " . $table . " WHERE hashtag LIKE '%".$_REQUEST['tag']."%' AND status = 1 ORDER BY datetime DESC";
    $result = executeQuery($query);
    $data = '<div id="items" class="row-fluid">';
    foreach ($result as $record) {
        if ($record['image'] != '') {
            $rec = baseURL . 'uploads/' . $record['image'];
            $rec = '<a class="image" title="Title" href="javascript:void(0);">
                                    <img alt="" src="' . $rec . '">
                                </a>';
        }
        if ($record['video'] != '') {
            $rec = baseURL . 'uploads/' . $record['video'];
            $rec = '<video class="player_name" controls width="100%">
                    <source type="video/mp4" src="'.$rec.'">
                    <source type="video/ogg" src="'.$rec.'">
                        <source src="'.$rec.'" type="video/webm;" />
                    <track kind="subtitles" srclang="en" src="'.$rec.'t"> 
                    <track kind="subtitles" srclang="ru" src="'.$rec.'"> 
                   </video>';
        }
        if ($record['text'] != '') {
            $rec = $record['text'];
            $rec = '<div class="item-content"><div class="">' . $rec . '</div></div>';
        }
        $data .= '<div class=" item masonry-brick">
                            <div class="picture">
                             ' . $rec . '   
                             </div>
                        </div>';
    }
    $data .= '</div>';
    //$data = array('success' => 'Form was submitted', 'formData' => $_POST);
}
else if(isset($_GET['searchtag']) || isset ($_GET['tagitems'])){
    include 'config.php';
    $_POST['searchtag'] = str_replace('#', '', $_POST['searchtag']);
    $query = "SELECT * FROM " . $table . " WHERE hashtag LIKE '%".$_POST['searchtag']."%' AND status = 1 ORDER BY datetime DESC";
    $result = executeQuery($query);
    if($result){
    $data = '<div id="items" class="row-fluid">';
    foreach ($result as $record) {
        if ($record['image'] != '') {
            $rec = baseURL . 'uploads/' . $record['image'];
            $rec = '<a class="image" title="Title" href="javascript:void(0);">
                                    <img alt="" src="' . $rec . '">
                                </a>';
        }
        if ($record['video'] != '') {
            $rec = baseURL . 'uploads/' . $record['video'];
            $rec = '<video class="player_name" controls width="100%">
                    <source type="video/mp4" src="'.$rec.'">
                    <source type="video/ogg" src="'.$rec.'">
                    <source src="'.$rec.'" type="video/webm;" />
                    <track kind="subtitles" srclang="en" src="'.$rec.'t"> 
                    <track kind="subtitles" srclang="ru" src="'.$rec.'"> 
                   </video>';
        }
        if ($record['text'] != '') {
            $rec = $record['text'];
            $rec = '<div class="item-content"><div class="">' . $rec . '</div></div>';
        }
        $data .= '<div class=" item masonry-brick">
                            <div class="picture">
                             ' . $rec . '   
                             </div>
                        </div>';
    }
    $data .= '</div>';
    }else{
    $data = 'No Record Found';    
    }
} 
else {
    $data = array('success' => 'Form was submitted', 'formData' => $_POST);
}
echo $data;
?>