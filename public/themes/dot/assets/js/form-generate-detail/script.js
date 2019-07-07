jQuery(function($) {
    
    var dataJson = $('input[name="jsonForm"]').val();
    console.log(dataJson);

    $('.fb-render').formRender({
      dataType: 'json',
      formData: dataJson
    });
    
  });