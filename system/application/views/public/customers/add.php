<?= $this->load->view('_template/public_header.html'); ?>

</head>

<body>
  <div id="wrapper">
   <div id="greyTop">
    <div id="innerWrapper">
    <div id="leftBox">
      <?$this->load->view('public/navigation',$navstate);?>
      
    </div>
    <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
    <div id="rightBox">
      <div id="headTop">
        <h1>Neues Unternehmen hinzufügen</h1>
        <div class="logout"><a href="<?=base_url();?>login/logout">&raquo; Logout</a></div>
        <div class="clear"></div>
      </div>
      
      <div id="content">
        <div id="left">
          <form id="data" class="data" action="<?=base_url();?>customer/add" method="post">
            
            <label class="user" for="company">Unternehmen:</label>
            <input type="text" id="company" name="company">
            <div class="clear"></div> 

            <label class="user" for="legal_person">Form:</label>
            <select name="companyform" id="companyform" size="1">
               <option value='ka'>keine Angabe</option>
               <option value='ek'>Einzelunternehmen</option>
               <option value='gmbh'>GmbH</option>
               <option value='ag'>AG</option>
               <option value='kg'>KG</option>
               <option value='ohg'>OHG</option>
               <option value='gbr'>GbR</option>
               <option value='ug'>UG</option>
            </select>
            <div class="clear"></div> 
<!--   
            <label class="user" for="headquarter">Geschäftsführer:</label>
            <select name="headquarter" size="1" >
              <?php //if ($formular->headquarter == '1') {
              //  echo "<option value='1'>Ja</option>";
               // echo "<option value='0'>Nein</option>"; 
              //} else {
               // echo "<option value='0'>Nein</option>";
               // echo "<option value='1'>Ja</option>"; 
            //   }?>
            </select>
            <div class="clear"></div> 

          <label class="user" for="gender">Anrede:</label>
            <select name="gender" size="1" >
              <?php //if ($formular->contact_gender == 'Herr') {
                //echo "<option value='Herr'>Herr</option>";
                //echo "<option value='Frau'>Frau</option>"; 
            //  } //else {
                //echo "<option value='Frau'>Frau</option>";
                //echo "<option value='Herr'>Herr</option>"; 
              // }?>
            </select>
            <div class="clear"></div> 

            <label class="user" for="firstName">Vorname:</label>
            <input type="text" id="firstName" name="firstName">
            <div class="clear"></div> 
            
            <label class="user" for="lastName">Nachname:</label>
            <input type="text" id="lastName" name="lastName">
            <div class="clear"></div> 

            <label class="user" for="birth">Geburtsdatum:</label>
            <input type="text" id="birth" name="birth">
            <div class="clear"></div> 

            <label class="user" for="mobile">Mobil:</label>
            <input type="text" id="mobile" name="mobile">
            <div class="clear"></div>        
             -->
            <label class="user" for="phone">Telefon:</label>
            <input type="text" id="phone" name="phone">
            <div class="clear"></div>

            <label class="user" for="fax">Fax:</label>
            <input type="text" id="fax" name="fax">
            <div class="clear"></div>

            <label class="user" for="mail">E-Mail:</label>
            <input type="text" id="mail" name="mail">
            <div class="clear"></div> 
            
            <label class="user" for="streetNumber">Straße / Hsnr.:</label>
            <input type="text" id="street" name="street">
            <div class="clear"></div>
            
            <label class="user" for="zipcodeCity">PLZ / Stadt:</label>
            <input type="text" id="zipcode" name="zipcode">
            <input type="text" id="town" name="town">
            <div class="clear"></div>

            <label class="user" for="state">Bundesland:</label>
            <select name="state" id="state" size="1">
               <option value='ka'>keine Angabe</option>
               <option value='bw'>Baden-Württemberg</option>
               <option value='b'>Bayern</option>
               <option value='bln'>Berlin</option>
               <option value='bb'>Brandenburg</option>
               <option value='br'>Bremen</option>
               <option value='hh'>Hamburg</option>
               <option value='he'>Hessen</option>
               <option value='mv'>Mecklenburg-Vorpommern</option>
               <option value='ni'>Niedersachen</option>
               <option value='nw'>Nordrhein-Westfalen</option>
               <option value='rp'>Rheinland-Pfalz</option>
               <option value='saa'>Saarland</option>
               <option value='sac'>Sachsen</option>
               <option value='saca'>Sachsen-Anhalt</option>
               <option value='sh'>Schleswig-Holstein</option>
               <option value='th'>Thüringen</option>
            </select>
            <div class="clear"></div>
                                            
            <label class="user" for="country">Region:</label>
            <select name="country" id="country" size="1">
               <option value='ka'>keine Angabe</option>
               <option value='rg'>Ruhrgebiet</option>
               <option value='rh'>Rheinland</option>
               <option value='sl'>Sauerland</option>
               <option value='bl'>Bergisches Land</option>
               <option value='ml'>Münsterland</option>
               <option value='so'>sonstiges</option>
            </select>
            <div class="clear"></div> 

            <label class="user" for="page">Homepage:</label>
            <input type="text" id="page" name="page">
            <div class="clear"></div>  

            <label class="user" for="year">Gründungsjahr:</label>
            <input type="text" id="year" name="year">
            <div class="clear"></div> 

            <label class="user" for="firstcontact">Erster Kontakt:</label>
            <input type="text" id="firstcontact" name="firstcontact">
            <div class="clear"></div>    

           <!-- <label class="user" for="international">International:</label>
            <select name="international" size="1" >
              <?php //if ($formular->international == '1') {
                //echo "<option value='1'>Ja</option>";
                //echo "<option value='0'>Nein</option>"; 
         //     } //else {
                //echo "<option value='0'>Nein</option>";
                //echo "<option value='1'>Ja</option>"; 
              // }?>
            </select>  
            --> 
            <div class="clear"></div>   

            <label class="user2" for="attendant">Unternehmen als Person hinzufügen?</label>
            <select name="attendant" size="1" >
              <?php if ($formular->copy_attendant == '1') {
                echo "<option value='1'>Ja</option>";
                echo "<option value='0'>Nein</option>"; 
              } else {
                echo "<option value='0'>Nein</option>";
                echo "<option value='1'>Ja</option>"; 
              }?>
            </select>   
            <div class="clear"></div>   

            <input type="submit" value="Speichern" id="saveButton" name="save" />

            <div class="clear"></div>       

          </form>
        </div>
         
        
      </div>
    </div>
      <div class="clear"></div> 
    </div>
  </div><?php endif;?>
    
  </div>
  
</body>
</html>