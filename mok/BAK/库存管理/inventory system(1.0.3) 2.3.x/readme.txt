Inventory System Extension 1.0.2 for Opencart 2.x
===============================================

The Inventory System Extension allows the admin user to manage all purchases
(purchase orders, purchase returns), Suppliers (suppliers, supplier groups) and reports of 
received orders and pending orders 

Installation
============

Just need to upload directory according to file structure, some files will need to be replaced.

In the OpenCart admin backend, do the following steps:

Step 1)
	Download Inventory System Extension 1.0 and extract the folder

Step 2)
	Upload the folders inside the upload foler according to folder structure

Step 3)
	Go to admin panel of your store > Extensions > Extension Installer > upload 'inventorysystem.ocmod.xml'
	file in the downloaded package.
Step 4) 
	Then Go to Extensions > Modifications (Press the Refresh Button on the top right corner of the page)

Step 5)
	Also download the PHPMailer-master (.zip file) package from the following link
	https://github.com/PHPMailer/PHPMailer
	extract it, name it 'mail' and upload to your store
	
	root directory > system > library
Step 6)
	Create the folder with name 'orders' in your store root directory
Step 7)
	Go to System > Users > User Group > Edit Administrator

Step 8)
	Set access and modify permissions for 
				'purchase/pending_orders'
				'purchase/purhcase_order'
				'purchase/received_orders'
				'purchase/return_orders'
				'purchase/supplier'
				'purchase/supplier_group'
Step 9)
	Go to System > Tools > Backup/Restore
	and import all tables in the databases folder in the download package of Inventory System Extension 1.0
