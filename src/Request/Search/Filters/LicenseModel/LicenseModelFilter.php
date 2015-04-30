<?php

namespace GettyImages\ApiClient\Request\Search\Filters\LicenseModel {
    require_once("RightsManagedLicenseModel.php");
    require_once("RoyaltyFreeLicenseModel.php");

    abstract class LicenseModelFilter {
        public static function RightsManaged() {
            return new RightsManagedLicenseModelFilter();
        }

        public static function RoyaltyFree() {
            return new RoyaltyFreeLicenseModelFilter();
        }

        public abstract function getValue();
    }
}