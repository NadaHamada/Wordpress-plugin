$(document).ready(function() {
    $(".clickable").click(function(event){
            $("input#email").val($(this).html());
    }); 

});

$("#list").click(function(event){
    $('#form')
        .css('display','none');
    var tables = document.getElementsByClassName("element");
    for (i = 0; i <tables.length; i++) { 
        var tableIndex=tables[i];
        tableIndex.style.display = "block";
    }
});
$('#add_new').click(function(event){
    $('#form')
        .css('display','block');
    var tables = document.getElementsByClassName("element");
    for (i = 0; i <tables.length; i++) { 
        var tableIndex=tables[i];
        tableIndex.style.display = "none";
    }
});
$('.modalClose').click(function(event){
    $('.overlay').css('display','none');
});

//Email Modal
var modal = document.getElementById('myModal1');
var btn = document.getElementsByClassName("myBtn");
var i;
for (i = 0; i < btn.length; i++) { 
   var btnIndex=btn[i];
    btnIndex.onclick = function() {
        modal.style.display = "block";
    }
}
var span = document.getElementsByClassName("close")[0];
span.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

