jQuery(function($){
	$('#nip').mask('0000000000000000000000000', {'translation': {0: {pattern: /[0-9*]/}}});
	$('#jam').mask('000000', {'translation': {0: {pattern: /[0-9*]/}}});
	$('#telepon').mask('000 000-0000-00');
});