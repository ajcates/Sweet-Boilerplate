# CRAD-DB Todo #
================

TESTS
=====

Models to test
--------------
	- Head_Index and its submodels
		- 	private $connectedTables = array('Wood_Basic_Head_Measurement', 'Wood_USGA_Head_Measurement', 'Wood_Extended_Head_Measurement');
	- Loft and Manufacturer models
	- Comments

SweetFramework Tests:
---------------------
	- Uri lib
	- Query lib
	- Session lib
	- SweetModel lib


-For each todo item there needs to be a way to test if its done.


Master/Misc
-----------

- Double slash sometimes appears in the url bug.
?# /?read() needs to be ported
	
	# the $tempPull needs to turn into a $model->gridPull property
		- and bug checked
		# Need to fix the Array in the JOIN statement the gridPull is generating
		# Need to figure out why I can't __get items out of the SweetRows the info() is trying to pull.


lookups
-------
# Get single lookup editing working aka /?lookups/edit/Models/96
- Fix the Model files for the lookup tables

# Get it showing lookup items when you go to something like: ?lookups/items/Grip_Weight
# Make the sidebar's "selected" class work in the css


new-sort-style
--------------
# Fix the sorting of related items on Head_Index
	
	
grid-model-views
----------------
- give the other jqGrid Models grid-model-json views
	- Wood_Extended_Head_Measurement
	- Wood_USGA_Head_Measurement
	- Wood_Basic_Head_Measurement

