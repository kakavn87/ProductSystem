<?= $this->load->view('_template/public_header.html'); ?>

	<script type="text/javascript">
	    
	    function loaded() {
      	document.addEventListener('touchmove', function(e){ e.preventDefault(); });
      	myScroll = new iScroll('scroller');
      }
      document.addEventListener('DOMContentLoaded', loaded);
	    
      function editForm() {
        $('input').removeAttr("disabled");
        $('select').removeAttr("disabled");
        $('#editForm').css("display","none");
        $('#saveForm').css("display","block");
        
        $("#saveForm").click(function() {
          alert("Daten geändert.");
        });
        
      }  

      function toggle() {
        $('.toggle').toggle();
        $('#toggleClose').toggle();
        $('#toggle').toggle();
      }

      function removeItem(art_id, customer_id, art) {
        if (art == "attendant") {
          var bestaetigung = window.confirm('Wollen Sie die Person wirklich löschen?');
          if(bestaetigung) {
            document.location.href = '<?=base_url();?>customer/removeAttendant/'+art_id+'/'+customer_id;
          }
        }
        else if (art == "branch") {
          var bestaetigung = window.confirm('Wollen Sie die Branche wirklich löschen?');
          if(bestaetigung) {
            document.location.href = '<?=base_url();?>customer/removeBranch/'+art_id+'/'+customer_id;
          }
        }
        else if (art == "counterpart") {
          var bestaetigung = window.confirm('Wollen Sie den Ansprechpartner wirklich löschen?');
          if(bestaetigung) {
            document.location.href = '<?=base_url();?>customer/removeCounterpart/'+art_id+'/'+customer_id;
          }
        }
        else if (art == "group") {
          var bestaetigung = window.confirm('Wollen Sie das Etikett wirklich löschen?');
          if(bestaetigung) {
            document.location.href = '<?=base_url();?>customer/removeGroup/'+art_id+'/'+customer_id;
          }
        }
        else if (art == "notice") {
          var bestaetigung = window.confirm('Wollen Sie die Notiz wirklich löschen?');
          if(bestaetigung) {
            document.location.href = '<?=base_url();?>customer/removeNotice/'+art_id+'/'+customer_id;
          }
        }
      } 


      function setDelete(customer_id) {
        var bestaetigung = window.confirm('Wollen Sie das Unternehmen wirklich löschen?');
        if(bestaetigung) {
          document.location.href = '<?=base_url();?>customer/setDelete/'+customer_id;
        }
      } 

      $(document).ready(function() { 

        $(".newWindow").fancybox({
          'scrolling'   : 'no',
          'titleShow'   : false
          });

        if ( $(".addButtonTop").length > 0 ) {
          $("#scroller").css("margin-top","43px");
        }

        if($("#legal_person").val() == "1") {
          $("#counterpart").css("display","block");
        }
        else {
          $("#counterpart").css("display","none");
        }

         //////////////Unternehmen finden///////
    var sourceArr; //Source for Typeahead 
    $.ajax({url:'<?=base_url();?>search/customer',success:function(result){
    document.getElementById("outside").value = result;
    sourceArr = document.getElementById("outside").value;
    
    var substringMatcher = function(js) {
      return function findMatches(q, cb) {
        var matches, substringRegex;
        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        
        $.each(js, function(i, str) {
          if (substrRegex.test(str.name)) {
            // the typeahead jQuery plugin expects suggestions to a
            // JavaScript object, refer to typeahead docs for more info
            matches.push({ value: str.name, id: str.id, town: str.town});
          }
        });
        cb(matches);
      };
    };

$('#the-basics .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'products',
  displayKey: 'value',
  source: substringMatcher($.parseJSON(sourceArr)),
   /*templates: {
      empty: [
      '<div class="empty-message">',
      'unable to find any Best Picture winners that match the current query',
      '</div>'
      ].join('\n'),
      suggestion: Handlebars.compile('<p><strong>{{value}}</strong> – {{id}}</p>')
      }
    */  
  // alert(JSON.stringify(obj)); // object
  // outputs, e.g., {"type":"typeahead:selected","timeStamp":1371822938628,"jQuery19105037956037711017":true,"isTrigger":true,"namespace":"","namespace_re":null,"target":{"jQuery19105037956037711017":46},"delegateTarget":{"jQuery19105037956037711017":46},"currentTarget":
  //alert(JSON.stringify(datum)); // contains datum value, tokens and custom fields
  // outputs, e.g., {"redirect_url":"http://localhost/test/topic/test_topic","image_url":"http://localhost/test/upload/images/t_FWnYhhqd.jpg","description":"A test description","value":"A test value","tokens":["A","test","value"]}
  // in this case I created custom fields called 'redirect_url', 'image_url', 'description'   

  //alert(JSON.stringify(name)); // contains dataset name
  // outputs, e.g., "my_dataset"

}).bind('typeahead:selected', function(obj, datum,name) {
        //selectd element typeahead
       // alert("Selected: "+datum.id + "name " + datum.value );
        document.location.href = '<?=base_url();?>customer/show/' + datum.id;

    });
    }});//$.ajax

      }); 
      
	</script>
