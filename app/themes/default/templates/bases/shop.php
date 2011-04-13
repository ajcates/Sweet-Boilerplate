<?=B::get('xhtml5', array(
	'head' => B::head(
		//B::meta(array('http-equiv' => 'Content-Type', 'content' => 'text/html; charset=utf-8')),
		B::meta(array('charset' => 'utf-8')),
		B::title($siteName . ' - ' . $title),
		V::get('common/gridIncludes'),
		V::get('common/headIncludes')
	),
	'body' => B::body(
		B::header(
			B::hgroup(
				B::h1(B::a(array('href' => URL), $siteName)),
				B::h2($siteTagline . ' - ' . $title)
			),
			T::get('parts/common/nav')
		),
		(!empty($message) ?
			B::hgroup(array('class' => 'title'), B::h2(array('class' => 'message'), $message))
		:''),
		B::div(array('class' => 'mainBody'), $jqGrid),
		T::get('parts/common/footer')
	)
));
