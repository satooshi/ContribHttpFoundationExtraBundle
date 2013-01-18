ContribHttpFoundationExtraBundle
================================

## Install
See [Packagist](https://packagist.org/packages/satooshi/symfony2contrib-http-foundation-extra-bundle).


## Annotation Usage

This bundle contains @File annotation which can force to download a file.

```php
# Acme/Bundle/Controller/FileController.php

use Contrib\HttpFoundationExtraBundle\Configuration\File;

/**
 * @Route("/download", name="file_download")
 * @Method("GET")
 * @File(filename = "test.csv", charset = "Shift_JIS")
 */
public function downloadAction()
{
    $content = 'item1,item2';

    return array(
        'content' => $content,

        // read file in FileResponse and ignore content if this was set to controller result
        //'path' => './test.csv', 
    );
}
```

### @File parameters

* filename: required if "content" was set to controller result. optional if "path" was set. used for "Content-Disposition" HTTP header
* charset: optional charactor encoding. used for "Content-Type" HTTP header
* mimeType: optional mime type. default value is "application/octet-stream". used for "Content-Type" HTTP header

### todo

* avoid HTTP header conflict if it has already been set
* add supecific file type annotation support (@Plain, @Csv, @Pdf, @Zip, and so on)
* add rendering template functionality as the same as @Template
* add DependencyInjection/Cofiguration to support default parameter configuration
* add unit test
