'use strict';

$(document).ready(function() {

	var scroller = $('.scroller');

	$('[data-href],[href]').unbind().bind('click', function(e) {

		e.preventDefault();

		var href = $(this).data('href') || $(this).attr('href');
		var javascript = /^[J|j]ava[s|S]cript|^\#/;

		if (javascript.test(href)) {
			return;
		}

		var target = $(this).attr('target');
		// var target = $(this).attr('target') || '_self';

		if (target) {

			if (target === '_self')
				return window.location.href = href;
			else if (target === '_top')
				return null;
			else
				return window.open(href, target);

		}

		$('main .animated').removeClass('fadeIn').addClass('fadeOut');

		Url.update(href);

		redirect(href);

	});

	$(scroller).each(function() {

		var scroll = new PerfectScrollbar(this, {
			theme: "dark",
		});

		$(window).bind('resize', function() {
			scroll.update();
		});

	});

	var tabs = $('.tabs');
	var t = tabs.tabs({
		// swipeable: true
	});

	$('.materialboxed').materialbox();

	if (typeof daterangepicker == 'function' && $('body').find('.daterangepicker').length > 0) {
		$('.daterangepicker').daterangepicker({
			// singleDatePicker: true,
			// showDropdowns: true,
			linkedCalendars: true,
			timePicker: false,
			timePickerIncrement: 15,
			// buttonClasses: 'btn waves-effect',
			autoApply: true,
			drops: 'down',
			locale: {
				cancelLabel: 'Clear',
				applyLabel: 'Aplicar',
				daysOfWeek: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
				monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
				format: 'DD/MM/YYYY',
				separator: ' - ',
				fromLabel: 'De',
				toLabel: 'Até',
				customRangeLabel: 'Custom',
				weekLabel: 'W',
				firstDay: 1,
			}
		});
	}

	if ($('.datepicker').length) {
		$('.datepicker').each(function() {

			// var date = new Date();
			// var defaultDate = $(this).val() ? $(this).val().split('/').reverse().join('-') : null;

			// var d = new Date(defaultDate);
			// console.log(d, date, defaultDate);
			// $(this).datepicker({
			// 	format: 'dd/mm/yyyy',
			// 	autoClose: true,
			// 	yearRange: 50,
			// 	defaultDate: defaultDate,
			// 	setDefaultDate: true
			// });


			var date = new Date();
			// var curDate = date.getDate();
			// var curMonth = (date.getMonth() < 10 ? '0' : null) + (date.getMonth() + 1);
			var curYear = date.getFullYear();

			var defaultDate = $(this).val() != '' ? $(this).val().split('/') : null;
			var minDate = $(this).data('min-date') ? $(this).data('min-date').split('/') : null;
			var maxDate = $(this).data('max-date') ? $(this).data('max-date').split('/') : null;
			var yearRange = minDate ? [minDate[2], curYear + 100] : maxDate ? [1900, curYear - 0] : [curYear - 100, curYear + 100];

			minDate = minDate ? new Date(minDate[2], minDate[1] - 1, minDate[0]) : null;
			maxDate = maxDate ? new Date(maxDate[2], maxDate[1] - 1, maxDate[0]) : null;
			defaultDate = defaultDate ? new Date(defaultDate[2], defaultDate[1] - 1, defaultDate[0]) : null;

			$(this).datepicker({
				format: $(this).data('format') || 'dd/mm/yyyy',
				startView: 1,
				autoClose: true,
				setDefaultDate: true,
				showClearBtn: false,
				defaultDate: defaultDate,
				isRTL: false,
				minDate: minDate,
				maxDate: maxDate,
				yearRange: yearRange,
				// showMonthAfterYear: true,
				i18n: {
					months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
					monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
					weekdays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
					weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
					weekdaysAbbrev: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
					cancel: 'Cancelar'
				},
				onDraw: function() {
					// var dropdown = $(".datepicker-container").find(".select-dropdown");
					// dropdown.dropdown('destroy');
					// dropdown.dropdown({
					// 	alignment: 'right'
					// });
				}
			});

		});
	}

	setTimeout(function() {
		$('.calendar-time').find('select').each(function() {
			$(this).addClass('browser-default');
		})
	}, 1000);

	tabs.find('a').unbind().bind('click', function() {
		setTimeout(function() {
			t.tabs('updateTabIndicator');
		}, 100)
	});

	$('.tabs .tab a').each(function(index, element) {

		var id = $(this).attr('href');

		if ($(id).find('.input-field').hasClass('error')) {
			$(this).parents('.tabs, .tab').addClass('error');
			var tab = $($(this).parents('.tabs').find('.tab.error')[0]); // Exibir sempre a primeira "tab" da lista de erros
			if (tab.index() > -1) {
				var atual = $(tab.find(`a[href="${id}"]`)[0]).attr('href');
				if (typeof atual !== 'undefined')
					t.tabs('select', atual.replace('#', ''));
			}
		}

	});

	// $('.collapsible').Menu();
	// $('#main-menu').Menu();

	$('.input-field').each(function() {

		var field = $(this).find('input,textarea,select');

		if (field.val() != '') {
			$(this).find('label').addClass('active');
		}

	});

	$('[data-tooltip]').tooltip({
		transitionMovement: 10,
		margin: -5
	});

	var sidenav = $('.sidenav').sidenav({
		onCloseStart: () => {
			// var self = $('aside');
			// self.find('ul.submenu').removeClass('in out');
			// self.find('ul:not(.submenu)').removeClass('out').addClass('in');
		}
		// }).find('li').unbind().bind('click', function (e) {
		//     e.preventDefault();
	});

	sidenav.sidenav('close');

	$('.btn-menu').unbind().bind('click', function() {
		$('body').toggleClass('nav-collapsed');
	});

	$('button[type="reset"]').unbind().bind('click', function() {

		var action = $(this).parents('form').attr('action');

		$(this).parents('.card-reveal').css({
			transform: 'translateY(0%)',
			transition: '300ms ease-in-out'
		});

		Url.update(action);

	});

	$('[data-trigger="form"]').unbind().bind('click', function(e) {

		e.preventDefault();

		var target = '#' + $(this).data('target');
		var form = $(target);
		var url = $(this).data('url') || $(this).data('href');
		var $cardReveal = form.parents('#formularios');
		var anim = {
			transform: 'translateY(-100%)',
			transition: '300ms ease-in-out'
		};

		$cardReveal.css({
			display: 'block',
		});

		if (typeof url !== 'undefined') {

			Url.update(url);

			$.ajax({
				url: url,
				method: 'get',
				success: (response) => {
					$cardReveal.html($(response).find('#formularios').html());
					$('#formularios').find('form').hide();
					$cardReveal.css(anim).find(target).show();
					$.getScript(BASE_PATH + 'assets/js/app.js');
				}
			});

		}

	});

	// $('#card-button,.icon-background,.edit').unbind().bind('click', function() {
	// var url = $(this).data('href');
	// $('form.card-reveal').show();
	// if (typeof url !== 'undefined') {
	// 	Url.update(url);
	// 	$.ajax({
	// 		url: url,
	// 		method: 'get',
	// 		success: (response) => {
	// 			var form = $(response).find('form.card-reveal');
	// 			$('form.card-reveal').html(form.html());
	// 			$('form.card-reveal').css({
	// 				'transform': 'translateY(-100%)',
	// 			});
	// 			$.getScript(BASE_PATH + 'assets/js/app.js');
	// 		}
	// 	});
	// }
	// });

	// activator

	// $('#card-button').unbind().bind('click', function () {

	//     var url = $(this).data('url');
	//     $('.card-reveal').show();

	//     if (typeof url !== 'undefined') {
	//         Url.update(url);

	//         $.ajax({
	//             url: url,
	//             method: 'get',
	//             success: (response) => {
	//                 var form = $(response).find('form.card-reveal');
	//                 $('form.card-reveal').html(form.html());
	//                 $.getScript(BASE_PATH + 'assets/scripts/app/clinica/app.js');
	//                 $('.card-reveal').css({
	//                     'transform': 'translateY(-100%)',
	//                 });
	//             }

	//         });

	//     }

	// });

	// $('aside').find('ul').each(function() {
	// 	var a = $(this).find('li').find('a[href="javascript:void(0);"]');
	// 	a.unbind().bind('click', function(e) {
	// 		var self = $(this).parents('ul');
	// 		var idMenu = $(this).data('id');
	// 		e.preventDefault();
	// 		if ($(this).hasClass('menu-close')) {
	// 			self.parents('aside').find('ul.in').removeClass('in');
	// 			self.parents('aside').find(idMenu).removeClass('in out').addClass('in');
	// 		} else {
	// 			self.removeClass('in').addClass('out');
	// 			self.parents('aside').find(idMenu).addClass('in');
	// 		}
	// 	});
	// });

	// $('aside').unbind().bind('mouseleave', function() {
	// 	var self = $(this);

	// 	// var timeout = setTimeout(function () {

	// 	// self.find('ul.submenu').removeClass('in out');
	// 	// self.find('ul:not(.submenu)').removeClass('out').addClass('in');

	// 	// self.find('a').parents('ul:not(.out):not(#main-menu)').removeClass('in out')
	// 	// self.find('a.active').parents('ul').removeClass('out').addClass('in');

	// 	var ul = self.find('.main-menu ul');
	// 	// for (var i in ul) {

	// 	// $(ul).each(function () {

	// 	//     var isIn = $(this).after().hasClass('in');
	// 	//     var isOut = $(this).before().hasClass('out');

	// 	//     console.log(isIn);

	// 	//     if (isOut) {
	// 	//         $(this).removeClass('out').addClass('in');
	// 	//     } else {
	// 	//         $(this).removeClass('in');
	// 	//     }

	// 	// })

	// 	// }

	// 	// }, 2000);

	// 	// $(this).bind('mouseenter', function () {
	// 	//     clearTimeout(timeout);
	// 	// });

	// });

	$('.card:not(.agenda)>.card-reveal').unbind().bind('mouseleave', function() {
		$(this).find('.card-title').click();
	});

	$('.input-field.error').find('input,textarea,select').each(function() {
		$(this).bind('keyup', function() {
			if ($(this).val().length > 0)
				$(this).parents('.input-field.error').removeClass('error').find('.error').hide();
			else
				$(this).parents('.input-field').addClass('error').find('.error').show();
		});
	});

	if (typeof FroalaEditor !== 'undefined') {
		$('.editor').each(function() {
			// var height = $(this).attr('rows') || $(this).parent().parent().height();
			var height = 300;
			var placeholder = ($(this).attr('placeholder') || 'Escreva aqui') + '...';
			new FroalaEditor(this, {
				theme: 'light',
				language: 'pt_br',
				height: height,
				placeholderText: placeholder,
				key: '1C%kZV[IX)_SL}UJHAEFZMUJOYGYQE[\\ZJ]RAe)+%$==',
				toolbarSticky: false,
				attribution: false,
				toolbarBottom: false,
				wordCounterCount: true,
				charCounterCount: true,
			});
		});
	}

	/** Página de agenda */
	$('#details .card-title').unbind().bind('click', function() {
		Url.update(BASE_URL + 'agenda');
	});

	$('#details .card-title .date').unbind().bind('click', function() {
		$('#details .card-title').click();
	});

	// Button Delete Actions

	$('#modal-delete').find('[type="reset"]').unbind().bind('click', function(e) {
		e.preventDefault();
		$(this).parents('#modal-delete').removeClass('open');
		$('#modal-delete').find('input[name="id"]').val('');
	});

	$('[data-trigger="delete"]').unbind().bind('click', function(e) {

		e.preventDefault();

		var form = $(this);
		var action = form.data('href');
		var target = $(this).data('target');
		var id = $(this).data('id');

		$('#modal-delete').toggleClass('open').find('#item').html(target);
		$('#modal-delete').find('input[name="id"]').val(id);

	});

	$('select:not(.browser-default):not(.autocomplete)').formSelect();

	var select = $('select.autocomplete');

	select.each(function() {

		var self = $(this);
		var a = self.val('').attr('disabled', false);
		self.select2({
			// theme: 'materialize',
			placeholder: self.attr('placeholder') || 'Digite para pesquisar',
			allowClear: true,
			ajax: {
				delay: 250,
				url: self.data('url'),
				dataType: 'json',
				data: (data) => {
					return {
						values: self.val(),
						search: data.term || null,
					}
				},
				processResults: function(data, params) {
					params.page = params.page || 1;
					return {
						results: data
					}
				},
			}
		});

		var selecteds = self.data('selected')

		console.log(selecteds)
		if (typeof selecteds != 'undefined' && selecteds.length > 0) {
			for (var i in selecteds) {
				var s = selecteds[i];
				var option = new Option(s.text, s.id, true, true);
				self.append(option).trigger('change');
			}
		}

	});

	let forceFocusFn = function() {
		// Gets the search input of the opened select2
		var searchInput = document.querySelector('.select2-container--open .select2-search__field');
		// If exists
		if (searchInput)
			searchInput.focus(); // focus
	};

	// Every time a select2 is opened
	$(document).on('select2:open', () => {
		// We use a timeout because when a select2 is already opened and you open a new one, it has to wait to find the appropiate
		setTimeout(() => forceFocusFn(), 200);
	});

});

