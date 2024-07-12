<?php
    $pageTitle = "Contact Us";
    include_once "layout/header.php";
?>

<main>
    <div class="container flex flex-col items-center justify-center">
        <img class="w-half rounded mb-8" src="images/place.jpg" alt="Location">

        <p class="text-center mb-8">
            ITE HQ<br>
            10 Dover Drive <br>
            Singapore 123456 <br>
            Tel: 61234567 <br>
            Email: <a href="mailto:candktraining@yahoo.com">candktraining@yahoo.com</a>
        </p>

        <p class="w-full font-bold mb-4">Please provide your feedback:</p>

        <form class="w-full flex flex-col" action="mailto:xxx@ite.edu.sg" method="post">
            <div class="mb-4 p-4 w-full" style="border: 1px solid #000; position: relative; padding-top: 20px;">
                <span style="position: absolute; left: 8px; top: -12px; background: #fff;">Personal Particulars</span>
                
                <div class="flex mb-2 items-center">
                    <label class="w-32">First Name <span class="text-red">*</span>:</label>
                    <input class="flex-1 h-6" type="text" id="firstname" required>
                </div>

                <div class="flex mb-2 items-center">
                    <label class="w-32">Last Name <span class="text-red">*</span>:</label>
                    <input class="flex-1 h-6" type="text" id="lastname" required>
                </div>

                <div class="flex mb-2 items-center">
                    <label class="w-32">Handphone No <span class="text-red">*</span>:</label>
                    <input class="flex-1 h-6" type="text" id="hpnumber" required>
                </div>
            </div>

            <label class="mb-1">Comments <span class="text-red">*</span> (limit to 250 characters)</label>
            <textarea class="mb-4 w-full" name="comments" id="comments" rows="5" maxlength="250" required></textarea>
            
            <div class="flex gap-2 items-center justify-between">
                <input class="h-10 w-32" type="submit">
                <input class="h-10 w-32" type="reset">
            </div>
        </form>
    </div>
</main>

<?php include_once "layout/footer.php"; ?>