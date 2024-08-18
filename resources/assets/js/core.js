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

	// window.addEventListener('keydown', function (e) {

	// 	console.log(e.keyCode);
	// 	// if(e.keyCode === 27) return false; e.preventDefault();

	// });

}

// if (window.XMLHttpRequest) {
// 	var $ = new XMLHttpRequest()
// } else if (window.ActiveXObject) {
// 	var $ = new ActiveXObject('Microsoft.XHMHTTP')
// }

function redirect(url, method = 'get') {

	var xhr = new XMLHttpRequest();

	xhr.open(method, url);

	xhr.onreadystatechange = function () { }

	xhr.onloadstart = function () { };

	xhr.onprogress = function (event) { }

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

var Url = {

	update: (url) => {
		window.history.pushState('', '', url);
	}

}

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

$('#input-search-header').bind('keyup paste', function () {

	$('.progress').show();

}).bind('keyup paste', delay(function () {

	var url = $(this).data('href') || $(this).data('url') || window.location.href;
	var search = $(this).val();

	console.log(url);

	$.ajax({
		url: url + '/' + search,
		method: 'get',
		success: (response) => {

			var parser = new DOMParser();
			var content = parser.parseFromString(response, 'text/html');

			$('main > .card > .card-content').html($(content).find('main > .card > .card-content').html());
			$('.progress').hide();

			$.getScript(BASE_PATH + 'assets/js/app.js');

		}
	})

}, 500));


$(function () {

	// $(document).keydown(function (e) {
	// 	if (e.keyCode == 27) return false;
	// });

	new Mmenu("#mmenu", {
		"offCanvas": {
			"position": "left-front"
		},
		"setSelected": {
			'current': 'detect',
			// "hover": true,
			// "parent": true
		},
		sidebar: {
			collapsed: {
				use: true
			},
			expanded: {
				use: true
			}
		},
		navbar: { title: 'Menu principal' },
	});

	// document.body.removeEventListener('keydown', document.body.mmEventKeydownTabguard[0])

	// $('#mm-open-menu').on('click', function() {
	// 	$('#mmenu').css({
	// 		'width': '300px !important',
	// 		'display': 'block'
	// 	})
	// })

});


$('body').bind('keydown', function (e) {

	// console.log(e.target.);
	// if (e.keyCode === 27) {
	// 	menuInit();
	// 	return false;
	// }

})