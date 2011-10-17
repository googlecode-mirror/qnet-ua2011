<?php include "fragment/insecureHead.php"; ?>
<body>
<div id="wrapper">
<?php
    require_once dirname(__FILE__) . '\..\util.php';
    require_model("User");
    use Qnet\Model\User;

echo "</br>";

$completeForm = $_GET['error'];
$emptyValue = "";
$defaultUserName = $emptyValue;
$defaultUserLastName = $emptyValue;
$DefaultInstitutionName = $emptyValue;

$default_day = date('j');
$default_month = date('n');
$default_year = date('Y');

$default_maritalSt = null;
$default_gender = null;
$default_studies = null;
$default_country = null;
$default_religion = null;


if ($completeForm) {
    $defaultUserName = $_SESSION["userName"];
    $defaultUserLastName = $_SESSION["userLastName"];
    $DefaultInstitutionName = $_SESSION["institutionName"];

    $default_day = $_SESSION["day"];
    $default_month = $_SESSION["month"];
    $default_year = $_SESSION["year"];

    $default_gender = $_SESSION[User::$GENDER];
    $default_maritalSt = $_SESSION[User::$MARITAL_STATUS];
    $default_studies = $_SESSION[User::$STUDIES];
    $default_country = $_SESSION[User::$LOCATION];
    $default_religion = $_SESSION[User::$RELIGION];
}
echo '<h2 class="title">';
if($_GET['error']) {
    print_r($_SESSION["errors"]);
}
echo '</h2>';
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
                                                                        id="userName"
                                                                        value="<?php echo $defaultUserName;?>"/>
    </div>
    <div><label for="userLastName" class="mylabelstyle">Last name:</label><input type="text"
                                                                                 name="userLastName"
                                                                                 id="userLastName"
                                                                                 value="<?php echo $defaultUserLastName;?>"/>
    </div>
    <div><label for="password" class="mylabelstyle">Password:</label><input type="password" name="password"
                                                                            id="password"/></div>
    <div><label for="rePassword" class="mylabelstyle">Retype Password:</label><input type="password"
                                                                                     name="rePassword"
                                                                                     id="rePassword"/>
    </div>
    <div><label class="mylabelstyle">Date of Birth:</label>
        <select name="year"><?php yearOptions($default_year, date('Y')); ?></select>
        <select name="month"><?php monthOptions($default_month); ?></select>
        <select name="day"><?php dayOptions($default_day); ?></select>
    </div>
    <div>
        <?php User::printOptionsFor(User::$GENDER, $default_gender); ?>
    </div>
    <div>
        <?php User::printOptionsFor(User::$MARITAL_STATUS, $default_maritalSt); ?>
    </div>
</fieldset>
<fieldset>
    <legend>Studies</legend>
    <div>
        <?php User::printOptionsFor(User::$STUDIES, $default_studies); ?>
    </div>
    <div>
        <label class="mylabelstyle" for="institutionName">Institution name:</label>
        <input type="text" name="institutionName" id="institutionName"
               value="<?php echo $DefaultInstitutionName ?>"/>
    </div>
</fieldset>
<fieldset>
    <legend>Other information</legend>
    <div>
        <?php User::printOptionsFor(User::$LOCATION, $default_country); ?>
    </div>
    <div>
        <?php User::printOptionsFor(User::$RELIGION, $default_religion); ?>
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
    content that you post on or in connection with Qnet (IP License). This IP License ends when you
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
    everyone, including people off of Qnet, to access and use that information, and to associate it with
    you (i.e., your name and profile picture).
    5. We always appreciate your feedback or other suggestions about Qnet, but you understand that we
    may use them without any obligation to compensate you for them (just as you have no obligation to offer
    them).

</p>

<h3>3.Safety</h3>

