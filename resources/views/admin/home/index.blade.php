<x-admin-layout>

	<x-slot:title>Home</x-slot:title>

	<x-slot:body>
		<div class="container">
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
			Página inicial<br>
		</div>
	</x-slot:body>

	<x-slot:script>
		<script>
			$(document).ready(function() {

				var scroller = $('.scroller');

				$(scroller).each(function() {

					var scroll = new PerfectScrollbar(this, {
						theme: "dark",
					});

					$(window).bind('resize', function() {
						scroll.update();
					});

				});

				$('.sidenav').sidenav({
					onCloseStart: () => {
						var self = $('aside');

						self.find('ul.submenu').removeClass('in out');
						self.find('ul:not(.submenu)').removeClass('out').addClass('in');

					}
				});

				$('.btn-menu').unbind().bind('click', function() {

					$('body').toggleClass('nav-collapsed');

				});

				$('aside').find('ul').each(function() {

					var a = $(this).find('li').find('a[href="javascript:void(0);"]');

					a.unbind().bind('click', function(e) {

						var self = $(this).parents('ul');
						var idMenu = $(this).data('id');

						e.preventDefault();

						if ($(this).hasClass('menu-close')) {
							self.parents('aside').find('ul.in').removeClass('in');
							self.parents('aside').find(idMenu).removeClass('out').addClass('in');
						} else {
							self.removeClass('in').addClass('out');
							self.parents('aside').find(idMenu).addClass('in');
						}

					});

				});

				$('aside').unbind().bind('mouseleave', function() {
					var self = $(this);

					var timeout = setTimeout(function() {

						self.find('ul.submenu').removeClass('in out');
						self.find('ul:not(.submenu)').removeClass('out').addClass('in');

					}, 2000);

					$(this).bind('mouseenter', function() {
						clearTimeout(timeout);
					})

				});



				$('#open-search').bind('click', function() {
					// $(this).parents('li.search').find('input[type="search"]').show().focus();
					$('#input-search-header').show().focus()
						// .find('input[type="search"]')
						.bind('blur', function() {
							if ($(this).val().length === 0) {
								// $(this).val('').parents('li').removeClass('search-open');
								// $(this).parents('li.search').find('input[type="search"]').hide();
								$('#input-search-header').hide();
								$(this).parents('li.search').find('#open-search').show();
								$(this).parents().find('li:not(.search)').removeClass('disabled')
							}
						});
					// $(this).parents('li').addClass('search-open');
					$(this).parents().find('li:not(.search)').addClass('disabled')
				}) //.parents('li')
			})
		</script>
	</x-slot:script>

</x-admin-layout>