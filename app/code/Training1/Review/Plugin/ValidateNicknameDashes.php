<?php
namespace Training1\Review\Plugin;

use Magento\Review\Model\Review;

class ValidateNicknameDashes
{
    public function aroundValidate(Review $subject)
    {
    	// if (!\Zend_Validate::is($subject->getNickname(), 'Alnum')) {
     //        $errors[] = __('Please enter a VALID nickname.');
     //    }
    	if (preg_match('/-/', $subject->getNickname())) {
            $errors[] = __('Dashes are not allowed in nickname.');
        }
        
    	return $errors;
    }
  
}
