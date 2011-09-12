<?php include "fragment/insecureHead.php"; ?>
<body>
<div id="wrapper">
<?php
        require_once dirname(__FILE__) . '\..\util.php';
require_model("User");
use Qnet\Model\User;
?>

<div id="page">
<div id="content">
<div class="post">
<h2 class="title">Signup and join our community!</h2>

<div class="entry">
<p>

<form action="signupFrontend.php" method="POST">
<fieldset>
    <legend>Personal information</legend>
    <div><label for="userName" class="mylabelstyle">Name:</label><input type="text" name="userName"
                                                                        id="userName"/>
    </div>
    <div><label for="userLasName" class="mylabelstyle">Last name:</label><input type="text"
                                                                                name="userLastName"
                                                                                id="userLasName"/></div>
    <div><label for="password" class="mylabelstyle">Password:</label><input type="password" name="password"
                                                                            id="password"/></div>
    <div><label for="rePassword" class="mylabelstyle">Retype Password:</label><input type="password"
                                                                                     name="rePassword"
                                                                                     id="rePassword"/>
    </div>
    <div><label class="mylabelstyle">Date of Birth:</label>
        <select name="year"><?php yearOptions(date('Y')); ?></select>
        <select name="month"><?php monthOptions(); ?></select>
        <select name="day"><?php dayOptions(); ?></select>
    </div>
    <div>
        <?php User::printOptionsFor(User::$GENDER); ?>
    </div>
    <div>
        <?php User::printOptionsFor(User::$MARITAL_STATUS); ?>
    </div>
</fieldset>
<fieldset>
    <legend>Studies</legend>
    <div>
        <?php User::printOptionsFor(User::$STUDIES); ?>
    </div>
    <div>
        <label class="mylabelstyle" for="institutionName">Institution name:</label>
        <input type="text" name="InstitutionName" id="InstitutionName"
               value="<?php echo $institutionName ?>"/>
    </div>
</fieldset>
<fieldset>
    <legend>Other information</legend>
    <div>
        <?php User::printOptionsFor(User::$LOCATION); ?>
    </div>
    <div>
        <?php User::printOptionsFor(User::$RELIGION); ?>
    </div>
