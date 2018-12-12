<!-- Contact Section -->
<div class="w3-padding-64 w3-content w3-text-grey" id="contact">
    <h2 class="w3-text-light-grey">Sign Up</h2>
    <hr style="width:200px" class="w3-opacity">
    <?php echo form_open('home/register'); ?>
    <p><input class="w3-input w3-padding-16" type="text" placeholder="First Name" required name="first_name"></p>
    <p><input class="w3-input w3-padding-16" type="text" placeholder="Last Name" required name="last_name"></p>
    <p><input class="w3-input w3-padding-16" type="text" placeholder="Email" required name="email"></p>
    <p><input class="w3-input w3-padding-16" type="text" placeholder="Password" required name="password"></p>
    <p><input class="w3-input w3-padding-16" type="text" placeholder="Phone" required name="phone"></p>
    <p><input class="w3-input w3-padding-16" type="text" placeholder="Company Name" required name="company_name"></p>
    <p><input class="w3-input w3-padding-16" type="text" placeholder="Address 1" required name="address_one"></p>
    <p><input class="w3-input w3-padding-16" type="text" placeholder="Address 2" required name="address_two"></p>
    <p><input class="w3-input w3-padding-16" type="text" placeholder="Town" required name="town"></p>
    <p><input class="w3-input w3-padding-16" type="text" placeholder="City" required name="city"></p>
    <p><input class="w3-input w3-padding-16" type="text" placeholder="State/Province" required name="state"></p>
    <p><input class="w3-input w3-padding-16" type="text" placeholder="Country" required name="country"></p>
    <button class="w3-button w3-light-grey w3-padding-large" type="submit">
        <i class="fa fa-paper-plane"></i> Sign Up
    </button>
    </p>
    </form>
    <!-- End Contact Section -->
</div>

<!-- Footer -->
<footer class="w3-content w3-padding-64 w3-text-grey w3-xlarge">
    <a href="<?php echo site_url() ?>/Home/maintenance"><i class="fa fa-facebook-official w3-hover-opacity"></i></a>
    <a href="<?php echo site_url() ?>/Home/maintenance"></a><i class="fa fa-instagram w3-hover-opacity"></i></a>
    <a href="<?php echo site_url() ?>/Home/maintenance"><i class="fa fa-snapchat w3-hover-opacity"></i></a>
    <p class="w3-medium">Midwest Electronics </p>
    <!-- End footer -->
</footer>

<!-- END PAGE CONTENT -->
</div>
</body>
</php>