</head>

<body>

  <div id="wrapper">
   <div id="greyTop">
    <div id="innerWrapper">
    <div id="leftBox">
      <?$this->load->view('public/navigation',$navstate);?>

      <div id="the-basics">
      <input type="hidden" id="outside" value="">
      <input class="typeahead" type="text" placeholder="Unternehmen finden...">
      </div>
      <!--
      <div class="searchbox"> 
           
           
        <span>Suchbegriff:</span>
    
        <input type="text" class="searchword" id="searchword" value="" />
      </div>
      -->
      <div id="scroller" class="scrollerNav">
        <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
        <div class="addButtonTop"><a href="<?=base_url();?>customer/add"><span class="greenFont">+</span> Unternehmen hinzufügen</a></div>
        <?php endif;?>
        
        
          <ul id="navLeft">
           <?php foreach ($nav as $name) :?>
              <li onclick="document.location.href = '<?=base_url();?>customer/show/<?= $name->id; ?>'"><p><?= $name->name; ?><? if($name->town) { echo '<br/><span class="greenFont">Ort:</span> '.$name->town; } ?></p><span class="navArrow"></span>
              <div class="clear"></div></li>
           <?php endforeach; ?>
          </ul>
        
      </div>

    </div>
    
    <div id="rightBox">
      <div id="headTop">
        <h1>Kontaktdaten</h1>
        <div class="logout"><a href="<?=base_url();?>login/logout">&raquo; Logout</a></div>
        <div class="clear"></div>
      </div>
      
      <div id="content">

        <div class="grey">

        <h1><?= $formular->name; ?></h1>
        
        <div id="left">
          <form class="data" action="<?=base_url();?>customer/save/<?= $formular->id; ?>" method="post">
            <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
            <div style="float:left; cursor:pointer;" id="editForm" onclick="editForm()">Editieren</div>
            <?php endif;?>
            <input type="submit" value="Speichern" name="save" id="saveForm" />
            <div style="float:left; cursor:pointer;" id="toggle" onclick="toggle()">&raquo; Erweiterte Ansicht einblenden</div>
            <div style="float:left; cursor:pointer;" id="toggleClose" onclick="toggle()">&raquo; Erweiterte Ansicht ausblenden</div>
            <div class="clear"></div>
            <br/>
            <label class="user" for="company">Unternehmen:</label>
            <input type="text" id="company" name="company" disabled="disabled" value="<?= $formular->name; ?>">

            <label class="user" for="companyform">Form:</label>
            <select name="companyform" id="companyform" size="1" disabled="disabled">
               <option value='ka' <? if ($formular->companyform == 'ka' ) { echo "selected = selected"; } ?>>keine Angabe</option>
               <option value='ek' <? if ($formular->companyform == 'ek' ) { echo "selected = selected"; } ?>>Einzelunternehmen</option>
               <option value='ev' <? if ($formular->companyform == 'ev' ) { echo "selected = selected"; } ?>>e.V.</option>
               <option value='gmbh' <? if ($formular->companyform == 'gmbh' ) { echo "selected = selected"; } ?>>GmbH</option>
               <option value='ggmbh' <? if ($formular->companyform == 'ggmbh' ) { echo "selected = selected"; } ?>>gGmbH</option>
               <option value='ag' <? if ($formular->companyform == 'ag' ) { echo "selected = selected"; } ?>>AG</option>
               <option value='kg' <? if ($formular->companyform == 'kg' ) { echo "selected = selected"; } ?>>KG</option>
               <option value='ohg' <? if ($formular->companyform == 'ohg' ) { echo "selected = selected"; } ?>>OHG</option>
               <option value='gbr' <? if ($formular->companyform == 'gbr' ) { echo "selected = selected"; } ?>>GbR</option>
            </select>
            <div class="clear"></div>
