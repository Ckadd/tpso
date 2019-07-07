$(document).ready(function(){
    var title = $('.head_cshare_detail > h2').text();
    $('title').text('ข่าวจัดซื้อจัดจ้าง');

    /**
     * script js share social
     */
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
});