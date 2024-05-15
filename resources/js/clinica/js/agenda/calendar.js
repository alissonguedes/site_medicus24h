var settings = {
	headerToolbar: {
		left: 'prev,next',
		center: 'today',
		right: 'title',
	},
	initialView: 'dayGridMonth',
	timeZone: 'America/Sao_Paulo',
	// selectable: true,
	locale: 'pt-br',
	dayMaxEvents: true,
	fixedWeekCount: false,
	height: 'auto',
	contentHeight: 'auto',
	expandRows: true,
	dayPopoverFormat: {
		day: 'numeric',
		weekday: 'short',
		omitCommas: true,
	},
	titleFormat: {
		month: 'long',
		year: 'numeric',
		// 	omitCommas: true,
		// 	omitZeroMinute: false,
	},
}

var calendarEl = document.querySelector('#agenda');
var agenda = new FullCalendar.Calendar(calendarEl, settings);

agenda.render();

$('#agenda-medica [data-trigger="btn-calendar-today"]')
	.attr('data-tooltip', moment(agenda.currentData.currentDate)
		.format('dddd, DD [de] MMMM [de] YYYY')).unbind().bind('click', function() {
		agenda.today();
	});

$('#agenda-medica [data-trigger="btn-calendar-prev"]').unbind().bind('click', function() {

	agenda.prev();

});

$('#agenda-medica [data-trigger="btn-calendar-next"]').unbind().bind('click', function() {

	agenda.next();

});

new Core();
