<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Product Title</label>
        <input type="text" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" name="title" placeholder="Enter Title" value="<?php echo $title ?>">
        <samp class="invalid-feedback"><?php echo $title_err; ?></samp>
    </div>
    <div class="mb-3">
        <label class="form-label">Upload Product Related Images</label>
        <input class="form-control" type="file" name="image[]" multiple>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form