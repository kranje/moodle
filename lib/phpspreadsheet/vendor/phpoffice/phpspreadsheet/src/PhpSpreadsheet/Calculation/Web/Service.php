<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Web;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
=======
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
>>>>>>> forked/LAE_400_PACKAGE
use PhpOffice\PhpSpreadsheet\Settings;
use Psr\Http\Client\ClientExceptionInterface;

class Service
{
    /**
     * WEBSERVICE.
     *
     * Returns data from a web service on the Internet or Intranet.
     *
     * Excel Function:
     *        Webservice(url)
     *
     * @return string the output resulting from a call to the webservice
     */
    public static function webService(string $url)
    {
        $url = trim($url);
        if (strlen($url) > 2048) {
<<<<<<< HEAD
            return ExcelError::VALUE(); // Invalid URL length
        }

        if (!preg_match('/^http[s]?:\/\//', $url)) {
            return ExcelError::VALUE(); // Invalid protocol
=======
            return Functions::VALUE(); // Invalid URL length
        }

        if (!preg_match('/^http[s]?:\/\//', $url)) {
            return Functions::VALUE(); // Invalid protocol
>>>>>>> forked/LAE_400_PACKAGE
        }

        // Get results from the the webservice
        $client = Settings::getHttpClient();
        $requestFactory = Settings::getRequestFactory();
        $request = $requestFactory->createRequest('GET', $url);

        try {
            $response = $client->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
<<<<<<< HEAD
            return ExcelError::VALUE(); // cURL error
        }

        if ($response->getStatusCode() != 200) {
            return ExcelError::VALUE(); // cURL error
=======
            return Functions::VALUE(); // cURL error
        }

        if ($response->getStatusCode() != 200) {
            return Functions::VALUE(); // cURL error
>>>>>>> forked/LAE_400_PACKAGE
        }

        $output = $response->getBody()->getContents();
        if (strlen($output) > 32767) {
<<<<<<< HEAD
            return ExcelError::VALUE(); // Output not a string or too long
=======
            return Functions::VALUE(); // Output not a string or too long
>>>>>>> forked/LAE_400_PACKAGE
        }

        return $output;
    }

    /**
     * URLENCODE.
     *
     * Returns data from a web service on the Internet or Intranet.
     *
     * Excel Function:
     *        urlEncode(text)
     *
     * @param mixed $text
     *
     * @return string the url encoded output
     */
    public static function urlEncode($text)
    {
        if (!is_string($text)) {
<<<<<<< HEAD
            return ExcelError::VALUE();
=======
            return Functions::VALUE();
>>>>>>> forked/LAE_400_PACKAGE
        }

        return str_replace('+', '%20', urlencode($text));
    }
}