// $(document).keydown(function(e) {

// 	if (e.keyCode == 27) {
// 		var db = sessionStorage;
// 		$('a[href="#mmenu"]').click();
// 		db.setItem('mmenuExpandedState', 'open');
// 		return false;
// 	}

// });

// 'use strict';

// $(document).ready(function() {

// 	var scroller = $('.scroller');

// 	$('[data-href],[href]').unbind().bind('click', function(e) {

// 		e.preventDefault();

// 		var href = $(this).data('href') || $(this).attr('href');
// 		var javascript = /^[J|j]ava[s|S]cript|^\#/;

// 		if (javascript.test(href)) {
// 			return;
// 		}

// 		var target = $(this).attr('target');

// 		if (target) {

// 			if (target === '_self')
// 				return window.location.href = href;
// 			else if (target === '_top')
// 				return null;
// 			else
// 				return window.open(href, target);

// 		}

// 		$('main .animated').removeClass('fadeIn').addClass('fadeOut');

// 		Url.update(href);

// 		redirect(href);

// 	});

// 	$(scroller).each(function() {

// 		var scroll = new PerfectScrollbar(this, {
// 			theme: "dark",
// 		});

// 		$(window).bind('resize', function() {
// 			scroll.update();
// 		});

// 	});

// 	var tabs = $('.tabs');
// 	var t = tabs.tabs({
// 		// swipeable: true
// 	});

