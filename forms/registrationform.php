<!-- This form provides the input fields to register a new user. -->

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  autocomplete="off" >
    
    <div class="row my-2">
        <div class="col-4 text-right">
            Name
        </div>
        <div class="col-8">
            <input type ="text"  name="name"  class="form-control"  placeholder="Your name" maxlength="50" />
            <span class="text-danger"> <?php echo $nameError; ?> </span>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-4 text-right">
            Email Address
        </div>
        <div class="col-8">
            <input type="email" name="email" class="form-control" placeholder="Your email address" maxlength="40"/>
            <span  class="text-danger"> <?php echo $emailError; ?> </span> 
        </div>
    </div>
    <div class="row my-2">
        <div class="col-4 text-right">
            User Image URL<br><sup>(optional)</sup>
        </div>
        <div class="col-8">
            <input type="text" name="userimage" class="form-control" placeholder="The URL of your image"/>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-4 text-right">
            Password
        </div>
        <div class="col-8">
            <input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15"  />
            <span class="text-danger"> <?php echo $passError; ?> </span>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-4">
        </div>
        <div class="col-12 text-right">
            <button type="submit" class="btn btn-primary" name="btn-signup">Register</button>
        </div>
    </div>
</form>