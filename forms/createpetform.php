<form action="actions/a_create.php" method="post">
    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formname">Name</label></div >
        <div class="col-md-8"><input class="form-control" type="text" name="formname"  placeholder="Enter title of the pet..." /></div>
    </div>
    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formimage">Image URL</label></div>
        <div class="col-md-8"><input class="form-control" type="text" name="formimage" placeholder="Enter URL of image..." /></div>
    </div>
    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="c">Type<br><sup>(e.g. dog, cat, etc.)</sup></label></div>
        <div class="col-md-8"><input class="form-control" type="text" name="formtype" placeholder="Enter the type of pet..." /></div>
    </div>
    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formdescription">Description</label></div>
        <div class="col-md-8"><input class="form-control" type="text" name="formdescription" placeholder="Enter the description..." /></div>
    </div>
    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formhobbies">Hobbies</label></div>
        <div class="col-md-8"><input class="form-control" type="text" name="formhobbies" placeholder="Enter pet's hobbies..." /></div>
    </div>
    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formage">Age</label></div>
        <div class="col-md-8"><input class="form-control" type="number" name="formage" placeholder="Enter the pet's age..." /></div>
    </div>

    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formlocation">Location</label></div>
        <div class="col-md-8">
            <select name="formlocation" class="form-control" id="formlocation">

            <?php
                $sql = 'SELECT locations.locationId, locations.street, locations.town, locations.postalCode, locations.country, countries.CountryName FROM locations INNER JOIN countries ON locations.country = countries.countryId;';
                $result = $connect->query($sql);

                if($result->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        printf('<option value="%s">%s, %s %s, %s</option>',
                        $row['locationId'], $row['street'], $row['postalCode'], $row['town'], $row['CountryName']);
                        }
                    } else {
                        echo('<option value="1">No location in database</option></tr>');
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-12 text-center">
            <p>Select from existing locations or <a href="locations.php">add a new location using the separate form.</a></p>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-md-12 text-right">
            <button class="btn btn-primary" type ="submit">Insert entry</button>
        </div>
    </div>
</form>