<form action="" method="post">
    <div class="form-group">
        <label for="title">Catagory Title</label>
        <input type="text" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" name="title" placeholder="Enter Title" value="<?php echo $title; ?>">
        <samp class="invalid-feedback"><?php echo $title_err; ?></samp>
    </div>
    <div class="form-group">
        <label for="title">Catagory Title Size </label>
        <input type="text" class="form-control <?php echo (!empty($titleSize_err)) ? 'is-invalid' : ''; ?>" name="titleSize" placeholder="Enter Title" value="<?php echo $titleSize; ?>">
        <samp class="invalid-feedback"><?php echo $titleSize_err; ?></samp>
    </div>
    <div class="form-group">
        <label for="title">Catagory Description</label>
        <input type="text" class="form-control <?php echo (!empty($dec_err)) ? 'is-invalid' : ''; ?>" name="dec" placeholder="Enter Title" value="<?php echo $dec; ?>">
        <samp class="invalid-feedback"><?php echo $dec_err; ?></samp>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>