<?
$navItems = array(
	'Home' => array(
		'Dashboard' => SITE_URL,
	),
	'Bustr' => array(
		'Gun Matchr' => SITE_URL . 'holster-guns',
		'Bailr' => SITE_URL . 'holsterBuster'
	),
	'Scrapr' => array(
		'Product Page' => SITE_URL . 'scrapr/product'
	)
);
 


/*
$navItems = array(
	'Home' => array(
		'Dashboard' => '',
		'Users' => 'users',
		'Logout' => 'logout'
	),
	'Input' => array(
		'Head' => 'input/Head_Index',
		'Lookups' => 'lookups'
	)
);
*/

echo B::nav(B::ul(
	join(f_keyMap(
		function($cat, $label) {
			if(is_string($cat)) {
				if(T::navLocation() == $label) {
					return B::li(array('class' => 'selected'), B::a(array('href' => $cat), $label));
				} else {
					return B::li(B::a(array('href' => $cat), $label));
				}
			}
			return B::li(
				B::h4($label),
				B::ul(join(f_keyMap(
					function($location, $nav) {
						if(T::navLocation() == $nav) {
							return B::li(array('class' => 'selected'), B::a(array('href' => $location), $nav));
						} else {
							return B::li(B::a(array('href' => $location), $nav));
						}
					},
					$cat
				)))
			);
		},
		$navItems
	))
));
?>


<?
/*
B::nav(B::ul(
	B::li(
		B::h4(B::a(array('href' => SITE_URL), 'Home')),
		B::ul(
			B::li('Dashboard'),
 			B::li('Users'),
			B::li('Logout')
		)
	),
	B::li(
		B::h4(B::a(array('href' => '#'), 'Input')),
		B::ul(
			B::li('Head'),
 			B::li('Lookups')
		)
	)
));
*/