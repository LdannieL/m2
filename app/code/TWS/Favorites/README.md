
# magento2-favorites

<h2>Composer Installation Instructions</h2>
Add GIT Repository to composer
<pre>
composer config repositories.tws-magento2-favorites vcs https://github.com/LdannieL/magento2-favorites/
</pre>

Since this package is in a development stage, you will need to change the minimum-stability as well to the composer.json file: -
<pre>
"minimum-stability": "dev",
</pre>

After that, need to install this module as follows:
<pre>
  composer require magento/magento-composer-installer
  composer require tws/favorites
</pre>


<br/>
<h2> Mannual Installation Instructions</h2>
go to Magento2Project root dir 
create following Directory Structure :<br/>
<strong>/Magento2Project/app/code/TWS/Favorites</strong>
you can also create by following command:
<pre>
cd /Magento2Project
mkdir app/code/TWS
mkdir app/code/TWS/Favorites
</pre>



<h3> Enable TWS/Favorites Module</h3>
to Enable this module you need to follow these steps:

<ul>
<li>
<strong>Enable the Module</strong>
<pre>bin/magento module:enable TWS_Favorites</pre></li>
<li>
<strong>Run Upgrade Setup</strong>
<pre>bin/magento setup:upgrade</pre></li>
<li>
<strong>Re-Compile (in-case you have compilation enabled)</strong>
	<pre>bin/magento setup:di:compile</pre>
</li>
</ul>


