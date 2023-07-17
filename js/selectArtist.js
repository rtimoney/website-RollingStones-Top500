

function selectArtist(){

// var x = document.getElementById("album_artist").value;
var x = document.getElementById("album_artist").value;

$.ajax({
url:"showSpecifiedArtist.php",
method: "POST",
data:{
id : x

},
success:function(data){
    $("#ans").html(data);
}
})





}



function selectArtist(purl, p2){

    // var x = document.getElementById("album_artist").value;
    var x = document.getElementById(p2).value;
    
    $.ajax({
    url:purl,
    method: "POST",
    data:{
    id : x
    
    },
    success:function(data){
        $("#ans").html(data);
    }
    })
    
    
    
    
    
    }




    function selectAlbumDataBody(purl, p2){

        // var x = document.getElementById("album_artist").value;
        var x = document.getElementById(p2).value;
        
        $.ajax({
        url:purl,
        method: "POST",
        data:{
        id : x
        
        },
        success:function(data){
            $("#indalbumpagedata").html(data);
        }
        })
    }    

