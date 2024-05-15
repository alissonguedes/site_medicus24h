'use strict';

// progress('out')

var grid_view = $('#dropdown-calendar-view li.active').find('[data-grid-view]').data('grid-view');
var url = BASE_URL + 'agendamentos/r/'; // $('#dropdown-calendar-view li.active').find('a').attr('href');
var calendar = new FullCalendar.Calendar(document.querySelector('#calendar'), {
    initialDate: $('[data-timestamp]').data('timestamp').replace(/\//g, '-'),
    initialView: grid_view != 'month' ? 'timeGrid' + ucfirst(grid_view) : 'dayGrid' + ucfirst(grid_view),
    timeZone: 'America/Sao_Paulo',
    locale: 'pt-br',
    views: {
        dayGridMonth: {
            titleFormat: {
                // day: '2-digit',
                month: 'long',
                year: 'numeric'
            }
        },
        timeGridWeek: {
            titleFormat: {
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            }
        },
        timeGridDay: {
            titleFormat: {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            }
        }
    },
    navLinks: true,

    displayEventTime: true,
    eventTimeFormat: {
        hour: '2-digit',
        minute: '2-digit',
    },

    dayMaxEvents: true,
    height: '100%',
    contentHeight: '100vh',
    fixedWeekCount: false,
    expandRows: true,
    lazyFetching: true,
    nowIndicator: true,

    moreLinkContent: function (l) {
        return 'Mais ' + l.num;
    },

    loading: function (e) {
        progress('in', 'bar');
        var loading = $('<div>', {
            id: 'await_calendar',
            style: 'position: fixed; left: 0; right: 0; top: 0; bottom: 0; z-index: 9999; opacity: 0;'
        })
        $('body').prepend(loading);
        setTimeout(function () {
            $('#await_calendar').remove();
        }, 200)
    },

    events: {
        url: BASE_URL + 'agendamentos',
        method: 'get',
        extraParams: {
            ajax: true
        },
        success: (response) => {
            progress('out');
        }
    },

    dayPopoverFormat: {
        // month: 'short',
        day: 'numeric',
        // year: '2-digit'
        weekday: 'short',
        omitCommas: true
    },

    moreLinkClick: function (e) {
        console.log(e);
        setTimeout(function () {
            var text = $('.fc-popover-title').text().split(' ');
            $('.fc-popover-title').html(`
			<span class="fc-popover-weekday">${text[0]}</span>
			<span class="fc-popover-date">${text[1]}</span>`);
        }, 1);
    },

    navLinkDayClick: function (d) {

        var date = calendar.formatDate(d, {
            year: 'numeric',
            month: 'numeric',
            day: 'numeric'
        }).split('/').reverse().join('/');

        Http.get(BASE_URL + 'agendamentos/r/day/' + date);

    },

    eventClick: function (e) {

        e.jsEvent.preventDefault();

        var id = e.event.id;
        var url = e.event.url;

        event_details(id);

    },

    dateClick: function (e) {

        // var timestamp = this.formatDate(e.dateStr, {
        //     year: 'numeric',
        //     month: 'numeric',
        //     day: 'numeric',
        //     hour: 'numeric',
        //     minute: 'numeric',
        //     second: 'numeric'
        // });


        // var date = timestamp.split(',')[0].toString();
        // var hour = timestamp.split(',')[1].toString();

        // var data = {
        //     'url': BASE_URL + 'agendamentos/new',
        //     'modal': 'agendamento',
        //     'data': {
        //         'data': date.trim(),
        //         'hora': hour.trim()
        //     }
        // }

        // $('#agendamento').Agendamentos('open', data);


        var modal_event_details = $('#modal_event_details').modal({

            onOpenStart: () => {
				$('.preloader').addClass('skeleton');
            },

            onOpenEnd: () => {

				var date = this.formatDate(e.dateStr, {
					year: 'numeric',
                    month: 'numeric',
                    day: 'numeric',
                });

                setTimeout(function () {
					$('.preloader').removeClass('skeleton')
                    $('#modal_event_details').find('h4.modal-title').text('Agendamentos para o dia ' + date);
                }, 5000);

                console.log(e);

            }
        });
        modal_event_details.modal('open');

    },

});

calendar.render();

/**
 * Função para abrir detalhes do agendamento
 */
var event_details = function (id) {

    var modal = $('#modal_event').modal({

        dismissible: typeof $('#modal_event').data('dismissible') === 'undefined' || $('#modal_event').data('dismissible') === true,

        onOpenStart: () => {

            $('.preloader').addClass('skeleton');

            $.ajax({
                url: BASE_URL + 'agendamentos/details/' + id,
                method: 'get',
                datatype: 'html',
                data: {
                    id: id
                },
                success: (response) => {
                    $('#modal_event').html($(response).find('#modal_event').html());
                    $('.preloader').removeClass('skeleton')
                    Core.prototype.construct();
                    agendamentos_dia();
                }
            });

        },

    });

    modal.modal('open');

}

/**
 * Função para atualizar informações da data corrente no navegador nos locais de url, títulos e botões
 * @param calendar
 */
var goToDate = function (calendar) {

    var url = $('.calendar-grid-view').data('url');
    var date = calendar.getDate();

    date = calendar.formatDate(date, {
        year: 'numeric',
        month: 'numeric',
        day: 'numeric'
    }).split('/').reverse().join('/');

    refreshUrl(url + '/' + date);

    $('.calendar-title').data('timestamp', date).text(ucfirst($('.fc-toolbar-title').text()))

}

/**
 * Fução para modificar o tipo e títulos conforme a visualização
 * @param view
 */
function changeView(view) {

    if (view) {
        $('#dropdown-calendar-view li').removeClass('active');
        var calendar_view = $('#dropdown-calendar-view li').find('[data-grid-view="' + view + '"]');
        var text = calendar_view.parent().addClass('active').children().text().trim();
        url = BASE_URL + 'agendamentos/r/' + view + ($('[data-timestamp]').data('timestamp') ? '/' + $('[data-timestamp]').data('timestamp') : null);
        Http.get(url);
    } else {
        url = url + $('#dropdown-calendar-view li.active').find('[data-grid-view]').data('grid-view');
        var text = $('#dropdown-calendar-view li.active').find('[data-grid-view]').text().trim();
    }

    $('.calendar-grid-view').attr('data-url', url).text(text);

}

$('[data-trigger="calendar-prev"]').unbind().bind('click', function () {
    calendar.prev();
    goToDate(calendar);
})

$('[data-trigger="calendar-next"]').unbind().bind('click', function () {
    calendar.next();
    goToDate(calendar);
});

$('[data-trigger="today"]').unbind().bind('click', function () {
    calendar.today();
    goToDate(calendar);
})

$('[data-grid-view]').unbind().bind('click', function () {
    var viewKey = $(this).data('grid-view');
    changeView(viewKey);
});

changeView();
goToDate(calendar);

// // var tipo = $('select[name="filtro_categoria_atendimento"]').val();

// // var data = tipo !== 'undefined' && tipo != null ? {
// //     'tipo': tipo
// // } : null;

// // $('select[name="filtro_categoria_atendimento"]').on('change', function () {
// //     tipo = $(this).val();
// //     // Calendar({
// //     // 	'tipo': tipo
// //     // })
// // });

// // $('#modal-filter').find(':button:reset').on('click', function () {

// //     $(this).parents('#modal-filter').find('select,input').each(function () {
// //         var value = ''; // $(this).data('value');
// //         $(this).val(value) // .find('option[value=""]').attr('selected', true)
// //             .trigger('change');
// //     })

// // })

// // var time = 3000;

// // function showEventDetails(element) {

// //     // var modal = $('.modal#agendamento_detalhes').modal();
// //     // modal.modal('open');

// // }

// // var calendar = document.querySelector('#calendar');
// // var calendar = new FullCalendar.Calendar(calendar, {
// //     // initialView: 'dayGridDay',
// //     initialView: 'dayGrid' + ($('[data-view]').data('view') || 'Week'),
// //     // initialView: 'timeGridWeek',//'dayGrid' + ($('[data-view]').data('view') || 'Week'),
// //     timeZone: 'America/Sao_Paulo',
// //     selectable: true,
// //     locale: 'pt-br',
// //     navLinks: false, // can click day/week names to navigate views
// //     dayMaxEvents: true, // allow "more" link when too many events
// //     height: '100%',
// //     contentHeight: '100vh',
// //     initialDate: $('[data-timestamp]').data('timestamp'),
// //     headerToolbar: {
// //         left: 'listWeek,dayGridWeek,dayGridMonth',
// //         center: 'title',
// //         right: 'today prev,next',
// //     },
// //     fixedWeekCount: false,
// //     expandRows: true,


// //     eventOverlap: function (stillEvent, movingEvent) {
// //         return stillEvent.allDay && movingEvent.allDay;
// //     },

// //     eventMouseEnter: function (e) {

// //         var $this = $(e.el);
// //         var w = e.jsEvent.screenX;
// //         var h = e.jsEvent.screenY;

// //         console.log(e, w, h);

// //         var details = setTimeout(function (e) {
// //             showEventDetails($this);
// //         }, 5000);

// //         $this.on('mouseleave', function () {
// //             clearTimeout(details);
// //         })

// //     },

// //     eventMouseLeave: function (e) {
// //     },

// //     eventClick: function (e) {

// //         e.jsEvent.preventDefault();

// //         var id = e.event.id;
// //         var url = e.event.url;

// //         var data = {
// //             'url': url,
// //             'modal': 'agendamento'
// //         }

// //         $('#agendamento').Agendamentos('open', data);

// //         $('.fc-popover').remove();

// //     },

// //     dateClick: function (e) {

// //         var timestamp = this.formatDate(e.dateStr, {
// //             year: 'numeric',
// //             month: 'numeric',
// //             day: 'numeric',
// //             hour: 'numeric',
// //             minute: 'numeric',
// //             second: 'numeric'
// //         });


// //         var date = timestamp.split(',')[0].toString();
// //         var hour = timestamp.split(',')[1].toString();

// //         // var date = '';
// //         // var hour = '';

// //         // console.log(date, hour.trim());

// //         var data = {
// //             'url': BASE_URL + 'agendamentos/new',
// //             'modal': 'agendamento',
// //             'data': {
// //                 'data': date.trim(),
// //                 'hora': hour.trim()
// //             }
// //         }

// //         $('#agendamento').Agendamentos('open', data);

// //     },

// //     titleFormat: {
// //         month: 'long',
// //         year: 'numeric',
// //         // day: 'numeric',
// //     },

// //     buttonText: {
// //         today: 'Hoje',
// //         month: 'Mês',
// //         week: 'Semana (Hora)',
// //         dayGridWeek: 'Semana',
// //         day: 'Dia (Hora)',
// //         list: 'Lista',
// //     },

// //     moreLinkContent: function (e) {

// //         return {
// //             html: '<b>Mais ' + e.num + '<b>'
// //         };

// //     },

// //     dayPopoverFormat: function (e) {

// //         console.log(e);

// //         var start = e.date.year + '-' + (e.date.month) + '-' + e.date.day + 'T' + e.date.hour + ':' + e.date.minute + ':' + e.date.second;
// //         var end = e.date.year + '-' + (e.date.month) + '-' + e.date.day + 'T' + e.date.hour + ':' + e.date.minute + ':' + e.date.second;

// //         console.log(start);

// //         $.ajax({
// //             url: BASE_URL + 'agendamentos/eventos',
// //             dataType: 'ajax',
// //             data: {
// //                 start: start,
// //                 end: end,
// //                 ajax: true
// //             },
// //             success: (response) => {
// //                 progress('out');
// //             }
// //         })

// //     },

// //     eventContent: (arg) => {
// //         // return {
// //         // 	html: arg.event.title
// //         // }
// //     }

// // });

// // var updateTitle = function (calendar) {

// //     var title = calendar.currentData.viewTitle;
// //     var upper = title[0].toUpperCase();
// //     var title = upper + title.split('').splice(1).join('');

// //     var date = calendar.getDate();
// //     var date = calendar.formatDate(date, {
// //         year: 'numeric',
// //         month: 'numeric',
// //     });

// //     $('.calendar-title').attr('data-timestamp', date.split('/').reverse().join('/')).html(title);

// // }

// // var goToDate = function (calendar, view = '') {

// //     var view = view != '' ? view : $('[data-view]').data('view');
// //     var dateTimes = $('.calendar-title').data('timestamp');

// //     var d1 = null;
// //     var d2 = null;

// //     var d1 = calendar.getDate();
// //     d1 = calendar.formatDate(d1, {
// //         year: 'numeric',
// //         month: 'numeric'
// //     }).split('/').reverse().join('/');

// //     var date = calendar.formatDate(dateTimes, {
// //         year: 'numeric',
// //         month: 'numeric',
// //     }).split('/').reverse().join('-');

// //     console.log(d1, d2, date + '-01', dateTimes);

// //     var href = $('.calendar-button').data('url');

// //     $('.calendar-title').data('timestamp', date + '-01');

// //     // // dateTimes.split('-').slice(0, -1).join('/')
// //     console.log(href + '/' + d1, view);
// //     refreshUrl(href + '/' + view.toLowerCase() + '/' + d1);
// //     updateTitle(calendar);

// // }

// // $('[data-trigger="btn-calendar-today"]').attr('data-tooltip', moment(calendar.currentData.currentDate).format('dddd, DD [de] MMMM [de] YYYY')).unbind().bind('click', function () {
// //     calendar.today();
// //     var view = $('[data-view]').data('view');
// //     goToDate(calendar, view);
// // });

// // $('[data-trigger="btn-calendar-prev"]').unbind().bind('click', function () {
// //     calendar.prev();
// //     var view = $('[data-view]').data('view');
// //     goToDate(calendar, view);
// // });

// // $('[data-trigger="btn-calendar-next"]').unbind().bind('click', function () {
// //     var view = $('[data-view]').data('view');
// //     calendar.next();
// //     goToDate(calendar, view);
// // });

// // $('[data-trigger="btn-calendar-day"]').unbind().bind('click', function () {
// //     calendar.changeView('dayGridDay');
// //     $('[data-view]').text('Dia');
// //     $('[data-view]').attr('data-view', 'Day');
// //     goToDate(calendar, 'day');
// // });
// // $('[data-trigger="btn-calendar-week"]').unbind().bind('click', function () {
// //     calendar.changeView('dayGridWeek');
// //     $('[data-view]').text('Semana');
// //     $('[data-view]').attr('data-view', 'Week');
// //     goToDate(calendar, 'week');
// // });
// // $('[data-trigger="btn-calendar-month"]').unbind().bind('click', function () {
// //     calendar.changeView('dayGridMonth');
// //     $('[data-view]').text('Mês');
// //     $('[data-view]').attr('data-view', 'Month');
// //     goToDate(calendar, 'month');
// // });

// // calendar.render();
// // goToDate(calendar);