<p>

    <<<<<<< .mine
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
    contest, giveaway, or sweepstakes (�promotion�) on Facebook.
    10. You will not use Facebook to do anything unlawful, misleading, malicious, or discriminatory.
    11. You will not do anything that could disable, overburden, or impair the proper working of Facebook,
    such as a denial of service attack.
    12. You will not facilitate or encourage any violations of this Statement.
    =======
    We do our best to keep Qnet safe, but we cannot guarantee it. We need your help to do that, which
    includes the following commitments:
    1. You will not send or otherwise post unauthorized commercial communications (such as spam) on
    Qnet.
    2. You will not collect users' content or information, or otherwise access Qnet, using automated
    means (such as harvesting bots, robots, spiders, or scrapers) without our permission.
    3. You will not engage in unlawful multi-level marketing, such as a pyramid scheme, on Qnet.
    4. You will not upload viruses or other malicious code.
    5. You will not solicit login information or access an account belonging to someone else.
    6. You will not bully, intimidate, or harass any user.
    7. You will not post content that: is hateful, threatening, or pornographic; incites violence; or
    contains nudity or graphic or gratuitous violence.
    8. You will not develop or operate a third-party application containing alcohol-related or other mature
    content (including advertisements) without appropriate age-based restrictions.
    9. You will follow our Promotions Guidelines and all applicable laws if you publicize or offer any
    contest, giveaway, or sweepstakes (�promotion�) on Qnet.
    10. You will not use Qnet to do anything unlawful, misleading, malicious, or discriminatory.
    11. You will not do anything that could disable, overburden, or impair the proper working of Qnet,
    such as a denial of service attack.
    12. You will not facilitate or encourage any violations of this Statement.
    >>>>>>> .r38

</p>

<h3>4.Registration and Account Security</h3>

<p>Qnet users provide their real names and information, and we need your help to keep it that way. Here are
    some commitments you make to us relating to registering and maintaining the security of your account:
    1. You will not provide any false personal information on Qnet, or create an account for anyone
    other than yourself without permission.
    2. You will not create more than one personal profile.
    3. If we disable your account, you will not create another one without our permission.
    4. You will not use your personal profile for your own commercial gain (such as selling your status
    update to an advertiser).
    5. You will not use Qnet if you are under 13.
    6. You will not use Qnet if you are a convicted sex offender.
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
    1. You will not post content or take any action on Qnet that infringes or violates someone else's rights
    or otherwise violates the law.
    2. We can remove any content or information you post on Qnet if we believe that it violates this
    Statement.
    3. We will provide you with tools to help you protect your intellectual property rights. To learn more,
    visit our How to Report Claims of Intellectual Property Infringement page.
    4. If we remove your content for infringing someone else's copyright, and you believe we removed it by
    mistake, we will provide you with an opportunity to appeal.
    5. If you repeatedly infringe other people's intellectual property rights, we will disable your account when
    appropriate.
    6. You will not use our copyrights or trademarks (including Qnet, the Qnet and F Logos, FB, Face,
    Poke, Wall and 32665), or any confusingly similar marks, without our written permission.
    7. If you collect information from users, you will: obtain their consent, make it clear you (and not
    Qnet) are the one collecting their information, and post a privacy policy explaining what information
    you collect and how you will use it.
    8. You will not post anyone's identification documents or sensitive financial information on Qnet.
    9. You will not tag users or send email invitations to non-users without their consent.

</p>

<h3>6.Mobile</h3>

<p>
    1. We currently provide our mobile services for free, but please be aware that your carrier's normal rates
    and fees, such as text messaging fees, will still apply.
    2. In the event you change or deactivate your mobile telephone number, you will update your account
    information on Qnet within 48 hours to ensure that your messages are not sent to the person who acquires
    your old number.
    3. You provide all rights necessary to enable users to sync (including through an application) their contact
    lists with any basic information and contact information that is visible to them on Qnet, as well as
    your name and profile picture.

</p>

<h3>7.Payments and Deals</h3>

<p>

    1. If you make a payment on Qnet or use Qnet Credits, you agree to our Payments Terms.
    2. If purchase a Deal, you agree to our Deals Terms.
    3. If you provide a Deal or partner with us to provide a Deal, you agree to the Merchant Deal Terms in
    addition to any other agreements you may have with us.

</p>

<h3>8.Special Provisions Applicable to Share Links </h3>

