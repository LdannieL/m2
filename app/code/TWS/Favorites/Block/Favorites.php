<?php
namespace TWS\Favorites\Block;

use Magento\Framework\View\Element\Template;
use TWS\Favorites\Model\FavoritesRepository;


class Favorites extends Template
{
	protected $customerSession;
	private $favoritesRepository;

	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        array $data = [],
		FavoritesRepository $favoritesRepository
    ) {
        parent::__construct($context, $data);

        $this->customerSession = $customerSession;
		$this->favoritesRepository = $favoritesRepository;
    }

    function _prepareLayout(){}

    public function getCustomerId()
    {
    	return $this->customerSession->getCustomer()->getId();
    }

    public function isCustomerLoggedIn()
    {
    	return $this->customerSession->isLoggedIn();
    }   

    public function getFavoriteIdsJson()
    {
    	$customerId = $this->getCustomerId();
        $favorites = $this->favoritesRepository->getFavoriteIdsJson($customerId);

        return $favorites;
    }
}
