/**
 * Fix voyager menu 3 levels
 * 
 * @ref : https://github.com/the-control-group/voyager/issues/2125
 */
$('.panel-collapse').on('hide.bs.collapse', function(e) {
    if($(event.target).parent().hasClass('collapsed')) { 
        e.stopPropagation(); e.preventDefault(); 
    } 
});