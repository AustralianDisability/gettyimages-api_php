<?php

namespace GettyImages\Api\Request\Search {
    //Require Filters
    require_once("Filters/EthnicityFilter.php");
    require_once("Filters/EditorialSegmentFilter.php");
    require_once("Filters/GraphicalStyleFilter.php");
    require_once("Filters/LicenseModelFilter.php");
    require_once("Filters/OrientationFilter.php");
    require_once("Filters/NumberOfPeopleFilter.php");
    require_once("Filters/AgeOfPeopleFilter.php");
    require_once("Filters/FileTypeFilter.php");
    require_once("Filters/CompositionFilter.php");

    //Require Other Search Types
    require_once("SearchImages.php");
    require_once("SearchImagesCreative.php");
    require_once("SearchImagesEditorial.php");

    use GettyImages\Api\Request\FluentRequest;
    use GettyImages\Api\Request\WebHelper;

    /**
     * Provides the basic infrastructure for building up a Search Request.
     *
     * @method Search QueryParameter(string $value) Where QueryParameter can be any field you want to append to the request query parameters.
     */
    class Search extends FluentRequest {

        /**
         * @return string
         */
        protected function getRoute() {
            return "search/";
        }

        /**
         * Creates a search configured for Images.
         *
         * @return SearchImages SearchImages object;
         */
        public function Images() {
            $newSearchObject = new SearchImages($this->credentials,$this->endpointUri, $this->requestDetails);
            return $newSearchObject;
        }

        /**
         *    Realizes the search request. Causes the request to go out and get processed
         *
         *
         * @throws \Exception
         * @return string Json package of the search results
         */
        public function execute() {
            $endpointUrl = $this->endpointUri."/".$this->getRoute();

            if(!$this->credentials->getAuthorizationHeaderValue()) {
                $authHeader = array(CURLOPT_HTTPHEADER =>
                                    array("Api-Key:".$this->credentials->getApiKey()));
            } else {
                $authHeader = array(CURLOPT_HTTPHEADER =>
                                    array("Api-Key:".$this->credentials->getApiKey(),
                                          "Authorization: ".$this->credentials->getAuthorizationHeaderValue()));
            }

            $response = WebHelper::getJsonWebRequest($endpointUrl,
                                                     $this->requestDetails,
                                                     $authHeader);

            if($response["http_code"] != 200) {
                throw new \Exception("Non 200 status code returned: " .$response["http_code"] . "\nBody: ". $response["body"]);
            }

            return $response["body"];
        }


        /**
         * @param $startDate
         * @return $this
         */
        public function withStartDate($startDate) {
            $this->requestDetails["start_date"] = $startDate;
            return $this;
        }


        /**
         * @param $endDate
         * @return $this
         */
        public function withEndDate($endDate) {
            $this->requestDetails["end_date"] = $endDate;
            return $this;
        }
    }
}