<!-- This form provides the input fields to create a new location. -->

<form action="actions/a_newlocation.php" method="post">
    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formstreet">Street Address</label></div >
        <div class="col-md-8"><input class="form-control" type="text" name="formstreet"  placeholder="Enter the street address..." /></div>
    </div>
    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formtown">Town/City</label></div>
        <div class="col-md-8"><input class="form-control" type="text" name="formtown" placeholder="Enter name of town or city..." /></div>
    </div>
    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formpostalcode">Postal Code</label></div>
        <div class="col-md-8"><input class="form-control" type="text" name="formpostalcode" placeholder="Enter the postal code..." /></div>
    </div>

    <div class="row my-2">
        <div class="col-md-4 text-right"><label for="formcountry">Country</label></div>
        <div class="col-md-8">
            <select class="form-control" name="formcountry" id="formcountry">

                <!-- This gets the country list from the country table and renders it into the select option list. -->
                <?php
                    $sql = 'SELECT * FROM countries';
                    $result = $connect->query($sql);

                    if($result->num_rows > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            printf('<option value ="%s">%s</option>',
                            $row['countryId'], $row['CountryName']);
                        }
                    } else {
                        echo('<div class="alert alert-danger text-center" role="alert"><h3>No countries in database</h3></div>');
                    }
                ?>
            </select>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-md-12 text-right">
            <button class="btn btn-primary" type ="submit">Insert location</button>
        </div>
    </div>
</form>