// 	$('.materialboxed').materialbox();

// 	tabs.find('a').unbind().bind('click', function() {
// 		setTimeout(function() {
// 			t.tabs('updateTabIndicator');
// 		}, 100)
// 	});

// 	$('.tabs .tab a').each(function(index, element) {

// 		var id = $(this).attr('href');

// 		if ($(id).find('.input-field').hasClass('error')) {
// 			$(this).parents('.tabs, .tab').addClass('error');
// 			var tab = $($(this).parents('.tabs').find('.tab.error')[0]); // Exibir sempre a primeira "tab" da lista de erros
// 			if (tab.index() > -1) {
// 				var atual = $(tab.find(`a[href="${id}"]`)[0]).attr('href');
// 				if (typeof atual !== 'undefined')
// 					t.tabs('select', atual.replace('#', ''));
// 			}
// 		}

// 	});

// 	$('.collapsible').Menu();
// 	// $('#main-menu').Menu();

// 	$('select').formSelect();

// 	$('.input-field').each(function() {

// 		var field = $(this).find('input,textarea,select');

// 		if (field.val() != '') {
// 			$(this).find('label').addClass('active');
// 		}

// 	});

// 	$('[data-tooltip]').tooltip({
// 		transitionMovement: 10,
// 		margin: -5
// 	});

