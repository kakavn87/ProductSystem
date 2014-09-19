<!DOCTYPE html>
<?= $this->load->view('_template/public_header.html'); ?>

</head>
<body>
  
  <div id="wrapper">
   <div id="greyTop">
    <div id="innerWrapper">
    <div id="leftBox">
      <?$this->load->view('public/navigation',$navstate);?>
    </div>
    <div id="rightBox">
      <div id="headTop">
        <h1>Neue Person hinzufügen</h1>
        <div class="logout"><a href="<?=base_url();?>login/logout">&raquo; Logout</a></div>
        <div class="clear"></div>
      </div>     
      
      <div id="content">
        
        <div id="left">
          <form class="data" action="<?=base_url();?>attendant/add" method="post">

            <label class="user" for="title">Titel:</label>
            <input type="text" id="title" name="titel" value="">
            <div class="clear"></div> 
            
            <label class="user" for="gender">Anrede:</label>
            <select name="gender" size="1">
              <option value="Herr">Herr</option>
              <option value="Frau">Frau</option>
            </select>
            <div class="clear"></div> 

            <label class="user" for="firstName">Vorname:</label>
            <input type="text" id="firstName" name="firstName" value="">
            <div class="clear"></div> 
            
            <label class="user" for="lastName">Nachname:</label>
            <input type="text" id="lastName" name="lastName" value="">
            <div class="clear"></div> 

            <label class="user" for="birth">Geburtsdatum:</label>
            <input type="text" id="birth" name="birth" value="">
            <div class="clear"></div> 

            <label class="user" for="additional_adress">Adresszusatz:</label>
            <input type="text" id="additional_adress" name="additional_adress" value="">
            <div class="clear"></div>
            
            <label class="user" for="streetNumber">Straße / Hsnr.:</label>
            <input type="text" id="street" name="street" value="<? echo  $this->session->userdata('street'); ?>">
            <div class="clear"></div>
            
            <label class="user" for="zipcodeCity">PLZ / Stadt:</label>
            <input type="text" id="zipcode" name="zipcode" value="<? echo $this->session->userdata('zipcode'); ?>">
            <input type="text" id="town" name="town" value="<? echo  $this->session->userdata('town'); ?>">
            <div class="clear"></div>

            <label class="user" for="phone">Funktion:</label>
            <input type="text" id="phone" name="function" value="<? echo  $this->session->userdata('function'); ?>">
            <div class="clear"></div>
                              
            <label class="user" for="mobile">Mobil:</label>
            <input type="text" id="mobile" name="mobile" value="<? echo $this->session->userdata('mobile'); ?>">
            <div class="clear"></div>        
            
            <label class="user" for="phone">Telefon:</label>
            <input type="text" id="phone" name="phone" value="<? echo  $this->session->userdata('phone'); ?>">
            <div class="clear"></div>

            <label class="user" for="fax">Fax:</label>
            <input type="text" id="fax" name="fax" value="<? echo  $this->session->userdata('fax'); ?>">
            <div class="clear"></div>

            <label class="user" for="mail">E-Mail:</label>
            <input type="text" id="mail" name="mail" value="<? echo  $this->session->userdata('mail'); ?>">
            <div class="clear"></div>

            <label class="user" for="group">Etikett:</label>
            <select class="groupChoose" name="group[]" size="5" multiple>
                <option value="NULL">keine</option>
              <?php foreach ($groups as $group) :?>
                <option value="<?=$group->id;?>"><?=$group->name;?></option>
              <?php endforeach; ?>
            </select>
            <div class="clear"></div>


            <label class="user" for="customer">Unternehmen auswählen:</label>
            <select name="customer" size="1">
                  <option selected="selected" value="0">kein Unternehmen</option>
              <?php foreach ($customers as $customer) :?>
                  <? if ($customer->id == $customer_id || $this->session->userdata('company') == $customer->name) { $selected = "selected=selected"; } else { $selected = ""; } ?>
                  <option <?=$selected;?> value="<?=$customer->id;?>"><?=$customer->name;?></option>
              <?php endforeach; ?>
            </select>
            <div class="clear"></div>

            <input type="submit" value="Erstellen" id="saveButton" name="save" />
            <div class="clear"></div>
                        
          </form>
        </div>
        
      </div>

    </div>
    

        <div class="clear"></div>
   </div>
    
   </div>
    
  </div>
  
</body>
</html>