<p>
    If you include our Share Link button on your website, the following additional terms apply to you:
    1. We give you permission to use Qnet's Share Link button so that users can post links or content from
    your website on Qnet.
    2. You give us permission to use and allow others to use such links and content on Qnet.
    3. You will not place a Share Link button on any page containing content that would violate this Statement
    if posted on Qnet.
</p>

<h3>9. Special Provisions Applicable to Developers/Operators of Applications and Websites </h3>

<p>
    If you are a developer or operator of a Platform application or website, the following additional terms apply to
    you:
    1. You are responsible for your application and its content and all uses you make of Platform. This includes
    ensuring your application or use of Platform meets our Qnet Platform Policiesand our Advertising Guidelines.
    2. Your access to and use of data you receive from Qnet, will be limited as follows:
    1. You will only request data you need to operate your application.
    2. You will have a privacy policy that tells users what user data you are going to use and how you will use,
    display, share, or transfer that data and you will include your privacy policy URL in the Developer Application.
    3. You will not use, display, share, or transfer a user�s data in a manner inconsistent with your privacy policy.
    4. You will delete all data you receive from us concerning a user if the user asks you to do so, and will provide a
    mechanism for users to make such a request.
    5. You will not include data you receive from us concerning a user in any advertising creative.
    6. You will not directly or indirectly transfer any data you receive from us to (or use such data in connection
    with) any ad network, ad exchange, data broker, or other advertising related toolset, even if a user consents to
    that transfer or use.
    7. You will not sell user data. If you are acquired by or merge with a third party, you can continue to use user
    data within your application, but you cannot transfer user data outside of your application.
    8. We can require you to delete user data if you use it in a way that we determine is inconsistent with users�
    expectations.
    9. We can limit your access to data.
    10. You will comply with all other restrictions contained in our Qnet Platform Policies.
    3. You will not give us information that you independently collect from a user or a user's content without that
    user's consent.
    4. You will make it easy for users to remove or disconnect from your application.
    5. You will make it easy for users to contact you. We can also share your email address with users and others
    claiming that you have infringed or otherwise violated their rights.
    6. You will provide customer support for your application.
    7. You will not show third party ads or web search boxes on Qnet.
    8. We give you all rights necessary to use the code, APIs, data, and tools you receive from us.
    9. You will not sell, transfer, or sublicense our code, APIs, or tools to anyone.
    10. You will not misrepresent your relationship with Qnet to others.
    11. You may use the logos we make available to developers or issue a press release or other public statement so long
    as you follow our Qnet Platform Policies.
    12. We can issue a press release describing our relationship with you.
    13. You will comply with all applicable laws. In particular you will (if applicable):
    1. have a policy for removing infringing content and terminating repeat infringers that complies with the Digital
    Millennium Copyright Act.
    2. comply with the Video Privacy Protection Act (VPPA), and obtain any opt-in consent necessary from users so that
    user data subject to the VPPA may be shared on Qnet. You represent that any disclosure to us will not be
    incidental to the ordinary course of your business.
    14. We do not guarantee that Platform will always be free.
    15. You give us all rights necessary to enable your application to work with Qnet, including the right to
    incorporate content and information you provide to us into streams, profiles, and user action stories.
    16. You give us the right to link to or frame your application, and place content, including ads, around your
    application.
    17. We can analyze your application, content, and data for any purpose, including commercial (such as for targeting
    the delivery of advertisements and indexing content for search).
    18. To ensure your application is safe for users, we can audit it.
    19. We can create applications that offer similar features and services to, or otherwise compete with, your
    application.


</p>


<h3>10. About Advertisements and Other Commercial Content Served or Enhanced by Qnet</h3>

<p>Our goal is to deliver ads that are not only valuable to advertisers, but also valuable to you. In order to do that,
    you agree to the following:
    1. You can use your privacy settings to limit how your name and profile picture may be associated with commercial,
    sponsored, or related content (such as a brand you like) served or enhanced by us. You give us permission to use
    your name and profile picture in connection with that content, subject to the limits you place.
    2. We do not give your content or information to advertisers without your consent.
    3. You understand that we may not always identify paid services and communications as such.
