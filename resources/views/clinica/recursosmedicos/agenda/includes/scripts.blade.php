<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/defaults/calendar.css') }}" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<style>
	table.programacao {
		margin-bottom: 30px;
	}

	td,
	th {
		border-radius: 0 !important;
		border: 1px solid var(--grey-darken-3);
	}

	main .card-panel>.card-header~.card-content {
		height: calc(100% - 56px);
		top: auto;
		bottom: 0px;
	}

	.card.agenda {
		position: relative;
		overflow: hidden;
		height: 100%;
	}

	.card.agenda .card-content {
		height: 100%;
		position: absolute;
		left: 0;
		top: 0;
		right: 0;
		bottom: 0;
		background-color: inherit;
	}

	.card .card-reveal {
		background-color: inherit;
		z-index: 999999;
	}

	.card.agenda .card-title .date {
		font-family: 'Montserrat Bold';
		display: flex;
		flex-direction: column;
		align-items: center;
		place-content: center;
		background: var(--light-green);
		width: 70px;
		height: 70px;
		border-radius: 100%;
		/* margin-left: 3px;
		margin-top: 3px; */
	}

	.card.agenda .date * {
		font-family: inherit;
		line-height: 24px;
	}

	th.hora {
		padding: 10px;
		font-family: 'Montserrat Bold';
		background-color: var(--grey-darken-4);
		color: #fff;
		border-radius: 4px;
	}

	.fc .fc-more-link,
	.fc .fc-event {
		color: var(--light-green);
		font-family: 'Montserrat Bold';
		font-size: 10px;
	}
</style>

<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('assets/node_modules/froala-editor/js/froala_editor.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/froala-editor/js/languages/pt_br.js') }}"></script>
<script src="{{ asset('assets/node_modules/fullcalendar/index.global.min.js') }}"></script>

<script>
	$(function() {

		var calendarEl = document.getElementById('calendar');
		var calendar = new FullCalendar.Calendar(calendarEl, {
			initialView: 'dayGridMonth',
			timeZone: 'America/Sao_Paulo',
			locale: 'pt-br',
			headerToolbar: false,

			dayMaxEvents: true,
			height: '100%',
			contentHeight: '100%',
			fixedWeekCount: false,
			expandRows: true,
			lazyFetching: true,
			nowIndicator: true,

			// eventDisplay: 'inverse-background',
			// eventDisplay: 'block',

			moreLinkContent: function(l) {
				return 'Mais ' + l.num;
			},

			eventClick: (e) => {

				e.jsEvent.preventDefault();

				var id = e.event.id;
				var url = e.event.url;

				$('form.card-reveal').show();
				calendar.refetchEvents();

				if (typeof url !== 'undefined') {

					Url.update(url);

					$.ajax({
						url: url,
						method: 'get',
						success: (response) => {

							console.log(response);
							var form = $(response).find('form.card-reveal');

							$('form.card-reveal').html(form.html());
							$('form.card-reveal').css({
								'transform': 'translateY(-100%)',
							});

							$.getScript(BASE_PATH + 'assets/js/app.js');
							calendar.refetchEvents();
						}
					});
				}

			},

			dateClick: (a) => {

				var url = BASE_URL + 'agenda/' + a.dateStr.replaceAll('-', '/');

				Url.update(url);

				$.ajax({
					url: url,
					method: 'get',
					success: (response) => {
						var form = $(response).find('#details.card-reveal');
						$('#details.card-reveal').html(form.html());
						$('#details.card-reveal').css({
							'display': 'block',
							'transform': 'translateY(-100%)',
						});
						$.getScript(BASE_PATH + 'assets/js/app.js');
						calendar.refetchEvents();
					}
				});

				calendar.refetchEvents();

			},

			events: {
				url: BASE_URL + 'agenda',
				method: 'get',
				extraParams: {
					ajaxCalendar: true
				},
				success: (response) => {

				},
				color: 'var(--light-green)', // an option!
				textColor: 'black' // an option!
			},

		});

		calendar.render();

	});
</script>

<style>
	.daterangepicker {
		z-index: 9999999999 !important;
		/* position: relative; */
		background-color: var(--grey-darken-5) !important;
	}

	.daterangepicker .calendar-table {
		background-color: inherit !important;
		border: 1px solid var(--grey-darken-5) !important;
	}
</style>
