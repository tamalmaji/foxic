<form action="" method="post">
    <div class="form-group">
        <label for="title">State Title</label>
        <input type="text" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" name="title" placeholder="Enter Title" value="<?php echo $title; ?>">
        <samp class="invalid-feedback"><?php echo $title_err; ?></samp>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>