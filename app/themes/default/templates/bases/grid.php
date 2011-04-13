<?=B::get('xhtml5', array(
	'head' => B::head(
		//B::meta(array('http-equiv' => 'Content-Type', 'content' => 'text/html; charset=utf-8')),
		B::meta(array('charset' => 'utf-8')),
		B::title($siteName . ' - ' . $title),
		V::get('common/gridIncludes', array('jqGrid' => $jqGrid)),
		V::get('common/headIncludes')
	),
	'body' => B::body(
		B::header(
			B::hgroup(
				B::h1(B::a(array('href' => URL), $siteName)),
				B::h2($siteTagline)
			),
			T::get('parts/common/nav')
		),
		(!empty($message) ?
			B::hgroup(array('class' => 'title'), B::h2(array('class' => 'message'), $message))
		:''),
		B::div(
			array('class' => 'main'),
			T::get('parts/grid-actions'),
			B::article(
				array('id' => 'jqGrid', 'class' => 'content grid'),
				B::table(array('id' => 'data'), ''),
				B::div(array('id' => 'pager'), '')
			)
		),
		T::get('parts/common/footer')
	)
));

/*
@todo
Make this a more dynamic form builder to show off how cool blocks reall can be.
*/