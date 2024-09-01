<script src="{{ asset('assets/node_modules/html2canvas/dist/html2canvas.js') }}"></script>
<script src="{{ asset('assets/node_modules/froala-editor/js/froala_editor.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/froala-editor/js/languages/pt_br.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/node_modules/select2/dist/css/select2.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/defaults/select2.css') }}">
<script src="{{ asset('assets/node_modules/select2/dist/js/select2.js') }}"></script>

<style>
	.calendar_pk .modal.datepicker-modal {
		position: relative;
		box-shadow: none;
		top: 0 !important;
		left: auto !important;
		right: auto !important;
		transform: none !important;
		background-color: #fafafa;
		padding: 0;
		max-height: 100%;
		width: 100%;
		max-width: 100%;
		margin: 0;
		overflow-y: auto;
		border-radius: 2px;
		will-change: auto;
		border: 1px solid var(--grey-lighten-2);
	}

	.calendar_pk .modal-overlay,
	.calendar_pk .datepicker-footer,
	.calendar_pk .datepicker-date-display {
		display: none !important;
	}

	.calendar_pk .datepicker-controls,
	.calendar_pk .datepicker-table,
	.calendar_pk .datepicker-footer {
		width: 100%;
	}

	.calendar_pk .datepicker-calendar {
		padding: 0;
	}

	.datepicker-day-button {
		width: 40px;
		height: 40px;
		line-height: 40px;
		margin: 5px auto;
	}

	.datepicker-table td {
		/* border-radius: 26px !important;
								width: 32px;
								height: 32px;
								line-height: 32px; */
		width: 40px;
		height: 40px;
		line-height: 40px;
		margin: 5px auto;
	}

	.datepicker-table td.is-selected {
		background-color: unset;
		color: unset;
	}

	.datepicker-table td.is-disabled.is-today .datepicker-day-button {
		background-color: var(--grey-lighten-2);
		color: #fff;
	}

	.datepicker-table td.is-selected .datepicker-day-button {
		background-color: #26a69a;
		color: #fff;
	}

	.datepicker-table td.is-selectable:not(.is-outside-current-month) .datepicker-day-button {
		color: #fff;
		background-color: var(--teal-lighten-2);
	}

	.datepicker-table td.is-selected.is-selectable:not(.is-outside-current-month) .datepicker-day-button {
		color: #fff;
		background-color: var(--teal-darken-4);
	}

	.datepicker-table-wrapper {
		padding: 0 15px 15px;
	}

	.datepicker-controls .selects-container .select-wrapper:first-child {
		float: right;
	}

	.datepicker-controls .selects-container .select-wrapper:first-child input {
		width: 130px;
	}

	.datepicker-controls .selects-container .select-wrapper:last-child {
		float: right;
	}

	.datepicker-controls .selects-container .select-wrapper:last-child input {
		width: 90px;
	}
</style>

<script>
	$(function() {

		var container = $('.calendar_pk');
		var input = $('[type="hidden"][data-mask="calendar"]');

		var date = new Date();
		// var curDate = date.getDate();
		// var curMonth = (date.getMonth() < 10 ? '0' : null) + (date.getMonth() + 1);
		var curYear = date.getFullYear();

		// var yearRange = 50;

		container.each(function() {

			var self = $(this);

			var defaultDate = "{{ date('d/m/Y') }}".split('/');
			var minDate = defaultDate; // $(this).data('min-date') ? $(this).data('min-date').split('/') : null;
			var maxDate = null; // $(this).data('max-date') ? $(this).data('max-date').split('/') : null;
			var yearRange = minDate ? [minDate[2], curYear + 50] : maxDate ? [1900, curYear - 0] : [curYear - 50, curYear + 50];

			minDate = minDate ? new Date(minDate[2], minDate[1] - 1, minDate[0]) : null;
			maxDate = maxDate ? new Date(maxDate[2], maxDate[1] - 1, maxDate[0]) : null;
			defaultDate = defaultDate ? new Date(defaultDate[2], defaultDate[1] - 1, defaultDate[0]) : null;

			function goToDate(data) {

				$.ajax({
					url: self.data('url'),
					method: 'get',
					data: {
						data: data
					},
					success: (response) => {

						var ativo = response['dias_ativos'];
						var inativo = response['dias_inativos'];

						for (var i in inativo) {
							var d = inativo[i];
							var data = moment(d).format('D');
							$('.datepicker-table').find('td[data-day="' + data + '"]').addClass('is-disabled');
						}

						for (var i in ativo) {
							var d = ativo[i];
							var data = moment(d).format('D');
							$('.datepicker-table').find('td[data-day="' + data + '"]').addClass('is-selectable');
						}

					}

				});
			}

			var pick = $(this).datepicker({
				showDaysInNextAndPreviousMonths: true,
				container: self,
				startView: 1,
				setDefaultDate: true,
				defaultDate: defaultDate,
				minDate: minDate,
				maxDate: maxDate,
				yearRange: yearRange,
				showMonthAfterYear: false,
				i18n: {
					months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
					monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
					weekdays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
					weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
					weekdaysAbbrev: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
					cancel: 'Cancelar'
				},

				onOpen(date) {

					var data = moment(date).format('YYYY-MM-DD');
					goToDate(data)

				},

				onDraw(da) {

					var month;
					var year;
					var data = moment(da.date).format('YYYY-MM-DD');

					$('.month-prev,.month-next').bind('click', function(e) {

						var i = 0;
						var m = $(this).hasClass('month-next') ? ++i : --i;
						month = Number.parseInt($('.datepicker-select.orig-select-month').val()) + i;
						year = Number.parseInt($('.datepicker-select.orig-select-year').val());
						var data = moment(new Date(year, month, '01')).format('YYYY-MM-DD');
						var dates = [];

						goToDate(data);

					});

				},

				onSelect: function(date) {

					var data = moment(date).format('YYYY-MM-DD');

					goToDate(data);

				},

			});

			pick.datepicker('open');

		});

		// var autocomplete = $('input[type="text"].autocomplete');
		// var autocomplete = document.querySelectorAll('[type="text"].autocomplete');

		// var instance = M.Autocomplete.init(autocomplete);
		// instance = M.Autocomplete.getInstance(instance);
		// var autocomplete = $('input[type="text"].autocomplete').autocomplete({
		// 	data: {
		// 		'teste': null,
		// 		'teste2': null
		// 	}
		// });

		// $('input[type="text"].autocomplete').each(function(e) {

		// 	$(this).on('keyup', function() {

		// 		$.ajax({
		// 			url: $(this).data('url'),
		// 			method: 'get',
		// 			data: {
		// 				search: $(this).val(),
		// 			},
		// 			success: (response) => {
		// 				autocomplete.autocomplete('updateData',
		// 					{
		// 						'Teste': null,
		// 					}
		// 				);
		// 				autocomplete.autocomplete('open');
		// 			}
		// 		});

		// 	});

		// });

	});
</script>
