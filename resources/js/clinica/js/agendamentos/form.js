'use strict';

(function ($) {

    $.fn.Agendamentos = function (form, options) {

        $.fn.close = function (target) {

            $('html').removeAttr('style');

            if (typeof calendar !== 'undefined' && $('#calendar').length) {

                calendar.refetchEvents();

                progress('in', 'bar');

                var loading = $('<div>', {
                    id: 'await_calendar',
                    style: 'position: fixed; left: 0; right: 0; top: 0; bottom: 0; z-index: 9999; opacity: 0;'
                })

                $('body').prepend(loading);

                setTimeout(function () {
                    progress('out');
                    $('#await_calendar').remove();
                }, 1200)

            }

        }

        $.fn.open = function (e, options) {

            progress('in', 'bar');
            var self = this;

            var $this = $(e);
            var target = '#' + $this.attr('id');
            var form = $(target);
            var url = options.url || $(options).data('href') || $(options).data('url');
            var data = options.data;
            var modal = form.modal({
                dismissible: typeof $(target).data('dismissible') === 'undefined' || $(target).data('dismissible') === true,
            });

            $('html').css({
                'overflow': 'hidden'
            });

            form.empty();

            Http.get(url, {
                datatype: 'html',
                data: data,
            }, (response) => {

                form.html($(response).find(target).html());

                modal.modal('open');

                self.btn_recorrente();

                Core.prototype.construct();

                var m_event = $('#modal_event').modal();
                m_event.modal('close');
                var modal_event_details = $('#modal_event_details').modal();
                modal_event_details.modal('close');
                $('#modal_event,#modal_event_details').removeClass('open');

                form.find('.modal-close').bind('click', function () {
                    self.close(target);
                });

            });

            $.fn.btn_recorrente = function () {

                $('#recorrente').on('change', function () {
                    if ($(this).prop('checked')) {
                        $(this).parents('.input').css({
                            'border-bottom-left-radius': '0px',
                            'border-bottom-right-radius': '0px'
                        }).next('.days-of-week').slideDown(100);
                    } else {
                        $(this).parents('.input').css({
                            'border-bottom-left-radius': '24px',
                            'border-bottom-right-radius': '24px'
                        }).next('.days-of-week').slideUp(100);
                    }
                });

            }

        }

        var self = this;
        var $this = $('#agendamento').parents('form');

        Form.prototype.submit = function () {

            $this.on('submit', function () {

                var method = $this.attr('method') || 'post';
                var action = $this.attr('action') || null;
                var btn_submit = $this.find(':submit');

                var url = $(this).attr('action')
                var method = $(this).attr('method');
                var tipo = $('select[name="filtro_categoria_atendimento"]').val();

                $this.ajaxSubmit({
                    method: method,
                    action: action,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    beforeSend: (e) => {

                        progress('in', 'bar');
                        btn_submit.attr('disabled', true);

                    },
                    success: (response) => {

                        message(response);
                        btn_submit.attr('disabled', false);
                        self.close();

                    },
                    error: (error) => {

                        $this.find('.input-field,.input-field.file-field')
                            .removeClass('error')
                            .find('.error')
                            .remove();

                        errors($this, error);
                        progress('out');
                        btn_submit.attr('disabled', false);

                    }

                });

            });

        }

        return this.each(function () {

            if (typeof $.fn[form]) {

                $.fn[form](this, options);

            }

        })

    }

})(jQuery);

$('[data-trigger="form-sidenav"]').unbind().bind('click', function () {
    progress('in', 'bar');
    $('#' + $(this).data('target')).Agendamentos('open', this);
});
