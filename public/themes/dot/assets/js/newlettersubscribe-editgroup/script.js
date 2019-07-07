$(document).ready(function(){
    $('meta[http-equiv=refresh]').remove();
    var title = $('.csharedetail_head > h1').text();
    $('title').text(title);

    $('#chkboxAll').click(function(){
        if($(this).is(':checked')) {

            $('input[type="checkbox"]').prop('checked',false);
            $(this).prop('checked',true);
            $('div.newletter_detail').addClass('disabled');
            $('input[type="checkbox"]').not(':checked').prop('disabled',true);
        }else{ 

            $('div.newletter_detail').removeClass('disabled');
            $('input[type="checkbox"]').prop('disabled',false);
            $(this).prop('checked',false);
        }
        
    });
    
    var numOfChildCheckBox = $("input[type='checkbox'][name!='chkall']").length;

    
    $("input[type='checkbox'][name!='chkall']").click(function(){
        var checkedchild = $("input[type='checkbox'][name!='chkall']:checked").length;
        if(checkedchild == numOfChildCheckBox) {
            $('input[type="checkbox"]').prop('checked',false);
            $('#chkboxAll').prop('checked',true);
            $('div.newletter_detail').addClass('disabled');
            $('input[type="checkbox"]').not(':checked').prop('disabled',true);
        }

    });

    $("#SentMail").click(function(){
        var url = $(this).data('url');
        
        var id = $('input[name="id"]').val();
        var dataCheckbox = [];
        $('input[type="checkbox"]:checked').each(function(key,valueData){
            
            dataCheckbox.push($(this).val()); 
        });
        console.log(dataCheckbox);
        $.ajax({
            type:'GET',
            url:url,
            data:{id:id,data:dataCheckbox},
            success:function(msg){
            //   console.log(msg);
              if(msg=="success") {
               $('#modal-newletter-success').modal({backdrop: 'static', keyboard: false});
                $index = $('#modal-ok').data('url');
               $('#modal-ok').click(function(){
                    window.location.href='/';
               });
              }
            }
        });
    });

    
});