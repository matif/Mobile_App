<?php
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
?>
<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0,">
        <title>Mobile App</title>
        <script src="js/jquery.js"></script>
        <!-- list page -->
        <!--<link rel="stylesheet" href="js/bootstrap/css/bootstrap-responsive.min.css" />-->
        <link rel="stylesheet"  href="./css/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="css/stylesheet.css" />
        
        <script src="./js/bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap-lightbox.min.css">
        <script src="js/bootstrap-lightbox.js"></script>
        <script src="js/bootstrap-img-lightbox-tooltip.js"></script>
        
        <script src="js/jquery.masonry.min.js"></script>
        <script src="js/script.js"></script>
        <!-- list page end -->
        <!-- index page -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="shortcut icon" href="favicon.ico">
        <script src="js/scriptpageone.js"></script>
        <!-- index page -->
        <script type="text/javascript">
            $(document).ready(function(){
               windohight();
               $("img").img_lightbox_tooltip();
            });
            /*--------------------editor functions start -------------*/
        </script>
    </head>
    <body>
    <dev style="width: 100%">
    <dev style="width: 70%; margin: 0px auto;">
        <div id="overlay" class="overlay" style="display: none; position:fixed; z-index:9999999;">
            <div class="loading_img"><img src="loading.gif" width="34" /></div>
        </div>
        <!-- Start of first page: #one -->
        <div data-role="page" id="one">
            <form enctype="multipart/form-data" onsubmit="tagitems(); return false;" id="form1" method="post" preservedata="yes">
                <div class="row blue">
                    <div class="container">
                        <div class="pink-con"><input id="tagg" type="text" name="hashtag" value="#" />
                            <span><a href="javascript:void(0);" id="tagsubmit" onclick="tagitems();return false;" >Submit</a></span>
                        </div>
                    </div>
                </div><!--end of blue-->
                <div class="row yellow">
                    <div class="container">
                        <div data-role="page" class="pink-con">
                            <label data-role="button" class="file-upload">
                                <img src="cam-icon.png" alt="" />
                                <input type="file" accept="image/gif,image/jpeg,image/jpg,image/png;capture=camera" onclick="return checkHashtag();" name="file_upload" id="file_uploadimage" multiple>
                            </label>
                        </div>
                    </div>
                </div><!--end of yellow capture="camcorder" capture="camera"  -->
                <div class="row pink">
                    <div class="container">
                        <div data-role="page" class="pink-con">
                            <label data-role="button" class="file-upload">
                                <img src="vid-cam.png" alt="" />
                                <input type="file" name="file_upload" onclick=" return checkHashtag();" accept="video/*;capture=camcorder"  id="file_uploadvideo" multiple>
                            </label>
                        </div>
                    </div>
                </div><!--end of pink-->
                <div class="row green">
                    <div class="container">
                        <a href="javascript:void(0);" onclick="iFrameOn();"><div><img src="list-icon.png" /></div></a>
                    </div>
                </div><!--end of green-->
            </form>
        </div>
        <!-- /page one -->
        <!-- Editor page start -->
        <div id="editoron" style="display: none;">
            <input type="button" onclick="iBold()" value="B"> 
            <input type="button" onclick="iUnderline()" value="U">
            <input type="button" onclick="iItalic()" value="I">
            <input type="button" onClick="iFontSize()" value="Font Size">
            <br />
            <iframe name="rte" id="rte" style="border:#000000 1px solid;"></iframe>
            <br />
            <input type="button" id="save" value="Save">
            <input type="button" onclick='closetextarea(); return false;' value="Cancal">
        </div>
        <input type="hidden" name="pagetype" id="pagetype" value="1"/>
        <!-- Editor page end  -->
        <!-- List page start  -->

        <div id="listpage" style="display: none;">
            <?php if($deviceType!='computer'){?>
            <header>
                <div class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <a class="btn btn-navbar" href="#" onclick="headertogal();">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <div class="nav-collapse collapse" id="toggleheader"  style="height: auto;">
                            <ul class="nav">
                                <li class="active">
                                    <a href="javascript:void(0);" onclick="loadHome();return false;"><i class="icon-home"></i>&nbsp;Home</a>
                                </li>
                                <li class="active">
                                    <div class="bluenev">
                                        <div class="container"  >
                                            <div class="pink-con"><input style="margin-top: 12px;" id="search" type="text" name="search" value="#" />
                                                <button class="btn btn-navbar" style="margin-top: 12px;" onclick="search();return false;">Search</button></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="active">
                                    <div class="yellownev">
                                        <div class="container">
                                            <div data-role="page" class="pink-con">
                                                <label data-role="button" class="file-upload">
                                                    <img src="cam-icon.png" style=" width: 80px;" alt="" />
                                                    <input type="file" accept="image/*;capture=camera" onclick=" nevclose();return checkHashtag();" name="file_upload" id="file_uploadimage2" multiple>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="active">
                                    <div class="pinknev">
                                        <div class="container">
                                            <div data-role="page" class="pink-con">
                                                <label data-role="button" class="file-upload">
                                                    <img src="vid-cam.png" style=" width: 80px;" alt="" />
                                                    <input type="file" name="file_upload" onclick=" nevclose();return checkHashtag();" accept="video/*;capture=camcorder"  id="file_uploadvideo2" multiple>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="active">
                                    <div class="greennev">
                                        <div class="container">
                                            <a href="javascript:void(0);" onclick="iFrameOn2();"><div><img src="list-icon.png" style=" width: 80px;" /></div></a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            <?php }else{?>
            <header class="header2">
                <div class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="nav-collapse collapse" id="toggleheader"  style="height: auto; display: none;">
                            <div class="col">
                                <span class="home-icon">     
                                <a href="javascript:void(0);" onclick="loadHome();return false;"><i class="icon-home"></i>&nbsp;Home</a>
                            </span>
                            </div>
                            <div class="col">
                                    <div class="bluenev">
                                        <div class="container">
                                            <div class="pink-con"><input style="margin-top: 12px;" id="search" type="text" name="search" value="#" />
                                                <button class="btn btn-navbar" style="margin-top: 12px;" onclick="search();return false;">Search</button></div>
                                        </div>
                                    </div>
                               
                            </div>
                            <div class="col">
                                <div class="col-con3">
                                <div class="list-icon green1">
                                        <div class="container">
                                            <div data-role="page" class="pink-con">
                                                <label data-role="button" class="file-upload">
                                                    <img src="cam-icon.png" style=" width: 80px;" alt="" />
                                                    <input type="file" accept="image/*;capture=camera" onclick=" nevclose();return checkHashtag();" name="file_upload" id="file_uploadimage2" multiple>
                                                </label>
                                            </div>
                                        </div>
                                </div>
                                <div class="list-icon pink1">
                                        <div class="container">
                                            <div data-role="page" class="pink-con">
                                                <label data-role="button" class="file-upload">
                                                    <img src="vid-cam.png" style=" width: 80px;" alt="" />
                                                    <input type="file" name="file_upload" onclick=" nevclose();return checkHashtag();" accept="video/*;capture=camcorder"  id="file_uploadvideo2" multiple>
                                                </label>
                                            </div>
                                        </div>
                                </div>
                                <div class="list-icon yellow1">
                                       <div class="container">
                                            <a href="javascript:void(0);" onclick="iFrameOn2();"><div><img src="list-icon.png" style=" width: 80px;" /></div></a>
                                        </div>
                                </div>
                            </div></div> 
                        </div>
                    </div>
                </div>
            </header>
            <?php } ?>
            <div class="wrapper">
                <div id="main">
                    <div id="items" class="row-fluid">
                        <div class=" item masonry-brick">
                            <div class="picture">
                                <div class="item-content">
                                    <div class="">
                                        <p>sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class=" item masonry-brick">
                            <div class="picture">
                                <a class="image" title="Title" href="#">
                                    <img alt="" src="uploads/image_07.jpg">
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <footer id="footer"></footer>
        </div>
        <!-- List page end  -->
</dev>
</dev>
    <!--light box dev-->
    <div id="demoLightbox" class="lightbox hide fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-header"
    style="position:absolute; height:20px; left:100%; margin-left: 10px; padding:0; border:0;">
    <button type="button" class="close"
    style="color:white; font-size: 30px;"
    onclick='$("#demoLightbox").lightbox("hide")'> × </button>
     
    </div>
    <div class='lightbox-content'>
        <img src="" style="height: 100%;margin: 0px">
    </div>
    </div>
    <!--light box dev-->
    </body>
</html>
