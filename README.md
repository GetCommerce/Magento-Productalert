#GetCommerce_Productalert
A Magento extension which adds a hourly option to Product Alerts Run Settings.

##Description

The default behaviour for Magento is to offer the Merchant the ability to set either a Daily, Weekly or Monthly option when it comes to sending Product Alerts such as "Back in Stock" notifications. This extension adds the ability to set notifications to be hourly.

##Installation

If you make use of modman use the "modman clone" command from the root of your Magento instance to install. If you don't use modman download the zip or clone repository and merge (excluding the modman file) with your Magento instance.

## Settings
Please see System > Configuration > Catalogue - Product Alerts Run Settings

### Notes
PLEASE BE AWARE THAT IF YOU HAVE A BUSY SITE WITH LOTS OF STOCK ADJUSTMENTS, AND USERS REGISTRING FOR PRODUCT ALERTS, THIS EXTENSION MAY NOTICABLY EFFECT PERFOMANCE. EMAILS BEING SENT EVERY HOUR COULD EAT UP RESOURCES DEPENDING ON NUMBER OF EMAILS BEING SENT. 