jQuery(function($) {
  var fbTemplate = document.getElementById('fb-template');
  $('.fb-render').formRender({
    dataType: 'xml',
    formData: fbTemplate.value
  });
});