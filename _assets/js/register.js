$(document).ready(function(){
    $(".collapse-control").each(function(idx, elem) {
      elem = $(elem);
      var group = elem.parent().next();
      
      group.hide();
      
      elem.bind('propertychange change click keyup input paste', function() {
        var visible = $(this).val() != '';
        group.toggle(visible);
        var inputs = group.find(':input');
        inputs
          .prop('required', visible)
          .attr('data-validate', visible.toString());
        $('form').validator('update');
        if(!visible) { inputs.change(); }
      });
    });
});
