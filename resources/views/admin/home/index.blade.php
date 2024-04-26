<x-admin-layout>

	<x-slot:title>Home</x-slot:title>

	<x-slot:body>
		Página inicial
	</x-slot:body>

	<x-slot:script>
		<script>
			$(document).ready(function() {

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
			})
		</script>
	</x-slot:script>

</x-admin-layout>
