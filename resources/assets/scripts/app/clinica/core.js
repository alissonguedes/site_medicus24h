
var Url = {

    update: (url) => {
        window.history.pushState('', '', url);
    }

}


$(document).ready(function () {

    var scroller = $('.scroller');

    function redirect(url, method = 'get') {

        var xhr = new XMLHttpRequest();

        xhr.open(method, url);

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

                // Url.update(url);

            }

            // $('.progress').css('display', 'none');
            $('main .card .animated').removeClass('fadeOut').addClass('fadeIn');

        }

        xhr.send();

    }

    $('[data-href],[href]').unbind().bind('click', function (e) {

        e.preventDefault();

        var href = $(this).data('href') || $(this).attr('href');
        var javascript = /^[J|j]ava[s|S]cript|^\#/;

        if (javascript.test(href)) {
            return;
        }

        $('main .card .animated').removeClass('fadeIn').addClass('fadeOut');

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

    tabs.find('a').unbind().bind('click', function () {
        setTimeout(function () {
            t.tabs('updateTabIndicator');
        }, 100)
    });

    $('.collapsible').Menu();
    $('select').formSelect();

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

        $(this).parents('.card-reveal').css({
            'transform': 'translateY(0%)',
        });

        Url.update(action);

    });


    $('#card-button,.icon-background').unbind().bind('click', function () {
        var url = $(this).data('url');
        $('.card-reveal').show();
        if (typeof url !== 'undefined') {
            Url.update(url);
            $.ajax({
                url: url,
                method: 'get',
                success: (response) => {
                    var form = $(response).find('form.card-reveal');
                    $('form.card-reveal').html(form.html());
                    $('.card-reveal').css({
                        'transform': 'translateY(-100%)',
                    });
                    $.getScript(BASE_PATH + 'assets/scripts/app/clinica/core.js');
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

    // $('aside').find('ul').each(function() {
    // 	var a = $(this).find('li').find('a[href="javascript:void(0);"]');
    // 	a.unbind().bind('click', function(e) {
    // 		var self = $(this).parents('ul');
    // 		var idMenu = $(this).data('id');
    // 		e.preventDefault();
    // 		if ($(this).hasClass('menu-close')) {
    // 			self.parents('aside').find('ul.in').removeClass('in');
    // 			self.parents('aside').find(idMenu).removeClass('out').addClass('in');
    // 		} else {
    // 			self.removeClass('in').addClass('out');
    // 			self.parents('aside').find(idMenu).addClass('in');
    // 		}
    // 	});
    // });

    // $('aside').unbind().bind('mouseleave', function() {
    // 	var self = $(this);

    // 	var timeout = setTimeout(function() {

    // 		self.find('ul.submenu').removeClass('in out');
    // 		self.find('ul:not(.submenu)').removeClass('out').addClass('in');

    // 	}, 2000);

    // 	$(this).bind('mouseenter', function() {
    // 		clearTimeout(timeout);
    // 	});

    // });

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

    // $('[data-href]').unbind().bind('click', function () {
    //     var href = $(this).data('href');
    //     // alert('Href')
    //     // location.href = href;
    // });

    $('.input-field.error').find('input,textarea,select').each(function () {
        $(this).bind('keyup', function () {
            if ($(this).val().length > 0)
                $(this).parents('.input-field.error').removeClass('error').find('.error').hide();
            else
                $(this).parents('.input-field').addClass('error').find('.error').show();
        });
    });

    $('.editor').each(function () {
        var height = $(this).parent().parent().height();
        var placeholder = ($(this).attr('placeholder') || 'Escreva aqui') + '...';
        new FroalaEditor(this, {
            language: 'pt_br',
            height: height,
            placeholderText: placeholder,
            key: '1C%kZV[IX)_SL}UJHAEFZMUJOYGYQE[\\ZJ]RAe)+%$==',
            attribution: false,
            toolbarBottom: false,
            wordCounterCount: false,
            charCounterCount: false,
        });
    });

});