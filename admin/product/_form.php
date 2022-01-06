<form action="" method="post">
    <div class="form-group">
        <label for="title">Product Title</label>
        <input type="text" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" name="title" placeholder="Enter Title" value="<?php echo $title; ?>">
        <samp class="invalid-feedback"><?php echo $title_err; ?></samp>
    </div>
    <div class="form-group">
        <label>Textarea</label>
        <textarea class="form-control" rows="3" placeholder="Enter Product Desc.." name="desc"><?php echo $desc; ?></textarea>
    </div>
    <div class="form-group">
        <label for="title">Product Price</label>
        <input type="number" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" name="price" placeholder="Enter Title" value="<?php echo $price; ?>">
        <samp class="invalid-feedback"><?php echo $price_err; ?></samp>
    </div>
    <div class="form-group">
        <label>Product Discount Date:</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                </span>
            </div>
            <input type="date" class="form-control float-right" id="reservation" name="decpriceDate">
        </div>
        <!-- /.input group -->
    </div>
    <div class="form-group">
        <label for="title">Product Discount</label>
        <input type="number" class="form-control <?php echo (!empty($decprice_err)) ? 'is-invalid' : ''; ?>" name="decprice" placeholder="Enter Title" value="<?php echo $decprice; ?>">
        <samp class="invalid-feedback"><?php echo $decprice_err; ?></samp>
    </div>
    <div class="form-group">
        <label for="title">Product Quantity</label>
        <input type="number" class="form-control <?php echo (!empty($qty_err)) ? 'is-invalid' : ''; ?>" name="qty" placeholder="Enter Title" value="<?php echo $qty; ?>">
        <samp class="invalid-feedback"><?php echo $qty_err; ?></samp>
    </div>

    <div class="form-group">
        <label>Select</label>
        <select class="form-control" name="catagory">
            <option>option 1</option>
            <option>option 2</option>
            <option>option 3</option>
            <option>option 4</option>
            <option>option 5</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>