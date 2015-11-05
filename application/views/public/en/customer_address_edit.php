<div id="main-content" class="float-left fix" xmlns="http://www.w3.org/1999/html">
<?php $this->load->view('public/'.get_language().'/search_view'); ?>

    <form action="<?php echo base_url() . "public/customer/change_address_book"; ?>" method="post">
        <ul class="user-login">
        <fieldset>
            <legend>Your Address</legend>
            <h4><span class="star">*Required fields</span></h4>
            <table
            <tr>
                <td>Company Name</td>
                <td>
                    <input type="text" name="company" id="company" value="<?php echo $customer_company;?>"></br>
                    <?php echo form_error('company', '<span class="error" style="color: red">', '</span>'); ?>
                </td>
            </tr>

            </table>
        </fieldset>
        <fieldset>
        <legend>Your Address <span class="star">*</span></legend>
        <table
        <tr>
            <td>Street Address <span class="star">*</span></td>
            <td>
                <input type="text" name="street" id="street" value="<?php echo $customer_street;?>"></br>
                <?php echo form_error('street', '<span class="error" style="color: red">', '</span>'); ?>
            </td>
        </tr>
        <tr>
            <td>Suburb <span class="star">*</span></td>
            <td>
                <input type="text" name="suburb" id="suburb" value="<?php echo $customer_suburb;?>"></br>
                <?php echo form_error('suburb', '<span class="error" style="color: red">', '</span>'); ?>
            </td>
        </tr>
        <tr>
            <td>Post Code <span class="star">*</span></td>
            <td>
                <input type="text" name="post" id="post" value="<?php echo $customer_postcode;?>"></br>
                <?php echo form_error('post', '<span class="error" style="color: red">', '</span>'); ?>
            </td>
        </tr>
        <tr>
            <td>City <span class="star">*</span></td>
            <td>
                <input type="text" name="city" id="city" value="<?php echo $customer_city;?>"></br>
                <?php echo form_error('city', '<span class="error" style="color: red">', '</span>'); ?>
            </td>
        </tr>
        <tr>
            <td>State/Province <span class="star">*</span></td>
            <td>
                <input type="text" name="state" id="state" value="<?php echo $customer_state;?>"></br>
                <?php echo form_error('state', '<span class="error" style="color: red">', '</span>'); ?>
            </td>
        </tr>
        <tr>
        <td>Country <span class="star">*</span></td>
        <td>
        <select name="country">
        <option selected="selected" value="">Please Select</option>
        <option value="Afghanistan" <?php echo $customer_country==='Afghanistan'?"selected='selected'":'';?>>Afghanistan</option>
        <option value="Albania" <?php echo $customer_country==='Albania'?"selected='selected'":'';?>>Albania</option>
        <option value="Algeria" <?php echo $customer_country==='Algeria'?"selected='selected'":'';?>>Algeria</option>
        <option value="American" <?php echo $customer_country==='American'?"selected='selected'":'';?>>American Samoa</option>
        <option value="Andorra" <?php echo $customer_country==='Andorra'?"selected='selected'":'';?>>Andorra</option>
        <option value="Angola" <?php echo $customer_country==='Angola'?"selected='selected'":'';?>>Angola</option>
        <option value="Anguilla" <?php echo $customer_country==='Anguilla'?"selected='selected'":'';?>>Anguilla</option>
        <option value="Antarctica" <?php echo $customer_country==='Antarctica'?"selected='selected'":'';?>>Antarctica</option>
        <option value="Antigua and Barbuda" <?php echo $customer_country==='Antigua and Barbuda'?"selected='selected'":'';?>>Antigua and Barbuda</option>
        <option value="Argentina" <?php echo $customer_country==='Argentina'?"selected='selected'":'';?>>Argentina</option>
        <option value="Armenia" <?php echo $customer_country==='Armenia'?"selected='selected'":'';?>>Armenia</option>
        <option value="Aruba" <?php echo $customer_country==='Aruba'?"selected='selected'":'';?>>Aruba</option>
        <option value="Australia" <?php echo $customer_country==='Australia'?"selected='selected'":'';?>>Australia</option>
        <option value="Austria" <?php echo $customer_country==='Austria'?"selected='selected'":'';?>>Austria</option>
        <option value="Azerbaijan" <?php echo $customer_country==='Azerbaijan'?"selected='selected'":'';?>>Azerbaijan</option>
        <option value="Bahamas" <?php echo $customer_country==='Bahamas'?"selected='selected'":'';?>>Bahamas</option>
        <option value="Bahrain" <?php echo $customer_country==='Bahrain'?"selected='selected'":'';?>>Bahrain</option>
        <option value="Bangladesh" <?php echo $customer_country==='Bangladesh'?"selected='selected'":'';?>>Bangladesh</option>
        <option value="Barbados" <?php echo $customer_country==='Barbados'?"selected='selected'":'';?>>Barbados</option>
        <option value="Belarus" <?php echo $customer_country==='Belarus'?"selected='selected'":'';?>>Belarus</option>
        <option value="Belgium" <?php echo $customer_country==='Belgium'?"selected='selected'":'';?>>Belgium</option>
        <option value="Belize" <?php echo $customer_country==='Belize'?"selected='selected'":'';?>>Belize</option>
        <option value="Benin" <?php echo $customer_country==='Benin'?"selected='selected'":'';?>>Benin</option>
        <option value="Bermuda" <?php echo $customer_country==='Bermuda'?"selected='selected'":'';?>>Bermuda</option>
        <option value="Bhutan" <?php echo $customer_country==='Bhutan'?"selected='selected'":'';?>>Bhutan</option>
        <option value="Bolivia" <?php echo $customer_country==='Bolivia'?"selected='selected'":'';?>>Bolivia</option>
        <option value="Bosnia and Herzegowina" <?php echo $customer_country==='Bosnia and Herzegowina'?"selected='selected'":'';?>>Bosnia and Herzegowina</option>
        <option value="Botswana" <?php echo $customer_country==='Botswana'?"selected='selected'":'';?>>Botswana</option>
        <option value="ouvet Island" <?php echo $customer_country==='ouvet Island'?"selected='selected'":'';?>>Bouvet Island</option>
        <option value="Brazil" <?php echo $customer_country==='Brazil'?"selected='selected'":'';?>>Brazil</option>
        <option value="British Indian Ocean Territory" <?php echo $customer_country==='British Indian Ocean Territory'?"selected='selected'":'';?>>British Indian Ocean Territory</option>
        <option value="Brunei Darussalam" <?php echo $customer_country==='Brunei Darussalam'?"selected='selected'":'';?>>Brunei Darussalam</option>
        <option value="Bulgaria" <?php echo $customer_country==='Bulgaria'?"selected='selected'":'';?>>Bulgaria</option>
        <option value="Burkina Faso" <?php echo $customer_country==='Burkina Faso'?"selected='selected'":'';?>>Burkina Faso</option>
        <option value="Burundi" <?php echo $customer_country==='Burundi'?"selected='selected'":'';?>>Burundi</option>
        <option value="Cambodia" <?php echo $customer_country==='Cambodia'?"selected='selected'":'';?>>Cambodia</option>
        <option value="Cameroon" <?php echo $customer_country==='Cameroon'?"selected='selected'":'';?>>Cameroon</option>
        <option value="Canada" <?php echo $customer_country==='Canada'?"selected='selected'":'';?>>Canada</option>
        <option value="Cape Verde" <?php echo $customer_country==='Cape Verde'?"selected='selected'":'';?>>Cape Verde</option>
        <option value="Cayman Islands" <?php echo $customer_country==='Cayman Islands'?"selected='selected'":'';?>>Cayman Islands</option>
        <option value="Central African Republic" <?php echo $customer_country==='Central African Republic'?"selected='selected'":'';?>>Central African Republic</option>
        <option value="Chad" <?php echo $customer_country==='Chad'?"selected='selected'":'';?>>Chad</option>
        <option value="Chile" <?php echo $customer_country==='Chile'?"selected='selected'":'';?>>Chile</option>
        <option value="China" <?php echo $customer_country==='China'?"selected='selected'":'';?>>China</option>
        <option value="Christmas Island" <?php echo $customer_country==='Christmas Island'?"selected='selected'":'';?>>Christmas Island</option>
        <option value="Cocos (Keeling) Islands" <?php echo $customer_country==='Cocos (Keeling) Islands'?"selected='selected'":'';?>>Cocos (Keeling) Islands</option>
        <option value="Colombia" <?php echo $customer_country==='Colombia'?"selected='selected'":'';?>>Colombia</option>
        <option value="Comoros" <?php echo $customer_country==='Comoros'?"selected='selected'":'';?>>Comoros</option>
        <option value="Congo" <?php echo $customer_country==='Congo'?"selected='selected'":'';?>>Congo</option>
        <option value="Cook Islands" <?php echo $customer_country==='Cook Islands'?"selected='selected'":'';?>>Cook Islands</option>
        <option value="Costa Rica" <?php echo $customer_country==='Costa Rica'?"selected='selected'":'';?>>Costa Rica</option>
        <option value="Cote D'Ivoire" <?php echo $customer_country==='Cote D\'Ivoire'?"selected='selected'":'';?>>Cote D'Ivoire</option>
        <option value="Croatia" <?php echo $customer_country==='Croatia'?"selected='selected'":'';?>>Croatia</option>
        <option value="Cuba" <?php echo $customer_country==='Cuba'?"selected='selected'":'';?>>Cuba</option>
        <option value="Cyprus" <?php echo $customer_country==='Cyprus'?"selected='selected'":'';?>>Cyprus</option>
        <option value="Czech Republic" <?php echo $customer_country==='Czech Republic'?"selected='selected'":'';?>>Czech Republic</option>
        <option value="Denmark" <?php echo $customer_country==='Denmark'?"selected='selected'":'';?>>Denmark</option>
        <option value="Djibouti" <?php echo $customer_country==='Djibouti'?"selected='selected'":'';?>>Djibouti</option>
        <option value="Dominica" <?php echo $customer_country==='Dominica'?"selected='selected'":'';?>>Dominica</option>
        <option value="Dominican Republic" <?php echo $customer_country==='Dominican Republic'?"selected='selected'":'';?>>Dominican Republic</option>
        <option value="East Timor" <?php echo $customer_country==='East Timor'?"selected='selected'":'';?>>East Timor</option>
        <option value="Ecuador" <?php echo $customer_country==='Ecuador'?"selected='selected'":'';?>>Ecuador</option>
        <option value="Egypt" <?php echo $customer_country==='Egypt'?"selected='selected'":'';?>>Egypt</option>
        <option value="El Salvador" <?php echo $customer_country==='El Salvador'?"selected='selected'":'';?>>El Salvador</option>
        <option value="Equatorial Guinea" <?php echo $customer_country==='Equatorial Guinea'?"selected='selected'":'';?>>Equatorial Guinea</option>
        <option value="Eritrea" <?php echo $customer_country==='Eritrea'?"selected='selected'":'';?>>Eritrea</option>
        <option value="Estonia" <?php echo $customer_country==='Estonia'?"selected='selected'":'';?>>Estonia</option>
        <option value="Ethiopia" <?php echo $customer_country==='Ethiopia'?"selected='selected'":'';?>>Ethiopia</option>
        <option value="Falkland Islands (Malvinas)" <?php echo $customer_country==='Falkland Islands (Malvinas)'?"selected='selected'":'';?>>Falkland Islands (Malvinas)</option>
        <option value="Faroe Islands" <?php echo $customer_country==='Faroe Islands'?"selected='selected'":'';?>>Faroe Islands</option>
        <option value="Fiji" <?php echo $customer_country==='Fiji'?"selected='selected'":'';?>>Fiji</option>
        <option value="Finland" <?php echo $customer_country==='Finland'?"selected='selected'":'';?>>Finland</option>
        <option value="France" <?php echo $customer_country==='France'?"selected='selected'":'';?>>France</option>
        <option value="France, Metropolitan" <?php echo $customer_country==='France, Metropolitan'?"selected='selected'":'';?>>France, Metropolitan</option>
        <option value="French Guiana" <?php echo $customer_country==='French Guiana'?"selected='selected'":'';?>>French Guiana</option>
        <option value="French Polynesia" <?php echo $customer_country==='French Southern Territories'?"selected='selected'":'';?>>French Polynesia</option>
        <option value="French Southern Territories" <?php echo $customer_country==='French Southern Territories'?"selected='selected'":'';?>>French Southern Territories</option>
        <option value="Gabon" <?php echo $customer_country==='Gabon'?"selected='selected'":'';?>>Gabon</option>
        <option value="Gambia" <?php echo $customer_country==='Gambia'?"selected='selected'":'';?>>Gambia</option>
        <option value="Georgia" <?php echo $customer_country==='Georgia'?"selected='selected'":'';?>>Georgia</option>
        <option value="Germany" <?php echo $customer_country==='Germany'?"selected='selected'":'';?>>Germany</option>
        <option value="Ghana" <?php echo $customer_country==='Ghana'?"selected='selected'":'';?>>Ghana</option>
        <option value="Gibraltar" <?php echo $customer_country==='Gibraltar'?"selected='selected'":'';?>>Gibraltar</option>
        <option value="Greece" <?php echo $customer_country==='Greece'?"selected='selected'":'';?>>Greece</option>
        <option value="Greenland" <?php echo $customer_country==='Greenland'?"selected='selected'":'';?>>Greenland</option>
        <option value="Grenada" <?php echo $customer_country==='Grenada'?"selected='selected'":'';?>>Grenada</option>
        <option value="Guadeloupe" <?php echo $customer_country==='Guadeloupe'?"selected='selected'":'';?>>Guadeloupe</option>
        <option value="Guam" <?php echo $customer_country==='Guam'?"selected='selected'":'';?>>Guam</option>
        <option value="Guatemala" <?php echo $customer_country==='Guatemala'?"selected='selected'":'';?>>Guatemala</option>
        <option value="Guinea" <?php echo $customer_country==='Guinea'?"selected='selected'":'';?>>Guinea</option>
        <option value="Guinea-bissau" <?php echo $customer_country==='Guinea-bissau'?"selected='selected'":'';?>>Guinea-bissau</option>
        <option value="Guyana" <?php echo $customer_country==='Guyana'?"selected='selected'":'';?>>Guyana</option>
        <option value="Haiti" <?php echo $customer_country==='Haiti'?"selected='selected'":'';?>>Haiti</option>
        <option value="Heard and Mc Donald Islands" <?php echo $customer_country==='Heard and Mc Donald Islands'?"selected='selected'":'';?>>Heard and Mc Donald Islands</option>
        <option value="Honduras" <?php echo $customer_country==='Honduras'?"selected='selected'":'';?>>Honduras</option>
        <option value="Hong Kong" <?php echo $customer_country==='Hong Kong'?"selected='selected'":'';?>>Hong Kong</option>
        <option value="Hungary" <?php echo $customer_country==='Hungary'?"selected='selected'":'';?>>Hungary</option>
        <option value="Iceland" <?php echo $customer_country==='Iceland'?"selected='selected'":'';?>>Iceland</option>
        <option value="India" <?php echo $customer_country==='India'?"selected='selected'":'';?>>India</option>
        <option value="Indonesia" <?php echo $customer_country==='Indonesia'?"selected='selected'":'';?>>Indonesia</option>
        <option value="Iran (Islamic Republic of)" <?php echo $customer_country==='Iran (Islamic Republic of)'?"selected='selected'":'';?>>Iran (Islamic Republic of)</option>
        <option value="Iraq" <?php echo $customer_country==='Iraq'?"selected='selected'":'';?>>Iraq</option>
        <option value="Ireland" <?php echo $customer_country==='Ireland'?"selected='selected'":'';?>>Ireland</option>
        <option value="Israel" <?php echo $customer_country==='Israel'?"selected='selected'":'';?>>Israel</option>
        <option value="Italy" <?php echo $customer_country==='Italy'?"selected='selected'":'';?>>Italy</option>
        <option value="Italy" <?php echo $customer_country==='Italy'?"selected='selected'":'';?>>Italy</option>
        <option value="Italy" <?php echo $customer_country==='Italy'?"selected='selected'":'';?>>Italy</option>
        <option value="Jordan" <?php echo $customer_country==='Jordan'?"selected='selected'":'';?>>Jordan</option>
        <option value="Kazakhstan" <?php echo $customer_country==='Kazakhstan'?"selected='selected'":'';?>>Kazakhstan</option>
        <option value="Kenya" <?php echo $customer_country==='Kenya'?"selected='selected'":'';?>>Kenya</option>
        <option value="Kiribati" <?php echo $customer_country==='Kiribati'?"selected='selected'":'';?>>Kiribati</option>
        <option value="Korea, Democratic People's Republic of" <?php echo $customer_country==='Korea, Democratic People\'s Republic of'?"selected='selected'":'';?>>Korea, Democratic People's Republic of</option>
        <option value="Korea, Republic of" <?php echo $customer_country==='Korea, Republic of'?"selected='selected'":'';?>>Korea, Republic of</option>
        <option value="Kuwait" <?php echo $customer_country==='Kuwait'?"selected='selected'":'';?>>Kuwait</option>
        <option value="Kyrgyzstan" <?php echo $customer_country==='Kyrgyzstan'?"selected='selected'":'';?>>Kyrgyzstan</option>
        <option value="Lao People's Democratic Republic" <?php echo $customer_country==='Lao People\'s Democratic Republic'?"selected='selected'":'';?>>Lao People's Democratic Republic</option>
        <option value="Latvia" <?php echo $customer_country==='Latvia'?"selected='selected'":'';?>>Latvia</option>
        <option value="Lebanon" <?php echo $customer_country==='Lebanon'?"selected='selected'":'';?>>Lebanon</option>
        <option value="Lesotho" <?php echo $customer_country==='Lesotho'?"selected='selected'":'';?>>Lesotho</option>
        <option value="Liberia" <?php echo $customer_country==='Liberia'?"selected='selected'":'';?>>Liberia</option>
        <option value="Libyan Arab Jamahiriya" <?php echo $customer_country==='Libyan Arab Jamahiriya'?"selected='selected'":'';?>>Libyan Arab Jamahiriya</option>
        <option value="Liechtenstein" <?php echo $customer_country==='Liechtenstein'?"selected='selected'":'';?>>Liechtenstein</option>
        <option value="Lithuania" <?php echo $customer_country==='Lithuania'?"selected='selected'":'';?>>Lithuania</option>
        <option value="Luxembourg" <?php echo $customer_country==='Luxembourg'?"selected='selected'":'';?>>Luxembourg</option>
        <option value="Macau" <?php echo $customer_country==='Macau'?"selected='selected'":'';?>>Macau</option>
        <option value="Macedonia, The Former Yugoslav Republic of" <?php echo $customer_country==='Macedonia, The Former Yugoslav Republic of'?"selected='selected'":'';?>>Macedonia, The Former Yugoslav Republic of</option>
        <option value="Madagascar" <?php echo $customer_country==='Madagascar'?"selected='selected'":'';?>>Madagascar</option>
        <option value="Malawi" <?php echo $customer_country==='Malawi'?"selected='selected'":'';?>>Malawi</option>
        <option value="Malaysia" <?php echo $customer_country==='Malaysia'?"selected='selected'":'';?>>Malaysia</option>
        <option value="Maldives" <?php echo $customer_country==='Maldives'?"selected='selected'":'';?>>Maldives</option>
        <option value="Mali" <?php echo $customer_country==='Mali'?"selected='selected'":'';?>>Mali</option>
        <option value="Malta" <?php echo $customer_country==='Malta'?"selected='selected'":'';?>>Malta</option>
        <option value="Marshall Islands" <?php echo $customer_country==='Marshall Islands'?"selected='selected'":'';?>>Marshall Islands</option>
        <option value="Martinique" <?php echo $customer_country==='Martinique'?"selected='selected'":'';?>>Martinique</option>
        <option value="Mauritania" <?php echo $customer_country==='Mauritania'?"selected='selected'":'';?>>Mauritania</option>
        <option value="Mauritius" <?php echo $customer_country==='Mauritius'?"selected='selected'":'';?>>Mauritius</option>
        <option value="Mayotte" <?php echo $customer_country==='Mayotte'?"selected='selected'":'';?>>Mayotte</option>
        <option value="Mexico" <?php echo $customer_country==='Mexico'?"selected='selected'":'';?>>Mexico</option>
        <option value="Micronesia, Federated States of" <?php echo $customer_country==='Micronesia, Federated States of'?"selected='selected'":'';?>>Micronesia, Federated States of</option>
        <option value="Moldova, Republic of" <?php echo $customer_country==='Moldova, Republic o'?"selected='selected'":'';?>>Moldova, Republic of</option>
        <option value="Monaco" <?php echo $customer_country==='Monaco'?"selected='selected'":'';?>>Monaco</option>
        <option value="Mongolia" <?php echo $customer_country==='Mongolia'?"selected='selected'":'';?>>Mongolia</option>
        <option value="Montserrat" <?php echo $customer_country==='Montserrat'?"selected='selected'":'';?>>Montserrat</option>
        <option value="Morocco" <?php echo $customer_country==='Morocco'?"selected='selected'":'';?>>Morocco</option>
        <option value="Mozambique" <?php echo $customer_country==='Mozambique'?"selected='selected'":'';?>>Mozambique</option>
        <option value="Myanmar" <?php echo $customer_country==='Myanmar'?"selected='selected'":'';?>>Myanmar</option>
        <option value="Namibia" <?php echo $customer_country==='Namibia'?"selected='selected'":'';?>>Namibia</option>
        <option value="Nauru" <?php echo $customer_country==='Nauru'?"selected='selected'":'';?>>Nauru</option>
        <option value="Nepal" <?php echo $customer_country==='Nepal'?"selected='selected'":'';?>>Nepal</option>
        <option value="Netherlands" <?php echo $customer_country==='Netherlands'?"selected='selected'":'';?>>Netherlands</option>
        <option value="Netherlands Antilles" <?php echo $customer_country==='Netherlands Antilles'?"selected='selected'":'';?>>Netherlands Antilles</option>
        <option value="New Caledonia" <?php echo $customer_country==='New Caledonia'?"selected='selected'":'';?>>New Caledonia</option>
        <option value="New Zealand" <?php echo $customer_country==='New Zealand'?"selected='selected'":'';?>>New Zealand</option>
        <option value="Nicaragua" <?php echo $customer_country==='Nicaragua'?"selected='selected'":'';?>>Nicaragua</option>
        <option value="Niger" <?php echo $customer_country==='Niger'?"selected='selected'":'';?>>Niger</option>
        <option value="Nigeria" <?php echo $customer_country==='Nigeria'?"selected='selected'":'';?>>Nigeria</option>
        <option value="Niue" <?php echo $customer_country==='Niue'?"selected='selected'":'';?>>Niue</option>
        <option value="Norfolk Island" <?php echo $customer_country==='Norfolk Island'?"selected='selected'":'';?>>Norfolk Island</option>
        <option value="Northern Mariana Islands" <?php echo $customer_country==='Northern Mariana Islands'?"selected='selected'":'';?>>Northern Mariana Islands</option>
        <option value="Norway" <?php echo $customer_country==='Norway'?"selected='selected'":'';?>>Norway</option>
        <option value="Oman" <?php echo $customer_country==='Oman'?"selected='selected'":'';?>>Oman</option>
        <option value="Pakistan" <?php echo $customer_country==='Pakistan'?"selected='selected'":'';?>>Pakistan</option>
        <option value="Palau" <?php echo $customer_country==='Palau'?"selected='selected'":'';?>>Palau</option>
        <option value="Panama" <?php echo $customer_country==='Panama'?"selected='selected'":'';?>>Panama</option>
        <option value="Papua New Guinea" <?php echo $customer_country==='Papua New Guinea'?"selected='selected'":'';?>>Papua New Guinea</option>
        <option value="Paraguay" <?php echo $customer_country==='Paraguay'?"selected='selected'":'';?>>Paraguay</option>
        <option value="Peru" <?php echo $customer_country==='Peru'?"selected='selected'":'';?>>Peru</option>
        <option value="Philippines" <?php echo $customer_country==='Philippines'?"selected='selected'":'';?>>Philippines</option>
        <option value="Pitcairn" <?php echo $customer_country==='Pitcairn'?"selected='selected'":'';?>>Pitcairn</option>
        <option value="Poland" <?php echo $customer_country==='Poland'?"selected='selected'":'';?>>Poland</option>
        <option value="Portugal" <?php echo $customer_country==='Portugal'?"selected='selected'":'';?>>Portugal</option>
        <option value="Puerto Rico" <?php echo $customer_country==='Puerto Rico'?"selected='selected'":'';?>>Puerto Rico</option>
        <option value="Qatar" <?php echo $customer_country==='Qatar'?"selected='selected'":'';?>>Qatar</option>
        <option value="Reunion" <?php echo $customer_country==='Reunion'?"selected='selected'":'';?>>Reunion</option>
        <option value="Romania" <?php echo $customer_country==='Romania'?"selected='selected'":'';?>>Romania</option>
        <option value="Russian Federation" <?php echo $customer_country==='Russian Federation'?"selected='selected'":'';?>>Russian Federation</option>
        <option value="Rwanda" <?php echo $customer_country==='Rwanda'?"selected='selected'":'';?>>Rwanda</option>
        <option value="Saint Kitts and Nevis" <?php echo $customer_country==='Saint Kitts and Nevis'?"selected='selected'":'';?>>Saint Kitts and Nevis</option>
        <option value="Saint Lucia" <?php echo $customer_country==='Saint Lucia'?"selected='selected'":'';?>>Saint Lucia</option>
        <option value="Saint Vincent and the Grenadines" <?php echo $customer_country==='Saint Vincent and the Grenadines'?"selected='selected'":'';?>>Saint Vincent and the Grenadines</option>
        <option value="Samoa" <?php echo $customer_country==='Samoa'?"selected='selected'":'';?>>Samoa</option>
        <option value="San Marino" <?php echo $customer_country==='San Marino'?"selected='selected'":'';?>>San Marino</option>
        <option value="Sao Tome and Principe" <?php echo $customer_country==='Sao Tome and Principe'?"selected='selected'":'';?>>Sao Tome and Principe</option>
        <option value="Saudi Arabia" <?php echo $customer_country==='Saudi Arabia'?"selected='selected'":'';?>>Saudi Arabia</option>
        <option value="Senegal" <?php echo $customer_country==='Senegal'?"selected='selected'":'';?>>Senegal</option>
        <option value="Seychelles" <?php echo $customer_country==='Seychelles'?"selected='selected'":'';?>>Seychelles</option>
        <option value="Sierra Leone" <?php echo $customer_country==='Sierra Leone'?"selected='selected'":'';?>>Sierra Leone</option>
        <option value="Singapore" <?php echo $customer_country==='Singapore'?"selected='selected'":'';?>>Singapore</option>
        <option value="lovakia (Slovak Republic)" <?php echo $customer_country==='lovakia (Slovak Republic)'?"selected='selected'":'';?>>Slovakia (Slovak Republic)</option>
        <option value="Slovenia" <?php echo $customer_country==='Slovenia'?"selected='selected'":'';?>>Slovenia</option>
        <option value="Solomon Islands" <?php echo $customer_country==='Solomon Islands'?"selected='selected'":'';?>>Solomon Islands</option>
        <option value="Somalia" <?php echo $customer_country==='Somalia'?"selected='selected'":'';?>>Somalia</option>
        <option value="South Africa" <?php echo $customer_country==='South Africa'?"selected='selected'":'';?>>South Africa</option>
        <option value="South Georgia and the South Sandwich Islands" <?php echo $customer_country==='South Georgia and the South Sandwich Islands'?"selected='selected'":'';?>>South Georgia and the South Sandwich Islands</option>
        <option value="Spain" <?php echo $customer_country==='Spain'?"selected='selected'":'';?>>Spain</option>
        <option value="Sri Lanka" <?php echo $customer_country==='Sri Lanka'?"selected='selected'":'';?>>Sri Lanka</option>
        <option value="St. Helena" <?php echo $customer_country==='St. Helena'?"selected='selected'":'';?>>St. Helena</option>
        <option value="St. Pierre and Miquelon" <?php echo $customer_country==='St. Pierre and Miquelon'?"selected='selected'":'';?>>St. Pierre and Miquelon</option>
        <option value="Sudan" <?php echo $customer_country==='Sudan'?"selected='selected'":'';?>>Sudan</option>
        <option value="Suriname" <?php echo $customer_country==='Suriname'?"selected='selected'":'';?>>Suriname</option>
        <option value="Svalbard and Jan Mayen Islands" <?php echo $customer_country==='Svalbard and Jan Mayen Islands'?"selected='selected'":'';?>>Svalbard and Jan Mayen Islands</option>
        <option value="Swaziland" <?php echo $customer_country==='Swaziland'?"selected='selected'":'';?>>Swaziland</option>
        <option value="Sweden" <?php echo $customer_country==='Sweden'?"selected='selected'":'';?>>Sweden</option>
        <option value="Switzerland" <?php echo $customer_country==='Switzerland'?"selected='selected'":'';?>>Switzerland</option>
        <option value="Syrian Arab Republic" <?php echo $customer_country==='Syrian Arab Republic'?"selected='selected'":'';?>>Syrian Arab Republic</option>
        <option value="Taiwan" <?php echo $customer_country==='Taiwan'?"selected='selected'":'';?>>Taiwan</option>
        <option value="Tajikistan" <?php echo $customer_country==='Tajikistan'?"selected='selected'":'';?>>Tajikistan</option>
        <option value="Tanzania, United Republic of" <?php echo $customer_country==='Tanzania, United Republic of'?"selected='selected'":'';?>>Tanzania, United Republic of</option>
        <option value="Thailand" <?php echo $customer_country==='Thailand'?"selected='selected'":'';?>>Thailand</option>
        <option value="Togo" <?php echo $customer_country==='Togo'?"selected='selected'":'';?>>Togo</option>
        <option value="Tokelau" <?php echo $customer_country==='Tokelau'?"selected='selected'":'';?>>Tokelau</option>
        <option value="Tonga" <?php echo $customer_country==='Tonga'?"selected='selected'":'';?>>Tonga</option>
        <option value="Trinidad and Tobago" <?php echo $customer_country==='Trinidad and Tobago'?"selected='selected'":'';?>>Trinidad and Tobago</option>
        <option value="Tunisia" <?php echo $customer_country==='Tunisia'?"selected='selected'":'';?>>Tunisia</option>
        <option value="Turkey" <?php echo $customer_country==='Turkey'?"selected='selected'":'';?>>Turkey</option>
        <option value="Turkmenistan" <?php echo $customer_country==='Turkmenistan'?"selected='selected'":'';?>>Turkmenistan</option>
        <option value="Turks and Caicos Islands" <?php echo $customer_country==='Turks and Caicos Islands'?"selected='selected'":'';?>>Turks and Caicos Islands</option>
        <option value="Tuvalu" <?php echo $customer_country==='Tuvalu'?"selected='selected'":'';?>>Tuvalu</option>
        <option value="Uganda" <?php echo $customer_country==='Uganda'?"selected='selected'":'';?>>Uganda</option>
        <option value="Ukraine" <?php echo $customer_country==='Ukraine'?"selected='selected'":'';?>>Ukraine</option>
        <option value="United Arab Emirates" <?php echo $customer_country==='United Arab Emirates'?"selected='selected'":'';?>>United Arab Emirates</option>
        <option value="United Kingdom" <?php echo $customer_country==='United Kingdom'?"selected='selected'":'';?>>United Kingdom</option>
        <option value="United States" <?php echo $customer_country==='United States'?"selected='selected'":'';?>>United States</option>
        <option value=">United States Minor Outlying Islands" <?php echo $customer_country==='>United States Minor Outlying Islands'?"selected='selected'":'';?>>United States Minor Outlying Islands</option>
        <option value="Uruguay" <?php echo $customer_country==='Uruguay'?"selected='selected'":'';?>>Uruguay</option>
        <option value="Uzbekistan" <?php echo $customer_country==='Uzbekistan'?"selected='selected'":'';?>>Uzbekistan</option>
        <option value="Vanuatu" <?php echo $customer_country==='Vanuatu'?"selected='selected'":'';?>>Vanuatu</option>
        <option value="Vatican City State (Holy See)" <?php echo $customer_country==='Vatican City State (Holy See)'?"selected='selected'":'';?>>Vatican City State (Holy See)</option>
        <option value="Venezuela" <?php echo $customer_country==='Venezuela'?"selected='selected'":'';?>>Venezuela</option>
        <option value="Viet Nam" <?php echo $customer_country==='Viet Nam'?"selected='selected'":'';?>>Viet Nam</option>
        <option value="Virgin Islands (British)" <?php echo $customer_country==='Virgin Islands (British)'?"selected='selected'":'';?>>Virgin Islands (British)</option>
        <option value="Virgin Islands (U.S.)" <?php echo $customer_country==='Virgin Islands (U.S.)'?"selected='selected'":'';?>>Virgin Islands (U.S.)</option>
        <option value="Wallis and Futuna Islands" <?php echo $customer_country==='Wallis and Futuna Islands'?"selected='selected'":'';?>>Wallis and Futuna Islands</option>
        <option value="Western Sahara" <?php echo $customer_country==='Western Sahara'?"selected='selected'":'';?>>Western Sahara</option>
        <option value="Yemen" <?php echo $customer_country==='Yemen'?"selected='selected'":'';?>>Yemen</option>
        <option value="Yugoslavia" <?php echo $customer_country==='Yugoslavia'?"selected='selected'":'';?>>Yugoslavia</option>
        <option value="Zaire" <?php echo $customer_country==='Zaire'?"selected='selected'":'';?>>Zaire</option>
        <option value="Zambia" <?php echo $customer_country==='Zambia'?"selected='selected'":'';?>>Zambia</option>
        <option value="Zimbabwe" <?php echo $customer_country==='Zimbabwe'?"selected='selected'":'';?>>Zimbabwe</option>
        </select></br>
        <?php echo form_error('country', '<span class="error" style="color: red">', '</span>'); ?>
        </td>
        </tr>

        </table>
        </fieldset>
        <fieldset>
            <legend>Your Contact Information</legend>
            <table
            <tr>
                <td>Telephone no</td>
                <td>
                    <input type="text" name="telephone" id="telephone" value="<?php echo $customer_telephone_no;?>"></br>
                    <?php echo form_error('telephone', '<span class="error" style="color: red">', '</span>'); ?>
                </td>
            </tr>
            <tr>
                <td><a class="next-previous" href="<?php echo base_url() . "public/customer/account"; ?>">Back</a></td>
                <td>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                </td>
                <td>
                    <input type="submit" class="next-previous" name="edit_customer_info" value="Continue"/>
                </td>
            </tr>
            </table>
        </fieldset>
        </ul>
    </form>
</div>