</p>

<h3>11. Special Provisions Applicable to Advertisers</h3>

<p>
    You can target your specific audience by buying ads on Qnet or our publisher network. The following additional
    terms apply to you if you place an order through our online advertising portal (Order):
    1. When you place an Order, you will tell us the type of advertising you want to buy, the amount you want to spend,
    and your bid. If we accept your Order, we will deliver your ads as inventory becomes available. When serving your
    ad, we do our best to deliver the ads to the audience you specify, although we cannot guarantee in every instance
    that your ad will reach its intended target.
    2. In instances where we believe doing so will enhance the effectiveness of your advertising campaign, we may
    broaden the targeting criteria you specify.
    3. You will pay for your Orders in accordance with our Payments Terms. The amount you owe will be calculated based
    on our tracking mechanisms.
    4. Your ads will comply with our Advertising Guidelines.
    5. We will determine the size, placement, and positioning of your ads.
    6. We do not guarantee the activity that your ads will receive, such as the number of clicks you will get.
    7. We cannot control how people interact with your ads, and are not responsible for click fraud or other improper
    actions that affect the cost of running ads. We do, however, have systems to detect and filter certain suspicious
    activity, learn more here.
    8. You can cancel your Order at any time through our online portal, but it may take up to 24 hours before the ad
    stops running. You are responsible for paying for those ads.
    9. Our license to run your ad will end when we have completed your Order. You understand, however, that if users
    have interacted with your ad, your ad may remain until the users delete it.
    10. We can use your ads and related content and information for marketing or promotional purposes.
    11. You will not issue any press release or make public statements about your relationship with Qnet without
    written permission.
    12. We may reject or remove any ad for any reason.
    13. If you are placing ads on someone else's behalf, we need to make sure you have permission to place those ads,
    including the following:
    1. You warrant that you have the legal authority to bind the advertiser to this Statement.
    2. You agree that if the advertiser you represent violates this Statement, we may hold you responsible for that
    violation.

</p>

<h3>12. Special Provisions Applicable to Pages</h3>

<p>
    If you create or administer a Page on Qnet, you agree to our Pages Terms.

</p>

<h3>13. Amendments</h3>

<p>
    1. We can change this Statement if we provide you notice (by posting the change on the Qnet Site Governance Page)
    and an opportunity to comment. To get notice of any future changes to this Statement, visit our Qnet Site Governance
    Page and become a fan.
    2. For changes to sections 7, 8, 9, and 11 (sections relating to payments, application developers, website
    operators, and advertisers), we will give you a minimum of three days notice. For all other changes we will give you
    a minimum of seven days notice. All such comments must be made on the Qnet Site Governance Page.
    3. If more than 7,000 users comment on the proposed change, we will also give you the opportunity to participate in
    a vote in which you will be provided alternatives. The vote shall be binding on us if more than 30% of all active
    registered users as of the date of the notice vote.
    4. We can make changes for legal or administrative reasons, or to correct an inaccurate statement, upon notice
    without opportunity to comment.


</p>

<h3>14. Termination</h3>

<p>
    If you violate the letter or spirit of this Statement, or otherwise create risk or possible legal exposure for us,
    we can stop providing all or part of Qnet to you. We will notify you by email or at the next time you attempt to
    access your account. You may also delete your account or disable your application at any time. In all such cases,
    this Statement shall terminate, but the following provisions will still apply: 2.2, 2.4, 3-5, 8.2, 9.1-9.3, 9.9,
    9.10, 9.13, 9.15, 9.18, 10.3, 11.2, 11.5, 11.6, 11.9, 11.12, 11.13, and 14-18.


</p>

<h3>15. Disputes</h3>

