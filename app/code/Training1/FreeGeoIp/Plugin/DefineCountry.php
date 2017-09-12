<?php
namespace Training1\FreeGeoIp\Plugin;

use Training1\FreeGeoIp\Api\DefineVisitorsCountryInterface;
use Magento\Theme\Block\Html\Header;

class DefineCountry
{
	/**
     * @var DefineVisitorsCountryInterface
     */
	private $defineVisitorsCountry;

	public function __construct(DefineVisitorsCountryInterface $defineVisitorsCountry)
    {
        $this->defineVisitorsCountry = $defineVisitorsCountry;
    }

    public function afterGetWelcome()
    {
    	$country = $this->defineVisitorsCountry->getCountry();
    	return 'Hello, '. $country;
    }
}
