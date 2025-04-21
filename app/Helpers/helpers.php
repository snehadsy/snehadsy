<?php

if (!function_exists('successResponse')) {
    function successResponse(
        $statusCode = 200,
        $message = '',
        $data = null
    ) {
        return response()->json([
            'status' => 'success',
            'status_code' => $statusCode,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
}

if (!function_exists('errorResponse')) {
    function errorResponse(
        $statusCode = 500,
        $message = 'Something went Wrong',
        $data = null
    ) {
        return response()->json([
            'status' => 'error',
            'status_code' => $statusCode,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
}

if (!function_exists('singleImageUpload')) {
    function singleImageUpload($image, $path, $oldImage = null)
    {
        $thumbnail = '';

        // Define the folder paths
        $folderPath = 'storage/app/public/uploads/' . $path . '/';
        $trashFolderPath = 'storage/app/public/trash/' . $path . '/';

        // Check if the folder exists, if not, create it
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        // Check if the trash folder exists, if not, create it
        if (!file_exists($trashFolderPath)) {
            mkdir($trashFolderPath, 0777, true);
        }

        // Check if a new image is uploaded
        if (!empty($image)) {
            // Generate a unique file name with the original extension
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Move the uploaded file to the destination folder
            $image->move($folderPath, $imageName);

            // Move the old image to trash if provided
            if (!empty($oldImage)) {
                $oldImageFullPath = $folderPath . $oldImage;
                // Check if the old image file exists before moving it to trash
                if (file_exists($oldImageFullPath)) {
                    // Move the old image to the trash folder
                    rename($oldImageFullPath, $trashFolderPath . basename($oldImage));
                }
            }

            $thumbnail = $imageName; // Set the thumbnail name to the new image name
        } else {
            // If no new image is uploaded, retain the old image name
            if (!empty($oldImage)) {
                $thumbnail = $oldImage;
            }
        }

        return $thumbnail;
    }
}