<p>
    1. You will resolve any claim, cause of action or dispute (claim) you have with us arising out of or relating to
    this Statement or Qnet exclusively in a state or federal court located in Santa Clara County. The laws of the State
    of California will govern this Statement, as well as any claim that might arise between you and us, without regard
    to conflict of law provisions. You agree to submit to the personal jurisdiction of the courts located in Santa Clara
    County, California for the purpose of litigating all such claims.
    2. If anyone brings a claim against us related to your actions, content or information on Qnet, you will indemnify
    and hold us harmless from and against all damages, losses, and expenses of any kind (including reasonable legal fees
    and costs) related to such claim.
    3. WE TRY TO KEEP QNET UP, BUG-FREE, AND SAFE, BUT YOU USE IT AT YOUR OWN RISK. WE ARE PROVIDING QNET AS IS WITHOUT
    ANY EXPRESS OR IMPLIED WARRANTIES INCLUDING, BUT NOT LIMITED TO, IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR
    A PARTICULAR PURPOSE, AND NON-INFRINGEMENT. WE DO NOT GUARANTEE THAT QNET WILL BE SAFE OR SECURE. QNET IS NOT
    RESPONSIBLE FOR THE ACTIONS, CONTENT, INFORMATION, OR DATA OF THIRD PARTIES, AND YOU RELEASE US, OUR DIRECTORS,
    OFFICERS, EMPLOYEES, AND AGENTS FROM ANY CLAIMS AND DAMAGES, KNOWN AND UNKNOWN, ARISING OUT OF OR IN ANY WAY
    CONNECTED WITH ANY CLAIM YOU HAVE AGAINST ANY SUCH THIRD PARTIES. IF YOU ARE A CALIFORNIA RESIDENT, YOU WAIVE
    CALIFORNIA CIVIL CODE �1542, WHICH SAYS: A GENERAL RELEASE DOES NOT EXTEND TO CLAIMS WHICH THE CREDITOR DOES NOT
    KNOW OR SUSPECT TO EXIST IN HIS FAVOR AT THE TIME OF EXECUTING THE RELEASE, WHICH IF KNOWN BY HIM MUST HAVE
    MATERIALLY AFFECTED HIS SETTLEMENT WITH THE DEBTOR. WE WILL NOT BE LIABLE TO YOU FOR ANY LOST PROFITS OR OTHER
    CONSEQUENTIAL, SPECIAL, INDIRECT, OR INCIDENTAL DAMAGES ARISING OUT OF OR IN CONNECTION WITH THIS STATEMENT OR QNET,
    EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. OUR AGGREGATE LIABILITY ARISING OUT OF THIS
    STATEMENT OR QNET WILL NOT EXCEED THE GREATER OF ONE HUNDRED DOLLARS ($100) OR THE AMOUNT YOU HAVE PAID US IN THE
    PAST TWELVE MONTHS. APPLICABLE LAW MAY NOT ALLOW THE LIMITATION OR EXCLUSION OF LIABILITY OR INCIDENTAL OR
    CONSEQUENTIAL DAMAGES, SO THE ABOVE LIMITATION OR EXCLUSION MAY NOT APPLY TO YOU. IN SUCH CASES, QNET'S LIABILITY
    WILL BE LIMITED TO THE FULLEST EXTENT PERMITTED BY APPLICABLE LAW.

</p>

<h3>16. Special Provisions Applicable to Users Outside the United States</h3>

<p>We strive to create a global community with consistent standards for everyone, but we also strive to respect local
    laws. The following provisions apply to users outside the United States:
    1. You consent to having your personal data transferred to and processed in the United States.
    2. If you are located in a country embargoed by the United States, or are on the U.S. Treasury Department's list of
    Specially Designated Nationals you will not engage in commercial activities on Qnet (such as advertising or
    payments) or operate a Platform application or website.
    3. Certain specific terms that apply only for German users are available here.


</p>

<h3>17. Definitions</h3>