<!--

            <label class="user" for="headquarter">Geschäftsführer:</label>
            <select name="headquarter" size="1" disabled="disabled">
              <?php // if ($formular->headquarter == '1') {
               // echo "<option value='1'>Ja</option>";
               // echo "<option value='0'>Nein</option>"; 
              // } else {
               // echo "<option value='0'>Nein</option>";
               // echo "<option value='1'>Ja</option>"; 
             // }?>
            </select>
            <div class="clear"></div> 

            <label class="user" for="gender">Anrede:</label>
            <select name="gender" size="1" disabled="disabled">
              <?php //if ($formular->contact_gender == 'Herr') {
                // echo "<option value='Herr'>Herr</option>";
               // echo "<option value='Frau'>Frau</option>"; 
             // } else {
                // echo "<option value='Frau'>Frau</option>";
                // echo "<option value='Herr'>Herr</option>"; 
             // }?>
            </select>
            <div class="clear"></div> 



            <label class="user" for="firstName">Vorname:</label>
            <input type="text" id="firstName" name="firstName" disabled="disabled" value="<?= $formular->contact_firstname; ?>">
            <div class="clear"></div> 
            
            <label class="user" for="lastName">Nachname:</label>
            <input type="text" id="lastName" name="lastName" disabled="disabled" value="<?= $formular->contact_lastname; ?>">
            <div class="clear"></div> 
--> 
       <!--      <label class="user" for="mobile">Mobil:</label>
            <input type="text" id="mobile" name="mobile" disabled="disabled"value="<?= $formular->contact_mobile; ?>">
            <div class="clear"></div>     -->    
           
            <label class="user" for="phone">Telefon:</label>
            <input type="text" id="phone" name="phone" disabled="disabled" value="<?= $formular->contact_phone; ?>">
            <div class="clear"></div>

            <label class="user" for="fax">Fax:</label>
            <input type="text" id="fax" name="fax" disabled="disabled" value="<?= $formular->contact_fax; ?>">
            <div class="clear"></div> 

            <label class="user" for="mail">E-Mail:</label>
            <input type="text" id="mail" name="mail" disabled="disabled" value="<?= $formular->contact_email; ?>">
            <div class="clear"></div> 

            <label class="user" for="firstcontact">Erstkontakt:</label>
            <input type="text" id="firstcontact" name="firstcontact" disabled="disabled" value="<?= $formular->firstcontact; ?>">
            <div class="clear"></div> 

            <label class="user" for="page">Homepage:</label>
            <input type="text" id="page" name="page" disabled="disabled" value="<?= $formular->page; ?>">
            <div class="clear"></div>    

            <label class="user" for="year">Gründungsjahr:</label>
            <input type="text" id="year" name="year" disabled="disabled" value="<?= $formular->year; ?>">
            <div class="clear"></div>    
            