// 	var sidenav = $('.sidenav').sidenav({
// 		onCloseStart: () => {
// 			// var self = $('aside');
// 			// self.find('ul.submenu').removeClass('in out');
// 			// self.find('ul:not(.submenu)').removeClass('out').addClass('in');
// 		}
// 		// }).find('li').unbind().bind('click', function (e) {
// 		//     e.preventDefault();
// 	});

// 	sidenav.sidenav('close');

// 	$('.btn-menu').unbind().bind('click', function() {
// 		$('body').toggleClass('nav-collapsed');
// 	});

// 	$('button[type="reset"]').unbind().bind('click', function() {

// 		var action = $(this).parents('form').attr('action');

// 		$(this).parents('form.card-reveal').css({
// 			'transform': 'translateY(0%)',
// 		});

// 		Url.update(action);

// 	});

// 	$('#card-button,.icon-background').unbind().bind('click', function() {
// 		var url = $(this).data('href');
// 		$('form.card-reveal').show();
// 		if (typeof url !== 'undefined') {
// 			Url.update(url);
// 			$.ajax({
// 				url: url,
// 				method: 'get',
// 				success: (response) => {
// 					var form = $(response).find('form.card-reveal');
// 					$('form.card-reveal').html(form.html());
// 					$('form.card-reveal').css({
// 						'transform': 'translateY(-100%)',
// 					});
// 					$.getScript(BASE_PATH + 'assets/js/app.js');
// 				}
// 			});
// 		}
// 	});