<p>
    1. By Qnet we mean the features and services we make available, including through (a) our website at www.Qnet.com
    and any other Qnet branded or co-branded websites (including sub-domains, international versions, widgets, and
    mobile versions); (b) our Platform; (c) social plugins such as the like button, the share button and other similar
    offerings and (d) other media, software (such as a toolbar), devices, or networks now existing or later developed.
    2. By Platform we mean a set of APIs and services that enable others, including application developers and website
    operators, to retrieve data from Qnet or provide data to us.
    3. By information we mean facts and other information about you, including actions you take.
    4. By content we mean anything you post on Qnet that would not be included in the definition of information.
    5. By data we mean content and information that third parties can retrieve from Qnet or provide to Qnet through
    Platform.
    6. By post we mean post on Qnet or otherwise make available to us (such as by using an application).
    7. By use we mean use, copy, publicly perform or display, distribute, modify, translate, and create derivative works
    of.
    8. By active registered user we mean a user who has logged into Qnet at least once in the previous 30 days.
    9. By application we mean any application or website that uses or accesses Platform, as well as anything else that
    receives or has received data from us. If you no longer access Platform but have not deleted all data from us, the
    term application will apply until you delete the data.


</p>

<h3>18. Other</h3>

<p>1. If you are a resident of or have your principal place of business in the US or Canada, this Statement is an
    agreement between you and Qnet, Inc. Otherwise, this Statement is an agreement between you and Qnet Ireland Limited.
    References to �us,� �we,� and �our� mean either Qnet, Inc. or Qnet Ireland Limited, as appropriate.
    2. This Statement makes up the entire agreement between the parties regarding Qnet, and supersedes any prior
    agreements.
    3. If any portion of this Statement is found to be unenforceable, the remaining portion will remain in full force
    and effect.
    4. If we fail to enforce any of this Statement, it will not be considered a waiver.
    5. Any amendment to or waiver of this Statement must be made in writing and signed by us.
    6. You will not transfer any of your rights or obligations under this Statement to anyone else without our consent.
    7. All of our rights and obligations under this Statement are freely assignable by us in connection with a merger,
    acquisition, or sale of assets, or by operation of law or otherwise.
    8. Nothing in this Statement shall prevent us from complying with the law.
    9. This Statement does not confer any third party beneficiary rights.
    10. You will comply with all applicable laws when using or accessing Qnet.
    By application we mean any application or website that uses or accesses Platform, as well as anything else that
    receives or has received data from us. If you no longer access Platform but have not deleted all data from us, the
    term application will apply until you delete the data.


</p>
</div>
<div class="mylabelstyle">
    <p></p>
    <input type="checkbox" name="agreement" value="YES">
    &nbsp; Yes, I accept the above Terms &amp; Conditions.

</div>
</fieldset>

<fieldset>
    <legend>Security</legend>
    <img id="captcha" src="../external/captcha/securimage_show.php" alt="CAPTCHA Image"/>
    <br>
    <a href="#"
       onclick="document.getElementById('captcha').src = '../external/captcha/securimage_show.php?' + Math.random(); return false">[
        Refresh ]</a>
    <!--    <object type="application/x-shockwave-flash"-->
    <!--            data="../external/captcha/securimage_play.swf?audio=../external/captcha/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000"-->
    <!--            width="19" height="19">-->
    <!---->
    <!--        <param name="movie"-->
    <!--               value="../external/captcha/securimage_play.swf?audio=../external/captcha//securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000"/>-->
    <!---->
    <!--    </object>-->
    <br/> <br/>
    <input type="text" name="captcha_code" size="10" maxlength="6"/>

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
function yearOptions($date, $endYear = '', $startYear = '1900')
{
    for ($i = $startYear; $i <= $endYear; $i++)
    {
        ($i == $date) ? $selected = ' selected="selected"' : $selected = '';
        echo '<option value="' . $i . '"' . $selected . '>' . $i . '</option>' . "\n";
    }
}

function monthOptions($date)
{
    $months = array(1 => "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

    foreach ($months as $monthNo => $month)
    {
        ($monthNo == $date) ? $selected = ' selected="selected"' : $selected = '';
        echo '<option value="' . $monthNo . '"' . $selected . '>' . $monthNo . ' - ' . $month . '</option>' . "\n";
    }
}

function dayOptions($date)
{
    for ($i = 1; $i <= 31; $i++)
    {
        ($i == $date) ? $selected = ' selected="selected"' : $selected = '';
        echo '<option value="' . $i . '"' . $selected . '>' . $i . '</option>' . "\n";
    }
}

?>