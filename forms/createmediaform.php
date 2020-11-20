<form action="actions/a_create.php" method="post">
    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formimage">Media Title</label></div >
        <div class="col-md-8"><input class="form-control" type="text" name="formtitle"  placeholder="Enter title of media..." /></div>
    </div>
    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formimage">Image URL</label></div>
        <div class="col-md-8"><input class="form-control" type="text" name="formimage" placeholder="Enter URL of image..." /></div>
    </div>
    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formauthor_first_name">Author First Name</label></div>
        <div class="col-md-8"><input class="form-control" type="text" name="formauthor_first_name" placeholder="Enter the author's first name..." /></div>
    </div>
    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formauthor_last_name">Author Last Name</label></div>
        <div class="col-md-8"><input class="form-control" type="text" name="formauthor_last_name" placeholder="Enter the author's last name..." /></div>
    </div>
    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formisbn_code">ISBN Code</label></div>
        <div class="col-md-8"><input class="form-control" type="text" name="formisbn_code" placeholder="Enter ISBN code..." /></div>
    </div>
    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formshort_description">Short Description</label></div>
        <div class="col-md-8"><input class="form-control" type="text" name="formshort_description" placeholder="Enter a short description..." /></div>
    </div>
    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formpublish_date">Publishing Year</label></div>
        <div class="col-md-8"><input class="form-control" type="number" name="formpublish_date" placeholder="Enter publishing year..." /></div>
    </div>
    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formpublisher_name">Publisher Name</label></div>
        <div class="col-md-8"><input class="form-control" type="text" name="formpublisher_name" placeholder="Enter publisher name..." /></div>
    </div>
    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formpublisher_address">Publisher Address</label></div>
        <div class="col-md-8"><input class="form-control" type="text" name="formpublisher_address" placeholder="Enter publisher address..." /></div>
    </div>
    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formpublisher_size">Publisher Size</label></div>
        <div class="col-md-8">
            <select name="formpublisher_size" class="form-control" id="publisher_size">
                <option selected>Choose publisher size...</option>
                <option value="big">big</option>
                <option value="medium">medium</option>
                <option value="small">small</option>
            </select>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formmedia_type">Media Type</label></div>
        <div class="col-md-8">
            <select name="formmedia_type" class="form-control" id="media_type">
                <option selected>Choose media type...</option>
                <option value="Book">Book</option>
                <option value="CD">CD</option>
                <option value="DVD">DVD</option>
            </select>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-4">
        </div>
        <div class="col-md-8 text-right">
            <button class="btn btn-primary" type ="submit">Insert media</button>
        </div>
    </div>
</form>