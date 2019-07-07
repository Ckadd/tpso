if($('input[name="form"]').val() == "") {
  jQuery(function($) {
    
    var fbEditor = document.getElementById('build-wrap');
    var options = {
      disabledActionButtons: ['data','clear','save']
    };
    var formBuilder = $(fbEditor).formBuilder(options);

    $('#saveData').click(function(){
      $('input[name="form"]').val(formBuilder.actions.getData('json'));
      formBuilder.actions.showData("Success");
      
    });  


    
  });
}else {
  jQuery(function($) {
    
    var dataForm = $('input[name="form"]').val();

    var fbTemplate = document.getElementById('build-wrap'),
    options = {
      dataType: 'json',
      formData: ''+dataForm+''
    };
    
    var formBuilder = $(fbTemplate).formBuilder(options);

    $('#saveData').click(function(){
      $('input[name="form"]').val(formBuilder.actions.getData('json'));
      formBuilder.actions.showData("Success");
    });  
    
  });
}

