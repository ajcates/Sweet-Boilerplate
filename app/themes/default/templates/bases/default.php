<?=B::get('xhtml5', array(
	'head' => B::head(
		B::meta(array('charset' => 'utf-8')),
		B::title($siteName . ' - ' . $title),
		isset($headInclude) ? $headInclude : V::get('common/headIncludes')
	),
	'body' => B::body(
		array('class' => isset($bodyClass) ? $bodyClass : null),
		B::header(
			B::hgroup(
				B::h1(B::a(array('href' => URL), $siteName)),
				B::h3($siteTagline)
			),
			T::get('parts/common/nav')
		),
		B::hgroup(
			array('class' => 'title'),
			B::h2($title),
			isset($message) ? B::h2(array('class' => 'message'), $message) : null
		),
		(!empty($sidebar) ? B::aside($sidebar) : ''),
		B::__callStatic(!empty($mainTag) ? $mainTag : 'div', array(
			array('class' => 'main'),
			$content
		)),
		T::get('parts/common/footer')
	)
));