</fieldset>
<fieldset id="termsArea">
    <legend>Term and Conditions</legend>
    <div id="terms" class="terms">
        <h3>Statement of Rights and Responsibilities</h3>

        <p>
            This Statement of Rights and Responsibilities (Statement) derives from the Qnet Principles, and
            governs our relationship with users and others who interact with Qnet. By using or accessing
            Qnet, you agree to this Statement.
        </p>

        <h3>1.Privacy</h3>

        <p>
            Your privacy is very important to us. We designed our Privacy Policy to make important disclosures about
            how you can use Qnet to share with others and how we collect and can use your content and information.
            We encourage you to read the Privacy Policy, and to use it to help make informed decisions.

        </p>


        <h3>2.Sharing Your Content and Information</h3>

        <p>
            You own all of the content and information you post on Qnet, and you can control how it is shared
            through your privacy and application settings. In addition:
            1. For content that is covered by intellectual property rights, like photos and videos (IP content), you
            specifically give us the following permission, subject to your privacy and application settings: you
            grant us a non-exclusive, transferable, sub-licensable, royalty-free, worldwide license to use any IP
            content that you post on or in connection with Facebook (IP License). This IP License ends when you
            delete your IP content or your account unless your content has been shared with others, and they have
            not deleted it.
            2. When you delete IP content, it is deleted in a manner similar to emptying the recycle bin on a
            computer. However, you understand that removed content may persist in backup copies for a reasonable
            period of time (but will not be available to others).
            3. When you use an application, your content and information is shared with the application. We require
            applications to respect your privacy, and your agreement with that application will control how the
            application can use, store, and transfer that content and information. (To learn more about Platform,
            read our Privacy Policy and Platform Page.)
            4. When you publish content or information using the Public setting, it means that you are allowing
            everyone, including people off of Facebook, to access and use that information, and to associate it with
            you (i.e., your name and profile picture).
            5. We always appreciate your feedback or other suggestions about Facebook, but you understand that we
            may use them without any obligation to compensate you for them (just as you have no obligation to offer
            them).

        </p>

        <h3>3.Safety</h3>

        <p>

            We do our best to keep Facebook safe, but we cannot guarantee it. We need your help to do that, which
            includes the following commitments:
            1. You will not send or otherwise post unauthorized commercial communications (such as spam) on
            Facebook.
            2. You will not collect users' content or information, or otherwise access Facebook, using automated
            means (such as harvesting bots, robots, spiders, or scrapers) without our permission.
            3. You will not engage in unlawful multi-level marketing, such as a pyramid scheme, on Facebook.
            4. You will not upload viruses or other malicious code.
            5. You will not solicit login information or access an account belonging to someone else.
            6. You will not bully, intimidate, or harass any user.
            7. You will not post content that: is hateful, threatening, or pornographic; incites violence; or
            contains nudity or graphic or gratuitous violence.
            8. You will not develop or operate a third-party application containing alcohol-related or other mature
            content (including advertisements) without appropriate age-based restrictions.
            9. You will follow our Promotions Guidelines and all applicable laws if you publicize or offer any
            contest, giveaway, or sweepstakes (“promotion”) on Facebook.
            10. You will not use Facebook to do anything unlawful, misleading, malicious, or discriminatory.
            11. You will not do anything that could disable, overburden, or impair the proper working of Facebook,
            such as a denial of service attack.
            12. You will not facilitate or encourage any violations of this Statement.

        </p>

        <h3>4.Registration and Account Security</h3>

        <p>Qnet users provide their real names and information, and we need your help to keep it that way. Here are
            some commitments you make to us relating to registering and maintaining the security of your account:
            1. You will not provide any false personal information on Facebook, or create an account for anyone
            other than yourself without permission.
            2. You will not create more than one personal profile.
            3. If we disable your account, you will not create another one without our permission.
            4. You will not use your personal profile for your own commercial gain (such as selling your status
            update to an advertiser).
            5. You will not use Facebook if you are under 13.
            6. You will not use Facebook if you are a convicted sex offender.
            7. You will keep your contact information accurate and up-to-date.
            8. You will not share your password, (or in the case of developers, your secret key), let anyone else
            access your account, or do anything else that might jeopardize the security of your account.
            9. You will not transfer your account (including any page or application you administer) to anyone
            without first getting our written permission.
            10. If you select a username for your account we reserve the right to remove or reclaim it if we believe
            appropriate (such as when a trademark owner complains about a username that does not closely relate to a
            user's actual name).

        </p>

        <h3>5.Protecting Other People's Rights</h3>

        <p>
            We respect other people's rights, and expect you to do the same.
            1. You will not post content or take any action on Facebook that infringes or violates someone else's rights
            or otherwise violates the law.
            2. We can remove any content or information you post on Facebook if we believe that it violates this
            Statement.
            3. We will provide you with tools to help you protect your intellectual property rights. To learn more,
            visit our How to Report Claims of Intellectual Property Infringement page.
            4. If we remove your content for infringing someone else's copyright, and you believe we removed it by
            mistake, we will provide you with an opportunity to appeal.
            5. If you repeatedly infringe other people's intellectual property rights, we will disable your account when
            appropriate.
            6. You will not use our copyrights or trademarks (including Facebook, the Facebook and F Logos, FB, Face,
            Poke, Wall and 32665), or any confusingly similar marks, without our written permission.
            7. If you collect information from users, you will: obtain their consent, make it clear you (and not
            Facebook) are the one collecting their information, and post a privacy policy explaining what information
            you collect and how you will use it.
            8. You will not post anyone's identification documents or sensitive financial information on Facebook.
            9. You will not tag users or send email invitations to non-users without their consent.

        </p>

        <h3>6.Mobile</h3>

        <p>
            1. We currently provide our mobile services for free, but please be aware that your carrier's normal rates
            and fees, such as text messaging fees, will still apply.
            2. In the event you change or deactivate your mobile telephone number, you will update your account
            information on Facebook within 48 hours to ensure that your messages are not sent to the person who acquires
            your old number.
            3. You provide all rights necessary to enable users to sync (including through an application) their contact
            lists with any basic information and contact information that is visible to them on Facebook, as well as
            your name and profile picture.

        </p>

        <h3>7.Payments and Deals</h3>

        <p>

            1. If you make a payment on Facebook or use Facebook Credits, you agree to our Payments Terms.
            2. If purchase a Deal, you agree to our Deals Terms.
            3. If you provide a Deal or partner with us to provide a Deal, you agree to the Merchant Deal Terms in
            addition to any other agreements you may have with us.

        </p>

        <h3>8.Special Provisions Applicable to Share Links </h3>

        <p>
            If you include our Share Link button on your website, the following additional terms apply to you:
            1. We give you permission to use Facebook's Share Link button so that users can post links or content from
            your website on Facebook.
            2. You give us permission to use and allow others to use such links and content on Facebook.
            3. You will not place a Share Link button on any page containing content that would violate this Statement
            if posted on Facebook.
        </p>

        <h3>10. Services</h3>

        <p>
            Our team is providing the following services:
        <ul>
            <li>
                <strong>Joomla! Installation.</strong><br>
                Our team will upload and install the template to your hosting server and activate it within
                your database as necessary.
            </li>
            <li><strong>Joomla! Modules Installation.</strong><br>
                Our team will install all necessary modules through the Joomla! administration manager
                of your site so your site look like our live demo.
            </li>
            <li><strong>Implementing The Customer's Logo.</strong><br>
                Personalizing AS template with your own logo. We will replace the template's
                logo with yours on each of the template's pages.
            </li>
            <li><strong>Changing Color Scheme.</strong><br>
                Changing any one color or the entire color scheme to the colors that best suit your needs.
                We will replace the template's color scheme with the one you prefer on every one
                of the template's pages.
            </li>
            <li><strong>Changing Pages Text Content.</strong><br>
                Replacing all of the default texts, images and links with yours and changing the layout of
                all pages to accommodate your content.
            </li>
        </ul>
</p>
<p>Please <a href="http://www.asdesigning.com/services.php">click here</a> for more details. </p>

<h3>11. Refund</h3>

<p>Since ASTemplates.com is offering non-tangible irrevocable goods we do not issue refunds once
    the order is accomplished and the product is sent. As a customer you are responsible for understanding
    this upon purchasing any item at our site.<br/><br/>
    Please note that we do not bear any responsibility and therefore we do not satisfy any
    refund/return/exchange
    requests based on incompatibility of our products with some third-party software (plug-ins, add-ons,
    modules,
    search engines, scripts, extensions etc) other than those which are specified as compatible in a description
    available on the template details page of each product.
    We don't guarantee that our products are fully compatible with
    any third-party programs and we do not provide support for third-party applications.</p>

<h3>12. Changes to Terms of Use</h3>

<p>
    We can revise or change these Terms (in whole or in part) from time to time and
    at any time without notice to you.<br/><br/>
</p>
</div>
<div>
    <p></p>
    <input type="checkbox" name="agreement" value="YES">
    &nbsp; Yes, I accept the above Terms &amp; Conditions.
</div>
</fieldset>
<div><input id="submitSignUpButton" class="summitQuery" type="submit"></div>
</form>
</div>
</div>
</div>
<?php include "fragment/footer.php"; ?>
</div>
</body>
</html>

<?php
function yearOptions($endYear = '', $startYear = '1900')
{
    for ($i = $startYear; $i <= $endYear; $i++)
    {
        ($i == date('Y')) ? $selected = ' selected="selected"' : $selected = '';
        echo '<option value="' . $i . '"' . $selected . '>' . $i . '</option>' . "\n";
    }
}

function monthOptions()
{
    $months = array(1 => "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

    foreach ($months as $monthNo => $month)
    {
        ($monthNo == date('n')) ? $selected = ' selected="selected"' : $selected = '';
        echo '<option value="' . $monthNo . '"' . $selected . '>' . $monthNo . ' - ' . $month . '</option>' . "\n";
    }
}

function dayOptions()
{
    for ($i = 1; $i <= 31; $i++)
    {
        ($i == date('j')) ? $selected = ' selected="selected"' : $selected = '';
        echo '<option value="' . $i . '"' . $selected . '>' . $i . '</option>' . "\n";
    }
}

?>