<div class="w3-padding-64 w3-content w3-text-grey" id="contact">
    <h2 class="w3-text-light-grey">Contact US</h2>
    <hr style="width:200px" class="w3-opacity">

    <p>Lets get in touch. Send me a message:</p>

    <form action="/action_page.php" target="_blank">
        <p><input class="w3-input w3-padding-16" type="number" placeholder="Name" required name="Name"></p>
        <p><input class="w3-input w3-padding-16" type="text" placeholder="Email" required name="Email"></p>
        <p><input class="w3-input w3-padding-16" type="text" placeholder="Subject" required name="Subject">
        </p>
        <p><input class="w3-input w3-padding-16" type="text" placeholder="Message" required name="Message">
        </p>
        <p>
            <button class="w3-button w3-light-grey w3-padding-large" type="submit">
                <i class="fa fa-paper-plane"></i> SEND MESSAGE
            </button>
        </p>
    </form>
    <!-- End Contact Section -->
</div>

<!-- Footer -->
<footer class="w3-content w3-padding-64 w3-text-grey w3-xlarge">
    <a href="<?php echo site_url() ?>/Home/maintenance"><i
            class="fa fa-facebook-official w3-hover-opacity"></i></a>
    <a href="<?php echo site_url() ?>/Home/maintenance"></a><i
        class="fa fa-instagram w3-hover-opacity"></i></a>
    <a href="<?php echo site_url() ?>/Home/maintenance"><i class="fa fa-snapchat w3-hover-opacity"></i></a>
    <p class="w3-medium">Midwest Electronics </p>
    <!-- End footer -->
</footer>

<!-- END PAGE CONTENT -->
</div>


<script>

    function openNav() {
        var x = document.getElementById("mySidenav");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>
</body>
</html>