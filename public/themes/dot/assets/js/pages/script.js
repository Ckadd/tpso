$(document).ready(function(){
    $('meta[http-equiv=refresh]').remove();
    var title = $('.head_cshare_detail h1').text();
    $('title').text(title);
});