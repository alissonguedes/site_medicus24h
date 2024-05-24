// 'use strict';

function redirect(url, method = 'get') {

    var xhr = new XMLHttpRequest();

    xhr.open(method, url);

    xhr.onreadystatechange = function () {

        // if (xhr.readyState === xhr.HEADERS_RECEIVED) {
        //     const contentType = client.getResponseHeader("Content-Type");
        //     if (contentType !== my_expected_type) {
        //         client.abort();
        //     }
        // }
        // console.log(xhr);
        // if (xhr.status === 302) {
        //     location.reload();
        // }

    }

    xhr.onloadstart = function () {
        // $('.progress').css('display', 'block');
    };

    xhr.onprogress = function (event) {
        // $('.progress').css('display', 'block');
    }

    xhr.onloadend = function (e) {

        if (xhr.readyState === 4) {

            var parser = new DOMParser();
            var content = parser.parseFromString(xhr.response, 'text/html');
            var response = content;
            var title = response.querySelector('title');
            var url = xhr.responseURL;


            if (title)
                document.title = title.innerHTML;

            $('#page').html($(response).find('#page').html());

        }

        $('main .card .animated').removeClass('fadeOut').addClass('fadeIn');

        // require([BASE_PATH+'node_modules/pace-js/pace.js'], function(){
        //     Pace.done();
        // });

    }

    xhr.send();

}

function delay(func, wait, immediate) {

    var timeout;

    return function (args) {
        const context = this;
        const later = function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };

        const callnow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callnow) func.apply(context, args);
    }

}

window.onload = () => {

    if (typeof redirect === 'function') {

        window.addEventListener('popstate', function () {

            var href = window.location.href;
            var javascript = /^[J|j]ava[s|S]cript|^\#/;

            if (javascript.test(href)) {
                this.alert('teste')
                return;
            }

            redirect(href);

        }, true);

    }

}

var Url = {

    update: (url) => {
        window.history.pushState('', '', url);
    }

}

$(document).ready(function () {

    var scroller = $('.scroller');

    $('[data-href],[href]').unbind().bind('click', function (e) {

        e.preventDefault();

        var href = $(this).data('href') || $(this).attr('href');
        var javascript = /^[J|j]ava[s|S]cript|^\#/;

        if (javascript.test(href)) {
            return;
        }

        var target = $(this).attr('target');

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

    $(scroller).each(function () {

        var scroll = new PerfectScrollbar(this, {
            theme: "dark",
        });

        $(window).bind('resize', function () {
            scroll.update();
        });

    });

    var tabs = $('.tabs');
    var t = tabs.tabs({
        // swipeable: true
    });

    $('.materialboxed').materialbox();

    tabs.find('a').unbind().bind('click', function () {
        setTimeout(function () {
            t.tabs('updateTabIndicator');
        }, 100)
    });

    $('.tabs .tab a').each(function (index, element) {

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
    $('#main-menu').Menu();
    $('select').formSelect();

    $('.input-field').each(function () {

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
            var self = $('aside');
            self.find('ul.submenu').removeClass('in out');
            self.find('ul:not(.submenu)').removeClass('out').addClass('in');
        }
        // }).find('li').unbind().bind('click', function (e) {
        //     e.preventDefault();
    });

    sidenav.sidenav('close');

    $('.btn-menu').unbind().bind('click', function () {
        $('body').toggleClass('nav-collapsed');
    });

    $('button[type="reset"]').unbind().bind('click', function () {

        var action = $(this).parents('form').attr('action');

        $(this).parents('form.card-reveal').css({
            'transform': 'translateY(0%)',
        });

        Url.update(action);

    });


    $('#card-button,.icon-background').unbind().bind('click', function () {
        var url = $(this).data('href');
        $('form.card-reveal').show();
        if (typeof url !== 'undefined') {
            Url.update(url);
            $.ajax({
                url: url,
                method: 'get',
                success: (response) => {
                    var form = $(response).find('form.card-reveal');
                    $('form.card-reveal').html(form.html());
                    $('form.card-reveal').css({
                        'transform': 'translateY(-100%)',
                    });
                    $.getScript(BASE_PATH + 'assets/js/core.js');
                }
            });
        }
    });

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
    //                 $.getScript(BASE_PATH + 'assets/scripts/app/clinica/core.js');
    //                 $('.card-reveal').css({
    //                     'transform': 'translateY(-100%)',
    //                 });
    //             }

    //         });

    //     }

    // });

    $('aside').find('ul').each(function () {
        var a = $(this).find('li').find('a[href="javascript:void(0);"]');
        a.unbind().bind('click', function (e) {
            var self = $(this).parents('ul');
            var idMenu = $(this).data('id');
            e.preventDefault();
            if ($(this).hasClass('menu-close')) {
                self.parents('aside').find('ul.in').removeClass('in');
                self.parents('aside').find(idMenu).removeClass('in out').addClass('in');
            } else {
                self.removeClass('in').addClass('out');
                self.parents('aside').find(idMenu).addClass('in');
            }
        });
    });

    $('aside').unbind().bind('mouseleave', function () {
        var self = $(this);

        var timeout = setTimeout(function () {

            self.find('ul.submenu').removeClass('in out');
            self.find('ul:not(.submenu)').removeClass('out').addClass('in');

        }, 2000);

        $(this).bind('mouseenter', function () {
            clearTimeout(timeout);
        });

    });

    $('#open-search').bind('click', function () {
        $('#input-search-header').show().focus()
            .bind('blur', function () {
                if ($(this).val().length === 0) {
                    $('#input-search-header').hide();
                    $(this).parents('li.search').find('#open-search').show();
                    $(this).parents().find('li:not(.search)').removeClass('disabled')
                }
            });
        $(this).parents().find('li:not(.search)').addClass('disabled')
    });

    $('#input-search-header').unbind().bind('keyup', function () {

        $('.progress').show();

    }).bind('keyup', delay(function () {

        var url = window.location.href;
        var search = $(this).val();

        $.ajax({
            url: url + '/' + search,
            method: 'get',
            success: (response) => {

                var parser = new DOMParser();
                var content = parser.parseFromString(response, 'text/html');

                $('main > .card > .card-content').html($(content).find('main > .card > .card-content').html());
                // Url.update(url + '/' + search);
                $('.progress').hide();
                $.getScript(BASE_PATH + 'assets/js/core.js');

            }
        })

    }, 500));

    $('.card>.card-reveal').unbind().bind('mouseleave', function () {
        $(this).find('.card-title').click();
    });

    $('.input-field.error').find('input,textarea,select').each(function () {
        $(this).bind('keyup', function () {
            if ($(this).val().length > 0)
                $(this).parents('.input-field.error').removeClass('error').find('.error').hide();
            else
                $(this).parents('.input-field').addClass('error').find('.error').show();
        });
    });

    $('.editor').each(function () {
        var height = $(this).attr('rows') || $(this).parent().parent().height();
        var placeholder = ($(this).attr('placeholder') || 'Escreva aqui') + '...';
        new FroalaEditor(this, {
            theme: 'dark',
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

});
