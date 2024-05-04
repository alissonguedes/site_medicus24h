<?php

return [
	'title'       => env('SITE_TITLE', 'Médicus24h - Soluções em saúde'),
	'description' => env('SITE_DESCRIPTION', 'A Médicus24h é uma empresa que nasceu com um olhar humanizado ao seu associado. A longa experiência de seus profissionais no serviço de home care possibilitou a criação do melhor programa de assistência médica da Paraíba, ampliando os cuidados médicos a domicílio para toda a população, possibilitando o atendimento de urgências médicas 24 horas por dia e a prevenção contra doenças através do seu programa médico.'),
	'robots'      => env('SITE_ROBOTS', 'index, follow'),
	'keywords'    => env('SITE_KEYWORDS', 'médicus, médico, telemedicina'),
	'author'      => env('SITE_AUTHOR', 'Alisson Guedes'),
	'theme-color' => env('THEME_COLOR', '#d23740'),
	'manifest'    => env('MANIFEST'),
	'type'        => env('SITE_TYPE', 'health, telemedicina, saúde'),
	'locale'      => env('APP_LOCALE'),
	'language'    => env('APP_LOCALE'),
	// 'logo'        => env('SITE_LOGO', asset('assets/img/logo/logo.png')),
	// 'url'         => url('/'),
];
