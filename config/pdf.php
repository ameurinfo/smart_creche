<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Laravel Pdf',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('../temp/'),
	'pdf_a'                 => false,
	'pdf_a_auto'            => false,
	'icc_profile_path'      => '',
	'font_path' => base_path('public/fonts/'),
	'default_font' => 'vazirmatn',
	//'default_font' => 'amiri',
	//'default_font' => 'Noto Naskh Arabic',
	//'default_font' => 'cairo',
	//'default_font' => 'sans-serif',
	/* 'font_data' => [
		'amiri' => [
			'R'  => 'Amiri-Regular.ttf',    // regular font
			'B'  => 'Amiri-Bold.ttf',       // optional: bold font
			'I'  => 'Amiri-Italic.ttf',     // optional: italic font
			'BI' => 'Amiri-BoldItalic.ttf',  // optional: bold-italic font
			'useOTL' => 0xFF,
    		'useKashida' => 75,
		]
	] */ 
	'font_data' => [
		'vazirmatn' => [
			'R'  => 'Vazirmatn-Regular.ttf',    // regular font
			'B'  => 'Vazirmatn-Bold.ttf',       // optional: bold font
			'M'  => 'Vazirmatn-Medium.ttf',     // optional: italic font
			'SB' => 'Vazirmatn-SemiBold.ttf',  // optional: bold-italic font
			'useOTL' => 0xFF,
    		'useKashida' => 75,
		]
	] 
	/* 'font_data' => [
		'Noto Naskh Arabic' => [
				'R'  => 'NotoNaskhArabic-Regular.ttf',    // regular font
				'B'  => 'NotoNaskhArabic-Bold.ttf',       // optional: bold font
				'M'  => 'NotoNaskhArabic-Medium.ttf',     // optional: italic font
				'SB' => 'NotoNaskhArabic-SemiBold.ttf',  // optional: bold-italic font
				'useOTL' => 0xFF,
    			//'useKashida' => 75,
		]
	]  */
	/* 'font_data' => [
		'cairo' => [
				'R'  => 'Cairo-Regular.ttf',    // regular font
				'B'  => 'Cairo-Bold.ttf',       // optional: bold font
				'M'  => 'Cairo-Medium.ttf',     // optional: italic font
				//'SB' => 'NotoNaskhArabic-SemiBold.ttf',  // optional: bold-italic font
				'useOTL' => 0xFF,
    			'useKashida' => 75,
		]
	]   */
];
