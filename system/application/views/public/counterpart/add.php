     <form class="data" action="<?=base_url();?>customer/addCounterpart/customer/<?= $customer;?>" method="post">


            <label class="user" for="firstName">Vorname:</label>
            <input type="text" id="firstName" name="firstName">
            <div class="clear"></div> 
            
            <label class="user" for="lastName">Nachname:</label>
            <input type="text" id="lastName" name="lastName">
            <div class="clear"></div> 

            <label class="user" for="mobile">Mobil:</label>
            <input type="text" id="mobile" name="mobile">
            <div class="clear"></div>        
            
            <label class="user" for="phone">Telefon:</label>
            <input type="text" id="phone" name="phone">
            <div class="clear"></div>

            <label class="user" for="mail">E-Mail:</label>
            <input type="text" id="mail" name="mail">
            <div class="clear"></div> 

            <label class="user" for="comment">Kommentar:</label><br/>
            <textarea id="comment" name="comment"></textarea>
            <div class="clear"></div> 

      <div class="clear"></div> 

            <input type="submit" value="Speichern" id="saveButton" name="save" />
            <div class="clear"></div>       

          </form>