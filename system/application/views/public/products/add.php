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
        <h1>Neues Produkt hinzufügen</h1>
        <div class="logout"><a href="<?=base_url();?>login/logout">&raquo; Logout</a></div>
        <div class="clear"></div>
      </div>
      
      <div id="content">        
        <div id="left">
          <form class="data" action="<?=base_url();?>product/add" method="post">
            
            <label class="user" for="productname">Projektname:</label>
            <input type="text" id="productname" name="productname" value="">
            <div class="clear"></div> 

            <label class="user" for="trainername">Projektkategorie:</label>
            <select name="categories" size="1">
              <?php foreach ($categories as $category) :?>
                <option value="<?=$category->id;?>"><?=$category->name;?></option>
              <?php endforeach; ?>
            </select>
            <div class="clear"></div> 

            <label class="user" for="label">Projektkennung:</label>
            <input type="text" id="label" name="label" value="">
            <div class="clear"></div> 

            <label class="user" for="productname">Projektbeschreibung:</label><br/>
            <textarea rows="4" class="productdescription" cols="50" name="description"></textarea>
            <div class="clear"></div> 
            
            <label class="user" for="attendance">Teilnehmer:</label>
            <input type="text" id="attendance" name="attendance" value="">
            <div class="clear"></div> 
            
            <label class="user" for="trainername">Koordinator:</label>
            <select name="trainername" size="1">
              <?php foreach ($trainername as $trainer) :?>
                <option value="<?=$trainer->trainer_id;?>"><?=$trainer->firstname;?> <?=$trainer->lastname;?></option>
              <?php endforeach; ?>
            </select>
            <div class="clear"></div> 

            <label class="user" for="status">Status:</label>
            <select name="status" id="status" size="1">
               <option value='0'>keine Angabe</option>
               <option value='1'>offen</option>
               <option value='2'>zugesagt</option>
               <option value='3'>abgesagt</option>
            </select>
            <div class="clear"></div> 

                              
<!--             <label class="user" for="target">Ziel:</label>
            <input type="text" id="target" name="target" value="">
            <div class="clear"></div>    -->

            <input type="submit" value="Speichern" id="saveButton" name="save" />
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