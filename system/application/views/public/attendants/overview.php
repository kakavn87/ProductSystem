<?= $this->load->view('_template/public_header.html'); ?>

	<script type="text/javascript">
	    
	    function loaded() {
      	document.addEventListener('touchmove', function(e){ e.preventDefault(); });
      	myScroll = new iScroll('scroller');
      }
      document.addEventListener('DOMContentLoaded', loaded)
	    
      function editForm(name) {
        $('#'+name+' input').removeAttr("disabled");
        $('#'+name+' select').removeAttr("disabled");
        $('#edit'+name+'Form').css("display","none");
        $('#save'+name+'Form').css("display","block");
        
        $('#savedataForm').click(function() {
          alert("Daten geändert.");
        }); 
      }   

      function removeItem(art_id, attendant_id, art) {

        if (art == "group") {
          var bestaetigung = window.confirm('Wollen Sie das Etikett wirklich löschen?');
          if(bestaetigung) {
            document.location.href = '<?=base_url();?>attendant/removeGroup/'+art_id+'/'+attendant_id;
          }
        }
        else if (art == "customer") {
          var bestaetigung = window.confirm('Wollen Sie das zugeordnete Unternehmen wirklich löschen?');
          if(bestaetigung) {
            document.location.href = '<?=base_url();?>attendant/removeCustomer/'+art_id+'/'+attendant_id;
          }
        }
        else if (art == "notice") {
          var bestaetigung = window.confirm('Wollen Sie die Notiz wirklich löschen?');
          if(bestaetigung) {
            document.location.href = '<?=base_url();?>attendant/removeNotice/'+art_id+'/'+attendant_id;
          }
        }
        else if (art == "product") {
          var bestaetigung = window.confirm('Wollen Sie das belegte Projekt wirklich löschen?');
          if(bestaetigung) {
            document.location.href = '<?=base_url();?>attendant/removeProduct/'+art_id+'/'+attendant_id;
          }
        }

      }

      function setDelete(attendant_id) {
        var bestaetigung = window.confirm('Wollen Sie die Person wirklich löschen?');
        if(bestaetigung) {
          document.location.href = '<?=base_url();?>attendant/setDelete/'+attendant_id;
        }
      } 

      $(document).ready(function() { 

        //CSS Edit Notizen:
        $("div.innerBottomBoxLarge").find("a").attr("target","_blank");


        $(".newWindow").fancybox({
          'scrolling'   : 'no',
          'titleShow'   : false
          });

        if ( $(".addButtonTop").length > 0 ) {
          $("#scroller").css("margin-top","43px");
        }

        $("#datepicker").datepicker(
          {dateFormat: 'dd.mm.yy'}
        );

        $("form#reminder").submit(function() {
          if($(".reminderdate").val() == "" && $(".user_id").val() == "0") {
            alert("Bitte Wiedervorlage Datum und zuständigen Mitarbeiter angeben.");
            return false;
          } else if ($(".reminderdate").val() == "") {
            alert("Bitte Wiedervorlage Datum angeben.");
            return false;
          } else if($(".user_id").val() == "0"){
            alert("Bitte zuständigen Mitarbeiter angeben.");
            return false;
          } else {
            alert("Daten geändert.");
            return true;
          }
        });

        //////////////
    var sourceArr;
    $.ajax({url:'<?=base_url();?>search/attendant',success:function(result){
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
          if (substrRegex.test(str.lastname) || substrRegex.test(str.firstname)) {
            // the typeahead jQuery plugin expects suggestions to a
            // JavaScript object, refer to typeahead docs for more info
            matches.push({ value: str.firstname +" "+str.lastname , id: str.id});
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
        document.location.href = '<?=base_url();?>attendant/show/' + datum.id;
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
      <input class="typeahead" type="text" placeholder="Person finden...">
      </div>
          
        <div id="scroller" class="scrollerNav">
          <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
      <div class="addButtonTop"><a href="<?=base_url();?>attendant/add"><span class="greenFont">+</span> Person hinzufügen</a></div>
      <?php endif; ?>
             <ul id="navLeft">
         <?php foreach ($nav as $name) :?>
           <li onclick="document.location.href = '<?=base_url();?>attendant/show/<?= $name->id; ?>'"><p><?= $name->firstname; ?> <?= $name->lastname; ?></p><span class="navArrow"></span>
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
                
        <h1><?= $formular->firstname; ?> <?= $formular->lastname; ?></h1>
        <div id="left">
          <form class="data" id="data" action="<?=base_url();?>attendant/save/<?= $formular->id; ?>" method="post">

            <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
            <div style="float:left; cursor:pointer;" id="editdataForm" class="editForm" onclick="editForm('data')">&raquo; Editieren</div>
            <input type="submit" value="Speichern" name="save" class="saveForm" id="savedataForm" />
            <div class="clear"></div>
            <?php endif; ?>

            <label class="user" for="title">Titel:</label>
            <input type="text" id="title" name="title" disabled="disabled" value="<? if($formular->title == '0') { echo ''; } else { echo $formular->title; }?>">
            <div class="clear"></div> 

            <label class="user" for="title">Anrede:</label>
            <select name="gender" size="1" disabled="disabled">
                <option <?if ($formular->gender == 'Herr') { echo "selected=selected"; } ?>>Herr</option>
                <option <?if ($formular->gender == 'Frau') { echo "selected=selected"; } ?>>Frau</option>
                <option <?if ($formular->gender == 'An die Geschäftsführung') { echo "selected=selected"; } ?>>An die Geschäftsführung</option>
            </select>
            <div class="clear"></div> 

            <label class="user" for="firstName">Vorname:</label>
            <input type="text" id="firstName" name="firstName" disabled="disabled" value="<?= $formular->firstname; ?>">
            <div class="clear"></div> 
            
            <label class="user" for="lastName">Nachname:</label>
            <input type="text" id="lastName" name="lastName" disabled="disabled" value="<?= $formular->lastname; ?>">
            <div class="clear"></div> 

            <label class="user" for="birth">Geburtsdatum:</label>
            <input type="text" id="birth" name="birth" disabled="disabled" value="<?= $formular->birth; ?>">
            <div class="clear"></div> 

            <label class="user" for="additional_adress">Adresszusatz:</label>
            <input type="text" id="additional_adress" name="additional_adress" disabled="disabled" value="<?= $formular->additional_adress; ?>">
            <div class="clear"></div> 
            
            <label class="user" for="streetNumber">Straße / Hsnr.:</label>
            <input type="text" id="street" name="street" disabled="disabled" value="<?= $formular->street; ?>">
            <div class="clear"></div>
            
            <label class="user" for="zipcodeCity">PLZ / Stadt:</label>
            <input type="text" id="zipcode" name="zipcode" disabled="disabled" value="<?= $formular->plz; ?>">
            <input type="text" id="town" name="town" disabled="disabled" value="<?= $formular->town; ?>">
            <div class="clear"></div>

            <label class="user" for="">Funktion:</label>
            <input type="text" id="function" name="function" disabled="disabled" value="<?= $formular->function; ?>">
            <div class="clear"></div>
                              
            <label class="user" for="mobile">Mobil:</label>
            <input type="text" id="mobile" name="mobile" disabled="disabled"value="<?= $formular->mobile; ?>">
            <div class="clear"></div>        

            <label class="user" for="phone">Telefon:</label>
            <input type="text" id="phone" name="phone" disabled="disabled" value="<?= $formular->phone; ?>">
            <div class="clear"></div>

            <label class="user" for="fax">Fax:</label>
            <input type="text" id="fax" name="fax" disabled="disabled" value="<?= $formular->fax; ?>">
            <div class="clear"></div>

            <label class="user" for="mail">E-Mail:</label>
            <input type="text" id="mail" name="mail" disabled="disabled" value="<?= $formular->email; ?>">
            <div class="clear"></div>

          </form>
        </div>
        
        <div id="right">

          <a class="newWindow" href="<?=base_url();?>notification/newMessage/attendant/<?= $formular->id; ?>">
          <div class="greenBox">
             <img src="<?=base_url();?>css/images/mailIcon.png" alt="Mail" /><p>Nachricht senden</p>
             <div class="clear"></div>
          </div>
          </a>
          <?php if ($this->session->userdata('role') == "admin"): ?>
          <div class="greyBox" onclick="setDelete('<?= $formular->id; ?>')">
             <img src="<?=base_url();?>css/images/deleteIcon.png" alt="Löschen" /><p>Person löschen</p>
             <div class="clear"></div>
          </div>
          <?php endif; ?>
        </div>
        <div class="clear"></div>

      </div>

       <div class="bottomBoxLarge bottomBoxReminder">
          <h1>Wiedervorlage</h1>
          <form id="reminder" class="data" action="<?=base_url();?>reminder/save/<?= $formular->id; ?>" method="post">
            <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
            <div style="float:left; cursor:pointer;" class="editForm" id="editreminderForm" onclick="editForm('reminder')">&raquo; Editieren</div>
            <input type="submit" value="Speichern" class="saveForm" name="reminderSave" id="savereminderForm" />
            <div class="clear"></div>
            <?php endif; ?>

            <label class="user" for="reminderdate">Wiedervorlage:</label>
            <input type="text" class="reminderdate" name="reminderdate" id="datepicker" disabled="disabled" value="<?= $reminderdate; ?>" />
            <div class="clear"></div>                

            <label class="user" for="user_id">Mitarbeiter intern:</label> 
            <select name="user_id" class="user_id" size="1" disabled="disabled">
              <option value="0">keiner</option>
              <?php foreach ($mintern as $mintern) :?>
                <option <?if ($user_id == $mintern->id) { echo 'selected=selected'; } ?> value="<?=$mintern->id;?>"><?=$mintern->name;?></option>
              <?php endforeach; ?>
            </select>
            <div class="clear"></div>

            <label class="user" for="priority">Priorität:</label>
            <input type="text" class="reminderdate" name="priority" disabled="disabled" value="<?= $priority; ?>" />
            <div class="clear"></div>     
       </div>


          <div class="bottomBoxLarge">
          <h1>Notizen</h1>
          <div class="innerBottomBoxLarge">
              <div id="scroller">
                <ul class="list">
                
                <?php  foreach ($notice as $note) :?>

                 <li>
                   <a class="newWindow" href="<?=base_url();?>note/edit/<?= $note->id; ?>/customer/0"><img src="<?=base_url();?>css/images/edit.png" alt="Editieren" /></a>
                  
                  <? echo $note->date.' - '.$note->short_name.' : '.$note->notice; ?>
                
                  <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
                 
                  <img onclick="removeItem('<?= $note->id; ?>','<?= $formular->id; ?>','notice');" src="<?=base_url();?>css/images/deleteIcon.png" alt="Löschen" />
                  <?php endif; ?>
                </li>
                <?php endforeach; ?> 
               </ul>
              </div>
          </div>
          <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
          <div class="addButton">
            <a class="newWindow" href="<?=base_url();?>note/anew/attendant/<?= $formular->id; ?>/customer/0"><span class="greenFont">+</span> Notiz hinzufügen</a>
          </div>
          <?php endif;?>
        </div>
        
        <div class="bottomBox">
          <h1>Belegte Projekte</h1>
          <div class="innerBottomBox">
              <div id="scroller">
               <ul class="list">
               <?php foreach ($products as $prod) :?>
                <? if (!empty($prod->name)): ?>
                 <li>
                  <a href="<?=base_url();?>product/show/<?= $prod->product_id; ?>"> <? if($prod->date == '00.00.0000') { echo 'Datum offen - '; } else { echo $prod->date; } ?> <?= $prod->name; ?></a>
                  <?php if ($this->session->userdata('role') == "admin"): ?>
                    <a class="newWindow" href="<?=base_url();?>attendant/editBookedProduct/<?= $formular->id; ?>/<?= $prod->product_id; ?>"><img src="<?=base_url();?>css/images/edit.png" alt="Editieren" /></a><br/>
                   <img onclick="removeItem('<?= $prod->ap_id; ?>','<?= $formular->id; ?>','product');" src="<?=base_url();?>css/images/deleteIcon.png" alt="Löschen" />
                  <?php endif; ?>
                </li>
                <?php endif; ?>
                <?php endforeach; ?> 
               </ul>
              </div>
          </div>
          <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
          <div class="addButton">
             <a class="newWindow" href="<?=base_url();?>attendant/bookNewProduct/<?= $formular->id; ?>"><span class="greenFont">+</span> Projekt hinzufügen</a>
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
            <a class="newWindow" href="<?=base_url();?>attendant/bookNewGroup/<?= $formular->id; ?>"><span class="greenFont">+</span> Etikett hinzufügen</a>
          </div>
          <?php endif;?>
        </div>

        <div class="bottomBox">
          <h1>Zug. Unternehmen</h1>
          <div class="innerBottomBox">
              <div id="scroller">
               <ul class="list">
                <?php foreach ($customers as $customer) :?>
                 <? if (!empty($customer->name)) { ?>
                 <li>
                 <a href="<?=base_url();?>customer/show/<?= $customer->customer_id; ?>"><?= $customer->name; ?></a>
                 <?php if ($this->session->userdata('role') == "admin"): ?>
                 <img onclick="removeItem('<?= $customer->customer_id; ?>','<?= $formular->id; ?>','customer');" src="<?=base_url();?>css/images/deleteIcon.png" alt="Löschen" />
                 <?php endif; ?>
                </li>
                <?php } ?>
                <?php endforeach; ?> 
               </ul>
              </div>
          </div>
          <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
          <div class="addButton">
            <a class="newWindow" href="<?=base_url();?>attendant/bookNewCustomer/<?= $formular->id; ?>"><span class="greenFont">+</span> Unternehmen hinzufügen</a>
          </div>
          <?php endif;?>
        </div>
        
        <div class="clear"></div>        
        
      </div>
    </div>
    
    <div class="clear"></div>
    
    
    </div>
  </div>
</div>

</body>
</html>