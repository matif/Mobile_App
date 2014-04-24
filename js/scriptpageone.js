$(function()
    {
        // Variable to store your files
        var files;
        // Add events
        if($('#tagg').val()!='#' || $('#tagg').val()!=''){
        $('#file_uploadimage').on('change', prepareUploadImage);
        $('#file_uploadvideo').on('change', prepareUploadVideo);
        $('#file_uploadimage2').on('change', prepareUploadImage);
        $('#file_uploadvideo2').on('change', prepareUploadVideo);
        $('#save').on('click', posttext);
        }
        //$('form').on('submit', uploadFiles);
        // Grab the files and set them to our variable
        function prepareUploadImage(event)
        {
            if($('#tagg').val()=='#' || $('#tagg').val()==''){
                alert('please fill tag field first.');
                return false;
            }else{
                files = event.target.files;
                uploadFiles(event,'image');
            }
        }
        function prepareUploadVideo(event)
        {
            if($('#tagg').val()=='#' || $('#tagg').val()==''){
                alert('please fill tag field first.');
                return false;
            }else{
                files = event.target.files;
                uploadFiles(event,'video');
            }
        }
        // Catch the form submit and upload the files
        function uploadFiles(event,types)
        {
            event.stopPropagation(); // Stop stuff happening
            event.preventDefault(); // Totally stop stuff happening
            // START A LOADING SPINNER HERE
            $(".overlay").show();
            // Create a formdata object and add the files
            var data = new FormData();
            $.each(files, function(key, value)
            {
                data.append(key, value);
            });
            data.append('tag', $('#tagg').val());
            $.ajax({
                url: 'submit.php?files='+types,
                type: 'POST',
                data: data,
                cache: false,
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function(data,textStatus,jqXHR)
                {
                    $(".overlay").hide();
                    $("#one").hide();
                    $("head").append('<link rel="stylesheet" id="bootcss" href="./js/bootstrap/css/bootstrap.min.css" />');
                    $("#listpage").show();
                    $("#main").html(data);
                    $('#search').val($('#tagg').val());
                    var $container = $('#items');
                    $container.imagesLoaded(function(){
                        $container.masonry({
                            itemSelector : '.item',
                            columnWidth : 290,
                            isAnimated: true
                        });
                    });
                    //$('#tagg').val('#');
                    //window.location.href='pagetwo.html';
                    if(typeof data.error === 'undefined')
                    {
                        // Success so call function to process the form
                        //$('#tagg').val('#');
                        submitForm(event, data);
                    }
                    else
                    {
                        // Handle errors here
                        //$('#tagg').val('#');
                        console.log('ERRORS: ' + data.error);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    // Handle errors here
                    console.log('ERRORS: ' + textStatus);
                // STOP LOADING SPINNER
                }
            });
        }
    });
function posttext(event){
    $(".overlay").show();
    var formData = 'tag='+$('#tagg').val()+'&textdata=' + window.frames['rte'].document.body.innerHTML;
    $.ajax({
        url: 'submit.php?text',
        type: 'POST',
        data: formData,
        cache: false,
            
        success: function(data)
        {
            $("head").append('<link rel="stylesheet" id="bootcss" href="./js/bootstrap/css/bootstrap.min.css" />');
            $(".overlay").hide();
            $("#editoron").hide();
            $("#listpage").show();
            $("#main").html(data);
            var $container = $('#items');
            $('#search').val($('#tagg').val());
            $container.imagesLoaded(function(){
                $container.masonry({
                    itemSelector : '.item',
                    columnWidth : 290,
                    isAnimated: true
                });
            });
            return "success";
        },
        error: function()
        {
            $("head").append('<link rel="stylesheet" id="bootcss" href="./js/bootstrap/css/bootstrap.min.css" />');
            $(".overlay").hide();
            $("#editoron").hide();
            $("#listpage").show();
            $("#main").html(data);
            $('#search').val($('#tagg').val());
            var $container = $('#items');
            $container.imagesLoaded(function(){
                $container.masonry({
                    itemSelector : '.item',
                    columnWidth : 290,
                    isAnimated: true
                });
            });
            return "error";
        },
        complete: function()
        {
            $("head").append('<link rel="stylesheet" href="./js/bootstrap/css/bootstrap.min.css" />');
            $(".overlay").hide();
            $("#editoron").hide();
            $("#listpage").show();
            $("#main").html(data);
            $('#search').val($('#tagg').val());
            var $container = $('#items');
            $container.imagesLoaded(function(){
                $container.masonry({
                    itemSelector : '.item',
                    columnWidth : 290,
                    isAnimated: true
                });
            });
            return "success";
        }
    });
}    
function iFrameOn(){
    if($('#tagg').val()=='#' || $('#tagg').val()==''){
        alert('please fill tag field first.');
        return false;
    }else{
        $("#editoron").show();
        $("#one").hide();
        $('#rte').css("height", (window.screen.height/2)-80);
        rte.document.designMode = 'On';
    }
}
function iBold(){
    rte.document.execCommand('bold', false, null); 
}
function iUnderline(){
    rte.document.execCommand('underline', false, null);
}
function iItalic(){
    rte.document.execCommand('italic', false, null);
}
function iFontSize(){
    var size = prompt('Enter a size 1 - 7', '');
    rte.document.execCommand('fontSize', false, size);
}
function iFrameOn2(){
    nevclose();
    $("#editoron").show();
    $("#one").hide();
    $("#listpage").hide();
    $('#rte').css("height", (window.screen.height/2)-80);
    rte.document.designMode = 'On';
}
function nevclose(){
    $("#toggleheader").hide();
}
function checkHashtag(){
    if($('#tagg').val()=='#' || $('#tagg').val()==''){
        alert('please fill tag field first.');
        return false;
    }
}
function windohight(){
    var heig = (window.screen.height-70);
    var eachhight = (heig/3);
    $('.green').css("height", eachhight);
    $('.pink').css("height", eachhight);
    $('.yellow').css("height", eachhight);
    $('.blue').css("height", 70);
    $('.overlay').css("height", heig);
}
function search(){
  $(".overlay").show();
  $("#toggleheader").hide();
    var formData = 'searchtag='+$('#search').val();
    $.ajax({
        url: 'submit.php?searchtag',
        type: 'POST',
        data: formData,
        cache: false,
            
        success: function(data)
        {   
            nevclose();
            $(".overlay").hide();
            $("#main").html(data);
            var $container = $('#items');
            $container.imagesLoaded(function(){
                $container.masonry({
                    itemSelector : '.item',
                    columnWidth : 290,
                    isAnimated: true
                });
            });
            return "success";
        },
        error: function()
        {
            $(".overlay").hide();
            $("#main").html(data);
            var $container = $('#items');
            $container.imagesLoaded(function(){
                $container.masonry({
                    itemSelector : '.item',
                    columnWidth : 290,
                    isAnimated: true
                });
            });
            return "error";
        },
        complete: function()
        {
            $(".overlay").hide();
            $("#main").html(data);
            var $container = $('#items');
            $container.imagesLoaded(function(){
                $container.masonry({
                    itemSelector : '.item',
                    columnWidth : 290,
                    isAnimated: true
                });
            });
            return "success";
        }
    });  
    
}
function tagitems(){
     if($('#tagg').val()=='#' || $('#tagg').val()==''){
        alert('please fill tag field first.');
        return false;
    }
    $(".overlay").show();
    nevclose();
    var formData = 'searchtag='+$('#tagg').val();
    $.ajax({
        url: 'submit.php?tagitems',
        type: 'POST',
        data: formData,
        cache: false,
            
        success: function(data)
        {
            $(".overlay").hide();
            $("#one").hide();
            $("head").append('<link rel="stylesheet" id="bootcss" href="./js/bootstrap/css/bootstrap.min.css" />');
            $(".overlay").hide();
            $("#editoron").hide();
            $("#listpage").show();
            $("#main").html(data);
            $('#search').val($('#tagg').val());
            var $container = $('#items');
            $container.imagesLoaded(function(){
                $container.masonry({
                    itemSelector : '.item',
                    columnWidth : 290,
                    isAnimated: true
                });
            });
            return "success";
        }
    });
}
function loadHome(){
    $("#bootcss").remove();
    $(".overlay").hide();
    $("#one").show();
    $("#listpage").hide();
    return false;
}
function headertogal(){
$( "#toggleheader" ).slideToggle();   
}