<?php
$upload_dir = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!is_dir('../../public/images/product')) {
        mkdir('../../public/images/product');
    }

    if (empty($title_err) && empty($price_err) && empty($price_err) && empty($qty_err)) {
        $image = $_FILES['img'] ['name'];
        $imgSize = $_FILES['img'] ['size'];
        $temp_dir = $_FILES['img'] ['tmp_name'];

        // $upload_dir = $product['product_img'];
        
        $imgExt = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $vaild_extenstions =  array('jpeg', 'jpg', 'png');

        if (in_array($imgExt, $vaild_extenstions)) {
            if ($imgSize < 5000000) {
                // if ($product['product_img']) {
                //    unlink('../../public/' . $product['product_img']);
                // }
                $picProfile = rand(1000, 1000000) . '.'. $imgExt;
                $upload_dir = 'images/product/' . $picProfile;
                $upload_File_dir = '../../public/images/product/'. $picProfile;
                move_uploaded_file($temp_dir, $upload_File_dir);
            }
        }
    }
}
