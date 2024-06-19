'use strict';

(function($) {

	var main_menu = '.main-menu';
	var menu = $('body').find(main_menu);

	if (typeof menu !== 'undefined' && menu.length > 0)
		var scroller = new PerfectScrollbar(main_menu);

	function Menu(element, options) {

		var $this = $(element);

		this.initialize($this, options);
		this.menuCollapse($this);
		this.animations($this);

		if (typeof scroller !== 'undefined') {
			scroller.update();
			$(window).bind('resize', function() {
				scroller.update();
			});
		}

	}

	Menu.prototype.initialize = function(element, options) {

		var self = this;

		let $this = element;
		let url = [];
		let local = window.location.href.split(BASE_URL).splice(1);

		if (typeof local.toString() !== 'undefined') {

			let href = window.location.href;
			let link = local.toString().split('/');
			let cursor = link === href ? 'default' : 'pointer';
			let links = [];

			$this.find('li a').each(function() {

				// var href = $(this).attr('href').split(BASE_URL).splice(1).toString();
				var href = $(this).attr('href');

				if (typeof href !== 'undefined') {

					if (href !== '')
						links.push(href);

				}

			});

			var path = [];

			for (var i in links) {

				var f = links[i].split('/');

				for (var j in f) {
					path.push(f[j]);
				}

			}

			var l = '';
			var f = href.split(BASE_URL).splice(1).toString().split('/');

			for (var d in f) {

				if (path.indexOf(f[d].replace('#', '')) !== -1) {
					if (l !== '') l += '/';
					l += '/' + f[d].replace('#', '');
				}

			}

			var base_url = BASE_URL.split('/');
			var a = base_url[base_url.length - 1] == '' ? base_url.slice(0, -1) : base_url.join('/');

			$this.find('li a[href="' + a.join('/') + l + '"]')
				.addClass('active')
				.css('cursor', cursor)
				.parents()
				.addClass('active').show;

		} else {

			$this.find('li a').first().addClass('active').parents().addClass('active').show();

		}

		var button_sidebar = $('.nav-collapsible .navbar-toggler');

		button_sidebar.unbind()
			.on('click', function() {
				self.toggleMenu($this);
			});

	}

	Menu.prototype.menuCollapse = function(element) {

		var $this = element;
		var $navbar = $('.navbar .nav-collapsible');

		$('body').hasClass('menu-collapse') && 993 < $(window).width() && (
			$this.removeClass('nav-lock'),
			$navbar.removeClass('sideNav-lock'),
			this.toggleMenu($this),
			this.navCollapse($this)
		);

	}

	Menu.prototype.toggleMenu = function(element) {

		var $this = element;
		var value = null;

		$this.hasClass('nav-expanded') && !$this.hasClass('nav-lock') && $this.toggleClass('nav-expanded'),
			$('.horizontal-layout, #main').toggleClass('main-full');

		$this.removeClass('nav-expanded nav-collapsed').hasClass('nav-lock') ? (
			value = 'collapsed',
			$this.removeClass('nav-lock')
		) : (
			value = 'expanded',
			$this.addClass('nav-lock')
		);

		var data = {
			'method': 'patch',
			'data': {
				'config': 'main-menu-type',
				'value': value
			}
		};

		Http.post(BASE_URL + 'config', data, (response) => {

			if (response.message)
				M.toast({
					html: response.message,
				});

		});

		// $.getScript([BASE_PATH + 'assets/app/clinica/js/agendamentos/calendar.js'], function(e){
		// });

	}

	Menu.prototype.navCollapse = function(element) {

		var $this = element;

		if (!$this.hasClass('nav-lock')) {

			var n = $('.collapsible .open').children().length;

			$this.addClass('nav-collapsed')
				.removeClass('nav-expanded');

			$('.navbar .nav-collapsible').addClass('nav-collapsed')
				.removeClass('nav-expanded');

			$this.find('#slide-out > li.open > a').parent()
				.addClass('close')
				.removeClass('open');

			setTimeout(function() {
				if (1 < n) {
					var e = $this.find('.collapsible');
					M.Collapsible.getInstance(e).close($('.collapsible .close').index());
				}
			}, 100);

		}

	}

	Menu.prototype.animations = function(element) {

		var self = this;
		var $this = element;
		var sidenav = $this.find('.collapsible');
		var active = $this.find('li.active .collapsible-sub .collapsible');
		var collapsible = document.querySelectorAll('.collapsible');
		var expandeble = document.querySelectorAll('.collapsible.expandeble');

		M.Collapsible.init(collapsible, {
			accordion: true,
			onOpenEnd: () => {
				if (typeof scroller !== 'undefined') {
					scroller.update();
				}
			},
			onCloseEnd: () => {
				if (typeof scroller !== 'undefined') {
					scroller.update();
				}
			}
		});

		M.Collapsible.init(expandeble, {
			accordion: true,
			onOpenEnd: () => {
				if (typeof scroller !== 'undefined') {
					scroller.update();
				}
			},
			onCloseEnd: () => {
				if (typeof scroller !== 'undefined') {
					scroller.update();
				}
			}
		});

		var menuInit = M.Collapsible.init(sidenav, {
			accordion: true,
			onOpenStart: () => {
				$('.collapsible > li.open').removeClass('open');
				setTimeout(function() {
					$('#slide-out > li.active > a').parent().addClass('open');
				}, 100);
			},
		});

		$this.mouseleave(function() {
			// Adiciona ou remove a class `nav-expanded` ou `nav-collapsed`
			// Função $this.mouseenter(function(){ ..
			// self.navCollapse($this);
		});

		$this.mouseenter(function() {
			$this.hasClass('nav-lock') || $this.addClass('nav-expanded').removeClass('nav-collapsed'),
				$('#slide-out > li.close > a').parent().addClass('open').removeClass('close'),
				setTimeout(function() {
					if (1 < $('.collapsible .open').children().length) {
						var e = $this.find('.collapsible');
						M.Collapsible.getInstance(e).open($('.collapsible .open').index());
					}
				}, 100);
		});

		// Ocultar a barra de menus após clicar quando estiver em modo responsivo
		$('#slide-out').find('li [href],li [data-href]').bind('click', function() {

			var javascript = /^[J|j]ava[s|S]cript/;
			var href = $(this).data('href') || $(this).attr('href');
			if (window.innerWidth < 993)
				// 	if ($(this).Requests('isLink', $(this).attr('href'))) {
				if (!javascript.test(href))
					$('.sidenav').sidenav('close')
			// 	}


		});

		var t,
			i = $("li.active .collapsible-sub .collapsible"),
			s = document.querySelectorAll(".sidenav-main .collapsible");

		if (0 < i.find("a.active").length &&
			(i.find("a.active").closest("div.collapsible-body").show(),
				i.find("a.active").closest("div.collapsible-body").closest("li")
				.addClass("active")),
			t = 0 < $(".sidenav-main li a.active").parent("li.active").parent("ul.collapsible-sub").length ?
			$(".sidenav-main li a.active").parent("li.active").parent("ul.collapsible-sub").position() :
			$(".sidenav-main li a.active").parent("li.active").position(),
			setTimeout(function() {
				void 0 !== t && $(".sidenav-main ul").stop().animate({
					scrollTop: t.top - 300
				}, 600)
			}, 1));

	}

	Menu.prototype.menuCollapse = function(element) {

	}

	window.Menu = Menu;

	$.fn.Menu = function(options) {

		return this.each(function() {

			new Menu(this, options);

		});

	}

})(jQuery);