<!--             <label class="user" for="reminder">Zuweisen:</label>
            <input type="text" id="reminder" name="reminder" disabled="disabled" value="">
            <div class="clear"></div>  -->

<!--             <label for="product">Datum auswählen:</label><br />
            <input type="text" name="datepicker" id="datepicker" /><br/><br/>
            <div class="clear"></div>  -->
<!--
           

            <label class="user" for="birth">Geburtsdatum:</label>
            <input type="text" id="birth" name="birth" disabled="disabled" value="<?= $formular->contact_birth; ?>">
            <div class="clear"></div> 
     -->
             <div class="toggle">



            <label class="user" for="streetNumber">Straße / Hsnr.:</label>
            <input type="text" id="street" name="street" disabled="disabled" value="<?= $formular->street; ?>">
            <div class="clear"></div>
            
            <label class="user" for="zipcodeCity">PLZ / Stadt:</label>
            <input type="text" id="zipcode" name="zipcode" disabled="disabled" value="<?= $formular->zip; ?>">
            <input type="text" id="town" name="town" disabled="disabled" value="<?= $formular->town; ?>">
            <div class="clear"></div>

            <label class="user" for="state">Bundesland:</label>
            <select name="state" disabled="disabled" id="state" size="1">
               <option value='ka' <? if ($formular->state == 'ka' ) { echo "selected = selected"; } ?>>keine Angabe</option>
               <option value='bw' <? if ($formular->state == 'bw' ) { echo "selected = selected"; } ?>>Baden-Württemberg</option>
               <option value='b' <? if ($formular->state == 'b' ) { echo "selected = selected"; } ?>>Bayern</option>
               <option value='bln' <? if ($formular->state == 'bln' ) { echo "selected = selected"; } ?>>Berlin</option>
               <option value='bb' <? if ($formular->state == 'bb' ) { echo "selected = selected"; } ?>>Brandenburg</option>
               <option value='br' <? if ($formular->state == 'br' ) { echo "selected = selected"; } ?>>Bremen</option>
               <option value='hh' <? if ($formular->state == 'hh' ) { echo "selected = selected"; } ?>>Hamburg</option>
               <option value='he' <? if ($formular->state == 'he' ) { echo "selected = selected"; } ?>>Hessen</option>
               <option value='mv' <? if ($formular->state == 'mv' ) { echo "selected = selected"; } ?>>Mecklenburg-Vorpommern</option>
               <option value='ni' <? if ($formular->state == 'ni' ) { echo "selected = selected"; } ?>>Niedersachen</option>
               <option value='nw' <? if ($formular->state == 'nw' ) { echo "selected = selected"; } ?>>Nordrhein-Westfalen</option>
               <option value='rp' <? if ($formular->state == 'rp' ) { echo "selected = selected"; } ?>>Rheinland-Pfalz</option>
               <option value='saa' <? if ($formular->state == 'saa' ) { echo "selected = selected"; } ?>>Saarland</option>
               <option value='sac' <? if ($formular->state == 'sac' ) { echo "selected = selected"; } ?>>Sachsen</option>
               <option value='saca' <? if ($formular->state == 'saca' ) { echo "selected = selected"; } ?>>Sachsen-Anhalt</option>
               <option value='sh' <? if ($formular->state == 'sh' ) { echo "selected = selected"; } ?>>Schleswig-Holstein</option>
               <option value='th' <? if ($formular->state == 'th' ) { echo "selected = selected"; } ?>>Thüringen</option>
            </select>
            <div class="clear"></div>
                                            
            <label class="user" for="country">Region:</label>
            <select name="country" id="country" size="1" disabled="disabled">
               <option value='ka' <? if($formular->country == 'ka') { echo  'selected = selected'; } ?>>keine Angabe</option>
               <option value='rg' <? if($formular->country == 'rg') { echo  'selected = selected'; } ?>>Ruhrgebiet</option>
               <option value='rh' <? if($formular->country == 'rh') { echo  'selected = selected'; } ?>>Rheinland</option>
               <option value='sl' <? if($formular->country == 'sl') { echo  'selected = selected'; } ?>>Sauerland</option>
               <option value='bl' <? if($formular->country == 'bl') { echo  'selected = selected'; } ?>>Bergisches Land</option>
               <option value='ml' <? if($formular->country == 'ml') { echo  'selected = selected'; } ?>>Münsterland</option>
               <option value='owl' <? if ($formular->country == 'owl' ) { echo "selected = selected"; } ?>>OWL</option>
               <option value='ndr' <? if ($formular->country == 'ndr' ) { echo "selected = selected"; } ?>>Niederrhein</option>
               <option value='so' <? if($formular->country == 'so') { echo  'selected = selected'; } ?>>sonstiges</option>
            </select>
            <div class="clear"></div>

   <!--
            <label class="user" for="international">International:</label>
            <select name="international" size="1" disabled="disabled">
              <?php // if ($formular->international == '1') {
              //  echo "<option value='1'>Ja</option>";
              //  echo "<option value='0'>Nein</option>"; 
              //}  else {
              //  echo "<option value='0'>Nein</option>";
              //  echo "<option value='1'>Ja</option>"; 
              // }?>
            </select>  -->        
            </div>

          </form>
        </div>
        
        <div id="right">



          <?php /*  Unternehmensbild - zurzeit nicht in Verwendung ?>
            <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
            <a class="newWindow" href="<?=base_url();?>upload/start/attendant/<?= $formular->id; ?>">
            <?php endif;?>
            <img src="<?=base_url();?>uploads/images/customer/<?php if(isset($formular->avatar)) { echo $formular->avatar; } else { echo "no_image.jpg"; } ?>" alt="UserBild" />
            <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
            </a>
            <?php endif;?>
            <div class="clear"></div>
          <?php Unternehemnsbild ende */ ?>

          <div class="bottomBox">
          <h1>Projekte</h1>
          <div class="innerBottomBox">
              <div id="scroller">
               <ul class="list">
               <?php foreach ($products as $prod) :?>
                 <li>
                  <a href="<?=base_url();?>attendant/show/<?=$prod->attendants_id;?>"><?= $prod->name; ?></a>
                </li>
                <?php endforeach; ?> 
               </ul>
              </div>
          </div>
         </div>
         <div class="clear"></div>


          <a class="newWindow" href="<?=base_url();?>notification/newMessage/customer/<?= $formular->id; ?>">
          <div class="greenBox">
             <img src="<?=base_url();?>css/images/mailIcon.png" alt="Mail" /><p>Nachricht senden</p>
             <div class="clear"></div>
          </div>
          </a>
          <?php if ($this->session->userdata('role') == "admin"): ?>
          <div class="greyBox" onclick="setDelete('<?= $formular->id; ?>')">
             <img src="<?=base_url();?>css/images/deleteIcon.png" alt="Löschen" /><p>Unternehmen löschen</p>
             <div class="clear"></div>
          </div>
          <?php endif;?>
          
        </div>
        
        <div class="clear"></div>
        
        </div>



          <div class="bottomBoxLarge">
          <h1>Notizen</h1>
          <div class="innerBottomBoxLarge">
              <div id="scroller">
                <ul class="list">
                <?php foreach ($notice as $note) :?>
                 <li>
                  <? echo $note->date.' - '.$note->short_name.' : '.$note->notice; ?>
                  <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
                  <a class="newWindow" href="<?=base_url();?>note/edit/<?= $note->id; ?>/customer/<?= $formular->id; ?>"><img src="<?=base_url();?>css/images/edit.png" alt="Edit" /></a>
                  <img onclick="removeItem('<?= $note->id; ?>','<?= $formular->id; ?>','notice');" src="<?=base_url();?>css/images/deleteIcon.png" alt="Löschen" />
                  <?php endif; ?>
                </li>
                <?php endforeach; ?> 
               </ul>
              </div>
          </div>
          <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
          <div class="addButton">
            <a class="newWindow" href="<?=base_url();?>note/aNew/attendant/0/customer/<?= $formular->id; ?>"><span class="greenFont">+</span> Notiz hinzufügen</a>
          </div>
          <?php endif;?>
        </div>
        
        <div class="clear"></div>

         <div class="bottomBox">
          <h1>Zugeordnete Personen</h1>
          <div class="innerBottomBox">
              <div id="scroller">
              <ul class="list">
               <?php foreach ($attendants as $attendant) :?>
                 <li>
                  <a href="<?=base_url();?>attendant/show/<?= $attendant->attendant_id; ?>"><? if($attendant->firstname == "" && $attendant->lastname == "" ) { echo "zur Person"; } else { echo $attendant->firstname; }?> <?= $attendant->lastname; ?></a> 
                  <?php if ($this->session->userdata('role') == "admin"): ?>
                    <img onclick="removeItem('<?= $attendant->attendant_id; ?>','<?= $formular->id; ?>','attendant');" src="<?=base_url();?>css/images/deleteIcon.png" alt="Löschen" />
                    <div class="clear"></div>
                  <?php endif;?>

                </li>
                <?php endforeach; ?> 
               </ul>
              </div> 
          </div>
          <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
          <div class="addButton">
                <a class="newWindow flLeft" href="<?=base_url();?>customer/bookNewAttendant/<?= $formular->id; ?>"><span class="greenFont">+</span> Hinzufügen</a>
                <a class="flRight" href="<?=base_url();?>attendant/add/<?= $formular->id; ?>"><span class="greenFont">+</span> Erstellen</a>
                <div class="clear"></div>
          </div>
          <?php endif;?>
        </div>

         <div class="bottomBox">
          <h1>Branchen</h1>
          <div class="innerBottomBox">
              <div id="scroller">
              <ul class="list">
               <?php foreach ($branchs as $branch) :?>
                <? if (!empty($branch->name)) { ?>
                 <li>
                  <a href="<?=base_url();?>branch/show/<?= $branch->id; ?>"><?= $branch->name; ?></a> 
                  <?php if ($this->session->userdata('role') == "admin"): ?>
                   <img onclick="removeItem('<?= $branch->id; ?>','<?= $formular->id; ?>','branch');" src="<?=base_url();?>css/images/deleteIcon.png" alt="Löschen" />
                  <?php endif;?>
                </li>
                <?php } ?>
                <?php endforeach; ?> 
               </ul>
              </div> 
          </div>
          <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
          <div class="addButton">
                <a class="newWindow flLeft" href="<?=base_url();?>customer/bookNewBranch/<?= $formular->id; ?>"><span class="greenFont">+</span> Branche hinzufügen</a>
                <div class="clear"></div>
          </div>
          <?php endif;?>
        </div>

      <div class="bottomBox">
          <h1>Zugeordnete Etiketten</h1>
          <div class="innerBottomBox">
              <div id="scroller">
               <ul class="list">
                <?php foreach ($groups as $group) :?>

                 <? if (!empty($group->name)) { ?>
                 <li>
                 <?= $group->name; ?>
                 <?php if ($this->session->userdata('role') == "admin"): ?>
                 <img onclick="removeItem('<?= $group->groups_id; ?>','<?= $formular->id; ?>','group');" src="<?=base_url();?>css/images/deleteIcon.png" alt="Löschen" />
                 <?php endif; ?>
                </li>
                <?php } ?>
                <?php endforeach; ?> 
               </ul>
              </div>
          </div>
          <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
          <div class="addButton">
            <a class="newWindow" href="<?=base_url();?>customer/bookNewGroup/<?= $formular->id; ?>"><span class="greenFont">+</span> Etikett hinzufügen</a>
          </div>
          <?php endif;?>
        </div>
        <div class="clear"></div>
    </div>
    
  </div>
      <div class="clear"></div>
     </div>
    </div>

</body>
</html>