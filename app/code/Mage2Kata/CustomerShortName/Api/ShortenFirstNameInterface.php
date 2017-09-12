<?php

namespace Mage2Kata\CustomerShortName\Api;

interface ShortenFirstNameInterface
{
    /**
     * @param string $firstname
     * @return string
     */
    public function shorten($firstname);
}