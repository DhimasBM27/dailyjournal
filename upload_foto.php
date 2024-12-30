<?php
function upload_foto($File) {
    $uploadOk = 1;
    $hasil = array();
    $message = '';
    
    // File properties:
    $FileName = $File['name'];
    $TmpLocation = $File['tmp_name'];
    $FileSize = $File['size'];

    // Figure out what kind of file this is:
    $FileExt = explode('.', $FileName);
    $FileExt = strtolower(end($FileExt));

    // Allowed files:
    $Allowed = array('jpg', 'png', 'gif', 'jpeg');  

    // Check if temporary file exists
    if (!is_uploaded_file($TmpLocation)) {
        $message .= "File upload failed, temporary file not found. ";
        $uploadOk = 0;
    }

    // Check file size
    if ($FileSize > 500000) { // 500KB
        $message .= "Sorry, your file is too large, max 500KB. ";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($FileExt, $Allowed)) {
        $message .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
        $uploadOk = 0; 
    }

    // Validate image type
    if ($uploadOk && exif_imagetype($TmpLocation) === false) {
        $message .= "Sorry, the file is not a valid image. ";
        $uploadOk = 0;
    }

    // Ensure upload directory exists
    if (!is_dir('img')) {
        mkdir('img', 0777, true);
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $message .= "Sorry, your file was not uploaded. ";
        $hasil['status'] = false; 
    } else {
        // Create new filename:
        $NewName = date("YmdHis") . '.' . $FileExt;
        $UploadDestination = "img/" . $NewName; 

        if (move_uploaded_file($TmpLocation, $UploadDestination)) {
            $message .= "File uploaded successfully: $NewName";

            // Insert file information into the database
            global $conn; // Make sure to use the database connection
            $stmt = $conn->prepare("INSERT INTO gallery (foto, tanggal) VALUES (?, NOW())");
            $stmt->bind_param("s", $NewName);
            if ($stmt->execute()) {
                $message .= " Data inserted into the database successfully.";
                $hasil['status'] = true; 
            } else {
                $message .= " Error inserting data into the database.";
                $hasil['status'] = false;
            }
            chmod($UploadDestination, 0644); // Secure the uploaded file
        } else {
            $message .= "Sorry, there was an error uploading your file. ";
            $hasil['status'] = false; 
        }
    }

    $hasil['message'] = $message; 
    return $hasil;
}
?>
