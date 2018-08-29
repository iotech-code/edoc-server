$('a.edoc-link-form').click(function(e){
  e.preventDefault();
  $(this).find('form').submit();
});

$('a.edoc-link-form').click(function(e){
  e.preventDefault();
  $(this).find('form').submit();
});

$('.date-select').datepicker({
  language: 'th',
  format: 'yyyy-mm-dd',
  // startDate: 'd'
});