// 	// activator

// 	// $('#card-button').unbind().bind('click', function () {

// 	//     var url = $(this).data('url');
// 	//     $('.card-reveal').show();

// 	//     if (typeof url !== 'undefined') {
// 	//         Url.update(url);

// 	//         $.ajax({
// 	//             url: url,
// 	//             method: 'get',
// 	//             success: (response) => {
// 	//                 var form = $(response).find('form.card-reveal');
// 	//                 $('form.card-reveal').html(form.html());
// 	//                 $.getScript(BASE_PATH + 'assets/scripts/app/clinica/app.js');
// 	//                 $('.card-reveal').css({
// 	//                     'transform': 'translateY(-100%)',
// 	//                 });
// 	//             }

// 	//         });

// 	//     }

// 	// });

// 	// $('aside').find('ul').each(function() {
// 	// 	var a = $(this).find('li').find('a[href="javascript:void(0);"]');
// 	// 	a.unbind().bind('click', function(e) {
// 	// 		var self = $(this).parents('ul');
// 	// 		var idMenu = $(this).data('id');
// 	// 		e.preventDefault();
// 	// 		if ($(this).hasClass('menu-close')) {
// 	// 			self.parents('aside').find('ul.in').removeClass('in');
// 	// 			self.parents('aside').find(idMenu).removeClass('in out').addClass('in');
// 	// 		} else {
// 	// 			self.removeClass('in').addClass('out');
// 	// 			self.parents('aside').find(idMenu).addClass('in');
// 	// 		}
// 	// 	});
// 	// });

// 	// $('aside').unbind().bind('mouseleave', function() {
// 	// 	var self = $(this);

// 	// 	// var timeout = setTimeout(function () {

// 	// 	// self.find('ul.submenu').removeClass('in out');
// 	// 	// self.find('ul:not(.submenu)').removeClass('out').addClass('in');

// 	// 	// self.find('a').parents('ul:not(.out):not(#main-menu)').removeClass('in out')
// 	// 	// self.find('a.active').parents('ul').removeClass('out').addClass('in');

// 	// 	var ul = self.find('.main-menu ul');
// 	// 	// for (var i in ul) {

// 	// 	// $(ul).each(function () {


// 	// 	//     var isIn = $(this).after().hasClass('in');
// 	// 	//     var isOut = $(this).before().hasClass('out');

// 	// 	//     console.log(isIn);

// 	// 	//     if (isOut) {
// 	// 	//         $(this).removeClass('out').addClass('in');
// 	// 	//     } else {
// 	// 	//         $(this).removeClass('in');
// 	// 	//     }

// 	// 	// })

// 	// 	// }


// 	// 	// }, 2000);

// 	// 	// $(this).bind('mouseenter', function () {
// 	// 	//     clearTimeout(timeout);
// 	// 	// });

// 	// });

// 	$('.card>.card-reveal').unbind().bind('mouseleave', function() {
// 		$(this).find('.card-title').click();
// 	});

// 	$('.input-field.error').find('input,textarea,select').each(function() {
// 		$(this).bind('keyup', function() {
// 			if ($(this).val().length > 0)
// 				$(this).parents('.input-field.error').removeClass('error').find('.error').hide();
// 			else
// 				$(this).parents('.input-field').addClass('error').find('.error').show();
// 		});
// 	});

// 	if (typeof FroalaEditor !== 'undefined')
// 		$('.editor').each(function() {
// 			var height = $(this).attr('rows') || $(this).parent().parent().height();
// 			var placeholder = ($(this).attr('placeholder') || 'Escreva aqui') + '...';
// 			new FroalaEditor(this, {
// 				// theme: 'light',
// 				language: 'pt_br',
// 				height: 300,
// 				placeholderText: placeholder,
// 				key: '1C%kZV[IX)_SL}UJHAEFZMUJOYGYQE[\\ZJ]RAe)+%$==',
// 				toolbarSticky: false,
// 				attribution: false,
// 				toolbarBottom: false,
// 				wordCounterCount: true,
// 				charCounterCount: true,
// 			});
// 		});

// });
