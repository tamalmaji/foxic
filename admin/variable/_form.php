<form action="" method="post">
    <div class="form-group">
        <label>Select Product Size</label>
        <select class="form-control" name="siz">
            <option value="<?php echo 0 ?>">Select Option</option>
            <?php foreach ($sizes as $size) : ?>
                <option value="<?php echo $size['sizes_id'] ?>"><?php echo $size['sizes_titleSize'] ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>