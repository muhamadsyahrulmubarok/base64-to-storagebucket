<?php

defined('BASEPATH') or exit('No direct script access allowed');

putenv('GOOGLE_APPLICATION_CREDENTIALS=assets/isentropic-keep-386003-46206ac69d48.json');

use Google\Cloud\Storage\StorageClient;

class Upload extends CI_Controller
{

    public function index()
    {
        $projectId = 'project-id';

        // Instantiates a client
        $storage = new StorageClient([
            'projectId' => $projectId
        ]);

        // The name for the new bucket
        $bucketName = 'image-nsgo';

        // Your base64 image string
        $base64Image = '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';

        // Decode the base64 string into binary data
        $imageData = base64_decode($base64Image);

        // The name of the image file in the bucket
        $random_name = rand();
        $imageName = $random_name . '.jpg';

        // Get the bucket
        $bucket = $storage->bucket($bucketName);

        //upload to folder image
        $folder = 'image/';
        // Upload the image data to the bucket
        $object = $bucket->upload($imageData, [
            'name' => $folder . $imageName
        ]);

        // Get the image object
        $object = $bucket->object($imageName);

        // get object using name of object
        // $object = $bucket->object($imageName);

        // Get the image URL
        $imageURL = $object->signedUrl(
            // This URL is valid for 1 hour
            new \DateTime('1 minutes'),
            [
                'version' => 'v4'
            ]
        );

        // Return the image URL
        echo $imageURL;
    }
}

/* End of file Upload.php */
