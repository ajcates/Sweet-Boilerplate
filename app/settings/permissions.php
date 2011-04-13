<? SweetFramework::getClass('lib', 'Config')->setAll('permissions', array(
	'users' => array(
		'canCreateUser' => array('god', 'admin', 'create_user', 'edit_user', 'change_user_perms', 'delete_user', 'change_user_perms'),
		'canEditUser' => array('god', 'admin', 'edit_user', 'change_user_perms', 'delete_user', 'change_user_perms'),
		'canChangePerms' => array('god', 'admin', 'change_user_perms', 'delete_user'),
		'canDeleteUser' => array('god', 'admin', 'change_user_perms', 'delete_user')
	),
	'groups' => array(
		'canViewGroups' => array('god', 'admin', 'user'),
		'canCreateGroup' => array('god', 'admin'),
		'canEditGroup' => array('god', 'admin'),
		'canDeleteGroup' => array('god', 'admin')
	),
	'head_index' => array(
		'add' => array('god', 'admin', 'add_head'),
		'edit' => array('god', 'admin', 'add_head', 'edit_head')
	),
	'machine_shop' => array(
		'edit_jobs' => array('god', 'admin', 'edit_jobs')
	)
));

/*
#Available Perms:
var $perms = array(
	'guest' => 1,
	'guest_head' => 2,
	'view_lookups' => 4,
	'user' => 8,
	'add_head' => 16,
	'edit_head' => 32,
	'delete_head' => 64,
	'add_jobs' => 128,
	'edit_jobs' => 256,
	'delete_jobs' => 512,
	'?10' => 1024,
	'?11' => 2048,
	'create_user' => 4096,
	'edit_user' => 8192,
	'change_user_perms' => 16384,
	'delete_user' => 32768,
	'admin' => 65536,
	'?17' => 131072,
	'god' => 262144
);

*/