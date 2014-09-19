<?= $this->load->view('_template/public_header.html'); ?>

	<script type="text/javascript">
	    
      function editForm() {
        $('input').removeAttr("disabled");
        $('select').removeAttr("disabled");
        $('textarea').removeAttr("disabled");
        $('#editForm').css("display","none");
        $('#saveForm').css("display","block");
        
        //Set Feedback form disable:
        $('#weiter').prop("disabled",true);
        $(':input[name=conten]').prop("disabled",true);
        $(':input[name=chkgekommen]').prop("disabled",true);
        $(':input[name=layout]').prop("disabled",true);
        $(':input[name=performance]').prop("disabled",true);
        $(':input[name=price]').prop("disabled",true);
        $(':input[name=care]').prop("disabled",true);
        $(':input[name=frendly]').prop("disabled",true);
        $(':input[name=completion]').prop("disabled",true);
        $(':input[name=profess]').prop("disabled",true);
        $(':input[name=optimization]').prop("disabled",true);
        $(':input[name=continue]').prop("disabled",true);
        $(':input[name=comment]').prop("disabled",true);
        $(':input[name=txtgekommen]').prop("disabled",true);
         $(':input[name=begruendung]').prop("disabled",true);
        

        $("#saveForm").click(function() {
          alert("Daten geändert.");
        });
        
      }

      function editFormFeedback() {
        $('#weiter').removeAttr("disabled");
        $(':input[name=conten]').removeAttr("disabled");
        $(':input[name=chkgekommen]').removeAttr("disabled");
        $(':input[name=layout]').removeAttr("disabled");
        $(':input[name=performance]').removeAttr("disabled");
        $(':input[name=price]').removeAttr("disabled");
        $(':input[name=care]').removeAttr("disabled");
        $(':input[name=frendly]').removeAttr("disabled");
        $(':input[name=completion]').removeAttr("disabled");
        $(':input[name=profess]').removeAttr("disabled");
        $(':input[name=optimization]').removeAttr("disabled");
        $(':input[name=continue]').removeAttr("disabled");
        $(':input[name=comment]').removeAttr("disabled");
        $(':input[name=txtgekommen]').removeAttr("disabled");
        $(':input[name=begruendung]').removeAttr("disabled");
        
        
        //$('form#frmBefragung :select').removeAttr("disabled");
        //$('form#frmBefragung :textarea').removeAttr("disabled");

        $('#editFormFeedback').css("display","none");
        $('#saveFeedback').css("display","block");
      
        
        $("#saveFeedback").click(function() {
          alert("Daten geändert.");
        });
        
      }   

      function setDelete(product_id) {
        var bestaetigung = window.confirm('Wollen Sie das Projekt wirklich löschen?');
        if(bestaetigung) {
          document.location.href = '<?=base_url();?>product/setDelete/'+product_id;
        }
      } 

      $(document).ready(function() { 
        
        if ( $(".addButtonTop").length > 0 ) {
          $("#scroller").css("margin-top","43px");
        }     
     
        
      //////////////Produkt finden////////////
    var sourceArr;
    $.ajax({url:'<?=base_url();?>search/product',success:function(result){
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
          if (substrRegex.test(str.name + str.label)) {
            // the typeahead jQuery plugin expects suggestions to a
            // JavaScript object, refer to typeahead docs for more info
            matches.push({ value: str.name +" <br/> "+ str.label, id: str.id, labels: str.label});
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
   //templates:"'<p><strong>{{value}}</strong> <br />  {{labels}}</p>'"
     
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
        document.location.href = '<?=base_url();?>product/show/' + datum.id;

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
      <?$this->load->view('public/navigation',$navstate); ?>

      
      <div id="the-basics">
      <input type="hidden" id="outside" value="">
      <input class="typeahead" type="text" placeholder="Projekt finden...">
      </div>
      
        <div id="scroller" class="scrollerNav">
          <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
          <div class="addButtonTop"><a href="<?=base_url();?>product/add"><span class="greenFont">+</span> Projekt hinzufügen</a></div>
          <?php endif; ?>
            <ul id="navLeft">
              <?php foreach ($nav as $name) :?>
                <li onclick="document.location.href = '<?=base_url();?>product/show/<?= $name->id; ?>'"><p><?= $name->name; ?><? if($name->label) { echo '<br/><span class="greenFont">Kennung:</span> '.$name->label; } ?></p><span class="navArrow"></span>
                <div class="clear"></div></li>
              <?php endforeach; ?>
            </ul>
        </div>
     

    </div>
   
    
    <div id="rightBox">
      <div id="headTop">
        <h1>Projektdaten</h1>
        <div class="logout"><a href="<?=base_url();?>login/logout">&raquo; Logout</a></div>
        <div class="clear"></div>
      </div>
       
      <div id="content">
        <div class="grey">
        <h1><? if(isset($formular->name)) { echo $formular->name; } ?></h1>
        
        <div id="left">
          <form class="data" action="<?=base_url();?>product/save/<? if(isset($formular->id)) { echo $formular->id; } ?>" method="post">
            
            <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
            <div style="float:left; cursor:pointer; margin-bottom:20px;" id="editForm" onclick="editForm()">&raquo; Editieren</div>
            <input type="submit" value="Speichern" name="save" id="saveForm" />
            <div class="clear"></div>
            <?php endif;?>
            <label class="user" for="productname">Projektname:</label>
            <input type="text" id="productname" name="productname" disabled="disabled" value="<? if(isset($formular->name)) { echo $formular->name; } ?>">
            <div class="clear"></div> 

            <label class="user" for="categories">Projektkategorie:</label>
            <select disabled="disabled" name="categories" size="1">
              <option value="0">keine</option>
              <?php foreach ($categories as $category): ?>
                <option <? if ($formular->category_id == $category->id)  echo 'selected'; ?> value="<?=$category->id;?>"><?=$category->name;?></option>
              <?php endforeach;?>
            </select>

            <label class="user" for="label">Kennung:</label>
            <input type="text" id="label" name="label" disabled="disabled" value="<?= $formular->label; ?>">
            <div class="clear"></div> 

            <label class="user" for="productname">Beschreibung:</label>
            <textarea class="productdescription" disabled="disabled" name="description"><? if(isset($formular->description)) { echo $formular->description; } ?></textarea>
            
            <label class="user" for="attendance">Teilnehmer:</label>
            <input type="text" id="attendance" name="attendance" disabled="disabled" value="<? if(isset($formular->attendance)) { echo $formular->attendance; } ?>">
            <div class="clear"></div> 
            
            <label class="user" for="trainername">Koordinator:</label>
            <select disabled="disabled" name="trainername" size="1">
              <?php foreach ($trainers as $trainer): ?>
                <option <? if ($formular->trainer_id == $trainer->trainer_id)  echo 'selected'; ?> value="<?=$trainer->trainer_id;?>"><?=$trainer->firstname;?> <?=$trainer->lastname;?></option>
              <?php endforeach;?>
            </select>

            <label class="user" for="status">Status:</label>
            <select name="status" id="status" size="1" disabled="disabled">
               <option value="0" <? if($formular->status == '0') { echo 'selected=selected'; } ?>>keine Angabe</option>
               <option value="1" <? if($formular->status == '1') { echo 'selected=selected'; } ?>>offen</option>
               <option value="2" <? if($formular->status == '2') { echo 'selected=selected'; } ?>>zugesagt</option>
               <option value="3" <? if($formular->status == '3') { echo 'selected=selected'; } ?>>abgesagt</option>
            </select>
            <div class="clear"></div>

            <label class="user" for="costs">Unternehmen:</label><br/>
            <div class="customers">
            
            <?if ($customers != 'keine') { ?>
            <?php foreach ($customers as $customer): ?>
                <a href="<?=base_url();?>customer/show/<?= $customer[0]->id; ?>"><?= $customer[0]->name; ?></a><br/>
            <?php endforeach;?>
            <? } ?>
            </div>
            <div class="clear"></div>
          </form>

          <?php if ($this->session->userdata('role') == "admin"): ?>
          <div class="greyBox" onclick="setDelete('<? if(isset($formular->id)) { echo $formular->id; } ?>')">
           <img src="<?=base_url();?>css/images/deleteIcon.png" alt="Löschen" /><p>Projekt löschen</p>
           <div class="clear"></div>
          </div>
          <?php endif;
            
          ?>
          
             
        </div>

        <div class="clear"></div><br/>
        <?
          if($befragunglist == null )
            //print_r($befragunglist);
            echo '<div  ><input type="button" id="feedback" class="active" value="Feedback"></div>';
           ?>   
          
        
      </div>      
    </div>

    <!--//=============================Befragungsbogen======================================-->
    <div id="content" class="feedback">
      <div class="grey">
          <form>
            <p>
              <input type="radio" name="rfeedback" value="Zusage" id="rzusage" > Zusage
              <input type="radio" name="rfeedback" value="Absage" id="rabsage" > Absage
            </p>  
          </form>    
      </div>
    </div>  
    <div id="content" class="divfeedback">
      <div class="grey">    
        <form class="data" action="<?=base_url();?>befragung/add/<?=$formular->id;?>" method="post" id="frmBefragung">        
            <table border="0">
              <tr>
                <td>
                <!--Linke Spalte-->
                  <tr>
                    <td>
                          <tr id="trZusage">
                             <td colspan="7"><h1>Zusage</h1></td>
                              
                          </tr>
         
                          <tr class="trAbsage">
                            <td colspan="7"><h1>Absage</h1></td>
                            
                          </tr>
                          <tr class="trAbsage"> 
                               <td class="textarea"><label class="user" >Begründung</label></td>  
                              <td colspan="6" class="textarea"> <textarea name="begruendung" cols="50" rows="3"></textarea></td>   
                          </tr>                        
                    </td>                    
                  </tr>
                      
                  <tr>
                        <td colspan="7"><label class="user" >Wie sind Sie auf uns gekommen?</label></td> 
                  </tr>
                  <tr class="tab"> 
                        <td>Internet</td>       
                        <td colspan="6"> <input type="radio" id="chkgekommen" name="chkgekommen" value="Internet"></td>   
                  </tr>
                  <tr class="tab"> 
                        <td>Akquise</td>       
                        <td colspan="6"> <input type="radio" id="chkgekommen" name="chkgekommen" value="Akquise"></td>   
                  </tr>
                  <tr class="tab"> 
                        <td>Newsletter</td>       
                        <td colspan="6"> <input type="radio" id="chkgekommen" name="chkgekommen" value="Newsletter"></td>   
                  </tr>
                  <tr class="tab"> 
                        <td>Empfehlung</td>       
                        <td colspan="6"> <input type="radio" id="chkgekommen" name="chkgekommen" value="Empfehlung"></td>   
                  </tr>
                  <tr class="tab"> 
                        <td>Stammkunde</td>       
                        <td colspan="6"> <input type="radio" id="chkgekommen" name="chkgekommen" value="Stammkunde"></td>   
                  </tr>
                  <tr class="tab"> 
                        <td>sonstiges, </td>       
                        <td colspan="6"> <input type="text" id="txtgekommen" name="txtgekommen" value="" size="50" onselect="textselect();"></td>   
                  </tr>
                  
                  <tr class="tab" >
                    <td></td>
                    <td>&nbsp; 1</td>
                    <td>&nbsp; 2</td>
                    <td>&nbsp; 3</td>
                    <td>&nbsp; 4</td>
                    <td>&nbsp; 5</td>
                    <td>&nbsp; 6</td>
                  </tr>
                  <tr>
                    <td colspan="7"><label class="user" >Zufriedenheit mit dem Angebot</label></td>
                  </tr>
                  <tr class="tab">
                    <td>Inhalt / Kreativität</td>
                    <td><input type="radio" name="conten" value="1"></td>
                    <td><input type="radio" name="conten" value="2"></td>
                    <td><input type="radio" name="conten" value="3"></td>
                    <td><input type="radio" name="conten" value="4"></td>
                    <td><input type="radio" name="conten" value="5"></td>
                    <td> <input type="radio" name="conten" value="6"></td>
                  </tr>
                  <tr class="tab">
                    <td>Optik / Layout</td>
                    <td><input type="radio" name="layout" value="1"></td>
                    <td><input type="radio" name="layout" value="2"></td>
                    <td><input type="radio" name="layout" value="3"></td>
                    <td><input type="radio" name="layout" value="4"></td>
                    <td><input type="radio" name="layout" value="5"></td>
                    <td> <input type="radio" name="layout" value="6"></td>
                  </tr>
                  <tr class="tab">
                    <td>Preise</td>
                    <td><input type="radio" name="price" value="1"></td>
                    <td><input type="radio" name="price" value="2"></td>
                    <td><input type="radio" name="price" value="3"></td>
                    <td><input type="radio" name="price" value="4"></td>
                    <td><input type="radio" name="price" value="5"></td>
                    <td> <input type="radio" name="price" value="6"></td>
                  </tr>
                  <tr class="tab">
                    <td>Performance / Schnelligkeit</td>
                    <td><input type="radio" name="performance" value="1"></td>
                    <td><input type="radio" name="performance" value="2"></td>
                    <td><input type="radio" name="performance" value="3"></td>
                    <td><input type="radio" name="performance" value="4"></td>
                    <td><input type="radio" name="performance" value="5"></td>
                    <td> <input type="radio" name="performance" value="6"></td>
                  </tr>
                  <tr class="tab">
                    <td>Betreuung durch SR</td>
                    <td><input type="radio" name="care" value="1"></td>
                    <td><input type="radio" name="care" value="2"></td>
                    <td><input type="radio" name="care" value="3"></td>
                    <td><input type="radio" name="care" value="4"></td>
                    <td><input type="radio" name="care" value="5"></td>
                    <td> <input type="radio" name="care" value="6"></td>
                  </tr>
                 
                   <tr>
                    <td colspan="7"><label class="user" >Zufriedenheit mit Dienstleister</label></td>
                  </tr>
                  <tr class="tab">
                    <td>Freundlichkeit</td>
                    <td><input type="radio" name="frendly" value="1"></td>
                    <td><input type="radio" name="frendly" value="2"></td>
                    <td><input type="radio" name="frendly" value="3"></td>
                    <td><input type="radio" name="frendly" value="4"></td>
                    <td><input type="radio" name="frendly" value="5"></td>
                    <td> <input type="radio" name="frendly" value="6"></td>
                  </tr>
                  <tr class="tab">
                    <td>Abwicklung</td>
                    <td><input type="radio" name="completion" value="1"></td>
                    <td><input type="radio" name="completion" value="2"></td>
                    <td><input type="radio" name="completion" value="3"></td>
                    <td><input type="radio" name="completion" value="4"></td>
                    <td><input type="radio" name="completion" value="5"></td>
                    <td> <input type="radio" name="completion" value="6"></td>
                  </tr>
                  <tr class="tab">
                    <td>Professionalität</td>
                    <td><input type="radio" name="profess" value="1"></td>
                    <td><input type="radio" name="profess" value="2"></td>
                    <td><input type="radio" name="profess" value="3"></td>
                    <td><input type="radio" name="profess" value="4"></td>
                    <td><input type="radio" name="profess" value="5"></td>
                    <td> <input type="radio" name="profess" value="6"></td>
                  </tr>
                 
                   <tr class="txtarea"> 
                    <td><label class="user" >Zukünftiges Optimierungspotential</label></td>       
                    <td colspan="6"class="textarea"> <textarea name="optimization" cols="50" rows="3"></textarea></td>   
                  </tr>
                   <tr class="txtarea"> 
                        <td><label class="user" >Weitere AP im Unternehmen</label></td>       
                        <td colspan="6" class="textarea"> <textarea name="continue" cols="50" rows="3"></textarea></td>   
                  </tr>
                   <tr class="txtarea"> 
                        <td><label class="user" >Bemerkungen</label></td>       
                        <td colspan="6"class="textarea"> <textarea name="comment" cols="50" rows="3"></textarea></td>   
                  </tr>
                   <tr> 
                              
                        <td colspan="7">
                      

                        <input type="hidden" value="Zusage" name="type" id="type">
                        <input type="hidden" value="<?echo ($customers[0][0]->id);?>" name="customer" id="customer">
                        <input type="hidden" value="<?echo ($formular->id);?>" name="product" id="product">
                        <input type="submit" value="Speichern" id="saveButton" name="save" />
                        </td>   
                  </tr>
                </td>
                
                
              </tr>
            </table>         
       </form>
      </div>
    </div>

    <!--================================Feedback Show========================================-->
    <? 
        if($befragunglist != null ){
        //print_r($this->session->userdata('user_id'));
          //print_r($befragunglist)
          //Loginid, style feedback button
    ?>
    <div id="content" class="">
      <div class="grey">    
        <form class="data" action="<?=base_url();?>befragung/save/<?=$befragunglist[0]->id;?>" method="post" id="frmBefragung">        
            <table border="0">
              <tr>
                <td>
                <!--Linke Spalte-->
                  <tr>
                    <td>
                          <tr id="trZusage">
                             <td colspan="7"><h1><? echo $befragunglist[0]->type;?></h1>
                                <?php if ($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "edit"): ?>
                                <div style="float:left; cursor:pointer; margin-bottom:20px;" id="editFormFeedback" onclick="editFormFeedback()">&raquo; Editieren</div>
                                <input type="submit" value="Speichern" name="save" id="saveFeedback" />
                                <div class="clear"></div>
                                <?php endif;?>
                             </td>                             
                          </tr>
         
                          <?if($befragunglist[0]->type=="Absage"){
                           ?>
                          
                          <tr class="txtarea"> 
                               <td class="textarea"><label class="user" >Begründung</label></td>  
                              <td colspan="6" class="textarea"> <textarea name="begruendung" cols="50" rows="3"  disabled="disabled" ><? echo $befragunglist[0]->grundabsage;?></textarea></td>   
                          </tr>
                           <? }
                          ?>
                                                  
                    </td>                    
                  </tr>
                      
                  <tr >
                        <td colspan="7"><label class="user" >Wie sind Sie auf uns gekommen?</label></td> 
                  </tr>
                  <tr class="tab"> 
                        <td>Internet</td>       
                        <td colspan="6"> <input type="radio" disabled="disabled"  id="chkgekommen1" name="chkgekommen" <?php echo ($befragunglist[0]->come=='Internet')?'checked':'' ?> value="Internet"></td>   
                  </tr>
                  <tr class="tab"> 
                        <td>Akquise</td>       
                        <td colspan="6"> <input type="radio" disabled="disabled"  id="chkgekommen1" name="chkgekommen" <?php echo ($befragunglist[0]->come=='Akquise')?'checked':'' ?>  value="Akquise"></td>   
                  </tr>
                  <tr class="tab"> 
                        <td>Newsletter</td>       
                        <td colspan="6"> <input type="radio" disabled="disabled"  disabled="disabled"  id="chkgekommen1" name="chkgekommen" <?php echo ($befragunglist[0]->come=='Newsletter')?'checked':'' ?>  value="Newsletter"></td>   
                  </tr>
                  <tr class="tab"> 
                        <td>Empfehlung</td>       
                        <td colspan="6"> <input type="radio"  disabled="disabled" id="chkgekommen1" name="chkgekommen"  <?php echo ($befragunglist[0]->come=='Empfehlung')?'checked':'' ?> value="Empfehlung"></td>   
                  </tr>
                  <tr class="tab"> 
                        <td>Stammkunde</td>       
                        <td colspan="6"> <input type="radio"  disabled="disabled" id="chkgekommen1" name="chkgekommen" <?php echo ($befragunglist[0]->come=='Stammkunde')?'checked':'' ?>  value="Stammkunde"></td>   
                  </tr>
                  <?
                    
                  ?>
                  <tr class="tab"> 
                        <td>sonstiges, </td>       
                        <td colspan="6"> <input type="text"  disabled="disabled" id="txtgekommen1" name="txtgekommen" value="<?php 
                          if($befragunglist[0]->come !="Internet" && $befragunglist[0]->come !="Akquise" && $befragunglist[0]->come !="Newsletter" && $befragunglist[0]->come !="Empfehlung" && $befragunglist[0]->come !="Stammkunde")
                        echo $befragunglist[0]->come;?>" size="50" onselect="textselect();"></td>   
                  </tr>
                  
                  <tr class="tab" >
                    <td></td>
                    <td>&nbsp; 1</td>
                    <td>&nbsp; 2</td>
                    <td>&nbsp; 3</td>
                    <td>&nbsp; 4</td>
                    <td>&nbsp; 5</td>
                    <td>&nbsp; 6</td>
                  </tr>
                  <tr>
                    <td colspan="7"><label class="user" >Zufriedenheit mit dem Angebot</label></td>
                  </tr>
                  <tr class="tab">
                    <td>Inhalt / Kreativität</td>
                    <?php 
                        for($i = 1; $i <7;$i++)
                        {
                          ?>
                            <td><input type="radio" name="conten" value="<?php echo $i;?>" disabled="disabled" <?php echo ($befragunglist[0]->conten==$i)?'checked':'' ?> ></td>
                          <?
                        }
                    ?>
                    <tr>
                  <tr class="tab">
                    <td>Optik / Layout</td>
                    <?php 
                        for($i = 1; $i <7;$i++)
                        {
                          ?>
                            <td><input type="radio" name="layout" value="<?php echo $i;?>" disabled="disabled" <?php echo ($befragunglist[0]->layout==$i)?'checked':'' ?> ></td>
                          <?
                        }
                    ?>
                  </tr>
                  <tr class="tab">
                    <td>Preise</td>
                    <?php 
                        for($i = 1; $i <7;$i++)
                        {
                          ?>
                            <td><input type="radio" name="price" value="<?php echo $i;?>" disabled="disabled" <?php echo ($befragunglist[0]->price==$i)?'checked':'' ?> ></td>
                          <?
                        }
                    ?>
                  </tr>
                  <tr class="tab">
                    <td>Performance / Schnelligkeit</td>
                    <?php 
                        for($i = 1; $i <7;$i++)
                        {
                          ?>
                            <td><input type="radio" name="performance" value="<?php echo $i;?>" disabled="disabled" <?php echo ($befragunglist[0]->performance==$i)?'checked':'' ?> ></td>
                          <?
                        }
                    ?>                    
                  </tr>
                  <tr class="tab">
                    <td>Betreuung durch SR</td>
                    <?php 
                        for($i = 1; $i <7;$i++)
                        {
                          ?>
                            <td><input type="radio" name="care" value="<?php echo $i;?>" disabled="disabled" <?php echo ($befragunglist[0]->care==$i)?'checked':'' ?> ></td>
                          <?
                        }
                    ?>                    
                  </tr>
                 
                   <tr>
                    <td colspan="7"><label class="user" >Zufriedenheit mit Dienstleister</label></td>
                  </tr>
                  <tr class="tab">
                    <td>Freundlichkeit</td>
                    <?php 
                        for($i = 1; $i <7;$i++)
                        {
                          ?>
                            <td><input type="radio" name="frendly" value="<?php echo $i;?>" disabled="disabled" <?php echo ($befragunglist[0]->frendly==$i)?'checked':'' ?> ></td>
                          <?
                        }
                    ?>                    
                  </tr>
                  <tr class="tab">
                    <td>Abwicklung</td>
                    <?php 
                        for($i = 1; $i <7;$i++)
                        {
                          ?>
                            <td><input type="radio" name="completion" value="<?php echo $i;?>" disabled="disabled" <?php echo ($befragunglist[0]->completion==$i)?'checked':'' ?> ></td>
                          <?
                        }
                    ?>                    
                  </tr>
                  <tr class="tab">
                    <td>Professionalität</td>
                    <?php 
                        for($i = 1; $i <7;$i++)
                        {
                          ?>
                            <td><input type="radio" name="profess" value="<?php echo $i;?>" disabled="disabled" <?php echo ($befragunglist[0]->profess==$i)?'checked':'' ?> ></td>
                          <?
                        }
                    ?>
                  </tr>
                  
                   <tr class="txtarea"> 
                    <td><label class="user" >Zukünftiges Optimierungspotential</label></td>       
                    <td colspan="6"class="textarea"> <textarea name="optimization" cols="50" rows="3" disabled="disabled" ><?php echo ($befragunglist[0]->optimization);?></textarea></td>   
                  </tr>
                   <tr class="txtarea"> 
                        <td><label class="user" >Weitere AP im Unternehmen</label></td>       
                        <td colspan="6" class="textarea"> <textarea name="continue" cols="50" rows="3" disabled="disabled" id="weiter" ><?php echo ($befragunglist[0]->continue);?></textarea></td>   
                  </tr>
                   <tr class="txtarea"> 
                        <td><label class="user" >Bemerkungen</label></td>       
                        <td colspan="6"class="textarea"> <textarea name="comment" cols="50" rows="3" disabled="disabled" ><?php echo ($befragunglist[0]->comment);?></textarea></td>   
                  </tr>
                   <tr>                               
                      <td colspan="7">            
                        <input type="hidden" value="<? echo $befragunglist[0]->type;?>" name="type" id="type">
                        <input type="hidden" value="<?echo ($customers[0][0]->id);?>" name="customer" id="customer">
                        <input type="hidden" value="<?echo ($formular->id);?>" name="product" id="product">
                        <input type="hidden" value="<?echo ($this->session->userdata('user_id'));?>" name="user" id="user">
                        <input type="hidden" value="<?php echo ($this->session->userdata('user_id'));?>"  name="user_id" id="user_id">
                        
                      </td>   
                  </tr>
                </td>                
                
              </tr>
            </table>         
       </form>
      </div>
    </div>

    <?
        }//endif;
    ?>
     </div>
    <div class="clear"></div>
    </div>
    
    </div>
  </div>
  
</body>
</html>