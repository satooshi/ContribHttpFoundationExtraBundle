ContribHttpFoundationExtraBundle
================================

## Install
See [Packagist](https://packagist.org/packages/satooshi/symfony2contrib-http-foundation-extra-bundle).


## Annotation Usage

This bundle contains the following annotations.

* @File: force to download a file.
* @Json: create JsonResponse from controller result.
	* Content-Type is
		* application/json for json response
		* text/javascript for jsonp response

```php
# Acme/Bundle/Controller/SiteController.php

use Contrib\HttpFoundationExtraBundle\Configuration\File;
use Contrib\HttpFoundationExtraBundle\Configuration\Json;

/**
 * @Route("/site")
 */
class SiteController
{
    /**
     * @Route("/csv", name="site_csv")
     * @Method("GET")
     * @File(filename = "test.csv", charset = "Shift_JIS")
     */
    public function csvAction()
    {
        $content = 'item1,item2';

        return array(
            'content' => $content,

            // read file in FileResponse and ignore content if this was set to controller result
            //'path' => './test.csv', 
        );
    }

    /**
     * @Route("/json", name="site_json")
     * @Method("GET")
     * @Json
     */
    public function jsonAction()
    {
    	// result response
    	// {"prop1":"value1","prop2":"value2"}
        return array(
        	'prop1' => 'value1',
        	'prop2' => 'value2'
        );
    }

    /**
     * @Route("/jsonp", name="site_jsonp")
     * @Method("GET")
     * @Json(callbackName = "jsoncallback")
     */
    public function jsonpAction()
    {
    	// request
    	// /site/jsonp?jsoncallback=mycallback
    	// response
    	// mycallback({"prop1":"value1","prop2":"value2"});
        return array(
        	'prop1' => 'value1',
        	'prop2' => 'value2'
        );
    }
}
```

### @File parameters

* filename: required if "content" was set to controller result. optional if "path" was set. used for "Content-Disposition" HTTP header
* charset: optional charactor encoding. used for "Content-Type" HTTP header
* mimeType: optional mime type. default value is "application/octet-stream". used for "Content-Type" HTTP header

### @Json parameters

* callbackName: optional callback request parameter name (default value: callback).
* serialize: optional boolean whether to use serializer ([jms/serializer](https://github.com/schmittjoh/serializer)).
* serializeGroups: optional array to use serialize group.

### todo

* avoid HTTP header conflict if it has already been set
* add supecific file type annotation support (@Plain, @Csv, @Pdf, @Zip, and so on)
* add rendering template functionality as the same as @Template
* add DependencyInjection/Cofiguration to support default parameter configuration
* add unit test
